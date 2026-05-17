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

        /* ================= NAVBAR ================= */

        .navbar{
            background:#002b7f;
            height:90px;
            display:flex;
            justify-content:space-between;
            align-items:center;
            padding:0 20px;
        }

        /* MENU */
        .nav-menu{
            display:flex;
            gap:25px;
            align-items:center;
        }

        .menu-item{
            text-align:center;
            color:white;
            font-size:10px;
            cursor:pointer;
        }

        .circle-icon{
            width:55px;
            height:55px;
            border-radius:50%;
            background:white;
            color:black;
            display:flex;
            justify-content:center;
            align-items:center;
            font-size:28px;
            margin:auto;
            margin-bottom:5px;
            font-weight:bold;
        }

        /* PROFILE */
        .profile-section{
            display:flex;
            align-items:center;
            gap:15px;
            color:white;
        }

        .profile{
            width:50px;
            height:50px;
            border-radius:50%;
            background:white;
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

        /*button filter harian*/
        .more-options {
            position: relative;
            display: flex;
            justify-content: flex-end;
            padding: 0 40px;
            margin-bottom: 10px;
        }

        .dots-btn {
            cursor: pointer;
            display: flex;
            gap: 4px;
            padding: 10px;
        }

        .dot {
            width: 8px;
            height: 8px;
            background-color: #001a57;
            border-radius: 50%;
        }

        /* Dropdown Menu */
        .dropdown-period {
            display: none; 
            position: absolute;
            top: 40px;
            right: 40px;
            background-color: #001a57;
            padding: 10px;
            border-radius: 15px;
            z-index: 100;
            gap: 10px;
        }

        .dropdown-period.show {
            display: flex;
        }

        .btn-period {
            background-color: #ffb800;
            color: #001a57;
            border: none;
            padding: 8px 20px;
            border-radius: 10px;
            font-weight: bold;
            font-size: 14px;
            cursor: pointer;
            text-transform: uppercase;
            transition: 0.3s;
        }

        .btn-period:hover {
            background-color: white;
        }

        .history-status{
    margin-top:8px;
    display:inline-block;
    padding:5px 12px;
    border-radius:20px;
    font-size:11px;
    font-weight:700;
}

.status-menunggu{
    background:rgba(255,184,0,0.2);
    color:#ffb800;
}

.status-diterima{
    background:rgba(20,184,20,0.2);
    color:#14ff72;
}

.status-selesai{
    background:rgba(255,255,255,0.2);
    color:white;
}

.status-ditolak{
    background:rgba(255,0,0,0.2);
    color:#ff8080;
}

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
    .circle-icon { width: 44px; height: 44px; font-size: 20px; }
    .profile-section { width: 100%; justify-content: center; }

    .main-container { padding: 20px 15px; }
    .history-card {
        flex-direction: column;
        align-items: flex-start;
        padding: 15px;
        gap: 12px;
    }
    .history-img-box img { width: 100%; height: 160px; border-radius: 12px; }
    .history-price { align-self: flex-end; }

    .more-options { padding: 0 15px; }
    .dropdown-period { right: 15px; flex-wrap: wrap; }
}
    </style>
</head>

<body>
    <div id="overlay" class="overlay" onclick="closeNav()"></div>

    <div id="mySidebar" class="sidebar">
        <div class="sidebar-content">
            <a href="/dashboard/seller" onclick="closeNav()">🏠 Dashboard</a>
<a href="/menu/create" onclick="closeNav()">➕ Tambah Menu</a>
<a href="/halaman-labarugi" onclick="closeNav()">💰 Laporan</a>
<a href="/history-penjual" onclick="closeNav()" style="background-color:#ffb800; color:#001a57;">⟳ Riwayat Pesanan</a>
        </div>
    </div>

    <div class="navbar">

        <div class="nav-menu">

            <div class="menu-item" onclick="window.location.href='/dashboard/seller'">
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

        <div class="more-options">
        <div class="dots-btn" onclick="toggleDropdown()">
            <div class="dot"></div>
            <div class="dot"></div>
            <div class="dot"></div>
        </div>

        <div id="dropdownPeriod" class="dropdown-period">
            <button class="btn-period" onclick="filterData('harian')">Harian</button>
            <button class="btn-period" onclick="filterData('mingguan')">Mingguan</button>
            <button class="btn-period" onclick="filterData('bulanan')">Bulanan</button>
        </div>
    </div>

    <div class="main-container" id="historyContainer">

    </div>

    <script>

const token = localStorage.getItem("token");
// Tambahkan di awal script
const user = JSON.parse(localStorage.getItem("user"));
if (!user || !token) window.location.href = "/login";
document.getElementById("namaUser").textContent = `Hallo, ${user.name}`;

function goToCreate() { window.location.href = "/menu/create"; }
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

function toggleDropdown() {
    const dropdown = document.getElementById("dropdownPeriod");
    dropdown.classList.toggle("show");
}

window.onclick = function(event) {

    if (!event.target.matches('.dots-btn') &&
        !event.target.matches('.dot')) {

        const dropdowns =
            document.getElementsByClassName("dropdown-period");

        for (let i = 0; i < dropdowns.length; i++) {

            let openDropdown = dropdowns[i];

            if (openDropdown.classList.contains('show')) {
                openDropdown.classList.remove('show');
            }
        }
    }
}

let allOrders = [];

async function getHistory(){

    try{

        const res = await fetch(
            "http://127.0.0.1:8000/api/orders/merchant/1",
            {
                headers:authHeaders
            }
        );

        const result = await res.json();

        console.log(result);

        allOrders = result || [];

        renderHistory(allOrders);

    } catch(err){

        console.error(err);

    }
}

function renderHistory(orders){

    const container =
        document.getElementById("historyContainer");

    container.innerHTML = "";

    if(!orders || orders.length === 0){

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

    const grouped = {};

    orders.forEach(order => {

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

                    const localStatuses = JSON.parse(localStorage.getItem("order_statuses") || "{}");
                    const finalStatus = localStatuses[order.id] ?? order.status_id;

                    let statusClass = "status-menunggu";
                    let statusText  = "Menunggu";

                    if(finalStatus == 2){
                        statusClass = "status-diterima";
                        statusText  = "Diterima";
                    }
                    if(finalStatus == 4){
                        statusClass = "status-selesai";
                        statusText  = "Selesai";
                    }
                    if(finalStatus == 5){
                        statusClass = "status-ditolak";
                        statusText  = "Ditolak";
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

                            <p>
                                👤 ${order.customer?.name || 'Customer'}
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
}

function filterData(periode) {

    const now = new Date();

    let filtered = [...allOrders];

    if(periode === 'harian'){

        filtered = allOrders.filter(order => {

            const d = new Date(order.created_at);

            return d.toDateString() === now.toDateString();

        });
    }

    if(periode === 'mingguan'){

        filtered = allOrders.filter(order => {

            const d = new Date(order.created_at);

            const diff =
                (now - d) / (1000 * 60 * 60 * 24);

            return diff <= 7;

        });
    }

    if(periode === 'bulanan'){

        filtered = allOrders.filter(order => {

            const d = new Date(order.created_at);

            return (
                d.getMonth() === now.getMonth() &&
                d.getFullYear() === now.getFullYear()
            );

        });
    }

    renderHistory(filtered);

    toggleDropdown();
}

getHistory();

</script>

</body>

</html>