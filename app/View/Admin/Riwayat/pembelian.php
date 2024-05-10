<div class="container-fluid">
    <div class="m-auto bg-white d-flex" style="height: 990px; width: 1440px">
        <div class="container-fluid d-flex flex-column flex-fill">
            <div class="mb-4" style="height: 100px;">
                <div class="row align-content-between bg-secondary-subtle align-items-center pe-5 ps-5">
                    <div class="col">
                        <div class="d-grid gap-2 d-md-flex">
                            <div style="width: 50px; height: 50px; background-color: #0a53be"></div>
                            <div class="col">
                                <p class="m-0 fw-bolder"><?php echo $model['infoUser']->nama ?? '' ?></p>
                                <p class="m-0"><?php echo $model['infoUser']->role ?? '' ?></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 justify-content-around d-md-flex h-100 p-4">
                        <div class="d-grid gap-4 d-md-flex ">
                            <a href="../managemen/barang" class="btn btn-outline-success fw-medium btn-lg"
                               tabindex="-1" role="button" aria-disabled="true" style="width: 160px;">Managemen</a>
                            <a href="../riwayat/pembelian" class="btn btn-outline-success fw-medium btn-lg active"
                               tabindex="-1" role="button" aria-disabled="true" style="width: 160px;">Riwayat</a>
                            <a href="../restok/" class="btn btn-outline-success fw-medium btn-lg"
                               tabindex="-1" role="button" aria-disabled="true" style="width: 160px;">Restok</a>
                        </div>
                    </div>
                    <div class="col justify-content-end d-md-flex">
                        <a href="/logout" class="btn btn-danger fw-medium btn-lg"
                           tabindex="-1" role="button" aria-disabled="true" style="width: 100px;">Logout</a>
                    </div>
                </div>
            </div>
            <div class="pe-5 ps-5 pb-5 d-flex flex-column flex-fill">
                <div class="mb-4">
                    <div class="row">
                        <div class="btn-group btn-group-lg d-grid d-md-flex mb-2">
                            <a href="pembelian" class="btn btn-outline-success fw-medium btn-lg active"
                               tabindex="-1" role="button" aria-disabled="true">Pembelian</a>
                            <a href="mensuplai" class="btn btn-outline-success fw-medium btn-lg"
                               tabindex="-1" role="button" aria-disabled="true">Mensuplai</a>
                        </div>
                    </div>
                </div>
                <div class="col flex-fill">
                    <table class="table table-striped table-hovers table-bordered">
                        <thead>
                        <tr>
                            <th scope="col" class="bg-success text-white fw-medium col-1">No</th>
                            <th scope="col" class="bg-success text-white fw-medium col-3">No Transaksi</th>
                            <th scope="col" class="bg-success text-white fw-medium col-3">Karyawan</th>
                            <th scope="col" class="bg-success text-white fw-medium col-2">tanggal</th>
                            <th scope="col" class="bg-success text-white fw-medium col-1">Produk</th>
                            <th scope="col" class="bg-success text-white fw-medium col-2">Total</th>
                            <th scope="col" class="bg-success text-white fw-medium col-1"></th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <th scope="row">1</th>
                            <td>123456</td>
                            <td>Admin</td>
                            <td>12-12-2021</td>
                            <td>2</td>
                            <td>20000</td>
                            <td>
                                <button type="button" class="btn btn-warning fw-medium btn-sm text-white">Cek</button>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <div class="justify-content-around w-100 d-md-flex">
                    <nav aria-label="Page navigation">
                        <ul class="pagination m-0">
                            <li class="page-item"><a class="page-link" href="#">Previous</a></li>
                            <li class="page-item"><a class="page-link" href="#">1</a></li>
                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item"><a class="page-link" href="#">Next</a></li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>