<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8"><meta name="viewport" content="width=device-width,initial-scale=1">
<title>About Temple – Aai Tulja Bhavani Mandir</title>
<link rel="stylesheet" href="shared.css">
<style>
/* ── ABOUT PAGE SPECIFIC ── */
.about-intro { display:grid; grid-template-columns:1fr 1.4fr; gap:50px; align-items:start; }
.ai-img-col { position:sticky; top:90px; }
.ai-img { width:100%; border-radius:var(--r); box-shadow:var(--sh-warm); }
.ai-img-sub { width:100%; margin-top:12px; border-radius:var(--r-sm); box-shadow:var(--sh-card); }
.ai-text .intro-para { font-size:.93rem; line-height:1.82; color:var(--text-mid); margin-bottom:14px; }
.ai-text .intro-para strong { color:var(--maroon); font-weight:700; }

/* Info cards */
.info-cards { display:grid; grid-template-columns:repeat(auto-fill,minmax(200px,1fr)); gap:16px; margin-top:32px; }
.info-card { background:var(--white); border:1px solid rgba(201,147,10,.22); border-radius:var(--r-sm); padding:18px 16px; }
.info-card .ic-icon { font-size:1.5rem; margin-bottom:6px; }
.info-card .ic-label { font-size:.67rem; letter-spacing:.14em; text-transform:uppercase; color:var(--gold); margin-bottom:3px; font-weight:700; }
.info-card .ic-val { font-family:'Cinzel',serif; font-size:.82rem; color:var(--maroon); line-height:1.4; }

/* Mission section */
.mission-bg { background:linear-gradient(135deg,var(--maroon-deep),var(--maroon)); color:var(--gold-pale); }
.mission-grid { display:grid; grid-template-columns:repeat(auto-fill,minmax(220px,1fr)); gap:20px; margin-top:36px; }
.mission-card { background:rgba(255,255,255,.07); border:1px solid rgba(201,147,10,.28); border-radius:var(--r); padding:22px 18px; text-align:center; }
.mission-card .mc-icon { font-size:2.1rem; margin-bottom:10px; }
.mission-card h3 { font-family:'Cinzel',serif; font-size:.88rem; color:var(--gold-lt); margin-bottom:7px; }
.mission-card p { font-size:.76rem; opacity:.8; line-height:1.62; }

