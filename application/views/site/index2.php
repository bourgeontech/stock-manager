



  <!-- HERO -->
  <section class="hero" id="hero">
    <?php 
                foreach ($banner as $value){
                ?> <div class="slide active"><img src="../../uploads/banner/<?PHP echo $value['image']; ?>"
        alt="Temple" loading="eager"></div><?php } ?>
    
    <div class="hero-overlay"></div>
    <div class="hero-content">
      <div class="hero-deva">🙏 आई तुळजाभवानी मंदिर – परास, जि. अकोला 🙏</div>
      <h1 class="hero-h1">Aai <em>Tulja Bhavani</em> Mandir</h1>
      <p class="hero-sub">PARAS · TQ BALAPUR · DIST. AKOLA – 444109</p>
      <div class="hero-ctas">
        <a href="https://shrituljabhavaniparas.org/index.php/worldline/booking" class="hero-cta cta-gold">📅 Book Pooja
          Online</a>
        <a href="shop.html" class="hero-cta cta-saffron">🛕 Temple Shop</a>
        <a href="https://shrituljabhavaniparas.org/index.php/worldline/donation" class="hero-cta cta-ghost">💛 Donate
          Now</a>
      </div>
    </div>
    <button class="s-arrow s-prev" onclick="moveSlide(-1)">&#8249;</button>
    <button class="s-arrow s-next" onclick="moveSlide(1)">&#8250;</button>
    <div class="s-dots" id="sDots"></div>
  </section>

  <!-- STATS BAR -->
  <div class="stats-bar">
    <div class="stats-inner">
      <div class="stat-cell"><span class="stat-icon">🪷</span>
        <div>
          <div class="stat-label">Established</div>
          <div class="stat-val">Ancient Mandir</div>
        </div>
      </div>
      <div class="stat-cell"><span class="stat-icon">🙏</span>
        <div>
          <div class="stat-label">Daily Poojas</div>
          <div class="stat-val">Archana & Sankalp</div>
        </div>
      </div>
      <div class="stat-cell"><span class="stat-icon">📅</span>
        <div>
          <div class="stat-label">Service</div>
          <div class="stat-val">Online Booking</div>
        </div>
      </div>
      <div class="stat-cell"><span class="stat-icon">📍</span>
        <div>
          <div class="stat-label">Location</div>
          <div class="stat-val">Paras, Akola</div>
        </div>
      </div>
    </div>
  </div>

  <!-- ABOUT -->
  <section class="section">
    <div class="container">
      <div class="about-grid fade-up">
        <div class="about-img-wrap">
          <img class="about-img"
            src="https://shrituljabhavaniparas.org/uploads/banner/WhatsApp_Image_2025-11-25_at_10_37_03.jpeg"
            alt="Temple">
          <div class="about-badge"><strong>🕉️</strong><span>Sadhana Foundation</span></div>
        </div>
        <div>
          <span class="lbl">Our Sacred Abode</span>
          <h2 class="sec-title">Aai Tulja Bhavani Mandir</h2>
          <div class="divider"><span>✦ ॐ ✦</span></div>
          <p class="sec-sub">AAI TULJA BHAVANI MANDIR, recently developed at Paras, Dist Akola, through the Sadhana
            Charitable Foundation (U85300MH2019NPL334216) — DARPAN ID: MH/2024/0444650. A centre of faith, devotion and
            community service.</p>
          <p class="sec-sub" style="margin-top:10px;">We welcome all devotees to offer prayers, perform poojas, and seek
            the blessings of Aai Tulja Bhavani. Online booking and donation facilities are available.</p>
          <div class="trust-row">
            <div class="trust-item"><span class="ti-icon">✅</span> Registered Foundation</div>
            <div class="trust-item"><span class="ti-icon">✅</span> DARPAN Certified</div>
            <div class="trust-item"><span class="ti-icon">✅</span> Online Services</div>
          </div>
          <a href="about.html" class="btn-outline" style="margin-top:22px;">Read More About Temple →</a>
        </div>
      </div>
    </div>
  </section>

  <!-- SERVICES -->
  <section class="section services-wrap">
    <div class="container">
      <div class="fade-up" style="text-align:center;">
        <span class="lbl" style="justify-content:center;display:flex;">Available Poojas</span>
        <h2 class="sec-title" style="margin:0 auto;">Divine Services</h2>
      </div>
      <div class="services-grid fade-up">
        <div class="svc-card">
          <div class="svc-icon">🌸</div>
          <div class="svc-deva">अर्चना</div>
          <div class="svc-name">ARCHANA</div>
          <div class="svc-desc">Offer sacred flowers and prayers to Maa Tulja Bhavani with full mantras.</div>
        </div>
        <div class="svc-card">
          <div class="svc-icon">🔱</div>
          <div class="svc-deva">संकल्प</div>
          <div class="svc-name">SANKALP</div>
          <div class="svc-desc">Make a sacred vow and dedication to the goddess for blessings.</div>
        </div>
        <div class="svc-card">
          <div class="svc-icon">🪔</div>
          <div class="svc-deva">आरती</div>
          <div class="svc-name">AARTI</div>
          <div class="svc-desc">Join morning and evening aarti — experience divine energy and devotion.</div>
        </div>
        <div class="svc-card">
          <div class="svc-icon">🥥</div>
          <div class="svc-deva">पंचामृत अभिषेक</div>
          <div class="svc-name">ABHISHEK</div>
          <div class="svc-desc">Sacred bathing of the deity with panchamrit — milk, curd, honey, ghee.</div>
        </div>
        <div class="booking-cta">
          <h3>📅 Book Your Pooja Online</h3>
          <p>Reserve your slot for Archana, Sankalp or special pooja from anywhere.</p>
          <a href="https://shrituljabhavaniparas.org/index.php/worldline/booking" class="btn-gold">Book Now →</a>
        </div>
      </div>
    </div>
  </section>

  <!-- EVENTS + GALLERY -->
  <section class="section" style="background:var(--cream-dark);">
    <div class="container">
      <div class="eg-grid">
        <div class="fade-up">
          <span class="lbl">Latest</span>
          <h2 class="sec-title">Events & Festivals</h2>
          <div style="display:flex;flex-direction:column;gap:14px;margin-top:22px;">
            <div class="ev-card">
              <img class="ev-img"
                src="../../uploads/events/<?php print_r($events[0]['image']);?>"
              <div class="ev-info">
                <h4><?php print_r($events[0]['title']);?></h4>
                <p><?php print_r($events[0]['description']);?></p>
              </div>
            </div>
            <div class="ev-card">
              <div
                style="background:linear-gradient(135deg,var(--gold-pale),#ffd080);height:100px;display:flex;align-items:center;justify-content:center;font-size:2.6rem;">
                🎉</div>
              <div class="ev-info">
                <h4>🔱 Navratri Mahotsav</h4>
                <p>Nine nights of devotion and prayers dedicated to Maa Bhavani. Special pooja arrangements.</p>
              </div>
            </div>
          </div>
          <a href="news.html" class="btn-outline" style="margin-top:16px;display:inline-block;">View All News & Events
            <?php
