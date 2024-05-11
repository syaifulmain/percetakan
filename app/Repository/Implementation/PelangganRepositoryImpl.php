<?php

namespace Saep\Percetakan\Repository\Implementation;

use Saep\Percetakan\Domain\Pelanggan;
use Saep\Percetakan\Repository\PelangganRepository;

class PelangganRepositoryImpl implements PelangganRepository
{
    private \PDO $connection;

    public function __construct(\PDO $connection)
    {
        $this->connection = $connection;
    }

    function save(Pelanggan $pelanggan): void
    {
        $statement = $this->connection->prepare("INSERT INTO pelanggan(nama, no_telp) VALUES (?, ?)");
        $statement->execute([
            $pelanggan->nama, $pelanggan->noTelp
        ]);
    }

    function getLastIdByNama(string $nama): int
    {
        $statement = $this->connection->prepare("SELECT id FROM pelanggan WHERE nama = ? ORDER BY id DESC LIMIT 1");
        $statement->execute([$nama]);
        $result = $statement->fetch();
        return $result['id'];
    }

    function getNamaByNoTransaksi(string $noTransaksi): string
    {
        $statement = $this->connection->prepare("SELECT pelanggan.nama FROM pelanggan JOIN pembelian ON pelanggan.id = pembelian.id_pelanggan WHERE pembelian.no_transaksi = ?");
        $statement->execute([$noTransaksi]);
        $result = $statement->fetch();
        return $result['nama'];
    }
}