<?php

namespace App\Domain\User\Repository;

use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Exception;

final class UserCreatorRepository
{
    private Connection $connection;

    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }

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