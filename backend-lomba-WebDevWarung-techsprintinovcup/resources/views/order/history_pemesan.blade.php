<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Pesanan</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@700&family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            background-color: #f5f5f5;
        }

        /* Navbar */
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

                /* Sidebar & Overlay */
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

        /* History Content */
        .main-container {
            padding: 30px 10%;
        }

        .history-group {
            margin-bottom: 30px;
        }

        .date-header {
            background-color: #e0e0e0;
            padding: 10px 20px; 
            font-weight: 600;
            color: #555;
            margin-bottom: 15px;
            border-radius: 12px;
            
            display: block;    
            text-align: left;  
        }    

        .history-card {
            background-color: #7286D3;
            border-radius: 25px;
            padding: 15px 25px;
            display: flex;
            align-items: center;
            gap: 20px;
            margin-bottom: 15px;
            color: white;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            transition: 0.3s;
        }

        .history-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 15px rgba(0,0,0,0.15);
        }

        .history-img-box img {
            width: 90px;
            height: 90px;
            border-radius: 15px;
            object-fit: cover;
            background-color: white;
            border: 2px solid white;
        }

        .history-info {
            flex: 1;
        }

        .history-info h3 {
            color: #ffb800;
            font-size: 22px;
            margin-bottom: 5px;
            font-family: 'Montserrat', sans-serif;
        }

        .history-info p {
            font-size: 14px;
            opacity: 0.9;
        }

        .history-price {
            font-size: 20px;
            font-weight: bold;
            white-space: nowrap;
            color: #ffffff;
        }

        .history-status{
    margin-top:8px;
    display:inline-block;
    padding:5px 12px;
    border-radius:20px;
    font-size:11px;
    font-weight:700;
}

.status-pending{
    background:rgba(255,184,0,0.2);
    color:#ffb800;
}

.status-diproses{
    background:rgba(20,184,20,0.2);
    color:#14ff72;
}

.status-selesai{
    background:rgba(255,255,255,0.2);
    color:white;
}
    </style>
</head>

<body>
    <div id="overlay" class="overlay" onclick="closeNav()"></div>

    <div id="mySidebar" class="sidebar">
        <div class="sidebar-content">
            <a href="/dashboard/consument" onclick="closeNav()">🍱 Menu</a>
            <a href="/status-pesanan" onclick="closeNav()">📦 Status Pesanan</a>
            <a href="/history-pemesan" onclick="closeNav()" style="background-color:#ffb800; color:#001a57;">🕑 Riwayat Pesanan</a>
        </div>
    </div>

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

    <div class="main-container" id="historyContainer">

</div>

    </div>

    <script>

const token = localStorage.getItem("token");
// Tambahkan di bagian atas script, setelah deklarasi token
const user = JSON.parse(localStorage.getItem("user"));
if (!user || !token) window.location.href = "/login";
document.getElementById("namaUser").textContent = `Hallo, ${user.name}`;
const authHeaders = {
    "Accept":"application/json",
    "Authorization":`Bearer ${token}`
};

function openNav() {
    document.getElementById("mySidebar").style.width = "280px";
    document.getElementById("overlay").style.display = "block";
}

function closeNav() {
    document.getElementById("mySidebar").style.width = "0";
    document.getElementById("overlay").style.display = "none";
}

async function getHistory(){

    try{

        const res = await fetch(
            "https://backend-lomba-php.onrender.com/api/orders/user/",
            {
                headers:authHeaders
            }
        );

        const result = await res.json();

        console.log(result);

        const container =
            document.getElementById("historyContainer");

        container.innerHTML = "";

        if(!result || result.length === 0){

            container.innerHTML = `
                <div style="
                    text-align:center;
                    padding:80px;
                    color:#777;
                    font-size:18px;
                ">
                    Belum ada riwayat pesanan
                </div>
            `;

            return;
        }

        // GROUP BY TANGGAL
        const grouped = {};

        result.forEach(order => {

            const date =
                new Date(order.created_at)
                .toLocaleDateString('id-ID',{
                    day:'2-digit',
                    month:'long',
                    year:'numeric'
                });

            if(!grouped[date]){
                grouped[date] = [];
            }

            grouped[date].push(order);

        });

        Object.keys(grouped).forEach(date => {

            let html = `
                <div class="history-group">

                    <div class="date-header">
                        ${date}
                    </div>
            `;

            grouped[date].forEach(order => {

                const items = order.items || [];

                items.forEach(item => {

                    const product = item.product || {};

                    const img =
    product.gambar
        ? `https://backend-lomba-php.onrender.com/storage/${product.gambar}`
        : "https://dummyimage.com/200x200/cccccc/000000&text=Menu";

                    const localStatuses =
                        JSON.parse(localStorage.getItem("order_statuses") || "{}");

                    const finalStatus =
                        localStatuses[order.id] ?? order.status_id;

                    let statusClass = "status-pending";
                    let statusText  = "Menunggu";

                    if(finalStatus == 2){

                        statusClass = "status-diproses";
                        statusText  = "Diproses";

                    }

                    if(finalStatus == 4){

                        statusClass = "status-selesai";
                        statusText  = "Selesai";

                    }

                    if(finalStatus == 5){

                        statusClass = "status-pending";
                        statusText  = "Ditolak";

                    }

                    if(order.status_id == 4){
                        statusClass = "status-selesai";
                        statusText  = "Selesai";
                    }

                    html += `
                        <div class="history-card">

                            <div class="history-img-box">
                                <img src="${img}">
                            </div>

                            <div class="history-info">

                                <h3>
                                    ${product.nama_menu || 'Menu'}
                                </h3>

                                <p>
                                    Qty: ${item.quantity}
                                </p>

                                <div class="history-status ${statusClass}">
                                    ${statusText}
                                </div>

                            </div>

                            <div class="history-price">
                                Rp.
                                ${Number(item.price_at_purchase || 0)
                                    .toLocaleString('id-ID')}
                            </div>

                        </div>
                    `;
                });

            });

            html += `</div>`;

            container.innerHTML += html;

        });

    } catch(err){

        console.error(err);

    }
}

getHistory();

</script>

</body>

</html>