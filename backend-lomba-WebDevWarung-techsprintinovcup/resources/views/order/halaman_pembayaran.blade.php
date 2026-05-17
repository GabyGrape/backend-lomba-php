<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pembayaran QRIS</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@700&family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <style>
        *{ margin:0; padding:0; box-sizing:border-box; font-family:'Poppins',sans-serif; }
        body{ background-color:#f5f5f5; min-height:100vh; display:flex; justify-content:center; align-items:center; position:relative; }
        .btn-back{ position:absolute; top:30px; left:30px; width:45px; height:45px; display:flex; justify-content:center; align-items:center; background-color:white; border-radius:50%; box-shadow:0 4px 10px rgba(0,0,0,0.1); transition:0.3s; text-decoration:none; }
        .btn-back svg{ width:28px; height:28px; }
        .btn-back:hover{ transform:scale(1.1); background-color:#7286D3; }
        .btn-back:hover svg path{ stroke:white; }
        .qris-card{ background-color:#001a57; width:100%; max-width:480px; border-radius:40px; padding:40px; text-align:center; color:white; position:relative; box-shadow:0 10px 30px rgba(0,0,0,0.15); margin:20px; }
        .qris-card h2{ color:#ffb800; font-size:32px; margin-bottom:8px; font-family:'Montserrat',sans-serif; }
        .order-info{ font-size:13px; color:#aab8d8; margin-bottom:20px; }
        .qr-container{ background-color:white; border-radius:30px; padding:25px; display:flex; justify-content:center; align-items:center; margin-bottom:20px; min-height:280px; flex-direction:column; gap:15px; }
        .qr-container img{ width:100%; max-width:260px; height:auto; border-radius:10px; }
        .qr-placeholder{ width:220px; height:220px; background:#f0f0f0; border-radius:15px; display:flex; flex-direction:column; align-items:center; justify-content:center; gap:10px; color:#aaa; }
        .qr-placeholder span{ font-size:60px; }
        .qr-placeholder p{ font-size:12px; text-align:center; }
        .qris-card p.note{ color:#ffb800; font-size:13px; margin-bottom:16px; }

        /* Tombol status pesanan */
        .btn-status{
            width:100%; background:#ffb800; color:#001a57;
            border:none; padding:14px; border-radius:14px;
            font-weight:700; font-size:14px; cursor:pointer;
            font-family:'Poppins',sans-serif;
            transition:0.2s; margin-bottom:50px;
        }
        .btn-status:hover{ background:#ffd740; }

        .btn-download{ position:absolute; bottom:25px; right:25px; background-color:#aeb9d7; width:50px; height:50px; border-radius:12px; display:flex; justify-content:center; align-items:center; transition:0.3s; color:#001a57; text-decoration:none; }
        .btn-download svg{ width:26px; height:26px; fill:none; }
        .btn-download:hover{ background-color:#ffb800; transform:scale(1.1); }
    </style>
</head>
<body>

    <a href="/dashboard/consument" class="btn-back">
        <svg viewBox="0 0 24 24" fill="none">
            <path d="M15 19L8 12L15 5" stroke="#7286D3" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
    </a>

    <div class="qris-card">
        <h2 id="totalTagihan">Rp. 0</h2>
        <div class="order-info" id="orderInfo">Menunggu data pesanan...</div>

        <div class="qr-container">
            <img id="qrisImg" src="" alt="QRIS" style="display:none">
            <div class="qr-placeholder" id="qrisPlaceholder">
                <span>📱</span>
                <p>QRIS akan tampil di sini</p>
            </div>
        </div>

        <p class="note">Pembayaran Hanya Menggunakan QRIS</p>

        {{-- Tombol ke status pesanan --}}
        <button class="btn-status" onclick="window.location.href='/status-pesanan'">
            📦 Lihat Status Pesanan
        </button>

        <a href="#" class="btn-download" id="btnDownload" title="Download QRIS">
            <svg viewBox="0 0 24 24">
                <path d="M12 15V3m0 12l-4-4m4 4l4-4" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M20 17v2a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2v-2" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
        </a>
    </div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const total     = localStorage.getItem("order_total");
    const lastOrder = JSON.parse(localStorage.getItem("last_order") || "{}");

    if (total) {
        document.getElementById("totalTagihan").textContent =
            "Rp. " + Number(total).toLocaleString('id-ID');
    }

   async function loadQris() {

    try {

        const res = await fetch("https://backend-lomba-php.onrender.com/api/users/1");

        const result = await res.json();

        console.log(result);

        // ambil qris url
        const qrisUrl =
            result.data?.qris_url ||
            result.qris_url ||
            result.data?.qris ||
            null;

        if (qrisUrl) {

            const img = document.getElementById("qrisImg");

            img.src = qrisUrl;

            img.style.display = "block";

            document.getElementById("qrisPlaceholder").style.display = "none";

            document.getElementById("btnDownload").href = qrisUrl;

            document.getElementById("btnDownload").download = "qris.png";
        }

    } catch(err) {

        console.error("Gagal load QRIS:", err);

    }
}

loadQris();
});
</script>
</body>
</html>