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
</script>
</body>
</html>