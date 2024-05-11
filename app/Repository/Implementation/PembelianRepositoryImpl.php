<?php

namespace Saep\Percetakan\Repository\Implementation;

use Saep\Percetakan\Domain\Pembelian;
use Saep\Percetakan\Repository\PembelianRepository;

class PembelianRepositoryImpl implements PembelianRepository
{
    private \PDO $connection;

    public function __construct(\PDO $connection)
    {
        $this->connection = $connection;
    }

    function save(Pembelian $pembelian): void
    {
        $statement = $this->connection->prepare("INSERT INTO pembelian(no_transaksi, id_pelanggan, id_karyawan, tanggal, bayar) VALUES (?, ?, ?, ?, ?)");
        $statement->execute([
            $pembelian->noTransaksi, $pembelian->idPelanggan, $pembelian->idKaryawan, $pembelian->tanggal, $pembelian->bayar
        ]);
    }
}