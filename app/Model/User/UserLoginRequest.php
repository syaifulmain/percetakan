<?php

namespace Saep\Percetakan\Model\User;

class UserLoginRequest
{
    public ?string $username = null;

    public ?string $password = null;

    public string $role;
}