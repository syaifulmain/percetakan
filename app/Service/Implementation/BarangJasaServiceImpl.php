<?php

namespace Saep\Percetakan\Service\Implementation;

use Saep\Percetakan\Config\Database;
use Saep\Percetakan\Domain\BarangJasa;
use Saep\Percetakan\Exception\ValidationException;
use Saep\Percetakan\Model\BarangJasa\BarangJasaRequest;
use Saep\Percetakan\Repository\BarangJasaRepository;
use Saep\Percetakan\Service\BarangJasaService;

class BarangJasaServiceImpl implements BarangJasaService
{

    private BarangJasaRepository $barangJasaRepository;

    public function __construct(BarangJasaRepository $barangJasaRepository)
    {
        $this->barangJasaRepository = $barangJasaRepository;
    }

    function create(BarangJasaRequest $request): bool
    {
        $this->validateUserCreateRequest($request);

        try {
            Database::beginTransaction();
            $barangJasa = $this->barangJasaRepository->findByKode($request->kode);
            if ($barangJasa != null) {
                throw new ValidationException("Barang Jasa dengan kode " . $request->kode . " sudah ada");
            }

            $barangJasa = new BarangJasa();
            $barangJasa->kode = $request->kode;
            $barangJasa->nama = $request->nama;
            $barangJasa->jenis = $request->jenis;
            $barangJasa->stok = $request->stok;
            $barangJasa->harga = $request->harga;

            $this->barangJasaRepository->save($barangJasa);

            Database::commitTransaction();
            return true;
        } catch (\Exception $exception) {
            Database::rollbackTransaction();
            throw $exception;
        }
    }

    public function validateUserCreateRequest(BarangJasaRequest $request): void
    {
        if ($request->kode == null || trim($request->kode) == "") {
            throw new ValidationException("Kode tidak boleh kosong");
        } else if ($request->nama == null || trim($request->nama) == "") {
            throw new ValidationException("Nama tidak boleh kosong");
        }
    }

    function totalPage(string $jenis): int
    {
        return ceil($this->barangJasaRepository->count($jenis) / 10);
    }

    function findAll(int $page, string $jenis): array
    {
        return $this->barangJasaRepository->findAll($page, $jenis);
    }

    function update(BarangJasaRequest $request): bool
    {
        $this->validateUserCreateRequest($request);

        try {
            Database::beginTransaction();
            $barangJasa = $this->barangJasaRepository->findByKode($request->kode);
            if ($barangJasa == null) {
                throw new ValidationException("Barang Jasa dengan kode " . $request->kode . " tidak ditemukan");
            }

            $barangJasa->nama = $request->nama;
            $barangJasa->jenis = $request->jenis;
            $barangJasa->stok = $request->stok;
            $barangJasa->harga = $request->harga;

            $this->barangJasaRepository->update($barangJasa);

            Database::commitTransaction();
            return true;
        } catch (\Exception $exception) {
            Database::rollbackTransaction();
            throw $exception;
        }
    }

    function delete(string $kode): bool
    {
        try {
            Database::beginTransaction();
            $barangJasa = $this->barangJasaRepository->findByKode($kode);
            if ($barangJasa == null) {
                throw new ValidationException("Barang Jasa dengan kode " . $kode . " tidak ditemukan");
            }

            $this->barangJasaRepository->delete($kode);

            Database::commitTransaction();
            return true;
        } catch (\Exception $exception) {
            Database::rollbackTransaction();
            throw $exception;
        }
    }

    function getAll(): array
    {
        return $this->barangJasaRepository->getAll();
    }

    function trulyGetAll(): array
    {
        return $this->barangJasaRepository->trulyGetAll();
    }
}