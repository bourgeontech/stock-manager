<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8"><meta name="viewport" content="width=device-width,initial-scale=1">
<title>Temple Shop – Aai Tulja Bhavani Mandir</title>
<link rel="stylesheet" href="shared.css">
<style>
/* ── SHOP PAGE SPECIFIC ── */
.shop-layout { display:grid; grid-template-columns:240px 1fr; gap:32px; align-items:start; }

/* Filter sidebar */
.filter-sidebar { position:sticky; top:88px; background:var(--white); border:1px solid rgba(201,147,10,.22); border-radius:var(--r); padding:20px; box-shadow:var(--sh-card); }
.fs-title { font-family:'Cinzel',serif; font-size:.82rem; letter-spacing:.1em; color:var(--maroon); border-bottom:1.5px solid rgba(201,147,10,.25); padding-bottom:8px; margin-bottom:14px; }
.fs-cat { display:block; width:100%; background:none; border:none; text-align:left; padding:9px 12px; border-radius:var(--r-sm); font-family:'Cinzel',serif; font-size:.75rem; letter-spacing:.07em; color:var(--text-mid); cursor:pointer; transition:background .2s,color .2s; display:flex; align-items:center; gap:8px; }
.fs-cat:hover { background:var(--cream-dark); color:var(--maroon); }
.fs-cat.active { background:var(--saffron); color:#fff; }
.fs-cat .fc-count { margin-left:auto; font-size:.65rem; background:rgba(0,0,0,.1); padding:2px 6px; border-radius:10px; }
.fs-cat.active .fc-count { background:rgba(255,255,255,.25); }
.fs-divider { height:1px; background:rgba(201,147,10,.15); margin:12px 0; }
.price-range { margin-top:4px; }
.price-range label { font-size:.72rem; color:var(--text-mid); letter-spacing:.08em; margin-bottom:8px; display:block; }
.price-range input[type=range] { width:100%; accent-color:var(--saffron); }
.price-display { font-family:'Cinzel',serif; font-size:.8rem; color:var(--saffron); text-align:center; margin-top:4px; }

/* Products area */
.shop-topbar { display:flex; align-items:center; justify-content:space-between; margin-bottom:22px; flex-wrap:wrap; gap:10px; }
.shop-topbar .result-count { font-size:.82rem; color:var(--text-mid); }
.sort-select { font-family:'Cinzel',serif; font-size:.72rem; letter-spacing:.06em; color:var(--text-mid); border:1.5px solid rgba(201,147,10,.3); border-radius:var(--r-sm); padding:6px 10px; background:var(--white); outline:none; }

.products-grid { display:grid; grid-template-columns:repeat(auto-fill,minmax(200px,1fr)); gap:18px; }

/* Product card */
.prod-card {
  background:var(--white); border:1px solid rgba(201,147,10,.2);
  border-radius:var(--r); overflow:hidden; box-shadow:var(--sh-card);
  display:flex; flex-direction:column;
  transition:transform .22s,box-shadow .22s;
}
.prod-card:hover { transform:translateY(-5px); box-shadow:var(--sh-warm); }

.prod-thumb {
  position:relative; aspect-ratio:1/1;
  background:linear-gradient(135deg,var(--gold-pale),#ffe8a0);
  display:flex; align-items:center; justify-content:center;
  font-size:4.2rem; overflow:hidden;
}
.prod-thumb img { width:100%; height:100%; object-fit:cover; }
.badge-sale { position:absolute;top:10px;left:10px;background:var(--saffron);color:#fff;font-size:.6rem;font-weight:700;letter-spacing:.08em;padding:3px 8px;border-radius:3px; }
.badge-new  { position:absolute;top:10px;right:10px;background:var(--gold);color:var(--maroon-deep);font-size:.6rem;font-weight:700;letter-spacing:.08em;padding:3px 8px;border-radius:3px; }

.prod-body { padding:13px 13px 8px; flex:1; }
.prod-cat  { font-size:.63rem;letter-spacing:.14em;text-transform:uppercase;color:var(--gold);font-weight:700;margin-bottom:3px; }
.prod-name { font-family:'Cinzel',serif;font-size:.84rem;color:var(--maroon);line-height:1.3;margin-bottom:5px; }
.prod-desc { font-size:.72rem;color:var(--text-light);line-height:1.55; }

.prod-foot { padding:9px 13px 13px;border-top:1px solid rgba(201,147,10,.14);display:flex;align-items:center;justify-content:space-between; }
.prod-price { font-family:'Cinzel',serif;font-size:.96rem;font-weight:700;color:var(--saffron); }
.prod-price s { font-size:.68rem;color:#bbb;font-weight:400;margin-left:3px; }
.add-btn {
  background:linear-gradient(135deg,var(--saffron),var(--saffron-lt));
  color:#fff; border:none; padding:7px 13px; border-radius:5px;
  font-size:.74rem;font-weight:700;cursor:pointer;
  font-family:'Raleway',sans-serif;letter-spacing:.04em;
  transition:opacity .18s,transform .1s;
}
.add-btn:hover { opacity:.88; transform:scale(1.04); }
.add-btn.added { background:linear-gradient(135deg,#2e7d32,#4caf50); }

/* Empty state */
.empty-products { text-align:center; padding:60px 20px; color:var(--text-light); }
.empty-products .ep-icon { font-size:3rem; margin-bottom:14px; }

/* Shop banner */
.shop-promo { background:linear-gradient(135deg,var(--maroon-deep),#a02800); border-radius:var(--r); padding:22px 24px; margin-bottom:22px; color:var(--gold-pale); display:flex; align-items:center; justify-content:space-between; gap:16px; flex-wrap:wrap; }
.shop-promo h3 { font-family:'Cinzel Decorative',serif; font-size:.95rem; color:var(--gold-lt); margin-bottom:5px; }
.shop-promo p { font-size:.78rem; opacity:.84; }

/* Quantity in product (optional counter) */
.prod-qty-row { display:flex; align-items:center; gap:6px; }
.pq-btn { width:24px;height:24px;background:var(--gold-pale);border:1px solid var(--gold);border-radius:4px;cursor:pointer;font-size:.9rem;font-weight:700;color:var(--maroon);display:flex;align-items:center;justify-content:center; }
.pq-num { min-width:18px;text-align:center;font-weight:700;font-size:.86rem;color:var(--text); }

@media(max-width:860px){
  .shop-layout { grid-template-columns:1fr; }
  .filter-sidebar { position:static; display:flex; flex-wrap:wrap; gap:6px; padding:14px; }
  .fs-title { display:none; }
  .fs-divider, .price-range { display:none; }
  .fs-cat { padding:5px 12px; border:1.5px solid rgba(201,147,10,.3); border-radius:20px; width:auto; }
}
</style>
</head>
<body>

<div class="topbar">
  <div class="topbar-inner">
    <span>🕉️ जय तुळजाभवानी 🕉️</span>
    <span class="topbar-sep">|</span>
    <span>📞 9822535654 / 8788097975</span>
    <span class="topbar-sep">|</span>
    <span>🚚 Free shipping on orders above ₹999</span>
    <span class="topbar-sep">|</span>
    <a href="https://shrituljabhavaniparas.org/index.php/worldline/donation">💛 Donate</a>
  </div>
</div>

<header>
  <div class="header-inner">
    <a href="index.html" class="logo"><div class="logo-orb">🪷</div><div class="logo-words"><h1>AAI TULJA BHAVANI MANDIR</h1><p>PARAS · BALAPUR · DIST. AKOLA</p></div></a>
    <ul class="nav-list">
      <li><a href="index.html">Home</a></li>
      <li><button class="nav-drop-btn">The Temple ▾</button><div class="nav-dropdown"><a href="about.html">About Temple</a><a href="https://shrituljabhavaniparas.org/index.php/welcome/priest">Temple Priest</a><a href="https://shrituljabhavaniparas.org/index.php/welcome/trusteeboard">Trustee Board</a></div></li>
      <li><a href="news.html">News</a></li>
      <li><a href="shop.html" class="active">Shop</a></li>
      <li><a href="https://shrituljabhavaniparas.org/index.php/welcome/gallery">Gallery</a></li>
      <li><a href="https://shrituljabhavaniparas.org/index.php/welcome/contact">Contact</a></li>
    </ul>
    <div class="nav-actions">
      <a href="https://shrituljabhavaniparas.org/index.php/worldline/booking" style="font-family:'Cinzel',serif;font-size:.71rem;padding:7px 13px;border-radius:4px;text-decoration:none;background:linear-gradient(135deg,var(--gold),var(--gold-lt));color:var(--maroon-deep);font-weight:700;">📅 Book Pooja</a>
      <a href="shop.html" class="nav-btn-shop" style="font-family:'Cinzel Decorative',serif;font-size:.65rem;padding:7px 13px;border-radius:4px;text-decoration:none;">🛕 For Sale</a>
      <button class="nav-btn-cart" onclick="openCart()">🛒 <span class="cart-badge">0</span></button>
    </div>
    <button class="hamburger"><span></span><span></span><span></span></button>
  </div>
</header>
<div class="marquee-bar"><span class="marquee-track">🛕 TEMPLE SHOP OPEN &nbsp;✦&nbsp; ALL ITEMS BLESSED AT THE MANDIR &nbsp;✦&nbsp; FREE SHIPPING ABOVE ₹999 &nbsp;✦&nbsp; JAI TULJA BHAVANI &nbsp;✦&nbsp; PRASAD · IDOLS · POOJA ITEMS &nbsp;✦&nbsp; ONLINE ORDERING AVAILABLE &nbsp;✦&nbsp; 🛕 TEMPLE SHOP OPEN &nbsp;✦&nbsp; ALL ITEMS BLESSED AT THE MANDIR &nbsp;✦&nbsp; FREE SHIPPING ABOVE ₹999 &nbsp;✦&nbsp; JAI TULJA BHAVANI &nbsp;✦&nbsp; PRASAD · IDOLS · POOJA ITEMS &nbsp;✦&nbsp;</span></div>

<div class="page-banner">
  <span class="lbl">Devotional Treasures</span>
  <h1 class="sec-title">🛕 Temple Shop — For Sale</h1>
  <div class="breadcrumb"><a href="index.html">Home</a><span>›</span><span style="color:var(--gold-lt);">Temple Shop</span></div>
</div>

<section class="section">
  <div class="container">
    <div class="shop-layout">

      <!-- FILTER SIDEBAR -->
      <div class="filter-sidebar fade-up">
        <div class="fs-title">🔍 Browse By</div>
        <button class="fs-cat active" onclick="filterCat('all',this)"><span>🪷</span> All Items <span class="fc-count" id="cnt-all">16</span></button>
        <button class="fs-cat" onclick="filterCat('pooja',this)"><span>🌺</span> Pooja Samagri <span class="fc-count">5</span></button>
        <button class="fs-cat" onclick="filterCat('prasad',this)"><span>🍬</span> Prasad <span class="fc-count">3</span></button>
        <button class="fs-cat" onclick="filterCat('idol',this)"><span>🪆</span> Idols & Murtis <span class="fc-count">2</span></button>
        <button class="fs-cat" onclick="filterCat('book',this)"><span>📖</span> Books & Calendars <span class="fc-count">3</span></button>
        <button class="fs-cat" onclick="filterCat('accessory',this)"><span>📿</span> Accessories <span class="fc-count">3</span></button>
        <div class="fs-divider"></div>
        <div class="price-range">
          <label>Max Price: <span id="priceVal">₹2000</span></label>
          <input type="range" min="40" max="2000" value="2000" step="10" oninput="filterPrice(this.value)">
          <div class="price-display" id="priceDisplay">Up to ₹2,000</div>
        </div>
        <div class="fs-divider"></div>
        <button class="fs-cat" onclick="filterSale(this)" id="saleBtn"><span>🏷️</span> On Sale</button>
        <button class="fs-cat" onclick="filterNew(this)" id="newBtn"><span>✨</span> New Arrivals</button>
      </div>

      <!-- PRODUCTS -->
      <div>
        <div class="shop-promo fade-up">
          <div>
            <h3>🙏 Blessed Items from the Mandir</h3>
            <p>All products are consecrated at Aai Tulja Bhavani Mandir. Delivered across India.</p>
          </div>
          <a href="https://shrituljabhavaniparas.org/index.php/worldline/booking" class="btn-gold" style="white-space:nowrap;font-size:.74rem;">Book Pooja Too →</a>
        </div>

        <div class="shop-topbar fade-up">
          <div class="result-count" id="resultCount">Showing 16 products</div>
          <select class="sort-select" onchange="sortProducts(this.value)">
            <option value="default">Sort: Default</option>
            <option value="low">Price: Low to High</option>
            <option value="high">Price: High to Low</option>
            <option value="name">Name: A–Z</option>
          </select>
        </div>

        <div class="products-grid" id="productsGrid"></div>
      </div>
    </div>
  </div>
</section>

<!-- WHY BUY -->
<section class="section" style="background:var(--cream-dark);padding:48px 0;">
  <div class="container">
    <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(190px,1fr));gap:18px;" class="fade-up">
      <div style="text-align:center;padding:20px 14px;"><div style="font-size:2rem;margin-bottom:8px;">🙏</div><div style="font-family:'Cinzel',serif;font-size:.82rem;color:var(--maroon);margin-bottom:5px;">Blessed Items</div><div style="font-size:.74rem;color:var(--text-light);line-height:1.55;">All items are consecrated and blessed at the mandir before dispatch.</div></div>
      <div style="text-align:center;padding:20px 14px;"><div style="font-size:2rem;margin-bottom:8px;">🚚</div><div style="font-family:'Cinzel',serif;font-size:.82rem;color:var(--maroon);margin-bottom:5px;">Pan India Delivery</div><div style="font-size:.74rem;color:var(--text-light);line-height:1.55;">We deliver across India. Free shipping on orders above ₹999.</div></div>
      <div style="text-align:center;padding:20px 14px;"><div style="font-size:2rem;margin-bottom:8px;">💯</div><div style="font-family:'Cinzel',serif;font-size:.82rem;color:var(--maroon);margin-bottom:5px;">Pure & Authentic</div><div style="font-size:.74rem;color:var(--text-light);line-height:1.55;">Only pure, authentic materials sourced for temple offerings.</div></div>
      <div style="text-align:center;padding:20px 14px;"><div style="font-size:2rem;margin-bottom:8px;">🔒</div><div style="font-family:'Cinzel',serif;font-size:.82rem;color:var(--maroon);margin-bottom:5px;">Secure Payments</div><div style="font-size:.74rem;color:var(--text-light);line-height:1.55;">Pay safely via UPI, card, net banking or cash on delivery.</div></div>
      <div style="text-align:center;padding:20px 14px;"><div style="font-size:2rem;margin-bottom:8px;">↩️</div><div style="font-family:'Cinzel',serif;font-size:.82rem;color:var(--maroon);margin-bottom:5px;">Easy Returns</div><div style="font-size:.74rem;color:var(--text-light);line-height:1.55;">Hassle-free returns within 7 days of delivery for eligible items.</div></div>
    </div>
  </div>
</section>

<!-- FOOTER -->
<footer>
  <div class="container">
    <div class="footer-grid">
      <div><div class="f-logo-text">🪷 AAI TULJA BHAVANI MANDIR</div><p class="f-desc">Temple shop — blessed devotional items from Paras, Akola. Sadhana Charitable Foundation.</p></div>
      <div><div class="f-head">Quick Links</div><ul class="f-links"><li><a href="index.html">Home</a></li><li><a href="about.html">About Temple</a></li><li><a href="news.html">News & Events</a></li><li><a href="shop.html">Temple Shop</a></li></ul></div>
      <div><div class="f-head">Shop Policies</div><ul class="f-links"><li><a href="https://shrituljabhavaniparas.org/index.php/welcome/termsandconditions">Terms & Conditions</a></li><li><a href="https://shrituljabhavaniparas.org/index.php/welcome/privacypolicy">Privacy Policy</a></li><li><a href="https://shrituljabhavaniparas.org/index.php/welcome/cancellationpolicy">Cancellation & Refund</a></li></ul></div>
      <div class="f-contact"><div class="f-head">Contact</div><p>📍 Paras, TQ Balapur, Dist. Akola – 444109</p><p style="margin-top:6px;">📞 <a href="tel:9822535654">9822535654</a></p><p>✉️ <a href="mailto:sadhanagroup.org@gmail.com">sadhanagroup.org@gmail.com</a></p><div class="f-cta-row"><a href="https://shrituljabhavaniparas.org/index.php/worldline/booking" class="f-cta f-cta-book">Book Pooja</a><a href="https://shrituljabhavaniparas.org/index.php/worldline/donation" class="f-cta f-cta-donate">Donate</a></div></div>
    </div>
    <div class="footer-bottom"><p>© 2025 Aai Tulja Bhavani Mandir · Sadhana Charitable Foundation</p><p>🕉️ जय तुळजाभवानी 🕉️</p></div>
  </div>
</footer>

<!-- CART / CHECKOUT -->
<div class="overlay" id="cartOverlay" onclick="closeCart()"></div>
<div class="cart-drawer" id="cartDrawer">
  <div class="cd-head"><h3>🛒 Your Cart</h3><button class="cd-close" onclick="closeCart()">✕</button></div>
  <div class="cd-list" id="cdList"><div class="cd-empty"><div class="cd-empty-icon">🪔</div><p>Your cart is empty.<br>Add some items above!</p></div></div>
  <div class="cd-foot" id="cdFoot" style="display:none;"><div class="cd-trow"><span>Subtotal</span><span id="cdSubtotal">₹0</span></div><div class="cd-trow"><span>Shipping</span><span>₹50</span></div><div class="cd-trow grand"><span>Total</span><span id="cdTotal">₹0</span></div><button class="cd-proceed" onclick="openCheckout()">✨ Proceed to Checkout</button></div>
</div>
<div class="modal-wrap" id="checkoutModal">
  <div class="modal-box">
    <div class="mo-head"><h3>🙏 Checkout</h3><button class="cd-close" onclick="closeCheckout()">✕</button></div>
    <div class="mo-body" id="moForm">
      <div class="os-box" id="moSummary"></div>
      <span class="lbl" style="margin-bottom:11px;display:block;">📦 Delivery Details</span>
      <input class="f-ctrl" id="moName" placeholder="Full Name *">
      <div class="two-col"><input class="f-ctrl" id="moPhone" placeholder="Phone *"><input class="f-ctrl" id="moEmail" placeholder="Email (optional)" type="email"></div>
      <textarea class="f-ctrl" id="moAddr" rows="2" placeholder="House No, Street, Area *"></textarea>
      <div class="two-col"><input class="f-ctrl" id="moCity" placeholder="City *"><input class="f-ctrl" id="moPin" placeholder="Pincode *" maxlength="6"></div>
      <select class="f-ctrl" id="moState"><option>Maharashtra</option><option>Gujarat</option><option>Madhya Pradesh</option><option>Karnataka</option><option>Andhra Pradesh</option><option>Telangana</option><option>Rajasthan</option><option>Uttar Pradesh</option><option>Other</option></select>
      <span class="lbl" style="margin-bottom:8px;display:block;">💳 Payment Method</span>
      <select class="f-ctrl" id="moPayment"><option>UPI / GPay / PhonePe</option><option>Cash on Delivery</option><option>Net Banking</option><option>Debit / Credit Card</option></select>
      <button class="mo-place" onclick="placeOrder()">🙏 Place Order — <span id="moTotal">₹0</span></button>
    </div>
    <div class="order-ok" id="moSuccess" style="display:none;">
      <div class="ok-icon">🎉</div><h3>Order Confirmed!</h3>
      <p>Jay Tulja Bhavani 🙏<br>Your order has been received.</p>
      <div class="order-id" id="moOrderId"></div>
      <p>We will contact you at your provided details.</p><br>
      <button class="mo-place" onclick="closeCheckout()">Continue Shopping</button>
    </div>
  </div>
</div>
<div class="toast" id="toast"></div>

<script src="shared.js"></script>
<script>
/* ── SHOP PAGE LOGIC ── */
let currentCat = 'all';
let maxPrice = 2000;
let saleOnly = false;
let newOnly = false;
let sortMode = 'default';

function getFiltered() {
  let list = PRODUCTS.slice();
  if (currentCat !== 'all') list = list.filter(p => p.cat === currentCat);
  list = list.filter(p => p.price <= maxPrice);
  if (saleOnly) list = list.filter(p => p.badge === 'sale');
  if (newOnly)  list = list.filter(p => p.badge === 'new');
  if (sortMode === 'low')  list.sort((a,b) => a.price - b.price);
  if (sortMode === 'high') list.sort((a,b) => b.price - a.price);
  if (sortMode === 'name') list.sort((a,b) => a.name.localeCompare(b.name));
  return list;
}

function renderShop() {
  const list = getFiltered();
  const grid = document.getElementById('productsGrid');
  document.getElementById('resultCount').textContent = `Showing ${list.length} product${list.length !== 1 ? 's' : ''}`;
  if (!list.length) {
    grid.innerHTML = `<div class="empty-products" style="grid-column:1/-1;"><div class="ep-icon">🔍</div><p>No products found for this filter.<br>Try adjusting the price range or category.</p></div>`;
    return;
  }
  grid.innerHTML = list.map(p => `
    <div class="prod-card">
      <div class="prod-thumb">
        <span>${p.emoji}</span>
        ${p.badge==='sale'?'<span class="badge-sale">SALE</span>':''}
        ${p.badge==='new'?'<span class="badge-new">NEW</span>':''}
      </div>
      <div class="prod-body">
        <div class="prod-cat">${p.tag}</div>
        <div class="prod-name">${p.name}</div>
        <div class="prod-desc">${p.desc}</div>
      </div>
      <div class="prod-foot">
        <div class="prod-price">₹${p.price.toLocaleString('en-IN')}${p.old?`<s>₹${p.old.toLocaleString('en-IN')}</s>`:''}</div>
        <button class="add-btn ${cart[p.id]?'added':''}" id="abtn-${p.id}" onclick="addToCart(${p.id})">
          ${cart[p.id]?`✓ (${cart[p.id]})`:'+ Add'}
        </button>
      </div>
    </div>`).join('');
}

function filterCat(cat, el) {
  currentCat = cat; saleOnly = false; newOnly = false;
  document.querySelectorAll('.fs-cat').forEach(b => b.classList.remove('active'));
  el.classList.add('active');
  document.getElementById('saleBtn').classList.remove('active');
  document.getElementById('newBtn').classList.remove('active');
  renderShop();
}

function filterPrice(val) {
  maxPrice = parseInt(val);
  document.getElementById('priceVal').textContent = `₹${parseInt(val).toLocaleString('en-IN')}`;
  document.getElementById('priceDisplay').textContent = `Up to ₹${parseInt(val).toLocaleString('en-IN')}`;
  renderShop();
}

function filterSale(el) {
  saleOnly = !saleOnly; newOnly = false;
  el.classList.toggle('active', saleOnly);
  document.getElementById('newBtn').classList.remove('active');
  renderShop();
}

function filterNew(el) {
  newOnly = !newOnly; saleOnly = false;
  el.classList.toggle('active', newOnly);
  document.getElementById('saleBtn').classList.remove('active');
  renderShop();
}

function sortProducts(val) {
  sortMode = val;
  renderShop();
}

document.addEventListener('DOMContentLoaded', renderShop);
</script>
</body>
</html>
