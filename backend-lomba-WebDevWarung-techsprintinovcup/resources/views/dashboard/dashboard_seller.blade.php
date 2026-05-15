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

/* ================= MAIN ================= */

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

/* MENU */
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

/* PROFILE */
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

.content{
    padding:30px;
}

.menu-title{
    font-size:35px;
    font-weight:700;
    color:#333;
    margin-bottom:20px;
}

/* ================= TOP BAR ================= */

.top-bar{
    display:flex;
    justify-content:space-between;
    align-items:center;
    margin-bottom:25px;
}

html, body{
    width:100%;
    height:100%;
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

/* ================= BUTTON ================= */

.action{
    display:flex;
    gap:10px;
    margin-top:10px;
}

.btn{
    flex:1;
    border:none;
    padding:8px;
    border-radius:10px;
    cursor:pointer;
    color:white;
    font-weight:600;
}

.edit{
    background:orange;
}

.delete{
    background:red;
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
}

.modal-box{
    width:350px;
    background:white;
    padding:25px;
    border-radius:20px;
}

.modal-box h3{
    margin-bottom:20px;
}

.modal-box input{
    width:100%;
    padding:10px;
    margin-bottom:15px;
    border:1px solid #ccc;
    border-radius:10px;
}

.modal-action{
    display:flex;
    gap:10px;
}

.modal-action button{
    flex:1;
    padding:10px;
    border:none;
    border-radius:10px;
    cursor:pointer;
}

.save{
    background:#0b2d75;
    color:white;
}

.cancel{
    background:#ccc;
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
            <div>Hallo, Nama Pengguna</div>
            <div class="profile"></div>
        </div>

    </div>

    <!-- CONTENT -->
    <div class="content">

        <div class="top-bar">

            <div class="menu-title">
                MENU
            </div>

            <!-- SWITCH -->
            <div class="switch" id="switchBtn" onclick="toggleSwitch()">
                <div class="switch-circle"></div>
            </div>

        </div>

        <!-- PRODUCT -->
        <div class="grid" id="menuGrid">

        </div>

    </div>

</div>

<!-- MODAL -->
<div class="modal" id="editModal">

    <div class="modal-box">

        <h3>Edit Produk</h3>

        <input type="hidden" id="edit_id">

        <input type="text" id="edit_nama" placeholder="Nama Menu">

        <input type="number" id="edit_harga" placeholder="Harga">

        <input type="number" id="edit_stok" placeholder="Stok">

        <div class="modal-action">
            <button class="save" onclick="updateProduct()">
                Simpan
            </button>

            <button class="cancel" onclick="closeModal()">
                Batal
            </button>
        </div>

    </div>

</div>

<script>
const user = JSON.parse(localStorage.getItem("user"));
document.querySelector(".right-nav div").textContent = `Hallo, ${user.name}`;
const API_URL = "http://127.0.0.1:8000/api/products";

const headers = {
    "Accept":"application/json",
    "Content-Type":"application/json"
};

// ================= GET PRODUCTS =================
async function getProducts(){

    const res = await fetch(API_URL, { headers });

    const result = await res.json();

    console.log(result);

    const grid = document.getElementById("menuGrid");

    grid.innerHTML = "";

    result.data.forEach(p => {

        const card = document.createElement("div");

        card.className = "card";

        card.innerHTML = `
        
            <img src="https://picsum.photos/300/300?random=${p.id}">

            <div class="title">
                ${p.nama_menu}
            </div>

            <div class="desc">
                ${p.deskripsi || 'Deskripsi menu'}
            </div>

            <div class="price">
                Rp. ${Number(p.harga).toLocaleString('id-ID')}
            </div>

            <div class="action">

                <button class="btn edit"
                    onclick="openEdit(${p.id}, '${p.nama_menu}', ${p.harga}, ${p.stok})">
                    Edit
                </button>

                <button class="btn delete"
                    onclick="deleteProduct(${p.id})">
                    Delete
                </button>

            </div>

        `;

        grid.appendChild(card);

    });

}

// ================= CREATE =================
function goToCreate(){

    window.location.href = "/menu/create";

}

// ================= DELETE =================
async function deleteProduct(id){

    if(!confirm("Yakin hapus produk?")) return;

    const res = await fetch(`${API_URL}/${id}`, {
        method:'DELETE',
        headers
    });

    if(res.status === 200){

        alert("Berhasil hapus");

        getProducts();

    } else {

        alert("Gagal hapus");

    }

}

// ================= OPEN MODAL =================
function openEdit(id, nama, harga, stok){

    document.getElementById("editModal").style.display = "flex";

    document.getElementById("edit_id").value = id;
    document.getElementById("edit_nama").value = nama;
    document.getElementById("edit_harga").value = harga;
    document.getElementById("edit_stok").value = stok;

}

// ================= CLOSE MODAL =================
function closeModal(){

    document.getElementById("editModal").style.display = "none";

}

// ================= UPDATE =================
async function updateProduct(){

    const id = document.getElementById("edit_id").value;

    const body = {
        nama_menu: document.getElementById("edit_nama").value,
        harga: Number(document.getElementById("edit_harga").value),
        stok: Number(document.getElementById("edit_stok").value)
    };

    const res = await fetch(`${API_URL}/${id}`, {
        method:'PUT',
        headers,
        body: JSON.stringify(body)
    });

    if(res.status === 200){

        alert("Berhasil update");

        closeModal();

        getProducts();

    } else {

        alert("Gagal update");

    }

}

// ================= SWITCH =================
function toggleSwitch(){

    document.getElementById("switchBtn")
        .classList.toggle("active");

}

// AUTO LOAD
getProducts();

</script>

</body>
</html>