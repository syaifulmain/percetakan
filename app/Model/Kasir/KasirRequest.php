<?php

namespace Saep\Percetakan\Model\Kasir;

class KasirRequest
{
    public DetailPelanggan $pelanggan;
    public Transaksi $transaksi;
    public array $detailBarang;
}

