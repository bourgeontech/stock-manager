
<style>
    .gallery_body {
      list-style: none;
      padding: 0;
      margin: 0;
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
      gap: 20px;
    }

    .gallery_body li {
      text-align: center;
    }

    .gallery_body img {
      width: 100%;
      height: auto;
      border-radius: 8px;
      margin-bottom: 10px;
    }

    /* Optional: Center-align the heading */
    .gallery_body p {
      text-align: center;
    }

    /* Optional: Add hover effect */
    .gallery_body a:hover img {
      opacity: 0.8;
      transition: 0.3s;
    }
  </style>


<!-- PAGE BANNER -->
<div class="page-banner">
  <span class="lbl">The Sacred Abode</span>
  <h1 class="sec-title">GALLERY </h1>
  <div class="breadcrumb">
    <a href="index.html">Home</a>
    <span>›</span>
    <span style="color:var(--gold-lt);">Temple Priest</span>
  </div>
</div>

                   
<!-- MAIN ABOUT -->
<section class="section">
  <div class="container">
    <div class="about-intro fade-up">
       <ul class='gallery_body'>
           <?php    if ($this->db->field_exists('qr_home', 'site_settings') && $this->db->field_exists('bank_home', 'site_settings')) {
    $query = $this->db->select('qr_home, bank_home')
                      ->from('site_settings')
                      ->limit(1)
                      ->get();
    
    if ($query->num_rows() > 0) {
        $row = $query->row();

        if ($row->qr_home == 1 && $row->bank_home == 1) {?>
              <div class='col-lg-12 text-center'>
           <h2 class='title1 text-center'>QR CODE  & BANK DETAILS</h2>
          </div>
           
             <div class='col-lg-12 text-center'>
               
              <img src="<?php echo base_url(); ?>/assets/new_site/images/qr-bank-details.jpeg" style="width:100%;"> 
               </div>
              <?php } } }?>
                <div class='inner_pak'>
                    <?php 
                    $a=$this->db->query("SELECT id,name From diety WHERE online='1' ORDER BY order_ ASC ");
                    $diety_id=$a->result_array();
                
                    foreach ($diety_id as $id){
                        $diety=$id['name'];
                        $id=$id['id'];
                        $this->db->select('diety_pooja.*,pooja.name_mal as pooja_nm,pooja.rate as pooja_rt');
                        $this->db->from('diety_pooja');
                        $this->db->join('pooja','pooja.id = diety_pooja.pooja_id');
                        $this->db->where('diety_pooja.temple_id', $id);
                    	
                        $query = $this->db->get()->result_array();
                        
                        if(count($query)>0){
                    ?>
                 <div class="accordion" id="accordionExample">

    <!-- Panel 1 -->
    <div class="accordion-item">
      <h2 class="accordion-header">
        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#panel1">
          Panel 1
        </button>
      </h2>
      <div id="panel1" class="accordion-collapse collapse show" data-bs-parent="#accordionExample">
        <div class="accordion-body">
          <ul>
            <li>Item 1</li>
            <li>Item 2</li>
            <li>Item 3</li>
          </ul>
        </div>
      </div>
    </div>
                    <?php
                    }
                    }
                    ?>
                    </div>
                    </div>

</section>

<!-- MISSION -->


<!-- DEITIES -->


<!-- TRUSTEE / COMMITTEE -->


<!-- FOUNDATION BOX -->


