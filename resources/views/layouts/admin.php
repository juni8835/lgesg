<!DOCTYPE html>
<html lang="ko">
<head>
    <!-- 필수 메타 태그 -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    
    <!-- 기본 SEO 정보 -->
    <meta name="description" content="NineOneLabs는 최고의 서비스를 제공합니다. 고객의 성공을 돕고 삶을 풍요롭게 만드는 솔루션을 경험하세요.">
    <meta name="keywords" content="SEO, 최적화, 웹사이트, 사용자 경험, 성능 개선, 글로벌 서비스">
    <meta name="author" content="NineOneLabs">
    <meta name="robots" content="index, follow">
    <meta name="revisit-after" content="7 days"> <!-- 검색엔진 색인 주기 -->

    <!-- Canonical URL -->
    <link rel="canonical" href="https://example.com/home">

    <!-- Open Graph (OG) 태그: 소셜 미디어 공유 최적화 -->
    <meta property="og:locale" content="ko_KR">
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="NineOneLabs">
    <meta property="og:url" content="https://example.com/home">
    <meta property="og:title" content="Home - 최고의 SEO 최적화 사이트">
    <meta property="og:description" content="NineOneLabs는 최고의 서비스를 제공합니다. 고객의 성공을 돕고 삶을 풍요롭게 만드는 솔루션을 경험하세요.">
    <meta property="og:image" content="https://example.com/images/meta/og-image.png">

    <!-- Twitter Card 태그: 트위터 공유 최적화 -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:site" content="@NineOneLabs">
    <meta name="twitter:title" content="Home - 최고의 SEO 최적화 사이트">
    <meta name="twitter:description" content="NineOneLabs는 최고의 서비스를 제공합니다. 고객의 성공을 돕고 삶을 풍요롭게 만드는 솔루션을 경험하세요.">
    <meta name="twitter:image" content="https://example.com/images/meta/twitter-image.png">

    <!-- 지역 기반 최적화 -->
    <meta name="geo.region" content="KR"> <!-- 국가 코드 -->
    <meta name="geo.placename" content="Seoul"> <!-- 도시 이름 -->
    <meta name="geo.position" content="37.5665;126.9780"> <!-- 위도와 경도 -->
    <meta name="ICBM" content="37.5665,126.9780"> <!-- 위도와 경도 -->

    <!-- 국제화: hreflang 태그 -->
    <link rel="alternate" href="https://example.com/home" hreflang="en">
    <link rel="alternate" href="https://example.com/kr/home" hreflang="ko">

    <!-- 구조화 데이터 (JSON-LD): 검색 엔진에 추가 정보 제공 -->
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "WebSite",
        "url": "https://example.com/",
        "potentialAction": {
            "@type": "SearchAction",
            "target": "https://example.com/search?q={search_term_string}",
            "query-input": "required name=search_term_string"
        }
    }
    </script>

    <!-- 파비콘 및 애플 아이콘 -->
    <link rel="icon" type="image/png" sizes="32x32" href="https://example.com/images/meta/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="https://example.com/images/meta/favicon-16x16.png">
    <link rel="apple-touch-icon" sizes="180x180" href="https://example.com/images/meta/apple-touch-icon.png">
    <link rel="manifest" href="https://example.com/site.webmanifest">

    <!-- 검색 엔진 인증 -->
    <meta name="msvalidate.01" content="your-bing-verification-code"> <!-- Bing 인증 -->
    <meta name="google-site-verification" content="your-google-verification-code"> <!-- Google 인증 -->

    <!-- CSS -->
    <link rel="stylesheet" href="https://kit.fontawesome.com/feea649d0a.css" crossorigin="anonymous">
    <link rel="stylesheet" href="<?= vendor_url('swiper/swiper.min.css') ?>" />
    <link rel="stylesheet" href="<?= vendor_url('aos/aos.css') ?>" />
    <link rel="stylesheet" href="<?= css_url('style.css?v='.time()) ?>" />
    
    <!-- Script -->
    <script crossorigin src="https://unpkg.com/react@18/umd/react.development.js"></script>
    <script crossorigin src="https://unpkg.com/react-dom@18/umd/react-dom.development.js"></script>
    <script src="https://unpkg.com/@babel/standalone/babel.min.js"></script>

    <script src="<?= vendor_url('fontAwesome/fontAwesome.min.js') ?>" crossorigin="anonymous"></script>
    <script src="<?= vendor_url('jquery/jquery.min.js') ?>"></script>
    <script src="<?= vendor_url('lenis/lenis.js') ?>"></script>
    <script src="<?= vendor_url('lordIcon/lordIcon.min.js') ?>"></script>
    <script src="<?= vendor_url('swiper/swiper.min.js') ?>"></script>
    <script src="<?= vendor_url('aos/aos.js') ?>"></script>

    <script src="<?= vendor_url('splitType/splitType.min.js') ?>"></script>
    <script src="<?= vendor_url('gsap/gsap.min.js') ?>"></script>
    <script src="<?= vendor_url('gsap/scrollTrigger.min.js') ?>"></script>
    <script src="<?= js_url('app.js?v='.time()) ?>"></script>

</head>
<body>
    <?= $this->renderOnlyView('includes/header.php') ?>
    
    <main>{{content}}</main>
    
    <?= $this->renderOnlyView('includes/footer.php') ?>
</body>
</html>