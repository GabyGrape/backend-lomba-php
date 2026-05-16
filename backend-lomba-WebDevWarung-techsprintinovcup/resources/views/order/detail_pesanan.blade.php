<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@700&family=Poppins:wght@400;600&display=swap" rel="stylesheet">
<style>
* { margin:0; padding:0; box-sizing:border-box; font-family:'Poppins',sans-serif; }
body { background-color:#f5f5f5; min-height:100vh; display:flex; flex-direction:column; position:relative; }
.btn-back {
    position:fixed; top:12px; left:12px;
    width:40px; height:40px;
    display:flex; justify-content:center; align-items:center;
    background-color:#001a57; border-radius:50%;
    box-shadow:0 4px 10px rgba(0,0,0,0.2);
    transition:0.3s; text-decoration:none; z-index:10;
}
.btn-back svg { width:22px; height:22px; }
.btn-back:hover { background-color:#7286D3; transform:scale(1.1); }
.content {
    display:flex; flex-direction:row;
    align-items:flex-start; gap:40px;
    padding:20px 40px 140px 40px;
    max-width:900px; margin:0 auto; width:100%;
}
.image-container {
    flex:0 0 380px;
    border:5px solid #7286D3;
    border-radius:40px; overflow:hidden;
    aspect-ratio:1/1;
    display:flex; justify-content:center; align-items:center;
    background:#dde2f5;
}
.image-container img { width:100%; height:100%; object-fit:cover; }
.info-container { flex:1; padding-top:10px; }
.product-name { color:#ffb800; font-size:44px; font-family:'Montserrat',sans-serif; margin-bottom:10px; line-height:1.1; }
.product-desc { color:#7286D3; font-size:16px; margin-bottom:25px; }
.price-tag { color:#7286D3; font-size:26px; font-weight:bold; margin-bottom:20px; display:block; }
.qty-box {
    display:inline-flex; align-items:center; gap:20px;
    background:#f0f0f0; padding:10px 22px;
    border-radius:12px; margin-bottom:25px;
}
.qty-btn {
    background:#001a57; border:none;
    width:32px; height:32px; border-radius:50%;
    font-size:20px; color:white;
    cursor:pointer; display:flex;
    align-items:center; justify-content:center;
    transition:0.2s; line-height:1;
}
.qty-btn:hover { background:#7286D3; }
.qty-count { font-size:20px; font-weight:700; color:#001a57; min-width:28px; text-align:center; }
.cart-summary {
    background:white; border-radius:15px;
    padding:14px 16px;
    box-shadow:0 2px 10px rgba(0,0,0,0.07);
    margin-bottom:10px;
    max-height:160px; overflow-y:auto;
}
.cart-summary-title { font-size:12px; font-weight:700; color:#001a57; margin-bottom:8px; }
.cart-summary-item {
    display:flex; justify-content:space-between;
    align-items:center; font-size:13px;
    padding:5px 0; border-bottom:1px solid #f0f0f0; gap:8px;
}
.cart-summary-item:last-child { border-bottom:none; }
.item-name { color:#333; flex:1; }
.item-qty  { color:#7286D3; font-weight:600; white-space:nowrap; }
.item-price{ color:#001a57; font-weight:700; white-space:nowrap; }
.item-del  { background:none; border:none; color:#cc0000; cursor:pointer; font-size:14px; }
.cart-empty { font-size:12px; color:#aaa; text-align:center; padding:8px 0; }
.footer-nav {
    position:fixed; left:0; bottom:0; right:0;
    background:rgba(245,245,245,0.97);
    backdrop-filter:blur(6px);
    padding:16px 40px;
    box-shadow:0 -4px 15px rgba(0,0,0,0.08);
    z-index:100;
}
.footer-inner {
    display:flex; justify-content:space-between;
    align-items:center; max-width:900px; margin:auto;
}
.total-text { color:#7286D3; font-size:20px; font-weight:700; }
.footer-btns { display:flex; gap:12px; }
.btn-cancel { background:#cc0000; color:white; padding:13px 24px; border-radius:12px; border:none; cursor:pointer; font-weight:700; font-size:14px; transition:0.2s; }
.btn-cancel:hover { background:#e60000; }
.btn-dark { background:#001a57; color:white; padding:13px 28px; border-radius:12px; border:none; cursor:pointer; font-weight:700; font-size:14px; font-family:'Poppins',sans-serif; transition:0.2s; }
.btn-dark:hover { background:#7286D3; }
.btn-pay { background:#ffb800; color:#001a57; padding:13px 28px; border-radius:12px; border:none; cursor:pointer; font-weight:700; font-size:14px; font-family:'Poppins',sans-serif; transition:0.2s; }
.btn-pay:hover { background:#ffd740; }
.btn-pay:disabled { background:#ccc; color:#888; cursor:not-allowed; }
.modal-overlay {
    position:fixed; top:0; left:0; width:100%; height:100%;
    background:rgba(0,0,0,0.6); z-index:2000;
    display:none; align-items:center; justify-content:center;
}
.modal-overlay.show { display:flex; }
.modal-box { background:white; border-radius:24px; padding:40px; text-align:center; max-width:340px; width:90%; }
.modal-icon { font-size:56px; margin-bottom:12px; }
.modal-box h3 { font-size:18px; color:#001a57; margin-bottom:8px; }
.modal-box p  { font-size:13px; color:#666; margin-bottom:22px; }
.btn-ok { background:#001a57; color:white; border:none; padding:12px 36px; border-radius:30px; font-size:14px; font-weight:700; cursor:pointer; font-family:'Poppins',sans-serif; }
.toast { position:fixed; top:15px; right:15px; background:#1fae4b; color:white; padding:10px 18px; border-radius:10px; font-size:13px; font-weight:600; display:none; z-index:9999; }
.toast.err { background:#cc0000; }
</style>
</head>
<body>

<a href="/dashboard/consument" class="btn-back">
    <svg viewBox="0 0 24 24" fill="none">
        <path d="M15 19L8 12L15 5" stroke="white" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/>
    </svg>
</a>

<div class="toast" id="toast"></div>

<div class="content">
    <div class="image-container">
        <img id="productImg" src="" alt="Menu">
    </div>
    <div class="info-container">
        <div class="product-name" id="productName">-</div>
        <div class="product-desc" id="productDesc">-</div>
        <span class="price-tag" id="productPrice">Rp. 0</span>
        <div class="qty-box">
            <button class="qty-btn" onclick="changeQty(-1)">−</button>
            <span class="qty-count" id="qtyCount">1</span>
            <button class="qty-btn" onclick="changeQty(1)">+</button>
        </div>
        <div class="cart-summary" id="cartSummary">
            <div class="cart-summary-title">🛒 Pesanan kamu</div>
            <div class="cart-empty" id="cartEmptyNote">Belum ada item</div>
        </div>
    </div>
</div>

<div class="footer-nav">
    <div class="footer-inner">
        <span class="total-text" id="displayTotal">Total Belanja Rp. 0</span>
        <div class="footer-btns">
            <button class="btn-cancel" onclick="batalBeli()">Batal Beli</button>
            <button class="btn-dark" onclick="tambahKeCart()">Tambah Menu</button>
            <button class="btn-pay" id="btnBayar" onclick="checkout()">Pembayaran</button>
        </div>
    </div>
</div>

<div class="modal-overlay" id="modalSukses">
    <div class="modal-box">
        <div class="modal-icon">✅</div>
        <h3>Pesanan Berhasil!</h3>
        <p>Pesanan kamu sudah masuk. Silakan lakukan pembayaran via QRIS.</p>
        <button class="btn-ok" onclick="window.location.href='/halaman-pembayaran'">Lihat QRIS →</button>
    </div>
</div>

<script>
// ================= INIT =================
const user  = JSON.parse(localStorage.getItem("user"));
const token = localStorage.getItem("token");
if (!user || !token) window.location.href = "/login";

const API_ORDERS  = "http://127.0.0.1:8000/api/orders";
const MERCHANT_ID = 1;

const selectedProduct = JSON.parse(localStorage.getItem("selected_product") || "null");
if (!selectedProduct) window.location.href = "/dashboard/consument";

// Ambil cart yang sudah ada — JANGAN auto-push saat halaman dibuka
let cart = JSON.parse(localStorage.getItem("detail_cart") || "[]");

// Qty default = 1, TIDAK sinkron dengan cart (cart hanya diupdate saat tombol ditekan)
let qty = 1;

// ================= LOAD PRODUK =================
document.getElementById("productName").textContent  = selectedProduct.nama_menu;
document.getElementById("productDesc").textContent  = selectedProduct.deskripsi || "Menu tersedia";
document.getElementById("productPrice").textContent = "Rp. " + Number(selectedProduct.harga).toLocaleString('id-ID');
document.getElementById("productImg").src = selectedProduct.gambar_url || `https://picsum.photos/400/400?random=${selectedProduct.id}`;
document.getElementById("qtyCount").textContent = qty;

// ================= QTY =================
function changeQty(delta) {
    qty = Math.max(1, qty + delta);
    document.getElementById("qtyCount").textContent = qty;
}

// ================= TAMBAH KE CART =================
// Hanya dipanggil saat tombol "Tambah Menu" ditekan
function tambahKeCart() {
    const existing = cart.find(i => i.id == selectedProduct.id);

    if (existing) {
        existing.qty += qty; // tambah qty ke item yang sudah ada
    } else {
        cart.push({
            id:    selectedProduct.id,
            nama:  selectedProduct.nama_menu,
            harga: Number(selectedProduct.harga),
            qty:   qty
        });
    }

    localStorage.setItem("detail_cart", JSON.stringify(cart));
    showToast("Menu ditambahkan ke pesanan");

    // Reset qty ke 1 setelah tambah
    qty = 1;
    document.getElementById("qtyCount").textContent = qty;

    // Kembali ke dashboard pilih menu lain
    setTimeout(() => window.location.href = "/dashboard/consument", 500);
}

// ================= RENDER CART =================
function renderCart() {
    const summary   = document.getElementById("cartSummary");
    const emptyNote = document.getElementById("cartEmptyNote");

    summary.querySelectorAll(".cart-summary-item").forEach(el => el.remove());

    if (cart.length === 0) {
        emptyNote.style.display = "block";
        document.getElementById("displayTotal").textContent = "Total Belanja Rp. 0";
        return;
    }

    emptyNote.style.display = "none";
    let total = 0;

    cart.forEach((item, idx) => {
        total += item.harga * item.qty;
        const row = document.createElement("div");
        row.className = "cart-summary-item";
        row.innerHTML = `
            <span class="item-name">${item.nama}</span>
            <span class="item-qty">x${item.qty}</span>
            <span class="item-price">Rp. ${Number(item.harga * item.qty).toLocaleString('id-ID')}</span>
            <button class="item-del" onclick="removeItem(${idx})">🗑</button>
        `;
        summary.appendChild(row);
    });

    document.getElementById("displayTotal").textContent =
        "Total Belanja Rp. " + total.toLocaleString('id-ID');
}

function removeItem(idx) {
    cart.splice(idx, 1);
    localStorage.setItem("detail_cart", JSON.stringify(cart));
    renderCart();
}

function batalBeli() {
    if (!confirm("Yakin ingin membatalkan semua pesanan?")) return;
    cart = [];
    localStorage.removeItem("detail_cart");
    showToast("Pesanan dibatalkan");
    setTimeout(() => window.location.href = "/dashboard/consument", 500);
}

// ================= CHECKOUT =================
async function checkout() {
    // Kalau cart kosong, otomatis tambahkan produk yang sedang dilihat
    if (cart.length === 0) {
        cart.push({
            id:    selectedProduct.id,
            nama:  selectedProduct.nama_menu,
            harga: Number(selectedProduct.harga),
            qty:   qty
        });
        localStorage.setItem("detail_cart", JSON.stringify(cart));
        renderCart();
    }

    const btn = document.getElementById("btnBayar");
    btn.disabled    = true;
    btn.textContent = "Memproses...";

    const items = cart.map(i => ({
        product_id: i.id,
        quantity:   i.qty,
        price:      i.harga
    }));

    const total_price    = cart.reduce((sum, i) => sum + (i.harga * i.qty), 0);
    const pickupDate     = new Date(Date.now() + 30 * 60 * 1000);
    const pickup_plan_at = pickupDate.toISOString().slice(0, 19).replace("T", " ");

    const payload = {
        user_id:        user.id,
        merchant_id:    MERCHANT_ID,
        total_price:    total_price,
        pickup_plan_at: pickup_plan_at,
        items:          items
    };

    try {
        const res = await fetch(API_ORDERS, {
            method: "POST",
            headers: {
                "Content-Type":  "application/json",
                "Accept":        "application/json",
                "Authorization": `Bearer ${token}`
            },
            body: JSON.stringify(payload)
        });

        const result = await res.json();

        if (res.ok) {
            localStorage.setItem("order_total", total_price);
            localStorage.setItem("last_order",  JSON.stringify(result));

            // Simpan status awal pesanan = 1 (pending)
            const statuses = JSON.parse(localStorage.getItem("order_statuses") || "{}");
            const orderId  = result.data?.id || result.id;
            if (orderId) statuses[orderId] = 1;
            localStorage.setItem("order_statuses", JSON.stringify(statuses));

            cart = [];
            localStorage.removeItem("detail_cart");

            document.getElementById("modalSukses").classList.add("show");
        } else {
            showToast(result.message || "Gagal membuat pesanan", true);
        }

    } catch (err) {
        console.error(err);
        showToast("Tidak dapat terhubung ke server", true);
    } finally {
        btn.disabled    = false;
        btn.textContent = "Pembayaran";
    }
}

// ================= TOAST =================
function showToast(msg, isErr = false) {
    const t = document.getElementById("toast");
    t.textContent   = msg;
    t.className     = "toast" + (isErr ? " err" : "");
    t.style.display = "block";
    setTimeout(() => t.style.display = "none", 2000);
}

renderCart();
</script>
</body>
</html>