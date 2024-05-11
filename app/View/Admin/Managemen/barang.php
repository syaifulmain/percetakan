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
                            <a href="../managemen/barang" class="btn btn-outline-success fw-medium btn-lg active"
                               tabindex="-1" role="button" aria-disabled="true" style="width: 160px;">Managemen</a>
                            <a href="../riwayat/pembelian" class="btn btn-outline-success fw-medium btn-lg"
                               tabindex="-1" role="button" aria-disabled="true" style="width: 160px;">Riwayat</a>
                            <a href="../restok/restok" class="btn btn-outline-success fw-medium btn-lg"
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
                            <a href="barang" class="btn btn-outline-success fw-medium btn-lg active"
                               tabindex="-1" role="button" aria-disabled="true">Barang</a>
                            <a href="jasa" class="btn btn-outline-success fw-medium btn-lg"
                               tabindex="-1" role="button" aria-disabled="true">Jasa</a>
                            <a href="karyawan" class="btn btn-outline-success fw-medium btn-lg"
                               tabindex="-1" role="button" aria-disabled="true">Karyawan</a>
                        </div>
                    </div>
                    <div class="d-grid">
                        <button type="button" class="btn btn-success fw-medium btn-lg" data-bs-toggle="modal"
                                data-bs-target="#CRUD" onclick="displayCRUDButton('Barang', 'Tambah')">Tambah
                        </button>
                    </div>
                </div>
                <div class="col flex-fill">
                    <table class="table table-striped table-hovers table-bordered">
                        <thead>
                        <tr>
                            <th scope="col" class="bg-success text-white fw-medium col-1">No</th>
                            <th scope="col" class="bg-success text-white fw-medium col-4">Kode</th>
                            <th scope="col" class="bg-success text-white fw-medium col-4">Nama</th>
                            <th scope="col" class="bg-success text-white fw-medium col-2">Harga</th>
                            <th scope="col" class="bg-success text-white fw-medium col-1">Stok</th>
                            <th scope="col" class="bg-success text-white fw-medium col-1"></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $no = 1 + ($model['halaman'] - 1) * 10;
                        foreach ($model['listBarang'] as $barang) { ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= $barang->kode ?></td>
                                <td><?= $barang->nama ?></td>
                                <td><?= $barang->harga ?></td>
                                <td><?= $barang->stok ?></td>
                                <td>
                                    <button type="button" class="btn btn-primary fw-medium btn-sm"
                                            data-bs-toggle="modal" data-bs-target="#CRUD"
                                            onclick="displayCRUDButton('Barang', 'Edit', '<?php echo $barang->kode ?>', '<?php echo $barang->nama ?>', '<?php echo $barang->harga ?>', '<?php echo $barang->stok ?>')">
                                        Edit
                                    </button>
                                </td>
                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                </div>
                <?php if ($model['totalPage'] > 1 !== null) { ?>
                    <?php
                    $totalHalaman = $model['totalPage'];
                    $halaman = $model['halaman'];
                    $previous = $halaman - 1;
                    $next = $halaman + 1;
                    ?>
                    <nav>
                        <ul class=" pagination justify-content-center m-0">
                            <li class="page-item">
                                <a class="page-link
                                <?php echo ($halaman > 1) ? "" : " disabled"; ?>"
                                    <?php echo "href='?halaman=$previous'"; ?>>Previous</a>
                            </li>
                            <?php
                            if ($totalHalaman > 1)
                                for ($x = 1; $x <= $totalHalaman; $x++) { ?>
                                    <li class="page-item">
                                        <a class="page-link"
                                           href="?halaman=<?php echo $x ?>"><?php echo $x; ?></a></li>
                                <?php } ?>
                            <li class="page-item">
                                <a class="page-link
                                <?php echo ($halaman < $totalHalaman) ? "" : " disabled"; ?>"
                                    <?php echo "href='?halaman=$next'"; ?>>Next</a>
                            </li>
                        </ul>
                    </nav>
                <?php } ?>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="CRUD" tabindex="-1" aria-labelledby="popUp"
     aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content p-4">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="popUp">
                    <span id="actionLabel">action</span>
                    <span id="jenisLabel">jenis</span>
                </h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close" onclick="resetForm()"></button>
            </div>
            <form method="post" action="/dashboard/managemen/barang" id="forminput">
                <div class="modal-body">
                    <div class="form-floating mb-4">
                        <input name="kode" type="text" class="form-control" id="kode"
                               placeholder="Masukan Kode" required>
                        <label for="kode">Kode</label>
                    </div>
                    <div class="form-floating mb-4">
                        <input name="nama" type="text" class="form-control" id="nama"
                               placeholder="Masukan Nama" required>
                        <label for="nama">Nama</label>
                    </div>
                    <div class="form-floating mb-4">
                        <input name="stok" type="number" class="form-control" id="stok"
                               placeholder="Masukan Stok">
                        <label for="stok">Stok</label>
                    </div>
                    <div class="form-floating mb-4">
                        <input name="harga" type="number" class="form-control" id="harga"
                               placeholder="Masukan Harga">
                        <label for="harga">Harga</label>
                    </div>
                    <div class="form-floating mb-4 hidden">
                        <input name="jenis" type="text" class="form-control" id="jenis"
                               placeholder="Masukan Stok">
                        <label for="jenis">jenis</label>
                    </div>
                    <div class="form-floating mb-4 hidden">
                        <input name="action" type="text" class="form-control" id="action"
                               placeholder="Masukan Stok">
                        <label for="action">Action</label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success w-100 btn-lg" id="saveButton">Simpan</button>
                    <button type="submit" class="btn btn-success w-100 btn-lg" id="confirmButton">Konfirmasi</button>
                    <a type="button" class="btn btn-danger w-100 btn-lg" id="deleteButton">Hapus</a>
                </div>
            </form>
        </div>
    </div>
</div>
