<?php

namespace Saep\Percetakan\Service\Implementation;

use Saep\Percetakan\Repository\SupplierRepository;
use Saep\Percetakan\Service\SupplierService;

class SupplierServiceImpl implements SupplierService
{

    private SupplierRepository $supplierRepository;

    public function __construct(SupplierRepository $supplierRepository)
    {
        $this->supplierRepository = $supplierRepository;
    }

    function findAll(): array
    {
        return $this->supplierRepository->findAll();
    }

    function delete(int $id): void
    {
        $this->supplierRepository->delete($id);
    }
}