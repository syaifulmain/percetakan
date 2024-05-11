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

    function getAll(): array
    {
        $statement = $this->connection->prepare("SELECT * FROM pembelian");
        $statement->execute();
        $result =[];
        while ($row = $statement->fetch()) {
            $pembelian = new Pembelian();
            $pembelian->noTransaksi = $row['no_transaksi'];
            $pembelian->idPelanggan = $row['id_pelanggan'];
            $pembelian->idKaryawan = $row['id_karyawan'];
            $pembelian->tanggal = $row['tanggal'];
            $pembelian->bayar = $row['bayar'];
            $result[] = $pembelian;
        }
        return $result;
    }

    function delete(string $noTransaksi): void
    {
        $statement = $this->connection->prepare("DELETE FROM pembelian WHERE no_transaksi = ?");
        $statement->execute([$noTransaksi]);
    }
}