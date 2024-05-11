<?php

namespace Saep\Percetakan\Repository\Implementation;

use Saep\Percetakan\Domain\Supplier;
use Saep\Percetakan\Repository\SupplierRepository;

class SupplierRepositoryImpl implements SupplierRepository
{

    private \PDO $connection;

    public function __construct(\PDO $connection)
    {
        $this->connection = $connection;
    }

    function save(Supplier $supplier): void
    {
        $statement = $this->connection->prepare("INSERT INTO supplier(supplier, barang, harga, stok, tanggal) VALUES (?, ?, ?, ?, ?)");
        $statement->execute([$supplier->supplier, $supplier->barang, $supplier->harga, $supplier->stok, $supplier->tanggal]);
    }

    function findAll(): array
    {
        $statement = $this->connection->prepare("SELECT * FROM supplier");
        $statement->execute();
        return $statement->fetchAll(\PDO::FETCH_ASSOC);
    }

    function delete(string $id): void
    {
        $statement = $this->connection->prepare("DELETE FROM supplier WHERE id = ?");
        $statement->execute([$id]);
    }
}