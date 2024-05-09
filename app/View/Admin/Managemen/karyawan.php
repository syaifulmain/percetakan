<div class="container-fluid">
    <div class="m-auto bg-white d-flex" style="height: 990px; width: 1440px">
        <div class="container-fluid d-flex flex-column flex-fill">
            <div class="mb-4" style="height: 100px;">
                <div class="row align-content-between bg-secondary-subtle align-items-center pe-5 ps-5">
                    <div class="col">
                        <div class="d-grid gap-2 d-md-flex">
                            <div style="width: 50px; height: 50px; background-color: #0a53be"></div>
                            <div class="col">
                                <p class="m-0 fw-bolder">Nama Karyawan</p>
                                <p class="m-0">Admin</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 justify-content-around d-md-flex h-100 p-4">
                        <div class="d-grid gap-4 d-md-flex ">
                            <a href="../managemen/barang" class="btn btn-outline-success fw-medium btn-lg active"
                               tabindex="-1" role="button" aria-disabled="true" style="width: 160px;">Managemen</a>
                            <a href="../riwayat/pembelian" class="btn btn-outline-success fw-medium btn-lg"
                               tabindex="-1" role="button" aria-disabled="true" style="width: 160px;">Riwayat</a>
                            <a href="../restok/" class="btn btn-outline-success fw-medium btn-lg"
                               tabindex="-1" role="button" aria-disabled="true" style="width: 160px;">Restok</a>
                        </div>
                    </div>
                    <div class="col">
                    </div>
                </div>
            </div>
            <div class="pe-5 ps-5 pb-5 d-flex flex-column flex-fill">
                <div class="mb-4">
                    <div class="row">
                        <div class="btn-group btn-group-lg d-grid d-md-flex mb-2">
                            <a href="barang" class="btn btn-outline-success fw-medium btn-lg"
                               tabindex="-1" role="button" aria-disabled="true">Barang</a>
                            <a href="jasa" class="btn btn-outline-success fw-medium btn-lg"
                               tabindex="-1" role="button" aria-disabled="true">Jasa</a>
                            <a href="karyawan" class="btn btn-outline-success fw-medium btn-lg active"
                               tabindex="-1" role="button" aria-disabled="true">Karyawan</a>
                        </div>
                    </div>
                    <div class="d-grid">
                        <button type="button" class="btn btn-success fw-medium btn-lg" data-bs-toggle="modal"
                                data-bs-target="#tambah" data-bs-whatever="@mdo">Tambah
                        </button>

                        <div class="modal fade" id="tambah" tabindex="-1" aria-labelledby="exampleModalLabel"
                             aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content p-4">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form>
                                            <div class="form-floating mb-4">
                                                <input type="text" class="form-control" id="username"
                                                       placeholder="Masukan username">
                                                <label for="username">Username</label>
                                            </div>
                                            <div class="form-floating mb-4">
                                                <input type="text" class="form-control" id="nama"
                                                       placeholder="Masukan Nama">
                                                <label for="nama">Nama</label>
                                            </div>
                                            <div class="form-floating mb-4">
                                                <input type="text" class="form-control" id="telp"
                                                       placeholder="Masukan No Telepon">
                                                <label for="telp">No Telepon</label>
                                            </div>
                                            <div class="form-floating mb-4">
                                                <input type="text" class="form-control" id="alamat"
                                                       placeholder="Masukan Alamat">
                                                <label for="alamat">Alamat</label>
                                            </div>
                                            <div class="form-floating">
                                                <select class="form-select" id="shift" aria-label="shift">
                                                    <option selected>Pilih Shift</option>
                                                    <option value="1">Pagi</option>
                                                    <option value="2">Malam</option>
                                                </select>
                                                <label for="shift">Shift</label>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-success w-100 btn-lg">Simpan</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col flex-fill">
                    <table class="table table-striped table-hovers table-bordered">
                        <thead>
                        <tr>
                            <th scope="col" class="bg-success text-white fw-medium col-1">No</th>
                            <th scope="col" class="bg-success text-white fw-medium col-3">Username</th>
                            <th scope="col" class="bg-success text-white fw-medium col-4">Nama</th>
                            <th scope="col" class="bg-success text-white fw-medium col-2">No Telepon</th>
                            <th scope="col" class="bg-success text-white fw-medium col-2">Shift</th>
                            <th scope="col" class="bg-success text-white fw-medium col-1"></th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <th scope="row">1</th>
                            <td>Mark</td>
                            <td>Otto</td>
                            <td>08123456789</td>
                            <td>Pagi</td>
                            <td>
                                <button type="button" class="btn btn-primary fw-medium btn-sm" data-bs-toggle="modal"
                                        data-bs-target="#edit" data-bs-whatever="@mdo">Edit
                                </button>

                                <div class="modal fade" id="edit" tabindex="-1" aria-labelledby="editLabel"
                                     aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content p-4">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="editLabel">Edit</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form>
                                                    <div class="form-floating mb-4">
                                                        <input type="text" class="form-control" id="username-u"
                                                               placeholder="Masukan username">
                                                        <label for="username-u">Username</label>
                                                    </div>
                                                    <div class="form-floating mb-4">
                                                        <input type="text" class="form-control" id="nama-u"
                                                               placeholder="Masukan Nama">
                                                        <label for="nama-u">Nama</label>
                                                    </div>
                                                    <div class="form-floating mb-4">
                                                        <input type="text" class="form-control" id="telp-u"
                                                               placeholder="Masukan No Telepon">
                                                        <label for="telp-u">No Telepon</label>
                                                    </div>
                                                    <div class="form-floating mb-4">
                                                        <input type="text" class="form-control" id="alamat-u"
                                                               placeholder="Masukan Alamat">
                                                        <label for="alamat-u">Alamat</label>
                                                    </div>
                                                    <div class="form-floating">
                                                        <select class="form-select" id="shift-u" aria-label="shift">
                                                            <option selected>Pilih Shift</option>
                                                            <option value="1">Pagi</option>
                                                            <option value="2">Malam</option>
                                                        </select>
                                                        <label for="shift-u">Shift</label>
                                                    </div>
                                                </form>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-success w-100 btn-lg">Konfirmasi
                                                </button>
                                                <button type="button" class="btn btn-danger w-100 btn-lg">Hapus</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
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