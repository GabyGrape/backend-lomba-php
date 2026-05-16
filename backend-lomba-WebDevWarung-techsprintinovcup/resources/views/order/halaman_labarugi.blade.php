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

        /* NAVBAR */
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
        .profile { width: 50px; height: 50px; border-radius: 50%; background: #7286D3; border-radius: 50%; }

        /* FILTER - hanya tanggal */
        .filter-container {
            display: flex; gap: 15px; align-items: flex-end;
            padding: 20px 40px; background: white;
            border-bottom: 1px solid #e2e8f0;
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

        /* FORM INPUT PEMBELIAN */
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

        /* TABLE */
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

        /* SUMMARY */
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
        <div>Hallo, <strong>{{ auth()->user()->name ?? 'Pengguna' }}</strong></div>
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

{{-- FILTER TANGGAL --}}
<div class="filter-container">
    <div class="filter-group">
        <span class="filter-label">Filter Tanggal</span>
        <input type="date" class="filter-input" id="filter-tanggal">
    </div>
    <button class="btn-filter" id="btn-tampilkan" onclick="loadLaporan()">Tampilkan</button>
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

<script>
    const API_BASE    = 'http://127.0.0.1:8000/api';
    const DEFAULT_UID = {{ auth()->id() ?? 1 }};

    function formatRp(val) {
        return 'Rp ' + Number(val ?? 0).toLocaleString('id-ID');
    }

    // ============================================================
    // FORM PEMBELIAN — POST /api/purchases
    // ============================================================
    async function submitPembelian() {
        const productName = document.getElementById('input-product').value.trim();
        const quantity    = parseInt(document.getElementById('input-qty').value);
        const unitPrice   = parseInt(document.getElementById('input-price').value);

        // Validasi
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

            // Sukses — reset form, tampilkan notif, reload laporan
            document.getElementById('input-product').value = '';
            document.getElementById('input-qty').value     = '';
            document.getElementById('input-price').value   = '';

            const newAvg = json.data?.purchase?.unit_price ?? unitPrice;
            showFormSuccess(`Pembelian dicatat! Stok bertambah ${quantity} unit, avg harga: ${formatRp(newAvg)}`);

            // Reload laporan supaya angka terupdate
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
    // LAPORAN — GET /api/reports/finance-summary
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

    function renderTabel(d) {
        const rows = [
            ['Pengeluaran Stok',      d.total_pengeluaran_stok,      'Pendapatan Kotor', d.total_pendapatan_kotor],
            ['Harga Pokok Penjualan', d.total_harga_pokok_penjualan, 'Laba Kotor',       d.total_laba_kotor],
            ['—',                     null,                           'Laba Bersih',      d.total_laba_bersih],
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
                <td class="right">${formatRp(d.total_pengeluaran_stok)}</td>
                <td class="divider"></td>
                <td class="label">TOTAL PENJUALAN</td>
                <td class="right">${formatRp(d.total_pendapatan_kotor)}</td>
            </tr>
        `;
        document.getElementById('table-body').innerHTML = html;
    }

    function renderSummary(d) {
        document.getElementById('val-pengeluaran').textContent = formatRp(d.total_pengeluaran_stok);
        document.getElementById('val-pendapatan').textContent  = formatRp(d.total_pendapatan_kotor);
        document.getElementById('val-hpp').textContent         = formatRp(d.total_harga_pokok_penjualan);
        document.getElementById('val-laba-kotor').textContent  = formatRp(d.total_laba_kotor);
        document.getElementById('val-laba-bersih').textContent = formatRp(Math.abs(d.total_laba_bersih));

        const box    = document.getElementById('status-box');
        const barVal = document.getElementById('val-laba-bersih');
        box.classList.remove('loading', 'untung', 'rugi');

        if (d.total_laba_bersih >= 0) {
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

        const params = new URLSearchParams({ user_id: DEFAULT_UID });
        const tgl = document.getElementById('filter-tanggal').value;
        if (tgl) params.append('tanggal', tgl);

        try {
            const res = await fetch(`${API_BASE}/reports/finance-summary?${params}`, {
                headers: {
                    'Accept': 'application/json',
                    // 'Authorization': 'Bearer ' + localStorage.getItem('token'),
                }
            });

            if (!res.ok) throw new Error(`HTTP ${res.status} — ${res.statusText}`);
            const json = await res.json();
            if (json.status !== 'success') throw new Error(json.message || 'Response tidak valid');

            renderTabel(json.data);
            renderSummary(json.data);

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

    document.addEventListener('DOMContentLoaded', loadLaporan);
</script>

</body>
</html>