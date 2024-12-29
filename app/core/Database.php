<?php

namespace app\core;

use PDO;
use PDOException;

class Database
{
    private static ?PDO $connection = null;

    /**
     * Connect to the database
     */
    public static function connect(): PDO
    {
        if (self::$connection === null) {
            $config = Config::get('database.connections.mysql');

            $host = $config['host'] ?? '127.0.0.1';
            $database = $config['database'] ?? '';
            $username = $config['username'] ?? 'root';
            $password = $config['password'] ?? '';
            $charset = $config['charset'] ?? 'utf8mb4';
            $collation = $config['collation'] ?? 'utf8mb4_unicode_ci';
            $port = $config['port'] ?? 3306;

            $dsn = "mysql:host={$host};port={$port};dbname={$database};charset={$charset}";

            try {
                self::$connection = new PDO($dsn, $username, $password, [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                    PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES '{$charset}' COLLATE '{$collation}'",
                ]);
            } catch (PDOException $e) {
                throw new \Exception("Database connection failed: " . $e->getMessage());
            }
        }

        return self::$connection;
    }

    /**
     * Execute a query
     */
    public static function query(string $sql, array $params = [])
    {
        if (self::$connection === null) {
            throw new \Exception("Database connection not established. Call `connect()` first.");
        }
        
        $stmt = self::$connection->prepare($sql);
        $stmt->execute($params);

        return $stmt;
    }

    /**
     * Fetch all rows
     */
    public static function fetchAll(string $sql, array $params = []): array
    {
        $stmt = self::query($sql, $params);
        return $stmt->fetchAll();
    }

    /**
     * Fetch a single row
     */
    public static function fetchOne(string $sql, array $params = []): array
    {
        $stmt = self::query($sql, $params);
        return $stmt->fetch() ?: [];
    }

    /**
     * Get the last inserted ID
     */
    public static function lastInsertId(): string
    {
        if (self::$connection === null) {
            throw new \Exception("Database connection not established. Call `connect()` first.");
        }

        return self::$connection->lastInsertId();
    }

    /**
     * Close the database connection
     */
    public static function close(): void
    {
        self::$connection = null;
    }
}
