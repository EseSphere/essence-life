<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Essence – Calm, Meditate & Relax</title>

    <meta name="description"
        content="Essence helps you find peace and relaxation with guided meditations, sleep stories, calming music, and mindfulness exercises.">
    <meta name="keywords"
        content="Essence app, meditation, mindfulness, sleep stories, calming music, relaxation, stress relief, wellness">
    <meta name="author" content="Essence Team">
    <meta name="robots" content="index, follow">
    <meta property="og:title" content="Essence – Calm, Meditate & Relax">
    <meta property="og:description"
        content="Discover inner calm with Essence. Guided meditations, soothing music, and sleep stories to improve focus and relaxation.">
    <meta property="og:type" content="website">
    <meta property="og:url" content="https://www.essenceapp.com">
    <meta property="og:image" content="https://www.essenceapp.com/assets/images/essence-preview.jpg">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="Essence – Calm, Meditate & Relax">
    <meta name="twitter:description"
        content="Relax, sleep better, and focus with Essence. Guided meditations, calming music, and sleep stories.">
    <meta name="twitter:image" content="https://www.essenceapp.com/assets/images/essence-preview.jpg">

    <link rel="icon" href="/assets/favicon.ico" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            scroll-behavior: smooth;
        }

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

        /* Header */
        .app-header {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 15px;
            position: relative;
            color: #fff;
        }

        .app-header img {
            position: absolute;
            left: 20px;
            height: 40px;
        }

        .app-header h1 {
            font-size: 1.5rem;
            font-weight: 600;
            box-shadow: rgba(17, 12, 46, 0.15) 0px 48px 100px 0px;
        }

        /* Questionnaire */
        #questionnaire h2 {
            font-weight: 700;
        }

        #questionnaire .btn-outline-primary {
            border: none;
            border-radius: 15px;
            padding: 15px 20px;
            font-weight: 500;
            font-size: 1rem;
            color: #000;
            background-color: #fff;
            text-align: left;
            display: flex;
            align-items: center;
            gap: 12px;
            width: 100%;
            max-width: 420px;
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.15);
            transition: all 0.3s ease;
        }

        #questionnaire .btn-outline-primary:hover {
            background: linear-gradient(135deg, #198754, #0d6efd);
            color: #fff;
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.3);
        }

        #questionnaire .btn-check:checked+.btn-outline-primary {
            background: linear-gradient(135deg, #198754, #0d6efd);
            color: #fff;
            transform: scale(1.03);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.4);
        }

        #questionnaire .btn-outline-primary i {
            font-size: 1.2rem;
        }

        /* Continue & Skip buttons */
        .action-btn {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            padding: 14px 22px;
            border-radius: 50px;
            font-size: 1rem;
            font-weight: 500;
            border: none;
            transition: all 0.3s ease;
            width: 100%;
            max-width: 420px;
        }

        #submitQuestionnaire {
            background: linear-gradient(135deg, #0d6efd, #198754);
            color: #fff;
            box-shadow: 0 6px 18px rgba(0, 0, 0, 0.3);
        }

        #submitQuestionnaire:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 22px rgba(0, 0, 0, 0.4);
        }

        #skipQuestionnaire {
            background: #f1f2f6;
            color: #2f3542;
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1);
        }

        #skipQuestionnaire:hover {
            background: #dfe4ea;
            transform: translateY(-3px);
        }

        /* Bottom Navbar */
        .navbar-bottom {
            background: rgba(0, 0, 0, 0.9);
            position: fixed;
            bottom: 0;
            left: 0;
            width: 100%;
            z-index: 1000;
        }

        .navbar-bottom .nav-link {
            color: #fff !important;
            font-size: 0.9rem;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 2px;
        }

        .navbar-bottom .nav-link i {
            font-size: 1.2rem;
        }

        .navbar-bottom .nav-link:hover {
            color: #198754 !important;
        }

        footer {
            background: #000;
            color: #bbb;
            padding: 50px 0 80px;
            text-align: center;
        }

        footer a {
            color: #0d6efd;
            text-decoration: none;
        }

        footer a:hover {
            color: #198754;
        }

        .category-row {
            margin-top: 40px;
        }

        .category-title {
            font-size: 1.5rem;
            margin-bottom: 15px;
            font-weight: bold;
        }

        .slider {
            display: flex;
            overflow-x: auto;
            gap: 20px;
            padding-bottom: 10px;
            scroll-snap-type: x mandatory;
            -webkit-overflow-scrolling: touch;
        }

        .slider::-webkit-scrollbar {
            display: none;
        }

        .song-item {
            flex: 0 0 auto;
            width: 180px;
            scroll-snap-align: start;
            background: #1e1e1e;
            border-radius: 12px;
            padding: 10px;
            text-align: center;
            cursor: pointer;
            transition: 0.2s;
        }

        .song-item:hover {
            transform: scale(1.05);
        }

        .song-item img {
            width: 100%;
            height: 160px;
            object-fit: cover;
            border-radius: 10px;
        }

        #searchBar {
            background: #1e1e1e;
            border: none;
            color: #fff;
        }

        #searchBar:focus {
            box-shadow: none;
            border: 1px solid #0d6efd;
        }

        /* Mobile Responsive */
        @media(max-width:768px) {
            .song-item {
                width: 70%;
            }
        }
    </style>
</head>

<body>
    <!-- Hero Wrapper -->
    <div class="wrapper" id="hero">
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>

        <!-- Questionnaire -->
        <section class="hero" id="questionnaire">
            <div style="box-shadow: rgba(17, 12, 46, 0.15) 0px 48px 100px 0px;" class="app-header mb-3">
                <img src="https://cdn-icons-png.flaticon.com/512/891/891419.png" alt="Essence Logo">
                <h1>Essence</h1>
            </div>

            <div class="container-fluid text-center">
                <!--Other contents here-->


            </div>
        </section>
    </div>

    <!-- Bottom Navbar -->
    <nav class="navbar navbar-expand-lg navbar-bottom">
        <div class="container justify-content-around">
            <a class="nav-link" href="#hero"><i class="bi bi-house-door"></i> Home</a>
            <a class="nav-link" href="#questionnaire"><i class="bi bi-bullseye"></i> Goals</a>
            <a class="nav-link" href="#features"><i class="bi bi-stars"></i> Features</a>
            <a class="nav-link" href="#cta"><i class="bi bi-download"></i> Get App</a>
            <a class="nav-link" href="#footer"><i class="bi bi-envelope"></i> Contact</a>
        </div>
    </nav>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/gsap@3.12.5/dist/gsap.min.js"></script>

    <script>
        AOS.init();

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

        document.getElementById('submitQuestionnaire').addEventListener('click', () => {
            const selected = [];
            document.querySelectorAll('#questionnaire input[type=checkbox]').forEach(cb => {
                if (cb.checked) selected.push(cb.nextElementSibling.textContent);
            });

            const sleepFrequency = document.querySelector('input[name="sleepFrequency"]:checked');
            if (sleepFrequency) selected.push('Sleep Frequency: ' + sleepFrequency.nextElementSibling.textContent);

            const display = selected.length > 0 ? 'You selected: ' + selected.join(', ') : 'No selection made';
            document.getElementById('selectedAnswers').textContent = display;
        });

        document.getElementById('skipQuestionnaire').addEventListener('click', () => {
            document.getElementById('selectedAnswers').textContent = 'Skipped';
            document.querySelectorAll('#questionnaire input[type=checkbox]').forEach(cb => cb.checked = false);
            document.querySelectorAll('#questionnaire input[type=radio]').forEach(rb => rb.checked = false);
        });
    </script>
</body>

</html>