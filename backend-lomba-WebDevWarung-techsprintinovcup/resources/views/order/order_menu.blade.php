<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Menu</title>

    {{-- BOOTSTRAP --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container py-5">

    <h2 class="mb-4">Create Order</h2>

    <div class="card shadow-sm">
        <div class="card-body">

            {{-- ALERT --}}
            <div id="alertBox"></div>

            {{-- FORM --}}
            <form id="orderForm">

                {{-- MERCHANT --}}
                <div class="mb-3">
                    <label class="form-label">Merchant ID</label>
                    <input type="number" class="form-control" id="merchant_id" value="1">
                </div>

                {{-- PICKUP --}}
                <div class="mb-3">
                    <label class="form-label">Pickup Plan</label>
                    <input type="datetime-local" class="form-control" id="pickup_plan_at">
                </div>

                <hr>

                <h5 class="mb-3">Order Items</h5>

                {{-- ITEMS --}}
                <div id="itemsContainer">

                    <div class="row mb-3 item-row">

                        <div class="col-md-4">
                            <label class="form-label">Product ID</label>
                            <input type="number" class="form-control product_id">
                        </div>

                        <div class="col-md-3">
                            <label class="form-label">Quantity</label>
                            <input type="number" class="form-control quantity">
                        </div>

                        <div class="col-md-3">
                            <label class="form-label">Price</label>
                            <input type="number" class="form-control price">
                        </div>

                        <div class="col-md-2 d-flex align-items-end">
                            <button type="button" class="btn btn-danger removeItem">
                                Remove
                            </button>
                        </div>

                    </div>

                </div>

                {{-- BUTTON ADD --}}
                <button type="button" class="btn btn-secondary mb-3" id="addItem">
                    + Add Item
                </button>

                <br>

                {{-- SUBMIT --}}
                <button type="submit" class="btn btn-primary">
                    Submit Order
                </button>

            </form>

        </div>
    </div>

</div>

<script>

    // ADD ITEM
    document.getElementById('addItem').addEventListener('click', function () {

        let item = `
            <div class="row mb-3 item-row">

                <div class="col-md-4">
                    <input type="number" class="form-control product_id" placeholder="Product ID">
                </div>

                <div class="col-md-3">
                    <input type="number" class="form-control quantity" placeholder="Quantity">
                </div>

                <div class="col-md-3">
                    <input type="number" class="form-control price" placeholder="Price">
                </div>

                <div class="col-md-2">
                    <button type="button" class="btn btn-danger removeItem">
                        Remove
                    </button>
                </div>

            </div>
        `;

        document.getElementById('itemsContainer')
            .insertAdjacentHTML('beforeend', item);

    });

    // REMOVE ITEM
    document.addEventListener('click', function(e){

        if(e.target.classList.contains('removeItem')) {
            e.target.closest('.item-row').remove();
        }

    });

    // SUBMIT ORDER
    document.getElementById('orderForm').addEventListener('submit', async function(e){

        e.preventDefault();

        let items = [];

        document.querySelectorAll('.item-row').forEach(row => {

            items.push({
                product_id: parseInt(row.querySelector('.product_id').value),
                quantity: parseInt(row.querySelector('.quantity').value),
                price: parseInt(row.querySelector('.price').value)
            });

        });

        // HITUNG TOTAL
        let total_price = 0;

        items.forEach(item => {
            total_price += item.quantity * item.price;
        });

        // PAYLOAD
        let payload = {
            merchant_id: parseInt(document.getElementById('merchant_id').value),
            total_price: total_price,
            pickup_plan_at: document.getElementById('pickup_plan_at').value.replace('T', ' ') + ':00',
            items: items
        };

        console.log(payload);

        try {

            const response = await fetch('http://127.0.0.1:8000/api/orders', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'

                    // kalau pakai token:
                    // 'Authorization': 'Bearer TOKEN'
                },
                body: JSON.stringify(payload)
            });

            const data = await response.json();

            console.log(data);

            if(response.ok){

                document.getElementById('alertBox').innerHTML = `
                    <div class="alert alert-success">
                        Order berhasil dibuat
                    </div>
                `;

            } else {

                document.getElementById('alertBox').innerHTML = `
                    <div class="alert alert-danger">
                        ${data.message ?? 'Gagal create order'}
                    </div>
                `;

            }

        } catch(error){

            console.log(error);

            document.getElementById('alertBox').innerHTML = `
                <div class="alert alert-danger">
                    Server error
                </div>
            `;

        }

    });

</script>

</body>
</html>