if ($this->db->field_exists('qr_home', 'site_settings') && $this->db->field_exists('bank_home', 'site_settings')) {
    $query = $this->db->select('qr_home, bank_home')
                      ->from('site_settings')
                      ->limit(1)
                      ->get();
    
    if ($query->num_rows() > 0) {
        $row = $query->row();

        if ($row->qr_home == 1 && $row->bank_home == 1) {?>
          <img src="<?php echo base_url(); ?>/assets/new_site/images/utsavam-eroor-pic.jpeg" 
          alt="" style="width:100%;"> <?php } } } ?>
          </a>
        </div>
        <div class="fade-up">
          <span class="lbl">Photos</span>
          <h2 class="sec-title">Temple Gallery</h2>
          <div class="mosaic" style="margin-top:22px;">
           <?php 
                foreach ($gallery_list as $value){
                ?>
                <ul class="gallery">
    <li><img src="'../../uploads/gallery/<?PHP echo $value['image']; ?>' height="240px" alt=""></li>
    
  </ul>
             <?php } ?>
          </div>
          <a href="https://shrituljabhavaniparas.org/index.php/welcome/gallery" class="btn-outline"
            style="margin-top:14px;display:inline-block;">Full Gallery →</a>
        </div>
      </div>
    </div>
  </section>

  <!-- TIMING -->
  <section class="section timing-bg">
    <div class="container">
      <div class="fade-up" style="text-align:center;">
        <span class="lbl" style="display:flex;justify-content:center;color:var(--gold-lt);">Plan Your Visit</span>
        <h2 class="sec-title" style="color:var(--gold-pale);margin:0 auto;">Temple Timings</h2>
      </div>
      <div class="timing-grid fade-up">
        <div class="t-card">
          <div class="t-icon">🌅</div>
          <h4>Morning Darshan</h4>
          <p>6:00 AM – 12:00 PM<br>Morning aarti at 6:30 AM</p>
        </div>
        <div class="t-card">
          <div class="t-icon">☀️</div>
          <h4>Afternoon</h4>
          <p>12:00 PM – 4:00 PM<br>Poojas by appointment</p>
        </div>
        <div class="t-card">
          <div class="t-icon">🌆</div>
          <h4>Evening Darshan</h4>
          <p>4:00 PM – 9:00 PM<br>Evening aarti at 7:00 PM</p>
        </div>
        <div class="t-card">
          <div class="t-icon">📅</div>
          <h4>Festival Days</h4>
          <p>Extended hours on<br>Navratri & special occasions</p>
        </div>
        <div class="t-card">
          <div class="t-icon">📞</div>
          <h4>Contact</h4>
          <p>9822535654<br>8788097975</p>
        </div>
      </div>
    </div>
  </section>

  <!-- DONATE CTA -->
  <div class="donate-cta">
    <h2>Support the Mandir — Donate Today</h2>
    <p>Your contribution helps maintain the temple and serve thousands of devotees. Every rupee goes toward the divine
      service of Maa Tulja Bhavani.</p>
    <div class="donate-row">
      <a href="https://shrituljabhavaniparas.org/index.php/worldline/donation" class="btn-gold">💛 Donate Online</a>
      <a href="https://shrituljabhavaniparas.org/index.php/worldline/booking" class="btn-primary">📅 Book a Pooja</a>
    </div>
  </div>

  <!-- FOOTER -->
  <footer>
    <div class="container">
      <div class="footer-grid">
        <div>
          <div class="f-logo-text">🪷 AAI TULJA BHAVANI MANDIR</div>
          <p class="f-desc">A sacred centre of faith and devotion at Paras, Akola. Established through the Sadhana
            Charitable Foundation. Reg: U85300MH2019NPL334216 · DARPAN ID: MH/2024/0444650</p>
        </div>
        <div>
          <div class="f-head">Quick Links</div>
          <ul class="f-links">
            <li><a href="index.html">Home</a></li>
            <li><a href="about.html">About Temple</a></li>
            <li><a href="news.html">News & Events</a></li>
            <li><a href="shop.html">Temple Shop</a></li>
            <li><a href="https://shrituljabhavaniparas.org/index.php/welcome/gallery">Gallery</a></li>
          </ul>
        </div>
        <div>
          <div class="f-head">Policies</div>
          <ul class="f-links">
            <li><a href="https://shrituljabhavaniparas.org/index.php/welcome/termsandconditions">Terms & Conditions</a>
            </li>
            <li><a href="https://shrituljabhavaniparas.org/index.php/welcome/disclaimer">Disclaimer</a></li>
            <li><a href="https://shrituljabhavaniparas.org/index.php/welcome/privacypolicy">Privacy Policy</a></li>
            <li><a href="https://shrituljabhavaniparas.org/index.php/welcome/cancellationpolicy">Refund Policy</a></li>
            <li><a href="https://shrituljabhavaniparas.org/index.php/welcome/rules">Temple Rules</a></li>
          </ul>
        </div>
        <div class="f-contact">
          <div class="f-head">Contact Us</div>
          <p>📍 AAI TULJABHAVANI MANDIR<br>Paras, TQ Balapur<br>Dist. Akola – 444109, Maharashtra</p>
          <p style="margin-top:8px;">📞 <a href="tel:9822535654">9822535654</a> / <a
              href="tel:8788097975">8788097975</a></p>
          <p>✉️ <a href="mailto:sadhanagroup.org@gmail.com">sadhanagroup.org@gmail.com</a></p>
          <div class="f-cta-row">
            <a href="https://shrituljabhavaniparas.org/index.php/worldline/booking" class="f-cta f-cta-book">Book
              Pooja</a>
            <a href="https://shrituljabhavaniparas.org/index.php/worldline/donation"
              class="f-cta f-cta-donate">Donate</a>
          </div>
        </div>
      </div>
      <div class="footer-bottom">
        <p>© 2025 Aai Tulja Bhavani Mandir, Paras · Sadhana Charitable Foundation</p>
        <p>🕉️ जय तुळजाभवानी 🕉️</p>
      </div>
    </div>
  </footer>

  <!-- CART DRAWER -->
  <div class="overlay" id="cartOverlay" onclick="closeCart()"></div>
  <div class="cart-drawer" id="cartDrawer">
    <div class="cd-head">
      <h3>🛒 Your Cart</h3><button class="cd-close" onclick="closeCart()">✕</button>
    </div>
    <div class="cd-list" id="cdList">
      <div class="cd-empty">
        <div class="cd-empty-icon">🪔</div>
        <p>Your cart is empty.<br>Visit the shop!</p>
      </div>
    </div>
    <div class="cd-foot" id="cdFoot" style="display:none;">
      <div class="cd-trow"><span>Subtotal</span><span id="cdSubtotal">₹0</span></div>
      <div class="cd-trow"><span>Shipping</span><span>₹50</span></div>
      <div class="cd-trow grand"><span>Total</span><span id="cdTotal">₹0</span></div>
      <button class="cd-proceed" onclick="openCheckout()">✨ Proceed to Checkout</button>
    </div>
  </div>

  <!-- CHECKOUT MODAL -->
  <div class="modal-wrap" id="checkoutModal">
    <div class="modal-box">
      <div class="mo-head">
        <h3>🙏 Checkout</h3><button class="cd-close" onclick="closeCheckout()">✕</button>
      </div>
      <div class="mo-body" id="moForm">
        <div class="os-box" id="moSummary"></div>
        <span class="lbl" style="margin-bottom:11px;display:block;">📦 Delivery Details</span>
        <input class="f-ctrl" id="moName" placeholder="Full Name *">
        <div class="two-col"><input class="f-ctrl" id="moPhone" placeholder="Phone *"><input class="f-ctrl" id="moEmail"
            placeholder="Email (optional)" type="email"></div>
        <textarea class="f-ctrl" id="moAddr" rows="2" placeholder="House No, Street, Area *"></textarea>
        <div class="two-col"><input class="f-ctrl" id="moCity" placeholder="City *"><input class="f-ctrl" id="moPin"
            placeholder="Pincode *" maxlength="6"></div>
        <select class="f-ctrl" id="moState">
          <option>Maharashtra</option>
          <option>Gujarat</option>
          <option>Madhya Pradesh</option>
          <option>Karnataka</option>
          <option>Andhra Pradesh</option>
          <option>Telangana</option>
          <option>Rajasthan</option>
          <option>Uttar Pradesh</option>
          <option>Other</option>
        </select>
        <span class="lbl" style="margin-bottom:8px;display:block;">💳 Payment</span>
        <select class="f-ctrl" id="moPayment">
          <option>UPI / GPay / PhonePe</option>
          <option>Cash on Delivery</option>
          <option>Net Banking</option>
          <option>Debit / Credit Card</option>
        </select>
        <button class="mo-place" onclick="placeOrder()">🙏 Place Order — <span id="moTotal">₹0</span></button>
      </div>
      <div class="order-ok" id="moSuccess" style="display:none;">
        <div class="ok-icon">🎉</div>
        <h3>Order Confirmed!</h3>
        <p>Jay Tulja Bhavani 🙏<br>Your order has been received successfully.</p>
        <div class="order-id" id="moOrderId"></div>
        <p>We will contact you at your provided details shortly.</p><br>
        <button class="mo-place" onclick="closeCheckout()">Continue</button>
      </div>
    </div>
  </div>
  <div class="toast" id="toast"></div>

  <script src="<?= base_url() ?>assets/js/shared.js"></script>
  <script>
    /* ── HERO SLIDER ── */
    let cur = 0, total = 5, timer;
    function buildDots() { const d = document.getElementById('sDots'); for (let i = 0; i < total; i++) { const b = document.createElement('button'); b.className = 's-dot' + (i === 0 ? ' active' : ''); b.onclick = () => goSlide(i); d.appendChild(b); } }
    function goSlide(n) { document.querySelectorAll('.slide')[cur].classList.remove('active'); document.querySelectorAll('.s-dot')[cur].classList.remove('active'); cur = (n + total) % total; document.querySelectorAll('.slide')[cur].classList.add('active'); document.querySelectorAll('.s-dot')[cur].classList.add('active'); }
    function moveSlide(d) { clearInterval(timer); goSlide(cur + d); start(); }
    function start() { timer = setInterval(() => goSlide(cur + 1), 4800); }
    document.addEventListener('DOMContentLoaded', () => { buildDots(); start(); });
  </script>
</body>

</html>