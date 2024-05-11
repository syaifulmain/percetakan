<?php

namespace Saep\Percetakan\Domain;

class DetailPembelian
{
    public string $noTransaksi;
    public string $kodeBarang;
    public int $jumlah;
    public float $harga;
}