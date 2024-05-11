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

    function getCountByNoTransaksi(string $noTransaksi): int
    {
        $statement = $this->connection->prepare("SELECT COUNT(*) FROM detail_pembelian WHERE no_transaksi = ?");
        $statement->execute([$noTransaksi]);
        return $statement->fetchColumn();
    }

    function getTotalHargaByNoTransaksi(string $noTransaksi): string
    {
        $statement = $this->connection->prepare("SELECT SUM(jumlah * harga) FROM detail_pembelian WHERE no_transaksi = ?");
        $statement->execute([$noTransaksi]);
        return $statement->fetchColumn();
    }

    function getByNoTransaksi(string $noTransaksi): array
    {
        $statement = $this->connection->prepare("SELECT * FROM detail_pembelian WHERE no_transaksi = ?");
        $statement->execute([$noTransaksi]);
        $result = [];
        while ($row = $statement->fetch()) {
            $detailPembelian = new DetailPembelian();
            $detailPembelian->noTransaksi = $row['no_transaksi'];
            $detailPembelian->kodeBarang = $row['kode_barang'];
            $detailPembelian->jumlah = $row['jumlah'];
            $detailPembelian->harga = $row['harga'];
            $result[] = $detailPembelian;
        }
        return $result;
    }

    function delete(string $noTransaksi): void
    {
        $statement = $this->connection->prepare("DELETE FROM detail_pembelian WHERE no_transaksi = ?");
        $statement->execute([$noTransaksi]);
    }
}