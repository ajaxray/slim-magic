<?php
declare(strict_types=1);

namespace App\Service;

use App\Repository\PostRepository;

final class PostReader
{
    /**
     * The constructor.
     *
     * @param PostRepository $repository The repository
     */
    public function __construct(private PostRepository $repository)
    {}

    /**
     * Create a new user.
     *
     * @param int $page
     * @param int $perPage
     *
     * @return array List of posts
     */
    public function getPaginated(int $page, int $perPage = 5): PaginatedResult
    {
        $offset = ($page * $perPage) - $perPage;
        $total = $this->repository->countPosts();

        return new PaginatedResult(
            $this->repository->getPosts($perPage, $offset),
            $total > ($page * $perPage),
            $page > 1,
        );
    }

    public function getByID(int $id): array|bool
    {
        return $this->repository->getByID($id);
    }
}