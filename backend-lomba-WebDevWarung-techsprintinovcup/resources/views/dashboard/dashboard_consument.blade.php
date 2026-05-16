<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Dashboard Konsumen</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<style>
*{ margin:0; padding:0; box-sizing:border-box; font-family:'Poppins',sans-serif; }
body{ background:#e9e9e9; }

/* ================= NAVBAR ================= */
.navbar{
    background-color:#001a57; color:white;
    padding:0 5%; display:flex;
    justify-content:space-between; align-items:center;
    position:sticky; top:0; z-index:100; height:70px;
}
.left-nav{ display:flex; align-items:center; gap:15px; }
.menu-icon{ font-size:24px; cursor:pointer; }
.logo{ font-size:28px; color:orange; font-weight:bold; }
.right-nav{ display:flex; align-items:center; gap:15px; color:white; }
.profile{ width:40px; height:40px; background:white; border-radius:50%; }

/* ================= SIDEBAR ================= */
.sidebar{
    height:100%; width:0; position:fixed;
    z-index:1001; top:0; left:0;
    background-color:#001a57; overflow-x:hidden;
    transition:0.5s; padding-top:60px;
    box-shadow:2px 0 10px rgba(0,0,0,0.3);
}
.sidebar-content{ display:flex; flex-direction:column; padding:20px; gap:15px; }
.sidebar-content a{
    padding:12px 20px; text-decoration:none; font-size:16px;
    color:white; background-color:rgba(255,255,255,0.1);
    border-radius:10px; display:block; transition:0.3s;
}
.sidebar-content a:hover{ background-color:#ffb800; color:#001a57; }
.overlay{
    display:none; position:fixed;
    width:100%; height:100%; top:0; left:0;
    background-color:rgba(0,0,0,0.5); z-index:1000;
}

/* ================= CONTAINER ================= */
.container{ padding:25px; }
.category-title{ font-size:22px; font-weight:700; color:#082567; margin:20px 0 12px; }
.menu-grid{ display:flex; gap:20px; flex-wrap:wrap; }

/* ================= CARD ================= */
.card{
    width:320px; background:#7488d8;
    border-radius:20px; padding:15px;
    display:flex; justify-content:space-between;
    align-items:center; color:white;
    position:relative; transition:0.3s ease;
}
.card.habis{ background:#aaaaaa; filter:grayscale(80%); }
.card-left{ width:55%; }
.menu-name{ font-size:22px; font-weight:700; color:#ffd400; line-height:1.1; }
.card.habis .menu-name{ color:#dddddd; }
.menu-desc{ font-size:12px; margin-top:5px; color:#f1f1f1; }
.menu-price{ margin-top:15px; font-size:18px; }
.card-right{ width:40%; text-align:center; }
.card-right img{ width:100%; height:110px; object-fit:cover; border-radius:15px; }
.badge-habis{
    display:none; position:absolute;
    top:12px; left:12px;
    background:#cc0000; color:white;
    font-size:10px; font-weight:700;
    padding:4px 10px; border-radius:20px; letter-spacing:1px;
}
.card.habis .badge-habis{ display:block; }
.btn-cart{
    margin-top:10px; background:#ffcc00;
    border:none; padding:8px 16px;
    border-radius:20px; cursor:pointer;
    font-weight:600; font-size:13px; transition:0.2s;
}
.btn-cart:hover{ background:#ffd740; }
.btn-cart:disabled{ background:#cccccc; color:#888; cursor:not-allowed; }


/* ================= ALERT ================= */
.alert-toast{
    position:fixed; top:80px; right:20px;
    background:#1fae4b; color:white;
    padding:12px 20px; border-radius:10px;
    font-size:13px; font-weight:600;
    display:none; z-index:9999;
    box-shadow:0 4px 15px rgba(0,0,0,0.2);
}
.alert-toast.error{ background:#cc0000; }

/* ================= MODAL SUKSES ================= */
.modal-overlay{
    position:fixed; top:0; left:0;
    width:100%; height:100%;
    background:rgba(0,0,0,0.6);
    z-index:2000; display:none;
    align-items:center; justify-content:center;
}
.modal-overlay.show{ display:flex; }
.modal-box{
    background:white; border-radius:24px;
    padding:40px; text-align:center;
    max-width:360px; width:90%;
    box-shadow:0 20px 60px rgba(0,0,0,0.3);
}
.modal-icon{ font-size:60px; margin-bottom:15px; }
.modal-box h3{ font-size:20px; color:#001a57; margin-bottom:8px; }
.modal-box p{ font-size:13px; color:#666; margin-bottom:25px; }
.modal-box .btn-ok{
    background:#001a57; color:white;
    border:none; padding:12px 40px;
    border-radius:30px; font-size:15px;
    font-weight:700; cursor:pointer;
}
</style>
</head>
<body>

<div id="sidebarOverlay" class="overlay" onclick="closeNav()"></div>

<div id="mySidebar" class="sidebar">
    <div class="sidebar-content">
        <a href="/dashboard/consument" onclick="closeNav()">🍱 Menu</a>
        <a href="/status-pesanan">📦 Status Pesanan</a>
        <a href="/history-pemesan">🕑 Riwayat Pesanan</a>
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

<!-- ALERT TOAST -->
<div class="alert-toast" id="alertToast"></div>

<!-- CONTENT -->
<div class="container">
    <div class="category-title">🍱 Makanan</div>
    <div class="menu-grid" id="gridMakanan"></div>

    <div class="category-title">🥤 Minuman</div>
    <div class="menu-grid" id="gridMinuman"></div>
</div>

<!-- MODAL ORDER SUKSES -->
<div class="modal-overlay" id="modalSukses">
    <div class="modal-box">
        <div class="modal-icon">✅</div>
        <h3>Pesanan Berhasil!</h3>
        <p id="modalMsg">Pesanan kamu sudah masuk. Silakan lakukan pembayaran via QRIS.</p>
        <button class="btn-ok" onclick="window.location.href='/halaman-pembayaran'">
            Lihat QRIS
        </button>
    </div>
</div>

<script>

// ================= INIT =================
const user  = JSON.parse(localStorage.getItem("user"));
const token = localStorage.getItem("token");

if (!user || !token) window.location.href = "/login";

document.getElementById("namaUser").textContent = `Hallo, ${user.name}`;

const API_PRODUCTS = "http://127.0.0.1:8000/api/products";
const API_ORDERS   = "http://127.0.0.1:8000/api/orders";
const MERCHANT_ID  = 1; // sesuaikan dengan merchant_id yang aktif

// Semua produk disimpan di sini biar bisa dicari saat pilih menu
let allProducts = [];

// Cart di memory
let cart = [];

function getProdukHabis(){
    const data = localStorage.getItem("produk_habis");
    return data ? new Set(JSON.parse(data)) : new Set();
}

// ================= GET PRODUCTS =================
async function getProducts(){
    try{
        const res    = await fetch(API_PRODUCTS, {
            headers:{ 'Accept':'application/json', 'Authorization':`Bearer ${token}` }
        });
        const result  = await res.json();
        allProducts   = result.data; // simpan semua produk
        const habisSet    = getProdukHabis();
        const storeOpen = localStorage.getItem("store_open") === "1";
        const gridMakanan = document.getElementById("gridMakanan");
        const gridMinuman = document.getElementById("gridMinuman");
        gridMakanan.innerHTML = "";
        gridMinuman.innerHTML = "";

        result.data.forEach(p => {
            const isHabis = habisSet.has(p.id);
            const isStoreClosed = !storeOpen;
            const imgSrc  = p.gambar_url || `https://picsum.photos/200/200?random=${p.id}`;

            const card = document.createElement("div");
            card.className =
            "card" +
            ((isHabis || isStoreClosed) ? " habis" : "");
            card.innerHTML = `
                <div class="badge-habis">
                    ${isStoreClosed ? 'TUTUP' : 'HABIS'}
                </div>
                <div class="card-left">
                    <div class="menu-name">${p.nama_menu}</div>
                    <div class="menu-desc">${p.deskripsi ?? 'Menu tersedia'}</div>
                    <div class="menu-price">Rp. ${Number(p.harga).toLocaleString('id-ID')}</div>
                </div>
                <div class="card-right">
                    <img src="${imgSrc}" alt="${p.nama_menu}">
                   <button class="btn-cart"
                        onclick="pilihMenu(${p.id})"
                        ${(isHabis || isStoreClosed) ? 'disabled' : ''}>
                        ${isStoreClosed ? 'Tutup' : (isHabis ? 'Habis' : 'Tambah')}
                    </button>
                </div>
            `;

            if(p.category_id === 1) gridMakanan.appendChild(card);
            else gridMinuman.appendChild(card);
        });

    } catch(err){ console.error(err); }
}

// ================= PILIH MENU → halaman detail =================
function pilihMenu(id){
    const produk = allProducts.find(p => p.id === id);
    if(!produk) return;
    localStorage.setItem("selected_product", JSON.stringify(produk));
    window.location.href = "/detail-pesanan";
}

// ================= TOAST =================
function showToast(msg, isError = false){
    const toast = document.getElementById("alertToast");
    toast.textContent = msg;
    toast.className   = "alert-toast" + (isError ? " error" : "");
    toast.style.display = "block";
    setTimeout(() => { toast.style.display = "none"; }, 2500);
}

// ================= SIDEBAR =================
function openNav(){
    document.getElementById("mySidebar").style.width = "250px";
    document.getElementById("sidebarOverlay").style.display = "block";
}
function closeNav(){
    document.getElementById("mySidebar").style.width = "0";
    document.getElementById("sidebarOverlay").style.display = "none";
}

// AUTO LOAD
getProducts();

</script>
</body>
</html>