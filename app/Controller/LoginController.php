<?php

namespace Saep\Percetakan\Controller;

use Saep\Percetakan\App\View;
use Saep\Percetakan\Config\Database;
use Saep\Percetakan\Exception\ValidationException;
use Saep\Percetakan\Model\User\UserLoginRequest;
use Saep\Percetakan\Repository\Implementation\SessionRepositoryImpl;
use Saep\Percetakan\Repository\Implementation\UserRepositoryImpl;
use Saep\Percetakan\Service\Implementation\SessionServiceImpl;
use Saep\Percetakan\Service\Implementation\UserServiceImpl;
use Saep\Percetakan\Service\SessionService;
use Saep\Percetakan\Service\UserService;

class LoginController
{

    private UserService $userService;
    private SessionService $sessionService;

    public function __construct()
    {
        $connection = Database::getConnection();
        $userRepository = new UserRepositoryImpl($connection);
        $sessionRepository = new SessionRepositoryImpl($connection);
        $this->userService = new UserServiceImpl($userRepository);
        $this->sessionService = new SessionServiceImpl($sessionRepository, $userRepository);
    }

    public function login()
    {
        View::render('login', [
            "title" => "Login user"
        ]);
    }

    public function postLogin()
    {
        $request = new UserLoginRequest();
        $request->username = $_POST['username'];
        $request->password = $_POST['password'];
        $request->role = $_POST['role'];

        try {
            $response = $this->userService->login($request);
            $this->sessionService->create($response->user->username);
            View::redirect('/');
        } catch (ValidationException $exception) {
            View::render('login', [
                'error' => $exception->getMessage()
            ]);
        }
    }
}