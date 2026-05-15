git <!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Tambah Menu</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
<style>

*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family:'Poppins', sans-serif;
}

body{
    margin:0;
    background:#efefef;
}

html, body{
    width:100%;
    height:100%;
}

/* ================= PAGE TITLE ================= */
.page-title{
    font-size:13px;
    font-weight:500;
    color:#333;
    padding:10px 16px 6px;
    background:#efefef;
}

/* ================= NAVBAR ================= */
.navbar{
    width:100%;
    background:#002b7f;
    padding:10px 20px;
    display:flex;
    align-items:center;
    gap:8px;
}

.nav-icons{
    display:flex;
    align-items:center;
    gap:8px;
    flex:1;
}

.nav-item{
    display:flex;
    flex-direction:column;
    align-items:center;
    gap:3px;
    cursor:pointer;
}

.nav-circle{
    width:50px;
    height:50px;
    border-radius:50%;
    background:#001f5b;
    border:2.5px solid #ffffff;
    display:flex;
    align-items:center;
    justify-content:center;
}

.nav-circle svg{
    width:22px;
    height:22px;
    stroke:white;
    fill:none;
}

.nav-circle.active{
    background:#f5b800;
    border-color:#f5b800;
}

.nav-circle.active svg{
    stroke:#001f5b;
}

.nav-label{
    font-size:9px;
    color:white;
    font-weight:500;
    text-align:center;
}

.nav-user{
    display:flex;
    align-items:center;
    gap:10px;
    margin-left:auto;
}

.nav-user-text{
    font-size:13px;
    color:white;
    font-weight:500;
}

.nav-avatar{
    width:42px;
    height:42px;
    border-radius:50%;
    background:#ccd6f6;
    border:2px solid white;
    display:flex;
    align-items:center;
    justify-content:center;
}

.nav-avatar svg{
    width:24px;
    height:24px;
    fill:#001f5b;
}

/* ================= CONTENT ================= */
.content{
    background:#ffffff;
    width:100%;
    min-height:calc(100vh - 90px);
    padding:30px 40px 40px;
    display:flex;
    gap:40px;
    align-items:flex-start;
}

/* ================= LEFT ================= */
.left{
    flex:1;
}

.section-title{
    font-size:22px;
    font-weight:800;
    color:#f5b800;
    text-transform:uppercase;
    letter-spacing:0.5px;
    margin-bottom:20px;
}

/* ================= FORM ================= */
.field{
    margin-bottom:12px;
}

.field input{
    width:100%;
    padding:13px 18px;
    border:none;
    border-radius:10px;
    background:#001f5b;
    color:white;
    font-size:14px;
    font-family:'Poppins', sans-serif;
    outline:none;
}

.field input::placeholder{
    color:#7da0e0;
}

/* ================= CATEGORY ================= */
.cat-toggle{
    display:flex;
    gap:12px;
    margin-top:4px;
}

.cat-btn{
    flex:1;
    padding:13px 0;
    border-radius:10px;
    border:2px solid rgba(255,255,255,0.2);
    background:#001f5b;
    color:#7da0e0;
    font-family:'Poppins', sans-serif;
    font-size:14px;
    font-weight:700;
    cursor:pointer;
    transition:all 0.2s;
    text-align:center;
}

.cat-btn.active{
    background:#f5b800;
    border-color:#f5b800;
    color:#001f5b;
}

/* ================= RIGHT: IMAGE ================= */
.right{
    flex-shrink:0;
}

.image-box{
    width:220px;
    height:220px;
    border:5px solid #001f5b;
    border-radius:20px;
    background:#c8d0e0;
    display:flex;
    flex-direction:column;
    align-items:center;
    justify-content:center;
    cursor:pointer;
    overflow:hidden;
}

.image-box img#preview{
    width:100%;
    height:100%;
    object-fit:cover;
    display:none;
}

.img-placeholder{
    display:flex;
    flex-direction:column;
    align-items:center;
    gap:6px;
}

.plus-icon{
    font-size:54px;
    color:#8898aa;
    font-weight:300;
    line-height:1;
}

