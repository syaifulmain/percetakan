<?php

namespace Saep\Percetakan\Service;

interface SupplierService
{
    function findAll(): array;
    function delete(int $id): void;

}