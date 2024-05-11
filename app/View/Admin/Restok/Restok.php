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
                            <a href="../managemen/barang" class="btn btn-outline-success fw-medium btn-lg "
                               tabindex="-1" role="button" aria-disabled="true" style="width: 160px;">Managemen</a>
                            <a href="../riwayat/pembelian" class="btn btn-outline-success fw-medium btn-lg"
                               tabindex="-1" role="button" aria-disabled="true" style="width: 160px;">Riwayat</a>
                            <a href="../restok/restok" class="btn btn-outline-success fw-medium btn-lg active"
                               tabindex="-1" role="button" aria-disabled="true" style="width: 160px;">Restok</a>
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
                            <div class="row">
                                <div class="col">

                                    <div class="form-floating">
                                        <input name="notransaksi" type="text" class="form-control" id="notransaksi"
                                               placeholder="Masukan Nama" disabled>
                                        <label for="notransaksi">No Transaksi</label>
                                    </div>
                                </div>
                                <div class="col">

                                    <div class="form-floating">
                                        <input name="tanggal" type="text" class="form-control" id="tanggal"
                                               placeholder="Masukan Nama" disabled>
                                        <label for="tanggal">Tanggal</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col gap-3 d-flex flex-column">
                                <div class="form-floating">
                                    <input name="supplier" type="text" class="form-control" id="supplier"
                                           placeholder="Masukan Nama" value="Guest">
                                    <label for="supplier">Supplier</label>
                                </div>
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
                                    <?php foreach ($model['list'] as $barang) { ?>
                                        <option value="<?php echo $barang->kode . '/' . $barang->nama?>">
                                            <?php echo $barang->kode . '/' . $barang->nama ?>
                                        </option>
                                    <?php } ?>
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
                                    <input name="harga" type="number" class="form-control" id="harga"
                                           placeholder="Masukan Nama">
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
                                <th scope="col" class="bg-success text-white fw-medium col-3">Supplier</th>
                                <th scope="col" class="bg-success text-white fw-medium col-3">Nama</th>
                                <th scope="col" class="bg-success text-white fw-medium col-2">Harga</th>
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
<script>
    $('#select-state').selectize({
        onChange: function (value) {
            let data = value.split('/');
            $('#nama').val(data[1]);
        }
    });

    $('#submit').on('click', function (e) {
        let supplier = $('#supplier').val();
        let nama = $('#nama').val();
        let harga = $('#harga').val();
        let qty = $('#jumlah').val();
        if (nama === '' || harga === '' || qty === '' || supplier === '') {
            e.preventDefault();
            alert('Data tidak lengkap');
        } else {
            submit();
        }
    });

    let tanggal;

    $(document).ready(function () {
        let date = new Date();
        let notransaksi = date.getTime();
        tanggal = date.getFullYear() + '-' + (date.getMonth() + 1) + '-' + date.getDate();
        $('#notransaksi').val(notransaksi);
        $('#tanggal').val(tanggal);
    });

    let tableDataArray = []; // kode, nama, harga, qty

    $('#checkoutbutton').on('click', function () {
        $.ajax({
            url: '/dashboard/restok/restok/post',
            type: 'POST',
            data: JSON.stringify(tableDataArray),
            contentType: 'application/json',
            success: function (data) {
                alert('Berhasil');
            },
            error: function (data) {
                alert('Gagal');
            }
        });
        location.reload();
    });

    let cells = [];

    function addRow() {
        let supplier = $('#supplier').val();
        let nama = $('#nama').val();
        let harga = $('#harga').val();
        let qty = $('#jumlah').val();
        let total = harga * qty;
        let table = document.querySelector('table');
        let rows = table.rows;
        let isExist = false;
        for (let i = 1; i < rows.length; i++) {
            if (rows[i].cells[1].innerText === supplier && rows[i].cells[2].innerText === nama) {
                let currentQty = parseInt(rows[i].cells[3].innerText);
                let newQty = currentQty + parseInt(qty);
                rows[i].cells[4].innerText = newQty;
                rows[i].cells[5].innerText = harga * newQty;
                tableDataArray[i - 1].qty = newQty;
                tableDataArray[i - 1].total = harga * newQty;
                isExist = true;
                break;
            }
        }
        if (!isExist) {
            tableDataArray.push({tanggal: tanggal, supplier: supplier,nama: nama, harga: parseInt(harga), qty: parseInt(qty), total: total});
            let row = table.insertRow(-1);
            cells = [];
            for (let j = 0; j < 7; j++) {
                cells.push(row.insertCell(j));
            }
            cells[0].innerText = rows.length - 1;
            cells[1].innerText = supplier;
            cells[2].innerText = nama;
            cells[3].innerText = harga;
            cells[4].innerText = qty;
            cells[5].innerText = total;
            cells[6].innerHTML = '<button type="button" class="btn btn-danger fw-medium btn-sm" onclick="deleteRow(this)">Hapus</button>';
        }
    }

    function loadData() {
        let table = document.querySelector('table');
        for (let i = 0; i < tableDataArray.length; i++) {
            let row = table.insertRow(-1);
            let cells = [];
            for (let j = 0; j < 7; j++) {
                cells.push(row.insertCell(j));
            }
            cells[0].innerText = i + 1;
            cells[1].innerText = tableDataArray[i].supplier;
            cells[2].innerText = tableDataArray[i].nama;
            cells[3].innerText = tableDataArray[i].harga;
            cells[4].innerText = tableDataArray[i].qty;
            cells[5].innerText = tableDataArray[i].total;
            cells[6].innerHTML = '<button type="button" class="btn btn-danger fw-medium btn-sm" onclick="deleteRow(this)">Hapus</button>';
        }
    }

    function deleteRow(r) {
        let i = r.parentNode.parentNode.rowIndex;
        document.querySelector('table').deleteRow(i);
        tableDataArray.splice(i - 1, 1);
        let table = document.querySelector('table');
        let rows = table.rows;
        for (let i = 1; i < rows.length; i++) {
            rows[i].cells[0].innerText = i;
        }
        sumTotal();
        updateCheckoutButton();
    }

    function sumTotal() {
        let total = 0;
        let table = document.querySelector('table');
        let rows = table.rows;
        for (let i = 1; i < rows.length; i++) {
            total += parseInt(rows[i].cells[4].innerText);
        }
        document.getElementById('totalpembelian').innerText = total;
    }

    function submit() {
        addRow();
        sumTotal();
        resetInput();
        updateCheckoutButton();
    }

    function resetInput() {
        $('#supplier').val('');
        $('#select-state')[0].selectize.clear();
        $('#nama').val('');
        $('#harga').val('');
        $('#jumlah').val('');
    }

    function updateCheckoutButton() {
        let total = parseInt($('#totalpembelian').text());
        if (total > 0) {
            $('#checkoutbutton').prop('disabled', false);
        } else {
            $('#checkoutbutton').prop('disabled', true);
        }
    }

</script>