<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Dashboard Penjual</title>

<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

<style>

*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family:'Poppins', sans-serif;
}

body{
    margin:0;
    background:#f2f2f2;
}

.wrapper{
    width:100%;
    min-height:100vh;
    background:white;
}

/* ================= NAVBAR ================= */

.navbar{
    background:#002b7f;
    height:90px;
    display:flex;
    justify-content:space-between;
    align-items:center;
    padding:0 20px;
}

.nav-menu{
    display:flex;
    gap:25px;
    align-items:center;
}

.menu-item{
    text-align:center;
    color:white;
    font-size:10px;
    cursor:pointer;
}

.circle-icon{
    width:55px;
    height:55px;
    border-radius:50%;
    background:white;
    color:black;
    display:flex;
    justify-content:center;
    align-items:center;
    font-size:28px;
    margin:auto;
    margin-bottom:5px;
    font-weight:bold;
}

.profile-section{
    display:flex;
    align-items:center;
    gap:15px;
    color:white;
}

.profile{
    width:50px;
    height:50px;
    border-radius:50%;
    background:white;
}

/* ================= CONTENT ================= */

.content{ padding:30px; }

.menu-title{
    font-size:35px;
    font-weight:700;
    color:#333;
    margin-bottom:20px;
}

.top-bar{
    display:flex;
    justify-content:space-between;
    align-items:center;
    margin-bottom:25px;
}

/* ================= SWITCH ================= */

.switch{
    width:70px;
    height:35px;
    background:#0b2d75;
    border-radius:30px;
    position:relative;
    cursor:pointer;
    padding:5px;
}

.switch-circle{
    width:25px;
    height:25px;
    background:red;
    border-radius:50%;
    position:absolute;
    left:5px;
    transition:0.3s;
}

.switch.active .switch-circle{
    left:40px;
    background:#00ff66;
}

/* ================= PRODUCT GRID ================= */

.grid{
    display:flex;
    gap:20px;
    flex-wrap:wrap;
}

/* ================= CARD ================= */

.card{
    width:220px;
    background:#7a8ed9;
    border-radius:20px;
    padding:10px;
    position:relative;
    overflow:hidden;
    transition: 0.3s ease;
}

/* CARD HABIS */
.card.habis{
    background:#aaaaaa;
    filter: grayscale(80%);
}

.card img{
    width:100%;
    height:140px;
    object-fit:cover;
    border-radius:15px;
}

.title{
    font-size:22px;
    font-weight:700;
    color:#ffd400;
    margin-top:8px;
}

.card.habis .title{
    color:#dddddd;
}

.desc{
    font-size:11px;
    color:white;
    min-height:30px;
}

.price{
    text-align:right;
    color:white;
    margin-top:10px;
}

/* Badge HABIS */
.badge-habis{
    display:none;
    position:absolute;
    top:12px;
    left:12px;
    background:#cc0000;
    color:white;
    font-size:10px;
    font-weight:700;
    padding:4px 10px;
    border-radius:20px;
    letter-spacing:1px;
}

.card.habis .badge-habis{
    display:block;
}

.action{
    display:flex;
    gap:6px;
    margin-top:10px;
    flex-wrap:wrap;
}

.btn{
    flex:1;
    border:none;
    padding:8px;
    border-radius:10px;
    cursor:pointer;
    color:white;
    font-weight:600;
    font-size:12px;
}

.edit{ background:orange; }
.delete{ background:red; }

/* Tombol habis/tersedia */
.btn-habis{
    width:100%;
    border:none;
    padding:7px;
    border-radius:10px;
    cursor:pointer;
    font-weight:600;
    font-size:11px;
    background:#333;
    color:white;
    margin-top:4px;
    transition:0.2s;
}

.card.habis .btn-habis{
    background:#1fae4b;
}

/* ================= MODAL ================= */

.modal{
    position:fixed;
    top:0;
    left:0;
    width:100%;
    height:100%;
    background:rgba(0,0,0,0.5);
    display:none;
    justify-content:center;
    align-items:center;
    z-index:999;
}

.modal-box{
    width:380px;
    background:white;
    padding:25px;
    border-radius:20px;
}

.modal-box h3{ margin-bottom:20px; }

.modal-box input[type="text"],
.modal-box input[type="number"]{
    width:100%;
    padding:10px;
    margin-bottom:15px;
    border:1px solid #ccc;
    border-radius:10px;
    font-family:'Poppins', sans-serif;
}

