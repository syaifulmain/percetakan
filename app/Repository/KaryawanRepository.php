<?php

namespace Saep\Percetakan\Repository;

interface KaryawanRepository
{
    function save(Karyawan $karyawan): void;

    function update(Karyawan $karyawan): void;

    function findByUsername(string $username): ?Karyawan;

    function count(): int;

    function findAll(int $page): array;

    function delete(string $username): void;

}