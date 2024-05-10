<div class="container-fluid">
    <div class="m-auto bg-white d-flex flex-column" style="height: 990px; width: 1440px">
        <div class="container-fluid container-fluid d-flex flex-column flex-fill">
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
                            <a href="./kasir" class="btn btn-outline-success fw-medium btn-lg active"
                               tabindex="-1" role="button" aria-disabled="true" style="width: 260px;">Kasir</a>
                            <a href="./Riwayat" class="btn btn-outline-success fw-medium btn-lg"
                               tabindex="-1" role="button" aria-disabled="true" style="width: 260px;">Riwayat</a>
                        </div>
                    </div>
                    <div class="col justify-content-end d-md-flex">
                        <a href="/logout" class="btn btn-danger fw-medium btn-lg"
                           tabindex="-1" role="button" aria-disabled="true" style="width: 100px;">Logout</a>
                    </div>
                </div>
            </div>
            <div class="pe-5 ps-5 pb-5 pt-4 d-flex flex-column flex-fill justify-content-start gap-4">
                <div class="col-auto">
                    <div class="row gap-2">
                        <div class="col gap-3 d-flex flex-column">
                            <div class="form-floating">
                                <input name="namapelanggan" type="text" class="form-control" id="namapelanggan"
                                       placeholder="Masukan Nama" value="Guest">
                                <label for="namapelanggan">Nama Pelanggan</label>
                            </div>
                            <div class="form-floating">
                                <input name="notelp" type="text" class="form-control" id="notelp"
                                       placeholder="Masukan Nama" value="+62">
                                <label for="notelp">No Telepon</label>
                            </div>
                        </div>
                        <div class="col gap-3 d-flex flex-column">
                            <div class="form-floating">
                                <input name="notransaksi" type="text" class="form-control" id="notransaksi"
                                       placeholder="Masukan Nama" disabled>
                                <label for="notransaksi">No Transaksi</label>
                            </div>
                            <div class="form-floating">
                                <input name="tanggal" type="text" class="form-control" id="tanggal"
                                       placeholder="Masukan Nama" disabled>
                                <label for="tanggal">Tanggal</label>
                            </div>
                        </div>
                        <div class="col-5 bg-success d-flex me-2 ms-2">
                            <div class="row d-flex justify-content-between flex-fill p-2 gap-5">
                                <div class="col justify-content-between d-flex flex-column text-white">
                                    <h2>Total Belanja</h2>
                                    <h3>Rp.<span id="totalpembelian">0</span></h3>
                                </div>
                                <div class="d-grid col p-3">
                                    <button type="button" class="btn btn-warning fw-medium btn-lg text-white fw-bold"
                                            data-bs-toggle="modal"
                                            data-bs-target="#checkout" id="checkoutbutton" disabled>Checkout
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-auto row pe-0">
                    <div class="col gap-3 d-flex flex-column pe-0">
                        <div class="col pe-0">
                            <div class="col">
                                <select id="select-state" placeholder="Cari Barang" class="my-form-control">
                                    <option value="">Select a state...</option>
                                    <option value="K0001 Bolpen 100000 5" id="Bolpen">K0001/Bolpen</option>
                                    <option value="K0002 Pensil 50000 5" id="Pensil">K0002/Pensil</option>
                                    <option value="K0003 Penghapus 20000 5" id="Penghapus">K0003/Penghapus</option>
                                    <option value="K0004 Penggaris 10000 5" id="Penggaris">K0004/Penggaris</option>
                                </select>
                            </div>
                        </div>
                        <div class="col pe-0">
                            <div class="row">
                                <div class="form-floating col">
                                    <input name="nama" type="text" class="form-control" id="nama"
                                           placeholder="Masukan Nama" disabled>
                                    <label for="nama" class="ms-2">Nama</label>
                                </div>
                                <div class="form-floating col-3">
                                    <input name="harga" type="text" class="form-control" id="harga"
                                           placeholder="Masukan Nama" disabled>
                                    <label for="harga" class="ms-2">Harga</label>
                                </div>
                                <div class="form-floating col-1">
                                    <input name="jumlah" type="number" class="form-control" id="jumlah"
                                           placeholder="Masukan Nama" required>
                                    <label for="jumlah" class="ms-2">Qty</label>
                                </div>
                                <div class="col-1 d-flex me-4">
                                    <button type="button" class="btn btn-success text-white fw-medium fs-5" id="submit">
                                        Submit
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-2 justify-content-end d-grid">
                        <div class="col">
                            <!--                            <button type="button" class="btn btn-danger text-white fw-medium">Reset</button>-->

                        </div>
                    </div>
                </div>
                <div class="col text-success d-flex flex-column flex-fill">
                    <h4 class="fw-semibold">List Pembelian</h4>
                    <div class="col border border-1">
                        <table class="table table-striped table-hovers table-bordered table-wrapper m-0">
                            <thead>
                            <tr>
                                <th scope="col" class="bg-success text-white fw-medium col-1">No</th>
                                <th scope="col" class="bg-success text-white fw-medium col-4">Nama</th>
                                <th scope="col" class="bg-success text-white fw-medium col-3">Harga</th>
                                <th scope="col" class="bg-success text-white fw-medium col-1">Qty</th>
                                <th scope="col" class="bg-success text-white fw-medium col-3">Total</th>
                                <th scope="col" class="bg-success text-white fw-medium col-1"></th>
                            </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="checkout" tabindex="-1" aria-labelledby="popUp"
     aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content p-4">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="popUp">Rincian Pembelian</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
            </div>
            <div class="modal-body col d-grid gap-4">
                <div class="col d-grid gap-3">
                    <label for="totalpembelianfinal">Total Pembelian</label>
                    <div class="input-group input-group-lg">
                        <span class="input-group-text">Rp. </span>
                        <input name="totalpembelianfinal" type="text" class="form-control" id="totalpembelianfinal"
                               disabled>
                    </div>
                </div>
                <form method="post" action="" id="forminput">
                    <div class="col d-grid gap-3">
                        <label for="totalbayarfinal">Pembayaran</label>
                        <div class="input-group input-group-lg">
                            <span class="input-group-text">Rp. </span>
                            <input name="totalbayarfinal" type="number" class="form-control" id="totalbayarfinal"
                                   placeholder="Masukan Jumlah bayar" required>
                        </div>
                    </div>
                </form>
                <div class="col d-grid gap-3">
                    <label for="totalkembalianfinal">Kembalian</label>
                    <div class="input-group input-group-lg">
                        <span class="input-group-text">Rp. </span>
                        <input name="totalkembalianfinal" type="text" class="form-control" id="totalkembalianfinal"
                               disabled>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-success w-100 btn-lg" id="selesaikan" form="forminput">Selesaikan</button>
            </div>
        </div>
    </div>
</div>
