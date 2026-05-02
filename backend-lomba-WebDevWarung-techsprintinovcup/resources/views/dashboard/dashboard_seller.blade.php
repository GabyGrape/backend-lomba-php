<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Dashboard Menu</title>

<style>
body {
    margin: 0;
    font-family: sans-serif;
    background: #ddd;
}

.container {
    padding: 30px;
}

/* GRID MENU */
.grid {
    display: flex;
    gap: 20px;
    flex-wrap: wrap;
}

.card {
    width: 200px;
    background: #6c7eb7;
    padding: 10px;
    border-radius: 20px;
    color: white;
}

.card img {
    width: 100%;
    border-radius: 15px;
}

.title {
    font-weight: bold;
    color: yellow;
    margin-top: 10px;
}

.price {
    text-align: right;
    font-size: 14px;
}

/* BUTTON */
.btn {
    margin-top: 5px;
    padding: 5px 10px;
    border: none;
    border-radius: 10px;
    cursor: pointer;
}

.edit { background: orange; color: white; }
.delete { background: red; color: white; }

/* MODAL */
.modal {
    position: fixed;
    top: 0; left: 0;
    width: 100%; height: 100%;
    background: rgba(0,0,0,0.5);
    display: none;
    justify-content: center;
    align-items: center;
}

.modal-box {
    background: white;
    padding: 20px;
    border-radius: 10px;
    width: 300px;
}
</style>

</head>
<body>

<div class="container">

    <h2>MENU</h2>
    <button onclick="getProducts()">Refresh</button>
    <button onclick="goToCreate()" style="margin-bottom:20px;">
    + Tambah Menu
</button>

    <div class="grid" id="menuGrid"></div>

</div>

<!-- MODAL EDIT -->
<div class="modal" id="editModal">
    <div class="modal-box">
        <h3>Edit Produk</h3>

        <input id="edit_id" hidden>
        <input id="edit_nama" placeholder="Nama Menu"><br><br>
        <input id="edit_harga" type="number" placeholder="Harga"><br><br>
        <input id="edit_stok" type="number" placeholder="Stok"><br><br>

        <button onclick="updateProduct()">Simpan</button>
        <button onclick="closeModal()">Batal</button>
    </div>
</div>

<script>
const API_URL = "http://localhost:8000/api/products";

const headers = {
    "Accept": "application/json",
    "Content-Type": "application/json"
};
function goToCreate() {
    window.location.href = "/menu/create";
}

async function getProducts() {
    const res = await fetch(API_URL, { headers });
    const result = await res.json();

    const grid = document.getElementById("menuGrid");
    grid.innerHTML = "";

    result.data.forEach(p => {
        const card = document.createElement("div");
        card.className = "card";

        card.innerHTML = `
            <img src="https://via.placeholder.com/200">
            <div class="title">${p.nama_menu}</div>
            <div>${p.deskripsi || "-"}</div>
            <div class="price">Rp ${p.harga}</div>

            <button class="btn edit" onclick="openEdit(${p.id}, '${p.nama_menu}', ${p.harga}, ${p.stok})">Edit</button>
            <button class="btn delete" onclick="deleteProduct(${p.id})">Delete</button>
        `;

        grid.appendChild(card);
    });
}


async function deleteProduct(id) {
    if (!confirm("Yakin hapus?")) return;

    const res = await fetch(`${API_URL}/${id}`, {
        method: "DELETE",
        headers
    });

    if (res.status === 200) {
        alert("Berhasil hapus");
        getProducts();
    } else {
        alert("Gagal hapus");
    }
}


function openEdit(id, nama, harga, stok) {
    document.getElementById("editModal").style.display = "flex";

    document.getElementById("edit_id").value = id;
    document.getElementById("edit_nama").value = nama;
    document.getElementById("edit_harga").value = harga;
    document.getElementById("edit_stok").value = stok;
}

function closeModal() {
    document.getElementById("editModal").style.display = "none";
}

// ================= UPDATE =================
async function updateProduct() {
    const id = document.getElementById("edit_id").value;

    const body = {
        nama_menu: document.getElementById("edit_nama").value,
        harga: Number(document.getElementById("edit_harga").value),
        stok: Number(document.getElementById("edit_stok").value)
    };

    const res = await fetch(`${API_URL}/${id}`, {
        method: "PUT",
        headers,
        body: JSON.stringify(body)
    });

    if (res.status === 200) {
        alert("Berhasil update");
        closeModal();
        getProducts();
    } else {
        alert("Gagal update");
    }
}

// AUTO LOAD
getProducts();

</script>

</body>
</html>