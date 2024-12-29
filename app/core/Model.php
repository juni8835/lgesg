<?php

namespace app\core;

use app\core\QueryBuilder;
use app\core\Database;
use Exception;

abstract class Model
{
    protected string $table; // 테이블 이름
    protected array $fillable = []; // 입력 가능한 컬럼들
    protected array $attributes = []; // 데이터
    protected array $original = []; // 원본 데이터
    public bool $exists = false; // 레코드 존재 여부

    /**
     * 생성자
     */
    public function __construct(array $data = [])
    {
        foreach ($data as $key => $value) {
            if (in_array($key, $this->fillable)) {
                $this->attributes[$key] = $value;
            }
        }

        $this->original = $this->attributes; // 원본 값 저장
    }

    /**
     * 정적 메서드: 모든 레코드 가져오기
     */
    public static function all(): array
    {
        $instance = new static();
        return (new QueryBuilder())->table($instance->table)->get();
    }

    /**
     * 정적 메서드: ID로 레코드 찾기
     */
    public static function find(int $id): ?self
    {
        $instance = new static();
        $data = (new QueryBuilder())->table($instance->table)->where('id', '=', $id)->first();

        return $data ? new static($data) : null;
    }

    /**
     * 정적 메서드: ID로 레코드 찾기 (없으면 예외 발생)
     */
    public static function findOrFail(int $id): self
    {
        $record = self::find($id);

        if (!$record) {
            throw new Exception("Record with ID {$id} not found.");
        }

        return $record;
    }

    /**
     * 정적 메서드: 첫 번째 레코드 가져오기
     */
    public static function first(): ?self
    {
        $instance = new static();
        $data = (new QueryBuilder())->table($instance->table)->limit(1)->get();

        return $data ? new static($data[0]) : null;
    }

    /**
     * 정적 메서드: 조건으로 레코드 찾기 또는 생성
     */
    public static function firstOrCreate(array $attributes, array $values = []): self
    {
        $record = (new QueryBuilder())
            ->table((new static())->table)
            ->where(key($attributes), '=', current($attributes))
            ->first();

        if ($record) {
            return new static($record);
        }

        return self::create(array_merge($attributes, $values));
    }

    /**
     * 정적 메서드: 레코드 생성
     */
    public static function create(array $data): self
    {
        $instance = new static($data);
        $instance->save();
        return $instance;
    }

    /**
     * 정적 메서드: 조건으로 업데이트 또는 생성
     */
    public static function updateOrCreate(array $attributes, array $values): self
    {
        $record = (new QueryBuilder())
            ->table((new static())->table)
            ->where(key($attributes), '=', current($attributes))
            ->first();

        if ($record) {
            $instance = new static($record);
            $instance->update($values);
            return $instance;
        }

        return self::create(array_merge($attributes, $values));
    }

    /**
     * 페이징
     */
    public static function paginate(int $currentPage = 1, int $perPage = 15): Paginator
    {
        return (new QueryBuilder())->table((new static())->table)->paginate($currentPage, $perPage);
    }


    /**
     * 레코드 저장
     */
    public function save(): bool
    {
        if ($this->exists) {
            return $this->update($this->attributes);
        }

        $columns = implode(', ', array_keys($this->attributes));
        $placeholders = implode(', ', array_fill(0, count($this->attributes), '?'));
        $sql = "INSERT INTO {$this->table} ({$columns}) VALUES ({$placeholders})";

        $result = Database::query($sql, array_values($this->attributes));
        $this->exists = true;
        return $result;
    }

    /**
     * 레코드 업데이트
     */
    public function update(array $data): bool
    {
        $setClause = implode(', ', array_map(fn($key) => "{$key} = ?", array_keys($data)));
        $sql = "UPDATE {$this->table} SET {$setClause} WHERE id = ?";
        $data['id'] = $this->attributes['id']; // ID 추가
        $this->attributes = array_merge($this->attributes, $data);

        return Database::query($sql, array_values($data));
    }

    /**
     * 레코드 삭제
     */
    public function delete(): bool
    {
        $sql = "DELETE FROM {$this->table} WHERE id = ?";
        $result = Database::query($sql, [$this->attributes['id']]);
        $this->exists = false;
        return $result;
    }

    /**
     * 레코드 수
     */
    public static function count(): int
    {
        $instance = new static();
        return (new QueryBuilder())->table($instance->table)->count();
    }

    /**
     * 레코드 최소값
     */
    public static function min(string $column): mixed
    {
        $instance = new static();
        return (new QueryBuilder())->table($instance->table)->min($column);
    }

    /**
     * 레코드 최대값
     */
    public static function max(string $column): mixed
    {
        $instance = new static();
        return (new QueryBuilder())->table($instance->table)->max($column);
    }

    /**
     * 레코드 합계
     */
    public static function sum(string $column): float
    {
        $instance = new static();
        return (new QueryBuilder())->table($instance->table)->sum($column);
    }

    /**
     * 레코드 평균값
     */
    public static function avg(string $column): float
    {
        $instance = new static();
        return (new QueryBuilder())->table($instance->table)->avg($column);
    }
}
