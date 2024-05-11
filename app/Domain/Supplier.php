<?php

namespace Saep\Percetakan\Domain;

class Supplier
{
    public int $id;
    public string $supplier;
    public string $barang;
    public float $harga;
    public int $stok;
    public string $tanggal;
}