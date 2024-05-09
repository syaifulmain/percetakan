<?php

namespace Saep\Percetakan\Service;

use Saep\Percetakan\Config\Database;
use Saep\Percetakan\Domain\User;
use Saep\Percetakan\Exception\ValidationException;
use Saep\Percetakan\Model\User\UserLoginRequest;
use Saep\Percetakan\Model\User\UserLoginResponse;
use Saep\Percetakan\Model\User\UserCreateRequest;
use Saep\Percetakan\Model\User\UserCreateResponse;
use Saep\Percetakan\Repository\UserRepository;

interface UserService
{
    public function create(UserCreateRequest $request): UserCreateResponse;

    public function login(UserLoginRequest $request): UserLoginResponse;
}

