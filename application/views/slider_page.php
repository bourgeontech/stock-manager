<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Image and Video Slider Gallery">
    <title>Media Gallery | Slider</title>
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600;700;900&display=swap" rel="stylesheet">
    <!-- SwiperJS CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <style>
        :root {
            --accent: #c9a227;
            --accent-dark: #a07b10;
            --bg-dark: #0a0a0f;
            --bg-card: #13131e;
            --text-light: #f0ede6;
            --text-muted: #9a8f7a;
            --glass: rgba(255,255,255,0.06);
            --glass-border: rgba(255,255,255,0.12);
        }

        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: 'Outfit', sans-serif;
            background: var(--bg-dark);
            color: var(--text-light);
            min-height: 100vh;
            overflow-x: hidden;
        }

        /* ─── Ambient background ─── */
        body::before {
            content: '';
            position: fixed;
            top: -30%;
            left: -20%;
            width: 70%;
            height: 70%;
            background: radial-gradient(ellipse, rgba(201,162,39,0.12) 0%, transparent 70%);
            pointer-events: none;
            z-index: 0;
        }
        body::after {
            content: '';
            position: fixed;
            bottom: -20%;
            right: -20%;
            width: 60%;
            height: 60%;
            background: radial-gradient(ellipse, rgba(120,60,200,0.08) 0%, transparent 70%);
            pointer-events: none;
            z-index: 0;
        }

        /* ─── Header ─── */
        .site-header {
            position: fixed;
            top: 0; left: 0; right: 0;
            z-index: 100;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 18px 40px;
            background: rgba(10,10,15,0.85);
            backdrop-filter: blur(20px);
            border-bottom: 1px solid var(--glass-border);
        }
        .site-header .logo {
            font-size: 1.4rem;
            font-weight: 700;
            color: var(--accent);
            text-decoration: none;
            letter-spacing: 1px;
        }
        .site-header .back-btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 8px 20px;
            border: 1px solid var(--accent);
            border-radius: 50px;
            color: var(--accent);
            text-decoration: none;
            font-size: 0.85rem;
            font-weight: 600;
            transition: all 0.3s ease;
        }
        .site-header .back-btn:hover {
            background: var(--accent);
            color: var(--bg-dark);
        }

        /* ─── Hero Section ─── */
        .hero {
            position: relative;
            z-index: 1;
            padding: 130px 40px 50px;
            text-align: center;
        }
        .hero-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: var(--glass);
            border: 1px solid var(--glass-border);
            border-radius: 50px;
            padding: 6px 18px;
            font-size: 0.78rem;
            font-weight: 600;
            letter-spacing: 1.5px;
            text-transform: uppercase;
            color: var(--accent);
            margin-bottom: 24px;
        }
        .hero h1 {
            font-size: clamp(2.5rem, 6vw, 4.5rem);
            font-weight: 900;
            line-height: 1.1;
            background: linear-gradient(135deg, #fff 0%, var(--accent) 60%, #fff9e0 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-bottom: 16px;
        }
        .hero p {
            font-size: 1.05rem;
            color: var(--text-muted);
            max-width: 520px;
            margin: 0 auto 40px;
            line-height: 1.7;
        }
        .hero-stats {
            display: flex;
            justify-content: center;
            gap: 48px;
            flex-wrap: wrap;
        }
        .stat-item { text-align: center; }
        .stat-item .stat-num {
            font-size: 2rem;
            font-weight: 800;
            color: var(--accent);
            display: block;
        }
        .stat-item .stat-label {
            font-size: 0.8rem;
            color: var(--text-muted);
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        /* ─── Divider ─── */
        .divider {
            position: relative;
            z-index: 1;
            display: flex;
            align-items: center;
            gap: 20px;
            padding: 0 40px;
            margin-bottom: 40px;
        }
        .divider::before, .divider::after {
            content: '';
            flex: 1;
            height: 1px;
            background: linear-gradient(to right, transparent, var(--glass-border));
        }
        .divider::after {
            background: linear-gradient(to left, transparent, var(--glass-border));
        }
        .divider span {
            font-size: 0.75rem;
            color: var(--text-muted);
            text-transform: uppercase;
            letter-spacing: 2px;
        }

        /* ─── Main Swiper ─── */
        .slider-section {
            position: relative;
            z-index: 1;
            padding: 0 0 60px;
        }

        .swiper-main {
            width: 100%;
            height: clamp(380px, 60vh, 680px);
        }

        .swiper-slide-main {
            position: relative;
            overflow: hidden;
            border-radius: 0;
        }

        /* Image slide */
        .slide-image-wrap {
            width: 100%;
            height: 100%;
            position: relative;
        }
        .slide-image-wrap img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
            transition: transform 8s ease;
        }
        .swiper-slide-active .slide-image-wrap img {
            transform: scale(1.04);
        }
        .slide-overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(to top, rgba(0,0,0,0.75) 0%, rgba(0,0,0,0.1) 50%, transparent 100%);
        }
        .slide-caption {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            padding: 40px 60px;
            z-index: 2;
            transform: translateY(20px);
            opacity: 0;
            transition: all 0.7s cubic-bezier(0.23, 1, 0.32, 1) 0.2s;
        }
        .swiper-slide-active .slide-caption {
            transform: translateY(0);
            opacity: 1;
        }
        .slide-caption h2 {
            font-size: clamp(1.5rem, 3vw, 2.8rem);
            font-weight: 800;
            color: #fff;
            text-shadow: 0 2px 20px rgba(0,0,0,0.5);
            margin-bottom: 10px;
        }
        .slide-caption p {
            font-size: clamp(0.85rem, 1.5vw, 1.05rem);
            color: rgba(255,255,255,0.8);
            max-width: 520px;
        }
        .slide-type-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: var(--accent);
            color: var(--bg-dark);
            border-radius: 50px;
            padding: 4px 12px;
            font-size: 0.75rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 12px;
        }

        /* Video slide */
        .slide-video-wrap {
            width: 100%;
            height: 100%;
            position: relative;
            background: #000;
        }
        .slide-video-iframe {
            width: 100%;
            height: 100%;
            border: none;
        }
        .slide-video-direct {
            width: 100%;
            height: 100%;
            object-fit: contain;
            background: #000;
        }

        /* Swiper Controls */
        .swiper-button-next,
        .swiper-button-prev {
            color: #fff !important;
            background: rgba(255,255,255,0.1);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255,255,255,0.2);
            width: 52px !important;
            height: 52px !important;
            border-radius: 50%;
            transition: all 0.3s ease;
        }
        .swiper-button-next:hover,
        .swiper-button-prev:hover {
            background: var(--accent);
            border-color: var(--accent);
        }
        .swiper-button-next::after,
        .swiper-button-prev::after {
            font-size: 16px !important;
            font-weight: 800;
        }
        .swiper-pagination-bullet {
            background: rgba(255,255,255,0.4) !important;
            opacity: 1 !important;
            width: 8px !important;
            height: 8px !important;
            transition: all 0.3s ease !important;
        }
        .swiper-pagination-bullet-active {
            background: var(--accent) !important;
            width: 28px !important;
            border-radius: 4px !important;
        }

        /* ─── Thumbnail Swiper ─── */
        .thumbs-section {
            position: relative;
            z-index: 1;
            padding: 0 40px 80px;
        }
        .thumbs-title {
            font-size: 0.75rem;
            font-weight: 600;
            letter-spacing: 2px;
            text-transform: uppercase;
            color: var(--text-muted);
            margin-bottom: 16px;
            text-align: center;
        }
        .swiper-thumbs {
            width: 100%;
        }
        .swiper-slide-thumb {
            width: 140px !important;
            height: 90px !important;
            border-radius: 10px;
            overflow: hidden;
            cursor: pointer;
            border: 2px solid transparent;
            opacity: 0.5;
            transition: all 0.3s ease;
        }
        .swiper-slide-thumb img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
        }
        .swiper-slide-thumb .thumb-video-placeholder {
            width: 100%;
            height: 100%;
            background: var(--bg-card);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            gap: 6px;
            color: var(--text-muted);
            font-size: 0.72rem;
            font-weight: 600;
            letter-spacing: 0.5px;
        }
        .swiper-slide-thumb .thumb-video-placeholder i {
            font-size: 1.5rem;
            color: var(--accent);
        }
        .swiper-slide-thumb-active {
            border-color: var(--accent) !important;
            opacity: 1 !important;
        }

        /* ─── Empty state ─── */
        .empty-state {
            position: relative;
            z-index: 1;
            text-align: center;
            padding: 100px 20px;
        }
        .empty-state i {
            font-size: 4rem;
            color: var(--text-muted);
            margin-bottom: 20px;
            display: block;
        }
        .empty-state h2 {
            font-size: 1.5rem;
            color: var(--text-muted);
            margin-bottom: 10px;
        }
        .empty-state p { color: var(--text-muted); font-size: 0.9rem; }

        /* ─── Footer strip ─── */
        .page-footer {
            position: relative;
            z-index: 1;
            text-align: center;
            padding: 30px 20px;
            border-top: 1px solid var(--glass-border);
            color: var(--text-muted);
            font-size: 0.8rem;
        }
        .page-footer a { color: var(--accent); text-decoration: none; }

        @media (max-width: 768px) {
            .site-header { padding: 14px 20px; }
            .hero { padding: 110px 20px 40px; }
            .slide-caption { padding: 24px 24px; }
            .thumbs-section { padding: 0 20px 60px; }
            .swiper-slide-thumb { width: 100px !important; height: 70px !important; }
        }
    </style>
