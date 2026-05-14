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
    width:100%;
    height:70px;
    background:#002b7f;
    display:flex;
    justify-content:space-between;
    align-items:center;
    padding:0 25px;
    color:white;
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
}

.profile{
    width:40px;
    height:40px;
    background:white;
    border-radius:50%;
}

.navbar {
    background-color: #001a57;
    color: white;
    padding: 15px 5%;
    display: flex;
    justify-content: space-between;
    align-items: center;
    position: sticky;
    top: 0;
    z-index: 100;
}

.user-info {
    display: flex;
    align-items: center;
    gap: 12px;
}

.profile-icon {
    cursor: pointer;
    width: 35px;
    height: 35px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.profile-icon img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.menu-trigger {
    cursor: pointer;
    font-size: 24px;
    color: white;
}


/* Sidebar, Overlay */

.sidebar {
    height: 100%;
    width: 0;
    position: fixed;
    z-index: 1001;
    top: 0;
    left: 0;
    background-color: #001a57;
    overflow-x: hidden;
    transition: 0.5s;
    padding-top: 60px;
    box-shadow: 2px 0 10px rgba(0, 0, 0, 0.3);
}

.sidebar-content {
    display: flex;
    flex-direction: column;
    padding: 20px;
    gap: 15px;
}

.sidebar-content a {
    padding: 12px 20px;
    text-decoration: none;
    font-size: 16px;
    color: white;
    background-color: rgba(255, 255, 255, 0.1);
    border-radius: 10px;
    display: block;
    transition: 0.3s;
}

.sidebar-content a:hover {
    background-color: #ffb800;
    color: #001a57;
}

.overlay {
    display: none;
    position: fixed;
    width: 100%;
    height: 100%;
    top: 0;
    left: 0;
    background-color: rgba(0, 0, 0, 0.5);
    z-index: 1000;
}

/* ================= CONTAINER ================= */

.container{
    padding:25px;
}

/* ================= CATEGORY ================= */

.category-title{
    font-size:28px;
    font-weight:700;
    color:#082567;
    margin-bottom:20px;
}

/* ================= MENU GRID ================= */

.menu-grid{
    display:flex;
    gap:20px;
    overflow-x:auto;
    padding-bottom:10px;
}

.menu-grid::-webkit-scrollbar{
    height:8px;
}

.menu-grid::-webkit-scrollbar-thumb{
    background:#bbb;
    border-radius:10px;
}

.main-container {
    padding: 20px 5%;
}

.horizontal-scroll {
    display: flex;
    flex-wrap: nowrap;
    gap: 25px;
    overflow-x: auto;
    padding: 10px 0 30px 0;
    scrollbar-width: none;
}

.horizontal-scroll::-webkit-scrollbar {
    display: none;
}


/* Produk Card */

.product-card {
    flex: 0 0 400px;
    background-color: #7286D3;
    border-radius: 30px;
    padding: 50px;
    display: flex;
    flex-direction: row;
    justify-content: space-between;
    align-items: stretch;
    color: white;
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
    gap: 15px;
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

.btn-cart{
    margin-top:10px;
    background:#ffcc00;
    border:none;
    padding:8px 20px;
    border-radius:20px;
    cursor:pointer;
    font-weight:600;
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

</style>
</head>



<body class="dashboard-body">
    <div id="overlay" class="overlay" onclick="closeNav()"></div>

    <div id="mySidebar" class="sidebar">
        <div class="sidebar-content">
            <a href="dashboard_consument.blade.php" onclick="closeNav()">Menu Makanan</a>
            <a href="status_pesanan.blade.php">Status Pesanan</a>
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
        <div>Hallo, Nama Pengguna</div>
        <div class="profile"></div>
    </div>

</div>

    <div class="main-container">
        <h2>Makanan</h2>
        <div class="horizontal-scroll">
            <div class="product-card">
                <div class="card-info"> </div>
                <div class="card-action"> </div>
            </div>

            <div class="product-card">
                <div class="card-info"> </div>
                <div class="card-action"> </div>
            </div>

            <div class="product-card">
                <div class="card-info"> </div>
                <div class="card-action"> </div>
            </div>

            <div class="product-card">
                <div class="card-info"> </div>
                <div class="card-action"> </div>
            </div>
        </div>

        <h2>Minuman</h2>
        <div class="horizontal-scroll">
            <div class="product-card">
                <div class="card-info"> </div>
                <div class="card-action"> </div>
            </div>

            <div class="product-card">
                <div class="card-info"> </div>
                <div class="card-action"> </div>
            </div>

            <div class="product-card">
                <div class="card-info"> </div>
                <div class="card-action"> </div>
            </div>

            <div class="product-card">
                <div class="card-info"> </div>
                <div class="card-action"> </div>
            </div>
        </div>
    </div>

<div class="container">

    <div class="alert" id="alertBox">
        Produk berhasil ditambahkan ke cart
    </div>

    <!-- MAKANAN
    <div class="category-title">
        Makanan & Minuman
    </div> -->

    <div class="menu-grid" id="menuGrid">

    </div>

</div>

<script>

const API_PRODUCTS = "http://127.0.0.1:8000/api/products";
const API_CART = "http://127.0.0.1:8000/api/carts";

// ================= GET PRODUCTS =================
async function getProducts(){

    try{

        const response = await fetch(API_PRODUCTS);

        const result = await response.json();

        console.log(result);

        const menuGrid = document.getElementById("menuGrid");

        menuGrid.innerHTML = "";

        result.data.forEach(product => {

            const card = document.createElement("div");

            card.className = "card";

            card.innerHTML = `
            
                <div class="card-left">

                    <div class="menu-name">
                        ${product.nama_menu}
                    </div>

                    <div class="menu-desc">
                        ${product.deskripsi ?? 'Menu tersedia'}
                    </div>

                    <div class="menu-price">
                        Rp. ${Number(product.harga).toLocaleString('id-ID')}
                    </div>

                </div>

                <div class="card-right">

                    <img src="https://picsum.photos/200/200?random=${product.id}">

                    <button class="btn-cart"
                        onclick="addToCart(${product.id})">
                        Tambah
                    </button>

                </div>

            `;

            menuGrid.appendChild(card);

        });

    } catch(error){

        console.log(error);

    }

}

// ================= ADD TO CART =================
async function addToCart(productId){

    try{

        const response = await fetch(API_CART, {
            method:'POST',
            headers:{
                'Content-Type':'application/json',
                'Accept':'application/json'
            },
            body: JSON.stringify({
                product_id: productId,
                qty: 1
            })
        });

        const result = await response.json();

        console.log(result);

        if(response.ok){

            const alertBox = document.getElementById("alertBox");

            alertBox.style.display = "block";

            setTimeout(() => {
                alertBox.style.display = "none";
            }, 2000);

        } else {

            alert("Gagal tambah ke cart");

        }

    } catch(error){

        console.log(error);

        alert("Server Error");

    }

}

// AUTO LOAD
getProducts();

/*NAVBAR*/
function openNav() 
{
    document.getElementById("mySidebar").style.width = "250px";
    document.getElementById("overlay").style.display = "block";
}

 function closeNav()
{
    document.getElementById("mySidebar").style.width = "0";
    document.getElementById("overlay").style.display = "none";
}


</script>

</body>
</html>