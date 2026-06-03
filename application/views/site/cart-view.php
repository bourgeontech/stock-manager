
<style>
    .section {
  min-height: 100vh;
  background: #f4f6f9;
  padding: 2.5rem 1rem;
}

/* ── Container ── */
.container {
  max-width: 860px;
  margin: 0 auto;
  background: #ffffff;
  border-radius: 12px;
  padding: 2rem 2.5rem;
  box-shadow: 0 4px 24px rgba(0, 0, 0, 0.08);
}

/* ── Heading ── */
.container h2 {
  font-size: 1.6rem;
  font-weight: 700;
  color: #1a1a2e;
  margin-bottom: 1.5rem;
  padding-bottom: 0.75rem;
  border-bottom: 2px solid #e8ecf0;
}

/* ── Table ── */
.table {
  width: 100%;
  border-collapse: collapse;
  margin-bottom: 1.5rem;
  font-size: 0.92rem;
}

.table thead tr {
  background: #1a1a2e;
  color: #ffffff;
}

.table thead th {
  padding: 0.85rem 1rem;
  text-align: left;
  font-weight: 600;
  letter-spacing: 0.04em;
  text-transform: uppercase;
  font-size: 0.78rem;
}

.table-bordered th,
.table-bordered td {
  border: 1px solid #e2e8f0;
}

.table tbody tr {
  transition: background 0.18s;
}

.table tbody tr:hover {
  background: #f8fafc;
}

.table tbody tr:nth-child(even) {
  background: #fafbfd;
}

.table tbody tr:nth-child(even):hover {
  background: #f1f5f9;
}

.table tbody td {
  padding: 0.85rem 1rem;
  color: #374151;
  vertical-align: middle;
}

/* First column — product name */
.table tbody td:first-child {
  font-weight: 600;
  color: #1a1a2e;
}

/* Price & Subtotal columns */
.table tbody td:nth-child(2),
.table tbody td:nth-child(4) {
  color: #0d6efd;
  font-weight: 600;
}

/* ── Total ── */
.container h4 {
  text-align: right;
  font-size: 1.15rem;
  font-weight: 700;
  color: #1a1a2e;
  margin-bottom: 1.5rem;
  padding: 0.75rem 1rem;
  background: #f0f4ff;
  border-radius: 8px;
  border-left: 4px solid #0d6efd;
}

/* ── Buttons ── */
.btn {
  display: inline-block;
  padding: 0.6rem 1.4rem;
  font-size: 0.88rem;
  font-weight: 600;
  border-radius: 8px;
  text-decoration: none;
  cursor: pointer;
  border: none;
  transition: all 0.22s;
  letter-spacing: 0.03em;
  margin-right: 0.6rem;
}

.btn-secondary {
  background: #e2e8f0;
  color: #374151;
}

.btn-secondary:hover {
  background: #cbd5e1;
  color: #1a1a2e;
}

.btn-success {
  background: #16a34a;
  color: #ffffff;
  box-shadow: 0 3px 12px rgba(22, 163, 74, 0.3);
}

.btn-success:hover {
  background: #15803d;
  box-shadow: 0 5px 18px rgba(22, 163, 74, 0.4);
  transform: translateY(-1px);
}

/* ── Responsive ── */
@media (max-width: 600px) {
  .container {
    padding: 1.2rem 1rem;
  }

  .table thead th,
  .table tbody td {
    padding: 0.65rem 0.6rem;
    font-size: 0.82rem;
  }

  .container h4 {
    font-size: 1rem;
  }

  .btn {
    display: block;
    width: 100%;
    text-align: center;
    margin: 0.4rem 0;
  }
}
</style>
<div class="page-banner">
  <span class="lbl">Devotional Treasures</span>
  <h1 class="sec-title">🛕 Temple Shop — For Sale</h1>
  <div class="breadcrumb"><a href="index.html">Home</a><span>›</span><span style="color:var(--gold-lt);">Temple Shop</span></div>
</div>

