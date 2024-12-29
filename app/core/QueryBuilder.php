<?php

namespace app\core;

use app\core\Database;

class QueryBuilder
{
    protected string $table;
    protected array $columns = ['*'];
    protected array $where = [];
    protected array $bindings = [];
    protected array $join = [];
    protected array $orderBy = [];
    protected ?int $limit = null;
    protected ?int $offset = null;
    protected array $groupBy = [];
    protected array $having = [];

    public function table(string $table): self
    {
        $this->table = $table;
        return $this;
    }

    public function select(array $columns = ['*']): self
    {
        $this->columns = $columns;
        return $this;
    }

    public function where(string $column, string $operator, $value): self
    {
        $this->where[] = "{$column} {$operator} ?";
        $this->bindings[] = $value;
        return $this;
    }

    public function orWhere(string $column, string $operator, $value): self
    {
        if (!empty($this->where)) {
            $this->where[] = "OR {$column} {$operator} ?";
            $this->bindings[] = $value;
        }
        return $this;
    }

    public function whereIn(string $column, array $values): self
    {
        $placeholders = implode(', ', array_fill(0, count($values), '?'));
        $this->where[] = "{$column} IN ({$placeholders})";
        $this->bindings = array_merge($this->bindings, $values);
        return $this;
    }

    public function whereNotIn(string $column, array $values): self
    {
        $placeholders = implode(', ', array_fill(0, count($values), '?'));
        $this->where[] = "{$column} NOT IN ({$placeholders})";
        $this->bindings = array_merge($this->bindings, $values);
        return $this;
    }

    public function join(string $table, string $first, string $operator, string $second, string $type = 'INNER'): self
    {
        $this->join[] = "{$type} JOIN {$table} ON {$first} {$operator} {$second}";
        return $this;
    }

    public function leftJoin(string $table, string $first, string $operator, string $second): self
    {
        return $this->join($table, $first, $operator, $second, 'LEFT');
    }

    public function rightJoin(string $table, string $first, string $operator, string $second): self
    {
        return $this->join($table, $first, $operator, $second, 'RIGHT');
    }

    public function groupBy(array $columns): self
    {
        $this->groupBy = $columns;
        return $this;
    }

    public function having(string $column, string $operator, $value): self
    {
        $this->having[] = "{$column} {$operator} ?";
        $this->bindings[] = $value;
        return $this;
    }

    public function orderBy(string $column, string $direction = 'ASC'): self
    {
        $this->orderBy[] = "{$column} {$direction}";
        return $this;
    }

    public function limit(int $limit): self
    {
        $this->limit = $limit;
        return $this;
    }

    public function offset(int $offset): self
    {
        $this->offset = $offset;
        return $this;
    }

    /**
     * Retrieve the first row that matches the query.
     */
    public function first(): ?array
    {
        $this->limit(1);
        $results = $this->get();
        return $results[0] ?? null;
    }

    public function paginate(int $currentPage = 1, int $perPage = 15): Paginator
{
    $totalItems = $this->count();
    $this->limit($perPage)->offset(($currentPage - 1) * $perPage);

    $data = $this->get();

    return new Paginator($data, $totalItems, $currentPage, $perPage);
}


    public function min(string $column): mixed
    {
        $sql = "SELECT MIN({$column}) as min_value FROM {$this->table}" . $this->buildWhere();
        $result = Database::fetchOne($sql, $this->bindings);
        return $result['min_value'] ?? null;
    }

    public function max(string $column): mixed
    {
        $sql = "SELECT MAX({$column}) as max_value FROM {$this->table}" . $this->buildWhere();
        $result = Database::fetchOne($sql, $this->bindings);
        return $result['max_value'] ?? null;
    }

    public function sum(string $column): float
    {
        $sql = "SELECT SUM({$column}) as sum_value FROM {$this->table}" . $this->buildWhere();
        $result = Database::fetchOne($sql, $this->bindings);
        return (float) ($result['sum_value'] ?? 0);
    }

    public function avg(string $column): float
    {
        $sql = "SELECT AVG({$column}) as avg_value FROM {$this->table}" . $this->buildWhere();
        $result = Database::fetchOne($sql, $this->bindings);
        return (float) ($result['avg_value'] ?? 0);
    }

    public function count(): int
    {
        $sql = "SELECT COUNT(*) as count FROM {$this->table}" . $this->buildWhere();
        $result = Database::fetchOne($sql, $this->bindings);
        return (int) ($result['count'] ?? 0);
    }

    public function get(): array
    {
        $sql = "SELECT " . implode(', ', $this->columns) . " FROM {$this->table}" . $this->buildJoins() . $this->buildWhere() . $this->buildGroupBy() . $this->buildHaving() . $this->buildOrderBy();

        if ($this->limit !== null) {
            $sql .= " LIMIT {$this->limit}";
        }

        if ($this->offset !== null) {
            $sql .= " OFFSET {$this->offset}";
        }

        return Database::fetchAll($sql, $this->bindings);
    }

    private function buildJoins(): string
    {
        return !empty($this->join) ? ' ' . implode(' ', $this->join) : '';
    }

    private function buildWhere(): string
    {
        return !empty($this->where) ? ' WHERE ' . implode(' AND ', $this->where) : '';
    }

    private function buildGroupBy(): string
    {
        return !empty($this->groupBy) ? ' GROUP BY ' . implode(', ', $this->groupBy) : '';
    }

    private function buildHaving(): string
    {
        return !empty($this->having) ? ' HAVING ' . implode(' AND ', $this->having) : '';
    }

    private function buildOrderBy(): string
    {
        return !empty($this->orderBy) ? ' ORDER BY ' . implode(', ', $this->orderBy) : '';
    }
}
