<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pembayaran QRIS</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@700&family=Poppins:wght@400;600&display=swap" rel="stylesheet">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body.payment-body {
            background-color: #f5f5f5;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            position: relative;
        }

        /* Tombol Kembali */
        .btn-back {
            position: absolute;
            top: 30px;
            left: 30px;
            width: 45px;
            height: 45px;
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: white;
            border-radius: 50%;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
            transition: 0.3s;
            text-decoration: none;
        }

        .btn-back svg {
            width: 28px;
            height: 28px;
            transition: 0.3s;
        }

        .btn-back:hover {
            transform: scale(1.1);
            background-color: #7286D3;
        }

        .btn-back:hover svg path {
            stroke: white;
        }

        .btn-back:hover {
            transform: scale(1.1);
        }

        /* Kartu QRIS */
        .qris-card {
            background-color: #001a57;
            width: 100%;
            max-width: 480px;
            border-radius: 40px;
            padding: 40px;
            text-align: center;
            color: white;
            position: relative;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            margin: 20px;
        }

        .qris-card h2 {
            color: #ffb800;
            font-size: 32px;
            margin-bottom: 25px;
            font-family: 'Montserrat', sans-serif;
        }

        .qr-container {
            background-color: white;
            border-radius: 30px;
            padding: 25px;
            display: flex;
            justify-content: center;
            align-items: center;
            margin-bottom: 20px;
        }

        .qr-container img {
            width: 100%;
            max-width: 300px;
            height: auto;
        }

        .qris-card p {
            color: #ffb800;
            font-size: 14px;
            margin-bottom: 40px;
        }

        /* Tombol Download/Selesai */
        .btn-download {
            position: absolute;
            bottom: 25px;
            right: 25px;
            background-color: #aeb9d7;
            width: 50px;
            height: 50px;
            border-radius: 12px;
            display: flex;
            justify-content: center;
            align-items: center;
            transition: 0.3s;
            color: #001a57; 
        }

        .btn-download svg {
            width: 26px;
            height: 26px;
            fill: none;
        }

        .btn-download:hover {
            background-color: #ffb800;
            transform: scale(1.1);
            color: white;
        }
    </style>
</head>

<body class="payment-body">

    <a href="#" class="btn-back">
        <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M15 19L8 12L15 5" stroke="#7286D3" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
    </a>

    <div class="qris-card">
        <h2 id="total-tagihan">Rp. 0.00</h2>

        <div class="qr-container">
            <!-- <img src="{{ asset('1x/qr.jpg') }}" alt="QRIS Code"> -->
        </div>

        <p>Pembayaran Hanya Menggunakan Qris</p>

        <a href="#" class="btn-download">
            <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path d="M12 15V3m0 12l-4-4m4 4l4-4" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M20 17v2a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2v-2" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
        </a>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Mengambil data dari localStorage yang disimpan di halaman sebelumnya
            const keranjang = JSON.parse(localStorage.getItem('keranjang')) || [];
            let totalSemua = 0;

            // Menghitung total harga
            keranjang.forEach(item => {
                totalSemua += item.harga;
            });

            // Update teks di HTML jika total lebih dari 0
            const displayTotal = document.getElementById('total-tagihan');
            if (totalSemua > 0) {
                displayTotal.innerText = `Rp. ${totalSemua.toLocaleString('id-ID')}.00`;
            } else {
                displayTotal.innerText = `Rp. 00.000.00`;
            }
        });
    </script>
</body>

</html>