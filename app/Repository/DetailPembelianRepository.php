<?php

namespace Saep\Percetakan\Repository;

use Saep\Percetakan\Domain\DetailPembelian;

interface DetailPembelianRepository
{
    function save(DetailPembelian $detailPembelian): void;

    function getCountByNoTransaksi(string $noTransaksi): int;

    function getTotalHargaByNoTransaksi(string $noTransaksi): string;

    function getByNoTransaksi(string $noTransaksi): array;

    function delete(string $noTransaksi): void;
}