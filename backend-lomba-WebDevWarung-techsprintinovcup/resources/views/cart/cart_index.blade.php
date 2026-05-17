<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container py-5">

    <h2 class="mb-4">Cart Menu</h2>

    {{-- ALERT --}}
    <div id="alertBox"></div>

    {{-- ADD TO CART --}}
    <div class="card mb-4 shadow-sm">
        <div class="card-body">

            <h5 class="mb-3">Tambah Produk ke Cart</h5>

            <form id="cartForm">

                <div class="mb-3">
                    <label class="form-label">Product ID</label>
                    <input type="number" class="form-control" id="product_id">
                </div>

                <div class="mb-3">
                    <label class="form-label">Quantity</label>
                    <input type="number" class="form-control" id="qty" value="1">
                </div>

                <button type="submit" class="btn btn-primary">
                    Add To Cart
                </button>

            </form>

        </div>
    </div>

    {{-- CART TABLE --}}
    <div class="card shadow-sm">
        <div class="card-body">

            <h5 class="mb-3">Cart List</h5>

            <table class="table table-bordered">

                <thead>
                    <tr>
                        <th>Product ID</th>
                        <th>Qty</th>
                        <th>Action</th>
                    </tr>
                </thead>

                <tbody id="cartTableBody">

                </tbody>

            </table>

        </div>
    </div>

</div>

<script>

    // SIMPAN CART SEMENTARA DI LOCAL
    let carts = [];

    // FORM SUBMIT
    document.getElementById('cartForm').addEventListener('submit', async function(e){

        e.preventDefault();

        let product_id = parseInt(document.getElementById('product_id').value);
        let qty = parseInt(document.getElementById('qty').value);

        let payload = {
            product_id: product_id,
            qty: qty
        };

        console.log(payload);

        try {

            const response = await fetch('https://backend-lomba-php.onrender.com/api/carts', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'Authorization': `Bearer ${localStorage.getItem("token")}`
                },
                body: JSON.stringify(payload)
            });

            const data = await response.json();

            console.log(data);

            if(response.ok){

                // MASUKKAN KE ARRAY CART
                carts.push(payload);

                // REFRESH TABLE
                renderCart();

                document.getElementById('alertBox').innerHTML = `
                    <div class="alert alert-success">
                        Produk berhasil ditambahkan ke cart
                    </div>
                `;

                // RESET INPUT
                document.getElementById('product_id').value = '';
                document.getElementById('qty').value = 1;

            } else {

                document.getElementById('alertBox').innerHTML = `
                    <div class="alert alert-danger">
                        ${data.message ?? 'Gagal tambah cart'}
                    </div>
                `;

            }

        } catch(error){

            console.log(error);

            document.getElementById('alertBox').innerHTML = `
                <div class="alert alert-danger">
                    Server Error
                </div>
            `;

        }

    });

    // RENDER TABLE
    function renderCart(){

        let table = document.getElementById('cartTableBody');

        table.innerHTML = '';

        carts.forEach((item, index) => {

            table.innerHTML += `
                <tr>
                    <td>${item.product_id}</td>
                    <td>${item.qty}</td>
                    <td>
                        <button class="btn btn-danger btn-sm"
                            onclick="removeCart(${index})">
                            Delete
                        </button>
                    </td>
                </tr>
            `;

        });

    }

    // DELETE CART
    function removeCart(index){

        carts.splice(index, 1);

        renderCart();

    }

</script>

</body>
</html>