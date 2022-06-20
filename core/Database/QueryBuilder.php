<?php

namespace core\Database;

use PDO;

class QueryBuilder
{
    protected PDO $dbh;
    protected static $instance = null;

    protected function __construct($pdo)
    {
        $this->dbh = $pdo;
    }

    /**
     * Singleton
     */
    public static function instance($pdo): QueryBuilder
    {
        if (static::$instance == null) {
            return new self($pdo);
        } else {
            return static::$instance;
        }
    }

    /**
     * Returns table records satisfying exact query.
     */
    public function query(string $statement, string $class, array $data = []): array
    {
        try {
            $sth = $this->dbh->prepare($statement);
            $sth->execute($data);
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }

        return $sth->fetchAll(\PDO::FETCH_CLASS, $class);
    }

    /**
     * Returns weight summary.
     */
    public function summaryQuery(string $statement): string
    {
        try {
            $sth = $this->dbh->prepare($statement);
            $sth->execute();
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }

        return $sth->fetch(\PDO::FETCH_NUM)[0];
    }

    /**
     * Execute sql query - INSERT, DELETE, UPDATE (without fetching anything)
     */
    public function execute($statement, $data = []): bool
    {
        try {
            $sth = $this->dbh->prepare($statement);
            $res = $sth->execute($data);
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }

        return $res;
    }

    public function lastInsertId(): string
    {
        try {
            $res = $this->dbh->lastInsertId();
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }

        return $res;
    }
}