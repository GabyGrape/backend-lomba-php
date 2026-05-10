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
<body>

<!-- NAVBAR -->
<div class="navbar">

    <div class="left-nav">
        <div class="menu-icon">☰</div>
        <div class="logo">🔥</div>
    </div>

    <div class="right-nav">
        <div>Hallo, Nama Pengguna</div>
        <div class="profile"></div>
    </div>

</div>

<div class="container">

    <div class="alert" id="alertBox">
        Produk berhasil ditambahkan ke cart
    </div>

    <!-- MAKANAN -->
    <div class="category-title">
        Makanan & Minuman
    </div>

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

</script>

</body>
</html>