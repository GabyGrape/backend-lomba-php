<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Keuangan - Laba Rugi</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@700&family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Poppins', sans-serif; }
        body { background-color: #f5f5f5; padding-bottom: 50px; }

        /* Header & Nav Area */
        .wrapper{
            width:100%;
            min-height:100vh;
            background:white;
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

        /* Filter Area */
        .filter-container {
            display: flex;
            gap: 20px;
            padding: 20px 40px;
            background: #fdfdfd;
        }
        .filter-box {
            background: #999;
            color: white;
            padding: 10px 20px;
            border-radius: 15px;
            flex: 1;
            font-size: 14px;
        }

        .table-section {
            padding: 0 40px;
            margin-top: 10px;
        }
        .scroll-wrapper {
            max-height: 400px;
            overflow-y: auto;
            border-radius: 0 0 15px 15px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        }

        /* Styling Tabel */
        .main-table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 2px;
        }
        .table-header-main {
            background-color: #ffb800;
            color: white;
            text-align: center;
            font-family: 'Montserrat', sans-serif;
            font-size: 24px;
            padding: 15px;
        }
        .sub-header th {
            background-color: #7286D3;
            color: white;
            padding: 12px;
            font-size: 14px;
        }
        .data-row td {
            background-color: #001a57;
            color: white;
            padding: 12px;
            text-align: center;
            border-bottom: 1px solid #1a2a6c;
        }

        /* Footer Perhitungan*/
        .summary-section {
            padding: 30px 40px;
            display: grid;
            grid-template-columns: 1fr 2fr;
            gap: 20px;
        }
        .untung-box {
            background-color: #001a57;
            color: white;
            border-radius: 15px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 40px;
        }
        .untung-box h2 { font-size: 32px; font-family: 'Montserrat', sans-serif; }
        
        .calc-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
        }
        .calc-card {
            background: #ffb800;
            padding: 15px;
            border-radius: 10px;
            text-align: center;
            font-weight: bold;
            color: white;
        }
        .calc-sub {
            background: #7286D3;
            padding: 10px;
            border-radius: 10px;
            text-align: center;
            color: white;
            margin-top: 10px;
        }
        .calc-total-bar {
            grid-column: span 2;
            background: #cbd5e0;
            padding: 15px;
            border-radius: 10px;
            text-align: center;
            font-weight: 600;
            color: #2d3748;
            border: 2px solid #7286D3;
        }
    </style>
</head>
<body>

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

            <div class="menu-item">
                <div class="circle-icon">💰</div>
                Laporan
            </div>

            <div class="menu-item">
                <div class="circle-icon">⟳</div>
                Pesanan
            </div>

        </div>

        <div class="profile-section">
            <div>Hallo, Nama Pengguna</div>
            <div class="profile"></div>
        </div>

    </div>

    <div class="filter-container">
        <div class="filter-box">ID User</div>
        <div class="filter-box">Tanggal</div>
        <div class="filter-box">Warung</div>
    </div>

    <div class="table-section">
        <div class="scroll-wrapper">
            <table class="main-table">
                <thead>
                    <tr>
                        <th colspan="3" class="table-header-main">PEMBELIAN</th>
                        <th colspan="2" class="table-header-main">PENJUALAN</th>
                    </tr>
                    <tr class="sub-header">
                        <th>No</th>
                        <th>Nama Menu</th>
                        <th>Average</th>
                        <th>Nama Menu</th>
                        <th>Average</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        // Inisialisasi variabel total
                        $totalBeli = 0;
                        $totalJual = 0;
                        
                        // Nilai statis per baris
                        $hargaBeliPerItem = 50000;
                        $hargaJualPerItem = 80000;
                    @endphp

                    @for ($i = 1; $i <= 15; $i++)
                        @php
                            $totalBeli += $hargaBeliPerItem;
                            $totalJual += $hargaJualPerItem;
                        @endphp
                        <tr class="data-row">
                            <td>{{ $i }}</td>
                            <td>Es Kambing</td>
                            <td>Rp. {{ number_format($hargaBeliPerItem, 0, ',', '.') }}</td>
                            <td>Es Kambing</td>
                            <td>Rp. {{ number_format($hargaJualPerItem, 0, ',', '.') }}</td>
                        </tr>
                    @endfor

                    <tr class="data-row" style="font-weight: bold; border-top: 3px solid #ffb800; background-color: #000c29;">
                        <td colspan="2">TOTAL</td>
                        <td style="color: #ffb800;">Rp. {{ number_format($totalBeli, 0, ',', '.') }}</td>
                        <td>TOTAL</td>
                        <td style="color: #ffb800;">Rp. {{ number_format($totalJual, 0, ',', '.') }}</td> 
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    @php
        // Logika Laba Rugi
        $labaRugi = $totalJual - $totalBeli;
        $status = $labaRugi >= 0 ? 'Untung' : 'Rugi';
        $boxColor = $labaRugi >= 0 ? '#001a57' : '#001a57';
    @endphp

    <div class="summary-section">
        <div class="untung-box" style="background-color: {{ $boxColor }};">
            <p>Total</p>
            <h2>{{ $status }}</h2>
        </div>
        <div class="calc-grid">
            <div>
                <div class="calc-card">Total Pembelian</div>
                <div class="calc-sub">Rp. {{ number_format($totalBeli, 0, ',', '.') }}</div>
            </div>
            
            <div>
                <div class="calc-card">Total Penjualan</div>
                <div class="calc-sub">Rp. {{ number_format($totalJual, 0, ',', '.') }}</div>
            </div>
            <div class="calc-total-bar">
                Total {{ $status }}: Rp. {{ number_format(abs($labaRugi), 0, ',', '.') }}
                <br>
                <small style="font-weight: 400;">(Hasil pengurangan Total Penjualan - Total Pembelian)</small>
            </div>
        </div>
    </div>

</body>
</html>