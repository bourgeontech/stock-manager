<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8"><meta name="viewport" content="width=device-width,initial-scale=1">
<title>About Temple – Aai Tulja Bhavani Mandir</title>
 <link rel="stylesheet" href="<?= base_url() ?>assets/css/shared.css">
 <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
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
<body>

  <!-- TOP BAR -->
  <div class="topbar">
    <div class="topbar-inner">
      <span>🕉️ जय तुळजाभवानी मातेकी जय 🕉️</span>
      <span class="topbar-sep">|</span>
      <span>📞 9822535654 &nbsp;/&nbsp; 8788097975</span>
      <span class="topbar-sep">|</span>
      <span>✉️ sadhanagroup.org@gmail.com</span>
      <span class="topbar-sep">|</span>
      <a href="https://shrituljabhavaniparas.org/index.php/worldline/donation">💛 Donate Online</a>
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
        <li><a href="<?php echo base_url(); ?>index.php/welcome/" class="active">Home</a></li>
        <li>
          <button class="nav-drop-btn">The Temple ▾</button>
          <div class="nav-dropdown">
            <a href="<?php echo base_url(); ?>index.php/welcome/aboutus">About Temple</a>
            <a href="<?php echo base_url(); ?>index.php/welcome/priest">Temple Priest</a>
            <a href="<?php echo base_url(); ?>index.php/welcome/trusteeboard">Trustee Board</a>
            <a href="<?php echo base_url(); ?>index.php/welcome/festivalCommittee">Festival Committee</a>
          </div>
        </li>
        <li>
          <button class="nav-drop-btn">Pooja ▾</button>
          <div class="nav-dropdown">
            <a href="https://shrituljabhavaniparas.org/index.php/welcome/dietys">Deities</a>
            <a href="https://shrituljabhavaniparas.org/index.php/welcome/templeTiming">Temple Timing</a>
          </div>
        </li>
        <li><a href="<?php echo base_url(); ?>index.php/welcome/news">News</a></li>
        <li><a href="<?php echo base_url(); ?>index.php/welcome/gallery">Gallery</a></li>
        <li><a href="<?php echo base_url(); ?>index.php/welcome/contact">Contact</a></li>
      </ul>
      <div class="nav-actions">
        <a href="<?php echo base_url(); ?>index.php/worldline/booking" class="nav-list a nav-btn-book"
          style="font-family:'Cinzel',serif;font-size:.71rem;letter-spacing:.07em;padding:7px 13px;border-radius:4px;text-decoration:none;background:linear-gradient(135deg,var(--gold),var(--gold-lt));color:var(--maroon-deep);font-weight:700;">📅
          Book Pooja</a>
        <a href="<?php echo base_url(); ?>index.php/worldline/donation" class="nav-btn-shop"
          style="font-family:'Cinzel Decorative',serif;font-size:.65rem;letter-spacing:.07em;padding:7px 13px;border-radius:4px;text-decoration:none;display:flex;align-items:center;gap:4px;">🛕
          For Sale</a>
        <button class="nav-btn-cart" onclick="openCart()">🛒 <span class="cart-badge">0</span></button>
      </div>
      <button class="hamburger"><span></span><span></span><span></span></button>
    </div>
  </header>

  <!-- MARQUEE -->
  <div class="marquee-bar">
    <span class="marquee-track">🪷 JAI TULJA BHAVANI &nbsp;✦&nbsp; ONLINE BOOKING AVAILABLE &nbsp;✦&nbsp; ARCHANA &amp;
      SANKALP POOJA &nbsp;✦&nbsp; NAVRATRI MAHOTSAV &nbsp;✦&nbsp; JAI JAGDAMB JAGDAMB &nbsp;✦&nbsp; PARAS · DIST AKOLA
      &nbsp;✦&nbsp; 🪷 JAI TULJA BHAVANI &nbsp;✦&nbsp; ONLINE BOOKING AVAILABLE &nbsp;✦&nbsp; ARCHANA &amp; SANKALP
      POOJA &nbsp;✦&nbsp; NAVRATRI MAHOTSAV &nbsp;✦&nbsp; JAI JAGDAMB JAGDAMB &nbsp;✦&nbsp; PARAS · DIST AKOLA
      &nbsp;✦&nbsp;</span>
  </div>