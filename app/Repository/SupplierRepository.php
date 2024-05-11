<?php

namespace Saep\Percetakan\Repository;

use Saep\Percetakan\Domain\Supplier;

interface SupplierRepository
{
    function save(Supplier $supplier): void;

    function findAll(): array;
    function delete(string $id): void;
}