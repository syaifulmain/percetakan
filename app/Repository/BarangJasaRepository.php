<?php

namespace Saep\Percetakan\Repository;

use Saep\Percetakan\Domain\BarangJasa;

interface BarangJasaRepository
{
    function save(BarangJasa $request): void;

    function update(BarangJasa $request): void;

    function findByKode(string $kode): ?BarangJasa;

    function count(string $jenis): int;

    function findAll(int $page, string $jenis): array;

    function delete(string $kode): void;
}
