<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Dashboard Penjual</title>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<style>
*{ margin:0; padding:0; box-sizing:border-box; font-family:'Poppins',sans-serif; }
body{ margin:0; background:#f2f2f2; }
.wrapper{ width:100%; min-height:100vh; background:white; }

/* NAVBAR */
.navbar{ background:#002b7f; height:90px; display:flex; justify-content:space-between; align-items:center; padding:0 20px; }
.nav-menu{ display:flex; gap:25px; align-items:center; }
.menu-item{ text-align:center; color:white; font-size:10px; cursor:pointer; transition:transform 0.2s; }
.menu-item:hover{ transform:translateY(-3px); }
.circle-icon{ width:55px; height:55px; border-radius:50%; background:white; color:black; display:flex; justify-content:center; align-items:center; font-size:28px; margin:auto; margin-bottom:5px; font-weight:bold; }
.profile-section{ display:flex; align-items:center; gap:15px; color:white; }
.profile{ width:50px; height:50px; border-radius:50%; background:white; }
.qris-section{
    padding:30px;
}

.qris-box{
    background:white;
    padding:15px;
    border-radius:18px;
    width:190px;
    box-shadow:0 4px 15px rgba(0,0,0,0.08);
}

.qris-box img{
    width:100%;
    height:150px;
    object-fit:cover;
    border-radius:12px;
    margin-bottom:10px;
}

.qris-box input{
    margin-bottom:15px;
}

.qris-box button{
    width:100%;
    padding:9px;
    border:none;
    border-radius:10px;
    background:#0b2d75;
    color:white;
    font-weight:600;
    font-size:12px;
    cursor:pointer;
}
/* CONTENT */
.content{ padding:30px; }
.menu-title{ font-size:35px; font-weight:700; color:#333; margin-bottom:20px; }
.top-bar{ display:flex; justify-content:space-between; align-items:center; margin-bottom:25px; }
.kategori-title{
    font-size:24px;
    font-weight:700;
    margin-bottom:15px;
    color:#0b2d75;
}
/* SWITCH */
.switch{ width:70px; height:35px; background:#0b2d75; border-radius:30px; position:relative; cursor:pointer; padding:5px; }
.switch-circle{ width:25px; height:25px; background:red; border-radius:50%; position:absolute; left:5px; transition:0.3s; }
.switch.active .switch-circle{ left:40px; background:#00ff66; }

/* PRODUK GRID */
.grid{ display:flex; gap:20px; flex-wrap:wrap; }
.card{ width:220px; background:#7a8ed9; border-radius:20px; padding:10px; position:relative; overflow:hidden; transition:0.3s ease; }
.card.habis{ background:#aaaaaa; filter:grayscale(80%); }
.card img{ width:100%; height:140px; object-fit:cover; border-radius:15px; }
.title{ font-size:22px; font-weight:700; color:#ffd400; margin-top:8px; }
.card.habis .title{ color:#dddddd; }
.desc{ font-size:11px; color:white; min-height:30px; }
.price{ text-align:right; color:white; margin-top:10px; }
.badge-habis{ display:none; position:absolute; top:12px; left:12px; background:#cc0000; color:white; font-size:10px; font-weight:700; padding:4px 10px; border-radius:20px; letter-spacing:1px; }
.card.habis .badge-habis{ display:block; }
.action{ display:flex; gap:6px; margin-top:10px; flex-wrap:wrap; }
.btn{ flex:1; border:none; padding:8px; border-radius:10px; cursor:pointer; color:white; font-weight:600; font-size:12px; }
.edit{ background:orange; }
.delete{ background:red; }
.btn-habis{ width:100%; border:none; padding:7px; border-radius:10px; cursor:pointer; font-weight:600; font-size:11px; background:#333; color:white; margin-top:4px; transition:0.2s; }
.card.habis .btn-habis{ background:#1fae4b; }
.empty-state{ width:100%; text-align:center; padding:60px 20px; color:#888; font-size:16px; }

/* PESANAN */
.order-section{ padding:0 30px 40px; }
.order-title{ font-size:28px; font-weight:700; margin-bottom:20px; color:#333; }
.order-grid{ display:flex; gap:15px; flex-wrap:wrap; }
.order-card{ width:220px; background:#7a8ed9; border-radius:18px; padding:10px; color:white; }
.order-card img{ width:100%; height:120px; object-fit:cover; border-radius:12px; }
.order-name{ font-size:18px; font-weight:700; color:#ffd400; margin-top:8px; }
.order-user{ font-size:11px; margin-top:3px; color:rgba(255,255,255,0.8); }
.order-total{ font-size:12px; font-weight:600; color:white; margin-top:4px; }
.order-action{ display:flex; gap:6px; margin-top:10px; }
.btn-terima{ flex:1; border:none; padding:7px; border-radius:20px; color:white; font-size:11px; font-weight:700; cursor:pointer; background:#14b814; }
.btn-tolak{ flex:1; border:none; padding:7px; border-radius:20px; color:white; font-size:11px; font-weight:700; cursor:pointer; background:#d90000; }
.btn-selesai{ width:100%; border:none; padding:8px; border-radius:20px; color:white; font-size:11px; font-weight:700; cursor:pointer; background:#0b2d75; margin-top:6px; transition:0.2s; }
.btn-selesai:hover{ background:#7286D3; }
.order-empty{ color:#777; font-size:14px; padding:20px 0; }
.order-list{
    margin-top:10px;
    display:flex;
    flex-direction:column;
    gap:6px;
}

.order-item{
    background:rgba(255,255,255,0.12);
    padding:7px 10px;
    border-radius:10px;
    font-size:12px;
    display:flex;
    justify-content:space-between;
    align-items:center;
}
/* Badge status */
.order-status-badge{ display:inline-block; font-size:10px; font-weight:700; padding:3px 10px; border-radius:20px; margin-top:5px; }
.badge-pending{ background:rgba(255,184,0,0.2); color:#ffb800; }
.badge-diterima{ background:rgba(20,184,20,0.2); color:#14b814; }
.badge-selesai{ background:rgba(255,255,255,0.15); color:white; }

/* MODAL */
.modal{ position:fixed; top:0; left:0; width:100%; height:100%; background:rgba(0,0,0,0.5); display:none; justify-content:center; align-items:center; z-index:999; }
.modal-box{ width:380px; background:white; padding:25px; border-radius:20px; }
.modal-box h3{ margin-bottom:20px; }
.modal-box input[type="text"], .modal-box input[type="number"]{ width:100%; padding:10px; margin-bottom:15px; border:1px solid #ccc; border-radius:10px; font-family:'Poppins',sans-serif; }
.edit-img-wrap{ width:100%; height:150px; border-radius:12px; overflow:hidden; margin-bottom:12px; cursor:pointer; position:relative; border:2px dashed #aaa; display:flex; align-items:center; justify-content:center; background:#f5f5f5; }
.edit-img-wrap img{ width:100%; height:100%; object-fit:cover; display:block; }
.edit-img-overlay{ position:absolute; bottom:0; left:0; right:0; background:rgba(0,0,0,0.45); color:white; text-align:center; font-size:12px; padding:6px; }
.modal-action{ display:flex; gap:10px; margin-top:5px; }
.modal-action button{ flex:1; padding:10px; border:none; border-radius:10px; cursor:pointer; font-family:'Poppins',sans-serif; font-weight:600; }
.save{ background:#0b2d75; color:white; }
.cancel{ background:#ccc; }

/* Toast */
.toast{ position:fixed; top:15px; right:15px; background:#1fae4b; color:white; padding:10px 18px; border-radius:10px; font-size:13px; font-weight:600; display:none; z-index:9999; box-shadow:0 4px 15px rgba(0,0,0,0.2); }
.toast.err{ background:#cc0000; }

/* ===== MOBILE ===== */
@media (max-width: 768px) {
    .navbar {
        height: auto;
        flex-direction: column;
        padding: 15px;
        gap: 12px;
    }
    .nav-menu {
        gap: 10px;
        flex-wrap: wrap;
        justify-content: center;
    }
    .circle-icon {
        width: 44px;
        height: 44px;
        font-size: 22px;
    }
    .profile-section { width: 100%; justify-content: center; }

    .content, .order-section, .qris-section { padding: 15px; }
    .grid, .order-grid { gap: 12px; }
    .card, .order-card { width: 100%; }

    .qris-box { width: 100%; }
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
            <div class="menu-item" onclick="window.location.href='/halaman-labarugi'">
                <div class="circle-icon">💰</div>
                Laporan
            </div>
            <div class="menu-item" onclick="window.location.href='/history-penjual'">
                <div class="circle-icon">⟳</div>
                Pesanan
            </div>
        </div>
        <div class="profile-section">
            <div id="namaUser">Hallo, ...</div>
            <div class="profile"></div>
        </div>
    </div>
<div class="qris-section">
    <h2>QRIS Pembayaran</h2>

    <div class="qris-box">
        <img id="qrisPreview"
             src="https://via.placeholder.com/250x250?text=Upload+QRIS">

        <input type="file"
               id="qrisFile"
               accept="image/*">

        <button onclick="uploadQris()">
            Upload QRIS
        </button>
    </div>
</div>

<!-- PESANAN -->
    <div class="order-section">
        <div class="order-title">Daftar Pesanan</div>
        <div class="order-grid" id="orderGrid"></div>
    </div>
    <!-- PRODUK -->
    <div class="content">
        <div class="top-bar">
            <div class="menu-title">MENU</div>
            <div class="switch" id="switchBtn" onclick="toggleSwitch()">
                <div class="switch-circle"></div>
            </div>
        </div>
        <h2 class="kategori-title">🍜 Makanan</h2>
        <div class="grid" id="makananGrid"></div>

        <h2 class="kategori-title" style="margin-top:40px;">🥤 Minuman</h2>
        <div class="grid" id="minumanGrid"></div>
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

<div class="toast" id="toast"></div>

<script>
// ================= INIT =================
const user  = JSON.parse(localStorage.getItem("user"));
const token = localStorage.getItem("token");
if (!user || !token) window.location.href = "/login";
document.getElementById("namaUser").innerHTML = `
    <div style="font-weight:700;">
        ${user.name}
    </div>
    <div style="font-size:12px;opacity:0.8;">
        Pedagang
    </div>
`;

const API_URL    = "https://backend-lomba-php.onrender.com/api/products";
const API_ORDERS = "https://backend-lomba-php.onrender.com/api/orders/merchant/{user_id}";
const API_BASE   = "https://backend-lomba-php.onrender.com/api/";
const authHeaders = {
    "Accept": "application/json",
    "Content-Type": "application/json",
    "Authorization": `Bearer ${token}`
};
let fallbackMenuImage = "";
let editSelectedFile = null;
const habisSet = new Set();

document.getElementById('edit_file').addEventListener('change', function(e) {
    const file = e.target.files[0];
    if (!file) return;
    editSelectedFile = file;
    const reader = new FileReader();
    reader.onload = ev => document.getElementById('edit_preview').src = ev.target.result;
    reader.readAsDataURL(file);
});

function showToast(msg, isErr = false) {
    const t = document.getElementById("toast");
    t.textContent   = msg;
    t.className     = "toast" + (isErr ? " err" : "");
    t.style.display = "block";
    setTimeout(() => t.style.display = "none", 2500);
}

// ================= PRODUK =================
async function getProducts() {
    try {
        const res    = await fetch(API_URL, { headers: authHeaders });
        const result = await res.json();
        const makananGrid = document.getElementById("makananGrid");
        const minumanGrid = document.getElementById("minumanGrid");

        makananGrid.innerHTML = "";
        minumanGrid.innerHTML = "";
        if (!result.data || result.data.length === 0) {
            makananGrid.innerHTML =
            '<div class="empty-state">Belum ada menu makanan.</div>';

        minumanGrid.innerHTML =
            '<div class="empty-state">Belum ada menu minuman.</div>';
                    return;
                }

        const firstWithImage = result.data.find(x => x.gambar_url);

        fallbackMenuImage =
            firstWithImage?.gambar_url || "";
        result.data.forEach(p => {

    const kategori = (p.category?.nama || "").toLowerCase();

    if (kategori.includes("minuman")) {
        renderCard(p, habisSet.has(p.id), "minumanGrid");
    } else {
        renderCard(p, habisSet.has(p.id), "makananGrid");
    }
});
    } catch(err) { console.error(err); }
}

function renderCard(p, isHabis, targetGrid) {

    const grid = document.getElementById(targetGrid);

    const imgSrc =
    p.gambar_url ||
    fallbackMenuImage ||
    "https://dummyimage.com/300x300/cccccc/000000&text=No+Image";
    const card = document.createElement("div");

    card.className = "card" + (isHabis ? " habis" : "");

    card.id = `card-${p.id}`;

    card.innerHTML = `
        <div class="badge-habis">HABIS</div>

        <img src="${imgSrc}" alt="${p.nama_menu}">

        <div class="title">${p.nama_menu}</div>

        <div class="desc">${p.deskripsi || ''}</div>

        <div class="price">
            Rp. ${Number(p.harga).toLocaleString('id-ID')}
        </div>

        <div class="action">
            <button class="btn edit"
                onclick="openEdit(${p.id},'${p.nama_menu}',${p.harga},${p.stok},'${imgSrc}')">
                Edit
            </button>

            <button class="btn delete"
                onclick="deleteProduct(${p.id})">
                Delete
            </button>
        </div>

        <button class="btn-habis"
            id="btn-habis-${p.id}"
            onclick="toggleHabis(${p.id})">

            ${isHabis ? '✅ Tandai Tersedia' : '🚫 Tandai Habis'}

        </button>
    `;

    grid.appendChild(card);
}

function toggleHabis(id) {
    const card = document.getElementById(`card-${id}`);
    const btn  = document.getElementById(`btn-habis-${id}`);
    if (habisSet.has(id)) {
        habisSet.delete(id);
        card.classList.remove("habis");
        btn.textContent = "🚫 Tandai Habis";
    } else {
        habisSet.add(id);
        card.classList.add("habis");
        btn.textContent = "✅ Tandai Tersedia";
    }
    localStorage.setItem("produk_habis", JSON.stringify([...habisSet]));
}

function goToCreate() { window.location.href = "/menu/create"; }

async function deleteProduct(id) {
    if (!confirm("Yakin hapus produk?")) return;
    const res = await fetch(`${API_URL}/${id}`, { method:'DELETE', headers: authHeaders });
    if (res.ok) { showToast("Berhasil hapus"); getProducts(); }
    else showToast("Gagal hapus", true);
}

function openEdit(id, nama, harga, stok, imgSrc) {
    editSelectedFile = null;
    document.getElementById("edit_file").value = "";
    document.getElementById("editModal").style.display = "flex";
    document.getElementById("edit_id").value    = id;
    document.getElementById("edit_nama").value  = nama;
    document.getElementById("edit_harga").value = harga;
    document.getElementById("edit_stok").value  = stok;
    document.getElementById("edit_preview").src = imgSrc;
}
function closeModal() { document.getElementById("editModal").style.display = "none"; }

async function updateProduct() {
    const id  = document.getElementById("edit_id").value;
    let res;
    if (editSelectedFile) {
        const fd = new FormData();
        fd.append('nama_menu', document.getElementById("edit_nama").value);
        fd.append('harga',     Number(document.getElementById("edit_harga").value));
        fd.append('stok',      Number(document.getElementById("edit_stok").value));
        fd.append('gambar',    editSelectedFile);
        fd.append('_method',   'PUT');
        res = await fetch(`${API_URL}/${id}`, { method:'POST', headers:{ 'Accept':'application/json','Authorization':`Bearer ${token}` }, body:fd });
    } else {
        res = await fetch(`${API_URL}/${id}`, { method:'PUT', headers: authHeaders, body: JSON.stringify({ nama_menu: document.getElementById("edit_nama").value, harga: Number(document.getElementById("edit_harga").value), stok: Number(document.getElementById("edit_stok").value) }) });
    }
    if (res.ok) { showToast("Berhasil update"); closeModal(); getProducts(); }
    else { const err = await res.json(); showToast("Gagal: " + (err.message || "Error"), true); }
}

// SWITCH
function toggleSwitch() {
    const s = document.getElementById("switchBtn");
    s.classList.toggle("active");
    localStorage.setItem("store_open", s.classList.contains("active") ? "1" : "0");
}
if (localStorage.getItem("store_open") === "1") document.getElementById("switchBtn").classList.add("active");

// ================= PESANAN =================
async function getOrders() {
    try {
        const res    = await fetch(API_ORDERS, { headers: authHeaders });
        const result = await res.json();
        const grid   = document.getElementById("orderGrid");
        grid.innerHTML = "";

        if (!result || result.length === 0) {
            grid.innerHTML = '<div class="order-empty">Belum ada pesanan masuk.</div>';
            return;
        }

        // Ambil status override dari localStorage
        const statuses = JSON.parse(localStorage.getItem("order_statuses") || "{}");

        result.forEach(order => {
            // Override status dari localStorage jika ada
            let statusId = statuses[order.id] ?? order.status_id;

            const items = order.items || [];

            if(items.length === 0) return;

            const firstProduct = items[0]?.product;
            const imgSrc  = firstProduct?.gambar_url || `https://picsum.photos/300/300?random=${order.id}`;
            const total   = "Rp. " + Number(order.total_price || 0).toLocaleString('id-ID');

            let statusBadge = '';
            let buttons     = '';

            if (statusId == 1) {
                // Pending — tampilkan tombol Terima & Tolak
                statusBadge = '<span class="order-status-badge badge-pending">⏳ Menunggu</span>';
                buttons = `
                    <button class="btn-terima" onclick="terimaOrder(${order.id})">TERIMA</button>
                    <button class="btn-tolak"  onclick="tolakOrder(${order.id})">TOLAK</button>
                `;
            } else if (statusId == 2) {
                // Diterima — tampilkan tombol Selesaikan
                statusBadge = '<span class="order-status-badge badge-diterima">✅ Diterima</span>';
                buttons = `<button class="btn-selesai" onclick="selesaikanOrder(${order.id})">🏁 Selesaikan Pesanan</button>`;
            } else {
                // Selesai — tidak ada tombol
                statusBadge = '<span class="order-status-badge badge-selesai">🎉 Selesai</span>';
                buttons = '';
            }

            grid.innerHTML += `
                <div class="order-card" id="order-card-${order.id}">
                    <img src="${imgSrc}" alt="menu">
                    <div class="order-list">
                        ${items.map(i => `
                            <div class="order-item">
                                <span>
                                    🍽 ${i.product?.nama_menu || 'Menu'}
                                </span>

                                <span>
                                    x${i.quantity}
                                </span>
                            </div>
                        `).join("")}
                    </div>
                    <div class="order-user">👤 ${order.customer?.name || 'Pemesan'}</div>
                    <div class="order-total">💰 ${total}</div>
                    ${statusBadge}
                    <div class="order-action" id="action-${order.id}">${buttons}</div>
                </div>
            `;
        });

    } catch(err) { console.error(err); }
}

// ================= TERIMA ORDER =================
function terimaOrder(id) {
    // Update localStorage — status 2 = diterima
    const statuses  = JSON.parse(localStorage.getItem("order_statuses") || "{}");
    statuses[id]    = 2;
    localStorage.setItem("order_statuses", JSON.stringify(statuses));
    showToast("Pesanan diterima ✅");
    getOrders(); // re-render
}

// ================= TOLAK ORDER =================
function tolakOrder(id) {
    if (!confirm("Yakin tolak pesanan ini?")) return;
    const statuses = JSON.parse(localStorage.getItem("order_statuses") || "{}");
    statuses[id]   = 5; // status tolak
    localStorage.setItem("order_statuses", JSON.stringify(statuses));
    showToast("Pesanan ditolak", true);
    getOrders();
}

// ================= SELESAIKAN ORDER =================
// POST /api/orders/{id}/complete + update status localStorage konsumen
async function selesaikanOrder(id) {
    if (!confirm("Selesaikan pesanan ini?")) return;

    try {
        const res = await fetch(`${API_BASE}orders/${id}/complete`, {
            method:  'POST',
            headers: authHeaders
        });

        if (res.ok) {
            const json = await res.json();

            // Update status di localStorage (dibaca oleh halaman status konsumen)
            const statuses = JSON.parse(localStorage.getItem("order_statuses") || "{}");
            statuses[id]   = 4; // selesai
            localStorage.setItem("order_statuses", JSON.stringify(statuses));

            const profit = json.data?.profit ?? 0;
            showToast(`Pesanan selesai! Profit: Rp ${Number(profit).toLocaleString('id-ID')} 🎉`);
            getOrders();
        } else {
            const err = await res.json();
            showToast("Gagal: " + (err.message || "Error"), true);
        }

    } catch(err) {
        console.error(err);
        showToast("Tidak dapat terhubung ke server", true);
    }
}
document.getElementById('qrisFile').addEventListener('change', function(e){
    const file = e.target.files[0];

    if(file){
        const reader = new FileReader();

        reader.onload = function(ev){
            document.getElementById('qrisPreview').src = ev.target.result;
        }

        reader.readAsDataURL(file);
    }
});

async function uploadQris(){

    const file = document.getElementById('qrisFile').files[0];

    if(!file){
        showToast("Pilih gambar QRIS dulu", true);
        return;
    }

    const fd = new FormData();
    fd.append("qris_image", file);

    try{

        const res = await fetch("https://backend-lomba-php.onrender.com/api/user/qris",{
            method:"POST",
            headers:{
                "Authorization": `Bearer ${token}`,
                "Accept":"application/json"
            },
            body:fd
        });

        const result = await res.json();
        console.log(result);
        if(res.ok){
            showToast("QRIS berhasil diupload ✅");
        }else{
            showToast(result.message || "Upload gagal", true);
        }

    }catch(err){
        console.error(err);
        showToast("Server error", true);
    }
}
getProducts();
getOrders();
</script>
</body>
</html>