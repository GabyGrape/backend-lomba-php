<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Status Pesanan</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@700&family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <style>
        * { margin:0; padding:0; box-sizing:border-box; font-family:'Poppins',sans-serif; }
        body { background-color:#f5f5f5; }
        .navbar{ width:100%; height:70px; background:#001a57; display:flex; justify-content:space-between; align-items:center; padding:0 25px; color:white; position:sticky; top:0; z-index:100; }
        .logo{ font-size:24px; color:#ffb800; font-weight:bold; }
        .user-info{ display:flex; align-items:center; gap:10px; }
        .profile{ width:38px; height:38px; background:#7286D3; border-radius:50%; }

        .main-container{ padding:40px 5%; display:flex; justify-content:center; align-items:flex-start; min-height:calc(100vh - 70px); }

        .status-card{
            background:#7286D3; width:100%; max-width:900px;
            border-radius:40px; padding:50px; color:white;
            box-shadow:0 10px 30px rgba(0,0,0,0.1);
        }
        .status-card h1{ color:white; font-family:'Montserrat',sans-serif; font-size:28px; margin-bottom:10px; text-align:center; }
        .order-id-info{ text-align:center; font-size:13px; color:rgba(255,255,255,0.7); margin-bottom:50px; }

        /* Timeline */
        .timeline-container{ display:flex; justify-content:space-between; align-items:center; position:relative; height:130px; }
        .status-connector-line{ position:absolute; top:35%; left:10%; right:10%; height:5px; background:rgba(255,255,255,0.4); z-index:1; }
        .status-connector-fill{ position:absolute; top:35%; left:10%; height:5px; background:white; z-index:2; transition:width 0.6s ease; width:0%; }

        .status-point{ display:flex; flex-direction:column; align-items:center; position:relative; z-index:3; width:130px; }
        .status-circle{
            width:70px; height:70px; border-radius:50%;
            border:5px solid rgba(255,255,255,0.4);
            background:rgba(255,255,255,0.15);
            margin-bottom:15px;
            transition:all 0.4s ease;
            display:flex; align-items:center; justify-content:center;
            font-size:28px;
        }
        .status-circle.done{ background:#00c853; border-color:white; box-shadow:0 0 15px rgba(0,200,83,0.5); }
        .status-circle.active{ background:#ffb800; border-color:white; box-shadow:0 0 15px rgba(255,184,0,0.5); animation: pulse 1.5s infinite; }
        .status-circle.selesai{ background:#001a57; border-color:white; box-shadow:0 0 15px rgba(0,26,87,0.5); }

        @keyframes pulse {
            0%,100%{ transform:scale(1); }
            50%{ transform:scale(1.08); }
        }

        .status-point span{ font-size:13px; font-weight:600; color:white; text-align:center; line-height:1.3; }
        .status-point .status-desc{ font-size:10px; color:rgba(255,255,255,0.6); margin-top:3px; text-align:center; }

        /* Tombol refresh & kembali */
        .btn-row{ display:flex; gap:12px; margin-top:40px; justify-content:center; }
        .btn-refresh{ background:rgba(255,255,255,0.15); color:white; border:2px solid rgba(255,255,255,0.4); padding:12px 28px; border-radius:12px; font-size:14px; font-weight:600; cursor:pointer; font-family:'Poppins',sans-serif; transition:0.2s; }
        .btn-refresh:hover{ background:rgba(255,255,255,0.25); }
        .btn-back-dash{ background:#ffb800; color:#001a57; border:none; padding:12px 28px; border-radius:12px; font-size:14px; font-weight:600; cursor:pointer; font-family:'Poppins',sans-serif; transition:0.2s; }
        .btn-back-dash:hover{ background:#ffd740; }

        .status-label-text{ margin-top:20px; text-align:center; font-size:16px; font-weight:600; color:white; }
    </style>
</head>
<body>

<div class="navbar">
    <div class="logo">🔥 WebDevWarung</div>
    <div class="user-info">
        <span id="namaUser">...</span>
        <div class="profile"></div>
    </div>
</div>

<div class="main-container">
    <div class="status-card">
        <h1>Status Pesanan</h1>
        <div class="order-id-info" id="orderIdInfo">Memuat data pesanan...</div>

        <div class="timeline-container">
            <div class="status-connector-line"></div>
            <div class="status-connector-fill" id="connectorFill"></div>

            <div class="status-point">
                <div class="status-circle" id="circle1">📋</div>
                <span>Diterima</span>
                <span class="status-desc" id="desc1">Menunggu</span>
            </div>

            <div class="status-point">
                <div class="status-circle" id="circle2">👨‍🍳</div>
                <span>Disiapkan</span>
                <span class="status-desc" id="desc2">Menunggu</span>
            </div>

            <div class="status-point">
                <div class="status-circle" id="circle3">✅</div>
                <span>Siap Diambil</span>
                <span class="status-desc" id="desc3">Menunggu</span>
            </div>
        </div>

        <div class="status-label-text" id="statusLabelText">Memuat status...</div>

        <div class="btn-row">
            <button class="btn-refresh" onclick="getStatusPesanan()">🔄 Refresh Status</button>
            <button class="btn-back-dash" onclick="window.location.href='/dashboard/consument'">← Kembali</button>
        </div>
    </div>
</div>

<script>
    const token    = localStorage.getItem("token");
    const user     = JSON.parse(localStorage.getItem("user") || "{}");
    const lastOrder = JSON.parse(localStorage.getItem("last_order") || "{}");

    document.getElementById("namaUser").textContent = user.name || "Pengguna";

    const orderId = lastOrder.data?.id || lastOrder.id;

    function updateTimeline(statusId) {
        const c1 = document.getElementById("circle1");
        const c2 = document.getElementById("circle2");
        const c3 = document.getElementById("circle3");
        const d1 = document.getElementById("desc1");
        const d2 = document.getElementById("desc2");
        const d3 = document.getElementById("desc3");
        const fill = document.getElementById("connectorFill");
        const label = document.getElementById("statusLabelText");

        // Reset semua
        [c1, c2, c3].forEach(c => c.className = "status-circle");

        if (statusId >= 1) {
            // Pending — circle 1 active (belum diterima)
            c1.className = "status-circle active";
            d1.textContent = "Menunggu konfirmasi";
            label.textContent = "⏳ Pesanan kamu sedang menunggu konfirmasi seller...";
            fill.style.width = "0%";
        }
        if (statusId >= 2) {
            // Diterima
            c1.className = "status-circle done";
            c2.className = "status-circle active";
            d1.textContent = "✓ Sudah dikonfirmasi";
            d2.textContent = "Sedang diproses";
            label.textContent = "👨‍🍳 Pesanan kamu sedang disiapkan!";
            fill.style.width = "40%";
        }
        if (statusId >= 3) {
            c2.className = "status-circle done";
            c3.className = "status-circle active";
            d2.textContent = "✓ Selesai disiapkan";
            d3.textContent = "Siap diambil!";
            label.textContent = "🎉 Pesanan siap! Silakan ambil di tempat.";
            fill.style.width = "80%";
        }
        if (statusId >= 4) {
            c3.className = "status-circle selesai";
            d3.textContent = "✓ Selesai";
            label.textContent = "✅ Pesanan selesai! Terima kasih.";
            fill.style.width = "100%";
        }
    }

    async function getStatusPesanan() {
        if (!orderId) {
            document.getElementById("orderIdInfo").textContent = "Tidak ada pesanan aktif.";
            updateTimeline(0);
            return;
        }

        document.getElementById("orderIdInfo").textContent = `Order #${orderId}`;

        // Cek localStorage dulu (update dari seller)
        const statuses = JSON.parse(localStorage.getItem("order_statuses") || "{}");
        const localStatus = statuses[orderId];

        if (localStatus) {
            updateTimeline(localStatus);
            return;
        }

        // Kalau tidak ada di localStorage, fetch dari API
        try {
            const res = await fetch("http://127.0.0.1:8000/api/orders", {
                headers: {
                    'Accept': 'application/json',
                    'Authorization': `Bearer ${token}`
                }
            });
            const result = await res.json();

            if (result.data && result.data.length > 0) {
                // Cari order yang sesuai
                const order = result.data.find(o => o.id == orderId) || result.data[result.data.length - 1];
                updateTimeline(order.status_id);
            }
        } catch (err) {
            console.error(err);
            updateTimeline(1); // fallback ke pending
        }
    }

    getStatusPesanan();
</script>
</body>
</html>