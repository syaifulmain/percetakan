<script>
    const target = document.getElementById("alertDiv");
    if (target) {
        window.onload = setInterval(() => {
            target.style.opacity = '0';
        }, 2000);
    }

    function editKode(kode, nama, stok, harga) {
        const kodeU = document.getElementById("kode-u");
        const namaU = document.getElementById("nama-u");
        const stokU = document.getElementById("stok-u");
        const hargaU = document.getElementById("harga-u");
        const deleteButton = document.getElementById("deleteButton");
        const editButton = document.getElementById("editButton");
        const jenis = document.getElementById("jenis").innerHTML;
        kodeU.value = kode;
        namaU.value = nama;
        stokU.value = stok;
        hargaU.value = harga;
        deleteButton.href = "delete?kode=" + kode + "&jenis=" + jenis;
        editButton.href = "update?kode=" + kode + "&nama=" + nama + "&stok=" + stok + "&harga=" + harga;
    }

    function resetForm() {
        const actionU = document.getElementById("action");
        if (actionU.value === 'Edit') {
            document.getElementById("forminput").reset();
        }
    }

    function displayCRUDButton(jenis, action, kode = null, nama = null, stok = null, harga = null) {
        const kodeU = document.getElementById("kode");
        const namaU = document.getElementById("nama");
        const stokU = document.getElementById("stok");
        const hargaU = document.getElementById("harga");
        const jenisU = document.getElementById("jenis");
        const actionU = document.getElementById("action");

        jenisU.value = jenis;
        actionU.value = action;

        const confirmButton = document.getElementById("confirmButton");
        const deleteButton = document.getElementById("deleteButton");
        const saveButton = document.getElementById("saveButton");
        const jenisLabel = document.getElementById("jenisLabel");
        const actionLabel = document.getElementById("actionLabel");
        if (action === 'Tambah') {
            actionLabel.innerHTML = action;
            jenisLabel.innerHTML = jenis;
            saveButton.style.display = 'block';
            confirmButton.style.display = 'none';
            deleteButton.style.display = 'none';

            kodeU.style.backgroundColor = '#ffffff';

            kodeU.readOnly = false;
        } else {
            kodeU.value = kode;
            namaU.value = nama;
            stokU.value = stok;
            hargaU.value = harga;

            kodeU.style.backgroundColor = '#e2e3e5';

            actionLabel.innerHTML = action;
            jenisLabel.innerHTML = jenis;
            confirmButton.style.display = 'block';
            deleteButton.style.display = 'block';
            saveButton.style.display = 'none';

            kodeU.readOnly = true;

            deleteButton.href = "./barangjasa/delete?kode=" + kode + "&jenis=" + jenis;
        }
    }
    function displayCRUDButtonK(jenis, action, username = null, nama = null, alamat = null, noTelp = null) {
        const usernameU = document.getElementById("username");
        const namaU = document.getElementById("nama");
        const alamatU = document.getElementById("alamat");
        const notelpU = document.getElementById("noTelp");
        const jenisU = document.getElementById("jenis");
        const actionU = document.getElementById("action");

        jenisU.value = jenis;
        actionU.value = action;

        const confirmButton = document.getElementById("confirmButton");
        const deleteButton = document.getElementById("deleteButton");
        const saveButton = document.getElementById("saveButton");
        const jenisLabel = document.getElementById("jenisLabel");
        const actionLabel = document.getElementById("actionLabel");
        if (action === 'Tambah') {
            actionLabel.innerHTML = action;
            jenisLabel.innerHTML = jenis;
            saveButton.style.display = 'block';
            confirmButton.style.display = 'none';
            deleteButton.style.display = 'none';

            usernameU.style.backgroundColor = '#ffffff';

            usernameU.readOnly = false;
        } else {
            usernameU.value = username;
            namaU.value = nama;
            alamatU.value = alamat;
            notelpU.value = noTelp;

            usernameU.style.backgroundColor = '#e2e3e5';

            actionLabel.innerHTML = action;
            jenisLabel.innerHTML = jenis;
            confirmButton.style.display = 'block';
            deleteButton.style.display = 'block';
            saveButton.style.display = 'none';

            usernameU.readOnly = true;

            deleteButton.href = "./karyawan/delete?kode=" + username + "&jenis=" + jenis;
        }
    }
    $('#select-state').selectize({
        onChange: function (value) {
            let data = value.split(' ');
            $('#nama').val(data[1]);
            $('#harga').val(data[2]);
            $('#jumlah').attr('max', data[3]);
            $('#jumlah').attr('min', 1);
            $('#jumlah').val(1);
        }
    });

    $('#jumlah').on('change', function () {
        let qty = $('#jumlah').val();
        let max = $('#jumlah').attr('max');
        if (qty < 1) {
            $('#jumlah').val(1);
        } else if (qty > max) {
            $('#jumlah').val(max);
        }
    });

    $('#totalbayarfinal').on('change', function () {
        let totalbayar = $('#totalbayarfinal').val();
        let totalpembelian = $('#totalpembelianfinal').val();
        let kembalian = totalbayar - totalpembelian;
        if (kembalian < 0) {
            $('#totalkembalianfinal').val(0);
        } else {
            $('#totalkembalianfinal').val(kembalian);
        }
    });

    $('#submit').on('click', function (e) {
        let nama = $('#nama').val();
        let harga = $('#harga').val();
        let qty = $('#jumlah').val();
        if (nama === '' || harga === '' || qty === '') {
            e.preventDefault();
            alert('Data tidak lengkap');
        } else {
            submit();
        }
    });

    $('#selesaikan').on('click', function (e) {
        let totalbayar = $('#totalbayarfinal').val();
        let totalpembelian = $('#totalpembelianfinal').val();
        if (totalbayar < totalpembelian) {
            e.preventDefault();
            alert('Pembayaran tidak cukup');
        }
    });

    $(document).ready(function () {
        let date = new Date();
        let notransaksi = date.getTime();
        let tanggal = date.getDate() + '-' + (date.getMonth() + 1) + '-' + date.getFullYear();
        $('#notransaksi').val(notransaksi);
        $('#tanggal').val(tanggal);
    });

    let tableDataArray = []; // kode, nama, harga, qty
    let cells = [];

    // add row adn data to table after submit button clicked
    // if same product already in table, update qty and total
    function addRow() {
        let nama = $('#nama').val();
        let harga = $('#harga').val();
        let qty = $('#jumlah').val();
        let total = harga * qty;
        let table = document.querySelector('table');
        let rows = table.rows;
        let isExist = false;
        for (let i = 1; i < rows.length; i++) {
            if (rows[i].cells[1].innerText === nama) {
                let currentQty = parseInt(rows[i].cells[3].innerText);
                let newQty = currentQty + parseInt(qty);
                rows[i].cells[3].innerText = newQty;
                rows[i].cells[4].innerText = harga * newQty;
                tableDataArray[i - 1].qty = newQty;
                tableDataArray[i - 1].total = harga * newQty;
                isExist = true;
                break;
            }
        }
        if (!isExist) {
            tableDataArray.push({nama: nama, harga: parseInt(harga), qty: parseInt(qty), total: total});
            let row = table.insertRow(-1);
            cells = [];
            for (let j = 0; j < 6; j++) {
                cells.push(row.insertCell(j));
            }
            cells[0].innerText = rows.length - 1;
            cells[1].innerText = nama;
            cells[2].innerText = harga;
            cells[3].innerText = qty;
            cells[4].innerText = total;
            cells[5].innerHTML = '<button type="button" class="btn btn-danger fw-medium btn-sm" onclick="deleteRow(this)">Hapus</button>';
        }
    }

    //laod data table with tableDataArray
    function loadData() {
        let table = document.querySelector('table');
        for (let i = 0; i < tableDataArray.length; i++) {
            let row = table.insertRow(-1);
            let cells = [];
            for (let j = 0; j < 6; j++) {
                cells.push(row.insertCell(j));
            }
            cells[0].innerText = i + 1;
            cells[1].innerText = tableDataArray[i].nama;
            cells[2].innerText = tableDataArray[i].harga;
            cells[3].innerText = tableDataArray[i].qty;
            cells[4].innerText = tableDataArray[i].total;
            cells[5].innerHTML = '<button type="button" class="btn btn-danger fw-medium btn-sm" onclick="deleteRow(this)">Hapus</button>';
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
        document.getElementById('totalpembelianfinal').value = total;
    }

    function submit() {
        addRow();
        sumTotal();
        resetInput();
        updateCheckoutButton();
    }

    function resetInput() {
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
</body>
</html>