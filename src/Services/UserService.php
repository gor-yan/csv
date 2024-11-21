<?php

namespace App\Services;

use App\Models\User;
use App\Repositories\UserRepository;

class UserService
{
    private UserRepository $userRepository;

    public function __construct()
    {
        $this->userRepository = new UserRepository();
    }

    public function save(User $user): void
    {
        $this->userRepository->save($user);
    }

    public function getAllUsers(): array
    {
        return $this->userRepository->getAll();
    }
}
