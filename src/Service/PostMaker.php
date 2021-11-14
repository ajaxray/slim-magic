<?php
declare(strict_types=1);
namespace App\Service;

use App\Repository\PostRepository;
use App\Exception\ValidationException;

final class PostMaker
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
     * @param array $data The form data
     *
     * @return int The new user ID
     * @throws \Doctrine\DBAL\Exception
     */
    public function createPost(array $data): int
    {
        $this->validateNewPost($data);

        $userId = $this->repository->insertPost($data);

        // Logging here: User created successfully
        //$this->logger->info(sprintf('User created successfully: %s', $userId));

        return $userId;
    }

    /**
     * @return int Number of updated rows
     * @throws \Doctrine\DBAL\Exception
     */
    public function updatePost(int $id, array $data): int
    {
        $this->validateNewPost($data);

        return $this->repository->updatePost($id, $data);
    }

    /**
     * Input validation.
     *
     * @param array $data The form data
     *
     * @throws ValidationException
     *
     * @return void
     */
    private function validateNewPost(array $data): void
    {
        $errors = [];

        if (empty($data['title'])) {
            $errors['title'] = 'Post title cannot be empty';
        }

        if (empty($data['content'])) {
            $errors['content'] = 'Post content cannot be empty';
        }

        if ($errors) {
            throw new ValidationException('Please check your input', $errors);
        }
    }
}