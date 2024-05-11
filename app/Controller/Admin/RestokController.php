<?php

namespace Saep\Percetakan\Controller\Admin;

use Saep\Percetakan\App\View;
use Saep\Percetakan\Config\Database;
use Saep\Percetakan\Domain\Supplier;
use Saep\Percetakan\Model\Supplier\SupplierRequest;
use Saep\Percetakan\Repository\Implementation\BarangJasaRepositoryImpl;
use Saep\Percetakan\Repository\Implementation\DetailPembelianRepositoryImpl;
use Saep\Percetakan\Repository\Implementation\KaryawanRepositoryImpl;
use Saep\Percetakan\Repository\Implementation\PelangganRepositoryImpl;
use Saep\Percetakan\Repository\Implementation\PembelianRepositoryImpl;
use Saep\Percetakan\Repository\Implementation\SessionRepositoryImpl;
use Saep\Percetakan\Repository\Implementation\SupplierRepositoryImpl;
use Saep\Percetakan\Repository\Implementation\UserRepositoryImpl;
use Saep\Percetakan\Service\BarangJasaService;
use Saep\Percetakan\Service\Implementation\BarangJasaServiceImpl;
use Saep\Percetakan\Service\Implementation\KasirServiceImpl;
use Saep\Percetakan\Service\Implementation\RestokServiceimpl;
use Saep\Percetakan\Service\Implementation\SessionServiceImpl;
use Saep\Percetakan\Service\Implementation\UserServiceImpl;
use Saep\Percetakan\Service\KasirService;
use Saep\Percetakan\Service\RestokService;
use Saep\Percetakan\Service\UserService;

class RestokController
{
    private BarangJasaService $barangJasaService;
    private UserService $userService;

    private RestokService $restokService;


    public function __construct()
    {
        $connection = Database::getConnection();
        $barangJasaRepository = new BarangJasaRepositoryImpl($connection);
        $this->barangJasaService = new BarangJasaServiceImpl($barangJasaRepository);

        $userRepository = new UserRepositoryImpl($connection);
        $karyawanRepository = new KaryawanRepositoryImpl($connection);
        $sessionService = new SessionServiceImpl(new SessionRepositoryImpl($connection), $userRepository);
        $this->userService = new UserServiceImpl($userRepository, $sessionService, $karyawanRepository);

        $this->restokService = new RestokServiceImpl(
            new SupplierRepositoryImpl($connection),
            $barangJasaRepository
        );

    }
    function restok()
    {
        View::render("Admin/Restok/Restok", [
            'list' => $this->barangJasaService->trulyGetAll(),
            'infoUser' => $this->userService->getUserInformation()
        ]);
    }

    function restokPost()
    {
        $data = json_decode(file_get_contents('php://input'), true);

        $mydata = [];
        foreach ($data as $supplier) {
            $sup = new Supplier();
            $sup->supplier = $supplier['supplier'];
            $sup->barang = $supplier['nama'];
            $sup->harga = $supplier['harga'];
            $sup->stok = $supplier['qty'];
            $sup->tanggal = $supplier['tanggal'];
            $mydata[] = $sup;
        }

        $supReq = new SupplierRequest();
        $supReq->supplier = $mydata;
        $this->restokService->create($supReq);
    }
}