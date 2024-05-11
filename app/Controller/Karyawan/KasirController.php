<?php

namespace Saep\Percetakan\Controller\Karyawan;

use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Saep\Percetakan\App\View;
use Saep\Percetakan\Config\Database;
use Saep\Percetakan\Model\Kasir\DetailBarang;
use Saep\Percetakan\Model\Kasir\DetailPelanggan;
use Saep\Percetakan\Model\Kasir\KasirRequest;
use Saep\Percetakan\Model\Kasir\Transaksi;
use Saep\Percetakan\Repository\Implementation\BarangJasaRepositoryImpl;
use Saep\Percetakan\Repository\Implementation\DetailPembelianRepositoryImpl;
use Saep\Percetakan\Repository\Implementation\KaryawanRepositoryImpl;
use Saep\Percetakan\Repository\Implementation\PelangganRepositoryImpl;
use Saep\Percetakan\Repository\Implementation\PembelianRepositoryImpl;
use Saep\Percetakan\Repository\Implementation\SessionRepositoryImpl;
use Saep\Percetakan\Repository\Implementation\UserRepositoryImpl;
use Saep\Percetakan\Service\BarangJasaService;
use Saep\Percetakan\Service\Implementation\BarangJasaServiceImpl;
use Saep\Percetakan\Service\Implementation\KasirServiceImpl;
use Saep\Percetakan\Service\Implementation\SessionServiceImpl;
use Saep\Percetakan\Service\Implementation\UserServiceImpl;
use Saep\Percetakan\Service\KasirService;
use Saep\Percetakan\Service\UserService;

class KasirController
{
    private BarangJasaService $barangJasaService;
    private UserService $userService;

    private KasirService $kasirService;

    public function __construct()
    {
        $connection = Database::getConnection();
        $barangJasaRepository = new BarangJasaRepositoryImpl($connection);
        $this->barangJasaService = new BarangJasaServiceImpl($barangJasaRepository);

        $userRepository = new UserRepositoryImpl($connection);
        $karyawanRepository = new KaryawanRepositoryImpl($connection);
        $sessionService = new SessionServiceImpl(new SessionRepositoryImpl($connection), $userRepository);
        $this->userService = new UserServiceImpl($userRepository, $sessionService, $karyawanRepository);

        $this->kasirService = new KasirServiceImpl(
            new PelangganRepositoryImpl($connection),
            new PembelianRepositoryImpl($connection),
            new DetailPembelianRepositoryImpl($connection),
            $karyawanRepository,
            $sessionService,
            $barangJasaRepository
        );
    }

    function kasir()
    {
        View::render("Karyawan/Kasir", [
            'list' => $this->barangJasaService->getAll(),
            'infoUser' => $this->userService->getUserInformation()
        ]);
    }

    //make rest api post only get request body json
    function postKasir()
    {
        $data = json_decode(file_get_contents('php://input'), true);

        $detailPelanggan = new DetailPelanggan();
        $detailPelanggan->namaPelanggan = $data['namapelanggan'];
        $detailPelanggan->noTelp = $data['notelp'];

        $transaksi = new Transaksi();
        $transaksi->noTransaksi = $data['notransaksi'];
        $transaksi->tanggal = $data['tanggal'];
        $transaksi->totalBayar = $data['totalbayar'];

        $detailBarang = [];
        foreach ($data['data'] as $item) {
            $barang = new DetailBarang();
            $barang->noTransaksi = $transaksi->noTransaksi;
            $barang->kode = $item['kode'];
            $barang->harga = $item['harga'];
            $barang->qty = $item['qty'];
            $detailBarang[] = $barang;
        }

        $kasirRequest = new KasirRequest();
        $kasirRequest->pelanggan = $detailPelanggan;
        $kasirRequest->transaksi = $transaksi;
        $kasirRequest->detailBarang = $detailBarang;

        try {
            $this->kasirService->create($kasirRequest);
        } catch (\Exception $exception) {
            echo $exception->getMessage();
        }

        View::redirect('/dashboard/kasir');
    }
}