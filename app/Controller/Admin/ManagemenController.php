<?php

namespace Saep\Percetakan\Controller\Admin;

use Saep\Percetakan\App\View;
use Saep\Percetakan\Config\Database;
use Saep\Percetakan\Exception\ValidationException;
use Saep\Percetakan\Model\BarangJasa\BarangJasaRequest;
use Saep\Percetakan\Model\Karyawan\KaryawanRequest;
use Saep\Percetakan\Repository\Implementation\BarangJasaRepositoryImpl;
use Saep\Percetakan\Repository\Implementation\KaryawanRepositoryImpl;
use Saep\Percetakan\Repository\Implementation\SessionRepositoryImpl;
use Saep\Percetakan\Repository\Implementation\UserRepositoryImpl;
use Saep\Percetakan\Service\BarangJasaService;
use Saep\Percetakan\Service\Implementation\BarangJasaServiceImpl;
use Saep\Percetakan\Service\Implementation\KaryawanServiceImpl;
use Saep\Percetakan\Service\Implementation\SessionServiceImpl;
use Saep\Percetakan\Service\Implementation\UserServiceImpl;
use Saep\Percetakan\Service\KaryawanService;
use Saep\Percetakan\Service\UserService;

class ManagemenController
{
    private BarangJasaService $barangJasaService;

    private UserService $userService;

    private KaryawanService $karyawanService;

    public function __construct()
    {
        $connection = Database::getConnection();
        $barangJasaRepository = new BarangJasaRepositoryImpl($connection);
        $this->barangJasaService = new BarangJasaServiceImpl($barangJasaRepository);

        $userRepository = new UserRepositoryImpl($connection);
        $karyawanRepository = new KaryawanRepositoryImpl($connection);
        $sessionService = new SessionServiceImpl(new SessionRepositoryImpl($connection), $userRepository);
        $this->userService = new UserServiceImpl($userRepository, $sessionService, $karyawanRepository);

        $karyawanRepository = new KaryawanRepositoryImpl($connection);
        $this->karyawanService = new KaryawanServiceImpl($karyawanRepository, $userRepository);
    }


    function barang()
    {
        $halaman = isset($_GET['halaman']) ? (int)$_GET['halaman'] : 1;
        View::render("Admin/Managemen/barang", [
            'halaman' => $halaman,
            'totalPage' => $this->barangJasaService->totalPage('barang'),
            'listBarang' => $this->barangJasaService->findAll($halaman, 'barang'),
            'infoUser' => $this->userService->getUserInformation()
        ]);
    }

    function PUBarang()
    {
        try {
            $action = $_POST['action'];
            $jenis = $_POST['jenis'];

            $request = new BarangJasaRequest();
            $request->kode = $_POST['kode'];
            $request->nama = $_POST['nama'];
            $request->jenis = $jenis;
            $request->stok = $_POST['stok'] == '' ? 0 : $_POST['stok'];
            $request->harga = $_POST['harga'] == '' ? 0 : $_POST['harga'];

            if ($action == 'Tambah') {
                $reponse = $this->barangJasaService->create($request);
            } else if ($action == 'Edit') {
                $reponse = $this->barangJasaService->update($request);
            }

            if ($jenis == 'Barang') {
                View::redirect('/dashboard/managemen/barang');
            } else {
                View::redirect('/dashboard/managemen/jasa');
            }
        } catch (ValidationException $exception) {
            View::render("Admin/Managemen/barang", [
                'error' => $exception->getMessage()
            ]);
        }
    }

    function deleteBarangJasa()
    {
        try {
            $kode = $_GET['kode'];
            $jenis = $_GET['jenis'];
            $reponse = $this->barangJasaService->delete($kode);
            if ($jenis == 'Barang') {
                View::redirect('/dashboard/managemen/barang');
            } else {
                View::redirect('/dashboard/managemen/jasa');
            }
        } catch (ValidationException $exception) {
            View::render("Admin/Managemen/barang", [
                'error' => $exception->getMessage()
            ]);
        }
    }

    function jasa()
    {
        $halaman = isset($_GET['halaman']) ? (int)$_GET['halaman'] : 1;
        View::render("Admin/Managemen/jasa", [
            'halaman' => $halaman,
            'totalPage' => $this->barangJasaService->totalPage('jasa'),
            'listBarang' => $this->barangJasaService->findAll($halaman, 'jasa'),
            'infoUser' => $this->userService->getUserInformation()
        ]);
    }


    function karyawan()
    {
        $halaman = isset($_GET['halaman']) ? (int)$_GET['halaman'] : 1;
        View::render("Admin/Managemen/karyawan", [
            'halaman' => $halaman,
            'totalPage' => $this->karyawanService->totalPage(),
            'listKaryawan' => $this->karyawanService->findAll($halaman),
            'infoUser' => $this->userService->getUserInformation()
        ]);
    }

    function PUKaryawan()
    {
        try {
            $action = $_POST['action'];

            $request = new KaryawanRequest();
            $request->username = $_POST['username'];
            $request->nama = $_POST['nama'];
            $request->alamat = $_POST['alamat'];
            $request->noTelp = $_POST['noTelp'];

            if ($action == 'Tambah') {
                $this->karyawanService->create($request);
            } else if ($action == 'Edit') {
                $this->karyawanService->update($request);
            }

            View::redirect('/dashboard/managemen/karyawan');
        } catch (ValidationException $exception) {
            View::render("Admin/Managemen/karyawan", [
                'error' => $exception->getMessage()
            ]);
        }
    }

    function deleteKaryawan()
    {
        try {
            $kode = $_GET['kode'];
            $this->karyawanService->delete($kode);
            View::redirect('/dashboard/managemen/karyawan');
        } catch (ValidationException $exception) {
            View::render("Admin/Managemen/karyawan", [
                'error' => $exception->getMessage()
            ]);
        }
    }
}