<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Essence – Calm, Meditate & Relax</title>

    <!-- SEO & Social Meta Tags -->
    <meta name="description" content="Essence helps you find peace and relaxation with guided meditations, sleep stories, calming music, and mindfulness exercises.">
    <meta name="keywords" content="Essence app, meditation, mindfulness, sleep stories, calming music, relaxation, stress relief, wellness">
    <meta name="author" content="Essence Team">
    <meta name="robots" content="index, follow">
    <meta property="og:title" content="Essence – Calm, Meditate & Relax">
    <meta property="og:description" content="Discover inner calm with Essence. Guided meditations, soothing music, and sleep stories to improve focus and relaxation.">
    <meta property="og:type" content="website">
    <meta property="og:url" content="https://www.essenceapp.com">
    <meta property="og:image" content="https://www.essenceapp.com/assets/images/essence-preview.jpg">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="Essence – Calm, Meditate & Relax">
    <meta name="twitter:description" content="Relax, sleep better, and focus with Essence. Guided meditations, calming music, and sleep stories.">
    <meta name="twitter:image" content="https://www.essenceapp.com/assets/images/essence-preview.jpg">

    <!-- Favicon -->
    <link rel="icon" href="/assets/favicon.ico" type="image/x-icon">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;700&display=swap" rel="stylesheet">

    <!-- AOS CSS -->
    <link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            scroll-behavior: smooth;
            /* Smooth scroll */
        }

        /* Navbar */
        .navbar {
            background: rgba(0, 0, 0, 0.8);
        }

        .navbar-brand,
        .nav-link {
            color: #fff !important;
            font-weight: 500;
        }

        .navbar-brand:hover,
        .nav-link:hover {
            color: #198754 !important;
        }

        /* Wrapper with gradient background */
        .wrapper {
            position: relative;
            min-height: 100vh;
            background: linear-gradient(-45deg, #0d6efd, #198754, #6c757d, #000000);
            background-size: 400% 400%;
            animation: gradientShift 20s ease infinite;
            overflow: hidden;
        }

        @keyframes gradientShift {
            0% {
                background-position: 0% 50%;
            }

            50% {
                background-position: 100% 50%;
            }

            100% {
                background-position: 0% 50%;
            }
        }

        .particle {
            position: absolute;
            width: 12px;
            height: 12px;
            background: rgba(255, 255, 255, 0.25);
            border-radius: 50%;
            pointer-events: none;
            top: 0;
            left: 0;
            transform: translate(-50%, -50%);
            box-shadow: 0 0 15px rgba(255, 255, 255, 0.3);
        }

        .hero {
            padding: 100px 0;
            text-align: center;
            color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            min-height: 100vh;
            position: relative;
            z-index: 2;
        }

        .hero h1,
        .hero p,
        .hero a {
            opacity: 0;
        }

        .feature-icon {
            font-size: 40px;
            color: #0d6efd;
        }

        .btn-primary {
            background-color: #198754;
            border: none;
        }

        .btn-primary:hover {
            background-color: #146c43;
        }

        .btn-light {
            background-color: #6c757d;
            color: #fff;
            border: none;
        }

        .btn-light:hover {
            background-color: #495057;
        }

        footer {
            background: #000;
            color: #bbb;
            padding: 20px 0;
            text-align: center;
        }

        footer a {
            color: #0d6efd;
            text-decoration: none;
        }

        footer a:hover {
            color: #198754;
        }
    </style>
</head>

<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg fixed-top">
        <div class="container">
            <a class="navbar-brand" href="#">Essence</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon" style="color:#fff;">☰</span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="#hero">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="#features">Features</a></li>
                    <li class="nav-item"><a class="nav-link" href="#cta">Get App</a></li>
                    <li class="nav-item"><a class="nav-link" href="#footer">Contact</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Wrapper with particles -->
    <div class="wrapper" id="hero">
        <!-- Particles -->
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>

        <!-- Hero Section -->
        <section class="hero">
            <div class="container">
                <h1 id="hero-title">Find Your Calm with Essence</h1>
                <p id="hero-text" class="mt-3">Guided meditations, sleep stories, and soothing music to bring peace to your mind and balance to your life.</p>
                <a href="#cta" id="hero-btn" class="btn btn-primary btn-lg mt-3">Download the App</a>
            </div>
        </section>
    </div>

    <!-- Features Section -->
    <section class="py-5" id="features">
        <div class="container text-center">
            <h2 class="mb-4" data-aos="fade-down">Features</h2>
            <div class="row g-4">
                <div class="col-md-4" data-aos="fade-right" data-aos-delay="200">
                    <div class="card p-4 shadow-sm">
                        <div class="feature-icon mb-3">🧘</div>
                        <h5 style="color:#198754;">Guided Meditations</h5>
                        <p>Practice mindfulness with sessions designed to reduce stress and improve focus.</p>
                    </div>
                </div>
                <div class="col-md-4" data-aos="zoom-in" data-aos-delay="400">
                    <div class="card p-4 shadow-sm">
                        <div class="feature-icon mb-3">🎶</div>
                        <h5 style="color:#0d6efd;">Calming Music</h5>
                        <p>Relax with curated soundscapes and music that ease the mind and body.</p>
                    </div>
                </div>
                <div class="col-md-4" data-aos="fade-left" data-aos-delay="600">
                    <div class="card p-4 shadow-sm">
                        <div class="feature-icon mb-3">🌙</div>
                        <h5 style="color:#6c757d;">Sleep Stories</h5>
                        <p>Drift off peacefully with soothing bedtime stories and sleep sounds.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Call to Action -->
    <section class="py-5 text-center bg-light" id="cta">
        <div class="container" data-aos="fade-up">
            <h2>Start Your Journey to Inner Peace</h2>
            <p class="mb-4">Download Essence today and discover tools to live calmer, sleep better, and feel more balanced.</p>
            <a href="#" class="btn btn-primary btn-lg">Get the App</a>
        </div>
    </section>

    <!-- Footer -->
    <footer id="footer">
        <div class="container">
            <p>&copy; 2025 Essence. All Rights Reserved.</p>
            <p>
                <a href="#">Privacy Policy</a> |
                <a href="#">Terms of Service</a>
            </p>
        </div>
    </footer>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/gsap@3.12.5/dist/gsap.min.js"></script>

    <script>
        // Initialize AOS
        AOS.init();

        // Hero animations
        gsap.to("#hero-title", {
            duration: 1,
            opacity: 1,
            y: -20,
            ease: "power2.out"
        });
        gsap.to("#hero-text", {
            duration: 1,
            opacity: 1,
            y: -20,
            delay: 0.5,
            ease: "power2.out"
        });
        gsap.to("#hero-btn", {
            duration: 1,
            opacity: 1,
            y: -10,
            delay: 1,
            ease: "back.out(1.7)"
        });

        // Glowing particles floating from center
        const particles = document.querySelectorAll('.particle');

        function animateParticles() {
            const centerX = window.innerWidth / 2;
            const centerY = window.innerHeight / 2;
            particles.forEach(p => {
                gsap.set(p, {
                    x: centerX,
                    y: centerY,
                    scale: Math.random() * 1 + 0.5,
                    opacity: Math.random() * 0.5 + 0.3
                });
                gsap.to(p, {
                    x: () => centerX + (Math.random() - 0.5) * window.innerWidth * 0.8,
                    y: () => centerY + (Math.random() - 0.5) * window.innerHeight * 0.8,
                    scale: () => Math.random() * 1 + 0.5,
                    opacity: () => Math.random() * 0.5 + 0.3,
                    duration: () => 10 + Math.random() * 15,
                    repeat: -1,
                    yoyo: true,
                    ease: "sine.inOut",
                    delay: Math.random() * 5
                });
            });
        }
        animateParticles();
        window.addEventListener('resize', animateParticles);
    </script>
</body>

</html>