<?php

namespace Saep\Percetakan\Repository\Implementation;

use Saep\Percetakan\Domain\Karyawan;
use Saep\Percetakan\Repository\KaryawanRepository;

class KaryawanRepositoryImpl implements KaryawanRepository
{
    private \PDO $connection;

    public function __construct(\PDO $connection)
    {
        $this->connection = $connection;
    }
    function getNamaByUsername(string $username): ?string
    {
        $statement = $this->connection->prepare("SELECT nama FROM karyawan WHERE username = ?");
        $statement->execute([$username]);

        try {
            if ($row = $statement->fetch()) {
                return $row['nama'];
            } else {
                return null;
            }
        } finally {
            $statement->closeCursor();
        }
    }

    function save(Karyawan $karyawan): void
    {
        $statement = $this->connection->prepare("INSERT INTO karyawan(username, nama, alamat, no_telp) VALUES (?, ?, ?, ?)");
        $statement->execute([
            $karyawan->username, $karyawan->nama, $karyawan->alamat, $karyawan->noTelp
        ]);
    }

    function update(Karyawan $karyawan): void
    {
        $statement = $this->connection->prepare("UPDATE karyawan SET nama = ?, alamat = ?, no_telp = ? WHERE username = ?");
        $statement->execute([
            $karyawan->nama, $karyawan->alamat, $karyawan->noTelp, $karyawan->username
        ]);
    }

    function findByUsername(string $username): ?Karyawan
    {
        $statement = $this->connection->prepare("SELECT username, nama, alamat, no_telp FROM karyawan WHERE username = ?");
        $statement->execute([$username]);

        try {
            if ($row = $statement->fetch()) {
                $karyawan = new Karyawan();
                $karyawan->username = $row['username'];
                $karyawan->nama = $row['nama'];
                $karyawan->alamat = $row['alamat'];
                $karyawan->noTelp = $row['no_telp'];
                return $karyawan;
            } else {
                return null;
            }
        } finally {
            $statement->closeCursor();
        }
    }

    function count(): int
    {
        $statement = $this->connection->prepare("SELECT COUNT(*) as total FROM karyawan");
        $statement->execute();
        $row = $statement->fetch();
        return $row['total'];
    }

    function findAll(int $page): array
    {
        $limit = 10;
        $offset = ($page - 1) * $limit;
        $statement = $this->connection->prepare("SELECT * FROM karyawan LIMIT :limit OFFSET :offset");
        $statement->bindParam(':limit', $limit, \PDO::PARAM_INT);
        $statement->bindParam(':offset', $offset, \PDO::PARAM_INT);
        $statement->execute();

        $result = [];
        while ($row = $statement->fetch()) {
            $karyawan = new Karyawan();
            $karyawan->username = $row['username'];
            $karyawan->nama = $row['nama'];
            $karyawan->alamat = $row['alamat'];
            $karyawan->noTelp = $row['no_telp'];
            $result[] = $karyawan;
        }

        return $result;
    }

    function delete(string $username): void
    {
        $statement = $this->connection->prepare("DELETE FROM karyawan WHERE username = ?");
        $statement->execute([$username]);
    }

    function getNamaByNoTransaksi(string $noTransaksi): string
    {
        $statement = $this->connection->prepare("SELECT karyawan.nama FROM karyawan JOIN pembelian ON karyawan.username = pembelian.id_karyawan WHERE pembelian.no_transaksi = ?");
        $statement->execute([$noTransaksi]);
        $result = $statement->fetch();
        return $result['nama'];
    }
}