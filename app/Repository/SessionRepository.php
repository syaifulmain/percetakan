<?php

namespace Saep\Percetakan\Repository;

use Saep\Percetakan\Domain\Session;

interface SessionRepository
{
    function save(Session $session): Session;
    function findByUsername(string $username): ?Session;
    function deleteById(string $id): void;
    function deleteAll(): void;
}

