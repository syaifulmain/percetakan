<?php

namespace Saep\Percetakan\Repository\Implementation;

use Saep\Percetakan\Domain\User;
use Saep\Percetakan\Repository\UserRepository;

class UserRepositoryImpl implements UserRepository
{
    private \PDO $connection;

    public function __construct(\PDO $connection)
    {
        $this->connection = $connection;
    }

    public function save(User $user): User
    {
        $statement = $this->connection->prepare("INSERT INTO users(username, password, role) VALUES (?, ?, ?)");
        $statement->execute([
            $user->username, $user->password, $user->role
        ]);
        return $user;
    }

    public function update(User $user): User
    {
        $statement = $this->connection->prepare("UPDATE users SET username = ?, password = ? WHERE username = ?");
        $statement->execute([
            $user->username, $user->password, $user->username
        ]);
        return $user;
    }

    public function findByUsername(string $username): ?User
    {
        $statement = $this->connection->prepare("SELECT username, password, role FROM users WHERE username = ?");
        $statement->execute([$username]);

        try {
            if ($row = $statement->fetch()) {
                $user = new User();
                $user->username = $row['username'];
                $user->password = $row['password'];
                $user->role = $row['role'];
                return $user;
            } else {
                return null;
            }
        } finally {
            $statement->closeCursor();
        }
    }

    public function delete(string $username): void
    {
        $statement = $this->connection->prepare("DELETE FROM users WHERE username = ?");
        $statement->execute([$username]);
    }

    public function findUser(string $username, string $role): ?User
    {
        $statement = $this->connection->prepare("SELECT username, password, role FROM users WHERE username = ? AND role = ?");
        $statement->execute([$username, $role]);

        try {
            if ($row = $statement->fetch()) {
                $user = new User();
                $user->username = $row['username'];
                $user->password = $row['password'];
                $user->role = $row['role'];
                return $user;
            } else {
                return null;
            }
        } finally {
            $statement->closeCursor();
        }
    }
}