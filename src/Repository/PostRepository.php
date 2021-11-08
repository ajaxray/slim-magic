<?php

namespace App\Repository;

use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Exception;

final class PostRepository
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
    public function insertPost(array $post): int
    {
        $this->connection->insert('posts', $post);
        return (int)$this->connection->lastInsertId();
    }

    public function getPosts(int $limit, int $offset = 0, array $condition = []): array
    {
        return $this->connection->fetchAllAssociative("SELECT * FROM posts LIMIT {$offset}, {$limit}");
    }

    /**
     * @throws Exception
     */
    public function getByID(int $id): array|bool
    {
        return $this->connection->executeQuery("SELECT * FROM posts WHERE id = ?", [$id])->fetchAssociative();
    }
}