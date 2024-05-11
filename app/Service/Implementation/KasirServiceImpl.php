<?php

namespace Saep\Percetakan\Service\Implementation;

use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Saep\Percetakan\Config\Database;
use Saep\Percetakan\Domain\DetailPembelian;
use Saep\Percetakan\Domain\Pelanggan;
use Saep\Percetakan\Domain\Pembelian;
use Saep\Percetakan\Domain\User;
use Saep\Percetakan\Model\Kasir\KasirRequest;
use Saep\Percetakan\Repository\BarangJasaRepository;
use Saep\Percetakan\Repository\DetailPembelianRepository;
use Saep\Percetakan\Repository\KaryawanRepository;
use Saep\Percetakan\Repository\PelangganRepository;
use Saep\Percetakan\Repository\PembelianRepository;
use Saep\Percetakan\Service\KasirService;
use Saep\Percetakan\Service\SessionService;

class KasirServiceImpl implements KasirService
{

    private PelangganRepository $pelangganRepository;

    private PembelianRepository $pembelianRepository;

    private DetailPembelianRepository $detailPembelian;

    private KaryawanRepository $karyawanRepository;

    private SessionService $sessionService;

    private BarangJasaRepository $barangJasaRepository;
    public function __construct(PelangganRepository $pelangganRepository, PembelianRepository $pembelianRepository, DetailPembelianRepository $detailPembelian, KaryawanRepository $karyawanRepository, SessionService $sessionService, BarangJasaRepository $barangJasaRepository)
    {
        $this->pelangganRepository = $pelangganRepository;
        $this->pembelianRepository = $pembelianRepository;
        $this->detailPembelian = $detailPembelian;
        $this->karyawanRepository = $karyawanRepository;
        $this->sessionService = $sessionService;
        $this->barangJasaRepository = $barangJasaRepository;
    }


    function create(KasirRequest $kasirRequest): void
    {
        $log = new Logger('servicekasir');
        $log->pushHandler(new StreamHandler('servicekasir.log', Logger::DEBUG));
        try {
            Database::beginTransaction();
            $pelanggan = new Pelanggan();
            $pelanggan->nama = $kasirRequest->pelanggan->namaPelanggan;
            $pelanggan->noTelp = $kasirRequest->pelanggan->noTelp;
            $this->pelangganRepository->save($pelanggan);

            $pembelian = new Pembelian();
            $pembelian->noTransaksi = $kasirRequest->transaksi->noTransaksi;
            $pembelian->idPelanggan = $this->pelangganRepository->getLastIdByNama($kasirRequest->pelanggan->namaPelanggan);
            $user = new User();
            $user = $this->sessionService->current();
            $pembelian->idKaryawan = $user->username;
            $pembelian->tanggal = $kasirRequest->transaksi->tanggal;
            $pembelian->bayar = $kasirRequest->transaksi->totalBayar;
            $this->pembelianRepository->save($pembelian);

            foreach ($kasirRequest->detailBarang as $barang) {
                $detailPembelian = new DetailPembelian();
                $detailPembelian->noTransaksi = $barang->noTransaksi;
                $detailPembelian->kodeBarang = $barang->kode;
                $detailPembelian->jumlah = $barang->qty;
                $detailPembelian->harga = $barang->harga;
                $this->detailPembelian->save($detailPembelian);
                $this->barangJasaRepository->updateStok($barang->kode, $barang->qty);
            }
            Database::commitTransaction();
            $log->log(Logger::INFO, "Transaksi berhasil");
        } catch (\Exception $exception) {
            Database::rollbackTransaction();
            $log->error($exception->getMessage());
            throw $exception;
        }
    }
}