.img-label{
    font-size:12px;
    color:#8898aa;
    font-weight:500;
}

#fileInput{ display:none; }

/* ================= BUTTON ================= */
.btn-area{
    display:flex;
    justify-content:center;
    gap:14px;
    padding:30px 0 10px;
    width:100%;
}

.btn-batal{
    background:transparent;
    color:#001f5b;
    border:2.5px solid #001f5b;
    padding:13px 50px;
    border-radius:30px;
    font-size:17px;
    font-weight:800;
    font-family:'Poppins', sans-serif;
    cursor:pointer;
    letter-spacing:1px;
}

.btn-batal:hover{ background:#f0f0f0; }

.btn-input{
    background:#f5b800;
    color:#001f5b;
    border:none;
    padding:13px 80px;
    border-radius:30px;
    font-size:17px;
    font-weight:800;
    font-family:'Poppins', sans-serif;
    cursor:pointer;
    letter-spacing:1px;
}

.btn-input:hover{ opacity:0.9; }

/* ================= STATUS ================= */
#statusMsg{
    font-size:12px;
    font-weight:600;
    padding:8px 16px;
    border-radius:8px;
    display:none;
    margin-top:10px;
    text-align:center;
    color:white;
}
#statusMsg.success{ background:rgba(26,200,100,0.15); color:#1a9b5a; }
#statusMsg.error  { background:rgba(220,50,50,0.15); color:#d63030; }

</style>
</head>
<body>

<!-- PAGE TITLE -->
<div class="page-title">Tambah Menu</div>

<!-- NAVBAR -->
<div class="navbar">
    <div class="nav-icons">

        <div class="nav-item" onclick="window.location.href='/dashboard/seller'">
            <div class="nav-circle">
                <svg viewBox="0 0 24 24" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M3 9.75L12 3l9 6.75V20a1 1 0 01-1 1H4a1 1 0 01-1-1V9.75z"/>
                    <path d="M9 21V12h6v9"/>
                </svg>
            </div>
            <div class="nav-label">Dashboard</div>
        </div>

        <div class="nav-item">
            <div class="nav-circle active">
                <svg viewBox="0 0 24 24" stroke-width="2.5" stroke-linecap="round">
                    <path d="M12 5v14M5 12h14"/>
                </svg>
            </div>
            <div class="nav-label">Tambah Menu</div>
        </div>

        <div class="nav-item">
            <div class="nav-circle">
                <svg viewBox="0 0 24 24" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <rect x="3" y="3" width="18" height="18" rx="2"/>
                    <path d="M3 9h18M9 21V9"/>
                    <path d="M7 13h2M7 17h2M13 13h4M13 17h4"/>
                </svg>
            </div>
            <div class="nav-label">Laporan Keuangan</div>
        </div>

        <div class="nav-item">
            <div class="nav-circle">
                <svg viewBox="0 0 24 24" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M12 4v8l4 2"/>
                    <circle cx="12" cy="12" r="9"/>
                </svg>
            </div>
            <div class="nav-label">Riwayat Pesanan</div>
        </div>

    </div>

    <div class="nav-user">
        <div class="nav-user-text">Hallo, Nama Pengguna</div>
        <div class="nav-avatar">
            <svg viewBox="0 0 24 24"><path d="M12 12c2.7 0 4.8-2.1 4.8-4.8S14.7 2.4 12 2.4 7.2 4.5 7.2 7.2 9.3 12 12 12zm0 2.4c-3.2 0-9.6 1.6-9.6 4.8v2.4h19.2v-2.4c0-3.2-6.4-4.8-9.6-4.8z"/></svg>
        </div>
    </div>
</div>

