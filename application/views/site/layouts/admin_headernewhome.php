<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Aai Tulja Bhavani Mandir – Paras, Akola</title>
  <link rel="stylesheet" href="<?= base_url() ?>assets/css/shared.css">
  <style>
    /* ── HERO SLIDER ── */
    .hero {
      position: relative;
      height: clamp(340px, 56vw, 610px);
      overflow: hidden;
      background: var(--maroon-deep);
    }

    .slide {
      position: absolute;
      inset: 0;
      opacity: 0;
      transition: opacity 1.1s ease;
    }

    .slide.active {
      opacity: 1;
    }

    .slide img {
      width: 100%;
      height: 100%;
      object-fit: cover;
      filter: brightness(.68) saturate(1.1);
    }

    .hero-overlay {
      position: absolute;
      inset: 0;
      background: linear-gradient(180deg, rgba(58, 10, 0, .12) 0%, rgba(58, 10, 0, .5) 55%, rgba(58, 10, 0, .88) 100%);
    }

    .hero-content {
      position: absolute;
      bottom: 0;
      left: 0;
      right: 0;
      padding: clamp(22px, 5vw, 60px) clamp(20px, 7vw, 90px);
      text-align: center;
    }

    .hero-deva {
      font-family: 'Noto Serif Devanagari', serif;
      font-size: clamp(.9rem, 2.2vw, 1.4rem);
      color: var(--gold-lt);
      letter-spacing: .1em;
      margin-bottom: 7px;
      animation: fadeD .9s ease both;
    }

    .hero-h1 {
      font-family: 'Cinzel Decorative', serif;
      font-size: clamp(1.5rem, 5vw, 3.2rem);
      color: #fff;
      line-height: 1.1;
      text-shadow: 0 4px 22px rgba(0, 0, 0, .7);
      margin-bottom: 6px;
      animation: fadeD .9s .1s ease both;
    }

    .hero-h1 em {
      color: var(--gold-lt);
      font-style: normal;
    }

    .hero-sub {
      color: rgba(253, 239, 192, .78);
      font-size: clamp(.75rem, 1.4vw, .95rem);
      letter-spacing: .16em;
      margin-bottom: 26px;
      animation: fadeD .9s .2s ease both;
    }

    .hero-ctas {
      display: flex;
      gap: 10px;
      justify-content: center;
      flex-wrap: wrap;
      animation: fadeD .9s .3s ease both;
    }

    .hero-cta {
      font-family: 'Cinzel', serif;
      font-size: .78rem;
      letter-spacing: .08em;
      padding: 11px 24px;
      border-radius: 5px;
      text-decoration: none;
      border: none;
      cursor: pointer;
      transition: transform .15s, box-shadow .15s;
    }

    .hero-cta:hover {
      transform: translateY(-2px);
    }

    .cta-saffron {
      background: linear-gradient(135deg, var(--saffron), var(--saffron-lt));
      color: #fff;
      box-shadow: 0 4px 18px rgba(180, 60, 0, .45);
    }

    .cta-gold {
      background: linear-gradient(135deg, var(--gold), var(--gold-lt));
      color: var(--maroon-deep);
      font-weight: 700;
      box-shadow: 0 4px 18px rgba(200, 140, 0, .4);
    }

    .cta-ghost {
      background: rgba(255, 255, 255, .1);
      color: var(--gold-pale);
      border: 1.5px solid rgba(201, 147, 10, .55);
      backdrop-filter: blur(6px);
    }

    @keyframes fadeD {
      from {
        opacity: 0;
        transform: translateY(-14px)
      }

      to {
        opacity: 1;
        transform: none
      }
    }

    .s-dots {
      position: absolute;
      bottom: 16px;
      left: 50%;
      transform: translateX(-50%);
      display: flex;
      gap: 7px;
    }

    .s-dot {
      width: 7px;
      height: 7px;
      border-radius: 50%;
      background: rgba(255, 255, 255, .38);
      border: none;
      cursor: pointer;
      transition: .3s;
    }

    .s-dot.active {
      background: var(--gold-lt);
      transform: scale(1.35);
    }

    .s-arrow {
      position: absolute;
      top: 50%;
      transform: translateY(-50%);
      background: rgba(0, 0, 0, .28);
      border: 1.5px solid rgba(255, 255, 255, .22);
      color: #fff;
      font-size: 1.2rem;
      width: 38px;
      height: 38px;
      border-radius: 50%;
      cursor: pointer;
      display: flex;
      align-items: center;
      justify-content: center;
      transition: background .2s;
    }

    .s-arrow:hover {
      background: rgba(201, 147, 10, .5);
    }

    .s-prev {
      left: 14px;
    }

    .s-next {
      right: 14px;
    }

    /* ── STATS BAR ── */
    .stats-bar {
      background: linear-gradient(135deg, var(--maroon), #8b2500);
    }

    .stats-inner {
      max-width: 1160px;
      margin: 0 auto;
      display: grid;
      grid-template-columns: repeat(4, 1fr);
    }

    .stat-cell {
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 10px;
      padding: 18px 14px;
      border-right: 1px solid rgba(255, 255, 255, .1);
    }

    .stat-cell:last-child {
      border: none;
    }

    .stat-icon {
      font-size: 1.6rem;
    }

    .stat-label {
      font-size: .62rem;
      letter-spacing: .14em;
      color: rgba(253, 239, 192, .65);
      text-transform: uppercase;
    }

    .stat-val {
      font-family: 'Cinzel', serif;
      font-size: .86rem;
      color: var(--gold-pale);
    }

    /* ── ABOUT ── */
    .about-grid {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 56px;
      align-items: center;
    }

    .about-img-wrap {
      position: relative;
    }

    .about-img {
      width: 100%;
      aspect-ratio: 4/5;
      object-fit: cover;
      border-radius: var(--r);
      box-shadow: var(--sh-warm);
    }

    .about-badge {
      position: absolute;
      bottom: -18px;
      right: -18px;
      background: linear-gradient(135deg, var(--gold), var(--gold-lt));
      color: var(--maroon-deep);
      padding: 16px 20px;
      border-radius: var(--r-sm);
      box-shadow: var(--sh-warm);
      text-align: center;
    }

    .about-badge strong {
      font-family: 'Cinzel Decorative', serif;
      font-size: 1.1rem;
      display: block;
    }

    .about-badge span {
      font-size: .65rem;
      letter-spacing: .1em;
    }

    .trust-row {
      display: flex;
      gap: 18px;
      margin-top: 20px;
      flex-wrap: wrap;
    }

    .trust-item {
      display: flex;
      align-items: center;
      gap: 7px;
      font-size: .78rem;
      color: var(--text-mid);
    }

    .ti-icon {
      color: var(--gold);
    }

    /* ── SERVICES ── */
    .services-wrap {
      background: var(--cream-dark);
    }

    .services-grid {
      display: grid;
      grid-template-columns: repeat(auto-fill, minmax(196px, 1fr));
      gap: 18px;
      margin-top: 38px;
    }

    .svc-card {
      background: var(--white);
      border: 1px solid rgba(201, 147, 10, .22);
      border-radius: var(--r);
      padding: 26px 18px;
      text-align: center;
      box-shadow: var(--sh-card);
      transition: transform .2s, box-shadow .2s;
    }

    .svc-card:hover {
      transform: translateY(-4px);
      box-shadow: var(--sh-warm);
    }

    .svc-icon {
      font-size: 2.2rem;
      margin-bottom: 12px;
    }

    .svc-deva {
      font-family: 'Noto Serif Devanagari', serif;
      font-size: .8rem;
      color: var(--gold);
      margin-bottom: 4px;
    }

    .svc-name {
      font-family: 'Cinzel', serif;
      font-size: .86rem;
      color: var(--maroon);
      margin-bottom: 6px;
    }

    .svc-desc {
      font-size: .74rem;
      color: var(--text-light);
      line-height: 1.56;
    }

    .booking-cta {
      background: linear-gradient(135deg, var(--maroon-deep), var(--maroon));
      border-radius: var(--r);
      padding: 32px 24px;
      text-align: center;
      color: var(--gold-pale);
      box-shadow: var(--sh-warm);
    }

    .booking-cta h3 {
      font-family: 'Cinzel Decorative', serif;
      font-size: 1rem;
      color: var(--gold-lt);
      margin-bottom: 9px;
    }

    .booking-cta p {
      font-size: .8rem;
      margin-bottom: 18px;
      opacity: .84;
      line-height: 1.6;
    }

    /* ── EVENTS+GALLERY GRID ── */
    .eg-grid {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 38px;
    }

    .ev-card {
      background: var(--white);
      border-radius: var(--r);
      overflow: hidden;
      border: 1px solid rgba(201, 147, 10, .18);
      box-shadow: var(--sh-card);
      transition: transform .2s;
    }

    .ev-card:hover {
      transform: translateY(-4px);
    }

    .ev-img {
      width: 100%;
      aspect-ratio: 16/9;
      object-fit: cover;
    }

    .ev-info {
      padding: 14px 16px;
    }

    .ev-info h4 {
      font-family: 'Cinzel', serif;
      font-size: .86rem;
      color: var(--maroon);
      margin-bottom: 5px;
    }

    .ev-info p {
      font-size: .76rem;
      color: var(--text-light);
      line-height: 1.58;
    }

    .mosaic {
      display: grid;
      grid-template-columns: repeat(3, 1fr);
      gap: 8px;
    }

    .mosaic-item {
      border-radius: var(--r-sm);
      overflow: hidden;
      position: relative;
      cursor: pointer;
    }

    .mosaic-item:first-child {
      grid-column: span 2;
    }

    .mosaic-item img {
      width: 100%;
      height: 100%;
      object-fit: cover;
      display: block;
      transition: transform .3s;
    }

    .mosaic-item:hover img {
      transform: scale(1.07);
    }

    .mosaic-overlay {
      position: absolute;
      inset: 0;
      background: rgba(58, 10, 0, .42);
      opacity: 0;
      transition: opacity .3s;
      display: flex;
      align-items: center;
      justify-content: center;
      color: #fff;
      font-size: 1.3rem;
    }

    .mosaic-item:hover .mosaic-overlay {
      opacity: 1;
    }

    /* ── TIMING ── */
    .timing-bg {
      background: linear-gradient(135deg, var(--maroon-deep), var(--maroon));
    }

    .timing-grid {
      display: grid;
      grid-template-columns: repeat(auto-fill, minmax(185px, 1fr));
      gap: 16px;
      margin-top: 34px;
    }

    .t-card {
      background: rgba(255, 255, 255, .07);
      border: 1px solid rgba(201, 147, 10, .28);
      border-radius: var(--r);
      padding: 20px 16px;
      text-align: center;
    }

    .t-card .t-icon {
      font-size: 1.9rem;
      margin-bottom: 8px;
    }

    .t-card h4 {
      font-family: 'Cinzel', serif;
      font-size: .84rem;
      color: var(--gold-lt);
      margin-bottom: 5px;
    }

    .t-card p {
      font-size: .77rem;
      opacity: .78;
      line-height: 1.58;
      color: var(--gold-pale);
    }

    /* ── DONATION CTA ── */
    .donate-cta {
      background: linear-gradient(160deg, #7b1e00, #c4400a 60%, #e8610a);
      text-align: center;
      padding: 60px 20px;
    }

    .donate-cta h2 {
      font-family: 'Cinzel Decorative', serif;
      color: var(--gold-pale);
      font-size: clamp(1.3rem, 3vw, 1.9rem);
      margin-bottom: 10px;
    }

    .donate-cta p {
      color: rgba(253, 239, 192, .82);
      font-size: .92rem;
      max-width: 500px;
      margin: 0 auto 26px;
      line-height: 1.7;
    }

    .donate-row {
      display: flex;
      gap: 12px;
      justify-content: center;
      flex-wrap: wrap;
    }

    @media(max-width:860px) {
      .about-grid {
        grid-template-columns: 1fr;
        gap: 28px;
      }

      .about-badge {
        bottom: -10px;
        right: 10px;
      }

      .eg-grid {
        grid-template-columns: 1fr;
        gap: 24px;
      }

      .stats-inner {
        grid-template-columns: repeat(2, 1fr);
      }

      .stat-cell:nth-child(2) {
        border-right: none;
      }
    }
  </style>
</head>

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
        <li><a href="index.html" class="active">Home</a></li>
        <li>
          <button class="nav-drop-btn">The Temple ▾</button>
          <div class="nav-dropdown">
            <a href="<?php echo base_url(); ?>index.php/welcome/aboutUs"">About Temple</a>
            <a href="https://shrituljabhavaniparas.org/index.php/welcome/priest">Temple Priest</a>
            <a href="https://shrituljabhavaniparas.org/index.php/welcome/trusteeboard">Trustee Board</a>
            <a href="https://shrituljabhavaniparas.org/index.php/welcome/festivalCommittee">Festival Committee</a>
          </div>
        </li>
        <li>
          <button class="nav-drop-btn">Pooja ▾</button>
          <div class="nav-dropdown">
            <a href="https://shrituljabhavaniparas.org/index.php/welcome/dietys">Deities</a>
            <a href="https://shrituljabhavaniparas.org/index.php/welcome/templeTiming">Temple Timing</a>
          </div>
        </li>
        <li><a href="news.html">News</a></li>
        <li><a href="https://shrituljabhavaniparas.org/index.php/welcome/gallery">Gallery</a></li>
        <li><a href="https://shrituljabhavaniparas.org/index.php/welcome/contact">Contact</a></li>
      </ul>
      <div class="nav-actions">
        <a href="https://shrituljabhavaniparas.org/index.php/worldline/booking" class="nav-list a nav-btn-book"
          style="font-family:'Cinzel',serif;font-size:.71rem;letter-spacing:.07em;padding:7px 13px;border-radius:4px;text-decoration:none;background:linear-gradient(135deg,var(--gold),var(--gold-lt));color:var(--maroon-deep);font-weight:700;">📅
          Book Pooja</a>
        <a href="shop.html" class="nav-btn-shop"
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