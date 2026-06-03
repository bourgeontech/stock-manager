<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>ശ്രീ കല്ലേരി കുട്ടിച്ചാത്തൻ ക്ഷേത്രം | Sree Kalleri Kuttichathan Kshethram</title>
<link href="https://fonts.googleapis.com/css2?family=Yatra+One&family=Tiro+Devanagari+Sanskrit:ital@0;1&family=Libre+Baskerville:ital,wght@0,400;0,700;1,400&family=Jost:wght@300;400;500;600&display=swap" rel="stylesheet">
<style>
*{margin:0;padding:0;box-sizing:border-box;}

:root{
  --vermillion:#b5200b;
  --vermillion-dark:#7d1508;
  --vermillion-light:#e8402a;
  --gold:#c8922a;
  --gold-light:#e8b84b;
  --gold-pale:#fdf3d9;
  --saffron:#f5820d;
  --deep:#120800;
  --brown:#2e1200;
  --sand:#f7efe0;
  --cream:#fdfaf4;
  --border:rgba(200,146,42,0.25);
  --text:#2e1200;
  --muted:#7a5c3a;
}

html{scroll-behavior:smooth;}

body{
  font-family:'Jost',sans-serif;
  background:var(--cream);
  color:var(--text);
  overflow-x:hidden;
}

