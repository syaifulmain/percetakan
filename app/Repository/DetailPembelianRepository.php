<?php

namespace Saep\Percetakan\Repository;

use Saep\Percetakan\Domain\DetailPembelian;

interface DetailPembelianRepository
{
    function save(DetailPembelian $detailPembelian): void;
}