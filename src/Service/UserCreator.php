<?php
declare(strict_types=1);

namespace App\Service;

use App\Repository\UserRepository;
use App\Exception\ValidationException;

final class UserCreator
{
    /**
     * The constructor.
     *
     * @param UserRepository $repository The repository
     */
    public function __construct(private UserRepository $repository)
    {}

    /**
     * Create a new user.
     *
     * @param array $data The form data
     *
     * @return int The new user ID
     * @throws \Doctrine\DBAL\Exception
     */
    public function createUser(array $data): int
    {
        // Input validation
        $this->validateNewUser($data);

        // Insert user
        $userId = $this->repository->insertUser($data);

        // Logging here: User created successfully
        //$this->logger->info(sprintf('User created successfully: %s', $userId));

        return $userId;
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
    private function validateNewUser(array $data): void
    {
        $errors = [];

        if (empty($data['username'])) {
            $errors['username'] = 'Input required';
        }

        if (empty($data['email'])) {
            $errors['email'] = 'Input required';
        } elseif (filter_var($data['email'], FILTER_VALIDATE_EMAIL) === false) {
            $errors['email'] = 'Invalid email address';
        }

        if ($errors) {
            throw new ValidationException('Please check your input', $errors);
        }
    }
}