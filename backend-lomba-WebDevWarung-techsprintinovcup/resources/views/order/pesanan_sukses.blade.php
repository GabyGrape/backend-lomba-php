<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pembayaran Sukses</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@700&family=Poppins:wght@400;600&display=swap" rel="stylesheet">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body.success-body {
            background-color: #f5f5f5;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            position: relative;
        }
        /* Tombol Kembali (SVG) */
        .btn-back {
            position: absolute;
            top: 30px;
            left: 30px;
            width: 50px;
            height: 50px;
            background-color: white;
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
            transition: 0.3s;
            text-decoration: none;
        }

        .btn-back:hover {
            transform: scale(1.1);
            background-color: #7286D3;
        }

        .btn-back svg {
            width: 25px;
            height: 25px;
            stroke: #001a57;
        }

        .btn-back:hover svg {
            stroke: white;
        }

        /* Kartu Sukses */
        .success-card {
            background-color: #001a57;
            border-radius: 45px;
            padding: 50px;
            text-align: center;
            color: white;
            width: 100%;
            max-width: 450px;
            display: flex;
            flex-direction: column;
            align-items: center;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            margin: 20px;
        }

        .success-card h1 {
            color: #ffb800;
            font-size: 32px;
            margin-bottom: 30px;
            font-family: 'Montserrat', sans-serif;
        }

        .white-box {
            background: white;
            border-radius: 35px;
            padding: 40px;
            margin-bottom: 25px;
            width: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .check-svg {
            width: 180px;
            height: 180px;
            filter: drop-shadow(0 4px 10px rgba(0,0,0,0.1));
        }

        .success-card p {
            font-size: 16px;
            margin-bottom: 30px;
            opacity: 0.9;
        }

        .btn-status {
            display: inline-block;
            background-color: #7286D3;
            color: white;
            text-decoration: none;
            padding: 15px 40px;
            border-radius: 15px;
            font-weight: bold;
            font-size: 18px;
            transition: 0.3s;
            width: 100%;
        }

        .btn-status:hover {
            background-color: #5b6db3;
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.2);
        }
    </style>
</head>

<body class="success-body">

    <a href="dashboard_consument" class="btn-back">
        <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M15 19L8 12L15 5" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
    </a>

    <div class="success-card">
        <h1>Pembayaran Sukses</h1>
        
        <div class="white-box">
            <svg class="check-svg" viewBox="0 0 512 512" xmlns="http://www.w3.org/2000/svg">
                <circle cx="256" cy="256" r="200" fill="#4CAF50"/>
                <path d="M362.6 192.9L224 331.5l-74.6-74.6c-6.2-6.2-16.4-6.2-22.6 0s-6.2 16.4 0 22.6l85.9 85.9c6.2 6.2 16.4 6.2 22.6 0l149.9-149.9c6.2-6.2 6.2-16.4 0-22.6s-16.3-6.2-22.6 0z" fill="white"/>
                <path d="M100 150l10 30 30 10-30 10-10 30-10-30-30-10 30-10z" fill="#81C784"/>
                <path d="M400 200l8 24 24 8-24 8-8 24-8-24-24-8 24-8z" fill="#81C784"/>
            </svg>
        </div>
        
        <p>Terimakasih sudah melakukan pembayaran</p>
        
        <a href="status_pesanan" class="btn-status">Cek Status Pesanan</a>
    </div>

</body>

</html>