<section class="section">
 

      <!-- FILTER SIDEBAR -->
     

      <!-- PRODUCTS AREA -->
    

        <!-- Products are injected here by renderShop() -->
        
          <div class="container ">
    <h2>Shopping Cart</h2>

    <table class="table table-bordered ">
        <thead>
            <tr>
                <th>Product</th>
                <th>Price</th>
                <th>Qty</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>

        <?php $total = 0; ?>
        <?php foreach ($cart as $item): ?>
            <?php $total += $item->subtotal; ?>
            <tr>
                <td><?= $item->name; ?></td>
                <td>₹<?= $item->price; ?></td>
                <td><?= $item->quantity; ?></td>
                <td>₹<?= $item->subtotal; ?></td>
            </tr>
        <?php endforeach; ?>

        </tbody>
    </table>

    <h4>Total: ₹<?= $total; ?></h4>

    <a href="<?= base_url(); ?>" class="btn btn-secondary">Continue Shopping</a>

    <a href="<?= base_url('index.php/Welcome/checkout'); ?>" class="btn btn-success">
        Proceed to Checkout
    </a>

  </div>
</section>

<!-- WHY BUY -->
<section class="section" style="background:var(--cream-dark);padding:48px 0;">
  <div class="container">
    <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(190px,1fr));gap:18px;" class="fade-up">
      <div style="text-align:center;padding:20px 14px;"><div style="font-size:2rem;margin-bottom:8px;">🙏</div><div style="font-family:'Cinzel',serif;font-size:.82rem;color:var(--maroon);margin-bottom:5px;">Blessed Items</div><div style="font-size:.74rem;color:var(--text-light);line-height:1.55;">All items are consecrated and blessed at the mandir before dispatch.</div></div>
      <div style="text-align:center;padding:20px 14px;"><div style="font-size:2rem;margin-bottom:8px;">🚚</div><div style="font-family:'Cinzel',serif;font-size:.82rem;color:var(--maroon);margin-bottom:5px;">Pan India Delivery</div><div style="font-size:.74rem;color:var(--text-light);line-height:1.55;">We deliver across India. Free shipping on orders above ₹999.</div></div>
      <div style="text-align:center;padding:20px 14px;"><div style="font-size:2rem;margin-bottom:8px;">💯</div><div style="font-family:'Cinzel',serif;font-size:.82rem;color:var(--maroon);margin-bottom:5px;">Pure &amp; Authentic</div><div style="font-size:.74rem;color:var(--text-light);line-height:1.55;">Only pure, authentic materials sourced for temple offerings.</div></div>
      <div style="text-align:center;padding:20px 14px;"><div style="font-size:2rem;margin-bottom:8px;">🔒</div><div style="font-family:'Cinzel',serif;font-size:.82rem;color:var(--maroon);margin-bottom:5px;">Secure Payments</div><div style="font-size:.74rem;color:var(--text-light);line-height:1.55;">Pay safely via UPI, card, net banking or cash on delivery.</div></div>
      <div style="text-align:center;padding:20px 14px;"><div style="font-size:2rem;margin-bottom:8px;">↩️</div><div style="font-family:'Cinzel',serif;font-size:.82rem;color:var(--maroon);margin-bottom:5px;">Easy Returns</div><div style="font-size:.74rem;color:var(--text-light);line-height:1.55;">Hassle-free returns within 7 days of delivery for eligible items.</div></div>
  
</section>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).on('click', '.add-to-cart', function() {

    let productId = $(this).data('id');
     let url="<?= base_url('index.php/Welcome/addtocart'); ?>";

    $.ajax({
        url: url,
        type: "POST",
        data: {
            product_id: productId
        },
        success: function(response) {
            alert(response);
        },
        error: function() {
            alert("Error adding to cart");
        }
    });
});
</script>
<script>
function loadCartCount() {
    $.ajax({
        url: "<?= base_url('index.php/Welcome/count'); ?>",
        type: "GET",
        success: function(data) {
            $('#cart-count').text(data);
        }
    });
}
function loadCartPreview() {
    $.ajax({
        url: "<?= base_url('index.php/Welcome/preview'); ?>",
        type: "GET",
        success: function(data) {
            $('#cart-preview').html(data);
        }
    });
}
// Load count on page load
$(document).ready(function() {
    loadCartCount();
});

$('#cartDropdown').on('click', function() {
    loadCartPreview();
});


</script>