</head>
<body>

<!-- Header -->
<header class="site-header">
    <a href="<?php echo base_url(); ?>" class="logo">
        <i class="fas fa-om" style="margin-right:8px;"></i>
        <?php if(!empty($contact) && isset($contact[0])): ?>
            <?php echo htmlspecialchars($contact[0]['temp_name'] ?? 'Temple'); ?>
        <?php else: ?>
            Media Gallery
        <?php endif; ?>
    </a>
    <a href="<?php echo base_url(); ?>" class="back-btn">
        <i class="fas fa-arrow-left"></i> Back to Home
    </a>
</header>

<!-- Hero -->

    

    <?php if(!empty($slider)): 
        $imgCount = 0; $vidCount = 0;
        foreach($slider as $s) { 
            ($s['type'] ?? 'image') === 'video' ? $vidCount++ : $imgCount++;
        }
    ?>
    <div class="hero-stats">
        <div class="stat-item">
            <span class="stat-num"><?php echo count($slider); ?></span>
            <span class="stat-label">Total Items</span>
        </div>
        <div class="stat-item">
            <span class="stat-num"><?php echo $imgCount; ?></span>
            <span class="stat-label">Images</span>
        </div>
        <div class="stat-item">
            <span class="stat-num"><?php echo $vidCount; ?></span>
            <span class="stat-label">Videos</span>
        </div>
    </div>
    <?php endif; ?>
