<?php

namespace Saep\Percetakan\Service;

use Saep\Percetakan\Domain\Session;
use Saep\Percetakan\Domain\User;
use Saep\Percetakan\Repository\SessionRepository;
use Saep\Percetakan\Repository\UserRepository;

interface SessionService
{
    public function create(string $username): Session;
    public function destroy();
    public function current(): ?User;
}

