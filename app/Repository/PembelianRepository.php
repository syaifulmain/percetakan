<?php

namespace Saep\Percetakan\Repository;

use Saep\Percetakan\Domain\Pembelian;

interface PembelianRepository
{
    function save(Pembelian $pembelian): void;

    function getAll(): array;

    function delete(string $noTransaksi): void;
}