<!-- CONTENT -->
<div class="content">

    <!-- LEFT -->
    <div class="left">
        <div class="section-title">Input Menu Kamu</div>

        <div class="field">
            <input type="text" id="nama_menu" placeholder="Nama Menu" required>
        </div>

        <div class="field">
            <input type="text" id="deskripsi" placeholder="Deskripsi Singkat">
        </div>

        <div class="field">
            <input type="number" id="harga" placeholder="Harga" required min="0">
        </div>

        <div class="field">
            <input type="number" id="stok" placeholder="Stok" required min="0">
        </div>

        <!-- KATEGORI -->
        <div class="cat-toggle">
            <button type="button" class="cat-btn active" data-id="1" onclick="selectCat(this)">🍱 Makanan</button>
            <button type="button" class="cat-btn" data-id="2" onclick="selectCat(this)">🥤 Minuman</button>
        </div>

        <div id="statusMsg"></div>

        <div class="btn-area">
            <button class="btn-batal" onclick="history.back()">BATAL</button>
            <button class="btn-input" onclick="submitForm()">INPUT</button>
        </div>
    </div>

    <!-- RIGHT: IMAGE -->
    <div class="right">
        <div class="image-box" onclick="document.getElementById('fileInput').click()">
            <div class="img-placeholder" id="imgPlaceholder">
                <div class="plus-icon">+</div>
                <div class="img-label">Input Foto Anda</div>
            </div>
            <img id="preview" src="" alt="Preview">
        </div>
        <input type="file" id="fileInput" accept="image/*">
    </div>

</div>

<script>
const API_URL = "http://localhost:8000/api/products";
const user = JSON.parse(localStorage.getItem("user"));
document.querySelector(".nav-user-text").textContent = `Hallo, ${user.name}`;
let selectedCategoryId = 1;
let selectedFile = null;

function selectCat(btn) {
    document.querySelectorAll('.cat-btn').forEach(b => b.classList.remove('active'));
    btn.classList.add('active');
    selectedCategoryId = parseInt(btn.dataset.id);
}

document.getElementById('fileInput').addEventListener('change', function(e) {
    const file = e.target.files[0];
    if (!file) return;
    selectedFile = file;

    const reader = new FileReader();
    reader.onload = function(ev) {
        const preview = document.getElementById('preview');
        preview.src = ev.target.result;
        preview.style.display = 'block';
        document.getElementById('imgPlaceholder').style.display = 'none';
    };
    reader.readAsDataURL(file);
});

async function submitForm() {
    const nama_menu = document.getElementById('nama_menu').value.trim();
    const deskripsi = document.getElementById('deskripsi').value.trim();
    const harga     = document.getElementById('harga').value;
    const stok      = document.getElementById('stok').value;

    if (!nama_menu || !harga || !stok) {
        showStatus('❌ Nama menu, harga, dan stok wajib diisi!', 'error');
        return;
    }

    const formData = new FormData();
    formData.append('nama_menu',   nama_menu);
    formData.append('deskripsi',   deskripsi);
    formData.append('harga',       Number(harga));
    formData.append('stok',        Number(stok));
    formData.append('category_id', selectedCategoryId);
    const user = JSON.parse(localStorage.getItem("user"));
        formData.append('user_id', user.id); 
            formData.append('status',      'tersedia');
    if (selectedFile) formData.append('gambar', selectedFile);

    const btn = document.querySelector('.btn-input');
    btn.textContent = 'Menyimpan...';
    btn.disabled = true;

    try {
       const token = localStorage.getItem("token");
        const res = await fetch(API_URL, {
            method: 'POST',
            headers: { 
                'Accept': 'application/json',
                'Authorization': `Bearer ${token}`  // ← tambah ini
            },
            body: formData
        });

        const result = await res.json();

        if (!res.ok) {
            showStatus('❌ ' + (result.message || JSON.stringify(result)), 'error');
            return;
        }

        showStatus('✅ Menu berhasil ditambahkan!', 'success');
        setTimeout(() => window.location.href = '/dashboard/seller', 1200);

    } catch (err) {
        console.error(err);
        showStatus('❌ Server error. Coba lagi.', 'error');
    } finally {
        btn.textContent = 'INPUT';
        btn.disabled = false;
    }
}

function showStatus(msg, type) {
    const el = document.getElementById('statusMsg');
    el.textContent = msg;
    el.className = type;
    el.style.display = 'block';
    setTimeout(() => el.style.display = 'none', 4000);
}
</script>

</body>
</html>