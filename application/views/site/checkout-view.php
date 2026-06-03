

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body { background: #f8f9fa; }

        .card {
            border-radius: 12px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.08);
        }

        .qr-box {
            text-align: center;
            padding: 15px;
            background: #fff;
            border-radius: 10px;
        }

        .total-box {
            font-size: 18px;
            font-weight: bold;
        }
    </style>
</head>
<body>

<div class="container mt-5">
    <div class="row">

        <!-- 🧾 Customer Details -->
        <div class="col-md-7">
            <div class="card p-4">
                <h4 class="mb-3">Billing Details</h4>

                <form method="post" action="<?= base_url('cart/checkout'); ?>">

                    <div class="mb-3">
                        <label>Name</label>
                        <input type="text" name="name" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label>Phone</label>
                        <input type="text" name="phone" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label>Address</label>
                        <textarea name="address" class="form-control" required></textarea>
                    </div>

                    <button type="submit" class="btn btn-success w-100">
                        Place Order
                    </button>

                </form>
            </div>
        </div>

        <!-- 🛒 Order Summary + QR -->
        <div class="col-md-5">
            <div class="card p-4">

                <h4 class="mb-3">Order Summary</h4>

                <?php $total = 0; ?>
                <?php foreach ($cart as $item): ?>
                    <?php $total += $item->subtotal; ?>
                    <div class="d-flex justify-content-between">
                        <span><?= $item->name; ?> (x<?= $item->quantity; ?>)</span>
                        <span>₹<?= $item->subtotal; ?></span>
                    </div>
                <?php endforeach; ?>

                <hr>

                <div class="d-flex justify-content-between total-box">
                    <span>Total</span>
                    <span>₹<?= $total; ?></span>
                </div>

                <hr>

                <!-- 🧾 QR Code Payment -->
                <div class="qr-box mt-3">
                    <h6>Scan & Pay</h6>

                    <!-- Static QR (replace with dynamic later) -->
                    <img src="https://api.qrserver.com/v1/create-qr-code/?size=200x200&data=upi://pay?pa=yourupi@bank&pn=Shop&am=<?= $total; ?>" 
                         alt="QR Code">

                    <p class="mt-2 text-muted">UPI Payment</p>
                </div>

            </div>
        </div>

    </div>
</div>