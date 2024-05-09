<?php

namespace Saep\Percetakan\Model\BarangJasa;

class BarangJasaRequest
{
    public ?string $kode = null;

    public ?string $nama = null;

    public ?string $jenis = null;

    public ?int $stok = 0;

    public ?float $harga = 0;

}