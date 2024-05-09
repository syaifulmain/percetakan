<?php

namespace Saep\Percetakan\Model\User;

class UserCreateRequest
{
    public ?string $username = null;

    public ?string $password = null;

    public string $role;
}