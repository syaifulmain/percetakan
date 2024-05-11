<?php

namespace Saep\Percetakan\Controller\Admin;

use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Saep\Percetakan\App\View;
use Saep\Percetakan\Config\Database;
use Saep\Percetakan\Repository\Implementation\BarangJasaRepositoryImpl;
use Saep\Percetakan\Repository\Implementation\DetailPembelianRepositoryImpl;
use Saep\Percetakan\Repository\Implementation\KaryawanRepositoryImpl;
use Saep\Percetakan\Repository\Implementation\PelangganRepositoryImpl;
use Saep\Percetakan\Repository\Implementation\PembelianRepositoryImpl;
use Saep\Percetakan\Repository\Implementation\SessionRepositoryImpl;
use Saep\Percetakan\Repository\Implementation\SupplierRepositoryImpl;
use Saep\Percetakan\Repository\Implementation\UserRepositoryImpl;
use Saep\Percetakan\Service\Implementation\RiwayatServiceImpl;
use Saep\Percetakan\Service\Implementation\SessionServiceImpl;
use Saep\Percetakan\Service\Implementation\SupplierServiceImpl;
use Saep\Percetakan\Service\Implementation\UserServiceImpl;
use Saep\Percetakan\Service\KaryawanService;
use Saep\Percetakan\Service\RiwayatService;
use Saep\Percetakan\Service\SupplierService;
use Saep\Percetakan\Service\UserService;

class RiwayatController
{
    private RiwayatService $riwayatService;
    private UserService $userService;

    private SupplierService $supplierService;
    public function __construct()
    {
        $connection = Database::getConnection();
        $karyawanRepository = new KaryawanRepositoryImpl($connection);
        $detailPembelianRepository = new DetailPembelianRepositoryImpl($connection);
        $pembelianRepository = new PembelianRepositoryImpl($connection);
        $pelangganRepository = new PelangganRepositoryImpl($connection);
        $barangJasaRepository = new BarangJasaRepositoryImpl($connection);

        $userRepository = new UserRepositoryImpl($connection);
        $sessionService = new SessionServiceImpl(new SessionRepositoryImpl($connection), $userRepository);

        $this->userService = new UserServiceImpl($userRepository, $sessionService, $karyawanRepository);
        $this->riwayatService = new RiwayatServiceImpl(
            $karyawanRepository,
            $detailPembelianRepository,
            $pembelianRepository,
            $pelangganRepository,
            $barangJasaRepository
        );

        $supplierRepository = new SupplierRepositoryImpl($connection);
        $this->supplierService = new SupplierServiceImpl($supplierRepository);
    }


    function pembelian()
    {
        View::render("Admin/Riwayat/pembelian", [
            'list' => $this->riwayatService->getAll(),
            'infoUser' => $this->userService->getUserInformation()
        ]);
    }

    function mensuplai()
    {
        View::render("Admin/Riwayat/mensuplai", [
            'list' => $this->supplierService->findAll(),
            'infoUser' => $this->userService->getUserInformation()
        ]);
    }

    function deleteSupplier()
    {
        $id = $_GET['id'];
        $this->supplierService->delete($id);
    }

    function getDetailBarangJasa()
    {
        $noTransaksi = $_GET['notransaksi'];
        $data = $this->riwayatService->getDetail($noTransaksi);

        $log = new Logger('name');
        $log->pushHandler(new StreamHandler('app.log', Logger::DEBUG));
        $log->info('Get Detail Barang Jasa', $data->barangJasa);


        echo json_encode($data);
    }

    function deletePembelian()
    {
        $noTransaksi = $_GET['notransaksi'];
        $this->riwayatService->delete($noTransaksi);
    }
}