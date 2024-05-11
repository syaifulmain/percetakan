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
                            <a href="../managemen/barang" class="btn btn-outline-success fw-medium btn-lg "
                               tabindex="-1" role="button" aria-disabled="true" style="width: 160px;">Managemen</a>
                            <a href="../riwayat/pembelian" class="btn btn-outline-success fw-medium btn-lg active"
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
                            <a href="penjualan" class="btn btn-outline-success fw-medium btn-lg active"
                               tabindex="-1" role="button" aria-disabled="true">Penjualan</a>
                            <a href="mensuplai" class="btn btn-outline-success fw-medium btn-lg"
                               tabindex="-1" role="button" aria-disabled="true">Mensuplai</a>
                        </div>
                    </div>
                </div>
                <div class="col flex-fill border border-1">
                    <table class="table table-striped table-hovers table-bordered table-wrapper-riwayat m-0">
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
                        <?php
                        $no = 1;
                        foreach ($model['list'] as $item) { ?>
                            <tr>
                                <th scope="row"><?= $no++ ?></th>
                                <td><?= $item->noTransaksi ?></td>
                                <td><?= $item->namaKaryawan ?></td>
                                <td><?= $item->tanggalTransaksi ?></td>
                                <td><?= $item->jumlahBarang ?></td>
                                <td><?= $item->totalHarga ?></td>
                                <td>
                                    <button type="button" class="btn btn-warning fw-medium btn-sm text-white"
                                            data-bs-toggle="modal"
                                            data-bs-target="#check" onclick="getDetail(
                                            '<?= $item->noTransaksi ?>',
                                            '<?= $item->namaKaryawan ?>',
                                            '<?= $item->tanggalTransaksi ?>',
                                            '<?= $item->jumlahBarang ?>',
                                            '<?= $item->totalHarga ?>'
                                            )">Cek
                                    </button>
                                </td>
                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function resetForm() {
        document.getElementById('pembeli').value = '';
        document.getElementById('kasir').value = '';
        document.getElementById('notransaksi').value = '';
        document.getElementById('tanggal').value = '';
    }

    let detailpesanan;


    // make wait for the data to be fetched
    function getDetail(noTransaksi, kasir, tanggal, totalBarang, totalPembelian) {
        document.getElementById('detailpesanan').getElementsByTagName('tbody')[0].innerHTML = '';
        document.getElementById('kasir').value = kasir;
        document.getElementById('notransaksi').value = noTransaksi;
        document.getElementById('tanggal').value = tanggal;
        document.getElementById('totalbarang').innerHTML = totalBarang;
        document.getElementById('totalpembelian').innerHTML = totalPembelian;
        fetch(`/dashboard/riwayat/pembelian/get?notransaksi=${noTransaksi}`)
            .then(response => response.json())
            .then(data => {
                document.getElementById('pembeli').value = data.namaPelanggan;
                detailpesanan = data.barangJasa.map((item, index) => {
                    return `<tr>
                        <th scope="row">${index + 1}</th>
                        <td>${item.kode}</td>
                        <td>${item.nama}</td>
                        <td>${item.harga}</td>
                        <td>${item.jumlah}</td>
                        <td>${item.subtotal}</td>
                    </tr>`;
                }).join('');
            });
        setTimeout(() => {
            document.getElementById('detailpesanan').getElementsByTagName('tbody')[0].innerHTML = detailpesanan;
        }, 1000);
    }



    function deletePembelian() {
        let noTransaksi = document.getElementById('notransaksi').value;
        fetch(`/dashboard/riwayat/pembelian/delete?notransaksi=${noTransaksi}`)
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    alert('Berhasil menghapus data');
                    location.reload();
                } else {
                    alert('Gagal menghapus data');
                }
            });
    }
</script>

<div class="modal fade" id="check" tabindex="-1" aria-labelledby="popUp"
     aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content p-4">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="popUp">Detail Transaksi
                </h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close" onclick="resetForm()"></button>
            </div>
            <div class="modal-body">
                <div class="col">
                    <div class="row">
                        <div class="col">
                            <div class="form-floating mb-4">
                                <input name="pembeli" type="text" class="form-control" id="pembeli"
                                       placeholder="Masukan Kode" disabled>
                                <label for="pembeli">Pembeli</label>
                            </div>
                            <div class="form-floating mb-4">
                                <input name="kasir" type="text" class="form-control" id="kasir"
                                       placeholder="Masukan Nama" disabled>
                                <label for="kasir">Kasir</label>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-floating mb-4">
                                <input name="notransaksi" type="number" class="form-control" id="notransaksi"
                                       placeholder="Masukan Stok" disabled>
                                <label for="notransaksi">No Transaksi</label>
                            </div>
                            <div class="form-floating mb-4">
                                <input name="tanggal" type="text" class="form-control" id="tanggal"
                                       placeholder="Masukan Harga" disabled>
                                <label for="tanggal">Tanggal</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="mb-4">
                        <div class="row d-flex gap-2 text-white">
                            <div class="col">
                                <div class="col bg-success p-3 rounded">
                                    <h4>Total Barang yang dibeli</h4>
                                    <h3 id="totalbarang">20</h3>
                                </div>
                            </div>
                            <div class="col">
                                <div class="col bg-success p-3 rounded">
                                    <h4>Total Pembelian</h4>
                                    <h3 id="totalpembelian"><span>Rp. </span>200000</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col flex-fill">
                        <table class="table table-striped table-hovers table-bordered table-wrapper-check m-0 caption-top"
                               id="detailpesanan">
                            <caption>Detail Barang</caption>
                            <thead>
                            <tr>
                                <th scope="col" class="bg-success text-white fw-medium col-1">No</th>
                                <th scope="col" class="bg-success text-white fw-medium col-3">Kode</th>
                                <th scope="col" class="bg-success text-white fw-medium col-4">Nama</th>
                                <th scope="col" class="bg-success text-white fw-medium col-2">Harga</th>
                                <th scope="col" class="bg-success text-white fw-medium col">Jumlah</th>
                                <th scope="col" class="bg-success text-white fw-medium col-3">Sub Total</th>
                            </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <a href="../riwayat/pembelian" type="button" class="btn btn-danger w-100 btn-lg" id="deleteButton" onclick="deletePembelian()">Hapus</a>
            </div>
        </div>
    </div>
</div>
