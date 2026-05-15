<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Dashboard Konsumen</title>

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
    background:#e9e9e9;
}

/* ================= NAVBAR ================= */

.navbar{
    background-color:#001a57;
    color:white;
    padding:15px 5%;
    display:flex;
    justify-content:space-between;
    align-items:center;
    position:sticky;
    top:0;
    z-index:100;
    height:70px;
}

.left-nav{
    display:flex;
    align-items:center;
    gap:15px;
}

.menu-icon{
    font-size:24px;
    cursor:pointer;
}

.logo{
    font-size:28px;
    color:orange;
    font-weight:bold;
}

.right-nav{
    display:flex;
    align-items:center;
    gap:10px;
    color:white;
}

.profile{
    width:40px;
    height:40px;
    background:white;
    border-radius:50%;
}

/* ================= SIDEBAR ================= */

.sidebar{
    height:100%;
    width:0;
    position:fixed;
    z-index:1001;
    top:0;
    left:0;
    background-color:#001a57;
    overflow-x:hidden;
    transition:0.5s;
    padding-top:60px;
    box-shadow:2px 0 10px rgba(0,0,0,0.3);
}

.sidebar-content{
    display:flex;
    flex-direction:column;
    padding:20px;
    gap:15px;
}

.sidebar-content a{
    padding:12px 20px;
    text-decoration:none;
    font-size:16px;
    color:white;
    background-color:rgba(255,255,255,0.1);
    border-radius:10px;
    display:block;
    transition:0.3s;
}

.sidebar-content a:hover{
    background-color:#ffb800;
    color:#001a57;
}

.overlay{
    display:none;
    position:fixed;
    width:100%;
    height:100%;
    top:0;
    left:0;
    background-color:rgba(0,0,0,0.5);
    z-index:1000;
}

/* ================= CONTAINER ================= */

.container{
    padding:25px;
}

/* ================= MENU GRID ================= */

.menu-grid{
    display:flex;
    gap:20px;
    overflow-x:auto;
    padding-bottom:10px;
    flex-wrap:wrap;
}

/* ================= CARD ================= */

.card{
    min-width:320px;
    background:#7488d8;
    border-radius:20px;
    padding:15px;
    display:flex;
    justify-content:space-between;
    align-items:center;
    color:white;
    position:relative;
    transition:0.3s ease;
}

/* CARD HABIS */
.card.habis{
    background:#aaaaaa;
    filter:grayscale(80%);
}

.card-left{
    width:55%;
}

.menu-name{
    font-size:30px;
    font-weight:700;
    color:#ffd400;
    line-height:1.1;
}

.card.habis .menu-name{
    color:#dddddd;
}

.menu-desc{
    font-size:12px;
    margin-top:5px;
    color:#f1f1f1;
}

.menu-price{
    margin-top:20px;
    font-size:28px;
}

.card-right{
    width:40%;
    text-align:center;
}

