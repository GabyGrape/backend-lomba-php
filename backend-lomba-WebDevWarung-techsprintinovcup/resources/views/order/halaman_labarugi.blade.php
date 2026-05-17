<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Keuangan - Laba Rugi</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@700;800&family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Poppins', sans-serif; }
        body { background-color: #f0f2f8; padding-bottom: 50px; }

        /* ===== NAVBAR ===== */
        .navbar {
            background: #002b7f; height: 90px;
            display: flex; justify-content: space-between; align-items: center;
            padding: 0 20px; box-shadow: 0 4px 15px rgba(0,43,127,0.4);
        }
        .nav-menu { display: flex; gap: 25px; align-items: center; }
        .menu-item { text-align: center; color: white; font-size: 10px; cursor: pointer; transition: transform 0.2s; }
        .menu-item:hover { transform: translateY(-3px); }
        .circle-icon {
            width: 55px; height: 55px; border-radius: 50%;
            background: white; color: black;
            display: flex; justify-content: center; align-items: center;
            font-size: 24px; margin: auto; margin-bottom: 5px;
            font-weight: bold; box-shadow: 0 2px 8px rgba(0,0,0,0.2);
        }
        .profile-section { display: flex; align-items: center; gap: 15px; color: white; }
        .profile { width: 50px; height: 50px; border-radius: 50%; background: #7286D3; }

        /* ===== FILTER ===== */
        .filter-container {
            display: flex; gap: 15px; align-items: flex-end;
            padding: 20px 40px; background: white;
            border-bottom: 1px solid #e2e8f0;
            flex-wrap: wrap;
        }
        .filter-group { display: flex; flex-direction: column; gap: 4px; }
        .filter-label { font-size: 11px; color: #718096; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px; }
        .filter-input {
            background: #f7fafc; color: #2d3748;
            padding: 10px 15px; border-radius: 10px;
            font-size: 14px; border: 2px solid #e2e8f0;
            font-family: 'Poppins', sans-serif; transition: border-color 0.2s;
        }
        .filter-input:focus { outline: none; border-color: #7286D3; }
        .btn-filter {
            background: #002b7f; color: white;
            padding: 10px 28px; border-radius: 10px;
            border: none; font-size: 14px; font-family: 'Poppins', sans-serif;
            font-weight: 600; cursor: pointer; white-space: nowrap;
            transition: background 0.2s;
        }
        .btn-filter:hover { background: #7286D3; }
        .btn-filter:disabled { background: #a0aec0; cursor: not-allowed; }

        /* Tombol Laporan Bulanan di filter bar */
        .btn-laporan-bulanan {
            background: #ffb800; color: white;
            padding: 10px 22px; border-radius: 10px;
            border: none; font-size: 14px; font-family: 'Poppins', sans-serif;
            font-weight: 600; cursor: pointer; white-space: nowrap;
            transition: background 0.2s, transform 0.1s;
            margin-left: auto;
            display: flex; align-items: center; gap: 8px;
        }
        .btn-laporan-bulanan:hover { background: #e6a600; }
        .btn-laporan-bulanan:active { transform: scale(0.97); }

        /* ===== FORM INPUT PEMBELIAN ===== */
        .form-section {
            padding: 20px 40px;
            background: white;
            border-bottom: 2px solid #e2e8f0;
        }
        .form-title {
            font-family: 'Montserrat', sans-serif;
            font-size: 15px; color: #002b7f;
            margin-bottom: 14px;
            display: flex; align-items: center; gap: 8px;
        }
        .form-title::after {
            content: ''; flex: 1; height: 2px;
            background: linear-gradient(to right, #ffb800, transparent);
        }
        .form-grid {
            display: grid;
            grid-template-columns: 2fr 1fr 1fr auto;
            gap: 12px; align-items: flex-end;
        }
        .form-group { display: flex; flex-direction: column; gap: 4px; }
        .form-label { font-size: 11px; color: #718096; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px; }
        .form-input {
            background: #f7fafc; color: #2d3748;
            padding: 10px 15px; border-radius: 10px;
            font-size: 14px; border: 2px solid #e2e8f0;
            font-family: 'Poppins', sans-serif; transition: border-color 0.2s;
            width: 100%;
        }
        .form-input:focus { outline: none; border-color: #ffb800; }
        .btn-tambah {
            background: #ffb800; color: white;
            padding: 10px 24px; border-radius: 10px;
            border: none; font-size: 14px; font-family: 'Poppins', sans-serif;
            font-weight: 600; cursor: pointer; white-space: nowrap;
            transition: background 0.2s, transform 0.1s;
            height: fit-content;
        }
        .btn-tambah:hover { background: #e6a600; }
        .btn-tambah:active { transform: scale(0.97); }
        .btn-tambah:disabled { background: #a0aec0; cursor: not-allowed; }
        .alert-success {
            margin-top: 12px; padding: 10px 16px;
            background: #f0fff4; border: 1px solid #9ae6b4;
            border-radius: 8px; color: #276749; font-size: 13px; display: none;
        }
        .alert-error-form {
            margin-top: 12px; padding: 10px 16px;
            background: #fff5f5; border: 1px solid #feb2b2;
            border-radius: 8px; color: #c53030; font-size: 13px; display: none;
        }

        /* ===== TABLE ===== */
        .table-section { padding: 25px 40px 0; }
        .table-title {
            font-family: 'Montserrat', sans-serif;
            font-size: 17px; color: #002b7f;
            margin-bottom: 14px;
            display: flex; align-items: center; gap: 10px;
        }
        .table-title::after {
            content: ''; flex: 1; height: 2px;
            background: linear-gradient(to right, #7286D3, transparent);
        }
        .scroll-wrapper {
            border-radius: 15px;
            box-shadow: 0 4px 20px rgba(0,43,127,0.15);
            overflow: hidden;
        }
        .main-table { width: 100%; border-collapse: separate; border-spacing: 0; }
        .table-header-pembelian {
            background: #ffb800; color: white; text-align: center;
            font-family: 'Montserrat', sans-serif;
            font-size: 15px; padding: 13px; letter-spacing: 1px;
        }
        .table-header-penjualan {
            background: #002b7f; color: white; text-align: center;
            font-family: 'Montserrat', sans-serif;
            font-size: 15px; padding: 13px; letter-spacing: 1px;
        }
        .sub-header th {
            background: #7286D3; color: white;
            padding: 11px 20px; font-size: 13px; font-weight: 600; text-align: left;
        }
        .sub-header th.right { text-align: right; }
        .sub-header th.divider { background: #5a70c7; width: 3px; padding: 0; }
        .data-row td {
            background: #001a57; color: white;
            padding: 14px 20px; border-bottom: 1px solid #0d2370;
            font-size: 14px; transition: background 0.15s;
        }
        .data-row:hover td { background: #0d2370; }
        .data-row td.right { text-align: right; font-family: 'Montserrat', sans-serif; font-size: 13px; }
        .data-row td.divider { background: #7286D3 !important; width: 3px; padding: 0; }
        .total-row td {
            background: #000c29 !important;
            font-weight: 700; font-size: 14px;
            border-top: 2px solid #ffb800; padding: 15px 20px;
        }
        .total-row td.label { color: white; }
        .total-row td.right { color: #ffb800; text-align: right; font-family: 'Montserrat', sans-serif; }
        .total-row td.divider { background: #7286D3 !important; width: 3px; padding: 0; }
        .loading-row td, .empty-row td {
            background: #001a57; color: #7286D3;
            padding: 35px; text-align: center; font-size: 14px;
        }
        .spinner {
            display: inline-block; width: 18px; height: 18px;
            border: 2px solid #7286D3; border-top-color: #ffb800;
            border-radius: 50%; animation: spin 0.7s linear infinite;
            margin-right: 8px; vertical-align: middle;
        }
        @keyframes spin { to { transform: rotate(360deg); } }

        /* ===== SUMMARY ===== */
        .summary-section {
            padding: 20px 40px 30px;
            display: grid; grid-template-columns: 1fr 2fr; gap: 20px;
        }
        .status-box {
            border-radius: 15px;
            display: flex; flex-direction: column;
            justify-content: center; align-items: center;
            padding: 35px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.2);
            position: relative; overflow: hidden; transition: background 0.4s;
        }
        .status-box::before {
            content: ''; position: absolute; top: -30px; right: -30px;
            width: 120px; height: 120px; border-radius: 50%;
            background: rgba(255,255,255,0.06);
        }
        .status-box.loading { background: #1a2a6c; }
        .status-box.untung  { background: #002b7f; }
        .status-box.rugi    { background: #7f1010; }
        .status-label { color: rgba(255,255,255,0.65); font-size: 12px; font-weight: 600; letter-spacing: 1.5px; text-transform: uppercase; }
        .status-value { color: white; font-family: 'Montserrat', sans-serif; font-size: 38px; font-weight: 800; margin-top: 6px; }
        .status-badge {
            margin-top: 12px; padding: 5px 18px;
            border-radius: 20px; font-size: 11px; font-weight: 600;
            background: rgba(255,255,255,0.12); color: rgba(255,255,255,0.8);
        }
        .status-box.untung .status-badge { background: rgba(255,184,0,0.2); color: #ffb800; }
        .status-box.rugi   .status-badge { background: rgba(255,100,100,0.2); color: #ff8080; }
        .calc-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 14px; }
        .calc-card { border-radius: 12px; padding: 18px 20px; box-shadow: 0 2px 10px rgba(0,0,0,0.08); }
        .calc-card-label { font-size: 11px; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 6px; opacity: 0.85; }
        .calc-card-value { font-family: 'Montserrat', sans-serif; font-size: 20px; font-weight: 700; }
        .calc-card-sub { font-size: 11px; margin-top: 3px; opacity: 0.65; }
        .card-pembelian  { background: #ffb800; color: white; }
        .card-penjualan  { background: #002b7f; color: white; }
        .card-hpp        { background: #7286D3; color: white; }
        .card-laba-kotor { background: #e2e8f0; color: #2d3748; }
        .calc-total-bar {
            grid-column: span 2; background: white;
            padding: 18px 22px; border-radius: 12px;
            border: 2px solid #7286D3;
            display: flex; justify-content: space-between; align-items: center;
            box-shadow: 0 2px 10px rgba(114,134,211,0.15);
        }
        .total-bar-label { font-size: 14px; color: #2d3748; font-weight: 600; }
        .total-bar-sub   { font-size: 11px; color: #a0aec0; margin-top: 3px; }
        .total-bar-value { font-family: 'Montserrat', sans-serif; font-size: 26px; font-weight: 800; }
        .total-bar-value.untung { color: #002b7f; }
        .total-bar-value.rugi   { color: #c53030; }

        .alert-error {
            margin: 12px 40px; padding: 12px 20px;
            background: #fff5f5; border: 1px solid #feb2b2;
            border-radius: 10px; color: #c53030; font-size: 13px; display: none;
        }

        /* ===== MODAL LAPORAN BULANAN ===== */
        .modal-overlay {
            display: none;
            position: fixed; inset: 0;
            background: rgba(0,0,0,0.55);
            z-index: 999;
            align-items: center; justify-content: center;
            padding: 20px;
        }
        .modal-overlay.open { display: flex; }

        .modal-box {
            background: white;
            border-radius: 18px;
            width: 100%; max-width: 580px;
            max-height: 90vh;
            overflow-y: auto;
            box-shadow: 0 20px 60px rgba(0,0,0,0.3);
            animation: modalIn 0.25s ease;
        }
        @keyframes modalIn {
            from { opacity: 0; transform: translateY(20px) scale(0.97); }
            to   { opacity: 1; transform: translateY(0) scale(1); }
        }

        .modal-header {
            background: #002b7f;
            padding: 22px 28px;
            border-radius: 18px 18px 0 0;
            display: flex; align-items: center; justify-content: space-between;
        }
        .modal-header-title {
            font-family: 'Montserrat', sans-serif;
            font-size: 16px; font-weight: 800; color: white; letter-spacing: 0.5px;
        }
        .modal-header-sub { font-size: 12px; color: rgba(255,255,255,0.6); margin-top: 3px; }
        .btn-close-modal {
            background: rgba(255,255,255,0.12); border: none; color: white;
            width: 34px; height: 34px; border-radius: 50%; font-size: 18px;
            cursor: pointer; display: flex; align-items: center; justify-content: center;
            transition: background 0.2s; flex-shrink: 0;
        }
        .btn-close-modal:hover { background: rgba(255,255,255,0.25); }

        .modal-body { padding: 24px 28px; }

        /* Periode */
        .modal-field-group { display: flex; flex-direction: column; gap: 5px; margin-bottom: 18px; }
        .modal-field-label { font-size: 11px; color: #718096; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px; }
        .modal-field-input {
            background: #f7fafc; color: #2d3748;
            padding: 10px 15px; border-radius: 10px;
            font-size: 14px; border: 2px solid #e2e8f0;
            font-family: 'Poppins', sans-serif; transition: border-color 0.2s;
            width: 100%;
        }
        .modal-field-input:focus { outline: none; border-color: #002b7f; }

        /* Ringkasan dari API */
        .modal-section-title {
            font-family: 'Montserrat', sans-serif;
            font-size: 12px; font-weight: 700; color: #002b7f;
            text-transform: uppercase; letter-spacing: 0.8px;
            margin-bottom: 10px;
            display: flex; align-items: center; gap: 8px;
        }
        .modal-section-title::after {
            content: ''; flex: 1; height: 1.5px;
            background: linear-gradient(to right, #e2e8f0, transparent);
        }

        .ringkasan-box {
            background: #f7fafc; border-radius: 12px;
            border: 1.5px solid #e2e8f0;
            padding: 16px 18px; margin-bottom: 18px;
        }
        .ringkasan-row {
            display: flex; justify-content: space-between; align-items: center;
            padding: 7px 0; border-bottom: 1px solid #e2e8f0;
            font-size: 14px;
        }
        .ringkasan-row:last-child { border-bottom: none; }
        .ringkasan-row .r-label { color: #718096; }
        .ringkasan-row .r-val   { font-family: 'Montserrat', sans-serif; font-weight: 700; color: #2d3748; font-size: 13px; }
        .ringkasan-row.highlight .r-label { color: #002b7f; font-weight: 600; }
        .ringkasan-row.highlight .r-val   { color: #002b7f; font-size: 15px; }

        /* Tabel biaya ops */
        .ops-list { display: flex; flex-direction: column; gap: 8px; margin-bottom: 10px; }
        .ops-row  { display: flex; gap: 8px; align-items: center; }
        .ops-input-nama {
            flex: 1; background: #f7fafc; color: #2d3748;
            padding: 9px 13px; border-radius: 9px; font-size: 13px;
            border: 2px solid #e2e8f0; font-family: 'Poppins', sans-serif;
            transition: border-color 0.2s;
        }
        .ops-input-nama:focus { outline: none; border-color: #ffb800; }
        .ops-input-nominal {
            width: 150px; background: #f7fafc; color: #2d3748;
            padding: 9px 13px; border-radius: 9px; font-size: 13px;
            border: 2px solid #e2e8f0; font-family: 'Poppins', sans-serif;
            transition: border-color 0.2s;
        }
        .ops-input-nominal:focus { outline: none; border-color: #ffb800; }
        .btn-hapus-ops {
            background: #fff5f5; border: 1.5px solid #fed7d7; color: #c53030;
            width: 34px; height: 34px; border-radius: 8px; font-size: 16px;
            cursor: pointer; display: flex; align-items: center; justify-content: center;
            flex-shrink: 0; transition: background 0.2s;
        }
        .btn-hapus-ops:hover { background: #fed7d7; }

        .btn-tambah-ops {
            background: none; border: 2px dashed #cbd5e0; color: #a0aec0;
            padding: 9px 16px; border-radius: 9px; font-size: 13px;
            font-family: 'Poppins', sans-serif; cursor: pointer; width: 100%;
            transition: border-color 0.2s, color 0.2s;
            margin-bottom: 18px;
        }
        .btn-tambah-ops:hover { border-color: #ffb800; color: #ffb800; }

        /* Hasil akhir */
        .hasil-box {
            background: #f7fafc; border-radius: 12px;
            border: 1.5px solid #e2e8f0; padding: 14px 18px;
            margin-bottom: 20px;
        }
        .hasil-row {
            display: flex; justify-content: space-between; align-items: center;
            padding: 6px 0; font-size: 13px;
        }
        .hasil-row .h-label { color: #718096; }
        .hasil-row .h-val   { font-family: 'Montserrat', sans-serif; font-weight: 700; color: #2d3748; font-size: 13px; }
        .hasil-row.divider-row { border-top: 1.5px solid #e2e8f0; margin-top: 6px; padding-top: 12px; }
        .hasil-row.divider-row .h-label { color: #2d3748; font-weight: 600; font-size: 14px; }
        .hasil-row.divider-row .h-val   { font-size: 20px; }
        .hasil-row.divider-row .h-val.untung { color: #276749; }
        .hasil-row.divider-row .h-val.rugi   { color: #c53030; }

        .modal-footer {
            display: flex; gap: 10px; justify-content: flex-end;
            padding-top: 4px;
        }
        .btn-modal-batal {
            background: #f7fafc; color: #718096;
            padding: 11px 22px; border-radius: 10px;
            border: 2px solid #e2e8f0; font-size: 14px;
            font-family: 'Poppins', sans-serif; font-weight: 600;
            cursor: pointer; transition: background 0.2s;
        }
        .btn-modal-batal:hover { background: #e2e8f0; }
        .btn-modal-cetak {
            background: #002b7f; color: white;
            padding: 11px 26px; border-radius: 10px;
            border: none; font-size: 14px;
            font-family: 'Poppins', sans-serif; font-weight: 600;
            cursor: pointer; display: flex; align-items: center; gap: 8px;
            transition: background 0.2s, transform 0.1s;
        }
        .btn-modal-cetak:hover { background: #7286D3; }
        .btn-modal-cetak:active { transform: scale(0.97); }

        @media (max-width: 768px) {
    .navbar {
        height: auto;
        flex-direction: column;
        padding: 15px;
        gap: 12px;
    }
    .nav-menu {
        gap: 8px;
        flex-wrap: wrap;
        justify-content: center;
    }
    .circle-icon { width: 44px; height: 44px; font-size: 20px; }
    .profile-section { width: 100%; justify-content: center; }

    .filter-container {
        padding: 15px;
        flex-direction: column;
        gap: 10px;
    }
    .btn-laporan-bulanan { margin-left: 0; width: 100%; justify-content: center; }
    .btn-filter { width: 100%; }

    .form-section { padding: 15px; }
    .form-grid {
        grid-template-columns: 1fr;
        gap: 10px;
    }
    .btn-tambah { width: 100%; }

    .table-section { padding: 15px 15px 0; }
    .scroll-wrapper { overflow-x: auto; }
    .main-table { min-width: 560px; }

    .summary-section {
        padding: 15px;
        grid-template-columns: 1fr;
    }
    .calc-grid { grid-template-columns: 1fr; }
    .calc-total-bar { grid-column: span 1; flex-direction: column; gap: 8px; }

    .modal-box { max-width: 100%; border-radius: 14px; }
    .modal-body { padding: 16px; }
    .modal-header { padding: 16px 20px; }
    .ops-row { flex-wrap: wrap; }
    .ops-input-nominal { width: 100%; }
    .modal-footer { flex-direction: column; }
    .btn-modal-cetak, .btn-modal-batal { width: 100%; justify-content: center; }
}
    </style>
</head>
<body>

{{-- NAVBAR --}}
<div class="navbar">
    <div class="nav-menu">
        <div class="menu-item" onclick="window.location.href='/dashboard/seller'">
            <div class="circle-icon">⌂</div>
            Dashboard
        </div>
        <div class="menu-item" onclick="window.location.href='/menu/create'">
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

{{-- FORM INPUT PEMBELIAN --}}
<div class="form-section">
    <div class="form-title">🛒 Input Data Pembelian (Modal)</div>
    <div class="form-grid">
        <div class="form-group">
            <label class="form-label">Nama Produk</label>
            <input type="text" class="form-input" id="input-product" placeholder="cth: Kopi Susu">
        </div>
        <div class="form-group">
            <label class="form-label">Jumlah (Qty)</label>
            <input type="number" class="form-input" id="input-qty" placeholder="cth: 10" min="1">
        </div>
        <div class="form-group">
            <label class="form-label">Harga Satuan (Rp)</label>
            <input type="number" class="form-input" id="input-price" placeholder="cth: 7000" min="0">
        </div>
        <button class="btn-tambah" id="btn-tambah" onclick="submitPembelian()">+ Tambah</button>
    </div>
    <div class="alert-success" id="alert-success">✅ <span id="success-msg">Pembelian berhasil dicatat!</span></div>
    <div class="alert-error-form" id="alert-error-form">⚠️ <span id="error-form-msg">Gagal.</span></div>
</div>

{{-- FILTER TANGGAL + TOMBOL LAPORAN BULANAN --}}
<div class="filter-container">
    <div class="filter-group">
        <span class="filter-label">Filter Tanggal</span>
        <input type="date" class="filter-input" id="filter-tanggal">
    </div>
    <button class="btn-filter" id="btn-tampilkan" onclick="loadLaporan()">Tampilkan</button>
    <button class="btn-laporan-bulanan" onclick="openModalLaporan()">
        📊 Laporan Bulanan
    </button>
</div>

{{-- ERROR LAPORAN --}}
<div class="alert-error" id="alert-error">
    ⚠️ <span id="error-msg">Gagal memuat data.</span>
</div>

{{-- TABLE --}}
<div class="table-section">
    <div class="table-title">📋 Ringkasan Laporan Keuangan</div>
    <div class="scroll-wrapper">
        <table class="main-table">
            <thead>
                <tr>
                    <th colspan="2" class="table-header-pembelian">🛒 PEMBELIAN</th>
                    <th style="background:#7286D3;width:3px;padding:0;"></th>
                    <th colspan="2" class="table-header-penjualan">💵 PENJUALAN</th>
                </tr>
                <tr class="sub-header">
                    <th>Keterangan</th>
                    <th class="right">Nominal</th>
                    <th class="divider"></th>
                    <th>Keterangan</th>
                    <th class="right">Nominal</th>
                </tr>
            </thead>
            <tbody id="table-body">
                <tr class="loading-row">
                    <td colspan="5"><span class="spinner"></span> Memuat data laporan...</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

{{-- SUMMARY --}}
<div class="summary-section">
    <div class="status-box loading" id="status-box">
        <div class="status-label">Total</div>
        <div class="status-value" id="status-value">—</div>
        <div class="status-badge" id="status-badge">Menghitung...</div>
    </div>
    <div class="calc-grid">
        <div class="calc-card card-pembelian">
            <div class="calc-card-label">Total Pengeluaran Stok</div>
            <div class="calc-card-value" id="val-pengeluaran">Rp —</div>
            <div class="calc-card-sub">Pembelian inventory</div>
        </div>
        <div class="calc-card card-penjualan">
            <div class="calc-card-label">Total Pendapatan Kotor</div>
            <div class="calc-card-value" id="val-pendapatan">Rp —</div>
            <div class="calc-card-sub">Dari seluruh penjualan</div>
        </div>
        <div class="calc-card card-hpp">
            <div class="calc-card-label">Harga Pokok Penjualan (HPP)</div>
            <div class="calc-card-value" id="val-hpp">Rp —</div>
            <div class="calc-card-sub">COGS barang terjual</div>
        </div>
        <div class="calc-card card-laba-kotor">
            <div class="calc-card-label">Laba Kotor</div>
            <div class="calc-card-value" id="val-laba-kotor">Rp —</div>
            <div class="calc-card-sub">Pendapatan - HPP</div>
        </div>
        <div class="calc-total-bar">
            <div>
                <div class="total-bar-label">Total Laba Bersih</div>
                <div class="total-bar-sub">Hasil akhir setelah semua perhitungan</div>
            </div>
            <div class="total-bar-value untung" id="val-laba-bersih">Rp —</div>
        </div>
    </div>
</div>

{{-- MODAL LAPORAN BULANAN --}}
<div class="modal-overlay" id="modal-overlay" onclick="handleOverlayClick(event)">
    <div class="modal-box" id="modal-box">

        <div class="modal-header">
            <div>
                <div class="modal-header-title">📊 Laporan Laba Rugi Bulanan</div>
                <div class="modal-header-sub">Tambahkan biaya operasional untuk mendapatkan laba bersih</div>
            </div>
            <button class="btn-close-modal" onclick="closeModalLaporan()">✕</button>
        </div>

        <div class="modal-body">

            {{-- Pilih Periode --}}
            <div class="modal-field-group">
                <label class="modal-field-label">Periode Laporan</label>
                <input type="month" class="modal-field-input" id="modal-periode">
            </div>

            {{-- Ringkasan dari API --}}
            <div class="modal-section-title">📈 Ringkasan dari Data</div>
            <div class="ringkasan-box">
                <div class="ringkasan-row">
                    <span class="r-label">Pendapatan Kotor</span>
                    <span class="r-val" id="m-pendapatan">Rp —</span>
                </div>
                <div class="ringkasan-row">
                    <span class="r-label">Harga Pokok Penjualan (HPP)</span>
                    <span class="r-val" id="m-hpp">Rp —</span>
                </div>
                <div class="ringkasan-row highlight">
                    <span class="r-label">Laba Kotor</span>
                    <span class="r-val" id="m-laba-kotor">Rp —</span>
                </div>
            </div>

            {{-- Biaya Operasional --}}
            <div class="modal-section-title">💸 Biaya Operasional</div>
            <div class="ops-list" id="ops-list"></div>
            <button class="btn-tambah-ops" onclick="tambahBiaysOps()">+ Tambah Biaya</button>

            {{-- Hasil Akhir --}}
            <div class="modal-section-title">✅ Hasil Akhir</div>
            <div class="hasil-box">
                <div class="hasil-row">
                    <span class="h-label">Laba Kotor</span>
                    <span class="h-val" id="hasil-laba-kotor">Rp —</span>
                </div>
                <div class="hasil-row">
                    <span class="h-label">Total Biaya Operasional</span>
                    <span class="h-val" id="hasil-total-ops">Rp 0</span>
                </div>
                <div class="hasil-row divider-row">
                    <span class="h-label">Laba Bersih</span>
                    <span class="h-val untung" id="hasil-laba-bersih">Rp —</span>
                </div>
            </div>

            <div class="modal-footer">
                <button class="btn-modal-batal" onclick="closeModalLaporan()">Batal</button>
                <button class="btn-modal-cetak" onclick="cetakLaporan()">🖨️ Cetak / Simpan PDF</button>
            </div>

        </div>
    </div>
</div>

<script>
    const API_BASE    = 'https://backend-lomba-php.onrender.com/api';
    const user = JSON.parse(localStorage.getItem("user"));
const token = localStorage.getItem("token");
if (!user || !token) window.location.href = "/login";
document.getElementById("namaUser").textContent = `Hallo, ${user.name}`;
const DEFAULT_UID = user.id;

    // State untuk laporan bulanan
    const reportState = {
        pendapatan : 0,
        hpp        : 0,
        labaKotor  : 0,
        ops        : []   // [{id, nama, nominal}]
    };

    // ============================================================
    // HELPERS
    // ============================================================
    function formatRp(val) {
        return 'Rp ' + Number(val ?? 0).toLocaleString('id-ID');
    }
    function formatRpNum(val) {
        return Math.round(Number(val ?? 0)).toLocaleString('id-ID');
    }

    // ============================================================
    // FORM PEMBELIAN — POST /api/purchases
    // ============================================================
    async function submitPembelian() {
        const productName = document.getElementById('input-product').value.trim();
        const quantity    = parseInt(document.getElementById('input-qty').value);
        const unitPrice   = parseInt(document.getElementById('input-price').value);

        if (!productName || !quantity || !unitPrice) {
            showFormError('Semua field wajib diisi!');
            return;
        }
        if (quantity < 1 || unitPrice < 0) {
            showFormError('Qty minimal 1 dan harga tidak boleh negatif.');
            return;
        }

        const btn = document.getElementById('btn-tambah');
        btn.disabled = true;
        btn.textContent = 'Menyimpan...';
        hideFormAlert();

        try {
            const res = await fetch(`${API_BASE}/purchases`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    // 'Authorization': 'Bearer ' + localStorage.getItem('token'),
                },
                body: JSON.stringify({
                    user_id:      DEFAULT_UID,
                    product_name: productName,
                    quantity:     quantity,
                    unit_price:   unitPrice,
                })
            });

            const json = await res.json();
            if (!res.ok || json.status !== 'success') {
                throw new Error(json.message || `HTTP ${res.status}`);
            }

            document.getElementById('input-product').value = '';
            document.getElementById('input-qty').value     = '';
            document.getElementById('input-price').value   = '';

            const newAvg = json.data?.purchase?.unit_price ?? unitPrice;
            showFormSuccess(`Pembelian dicatat! Stok bertambah ${quantity} unit, avg harga: ${formatRp(newAvg)}`);
            loadLaporan();

        } catch (err) {
            console.error('[Pembelian]', err);
            showFormError('Gagal menyimpan: ' + err.message);
        } finally {
            btn.disabled    = false;
            btn.textContent = '+ Tambah';
        }
    }

    function showFormSuccess(msg) {
        document.getElementById('success-msg').textContent = msg;
        document.getElementById('alert-success').style.display = 'block';
        document.getElementById('alert-error-form').style.display = 'none';
        setTimeout(() => document.getElementById('alert-success').style.display = 'none', 4000);
    }
    function showFormError(msg) {
        document.getElementById('error-form-msg').textContent = msg;
        document.getElementById('alert-error-form').style.display = 'block';
        document.getElementById('alert-success').style.display = 'none';
    }
    function hideFormAlert() {
        document.getElementById('alert-success').style.display    = 'none';
        document.getElementById('alert-error-form').style.display = 'none';
    }

    // ============================================================
    // LAPORAN — gabungan /finance-summary + /orders/merchant
    // ============================================================
    function setLoading(on) {
        const btn = document.getElementById('btn-tampilkan');
        btn.disabled    = on;
        btn.textContent = on ? 'Memuat...' : 'Tampilkan';
    }
    function showError(msg) {
        document.getElementById('error-msg').textContent = msg;
        document.getElementById('alert-error').style.display = 'block';
    }
    function hideError() {
        document.getElementById('alert-error').style.display = 'none';
    }

    // Hitung pendapatan dari data orders (harga jual)
    function hitungDariOrders(orders, filterTgl) {
        let pendapatan = 0;

        orders.forEach(order => {
            if (filterTgl) {
                const orderDate = order.created_at ? order.created_at.substring(0, 10) : '';
                if (orderDate !== filterTgl) return;
            }
            pendapatan += Number(order.total_price ?? 0);
        });

        return { pendapatan };
    }

    function renderTabel(pengeluaran, pendapatan, hpp) {
        const labaKotor  = pendapatan - hpp;

        const rows = [
            ['Pengeluaran Stok (Modal)',    pengeluaran, 'Pendapatan Kotor', pendapatan],
            ['Harga Pokok Penjualan (HPP)', hpp,         'Laba Kotor',      labaKotor],
            ['—',                           null,         'Laba Bersih',    labaKotor],
        ];

        let html = rows.map(r => `
            <tr class="data-row">
                <td>${r[0]}</td>
                <td class="right">${r[1] !== null ? formatRp(r[1]) : '—'}</td>
                <td class="divider"></td>
                <td>${r[2]}</td>
                <td class="right">${formatRp(r[3])}</td>
            </tr>
        `).join('');

        html += `
            <tr class="total-row">
                <td class="label">TOTAL PEMBELIAN</td>
                <td class="right">${formatRp(pengeluaran)}</td>
                <td class="divider"></td>
                <td class="label">TOTAL PENJUALAN</td>
                <td class="right">${formatRp(pendapatan)}</td>
            </tr>
        `;
        document.getElementById('table-body').innerHTML = html;
    }

    function renderSummary(pengeluaran, pendapatan, hpp) {
        const labaKotor = pendapatan - hpp;

        document.getElementById('val-pengeluaran').textContent = formatRp(pengeluaran);
        document.getElementById('val-pendapatan').textContent  = formatRp(pendapatan);
        document.getElementById('val-hpp').textContent         = formatRp(hpp);
        document.getElementById('val-laba-kotor').textContent  = formatRp(labaKotor);
        document.getElementById('val-laba-bersih').textContent = formatRp(Math.abs(labaKotor));

        // Simpan ke reportState untuk modal laporan bulanan
        reportState.pendapatan = pendapatan;
        reportState.hpp        = hpp;
        reportState.labaKotor  = labaKotor;

        const box    = document.getElementById('status-box');
        const barVal = document.getElementById('val-laba-bersih');
        box.classList.remove('loading', 'untung', 'rugi');

        if (labaKotor >= 0) {
            box.classList.add('untung');
            document.getElementById('status-value').textContent = 'UNTUNG';
            document.getElementById('status-badge').textContent = '📈 Laba Positif';
            barVal.className = 'total-bar-value untung';
        } else {
            box.classList.add('rugi');
            document.getElementById('status-value').textContent = 'RUGI';
            document.getElementById('status-badge').textContent = '📉 Laba Negatif';
            barVal.className = 'total-bar-value rugi';
        }
    }

    async function loadLaporan() {
        hideError();
        setLoading(true);

        document.getElementById('table-body').innerHTML = `
            <tr class="loading-row">
                <td colspan="5"><span class="spinner"></span> Memuat data laporan...</td>
            </tr>`;
        document.getElementById('status-box').className = 'status-box loading';
        document.getElementById('status-value').textContent = '—';
        document.getElementById('status-badge').textContent = 'Menghitung...';
        ['val-pengeluaran','val-pendapatan','val-hpp','val-laba-kotor','val-laba-bersih']
            .forEach(id => document.getElementById(id).textContent = 'Rp —');

        const filterTgl = document.getElementById('filter-tanggal').value; // "YYYY-MM-DD" atau ''

        try {
            // Fetch dua endpoint paralel
            const [resSummary, resOrders] = await Promise.all([
                fetch(`${API_BASE}/reports/finance-summary?user_id=${DEFAULT_UID}${filterTgl ? '&tanggal=' + filterTgl : ''}`, {
                    headers: { 'Accept': 'application/json' }
                }),
                fetch(`${API_BASE}/orders/merchant/${DEFAULT_UID}`, {
                    headers: { 'Accept': 'application/json' }
                })
            ]);

            // Parse summary untuk total pengeluaran stok (dari form pembelian)
            let pengeluaran = 0;
            if (resSummary.ok) {
                const jsonSummary = await resSummary.json();
                if (jsonSummary.status === 'success') {
                    pengeluaran = Number(jsonSummary.data?.total_pengeluaran_stok ?? 0);
                }
            }

            // Parse orders untuk hitung pendapatan aktual dari transaksi nyata
            let pendapatan = 0;
            if (resOrders.ok) {
                const orders = await resOrders.json();
                const hasil  = hitungDariOrders(Array.isArray(orders) ? orders : [], filterTgl);
                pendapatan   = hasil.pendapatan;
            } else {
                throw new Error(`Orders API: HTTP ${resOrders.status}`);
            }

            // HPP = total pengeluaran stok (modal beli ke supplier, diinput manual)
            // Laba Kotor = Pendapatan - HPP
            const hpp = pengeluaran;

            renderTabel(pengeluaran, pendapatan, hpp);
            renderSummary(pengeluaran, pendapatan, hpp);

        } catch (err) {
            console.error('[Laporan]', err);
            showError('Gagal memuat laporan: ' + err.message);
            document.getElementById('table-body').innerHTML = `
                <tr class="empty-row">
                    <td colspan="5">⚠️ Gagal memuat data. Periksa koneksi ke API.</td>
                </tr>`;
        } finally {
            setLoading(false);
        }
    }

    // ============================================================
    // MODAL LAPORAN BULANAN
    // ============================================================
    function openModalLaporan() {
        // Set default periode ke bulan ini
        const now = new Date();
        const yyyy = now.getFullYear();
        const mm   = String(now.getMonth() + 1).padStart(2, '0');
        document.getElementById('modal-periode').value = `${yyyy}-${mm}`;

        // Isi ringkasan dari state
        document.getElementById('m-pendapatan').textContent  = formatRp(reportState.pendapatan);
        document.getElementById('m-hpp').textContent         = formatRp(reportState.hpp);
        document.getElementById('m-laba-kotor').textContent  = formatRp(reportState.labaKotor);
        document.getElementById('hasil-laba-kotor').textContent = formatRp(reportState.labaKotor);

        // Default baris biaya ops jika kosong
        if (reportState.ops.length === 0) {
            tambahBiaysOps('Gaji Karyawan', 0);
            tambahBiaysOps('Listrik & Air', 0);
            tambahBiaysOps('Sewa Tempat', 0);
        }

        hitungHasilAkhir();
        renderOpsList();
        document.getElementById('modal-overlay').classList.add('open');
        document.body.style.overflow = 'hidden';
    }

    function closeModalLaporan() {
        document.getElementById('modal-overlay').classList.remove('open');
        document.body.style.overflow = '';
    }

    function handleOverlayClick(e) {
        if (e.target === document.getElementById('modal-overlay')) {
            closeModalLaporan();
        }
    }

    // Tambah baris biaya operasional
    function tambahBiaysOps(nama = '', nominal = 0) {
        const id = Date.now() + Math.random();
        reportState.ops.push({ id, nama, nominal });
        renderOpsList();
        hitungHasilAkhir();
    }

    // Hapus baris
    function hapusBiayaOps(id) {
        reportState.ops = reportState.ops.filter(o => o.id !== id);
        renderOpsList();
        hitungHasilAkhir();
    }

    // Update nilai dari input
    function updateOpsNama(id, val) {
        const row = reportState.ops.find(o => o.id === id);
        if (row) row.nama = val;
    }
    function updateOpsNominal(id, val) {
        const row = reportState.ops.find(o => o.id === id);
        if (row) { row.nominal = parseFloat(val) || 0; hitungHasilAkhir(); }
    }

    // Render ulang daftar biaya ops
    function renderOpsList() {
        const list = document.getElementById('ops-list');
        if (reportState.ops.length === 0) {
            list.innerHTML = '<div style="font-size:13px;color:#a0aec0;text-align:center;padding:10px 0;">Belum ada biaya operasional.</div>';
            return;
        }
        list.innerHTML = reportState.ops.map(o => `
            <div class="ops-row">
                <input
                    type="text"
                    class="ops-input-nama"
                    value="${escHtml(o.nama)}"
                    placeholder="Nama biaya (cth: Listrik)"
                    oninput="updateOpsNama(${o.id}, this.value)"
                >
                <input
                    type="number"
                    class="ops-input-nominal"
                    value="${o.nominal || ''}"
                    placeholder="0"
                    min="0"
                    oninput="updateOpsNominal(${o.id}, this.value)"
                >
                <button class="btn-hapus-ops" onclick="hapusBiayaOps(${o.id})" title="Hapus">✕</button>
            </div>
        `).join('');
    }

    // Hitung dan tampilkan hasil akhir
    function hitungHasilAkhir() {
        const totalOps   = reportState.ops.reduce((s, o) => s + (o.nominal || 0), 0);
        const labaBersih = reportState.labaKotor - totalOps;

        document.getElementById('hasil-laba-kotor').textContent  = formatRp(reportState.labaKotor);
        document.getElementById('hasil-total-ops').textContent   = formatRp(totalOps);

        const elVal = document.getElementById('hasil-laba-bersih');
        if (labaBersih >= 0) {
            elVal.textContent = formatRp(labaBersih);
            elVal.className   = 'h-val untung';
        } else {
            elVal.textContent = '- ' + formatRp(Math.abs(labaBersih));
            elVal.className   = 'h-val rugi';
        }
    }

    // Escape HTML untuk value input
    function escHtml(str) {
        return String(str).replace(/&/g,'&amp;').replace(/"/g,'&quot;').replace(/</g,'&lt;').replace(/>/g,'&gt;');
    }

    // Cetak PDF
    function cetakLaporan() {
        const periode  = document.getElementById('modal-periode').value || 'Tidak dipilih';
        const totalOps = reportState.ops.reduce((s, o) => s + (o.nominal || 0), 0);
        const labaBersih = reportState.labaKotor - totalOps;

        // Format periode jadi "Januari 2025"
        let periodeLabel = periode;
        try {
            const [y, m] = periode.split('-');
            periodeLabel = new Date(y, parseInt(m) - 1, 1)
                .toLocaleDateString('id-ID', { month: 'long', year: 'numeric' });
        } catch(e) {}

        const opsRows = reportState.ops.length > 0
            ? reportState.ops.map(o => `
                <tr>
                    <td style="padding:7px 0; color:#555; border-bottom:1px solid #f0f0f0;">${escHtml(o.nama) || '—'}</td>
                    <td style="text-align:right; padding:7px 0; color:#555; border-bottom:1px solid #f0f0f0;">
                        Rp ${Math.round(o.nominal || 0).toLocaleString('id-ID')}
                    </td>
                </tr>`).join('')
            : `<tr><td colspan="2" style="color:#aaa; padding:7px 0; font-style:italic;">Tidak ada biaya operasional</td></tr>`;

        const html = `<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Laporan Laba Rugi — ${periodeLabel}</title>
<style>
  body { font-family: 'Poppins', Arial, sans-serif; margin: 0; padding: 40px; color: #222; max-width: 680px; margin: auto; }
  .logo-bar { display: flex; justify-content: space-between; align-items: flex-end; margin-bottom: 30px; }
  h1 { font-size: 22px; font-weight: 800; color: #002b7f; margin: 0; }
  .sub { color: #718096; font-size: 13px; margin-top: 4px; }
  .badge { background: #002b7f; color: white; padding: 4px 14px; border-radius: 20px; font-size: 11px; font-weight: 600; }
  table { width: 100%; border-collapse: collapse; margin-bottom: 6px; }
  .section-title { font-size: 11px; font-weight: 700; text-transform: uppercase; letter-spacing: 1px; color: #a0aec0; margin: 22px 0 8px; }
  .total-row td { font-weight: 700; border-top: 2px solid #e2e8f0; padding-top: 12px; }
  .final-row td { font-size: 17px; font-weight: 800; color: ${labaBersih >= 0 ? '#002b7f' : '#c53030'}; border-top: 3px solid ${labaBersih >= 0 ? '#002b7f' : '#c53030'}; padding-top: 14px; }
  .footer { margin-top: 50px; font-size: 11px; color: #a0aec0; border-top: 1px solid #e2e8f0; padding-top: 14px; display: flex; justify-content: space-between; }
</style>
</head>
<body>
  <div class="logo-bar">
    <div>
      <h1>Laporan Laba Rugi</h1>
      <div class="sub">Periode: ${periodeLabel}</div>
    </div>
    <div class="badge">LAPORAN KEUANGAN</div>
  </div>

  <div class="section-title">Pendapatan & HPP</div>
  <table>
    <tr>
      <td style="padding:8px 0; border-bottom:1px solid #f0f0f0;">Pendapatan Kotor</td>
      <td style="text-align:right; padding:8px 0; border-bottom:1px solid #f0f0f0; font-weight:600;">Rp ${Math.round(reportState.pendapatan).toLocaleString('id-ID')}</td>
    </tr>
    <tr>
      <td style="padding:8px 0; color:#555; border-bottom:1px solid #f0f0f0;">Harga Pokok Penjualan (HPP)</td>
      <td style="text-align:right; padding:8px 0; color:#555; border-bottom:1px solid #f0f0f0;">- Rp ${Math.round(reportState.hpp).toLocaleString('id-ID')}</td>
    </tr>
    <tr class="total-row">
      <td style="padding:8px 0;">Laba Kotor</td>
      <td style="text-align:right; padding:8px 0;">Rp ${Math.round(reportState.labaKotor).toLocaleString('id-ID')}</td>
    </tr>
  </table>

  <div class="section-title">Biaya Operasional</div>
  <table>
    ${opsRows}
    <tr class="total-row">
      <td style="padding:8px 0;">Total Biaya Operasional</td>
      <td style="text-align:right; padding:8px 0;">- Rp ${Math.round(totalOps).toLocaleString('id-ID')}</td>
    </tr>
  </table>

  <table style="margin-top:18px;">
    <tr class="final-row">
      <td style="padding:8px 0;">Laba Bersih</td>
      <td style="text-align:right; padding:8px 0;">${labaBersih < 0 ? '- ' : ''}Rp ${Math.round(Math.abs(labaBersih)).toLocaleString('id-ID')}</td>
    </tr>
  </table>

  <div class="footer">
    <span>Dicetak: ${new Date().toLocaleString('id-ID')}</span>
    <span>Laporan otomatis — sistem POS</span>
  </div>
</body>
</html>`;

        const w = window.open('', '_blank');
        if (w) {
            w.document.write(html);
            w.document.close();
            w.focus();
            setTimeout(() => w.print(), 400);
        } else {
            alert('Popup diblokir browser. Silakan izinkan popup untuk mencetak laporan.');
        }
    }

    // ============================================================
    // INIT
    // ============================================================
    document.addEventListener('DOMContentLoaded', loadLaporan);
</script>

</body>
</html>