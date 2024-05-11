<?php

namespace Saep\Percetakan\Repository\Implementation;

use Saep\Percetakan\Domain\DetailPembelian;
use Saep\Percetakan\Repository\DetailPembelianRepository;

class DetailPembelianRepositoryImpl implements DetailPembelianRepository
{
    private \PDO $connection;

    public function __construct(\PDO $connection)
    {
        $this->connection = $connection;
    }

    function save(DetailPembelian $detailPembelian): void
    {
        $statement = $this->connection->prepare("INSERT INTO detail_pembelian(no_transaksi, kode_barang, jumlah, harga) VALUES (?, ?, ?, ?)");
        $statement->execute([
            $detailPembelian->noTransaksi, $detailPembelian->kodeBarang, $detailPembelian->jumlah, $detailPembelian->harga
        ]);
    }
}