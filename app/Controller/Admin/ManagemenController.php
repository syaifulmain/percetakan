<?php

namespace Saep\Percetakan\Controller\Admin;

use Saep\Percetakan\App\View;
use Saep\Percetakan\Config\Database;
use Saep\Percetakan\Exception\ValidationException;
use Saep\Percetakan\Model\BarangJasa\BarangJasaRequest;
use Saep\Percetakan\Repository\Implementation\BarangJasaRepositoryImpl;
use Saep\Percetakan\Service\BarangJasaService;
use Saep\Percetakan\Service\Implementation\BarangJasaServiceImpl;

class ManagemenController
{
    private BarangJasaService $barangJasaService;

    public function __construct()
    {
        $connection = Database::getConnection();
        $barangJasaRepository = new BarangJasaRepositoryImpl($connection);
        $this->barangJasaService = new BarangJasaServiceImpl($barangJasaRepository);
    }


    function barang()
    {
        $halaman = isset($_GET['halaman']) ? (int)$_GET['halaman'] : 1;
        View::render("Admin/Managemen/barang", [
            'halaman' => $halaman,
            'totalPage' => $this->barangJasaService->totalPage('barang'),
            'listBarang' => $this->barangJasaService->findAll($halaman, 'barang')
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
                View::render("Admin/Managemen/barang", [
                    'success' => "Berhasil " . $action . " " . $jenis . " dengan kode " . $request->kode,
                    'halaman' => isset($_GET['halaman']) ? (int)$_GET['halaman'] : 1,
                    'totalPage' => $this->barangJasaService->totalPage('barang'),
                    'listBarang' => $this->barangJasaService->findAll(1, 'barang')
                ]);
            } else {
                View::redirect('/dashboard/managemen/jasa');
                View::render("Admin/Managemen/barang", [
                    'success' => "Berhasil " . $action . " " . $jenis . " dengan kode " . $request->kode,
                    'halaman' => isset($_GET['halaman']) ? (int)$_GET['halaman'] : 1,
                    'totalPage' => $this->barangJasaService->totalPage('jasa'),
                    'listBarang' => $this->barangJasaService->findAll(1, 'jasa')
                ]);
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
                View::render("Admin/Managemen/barang", [
                    'success' => "Berhasil menghapus " . $jenis . " dengan kode " . $kode,
                    'halaman' => isset($_GET['halaman']) ? (int)$_GET['halaman'] : 1,
                    'totalPage' => $this->barangJasaService->totalPage('barang'),
                    'listBarang' => $this->barangJasaService->findAll(1, 'barang')
                ]);
            } else {
                View::redirect('/dashboard/managemen/jasa');
                View::render("Admin/Managemen/barang", [
                    'success' => "Berhasil menghapus " . $jenis . " dengan kode " . $kode,
                    'halaman' => isset($_GET['halaman']) ? (int)$_GET['halaman'] : 1,
                    'totalPage' => $this->barangJasaService->totalPage('jasa'),
                    'listBarang' => $this->barangJasaService->findAll(1, 'jasa')
                ]);
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
            'listBarang' => $this->barangJasaService->findAll($halaman, 'jasa')
        ]);
    }


    function karyawan()
    {
        View::render("Admin/Managemen/karyawan", []);
    }
}