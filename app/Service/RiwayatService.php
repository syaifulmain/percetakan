<?php

namespace Saep\Percetakan\Service;

use Saep\Percetakan\Model\Riwayat\DetailPembelianAdminResponse;

interface RiwayatService
{
    function getAll(): array;

    function getDetail(string $noTransaksi): DetailPembelianAdminResponse;

    function delete(string $noTransaksi): void;
}