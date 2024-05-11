<?php

namespace Saep\Percetakan\Domain;

class Pembelian
{
    public string $noTransaksi;
    public int $idPelanggan;
    public string $idKaryawan;
    public string $tanggal;
    public float $bayar;
}