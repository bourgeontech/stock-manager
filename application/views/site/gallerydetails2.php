
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
       <?php
                if(!empty($galleryDetails)){ 
                      foreach ($galleryDetails as $value) {
                        $originalDate = $value['created'];
                        $newDate = date("d-m-Y", strtotime($originalDate));
                        
                      ?>
                <li> 
             <a class='sb' href='../../../uploads/gallery/<?PHP echo $value['image']; ?>' title='gallery'>
             <img alt='' title='' src='../../../uploads/gallery/<?PHP echo $value['image']; ?>' /></a> </li>
             <?php
                        }}
                        else {?>
                  <li> 
             <a class='sb' href='../../uploads/gallery/<?PHP echo $value['image']; ?>' title='gallery'>
             <img alt='' title='' src='../../uploads/gallery/<?PHP echo $value['image']; ?>' /></a> </li>
                     <?php   }
                        ?>
             </ul>
                    </div>
                    </div>

</section>

<!-- MISSION -->


<!-- DEITIES -->


<!-- FOUNDATION BOX -->
<section style="padding:0 0 60px;">
  <div class="container">
    <div class="foundation-box fade-up">
        <div class="fb-text">
        <h3>🏛️ Sadhana Charitable Foundation</h3>
        <p>The temple is managed under the Sadhana Charitable Foundation, a legally registered non-profit organisation in Maharashtra. The Foundation ensures transparency, proper management of funds, and the continued service of the community in religious and social matters.</p>
        <a href="https://shrituljabhavaniparas.org/index.php/worldline/donation" class="btn-primary" style="margin-top:18px;display:inline-block;">Support the Foundation →</a>
      </div>
      <div class="fb-details">
        <div class="fb-row"><div class="fb-icon">📋</div><div class="fb-info"><small>Registration No.</small><strong>U85300MH2019NPL334216</strong></div></div>
        <div class="fb-row"><div class="fb-icon">🆔</div><div class="fb-info"><small>DARPAN ID</small><strong>MH/2024/0444650</strong></div></div>
        <div class="fb-row"><div class="fb-icon">📍</div><div class="fb-info"><small>Registered Address</small><strong>Paras, TQ Balapur, Dist. Akola – 444109</strong></div></div>
        <div class="fb-row"><div class="fb-icon">📞</div><div class="fb-info"><small>Contact</small><strong>9822535654 / 8788097975</strong></div></div>
        <div class="fb-row"><div class="fb-icon">✉️</div><div class="fb-info"><small>Email</small><strong>sadhanagroup.org@gmail.com</strong></div></div>
      </div>
    </div>
  </div>
</section>

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
<div class="toast" id="toast"></div>

</body>
</html>
