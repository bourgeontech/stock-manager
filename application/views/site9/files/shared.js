/* shared.js — cart + header/footer helpers used by every page */

/* ══ CART STATE (persisted in sessionStorage) ══ */
const PRODUCTS = [
  { id:1,  name:"Bhavani Brass Murti",        cat:"idol",      price:1200, old:1500, emoji:"🪆", tag:"Idol",     badge:"sale", desc:"Hand-crafted brass murti of Aai Tulja Bhavani, 6 inch." },
  { id:2,  name:"Silver Finish Padukas",      cat:"idol",      price:850,  old:1100, emoji:"👣", tag:"Idol",     badge:"sale", desc:"Oxidised silver-finish padukas for home pooja mandir." },
  { id:3,  name:"Panchamrit Puja Set",        cat:"pooja",     price:320,  old:null, emoji:"🥛", tag:"Pooja",    badge:"new",  desc:"5-item abhishek set — milk, curd, honey, ghee & sugar." },
  { id:4,  name:"Kumkum & Haldi Box",         cat:"pooja",     price:120,  old:null, emoji:"🔴", tag:"Pooja",    badge:null,   desc:"Pure temple-grade kumkum & haldi in decorative box." },
  { id:5,  name:"Camphor Tablets (100 pcs)",  cat:"pooja",     price:80,   old:null, emoji:"🕯️", tag:"Pooja",    badge:null,   desc:"Pure camphor tablets for aarti and havan." },
  { id:6,  name:"Bhavani Agarbatti Set",      cat:"pooja",     price:150,  old:null, emoji:"🌺", tag:"Pooja",    badge:"new",  desc:"Temple-blended incense sticks — marigold & sandalwood." },
  { id:7,  name:"Temple Prasad Laddoo 500g",  cat:"prasad",    price:200,  old:null, emoji:"🍬", tag:"Prasad",   badge:null,   desc:"Pure ghee & jaggery prasad laddoo, blessed at the mandir." },
  { id:8,  name:"Shrikhand Prasad 250ml",     cat:"prasad",    price:180,  old:null, emoji:"🍮", tag:"Prasad",   badge:"new",  desc:"Freshly prepared shrikhand — blessed at the mandir." },
  { id:9,  name:"Panchafal Offering Box",     cat:"prasad",    price:250,  old:null, emoji:"🍎", tag:"Prasad",   badge:null,   desc:"Seasonal five-fruit offering box, hygienically packed." },
  { id:10, name:"Aarti Sangrah (Marathi)",    cat:"book",      price:60,   old:null, emoji:"📖", tag:"Book",     badge:null,   desc:"Complete Marathi aarti book with Tulja Bhavani aarti." },
  { id:11, name:"2026 Temple Wall Calendar",  cat:"book",      price:40,   old:null, emoji:"📅", tag:"Book",     badge:"new",  desc:"Wall calendar with festival dates & Bhavani images." },
  { id:12, name:"Navratri Vrat Katha",        cat:"book",      price:75,   old:null, emoji:"📜", tag:"Book",     badge:null,   desc:"Illustrated story booklet for Navratri pooja rituals." },
  { id:13, name:"Rudraksha Mala 5 Mukhi",     cat:"accessory", price:450,  old:600,  emoji:"📿", tag:"Accessory",badge:"sale", desc:"Original 5-mukhi rudraksha mala, 108 beads knotted." },
  { id:14, name:"Coconut Shell Diya Set (6)", cat:"accessory", price:220,  old:null, emoji:"🪔", tag:"Accessory",badge:null,   desc:"Eco-friendly coconut shell diyas — set of 6 pieces." },
  { id:15, name:"Bhavani Copper Yantra",      cat:"accessory", price:550,  old:700,  emoji:"🔱", tag:"Accessory",badge:"sale", desc:"Energised Shri Bhavani Yantra on pure copper, 3×3 inch." },
  { id:16, name:"Herbal Gulal Festival Pack", cat:"pooja",     price:90,   old:null, emoji:"🎨", tag:"Pooja",    badge:null,   desc:"Natural herbal gulal in saffron & red for festival puja." },
];

function loadCart() {
  try { return JSON.parse(sessionStorage.getItem('atbCart') || '{}'); } catch { return {}; }
}
function saveCart(c) { sessionStorage.setItem('atbCart', JSON.stringify(c)); }

let cart = loadCart();

function updateBadge() {
  const n = Object.values(cart).reduce((a,b)=>a+b,0);
  document.querySelectorAll('.cart-badge').forEach(el => el.textContent = n);
}

function addToCart(id) {
  cart[id] = (cart[id] || 0) + 1;
  saveCart(cart);
  updateBadge();
  const p = PRODUCTS.find(x => x.id === id);
  syncAddBtn(id);
  showToast(`${p.emoji} ${p.name} added to cart!`);
}

function syncAddBtn(id) {
  const btn = document.getElementById(`abtn-${id}`);
  if (!btn) return;
  if (cart[id]) { btn.textContent = `✓ (${cart[id]})`; btn.classList.add('added'); }
  else { btn.textContent = '+ Add'; btn.classList.remove('added'); }
}

