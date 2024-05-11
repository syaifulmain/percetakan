<?php

namespace Saep\Percetakan\Service;

use Saep\Percetakan\Model\Supplier\SupplierRequest;

interface RestokService
{
    function create(SupplierRequest $supplierRequest): void;
}