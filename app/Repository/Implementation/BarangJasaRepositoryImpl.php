<?php

namespace Saep\Percetakan\Repository\Implementation;

use Saep\Percetakan\Domain\BarangJasa;
use Saep\Percetakan\Repository\BarangJasaRepository;

class BarangJasaRepositoryImpl implements BarangJasaRepository
{
    private \PDO $connection;

    public function __construct(\PDO $connection)
    {
        $this->connection = $connection;
    }

    function save(BarangJasa $request): void
    {
        $statement = $this->connection->prepare("INSERT INTO barang_jasa(kode, nama, jenis, stok, harga) VALUES (?, ?, ?, ?, ?)");
        $statement->execute([
            $request->kode, $request->nama, $request->jenis, $request->stok, $request->harga
        ]);
    }

    function findByKode(string $kode): ?BarangJasa
    {
        $statement = $this->connection->prepare("SELECT kode, nama, jenis, stok, harga FROM barang_jasa WHERE kode = ?");
        $statement->execute([$kode]);

        try {
            if ($row = $statement->fetch()) {
                $barangJasa = $this->getBarangJasa($row);
                return $barangJasa;
            } else {
                return null;
            }
        } finally {
            $statement->closeCursor();
        }
    }

    function count(string $jenis): int
    {
        $statement = $this->connection->prepare("SELECT COUNT(*) as total FROM barang_jasa WHERE jenis = ?");
        $statement->execute([$jenis]);
        $row = $statement->fetch();
        return $row['total'];
    }

    function findAll(int $page, string $jenis): array
    {
        $limit = 10;
        $offset = ($page - 1) * $limit;
        $statement = $this->connection->prepare("SELECT * FROM barang_jasa WHERE jenis = :jenis LIMIT :limit OFFSET :offset");
        $statement->bindParam(':jenis', $jenis);
        $statement->bindParam(':limit', $limit, \PDO::PARAM_INT);
        $statement->bindParam(':offset', $offset, \PDO::PARAM_INT);
        $statement->execute();

        $result = [];
        while ($row = $statement->fetch()) {
            $barangJasa = $this->getBarangJasa($row);
            $result[] = $barangJasa;
        }

        return $result;
    }

    public function getBarangJasa(mixed $row): BarangJasa
    {
        $barangJasa = new BarangJasa();
        $barangJasa->kode = $row['kode'];
        $barangJasa->nama = $row['nama'];
        $barangJasa->jenis = $row['jenis'];
        $barangJasa->stok = $row['stok'];
        $barangJasa->harga = $row['harga'];
        return $barangJasa;
    }

    function update(BarangJasa $request): void
    {
        $statement = $this->connection->prepare("UPDATE barang_jasa SET nama = ?, jenis = ?, stok = ?, harga = ? WHERE kode = ?");
        $statement->execute([
            $request->nama, $request->jenis, $request->stok, $request->harga, $request->kode
        ]);
    }

    function delete(string $kode): void
    {
        $statement = $this->connection->prepare("DELETE FROM barang_jasa WHERE kode = ?");
        $statement->execute([$kode]);
    }

    function getAll(): array
    {
        // harga > 0 stok > 0
        $statement = $this->connection->prepare("SELECT * FROM barang_jasa WHERE harga > 0 AND stok > 0");
        $statement->execute();

        $result = [];
        while ($row = $statement->fetch()) {
            $barangJasa = $this->getBarangJasa($row);
            $result[] = $barangJasa;
        }

        return $result;
    }

    function updateStok(string $kode, int $qty): void
    {
        $statement = $this->connection->prepare("UPDATE barang_jasa SET stok = stok - ? WHERE kode = ?");
        $statement->execute([$qty, $kode]);
    }

    function updateStokByNama(string $nama, int $qty): void
    {
        $statement = $this->connection->prepare("UPDATE barang_jasa SET stok = stok + ? WHERE nama = ?");
        $statement->execute([$qty, $nama]);
    }

    function trulyGetAll(): array
    {
        $statement = $this->connection->prepare("SELECT * FROM barang_jasa");
        $statement->execute();

        $result = [];
        while ($row = $statement->fetch()) {
            $barangJasa = $this->getBarangJasa($row);
            $result[] = $barangJasa;
        }

        return $result;
    }
}