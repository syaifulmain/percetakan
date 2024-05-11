<?php

namespace Saep\Percetakan\Service\Implementation;

use Saep\Percetakan\Domain\BarangJasa;
use Saep\Percetakan\Model\Riwayat\DetaiBarangJasa;
use Saep\Percetakan\Model\Riwayat\DetailPembelianAdminResponse;
use Saep\Percetakan\Model\Riwayat\RiwayatAdminResponse;
use Saep\Percetakan\Repository\BarangJasaRepository;
use Saep\Percetakan\Repository\DetailPembelianRepository;
use Saep\Percetakan\Repository\KaryawanRepository;
use Saep\Percetakan\Repository\PelangganRepository;
use Saep\Percetakan\Repository\PembelianRepository;
use Saep\Percetakan\Service\RiwayatService;

class RiwayatServiceImpl implements RiwayatService
{
    private KaryawanRepository $karyawanRepository;
    private DetailPembelianRepository $detailPembelianRepository;
    private PembelianRepository $pembelianRepository;
    private PelangganRepository $pelangganRepository;
    private BarangJasaRepository $barangJasaRepository;

    public function __construct(KaryawanRepository $karyawanRepository, DetailPembelianRepository $detailPembelianRepository, PembelianRepository $pembelianRepository, PelangganRepository $pelangganRepository, BarangJasaRepository $barangJasaRepository)
    {
        $this->karyawanRepository = $karyawanRepository;
        $this->detailPembelianRepository = $detailPembelianRepository;
        $this->pembelianRepository = $pembelianRepository;
        $this->pelangganRepository = $pelangganRepository;
        $this->barangJasaRepository = $barangJasaRepository;
    }


    function getAll(): array
    {
        $totalPembelian = $this->pembelianRepository->getAll();
        $riwayatAdmins = [];
        foreach ($totalPembelian as $pembelian) {
            $riwayatAdmin = new RiwayatAdminResponse();
            $riwayatAdmin->noTransaksi = $pembelian->noTransaksi;
            $riwayatAdmin->namaKaryawan = $this->karyawanRepository->getNamaByUsername($pembelian->idKaryawan);
            $riwayatAdmin->tanggalTransaksi = $pembelian->tanggal;
            $riwayatAdmin->jumlahBarang = $this->detailPembelianRepository->getCountByNoTransaksi($pembelian->noTransaksi);
            $riwayatAdmin->totalHarga = $this->detailPembelianRepository->getTotalHargaByNoTransaksi($pembelian->noTransaksi);
            $riwayatAdmins[] = $riwayatAdmin;
        }
        return $riwayatAdmins;
    }

    function getDetail(string $noTransaksi): DetailPembelianAdminResponse
    {
        $detailPembelian = $this->detailPembelianRepository->getByNoTransaksi($noTransaksi);
        $detailPembelianAdmin = new DetailPembelianAdminResponse();
        $detailPembelianAdmin->namaPelanggan = $this->pelangganRepository->getNamaByNoTransaksi($noTransaksi);
        $detailPembelianAdmin->namaKarayawan = $this->karyawanRepository->getNamaByNoTransaksi($noTransaksi);
        $detailPembelianAdmin->barangJasa = [];
        foreach ($detailPembelian as $detail) {
            $barangJasa = $this->barangJasaRepository->findByKode($detail->kodeBarang);
            $detailBarangJasa = new DetaiBarangJasa();
            $detailBarangJasa->kode = $barangJasa->kode;
            $detailBarangJasa->nama = $barangJasa->nama;
            $detailBarangJasa->jumlah = $detail->jumlah;
            $detailBarangJasa->harga = $detail->harga;
            $detailBarangJasa->subtotal = $detail->jumlah * $detail->harga;
            $detailPembelianAdmin->barangJasa[] = $detailBarangJasa;
        }
        return $detailPembelianAdmin;
    }

    function delete(string $noTransaksi): void
    {
        $this->detailPembelianRepository->delete($noTransaksi);
        $this->pembelianRepository->delete($noTransaksi);
    }
}