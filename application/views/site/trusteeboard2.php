

<!-- PAGE BANNER -->
<div class="page-banner">
  <span class="lbl">The Sacred Abode</span>
  <h1 class="sec-title">WHO IS WHO </h1>
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
       <ul class="list clearfix ">
                      <?php
                      foreach ($trusteeboard as $value) {
                      ?>
                      <li>   
                     <div class='image-block'><img src='../../uploads/trustee/<?PHP echo $value['image']; ?>' width='263' height='157' alt='' title=''></div>
                        <div class='person_info'>
                          <h4 class='name'><?php echo $value['name'];?></h4>
                          <div class='desig'><?php echo $value['designation'];?></div>
                        </div>
                      </li>
                      <?php
                        }
                        ?>
                    </ul>
                    </div>

</section>

<!-- MISSION -->
<section class="section mission-bg">
  <div class="container">
    <div class="fade-up" style="text-align:center;">
      <span class="lbl" style="display:flex;justify-content:center;color:var(--gold-lt);">Our Purpose</span>
      <h2 class="sec-title" style="color:var(--gold-pale);margin:0 auto;">Mission & Values</h2>
    </div>
    <div class="mission-grid fade-up">
      <div class="mission-card"><div class="mc-icon">🙏</div><h3>Devotion</h3><p>Providing a sacred space for daily worship, prayer, and devotion to Maa Tulja Bhavani.</p></div>
      <div class="mission-card"><div class="mc-icon">🤝</div><h3>Community</h3><p>Fostering unity and brotherhood among devotees through festivals and collective service.</p></div>
      <div class="mission-card"><div class="mc-icon">🎓</div><h3>Education</h3><p>Promoting knowledge of Hindu traditions, rituals, and the significance of the goddess.</p></div>
      <div class="mission-card"><div class="mc-icon">🌱</div><h3>Service</h3><p>Charitable activities through Sadhana Foundation serving the underprivileged community.</p></div>
      <div class="mission-card"><div class="mc-icon">🏛️</div><h3>Preservation</h3><p>Maintaining and developing the temple infrastructure for future generations of devotees.</p></div>
    </div>
  </div>
</section>

<!-- DEITIES -->
<section class="section" style="background:var(--cream-dark);">
  <div class="container">
    <div class="fade-up" style="text-align:center;margin-bottom:36px;">
      <span class="lbl" style="display:flex;justify-content:center;">Presiding Deity</span>
      <h2 class="sec-title" style="margin:0 auto;">Maa Tulja Bhavani</h2>
    </div>
    <div style="display:grid;grid-template-columns:1fr 1fr;gap:40px;align-items:center;" class="fade-up">
      <div>
        <img src="../../uploads/aboutus/<?php echo $value['image']; ?>" alt="Maa Tulja Bhavani" style="width:100%;border-radius:var(--r);box-shadow:var(--sh-warm);">
      </div>
      <div>
        <span class="lbl">The Goddess</span>
        <h3 class="sec-title">श्री तुळजाभवानी माता</h3>
        <div class="divider"><span>✦ ॐ ✦</span></div>
        <p class="sec-sub">Maa Tulja Bhavani is a powerful form of the Divine Mother — Shakti — worshipped widely across Maharashtra. She is the Kuldevi (family goddess) of millions of devotees and is believed to protect her children from all evil and grant their heartfelt wishes.</p>
        <p class="sec-sub" style="margin-top:10px;">The original Tulja Bhavani temple is in Tuljapur, Osmanabad. Our Paras mandir brings the same divine energy and blessings closer to the local community, providing a sanctified space for daily worship and annual festivals.</p>
        <div style="display:flex;gap:10px;margin-top:20px;flex-wrap:wrap;">
          <a href="https://shrituljabhavaniparas.org/index.php/welcome/dietys" class="btn-outline">View All Deities</a>
          <a href="https://shrituljabhavaniparas.org/index.php/worldline/booking" class="btn-primary">Book Pooja</a>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- TRUSTEE / COMMITTEE -->
<section class="section">
  <div class="container">
    <div class="fade-up" style="text-align:center;margin-bottom:8px;">
      <span class="lbl" style="display:flex;justify-content:center;">Leadership</span>
      <h2 class="sec-title" style="margin:0 auto;">Temple Committee</h2>
      <p class="sec-sub" style="margin:10px auto 0;text-align:center;">Our dedicated committee members work tirelessly to serve Maa Bhavani and the devotee community.</p>
    </div>
    <div class="committee-grid fade-up">
      <div class="cmember"><div class="cm-avatar">👤</div><div class="cm-name">Trustee Member</div><div class="cm-role">Chairman</div></div>
      <div class="cmember"><div class="cm-avatar">👤</div><div class="cm-name">Temple Priest</div><div class="cm-role">Head Priest</div></div>
      <div class="cmember"><div class="cm-avatar">👤</div><div class="cm-name">Secretary</div><div class="cm-role">Festival Committee</div></div>
      <div class="cmember"><div class="cm-avatar">👤</div><div class="cm-name">Treasurer</div><div class="cm-role">Finance</div></div>
      <div class="cmember"><div class="cm-avatar">👤</div><div class="cm-name">Member</div><div class="cm-role">Paripalana Samithi</div></div>
    </div>
    <p style="text-align:center;margin-top:22px;font-size:.8rem;color:var(--text-light);">For full trustee details, visit the <a href="https://shrituljabhavaniparas.org/index.php/welcome/trusteeboard" style="color:var(--saffron);">Trustee Board page</a>.</p>
  </div>
</section>

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
