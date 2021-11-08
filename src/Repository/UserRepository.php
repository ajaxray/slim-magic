<?php

namespace App\Repository;

use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Exception;

final class UserRepository
{
    public function __construct(private Connection $connection)
    {}

    /**
     * Insert user row.
     *
     * @param array $user The user
     *
     * @return int The new ID
     * @throws Exception
     */
    public function insertUser(array $user): int
    {
        $this->connection->insert('users', $user);
        return (int)$this->connection->lastInsertId();
    }
}