</section>

<?php if(!empty($slider)): ?>

<!-- Main Slider -->
<section class="slider-section">
    <div class="swiper swiper-main">
        <div class="swiper-wrapper">
            <?php foreach($slider as $item):
                $type = $item['type'] ?? 'image';
                $title = htmlspecialchars($item['title'] ?? '');
                $desc = htmlspecialchars($item['description'] ?? '');
                $videoUrl = $item['video_url'] ?? '';
                $image = $item['image'] ?? '';

                // Convert YouTube watch URL to embed URL
                $embedUrl = '';
                if($type === 'video' && !empty($videoUrl)) {
                    if(preg_match('/(?:youtube\.com\/watch\?v=|youtu\.be\/)([a-zA-Z0-9_-]+)/', $videoUrl, $matches)) {
                        $embedUrl = 'https://www.youtube.com/embed/'.$matches[1].'?autoplay=0&rel=0';
                    } elseif(preg_match('/vimeo\.com\/(\d+)/', $videoUrl, $matches)) {
                        $embedUrl = 'https://player.vimeo.com/video/'.$matches[1];
                    } else {
                        $embedUrl = $videoUrl; // direct video
                    }
                }
            ?>
            <div class="swiper-slide swiper-slide-main">
                <?php if($type === 'video'): ?>
                    <div class="slide-video-wrap">
                        <?php if(strpos($embedUrl, 'youtube.com/embed') !== false || strpos($embedUrl, 'vimeo.com') !== false): ?>
                            <iframe class="slide-video-iframe"
                                src="<?php echo $embedUrl; ?>"
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                allowfullscreen
                                loading="lazy"
                                title="<?php echo $title; ?>">
                            </iframe>
                        <?php else: ?>
                            <video class="slide-video-direct" controls preload="metadata">
                                <source src="<?php echo $embedUrl; ?>" type="video/mp4">
                                <source src="<?php echo $embedUrl; ?>" type="video/webm">
                                Your browser does not support video playback.
                            </video>
                        <?php endif; ?>
                        <div class="slide-caption">
                            <div class="slide-type-badge"><i class="fas fa-play"></i> Video</div>
                            <?php if($title): ?><h2><?php echo $title; ?></h2><?php endif; ?>
                            <?php if($desc): ?><p><?php echo $desc; ?></p><?php endif; ?>
                        </div>
                    </div>
                <?php else: ?>
                    <div class="slide-image-wrap">
                        <img src="<?php echo base_url(); ?>uploads/slider/<?php echo htmlspecialchars($image); ?>"
                             alt="<?php echo $title; ?>"
                             loading="lazy">
                        <div class="slide-overlay"></div>
                        <div class="slide-caption">
                            <div class="slide-type-badge"><i class="fas fa-image"></i> Image</div>
                            <?php if($title): ?><h2><?php echo $title; ?></h2><?php endif; ?>
                            <?php if($desc): ?><p><?php echo $desc; ?></p><?php endif; ?>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
            <?php endforeach; ?>
        </div>
        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>
        <div class="swiper-pagination"></div>
    </div>
