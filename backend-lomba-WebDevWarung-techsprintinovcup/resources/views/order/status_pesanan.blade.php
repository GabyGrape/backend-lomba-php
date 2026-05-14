<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Status Pesanan - Kantin</title>
    
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

        /* Navbar Styling */
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

        /* Sidebar Styling */
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

        /* Status Page Styling */
        .main-container.status-page {
            padding: 40px 5%;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: calc(100vh - 70px);
        }

        .status-card {
            background-color: #7286D3;
            width: 100%;
            max-width: 900px;
            border-radius: 40px;
            padding: 50px;
            color: white;
            position: relative;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        }

        .status-card h1 {
            color: white;
            font-family: 'Montserrat', sans-serif;
            font-size: 32px;
            margin-bottom: 60px;
            text-align: center;
        }

        .timeline-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: relative;
            height: 120px;
        }

        .status-connector-line {
            position: absolute;
            top: 35%;
            left: 10%;
            right: 10%;
            height: 5px;
            background-color: #ffffff;
            z-index: 1;
        }

        .status-point {
            display: flex;
            flex-direction: column;
            align-items: center;
            position: relative;
            z-index: 2;
            width: 130px;
        }

        .status-circle {
            width: 70px;
            height: 70px;
            border-radius: 50%;
            border: 6px solid #ffffff;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
            margin-bottom: 15px;
            transition: transform 0.3s ease;
        }

        .color-green { background-color: #00c853; }
        .color-yellow { background-color: #ffb800; }
        .color-red { background-color: #d32f2f; }

        .status-point span {
            font-size: 14px;
            font-weight: 600;
            color: #ffffff;
            text-align: center;
            line-height: 1.2;
        }
    </style>
</head>

<body>
    <div id="overlay" class="overlay" onclick="closeNav()"></div>

    <div id="mySidebar" class="sidebar">
        <div class="sidebar-content">
            <a href="dashboard_consument.blade.php">Menu Makanan</a>
            <a href="status_pesanan.blade.php" style="background-color: #ffb800; color: #001a57;">Status Pesanan</a>
            <a href="{{ url('riwayat_pesanan') }}">Riwayat Pesanan</a>
        </div>
    </div>

    <!-- NAVBAR -->
<div class="navbar">

    <div class="left-nav">
        <div class="menu-icon" onclick="openNav()">☰</div>
        <div class="logo">🔥</div>
    </div>

    <div class="right-nav">
        <div>Hallo, Nama Pengguna</div>
        <div class="profile"></div>
    </div>

</div>

    <div class="main-container status-page">
        <div class="status-card">
            <h1>Status Pesanan</h1>

            <div class="timeline-container">
                <div class="status-connector-line"></div>

                <div class="status-point">
                    <div class="status-circle color-green"></div>
                    <span>Diterima</span>
                </div>

                <div class="status-point">
                    <div class="status-circle color-yellow"></div>
                    <span>Disiapkan</span>
                </div>

                <div class="status-point">
                    <div class="status-circle color-red"></div>
                    <span>Pesanan Siap<br>Diambil</span>
                </div>
            </div>
        </div>
    </div>

    <script>
        function openNav() {
            document.getElementById("mySidebar").style.width = "280px";
            document.getElementById("overlay").style.display = "block";
        }

        function closeNav() {
            document.getElementById("mySidebar").style.width = "0";
            document.getElementById("overlay").style.display = "none";
        }
    </script>
</body>

</html>