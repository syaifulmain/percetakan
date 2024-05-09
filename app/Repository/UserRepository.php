<?php

namespace Saep\Percetakan\Repository;

use Saep\Percetakan\Domain\User;

interface UserRepository
{
    public function save(User $user): User;
    public function update(User $user): User;
    public function findByUsername(string $username): ?User;
    public function findUser(string $username, string $role): ?User;
    public function delete(string $username): void;
}

