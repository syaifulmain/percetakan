<?php

namespace Saep\Percetakan\Service;

use Saep\Percetakan\Model\Karyawan\KaryawanRequest;

interface KaryawanService
{
    function create(KaryawanRequest $request): void;

    function totalPage(): int;

    function findAll(int $page): array;

    function update(KaryawanRequest $request): bool;

    function delete(string $kode): bool;
}