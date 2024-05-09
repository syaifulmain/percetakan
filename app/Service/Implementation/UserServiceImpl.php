<?php

namespace Saep\Percetakan\Service\Implementation;

use Saep\Percetakan\Config\Database;
use Saep\Percetakan\Domain\User;
use Saep\Percetakan\Exception\ValidationException;
use Saep\Percetakan\Model\User\UserCreateRequest;
use Saep\Percetakan\Model\User\UserCreateResponse;
use Saep\Percetakan\Model\User\UserLoginRequest;
use Saep\Percetakan\Model\User\UserLoginResponse;
use Saep\Percetakan\Repository\UserRepository;
use Saep\Percetakan\Service\UserService;

class UserServiceImpl implements UserService
{
    private UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function create(UserCreateRequest $request): UserCreateResponse
    {
        $this->validateUserCreateRequest($request);

        try {
            Database::beginTransaction();
            $user = $this->userRepository->findByUsername($request->username);
            if ($user != null) {
                throw new ValidationException("User Id already exists");
            }

            $user = new User();
            $user->username = $request->username;
            $user->password = $request->password;
            $user->role = $request->role;

            $this->userRepository->save($user);

            $response = new UserCreateResponse();
            $response->user = $user;

            Database::commitTransaction();
            return $response;
        } catch (\Exception $exception) {
            Database::rollbackTransaction();
            throw $exception;
        }
    }

    public function validateUserCreateRequest(UserCreateRequest $request): void
    {
        if ($request->username == null || $request->password == null || $request->role == null ||
            trim($request->username) == "" || trim($request->password) == "" || trim($request->role) == "") {
            throw new ValidationException("Username tidak boleh kosong");
        }
    }

    public function login(UserLoginRequest $request): UserLoginResponse
    {
        $this->validateUserLoginRequest($request);

        $user = $this->userRepository->findUser($request->username, $request->role);
        if ($user == null) {
            throw new ValidationException("username atau password salah");
        }

        if ($request->password == $user->password) {
            $response = new UserLoginResponse();
            $response->user = $user;
            return $response;
        } else {
            throw new ValidationException("username atau password salah");
        }
    }

    private function validateUserLoginRequest(UserLoginRequest $request): void
    {
        if ($request->username == null || $request->password == null ||
            trim($request->username) == "" || trim($request->password) == "") {
            throw new ValidationException("username dan password tidak boleh kosong");
        }
    }
}