.edit-img-wrap{
    width:100%;
    height:150px;
    border-radius:12px;
    overflow:hidden;
    margin-bottom:12px;
    cursor:pointer;
    position:relative;
    border:2px dashed #aaa;
    display:flex;
    align-items:center;
    justify-content:center;
    background:#f5f5f5;
}

.edit-img-wrap img{
    width:100%;
    height:100%;
    object-fit:cover;
    display:block;
}

.edit-img-overlay{
    position:absolute;
    bottom:0;
    left:0;
    right:0;
    background:rgba(0,0,0,0.45);
    color:white;
    text-align:center;
    font-size:12px;
    padding:6px;
}

.modal-action{ display:flex; gap:10px; margin-top:5px; }

.modal-action button{
    flex:1;
    padding:10px;
    border:none;
    border-radius:10px;
    cursor:pointer;
    font-family:'Poppins', sans-serif;
    font-weight:600;
}

.save{ background:#0b2d75; color:white; }
.cancel{ background:#ccc; }

/* ================= EMPTY STATE ================= */
.empty-state{
    width:100%;
    text-align:center;
    padding:60px 20px;
    color:#888;
    font-size:16px;
}

</style>
</head>
<body>

<div class="wrapper">

    <!-- NAVBAR -->
    <div class="navbar">
        <div class="nav-menu">

            <div class="menu-item">
                <div class="circle-icon">⌂</div>
                Dashboard
            </div>

            <div class="menu-item" onclick="goToCreate()">
                <div class="circle-icon">+</div>
                Tambah Menu
            </div>

            <div class="menu-item">
                <div class="circle-icon">💰</div>
                Laporan
            </div>

            <div class="menu-item">
                <div class="circle-icon">⟳</div>
                Pesanan
            </div>

        </div>

        <div class="profile-section">
            <div id="namaUser">Hallo, ...</div>
            <div class="profile"></div>
        </div>
    </div>

    <!-- CONTENT -->
    <div class="content">
        <div class="top-bar">
            <div class="menu-title">MENU</div>
            <div class="switch" id="switchBtn" onclick="toggleSwitch()">
                <div class="switch-circle"></div>
            </div>
        </div>
        <div class="grid" id="menuGrid"></div>
    </div>

</div>

<!-- MODAL EDIT -->
<div class="modal" id="editModal">
    <div class="modal-box">
        <h3>Edit Produk</h3>

        <input type="hidden" id="edit_id">

        <div class="edit-img-wrap" onclick="document.getElementById('edit_file').click()">
            <img id="edit_preview" src="" alt="Foto Produk">
            <div class="edit-img-overlay">📷 Klik untuk ganti foto</div>
        </div>
        <input type="file" id="edit_file" accept="image/*" style="display:none">

        <input type="text"   id="edit_nama"  placeholder="Nama Menu">
        <input type="number" id="edit_harga" placeholder="Harga">
        <input type="number" id="edit_stok"  placeholder="Stok">

        <div class="modal-action">
            <button class="save"   onclick="updateProduct()">Simpan</button>
            <button class="cancel" onclick="closeModal()">Batal</button>
        </div>
    </div>
</div>

<script>

// ================= INIT =================
const user  = JSON.parse(localStorage.getItem("user"));
const token = localStorage.getItem("token");

if (!user || !token) {
    window.location.href = "/login";
}

document.getElementById("namaUser").textContent = `Hallo, ${user.name}`;

const API_URL = "http://127.0.0.1:8000/api/products";

const authHeaders = {
    "Accept": "application/json",
    "Content-Type": "application/json",
    "Authorization": `Bearer ${token}`
};

let editSelectedFile = null;

// Simpan status habis per produk (hanya frontend, tidak ke backend)
const habisSet = new Set();

document.getElementById('edit_file').addEventListener('change', function(e) {
    const file = e.target.files[0];
    if (!file) return;
    editSelectedFile = file;
    const reader = new FileReader();
    reader.onload = ev => {
        document.getElementById('edit_preview').src = ev.target.result;
    };
    reader.readAsDataURL(file);
});

// ================= GET PRODUCTS =================
async function getProducts(){
    try {
        const res    = await fetch(API_URL, { headers: authHeaders });
        const result = await res.json();

        console.log(result);

        const grid = document.getElementById("menuGrid");
        grid.innerHTML = "";

        if (!result.data || result.data.length === 0) {
            grid.innerHTML = '<div class="empty-state">Belum ada menu. Klik + Tambah Menu untuk mulai.</div>';
            return;
        }

        result.data.forEach(p => {
            const isHabis = habisSet.has(p.id);
            renderCard(p, isHabis);
        });

    } catch(err) {
        console.error(err);
    }
}

// ================= RENDER CARD =================
function renderCard(p, isHabis){
    const grid   = document.getElementById("menuGrid");
    const imgSrc = p.gambar_url || `https://picsum.photos/300/300?random=${p.id}`;

    const card = document.createElement("div");
    card.className = "card" + (isHabis ? " habis" : "");
    card.id = `card-${p.id}`;

    card.innerHTML = `
        <div class="badge-habis">HABIS</div>
        <img src="${imgSrc}" alt="${p.nama_menu}">
        <div class="title">${p.nama_menu}</div>
        <div class="desc">${p.deskripsi || 'Deskripsi menu'}</div>
        <div class="price">Rp. ${Number(p.harga).toLocaleString('id-ID')}</div>
        <div class="action">
            <button class="btn edit"
                onclick="openEdit(${p.id}, '${p.nama_menu}', ${p.harga}, ${p.stok}, '${imgSrc}')">
                Edit
            </button>
            <button class="btn delete"
                onclick="deleteProduct(${p.id})">
                Delete
            </button>
        </div>
        <button class="btn-habis" id="btn-habis-${p.id}" onclick="toggleHabis(${p.id})">
            ${isHabis ? '✅ Tandai Tersedia' : '🚫 Tandai Habis'}
        </button>
    `;

    grid.appendChild(card);
}

function toggleHabis(id){
    const card     = document.getElementById(`card-${id}`);
    const btnHabis = document.getElementById(`btn-habis-${id}`);

    if (habisSet.has(id)) {
        habisSet.delete(id);
        card.classList.remove("habis");
        btnHabis.textContent = "🚫 Tandai Habis";
    } else {
        habisSet.add(id);
        card.classList.add("habis");
        btnHabis.textContent = "✅ Tandai Tersedia";
    }

    // simpan ke localStorage biar consument bisa baca
    localStorage.setItem("produk_habis", JSON.stringify([...habisSet]));
}

// ================= CREATE =================
function goToCreate(){
    window.location.href = "/menu/create";
}

// ================= DELETE =================
async function deleteProduct(id){
    if (!confirm("Yakin hapus produk?")) return;

    const res = await fetch(`${API_URL}/${id}`, {
        method: 'DELETE',
        headers: authHeaders
    });

    if (res.ok) {
        habisSet.delete(id);
        alert("Berhasil hapus");
        getProducts();
    } else {
        alert("Gagal hapus");
    }
}

// ================= OPEN MODAL =================
function openEdit(id, nama, harga, stok, imgSrc){
    editSelectedFile = null;
    document.getElementById("edit_file").value = "";

    document.getElementById("editModal").style.display = "flex";
    document.getElementById("edit_id").value    = id;
    document.getElementById("edit_nama").value  = nama;
    document.getElementById("edit_harga").value = harga;
    document.getElementById("edit_stok").value  = stok;
    document.getElementById("edit_preview").src = imgSrc;
}

// ================= CLOSE MODAL =================
function closeModal(){
    document.getElementById("editModal").style.display = "none";
}

// ================= UPDATE =================
async function updateProduct(){
    const id = document.getElementById("edit_id").value;

    let res;

    if (editSelectedFile) {
        const formData = new FormData();
        formData.append('nama_menu', document.getElementById("edit_nama").value);
        formData.append('harga',     Number(document.getElementById("edit_harga").value));
        formData.append('stok',      Number(document.getElementById("edit_stok").value));
        formData.append('gambar',    editSelectedFile);
        formData.append('_method',   'PUT');

        res = await fetch(`${API_URL}/${id}`, {
            method: 'POST',
            headers: { 'Accept': 'application/json', 'Authorization': `Bearer ${token}` },
            body: formData
        });
    } else {
        res = await fetch(`${API_URL}/${id}`, {
            method: 'PUT',
            headers: authHeaders,
            body: JSON.stringify({
                nama_menu: document.getElementById("edit_nama").value,
                harga:     Number(document.getElementById("edit_harga").value),
                stok:      Number(document.getElementById("edit_stok").value)
            })
        });
    }

    if (res.ok) {
        alert("Berhasil update");
        closeModal();
        getProducts();
    } else {
        const err = await res.json();
        alert("Gagal update: " + (err.message || JSON.stringify(err)));
    }
}

// ================= SWITCH =================
function toggleSwitch(){
    document.getElementById("switchBtn").classList.toggle("active");
}

// AUTO LOAD
getProducts();

</script>

</body>
</html>