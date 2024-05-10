<?php

namespace Saep\Percetakan\Controller;

use Saep\Percetakan\App\View;
use Saep\Percetakan\Config\Database;
use Saep\Percetakan\Exception\ValidationException;
use Saep\Percetakan\Model\User\UserLoginRequest;
use Saep\Percetakan\Repository\Implementation\KaryawanRepositoryImpl;
use Saep\Percetakan\Repository\Implementation\SessionRepositoryImpl;
use Saep\Percetakan\Repository\Implementation\UserRepositoryImpl;
use Saep\Percetakan\Service\Implementation\SessionServiceImpl;
use Saep\Percetakan\Service\Implementation\UserServiceImpl;
use Saep\Percetakan\Service\SessionService;
use Saep\Percetakan\Service\UserService;

class UserController
{

    private UserService $userService;
    private SessionService $sessionService;

    public function __construct()
    {
        $connection = Database::getConnection();
        $sessionRepository = new SessionRepositoryImpl($connection);
        $userRepository = new UserRepositoryImpl($connection);
        $karyawanRepository = new KaryawanRepositoryImpl($connection);
        $this->sessionService = new SessionServiceImpl($sessionRepository, $userRepository);
        $this->userService = new UserServiceImpl($userRepository, $this->sessionService, $karyawanRepository);
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

    public function logout()
    {
        $this->sessionService->destroy();
        View::redirect('/');
    }
}