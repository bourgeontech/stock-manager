<style>
.cards-grid {
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
  gap: 1.5rem;
  padding: 1.5rem;
}

/* Card */
.card {
  background: #fff;
  border-radius: 12px;
  overflow: hidden;
  box-shadow: 0 2px 12px rgba(0, 0, 0, 0.1);
  transition: transform 0.25s, box-shadow 0.25s;
}

.card:hover {
  transform: translateY(-4px);
  box-shadow: 0 8px 28px rgba(0, 0, 0, 0.15);
}

/* Image */
.card img {
  width: 100%;
  height: 200px;
  object-fit: cover;
  display: block;
}

/* Card body */
.card-body {
  padding: 1rem 1.2rem 1.2rem;
}

.card-title {
  font-size: 1rem;
  font-weight: 700;
  margin: 0 0 0.4rem;
  color: #1a1a1a;
}

.card-text {
  font-size: 0.875rem;
  color: #666;
  line-height: 1.6;
  margin: 0;
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
    <div class="cards-grid">

        <?php foreach ($salesitems as $value) { ?>    <div class="card"> 
                <img src="<?php echo base_url();?>uploads/products/<?php echo $value['photo'];?>" class="card-img-top" alt="Product" width="100px" height="100px">
                <div class="card-body text-center">
                    <h5 class="card-title"><?php echo $value['name'];?></h5>
                    <p class="card-text"><?php echo $value['rate'];?></p>
                    <button class="btn btn-primary add-to-cart" data-id="<?php echo $value['id'];?>">
    Add to Cart
</button>
                </div>
        
        </div> <?php } ?>

        <!-- Product 2 -->
        
            
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
    </div>
  </div>
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
