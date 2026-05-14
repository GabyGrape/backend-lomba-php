<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Pesanan - Ayam Bakar</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@700&family=Poppins:wght@400;600&display=swap" rel="stylesheet">
</head>
<style>
    .detail-body {
        background-color: #f5f5f5;
        min-height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
        padding: 20px;
        position: relative;
    }

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

    .detail-card {
        display: flex;
        flex-direction: row;
        align-items: center;
        gap: 50px;
        max-width: 1000px;
        width: 100%;
        padding-bottom: 100px;
        position: relative;
    }

    .image-container {
        flex: 0 0 450px;
        border: 5px solid #7286D3;
        border-radius: 40px;
        overflow: hidden;
        aspect-ratio: 1/1;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .image-container img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .info-container {
        flex: 1;
    }

    .info-container h1 {
        color: #ffb800;
        font-size: 56px;
        font-family: 'Montserrat', sans-serif;
        margin-bottom: 10px;
    }

    .info-container p {
        color: #7286D3;
        font-size: 20px;
        margin-bottom: 30px;
    }

    .price-qty {
        display: flex;
        align-items: center;
        gap: 40px;
        margin-bottom: 30px;
        margin-top: 15px;
    }

    .price-tag {
        color: #7286D3;
        font-size: 32px;
        font-weight: bold;
        white-space: nowrap;
        margin: 0;
    }

    .qty-box {
        position: absolute; 
        left: 950px;   
        top: 50%;               
        display: flex;
        align-items: center;
        gap: 15px;
        background: #f0f0f0;
        padding: 10px 20px;
        border-radius: 15px;
        z-index: 20; 
    }

    .qty-box button {
        background: none;
        border: none;
        font-size: 24px;
        color: #001a57;
        cursor: pointer;
    }


/* button tambah menu, pembayaran, total belanja */

    .footer-nav {
        position: fixed;
        left: 100px;
        bottom: 40px;
        right: 50px;
        z-index: 100;
    }

    .footer-wrapper {
        display: flex;
        flex-direction: column;
        align-items: flex-end;
        gap: 15px;
    }

    .action-btns {
        display: flex;
        flex-direction: row;
        gap: 15px;
    }

    .total-text {
        color: #7286D3;
        font-size: 22px;
        font-weight: 600;
        margin-bottom: 5px;
    }

    .btn-blue {
        background-color: #001a57;
        color: white;
        padding: 15px 35px;
        border-radius: 15px;
        border: none;
        cursor: pointer;
        font-weight: bold;
        text-align: center;
    }
</style>
<body class="detail-body">

<!-- button kembali -->
    <a href="#" class="btn-back">
        <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M15 19L8 12L15 5" stroke="#7286D3" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
    </a>

    <div class="detail-card">

        <div class="image-container"># </div>

        <div class="qty-box">
                    <button onclick="
                    {
                        let countEl = document.getElementById('qty-count');
                        let totalEl = document.getElementById('display-total');
                        let val = parseInt(countEl.innerText);
                        if(val > 1) {
                            val--;
                            countEl.innerText = val;
                            totalEl.innerText = 'Total Belanja Rp. ' + (val * 20000).toLocaleString('id-ID');
                        }
                    }">-</button>

                    <span id="qty-count">1</span>
                    <button onclick="
                    {
                        let countEl = document.getElementById('qty-count');
                        let totalEl = document.getElementById('display-total');
                        let val = parseInt(countEl.innerText);
                        val++;
                        countEl.innerText = val;
                        totalEl.innerText = 'Total Belanja Rp. ' + (val * 20000).toLocaleString('id-ID');
                    }">+</button>
        </div>

        <!-- <div class="info-container">
            <h1>Ayam Bakar</h1>
            <p>Ayam Bakar, Timun, Kol Goreng, Sambal</p>

            <div class="price-qty">
                <span class="price-tag">Rp. 20.000</span> -->

                
            </div>
        </div>
    </div>

    <div class="footer-nav">
        <div class="footer-wrapper">
            <span class="total-text" id="display-total">Total Belanja Rp. 20.000</span>
            <div class="action-btns">
                <button class="btn-blue">Tambah Menu</button>
                <button onclick="window.location.href='#'" class="btn-blue">Pembayaran</button>
            </div>
        </div>
    </div>
</body>

</html>