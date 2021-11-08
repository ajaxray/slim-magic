<?php
declare(strict_types=1);
namespace App\Service;

use App\Repository\PostRepository;
use App\Exception\ValidationException;

final class PostListing
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
    public function getPaginated(int $page, int $perPage = 5): array
    {
        $offset = ($page * $perPage) - $perPage;
        return $this->repository->getPosts($perPage, $offset);
    }

    public function getByID(int $id): array|bool
    {
        return $this->repository->getByID($id);
    }
}