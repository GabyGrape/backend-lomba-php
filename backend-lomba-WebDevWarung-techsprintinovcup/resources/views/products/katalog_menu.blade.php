<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Tambah Menu</title>

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
    background:#efefef;
}

/* ================= CONTAINER ================= */

.container{
    width:100%;
    min-height:100vh;
    background:#efefef;
}

html, body{
    width:100%;
    height:100%;
}

/* ================= NAVBAR ================= */

.navbar{
    width:100%;
    height:90px;
    background:#002b7f;
}

/* ================= CONTENT ================= */

.content{
    display:flex;
    align-items:center;
    justify-content:center;
    gap:60px;
    padding:60px;
}

/* ================= IMAGE BOX ================= */

.image-box{
    width:230px;
    height:230px;
    border:10px solid #002b7f;
    border-radius:25px;
    display:flex;
    justify-content:center;
    align-items:center;
    background:#efefef;
    cursor:pointer;
}

.plus{
    font-size:80px;
    color:#999;
    font-weight:bold;
}

/* ================= FORM ================= */

.form-box{
    width:450px;
}

.input-group{
    margin-bottom:18px;
}

.input-group input,
.input-group select{
    width:100%;
    padding:14px 18px;
    border:none;
    border-radius:15px;
    background:#002b7f;
    color:white;
    outline:none;
    font-size:14px;
}

.input-group input::placeholder{
    color:#d9d9d9;
}

/* ACTIVE INPUT */
.highlight{
    border:3px solid #008cff !important;
}

/* ================= BUTTON ================= */

.button-area{
    margin-top:40px;
    display:flex;
    justify-content:flex-end;
}

.btn-submit{
    background:#f5b800;
    color:white;
    border:none;
    padding:12px 50px;
    border-radius:30px;
    font-size:18px;
    font-weight:700;
    cursor:pointer;
}

.btn-submit:hover{
    opacity:0.9;
}

</style>
</head>

<body>

<div class="container">

    <!-- NAVBAR -->
    <div class="navbar"></div>

    <!-- CONTENT -->
    <div class="content">

        <!-- IMAGE -->
        <div class="image-box">
            <div class="plus">+</div>
        </div>

        <!-- FORM -->
        <div class="form-box">

            <form id="productForm">

                <div class="input-group">
                    <input type="text" name="nama_menu" placeholder="Nama" required>
                </div>

                <div class="input-group">
                    <input type="text" name="deskripsi" placeholder="Deskripsi Menu">
                </div>

                <div class="input-group">
                    <input type="number" 
                           name="harga" 
                           placeholder="99"
                           class="highlight"
                           required>
                </div>

                <div class="input-group">
                    <input type="number" name="stok" placeholder="Harga" required>
                </div>

                <!-- HIDDEN -->
                <input type="hidden" name="kategori" value="Makanan">
                <input type="hidden" name="user_id" value="1">
                <input type="hidden" name="status" value="tersedia">
                <input type="hidden" name="gambar" value="">

                <div class="button-area">
                    <button type="submit" class="btn-submit">
                        INPUT
                    </button>
                </div>

            </form>

        </div>

    </div>

</div>

<script>
const API_URL = "http://localhost:8000/api/products";

document.getElementById("productForm")
.addEventListener("submit", async function(e) {
    e.preventDefault();

    const formData = new FormData(this);
    const data = Object.fromEntries(formData.entries());

    try {
        const res = await fetch(API_URL, {
            method: "POST",
            headers: {
                "Accept": "application/json",
                "Content-Type": "application/json"
            },
            body: JSON.stringify({
                nama_menu: data.nama_menu,
                deskripsi: data.deskripsi || "",
                harga: Number(data.harga),
                stok: Number(data.stok),
                kategori: data.kategori,
                user_id: Number(data.user_id),
                status: data.status || "tersedia",
                gambar: data.gambar || null
            })
        });

        const result = await res.json();

        if (!res.ok) {
            console.error(result);
            alert("❌ " + JSON.stringify(result));
            return;
        }

        alert("✅ Produk berhasil ditambahkan");
        window.location.href = "/dashboard/seller";

    } catch (error) {
        console.error(error);
        alert("❌ Server error");
    }
});
</script>

</body>
</html>