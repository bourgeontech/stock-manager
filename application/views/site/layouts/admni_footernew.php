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

<script src="<?php echo base_url(); ?>/assets/site9/shared.js"></script>
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

function renderShopss() {
  const grid = document.getElementById('productsGrid');
  if (!grid) return;
  const list = getFiltered();
  const rc = document.getElementById('resultCount');
  if (rc) rc.textContent = `Showing ${list.length} product${list.length !== 1 ? 's' : ''}`;

  if (!list.length) {
    grid.innerHTML = `<div class="empty-products"><div class="ep-icon">🪔</div><p>No products match your filters.<br>Try adjusting the price or category.</p></div>`;
    return;
  }

  grid.innerHTML = list.map(p => {
    const inCart = cart[p.id] || 0;
    const btnLabel = inCart ? `✓ (${inCart})` : '+ Add to Cart';
    const btnClass = inCart ? 'add-btn added' : 'add-btn';
    const badgeSale = p.badge === 'sale' ? `<span class="badge-sale">SALE</span>` : '';
    const badgeNew  = p.badge === 'new'  ? `<span class="badge-new">NEW</span>` : '';
    const oldPrice  = p.old ? `<s>₹${p.old.toLocaleString('en-IN')}</s>` : '';
    return `
      <div class="prod-card" data-cat="${p.cat}" data-price="${p.price}" data-badge="${p.badge||''}">
        <div class="prod-thumb">
          <span>${p.emoji}</span>
          ${badgeSale}${badgeNew}
        </div>
        <div class="prod-body">
          <div class="prod-cat">${p.tag}</div>
          <div class="prod-name">${p.name}</div>
          <div class="prod-desc">${p.desc}</div>
        </div>
        <div class="prod-foot">
          <div class="prod-price">₹${p.price.toLocaleString('en-IN')} ${oldPrice}</div>
          <button class="${btnClass}" id="abtn-${p.id}" onclick="addToCart(${p.id})">${btnLabel}</button>
        </div>
      </div>`;
  }).join('');
}

function filterCat(cat, el) {
  currentCat = cat; saleOnly = false; newOnly = false;
  document.querySelectorAll('.fs-cat').forEach(b => b.classList.remove('active'));
  el.classList.add('active');
  if (document.getElementById('saleBtn')) document.getElementById('saleBtn').classList.remove('active');
  if (document.getElementById('newBtn'))  document.getElementById('newBtn').classList.remove('active');
  renderShop();
}

function filterPrice(val) {
  maxPrice = parseInt(val);
  const pv = document.getElementById('priceVal');
  const pd = document.getElementById('priceDisplay');
  if (pv) pv.textContent = `₹${parseInt(val).toLocaleString('en-IN')}`;
  if (pd) pd.textContent = `Up to ₹${parseInt(val).toLocaleString('en-IN')}`;
  renderShop();
}

function filterSale(el) {
  saleOnly = !saleOnly; newOnly = false;
  el.classList.toggle('active', saleOnly);
  if (document.getElementById('newBtn')) document.getElementById('newBtn').classList.remove('active');
  renderShop();
}

function filterNew(el) {
  newOnly = !newOnly; saleOnly = false;
  el.classList.toggle('active', newOnly);
  if (document.getElementById('saleBtn')) document.getElementById('saleBtn').classList.remove('active');
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
