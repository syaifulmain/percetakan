<?php

namespace Saep\Percetakan\Service;

use Saep\Percetakan\Model\User\UserGetNameRole;
use Saep\Percetakan\Model\User\UserLoginRequest;
use Saep\Percetakan\Model\User\UserLoginResponse;
use Saep\Percetakan\Model\User\UserCreateRequest;
use Saep\Percetakan\Model\User\UserCreateResponse;

interface UserService
{
    public function create(UserCreateRequest $request): UserCreateResponse;

    public function login(UserLoginRequest $request): UserLoginResponse;

    public function getUserInformation(): UserGetNameRole;
}

