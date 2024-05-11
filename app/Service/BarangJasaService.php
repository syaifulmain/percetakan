<?php

namespace Saep\Percetakan\Service;

use Saep\Percetakan\Model\BarangJasa\BarangJasaRequest;

interface BarangJasaService
{
    function create(BarangJasaRequest $request): bool;

    function totalPage(string $jenis): int;

    function findAll(int $page, string $jenis): array;

    function update(BarangJasaRequest $request): bool;

    function delete(string $kode): bool;

    function getAll(): array;

    function trulyGetAll(): array;
}