/* ── TOPBAR ── */
.topbar{
  background:var(--vermillion-dark);
  padding:.45rem 2rem;
  display:flex;justify-content:flex-end;align-items:center;gap:2rem;
  font-size:.78rem;letter-spacing:.08em;color:rgba(255,255,255,.75);
}
.topbar a{color:rgba(255,255,255,.75);text-decoration:none;display:flex;align-items:center;gap:.35rem;}
.topbar a:hover{color:#fff;}
.topbar .booking-cta{
  background:var(--gold);color:var(--deep);
  padding:.3rem .9rem;border-radius:2px;
  font-weight:600;letter-spacing:.1em;text-transform:uppercase;font-size:.72rem;
}
.topbar .booking-cta:hover{background:var(--gold-light);}

/* ── NAVBAR ── */
nav{
  background:var(--deep);
  position:sticky;top:0;z-index:200;
  border-bottom:2px solid var(--gold);
}
.nav-inner{
  max-width:1200px;margin:0 auto;
  display:flex;align-items:center;justify-content:space-between;
  padding:.85rem 2rem;
}
.nav-brand{
  font-family:'Yatra One',cursive;
  color:var(--gold-light);font-size:1.05rem;line-height:1.25;
}
.nav-brand span{
  display:block;font-family:'Jost',sans-serif;
  font-size:.62rem;color:rgba(255,255,255,.5);
  letter-spacing:.18em;text-transform:uppercase;font-weight:300;margin-top:.1rem;
}
.nav-links{
  display:flex;gap:.15rem;list-style:none;
}
.nav-links li{position:relative;}
.nav-links a{
  color:rgba(255,255,255,.75);text-decoration:none;
  font-size:.78rem;letter-spacing:.08em;text-transform:uppercase;font-weight:500;
  padding:.5rem .9rem;display:block;
  transition:color .2s;border-radius:2px;
}
.nav-links a:hover{color:var(--gold-light);}
.nav-links .dropdown{
  position:absolute;top:100%;left:0;
  background:var(--deep);border:1px solid rgba(200,146,42,.2);
  min-width:200px;display:none;
  box-shadow:0 12px 32px rgba(0,0,0,.4);
}
.nav-links li:hover .dropdown{display:block;}
.nav-links .dropdown a{
  padding:.55rem 1rem;font-size:.75rem;
  border-bottom:1px solid rgba(255,255,255,.05);
}
.hamburger{display:none;flex-direction:column;gap:5px;cursor:pointer;padding:.5rem;}
.hamburger span{width:22px;height:2px;background:var(--gold-light);display:block;}

/* ── HERO ── */
.hero{
  position:relative;height:92vh;min-height:580px;
  background:#120800;overflow:hidden;
}
.hero-slides{position:absolute;inset:0;}
.hero-slide{
  position:absolute;inset:0;opacity:0;
  transition:opacity 1.5s ease;
  background-size:cover;background-position:center;
}
.hero-slide.active{opacity:1;}
.hero-slide::after{
  content:'';position:absolute;inset:0;
  background:linear-gradient(
    to bottom,
    rgba(18,8,0,.35) 0%,
    rgba(18,8,0,.2) 40%,
    rgba(18,8,0,.75) 100%
  );
}
.slide1{background-image:url('http://kallerikuttichathantemple.org/uploads/banner/kalleri_71.jpeg');}
.slide2{background-image:url('http://kallerikuttichathantemple.org/uploads/banner/kalleri05.jpeg');}
.slide3{background-image:url('http://kallerikuttichathantemple.org/uploads/banner/kalleri456.jpeg');}
.slide4{background-image:url('http://kallerikuttichathantemple.org/uploads/banner/kalleri67.jpeg');}
.slide5{background-image:url('http://kallerikuttichathantemple.org/uploads/banner/temple25.jpg');}

.hero-content{
  position:absolute;bottom:0;left:0;right:0;
  padding:3rem 2rem 4rem;
  max-width:1200px;margin:0 auto;
  z-index:10;
}
.hero-eyebrow{
  font-size:.72rem;letter-spacing:.25em;text-transform:uppercase;
  color:var(--gold-light);font-weight:500;
  display:flex;align-items:center;gap:.7rem;margin-bottom:.8rem;
  animation:fadeUp .8s .1s both;
}
.hero-eyebrow::before{content:'';width:32px;height:1px;background:var(--gold-light);}

.hero h1{
  font-family:'Yatra One',cursive;
  font-size:clamp(2rem,5vw,3.8rem);
  color:#fff;line-height:1.1;
  text-shadow:0 4px 24px rgba(0,0,0,.5);
  margin-bottom:.5rem;
  animation:fadeUp .8s .2s both;
}
.hero h1 em{
  display:block;font-style:normal;
  font-family:'Jost',sans-serif;font-size:.35em;font-weight:300;
  letter-spacing:.12em;color:rgba(255,255,255,.7);text-transform:uppercase;
  margin-top:.35rem;
}
.hero-sub{
  color:rgba(255,255,255,.65);font-size:.9rem;
  letter-spacing:.08em;margin-bottom:2rem;
  animation:fadeUp .8s .3s both;
}
.hero-actions{
  display:flex;gap:1rem;flex-wrap:wrap;
  animation:fadeUp .8s .4s both;
}
.btn-primary{
  background:var(--vermillion);color:#fff;
  padding:.75rem 2rem;font-family:'Jost',sans-serif;
  font-size:.82rem;font-weight:600;letter-spacing:.12em;text-transform:uppercase;
  text-decoration:none;border:none;cursor:pointer;
  transition:background .2s,transform .2s;display:inline-block;
}
.btn-primary:hover{background:var(--vermillion-light);transform:translateY(-2px);}
.btn-ghost{
  background:transparent;color:#fff;
  padding:.75rem 2rem;
  font-family:'Jost',sans-serif;font-size:.82rem;font-weight:500;
  letter-spacing:.12em;text-transform:uppercase;
  text-decoration:none;border:1.5px solid rgba(255,255,255,.45);
  transition:border-color .2s,color .2s;display:inline-block;
}
.btn-ghost:hover{border-color:var(--gold-light);color:var(--gold-light);}

.hero-dots{
  position:absolute;bottom:2rem;right:2rem;z-index:10;
  display:flex;gap:.5rem;
}
.dot{
  width:8px;height:8px;border-radius:50%;
  background:rgba(255,255,255,.3);cursor:pointer;
  transition:background .3s,transform .3s;border:none;
}
.dot.active{background:var(--gold-light);transform:scale(1.3);}

/* ── STRIP ── */
.strip{
  background:var(--vermillion-dark);
  display:flex;justify-content:center;gap:0;
}
.strip-item{
  flex:1;max-width:300px;
  padding:1.2rem 1.5rem;text-align:center;
  border-right:1px solid rgba(255,255,255,.1);
  transition:background .2s;
}
.strip-item:last-child{border-right:none;}
.strip-item:hover{background:rgba(0,0,0,.2);}
.strip-item .si-icon{font-size:1.3rem;margin-bottom:.3rem;}
.strip-item .si-label{font-size:.68rem;letter-spacing:.12em;text-transform:uppercase;color:rgba(255,255,255,.55);font-weight:500;}
.strip-item .si-val{font-size:.88rem;color:#fff;font-weight:500;margin-top:.1rem;}

/* ── ORNAMENT ── */
.ornament{
  text-align:center;padding:3rem 2rem 1.5rem;
  display:flex;align-items:center;justify-content:center;gap:1.2rem;
}
.ornament-line{flex:1;height:1px;background:linear-gradient(90deg,transparent,var(--border),transparent);}
.ornament-sym{
  font-family:'Tiro Devanagari Sanskrit',serif;
  color:var(--gold);font-size:1.1rem;letter-spacing:.15em;white-space:nowrap;
}

/* ── ABOUT ── */
.about{
  max-width:1200px;margin:0 auto;padding:1rem 2rem 5rem;
  display:grid;grid-template-columns:1fr 1fr;gap:5rem;align-items:center;
}
@media(max-width:800px){.about{grid-template-columns:1fr;gap:2.5rem;}}
.about-img{
  position:relative;
}
.about-img img{
  width:100%;height:460px;object-fit:cover;
  display:block;
}
.about-img::before{
  content:'';position:absolute;
  top:-14px;left:-14px;right:14px;bottom:14px;
  border:2px solid var(--gold);
  pointer-events:none;z-index:-1;
  opacity:.4;
}
.about-img-badge{
  position:absolute;bottom:-1px;right:-1px;
  background:var(--vermillion-dark);
  padding:1rem 1.4rem;
  font-family:'Yatra One',cursive;color:var(--gold-light);
  font-size:.85rem;text-align:center;line-height:1.4;
}
.section-label{
  font-size:.68rem;letter-spacing:.22em;text-transform:uppercase;
  color:var(--saffron);font-weight:600;margin-bottom:.7rem;
  display:flex;align-items:center;gap:.6rem;
}
.section-label::before{content:'';width:20px;height:2px;background:var(--saffron);}
.about-text h2{
  font-family:'Libre Baskerville',serif;
  font-size:2rem;color:var(--brown);line-height:1.25;margin-bottom:1.2rem;
}
.about-text h2 span{color:var(--vermillion);}
.about-text .ml-text{
  font-family:'Tiro Devanagari Sanskrit',serif;
  font-size:1.1rem;color:var(--muted);line-height:1.8;margin-bottom:.8rem;
}
.about-text p{
  font-size:.93rem;color:#5a4020;line-height:1.85;margin-bottom:1.5rem;
}
.about-stats{
  display:grid;grid-template-columns:1fr 1fr;gap:1px;
  background:var(--border);margin-bottom:1.5rem;border:1px solid var(--border);
}
.stat{background:var(--cream);padding:.9rem 1rem;text-align:center;}
.stat-num{font-family:'Libre Baskerville',serif;font-size:1.6rem;color:var(--vermillion);font-weight:700;}
.stat-label{font-size:.72rem;letter-spacing:.1em;text-transform:uppercase;color:var(--muted);margin-top:.2rem;}

/* ── TIMING BAND ── */
.timing-band{
  background:var(--deep);
  padding:2.5rem 2rem;
}
.timing-inner{
  max-width:1200px;margin:0 auto;
  display:flex;align-items:center;gap:3rem;flex-wrap:wrap;justify-content:center;
}
.timing-inner .tl{
  font-family:'Yatra One',cursive;color:var(--gold-light);font-size:1.3rem;
  white-space:nowrap;
}
.timing-slots{display:flex;gap:2px;flex-wrap:wrap;justify-content:center;}
.tslot{
  background:rgba(255,255,255,.04);
  border:1px solid rgba(200,146,42,.2);
  padding:.7rem 1.5rem;text-align:center;
}
.tslot .ts-label{font-size:.65rem;letter-spacing:.14em;text-transform:uppercase;color:rgba(255,255,255,.4);margin-bottom:.25rem;}
.tslot .ts-time{font-size:.95rem;color:#fff;font-weight:500;}

/* ── POOJAS ── */
.poojas-sec{padding:4rem 2rem;background:var(--sand);}
.poojas-inner{max-width:1200px;margin:0 auto;}
.sec-head{text-align:center;margin-bottom:2.5rem;}
.sec-head h2{font-family:'Libre Baskerville',serif;font-size:1.8rem;color:var(--brown);margin-bottom:.3rem;}
.sec-head p{color:var(--muted);font-size:.88rem;letter-spacing:.06em;}

.poojas-grid{
  display:grid;
  grid-template-columns:repeat(auto-fill,minmax(190px,1fr));
  gap:1px;background:var(--border);border:1px solid var(--border);
}
.pooja-item{
  background:var(--cream);padding:.85rem 1rem;
  display:flex;align-items:center;gap:.7rem;
  transition:background .2s;cursor:default;
}
.pooja-item:hover{background:var(--gold-pale);}
.pooja-dot{
  width:7px;height:7px;border-radius:50%;
  background:var(--gold);flex-shrink:0;
}
.pooja-name{font-size:.8rem;color:var(--text);line-height:1.4;}
.pooja-name .ml{display:block;font-size:.72rem;color:var(--muted);}

.poojas-cta{text-align:center;margin-top:2rem;}

/* ── EVENTS ── */
.events-sec{padding:4rem 2rem;}
.events-inner{max-width:1200px;margin:0 auto;}
.events-grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(280px,1fr));gap:1.5rem;margin-top:2.5rem;}
.event-card{
  background:#fff;border:1px solid var(--border);
  overflow:hidden;transition:transform .25s,box-shadow .25s;
}
.event-card:hover{transform:translateY(-4px);box-shadow:0 12px 36px rgba(46,18,0,.1);}
.event-card img{width:100%;height:200px;object-fit:cover;display:block;}
.event-info{padding:1.2rem;}
.event-tag{
  font-size:.65rem;letter-spacing:.14em;text-transform:uppercase;
  background:var(--gold-pale);color:var(--gold);
  padding:.2rem .6rem;display:inline-block;margin-bottom:.6rem;
  border:1px solid rgba(200,146,42,.3);
}
.event-info h3{font-family:'Libre Baskerville',serif;font-size:1rem;color:var(--brown);line-height:1.3;}

/* ── GALLERY ── */
.gallery-sec{padding:4rem 2rem;background:var(--deep);}
.gallery-inner{max-width:1200px;margin:0 auto;}
.gallery-sec .sec-head h2{color:var(--gold-light);}
.gallery-sec .sec-head p{color:rgba(255,255,255,.4);}
.gallery-grid{
  display:grid;
  grid-template-columns:2fr 1fr 1fr;
  grid-template-rows:220px 220px;
  gap:4px;margin-top:2rem;
}
.gallery-grid .g-item{overflow:hidden;}
.gallery-grid .g-item img{width:100%;height:100%;object-fit:cover;display:block;transition:transform .5s;}
.gallery-grid .g-item:hover img{transform:scale(1.06);}
.gallery-grid .g-item:first-child{grid-row:1/3;}
.gallery-cta{text-align:center;margin-top:1.5rem;}

/* ── CONTACT ── */
.contact-sec{
  background:var(--sand);padding:4rem 2rem;
}
.contact-inner{
  max-width:1200px;margin:0 auto;
  display:grid;grid-template-columns:1fr 1fr;gap:4rem;align-items:start;
}
@media(max-width:700px){.contact-inner{grid-template-columns:1fr;gap:2rem;}}
.contact-info h2{font-family:'Libre Baskerville',serif;font-size:1.5rem;color:var(--brown);margin-bottom:1.5rem;}
.contact-row{
  display:flex;gap:1rem;align-items:flex-start;margin-bottom:1.2rem;
}
.c-icon{
  width:36px;height:36px;background:var(--vermillion);
  display:flex;align-items:center;justify-content:center;
  font-size:.95rem;flex-shrink:0;color:#fff;
}
.c-data h4{font-size:.72rem;letter-spacing:.12em;text-transform:uppercase;color:var(--muted);margin-bottom:.2rem;}
.c-data p{font-size:.9rem;color:var(--text);line-height:1.5;}
.c-data a{color:var(--vermillion);text-decoration:none;}

.map-placeholder{
  background:var(--deep);height:240px;
  display:flex;align-items:center;justify-content:center;
  border:1px solid var(--border);color:rgba(255,255,255,.3);
  font-size:.85rem;letter-spacing:.1em;text-transform:uppercase;
}

/* ── FOOTER ── */
footer{
  background:var(--deep);
  border-top:2px solid var(--gold);
}
.footer-main{
  max-width:1200px;margin:0 auto;
  display:grid;grid-template-columns:1.5fr 1fr 1fr;gap:3rem;
  padding:3rem 2rem;
}
@media(max-width:700px){.footer-main{grid-template-columns:1fr;gap:1.5rem;}}
.footer-brand{
  font-family:'Yatra One',cursive;color:var(--gold-light);font-size:1.1rem;margin-bottom:.8rem;
}
.footer-tagline{color:rgba(255,255,255,.4);font-size:.82rem;line-height:1.7;margin-bottom:1rem;}
.footer-col h4{
  font-size:.68rem;letter-spacing:.16em;text-transform:uppercase;
  color:var(--gold);margin-bottom:1rem;font-weight:600;
}
.footer-col ul{list-style:none;}
.footer-col ul li{margin-bottom:.55rem;}
.footer-col ul a{color:rgba(255,255,255,.5);text-decoration:none;font-size:.83rem;transition:color .2s;}
.footer-col ul a:hover{color:var(--gold-light);}
.footer-bottom{
  border-top:1px solid rgba(255,255,255,.06);
  padding:1rem 2rem;text-align:center;
  font-size:.75rem;color:rgba(255,255,255,.3);
  max-width:1200px;margin:0 auto;
}

/* ── ANIMATIONS ── */
@keyframes fadeUp{
  from{opacity:0;transform:translateY(20px)}
  to{opacity:1;transform:translateY(0)}
}
.reveal{opacity:0;transform:translateY(24px);transition:opacity .7s,transform .7s;}
.reveal.visible{opacity:1;transform:none;}

/* ── RESPONSIVE ── */
@media(max-width:900px){
  .nav-links,.topbar{display:none;}
  .hamburger{display:flex;}
  .about{padding-bottom:3rem;}
  .footer-main{padding:2rem 1.5rem;}
}
@media(max-width:600px){
  .strip{flex-direction:column;}
  .strip-item{max-width:100%;border-right:none;border-bottom:1px solid rgba(255,255,255,.1);}
  .gallery-grid{grid-template-columns:1fr 1fr;grid-template-rows:auto;}
  .gallery-grid .g-item:first-child{grid-row:auto;grid-column:1/3;}
}

.auditorium{background:linear-gradient(160deg,var(--deep),var(--maroon));padding:5rem 0;position:relative;overflow:hidden}
.auditorium::before{content:'';position:absolute;inset:0;background:radial-gradient(ellipse 60% 70% at 80% 50%,rgba(201,147,10,.1),transparent)}
.auditorium-grid{display:grid;grid-template-columns:1fr 1fr;gap:4rem;align-items:center}
.aud-img{border-radius:18px;overflow:hidden;border:2px solid rgba(201,147,10,.3);box-shadow:0 20px 60px rgba(0,0,0,.4)}
.aud-img img{width:100%;height:320px;object-fit:cover;display:block}
.aud-label{font-size:.72rem;letter-spacing:.25em;text-transform:uppercase;color:var(--gold);margin-bottom:.75rem;font-weight:600}
.aud-title{font-family:'Cinzel',serif;font-size:clamp(1.5rem,3vw,2.2rem);font-weight:700;color:var(--cream);margin-bottom:1rem}
.aud-desc{font-size:.9rem;color:rgba(253,246,236,.6);line-height:1.75;margin-bottom:2rem}
.aud-features{display:grid;grid-template-columns:1fr 1fr;gap:.6rem;margin-bottom:2rem}
.aud-feat{display:flex;align-items:center;gap:.5rem;font-size:.82rem;color:rgba(253,246,236,.7)}
.aud-feat::before{content:'✦';color:var(--gold);font-size:.65rem}
.btn-aud{display:inline-flex;align-items:center;gap:.5rem;border:1.5px solid rgba(201,147,10,.5);color:var(--gold-lt);padding:.75rem 1.75rem;border-radius:9px;font-size:.88rem;font-weight:600;text-decoration:none;transition:all .25s}
.btn-aud:hover{background:rgba(201,147,10,.12);border-color:var(--gold-lt)}
</style>
</head>
<body>

<!-- TOPBAR -->
<div class="topbar">
  <a href="tel:04962533301">📞 0496 253 3301</a>
  <a href="mailto:kalleritemple@gmail.com">✉ kalleritemple@gmail.com</a>
  <a href="http://kallerikuttichathantemple.org/index.php/worldline/booking" class="booking-cta">Online Booking</a>
</div>

<!-- NAV -->
<nav>
  <div class="nav-inner">
    <div class="nav-brand">
      ശ്രീ കല്ലേരി കുട്ടിച്ചാത്തൻ ക്ഷേത്രം
      <span>Sree Kalleri Kuttichathan Kshethram · Vadakara</span>
    </div>
    <ul class="nav-links">
      <li><a href="#">Home</a></li>
      <li>
        <a href="#">The Temple ▾</a>
        <div class="dropdown">
          <a href="http://kallerikuttichathantemple.org/index.php/welcome/aboutUs">About Temple</a>
          <a href="http://kallerikuttichathantemple.org/index.php/welcome/priest">Temple Priest</a>
          <a href="http://kallerikuttichathantemple.org/index.php/welcome/trusteeboard">Trustee Board</a>
          <a href="http://kallerikuttichathantemple.org/index.php/welcome/festivalCommittee">Festival Committee</a>
          <a href="http://kallerikuttichathantemple.org/index.php/welcome/paripalanaSamithi">Paripalana Samithi</a>
        </div>
      </li>
      <li>
        <a href="#">Pooja ▾</a>
        <div class="dropdown">
          <a href="http://kallerikuttichathantemple.org/index.php/welcome/dietys">Deities</a>
          <a href="http://kallerikuttichathantemple.org/index.php/welcome/templeTiming">Temple Timing</a>
        </div>
      </li>
      <li><a href="http://kallerikuttichathantemple.org/index.php/welcome/eventFestival">Events</a></li>
      <li><a href="http://kallerikuttichathantemple.org/index.php/welcome/news">News</a></li>
      <li><a href="http://kallerikuttichathantemple.org/index.php/welcome/gallery">Gallery</a></li>
      <li><a href="http://kallerikuttichathantemple.org/index.php/welcome/contact">Contact</a></li>
    </ul>
    <div class="hamburger" onclick="toggleMobileNav()">
      <span></span><span></span><span></span>
    </div>
  </div>
</nav>

<!-- HERO -->
<section class="hero">
  <div class="hero-slides">
    <div class="hero-slide slide1 active"></div>
    <div class="hero-slide slide2"></div>
    <div class="hero-slide slide3"></div>
    <div class="hero-slide slide4"></div>
    <div class="hero-slide slide5"></div>
  </div>

  <div class="hero-content" style="position:relative;z-index:10;">
    <div class="hero-eyebrow">Vadakara, Kozhikode District · Kerala</div>
    <h1>
      ശ്രീ കല്ലേരി<br>കുട്ടിച്ചാത്തൻ ക്ഷേത്രം
      <em>Sree Kalleri Kuttichathan Kshethram</em>
    </h1>
    <p class="hero-sub">A sacred abode of devotion in Villiyappally, Vadakara</p>
    <div class="hero-actions">
      <a href="http://kallerikuttichathantemple.org/index.php/worldline/booking" class="btn-primary">Book a Pooja Online</a>
      <a href="http://kallerikuttichathantemple.org/index.php/welcome/aboutUs" class="btn-ghost">Know the Temple</a>
    </div>
  </div>

  <div class="hero-dots">
    <button class="dot active" onclick="goSlide(0)"></button>
    <button class="dot" onclick="goSlide(1)"></button>
    <button class="dot" onclick="goSlide(2)"></button>
    <button class="dot" onclick="goSlide(3)"></button>
    <button class="dot" onclick="goSlide(4)"></button>
  </div>
</section>

<!-- INFO STRIP -->
<div class="strip">
  <div class="strip-item">
    <div class="si-icon">🕯️</div>
    <div class="si-label">Morning Darshan</div>
    <div class="si-val">5:30 AM – 12:00 PM</div>
  </div>
  <div class="strip-item">
    <div class="si-icon">🪔</div>
    <div class="si-label">Evening Darshan</div>
    <div class="si-val">5:00 PM – 9:00 PM</div>
  </div>
  <div class="strip-item">
    <div class="si-icon">📞</div>
    <div class="si-label">Temple Office</div>
    <div class="si-val">0496 253 3301</div>
  </div>
  <div class="strip-item">
    <div class="si-icon">🌐</div>
    <div class="si-label">Online Pooja Booking</div>
    <div class="si-val">Available 24 × 7</div>
  </div>
</div>

<!-- ABOUT -->
<section>
  <div class="ornament">
    <div class="ornament-line"></div>
    <div class="ornament-sym">॥ ശ്രീ ഗണേശായ നമഃ ॥</div>
    <div class="ornament-line"></div>
  </div>
  <div class="about reveal">
    <div class="about-img">
      <img src="http://kallerikuttichathantemple.org/uploads/aboutus/temple22.jpg" alt="Kalleri Kuttichathan Temple">
      <div class="about-img-badge">
        കല്ലേരി<br>ക്ഷേത്രം
      </div>
    </div>
    <div class="about-text">
      <div class="section-label">About the Temple</div>
      <h2>A Legacy of <span>Sacred Devotion</span></h2>
      <p class="ml-text">കോഴിക്കോട് ജില്ലയിലെ വടകരയിൽ വില്യാപ്പിള്ളിയി കല്ലേരിയിലാണ് പ്രശസ്തമായ ഈ ക്ഷേത്രം സ്ഥിതി ചെയ്യുന്നത്.</p>
      <p>Sree Kalleri Kuttichathan Kshethram is a revered Hindu temple located in the Kalleri area of Villiyappally, Vadakara, Kozhikode District. The temple is dedicated to Kuttichathan, a powerful deity worshipped widely in northern Kerala. Devotees from across Kerala and beyond visit this sacred shrine seeking blessings, fulfilment of vows, and spiritual solace.</p>
      <div class="about-stats">
        <div class="stat"><div class="stat-num">40+</div><div class="stat-label">Pooja types available</div></div>
        <div class="stat"><div class="stat-num">365</div><div class="stat-label">Days of darshan</div></div>
        <div class="stat"><div class="stat-num">2×</div><div class="stat-label">Daily puja sessions</div></div>
        <div class="stat"><div class="stat-num">24/7</div><div class="stat-label">Online booking</div></div>
      </div>
      <a href="http://kallerikuttichathantemple.org/index.php/welcome/aboutUs" class="btn-primary" style="font-size:.78rem;">Read Full History →</a>
    </div>
  </div>
</section>
<section>
 
  <div class="about reveal">
    <div class="about-img">
      <img src="http://kallerikuttichathantemple.org/uploads/aboutus/auditorium.jpg" alt="Kalleri Kuttichathan Temple">
      <div class="about-img-badge">
       KALLERI AUDITORIUM
      </div>
    </div>
    <div class="about-text">
      <div class="section-label">About the Temple</div>
      <h2>A Legacy of <span>Sacred Devotion</span></h2>
      <p class="ml-text">കോഴിക്കോട് ജില്ലയിലെ വടകരയിൽ വില്യാപ്പിള്ളിയി കല്ലേരിയിലാണ് പ്രശസ്തമായ ഈ ക്ഷേത്രം സ്ഥിതി ചെയ്യുന്നത്.</p>
      <p>Sree Kalleri Kuttichathan Kshethram is a revered Hindu temple located in the Kalleri area of Villiyappally, Vadakara, Kozhikode District. The temple is dedicated to Kuttichathan, a powerful deity worshipped widely in northern Kerala. Devotees from across Kerala and beyond visit this sacred shrine seeking blessings, fulfilment of vows, and spiritual solace.</p>
      
      <a href="http://kallerikuttichathantemple.org/index.php/welcome/aboutUs" class="btn-primary" style="font-size:.78rem;">Read Full History →</a>
    </div>
  </div>
</section>
<!-- TIMING BAND -->
<div class="timing-band">
  <div class="timing-inner">
    <div class="tl">🪔 Darshan Timings</div>
    <div class="timing-slots">
      
      <div class="tslot">
        <div class="ts-label">Evening Opening</div>
        <div class="ts-time">5:00 PM</div>
      </div>
      <div class="tslot">
        <div class="ts-label">Evening Closing</div>
        <div class="ts-time">9:00 PM</div>
      </div>
    </div>
  </div>
</div>

<!-- AVAILABLE POOJAS -->
<section class="poojas-sec">
  <div class="poojas-inner">
    <div class="sec-head reveal">
      <div class="section-label" style="justify-content:center;">Available Offerings</div>
      <h2>Poojas & Offerings</h2>
      <p>Book any of the following poojas and offerings online or at the temple office</p>
    </div>
    <div class="poojas-grid reveal">
      <?php 
                foreach ($pooja_list as $pooja){
                ?> <div class="pooja-item"><div class="pooja-dot"></div>
               <div class="pooja-name"><?php echo $pooja['name'];?><span class="ml"><?php echo $pooja['name_mal'];?></span></div></div>
      <?php }?>
    </div>
    <div class="poojas-cta reveal">
      <a href="http://kallerikuttichathantemple.org/index.php/worldline/booking" class="btn-primary">Book a Pooja Online →</a>
    </div>
  </div>
</section>
<section class="auditorium" id="auditorium">
  <div class="container">
    <div class="auditorium-grid">
      <div class="aud-img reveal">
        <img src="kalleri_auditorium.jpg" alt="Kalleri Auditorium">
      </div>
      <div class="reveal">
        <div class="aud-label">Kalleri Kuttichathan Temple</div>
        <h2 class="aud-title">Kalleri Auditorium</h2>
        <p class="aud-desc">A prestigious project by the Kalleri Kuttichathan Temple Administration Committee, equipped with all modern facilities for Marriages, Receptions, Engagements, Cultural Events, Meetings, and Seminars.</p>
        <div class="aud-features">
          <div class="aud-feat">Modern A/C Hall</div>
          <div class="aud-feat">Marriage Functions</div>
          <div class="aud-feat">Cultural Events</div>
          <div class="aud-feat">Seminars & Meetings</div>
          <div class="aud-feat">Ample Parking</div>
          <div class="aud-feat">Catering Support</div>
        </div>
        <a href="#contact" class="btn-aud">📞 Enquire for Booking</a>
      </div>
    </div>
  </div>
</section>
<!-- EVENTS -->
<section class="events-sec">
  <div class="events-inner">
    <div class="sec-head reveal">
      <div class="section-label" style="justify-content:center;">Upcoming</div>
      <h2>Events & Festivals</h2>
      <p>Sacred celebrations at the temple throughout the year</p>
    </div>
    <?php 
                foreach ($gallery_list as $value){
                ?> <div class="events-grid">
      <div class="event-card reveal">
        <img src="http://kallerikuttichathantemple.org/uploads/events/kuttichathan-kalleri_n1.png" alt="Prathishtadinam" onerror="this.src='http://kallerikuttichathantemple.org/uploads/banner/temple25.jpg'">
        <div class="event-info">
          <span class="event-tag">Annual Festival</span>
          <h3>Prathishtadinam</h3>
          <p style="font-size:.82rem;color:var(--muted);margin-top:.5rem;line-height:1.6;">The sacred Prathishta anniversary of the deity — one of the most important festivals celebrated at the temple with elaborate rituals and special poojas.</p>
        </div>
      </div> 
      <?php } ?>
     
    
</section>

<!-- GALLERY -->
<section class="gallery-sec">
  <div class="gallery-inner">
    <div class="sec-head reveal">
      <div class="section-label" style="justify-content:center;color:var(--saffron);">Visual Journey</div>
      <h2>Temple Gallery</h2>
      <p>Sacred moments captured from the temple</p>
    </div>
    <div class="gallery-grid reveal">
      <?php 
                foreach ($gallery_list as $value){
                ?>
                <ul class="gallery">
    <li><img src="'../../uploads/gallery/<?PHP echo $value['image']; ?>' height="240px" alt=""></li>
    
  </ul>
             <?php } ?> 
    
    <div class="gallery-cta reveal">
      <a href="http://kallerikuttichathantemple.org/index.php/welcome/gallery" class="btn-ghost" style="margin-top:.5rem;display:inline-block;">View Full Gallery →</a>
    </div>
  </div>
</section>

<!-- CONTACT -->
<section class="contact-sec">
  <div class="contact-inner">
    <div class="contact-info reveal">
      <div class="section-label">Find Us</div>
      <h2>Contact & Location</h2>
      <div class="contact-row">
        <div class="c-icon">📍</div>
        <div class="c-data">
          <h4>Temple Address</h4>
          <p>പൊന്മേരി പറമ്പിൽ PO, വില്യപ്പള്ളി<br>Vadakara, Kozhikode District<br>Kerala, India</p>
        </div>
      </div>
      <div class="contact-row">
        <div class="c-icon">📞</div>
        <div class="c-data">
          <h4>Phone</h4>
          <p><a href="tel:04962533301">0496 253 3301</a> &nbsp;/&nbsp; <a href="tel:04962533301">0496 253 3301</a></p>
        </div>
      </div>
      <div class="contact-row">
        <div class="c-icon">✉</div>
        <div class="c-data">
          <h4>Email</h4>
          <p><a href="mailto:kalleritemple@gmail.com">kalleritemple@gmail.com</a></p>
        </div>
      </div>
      <div class="contact-row">
        <div class="c-icon">🕐</div>
        <div class="c-data">
          <h4>Office Hours</h4>
          <p>Every day · 8:00 AM – 8:00 PM</p>
        </div>
      </div>
    </div>
    <div class="reveal">
      <div class="map-placeholder">
        <span>📍 Kalleri, Vadakara, Kerala</span>
      </div>
      <div style="margin-top:1.5rem;">
        <a href="http://kallerikuttichathantemple.org/index.php/worldline/booking" class="btn-primary" style="width:100%;display:block;text-align:center;padding:1rem;">Book a Pooja Online →</a>
      </div>
    </div>
  </div>
</section>

<!-- FOOTER -->
<footer>
  <div class="footer-main">
    <div>
      <div class="footer-brand">ശ്രീ കല്ലേരി കുട്ടിച്ചാത്തൻ ക്ഷേത്രം</div>
      <p class="footer-tagline">A sacred temple of Lord Kuttichathan situated in the peaceful surroundings of Kalleri, Vadakara, Kerala. May the blessings of the deity be with all devotees.</p>
      <p style="font-size:.78rem;color:rgba(255,255,255,.3);">📞 0496 253 3301<br>✉ kalleritemple@gmail.com</p>
    </div>
    <div class="footer-col">
      <h4>Quick Links</h4>
      <ul>
        <li><a href="<?php echo base_url(); ?>index.php/welcome/aboutUs">About Temple</a></li>
        <li><a href="<?php echo base_url(); ?>index.php/welcome/dietys">Deities</a></li>
        <li><a href="<?php echo base_url(); ?>index.php/welcome/templeTiming">Temple Timing</a></li>
        <li><a href="<?php echo base_url(); ?>index.php/welcome/eventFestival">Events & Festivals</a></li>
        <li><a href="<?php echo base_url(); ?>index.php/welcome/news">News</a></li>
        <li><a href="<?php echo base_url(); ?>index.php/welcome/gallery">Gallery</a></li>
      </ul>
    </div>
    <div class="footer-col">
      <h4>Policies</h4>
      <ul>
        <li><a href="<?php echo base_url(); ?>index.php/welcome/termsandconditions">Terms & Conditions</a></li>
        <li><a href="<?php echo base_url(); ?>index.php/welcome/disclaimer">Disclaimer</a></li>
        <li><a href="<?php echo base_url(); ?>index.php/welcome/privacypolicy">Privacy Policy</a></li>
        <li><a href="<?php echo base_url(); ?>index.php/welcome/cancellationpolicy">Cancellation & Refund</a></li>
        <li><a href="<?php echo base_url(); ?>index.php/welcome/contact">Contact Us</a></li>
        <li><a href="<?php echo base_url(); ?>index.php/welcome/announcements">Announcements</a></li>
      </ul>
    </div>
  </div>
  <div class="footer-bottom">
    © 2024 Sree Kalleri Kuttichathan Kshethram · Vadakara, Kerala &nbsp;·&nbsp; All Rights Reserved
  </div>
</footer>

<script>
// Hero slideshow
let cur = 0;
const slides = document.querySelectorAll('.hero-slide');
const dots = document.querySelectorAll('.dot');
function goSlide(n) {
  slides[cur].classList.remove('active');
  dots[cur].classList.remove('active');
  cur = (n + slides.length) % slides.length;
  slides[cur].classList.add('active');
  dots[cur].classList.add('active');
}
setInterval(() => goSlide(cur + 1), 5000);

// Scroll reveal
const observer = new IntersectionObserver((entries) => {
  entries.forEach(e => { if(e.isIntersecting) e.target.classList.add('visible'); });
}, { threshold: 0.12 });
document.querySelectorAll('.reveal').forEach(el => observer.observe(el));

// Mobile nav toggle
function toggleMobileNav() {
  const links = document.querySelector('.nav-links');
  if (links) {
    const shown = links.style.display === 'flex';
    links.style.display = shown ? 'none' : 'flex';
    links.style.flexDirection = 'column';
    links.style.position = 'absolute';
    links.style.top = '100%';
    links.style.left = '0';
    links.style.right = '0';
    links.style.background = '#120800';
    links.style.padding = '1rem';
    links.style.borderBottom = '2px solid #c8922a';
  }
}
</script>
</body>
</html>