</section>

<!-- Divider -->


<!-- Thumbnail Grid Swiper -->
<section class="thumbs-section">
   
    <div class="swiper swiper-thumbs">
        <div class="swiper-wrapper">
            <?php foreach($slider as $item):
                $type = $item['type'] ?? 'image';
                $image = $item['image'] ?? '';
                $title = htmlspecialchars($item['title'] ?? '');
            ?>
            <div class="swiper-slide swiper-slide-thumb">
                <?php if($type === 'video'): ?>
                    <div class="thumb-video-placeholder">
                        <i class="fas fa-play-circle"></i>
                        
                    </div>
                <?php else: ?>
                    <img src="<?php echo base_url(); ?>uploads/slider/<?php echo htmlspecialchars($image); ?>"
                         alt="<?php echo $title; ?>"
                         loading="lazy">
                <?php endif; ?>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<?php else: ?>
<!-- Empty State -->

<?php endif; ?>


<!-- SwiperJS -->
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script>
    // Thumbnail swiper (controller)
    const thumbSwiper = new Swiper('.swiper-thumbs', {
        spaceBetween: 12,
        slidesPerView: 'auto',
        freeMode: true,
        watchSlidesProgress: true,
        centeredSlides: false,
    });

    // Main swiper
    const mainSwiper = new Swiper('.swiper-main', {
        loop: <?php echo (count($slider ?? []) > 1) ? 'true' : 'false'; ?>,
        speed: 800,
        autoplay: {
            delay: 1000,
            disableOnInteraction: false,
            pauseOnMouseEnter: true,
        },
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
        },
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
        thumbs: {
            swiper: thumbSwiper,
        },
        keyboard: {
            enabled: true,
        },
        a11y: {
            prevSlideMessage: 'Previous slide',
            nextSlideMessage: 'Next slide',
        },
    });
</script>
</body>
</html>
