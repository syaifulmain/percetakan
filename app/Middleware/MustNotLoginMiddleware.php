<?php

namespace Saep\Percetakan\Middleware;

use Saep\Percetakan\App\View;
use Saep\Percetakan\Config\Database;
use Saep\Percetakan\Repository\Implementation\SessionRepositoryImpl;
use Saep\Percetakan\Repository\Implementation\UserRepositoryImpl;
use Saep\Percetakan\Service\Implementation\SessionServiceImpl;
use Saep\Percetakan\Service\SessionService;

class MustNotLoginMiddleware implements Middleware
{
    private SessionService $sessionService;

    public function __construct()
    {
        $sessionRepository = new SessionRepositoryImpl(Database::getConnection());
        $userRepository = new UserRepositoryImpl(Database::getConnection());
        $this->sessionService = new SessionServiceImpl($sessionRepository, $userRepository);
    }

    function before(): void
    {
        $user = $this->sessionService->current();
        if ($user != null) {
            if ($user->role == "admin") {
                View::redirect('/dashboard/managemen/barang', [
                ]);
            } else {
                View::render('/dashboard/kasir', [
                ]);
            }
        }
    }
}