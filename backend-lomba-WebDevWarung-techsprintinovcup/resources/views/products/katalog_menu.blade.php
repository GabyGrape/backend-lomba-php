<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Tambah Menu</title>
</head>

<body>

<h2>Tambah Menu</h2>

<form id="productForm">

    <input name="nama_menu" placeholder="Nama Menu" required><br><br>

    <input name="deskripsi" placeholder="Deskripsi"><br><br>

    <input name="harga" type="number" placeholder="Harga" required><br><br>

    <input name="stok" type="number" placeholder="Stok" required><br><br>

    <input name="kategori" placeholder="Kategori" required><br><br>

    <!-- OPTIONAL: kalau belum pakai auth -->
    <input name="user_id" type="number" placeholder="User ID" required><br><br>

    <!-- DEFAULT STATUS -->
    <select name="status">
        <option value="tersedia">Tersedia</option>
        <option value="habis">Habis</option>
    </select><br><br>

    <!-- GAMBAR (sementara string / dummy dulu) -->
    <input name="gambar" placeholder="URL Gambar (optional)"><br><br>

    <button type="submit">INPUT</button>

</form>

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