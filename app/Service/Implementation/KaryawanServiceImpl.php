<?php

namespace Saep\Percetakan\Service\Implementation;

use Saep\Percetakan\Config\Database;
use Saep\Percetakan\Domain\Karyawan;
use Saep\Percetakan\Domain\User;
use Saep\Percetakan\Model\Karyawan\KaryawanRequest;
use Saep\Percetakan\Repository\KaryawanRepository;
use Saep\Percetakan\Repository\UserRepository;
use Saep\Percetakan\Service\KaryawanService;

class KaryawanServiceImpl implements KaryawanService
{
    private KaryawanRepository $karyawanRepository;

    private UserRepository $userRepository;

    public function __construct(KaryawanRepository $karyawanRepository, UserRepository $userRepository)
    {
        $this->karyawanRepository = $karyawanRepository;
        $this->userRepository = $userRepository;
    }

    function create(KaryawanRequest $request): void
    {
        try {
            Database::beginTransaction();
            $karyawan = $this->karyawanRepository->findByUsername($request->username);
            if ($karyawan != null) {
                throw new \Exception("Karyawan dengan username " . $request->username . " sudah ada");
            }

            $user = new User();
            $user->username = $request->username;
            $user->password = $request->username;
            $user->role = "karyawan";

            $this->userRepository->save($user);

            $karyawan = new Karyawan();
            $karyawan->username = $request->username;
            $karyawan->nama = $request->nama;
            $karyawan->alamat = $request->alamat;
            $karyawan->noTelp = $request->noTelp;

            $this->karyawanRepository->save($karyawan);
            Database::commitTransaction();
        } catch (\Exception $exception) {
            Database::rollbackTransaction();
            throw $exception;
        }
    }

    function totalPage(): int
    {
        return ceil($this->karyawanRepository->count() / 10);
    }

    function findAll(int $page): array
    {
        return $this->karyawanRepository->findAll($page);
    }

    function update(KaryawanRequest $request): bool
    {
        try {
            Database::beginTransaction();
            $karyawan = $this->karyawanRepository->findByUsername($request->username);
            if ($karyawan == null) {
                throw new \Exception("Karyawan dengan username " . $request->username . " tidak ditemukan");
            }

            $karyawan->nama = $request->nama;
            $karyawan->alamat = $request->alamat;
            $karyawan->noTelp = $request->noTelp;

            $this->karyawanRepository->update($karyawan);
            Database::commitTransaction();
            return true;
        } catch (\Exception $exception) {
            Database::rollbackTransaction();
            throw $exception;
        }
    }

    function delete(string $kode): void
    {
        try {
            Database::beginTransaction();
            $karyawan = $this->karyawanRepository->findByUsername($kode);
            if ($karyawan == null) {
                throw new \Exception("Karyawan dengan username " . $kode . " tidak ditemukan");
            }

            $this->karyawanRepository->delete($kode);
            Database::commitTransaction();
        } catch (\Exception $exception) {
            Database::rollbackTransaction();
            throw $exception;
        }
    }
}