<!-- FOOTER -->
<footer>
  <div class="container">
    <div class="footer-grid">
      <div><div class="f-logo-text">🪷 AAI TULJA BHAVANI MANDIR</div><p class="f-desc">A sacred centre of faith at Paras, Akola. Established through Sadhana Charitable Foundation. Reg: U85300MH2019NPL334216 · DARPAN ID: MH/2024/0444650</p></div>
      <div><div class="f-head">Quick Links</div><ul class="f-links"><li><a href="index.html">Home</a></li><li><a href="about.html">About Temple</a></li><li><a href="news.html">News & Events</a></li><li><a href="shop.html">Temple Shop</a></li><li><a href="https://shrituljabhavaniparas.org/index.php/welcome/gallery">Gallery</a></li></ul></div>
      <div><div class="f-head">Policies</div><ul class="f-links"><li><a href="https://shrituljabhavaniparas.org/index.php/welcome/termsandconditions">Terms & Conditions</a></li><li><a href="https://shrituljabhavaniparas.org/index.php/welcome/privacypolicy">Privacy Policy</a></li><li><a href="https://shrituljabhavaniparas.org/index.php/welcome/cancellationpolicy">Refund Policy</a></li><li><a href="https://shrituljabhavaniparas.org/index.php/welcome/rules">Temple Rules</a></li></ul></div>
      <div class="f-contact"><div class="f-head">Contact</div><p>📍 Paras, TQ Balapur, Dist. Akola – 444109</p><p style="margin-top:6px;">📞 <a href="tel:9822535654">9822535654</a> / <a href="tel:8788097975">8788097975</a></p><p>✉️ <a href="mailto:sadhanagroup.org@gmail.com">sadhanagroup.org@gmail.com</a></p><div class="f-cta-row"><a href="https://shrituljabhavaniparas.org/index.php/worldline/booking" class="f-cta f-cta-book">Book Pooja</a><a href="https://shrituljabhavaniparas.org/index.php/worldline/donation" class="f-cta f-cta-donate">Donate</a></div></div>
    </div>
    <div class="footer-bottom"><p>© 2025 Aai Tulja Bhavani Mandir · Sadhana Charitable Foundation</p><p>🕉️ जय तुळजाभवानी 🕉️</p></div>
  </div>
</footer>

<!-- CART / CHECKOUT (same on every page) -->
<div class="overlay" id="cartOverlay" onclick="closeCart()"></div>
<div class="cart-drawer" id="cartDrawer">
  <div class="cd-head"><h3>🛒 Your Cart</h3><button class="cd-close" onclick="closeCart()">✕</button></div>
  <div class="cd-list" id="cdList"><div class="cd-empty"><div class="cd-empty-icon">🪔</div><p>Your cart is empty.<br><a href="shop.html" style="color:var(--saffron);">Visit the shop!</a></p></div></div>
  <div class="cd-foot" id="cdFoot" style="display:none;"><div class="cd-trow"><span>Subtotal</span><span id="cdSubtotal">₹0</span></div><div class="cd-trow"><span>Shipping</span><span>₹50</span></div><div class="cd-trow grand"><span>Total</span><span id="cdTotal">₹0</span></div><button class="cd-proceed" onclick="openCheckout()">✨ Proceed to Checkout</button></div>
</div>
<div class="modal-wrap" id="checkoutModal">
  <div class="modal-box">
    <div class="mo-head"><h3>🙏 Checkout</h3><button class="cd-close" onclick="closeCheckout()">✕</button></div>
    <div class="mo-body" id="moForm"><div class="os-box" id="moSummary"></div><span class="lbl" style="margin-bottom:11px;display:block;">📦 Delivery Details</span><input class="f-ctrl" id="moName" placeholder="Full Name *"><div class="two-col"><input class="f-ctrl" id="moPhone" placeholder="Phone *"><input class="f-ctrl" id="moEmail" placeholder="Email" type="email"></div><textarea class="f-ctrl" id="moAddr" rows="2" placeholder="Address *"></textarea><div class="two-col"><input class="f-ctrl" id="moCity" placeholder="City *"><input class="f-ctrl" id="moPin" placeholder="Pincode *" maxlength="6"></div><select class="f-ctrl" id="moState"><option>Maharashtra</option><option>Gujarat</option><option>Madhya Pradesh</option><option>Karnataka</option><option>Other</option></select><span class="lbl" style="margin-bottom:8px;display:block;">💳 Payment</span><select class="f-ctrl" id="moPayment"><option>UPI / GPay</option><option>Cash on Delivery</option><option>Net Banking</option><option>Card</option></select><button class="mo-place" onclick="placeOrder()">🙏 Place Order — <span id="moTotal">₹0</span></button></div>
    <div class="order-ok" id="moSuccess" style="display:none;"><div class="ok-icon">🎉</div><h3>Order Confirmed!</h3><p>Jay Tulja Bhavani 🙏</p><div class="order-id" id="moOrderId"></div><button class="mo-place" onclick="closeCheckout()">Continue</button></div>
  </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<div class="toast" id="toast"></div>

</body>
</html>
