<?php

namespace Saep\Percetakan\Service\Implementation;

use Saep\Percetakan\Domain\Session;
use Saep\Percetakan\Domain\User;
use Saep\Percetakan\Repository\SessionRepository;
use Saep\Percetakan\Repository\UserRepository;
use Saep\Percetakan\Service\SessionService;

class SessionServiceImpl implements SessionService
{

    public static string $COOKIE_NAME = "X-LOGIN-SESSION";

    private SessionRepository $sessionRepository;
    private UserRepository $userRepository;

    public function __construct(SessionRepository $sessionRepository, UserRepository $userRepository)
    {
        $this->sessionRepository = $sessionRepository;
        $this->userRepository = $userRepository;
    }

    public function create(string $username): Session
    {
        $session = new Session();
        $session->id = uniqid();
        $session->username = $username;

        $this->sessionRepository->save($session);

        setcookie(self::$COOKIE_NAME, $session->id, time() + (60 * 60 * 24 * 30), "/");

        return $session;
    }

    public function destroy()
    {
        $sessionId = $_COOKIE[self::$COOKIE_NAME] ?? '';
        $this->sessionRepository->deleteById($sessionId);

        setcookie(self::$COOKIE_NAME, '', 1, "/");
    }

    public function current(): ?User
    {
        $sessionId = $_COOKIE[self::$COOKIE_NAME] ?? '';

        $session = $this->sessionRepository->findByUsername($sessionId);
        if ($session == null) {
            return null;
        }

        return $this->userRepository->findByUsername($session->username);
    }

}