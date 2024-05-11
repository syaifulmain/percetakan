<?php

namespace Saep\Percetakan\Service\Implementation;

use Saep\Percetakan\Config\Database;
use Saep\Percetakan\Domain\Supplier;
use Saep\Percetakan\Model\Supplier\SupplierRequest;
use Saep\Percetakan\Repository\BarangJasaRepository;
use Saep\Percetakan\Repository\SupplierRepository;
use Saep\Percetakan\Service\BarangJasaService;
use Saep\Percetakan\Service\RestokService;

class RestokServiceimpl implements RestokService
{
    private SupplierRepository $supplierRepository;

    private BarangJasaRepository $barangJasaRepository;

    public function __construct(SupplierRepository $supplierRepository, BarangJasaRepository $barangJasaRepository)
    {
        $this->supplierRepository = $supplierRepository;
        $this->barangJasaRepository = $barangJasaRepository;
    }


    function create(SupplierRequest $supplierRequest): void
    {
        try {
            Database::beginTransaction();
            foreach ($supplierRequest->supplier as $supplier) {
                $this->supplierRepository->save($supplier);
                $this->barangJasaRepository->updateStokByNama($supplier->barang, $supplier->stok);
            }
            Database::commitTransaction();
        } catch (\Exception $e) {
            Database::rollbackTransaction();
            throw $e;
        }
    }
}