/* ── CART DRAWER ── */
function openCart() {
  document.getElementById('cartDrawer').classList.add('open');
  document.getElementById('cartOverlay').classList.add('open');
  document.body.style.overflow = 'hidden';
  renderCart();
}
function closeCart() {
  document.getElementById('cartDrawer').classList.remove('open');
  document.getElementById('cartOverlay').classList.remove('open');
  document.body.style.overflow = '';
}

function renderCart() {
  const ids = Object.keys(cart).filter(id => cart[id] > 0);
  const list = document.getElementById('cdList');
  const foot = document.getElementById('cdFoot');
  if (!ids.length) {
    list.innerHTML = `<div class="cd-empty"><div class="cd-empty-icon">🪔</div><p>Your cart is empty.<br>Visit the shop to add items!</p></div>`;
    foot.style.display = 'none'; return;
  }
  list.innerHTML = ids.map(id => {
    const p = PRODUCTS.find(x => x.id == id);
    return `<div class="cd-item">
      <div class="cd-item-icon">${p.emoji}</div>
      <div class="cd-item-info">
        <div class="cd-item-name">${p.name}</div>
        <div class="cd-item-price">₹${(p.price*cart[id]).toLocaleString('en-IN')}</div>
      </div>
      <div class="cd-qty">
        <button class="cd-qbtn" onclick="chQty(${id},-1)">−</button>
        <span class="cd-qnum">${cart[id]}</span>
        <button class="cd-qbtn" onclick="chQty(${id},1)">+</button>
      </div>
      <button class="cd-del" onclick="removeItem(${id})">🗑️</button>
    </div>`;
  }).join('');
  const sub = ids.reduce((s,id)=>s+PRODUCTS.find(x=>x.id==id).price*cart[id],0);
  document.getElementById('cdSubtotal').textContent = `₹${sub.toLocaleString('en-IN')}`;
  document.getElementById('cdTotal').textContent = `₹${(sub+50).toLocaleString('en-IN')}`;
  foot.style.display = 'block';
}

function chQty(id, d) {
  cart[id] = (cart[id]||0)+d;
  if (cart[id]<=0) delete cart[id];
  saveCart(cart); updateBadge(); renderCart(); syncAddBtn(id);
}
function removeItem(id) {
  delete cart[id]; saveCart(cart); updateBadge(); renderCart(); syncAddBtn(id);
}

/* ── CHECKOUT MODAL ── */
function openCheckout() {
  closeCart();
  const ids = Object.keys(cart).filter(id=>cart[id]>0);
  const sub = ids.reduce((s,id)=>s+PRODUCTS.find(x=>x.id==id).price*cart[id],0);
  const total = sub + 50;
  let html = `<h4>📦 Order Summary</h4>`;
  ids.forEach(id => {
    const p = PRODUCTS.find(x=>x.id==id);
    html += `<div class="os-line"><span>${p.emoji} ${p.name} ×${cart[id]}</span><span>₹${(p.price*cart[id]).toLocaleString('en-IN')}</span></div>`;
  });
  html += `<div class="os-line"><span>Shipping</span><span>₹50</span></div>`;
  html += `<div class="os-line bold"><span>Total</span><span>₹${total.toLocaleString('en-IN')}</span></div>`;
  document.getElementById('moSummary').innerHTML = html;
  document.getElementById('moTotal').textContent = `₹${total.toLocaleString('en-IN')}`;
  document.getElementById('moForm').style.display='block';
  document.getElementById('moSuccess').style.display='none';
  document.getElementById('checkoutModal').classList.add('open');
  document.body.style.overflow='hidden';
}
function closeCheckout() {
  document.getElementById('checkoutModal').classList.remove('open');
  document.body.style.overflow='';
}
function placeOrder() {
  const name=document.getElementById('moName').value.trim();
  const phone=document.getElementById('moPhone').value.trim();
  const addr=document.getElementById('moAddr').value.trim();
  const city=document.getElementById('moCity').value.trim();
  const pin=document.getElementById('moPin').value.trim();
  if(!name){alert('Please enter your full name.');return;}
  if(phone.length<10){alert('Please enter a valid phone number.');return;}
  if(!addr){alert('Please enter your delivery address.');return;}
  if(!city){alert('Please enter your city.');return;}
  if(pin.length<6){alert('Please enter a valid 6-digit pincode.');return;}
  const oid='ATB-'+Date.now().toString().slice(-8).toUpperCase();
  document.getElementById('moOrderId').textContent=`Order ID: ${oid}`;
  document.getElementById('moForm').style.display='none';
  document.getElementById('moSuccess').style.display='block';
  cart={};saveCart(cart);updateBadge();
}

/* ── TOAST ── */
function showToast(msg) {
  const t=document.getElementById('toast');
  t.textContent=msg; t.classList.add('show');
  setTimeout(()=>t.classList.remove('show'),2500);
}

/* ── SCROLL FADE ── */
function checkFade() {
  document.querySelectorAll('.fade-up').forEach(el=>{
    if(el.getBoundingClientRect().top < window.innerHeight-60) el.classList.add('vis');
  });
}

/* ── INIT ── */
document.addEventListener('DOMContentLoaded',()=>{
  updateBadge();
  window.addEventListener('scroll',checkFade,{passive:true});
  checkFade();
});