.card-right img{
    width:100%;
    height:120px;
    object-fit:cover;
    border-radius:15px;
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

/* Tombol Tambah */
.btn-cart{
    margin-top:10px;
    background:#ffcc00;
    border:none;
    padding:8px 20px;
    border-radius:20px;
    cursor:pointer;
    font-weight:600;
    font-family:'Poppins', sans-serif;
    transition:0.2s;
}

.btn-cart:disabled{
    background:#cccccc;
    color:#888888;
    cursor:not-allowed;
}

/* ================= ALERT ================= */

.alert{
    padding:15px;
    background:#1fae4b;
    color:white;
    border-radius:10px;
    margin-bottom:20px;
    display:none;
}

/* ================= CATEGORY TITLE ================= */
.category-title{
    font-size:22px;
    font-weight:700;
    color:#082567;
    margin:20px 0 12px;
}

</style>
</head>

<body>
    <div id="overlay" class="overlay" onclick="closeNav()"></div>

    <div id="mySidebar" class="sidebar">
        <div class="sidebar-content">
            <a href="/dashboard/consument" onclick="closeNav()">Menu Makanan</a>
            <a href="#">Status Pesanan</a>
            <a href="#">Riwayat Pesanan</a>
        </div>
    </div>

<!-- NAVBAR -->
<div class="navbar">
    <div class="left-nav">
        <div class="menu-icon" onclick="openNav()">☰</div>
        <div class="logo">🔥</div>
    </div>
    <div class="right-nav">
        <div id="namaUser">Hallo, ...</div>
        <div class="profile"></div>
    </div>
</div>

<div class="container">

    <div class="alert" id="alertBox">
        Produk berhasil ditambahkan ke cart
    </div>

    <div class="category-title">🍱 Makanan</div>
    <div class="menu-grid" id="gridMakanan"></div>

    <div class="category-title">🥤 Minuman</div>
    <div class="menu-grid" id="gridMinuman"></div>

</div>

<script>

// ================= INIT =================
const user  = JSON.parse(localStorage.getItem("user"));
const token = localStorage.getItem("token");

if (!user || !token) {
    window.location.href = "/login";
}

document.getElementById("namaUser").textContent = `Hallo, ${user.name}`;

const API_PRODUCTS = "http://127.0.0.1:8000/api/products";
const API_CART     = "http://127.0.0.1:8000/api/carts";

// Baca daftar produk habis dari localStorage (di-set oleh seller)
function getProdukHabis(){
    const data = localStorage.getItem("produk_habis");
    return data ? new Set(JSON.parse(data)) : new Set();
}

// ================= GET PRODUCTS =================
async function getProducts(){
    try{
        const response = await fetch(API_PRODUCTS, {
            headers:{
                'Accept': 'application/json',
                'Authorization': `Bearer ${token}`
            }
        });
        const result = await response.json();

        const habisSet    = getProdukHabis();
        const gridMakanan = document.getElementById("gridMakanan");
        const gridMinuman = document.getElementById("gridMinuman");

        gridMakanan.innerHTML = "";
        gridMinuman.innerHTML = "";

        result.data.forEach(product => {
            const isHabis = habisSet.has(product.id);
            const imgSrc  = product.gambar_url || `https://picsum.photos/200/200?random=${product.id}`;

            const card = document.createElement("div");
            card.className = "card" + (isHabis ? " habis" : "");

            card.innerHTML = `
                <div class="badge-habis">HABIS</div>
                <div class="card-left">
                    <div class="menu-name">${product.nama_menu}</div>
                    <div class="menu-desc">${product.deskripsi ?? 'Menu tersedia'}</div>
                    <div class="menu-price">Rp. ${Number(product.harga).toLocaleString('id-ID')}</div>
                </div>
                <div class="card-right">
                    <img src="${imgSrc}" alt="${product.nama_menu}">
                    <button
                        class="btn-cart"
                        onclick="addToCart(${product.id})"
                        ${isHabis ? 'disabled' : ''}
                    >
                        ${isHabis ? 'Habis' : 'Tambah'}
                    </button>
                </div>
            `;

            // pisah berdasarkan category_id: 1=Makanan, 2=Minuman
            if (product.category_id === 1) {
                gridMakanan.appendChild(card);
            } else {
                gridMinuman.appendChild(card);
            }
        });

    } catch(error){
        console.log(error);
    }
}

// ================= ADD TO CART =================
async function addToCart(productId){
    try{
        const response = await fetch(API_CART, {
            method: 'POST',
            headers:{
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'Authorization': `Bearer ${token}`
            },
            body: JSON.stringify({ product_id: productId, qty: 1 })
        });

        const result = await response.json();
        console.log(result);

        if(response.ok){
            const alertBox = document.getElementById("alertBox");
            alertBox.style.display = "block";
            setTimeout(() => { alertBox.style.display = "none"; }, 2000);
        } else {
            alert("Gagal tambah ke cart");
        }
    } catch(error){
        console.log(error);
        alert("Server Error");
    }
}

getProducts();

function openNav(){
    document.getElementById("mySidebar").style.width = "250px";
    document.getElementById("overlay").style.display = "block";
}

function closeNav(){
    document.getElementById("mySidebar").style.width = "0";
    document.getElementById("overlay").style.display = "none";
}

</script>

</body>
</html>