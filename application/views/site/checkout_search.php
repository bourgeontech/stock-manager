
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body { background: #f5f5f5; }
        .card { border-radius: 12px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
    </style>

<div class="page-banner">
  <span class="lbl">Devotional Treasures</span>
  <h1 class="sec-title">🛕 Temple Shop — For Sale</h1>
  <div class="breadcrumb"><a href="index.html">Home</a><span>›</span><span style="color:var(--gold-lt);">Temple Shop</span></div>
</div>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">

            <div class="card p-4">

                <h4 class="mb-3">Checkout</h4>

                <!-- 🔍 Search Phone -->
              <div class="mb-3">
                    <label>Enter Phone Number</label>
                    <input type="text" id="search-phone" class="form-control" placeholder="Enter phone">
                </div>

                <button class="btn btn-primary mb-3 w-100" onclick="searchUser()">
                    Search
                </button>

                <hr>

                <!-- 🧾 User Form -->
                <form method="post" action="<?= base_url('index.php/Welcome/process'); ?>">

                    <input type="hidden" name="user_id" id="user_id">

                    <div class="mb-3">
                        <label>Name</label>
                        <input type="text" name="name" id="name" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label>Phone</label>
                        <input type="text" name="phone" id="phone" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label>Address</label>
                        <textarea name="address" id="address" class="form-control" required></textarea>
                    </div>

                    <button type="submit" class="btn btn-success w-100">
                        Proceed to Payment
                    </button>

                </form>

            </div>

        </div>
    </div>
</div>



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
function searchUser() {
    let phone = $('#search-phone').val();

    if (!phone) {
        alert('Enter phone number');
        return;
    }

    $.ajax({
        url: "<?= base_url('index.php/Welcome/search_user'); ?>",
        type: "POST",
        data: { phone: phone },
        dataType: "json",
        success: function(res) {

            if (res.status == 'found') {
                $('#user_id').val(res.data.id);
                $('#name').val(res.data.name);
                $('#phone').val(res.data.mobile);
                $('#address').val(res.data.address);
            } else {
                alert('User not found. Please enter details.');
                $('#user_id').val('');
                $('#phone').val(phone);
                $('#name').val('');
                $('#address').val('');
            }
        }
    });
}
</script>
