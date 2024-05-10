<?php

namespace Saep\Percetakan\Repository;

use Saep\Percetakan\Domain\Karyawan;

interface KaryawanRepository
{
    function getNamaByUsername(string $username): ?string;

    function save(Karyawan $karyawan): void;

    function update(Karyawan $karyawan): void;

    function findByUsername(string $username): ?Karyawan;

    function count(): int;

    function findAll(int $page): array;

    function delete(string $username): void;

}