/* Committee section */
.committee-grid { display:grid; grid-template-columns:repeat(auto-fill,minmax(180px,1fr)); gap:18px; margin-top:32px; }
.cmember { background:var(--white); border:1px solid rgba(201,147,10,.2); border-radius:var(--r); padding:20px 16px; text-align:center; box-shadow:var(--sh-card); transition:transform .2s; }
.cmember:hover { transform:translateY(-4px); }
.cmember .cm-avatar { width:64px; height:64px; border-radius:50%; background:linear-gradient(135deg,var(--gold-pale),#ffd080); display:flex; align-items:center; justify-content:center; font-size:1.8rem; margin:0 auto 10px; border:2px solid rgba(201,147,10,.3); }
.cmember .cm-name { font-family:'Cinzel',serif; font-size:.82rem; color:var(--maroon); margin-bottom:3px; }
.cmember .cm-role { font-size:.68rem; letter-spacing:.1em; text-transform:uppercase; color:var(--gold); }

/* Foundation box */
.foundation-box { background:var(--cream-dark); border:2px solid rgba(201,147,10,.3); border-radius:var(--r); padding:32px; margin-top:40px; display:grid; grid-template-columns:1fr 1fr; gap:28px; align-items:center; }
.fb-text h3 { font-family:'Cinzel Decorative',serif; font-size:1rem; color:var(--maroon); margin-bottom:10px; }
.fb-text p { font-size:.83rem; line-height:1.8; color:var(--text-mid); }
.fb-details { }
.fb-row { display:flex; gap:10px; align-items:flex-start; padding:8px 0; border-bottom:1px solid rgba(201,147,10,.15); }
.fb-row:last-child { border:none; }
.fb-icon { font-size:1rem; flex-shrink:0; margin-top:2px; }
.fb-info small { display:block; font-size:.65rem; letter-spacing:.12em; text-transform:uppercase; color:var(--gold); }
.fb-info strong { font-size:.82rem; color:var(--text); }

@media(max-width:860px){
  .about-intro { grid-template-columns:1fr; }
  .ai-img-col { position:static; }
  .foundation-box { grid-template-columns:1fr; }
}
</style>
</head>
<body>

<!-- TOP BAR -->
<div class="topbar">
  <div class="topbar-inner">
    <span>🕉️ जय तुळजाभवानी 🕉️</span>
    <span class="topbar-sep">|</span>
    <span>📞 9822535654 / 8788097975</span>
    <span class="topbar-sep">|</span>
    <a href="https://shrituljabhavaniparas.org/index.php/worldline/donation">💛 Donate</a>
  </div>
</div>

<!-- HEADER -->
<header>
  <div class="header-inner">
    <a href="index.html" class="logo">
      <div class="logo-orb">🪷</div>
      <div class="logo-words">
        <h1>AAI TULJA BHAVANI MANDIR</h1>
        <p>PARAS · BALAPUR · DIST. AKOLA</p>
      </div>
    </a>
    <ul class="nav-list">
      <li><a href="index.html">Home</a></li>
      <li>
        <button class="nav-drop-btn">The Temple ▾</button>
        <div class="nav-dropdown">
          <a href="about.html" class="active">About Temple</a>
          <a href="https://shrituljabhavaniparas.org/index.php/welcome/priest">Temple Priest</a>
          <a href="https://shrituljabhavaniparas.org/index.php/welcome/trusteeboard">Trustee Board</a>
          <a href="https://shrituljabhavaniparas.org/index.php/welcome/festivalCommittee">Festival Committee</a>
        </div>
      </li>
      <li><a href="news.html">News</a></li>
      <li><a href="https://shrituljabhavaniparas.org/index.php/welcome/gallery">Gallery</a></li>
      <li><a href="https://shrituljabhavaniparas.org/index.php/welcome/contact">Contact</a></li>
    </ul>
    <div class="nav-actions">
      <a href="https://shrituljabhavaniparas.org/index.php/worldline/booking" style="font-family:'Cinzel',serif;font-size:.71rem;padding:7px 13px;border-radius:4px;text-decoration:none;background:linear-gradient(135deg,var(--gold),var(--gold-lt));color:var(--maroon-deep);font-weight:700;letter-spacing:.07em;">📅 Book Pooja</a>
      <a href="shop.html" class="nav-btn-shop" style="font-family:'Cinzel Decorative',serif;font-size:.65rem;padding:7px 13px;border-radius:4px;text-decoration:none;">🛕 For Sale</a>
      <button class="nav-btn-cart" onclick="openCart()">🛒 <span class="cart-badge">0</span></button>
    </div>
    <button class="hamburger"><span></span><span></span><span></span></button>
  </div>
</header>
<div class="marquee-bar"><span class="marquee-track">🪷 JAI TULJA BHAVANI &nbsp;✦&nbsp; ONLINE BOOKING AVAILABLE &nbsp;✦&nbsp; ARCHANA &amp; SANKALP POOJA &nbsp;✦&nbsp; NAVRATRI MAHOTSAV &nbsp;✦&nbsp; JAI JAGDAMB JAGDAMB &nbsp;✦&nbsp; PARAS · DIST AKOLA &nbsp;✦&nbsp; 🪷 JAI TULJA BHAVANI &nbsp;✦&nbsp; ONLINE BOOKING AVAILABLE &nbsp;✦&nbsp; ARCHANA &amp; SANKALP POOJA &nbsp;✦&nbsp; NAVRATRI MAHOTSAV &nbsp;✦&nbsp; JAI JAGDAMB JAGDAMB &nbsp;✦&nbsp; PARAS · DIST AKOLA &nbsp;✦&nbsp;</span></div>

<!-- PAGE BANNER -->
<div class="page-banner">
  <span class="lbl">The Sacred Abode</span>
  <h1 class="sec-title">About the Temple</h1>
  <div class="breadcrumb">
    <a href="index.html">Home</a>
    <span>›</span>
    <span style="color:var(--gold-lt);">About Temple</span>
  </div>
</div>

<!-- MAIN ABOUT -->
<section class="section">
  <div class="container">
    <div class="about-intro fade-up">
      <div class="ai-img-col">
        <img class="ai-img" src="https://shrituljabhavaniparas.org/uploads/banner/WhatsApp_Image_2025-11-25_at_10_37_03.jpeg" alt="Aai Tulja Bhavani Mandir">
        <img class="ai-img-sub" src="https://shrituljabhavaniparas.org/uploads/banner/SAVE_20250908_135424.jpg" alt="Temple">
      </div>
      <div class="ai-text">
        <span class="lbl">Our History & Mission</span>
        <h2 class="sec-title">Aai Tulja Bhavani Mandir, Paras</h2>
        <div class="divider"><span>✦ ॐ ✦</span></div>
        <p class="intro-para"><strong>Aai Tulja Bhavani Mandir</strong> is a recently developed sacred temple located at Paras, Taluka Balapur, District Akola — 444109. This divine temple is dedicated to <strong>Maa Tulja Bhavani</strong>, a powerful manifestation of the goddess Shakti, revered across Maharashtra and beyond.</p>
        <p class="intro-para">The temple was developed under the auspices of the <strong>Sadhana Charitable Foundation</strong>, a registered non-profit organization committed to religious, social, and community services. The Foundation holds the registration number U85300MH2019NPL334216 and DARPAN ID MH/2024/0444650.</p>
        <p class="intro-para">The mandir serves as a spiritual anchor for the community — offering daily poojas, hosting grand festivals, and providing a welcoming space for all devotees to seek the blessings of <strong>Aai Tulja Bhavani</strong>. Special facilities for online pooja booking and donations have been made available to serve devotees across the globe.</p>
        <p class="intro-para">It is the unwavering belief of devotees that Maa Tulja Bhavani fulfils the prayers of those who come to her with sincere hearts. The temple committee works tirelessly to maintain the sanctity, cleanliness, and spiritual atmosphere of this divine abode.</p>

        <div class="info-cards">
          <div class="info-card"><div class="ic-icon">📍</div><div class="ic-label">Location</div><div class="ic-val">Paras, TQ Balapur<br>Dist. Akola – 444109</div></div>
          <div class="info-card"><div class="ic-icon">🏛️</div><div class="ic-label">Foundation</div><div class="ic-val">Sadhana Charitable Foundation</div></div>
          <div class="info-card"><div class="ic-icon">📋</div><div class="ic-label">Reg. No.</div><div class="ic-val">U85300MH2019NPL334216</div></div>
          <div class="info-card"><div class="ic-icon">🆔</div><div class="ic-label">DARPAN ID</div><div class="ic-val">MH/2024/0444650</div></div>
          <div class="info-card"><div class="ic-icon">📞</div><div class="ic-label">Contact</div><div class="ic-val">9822535654<br>8788097975</div></div>
          <div class="info-card"><div class="ic-icon">✉️</div><div class="ic-label">Email</div><div class="ic-val">sadhanagroup.org<br>@gmail.com</div></div>
        </div>
      </div>
    </div>
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
        <img src="https://shrituljabhavaniparas.org/uploads/banner/SAVE_20250906_1108481.jpg" alt="Maa Tulja Bhavani" style="width:100%;border-radius:var(--r);box-shadow:var(--sh-warm);">
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
<script src="shared.js"></script>
</body>
</html>
