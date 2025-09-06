<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Essence – Calm, Meditate & Relax</title>
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
    <link rel="stylesheet" href="./css/style2.css">
    <link rel="icon" href="/assets/favicon.ico" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
        <div class="container">
            <a class="navbar-brand" href="index.php">OfflineSite</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link <?php if (basename($_SERVER['PHP_SELF']) == 'index.php') {
                                                                echo 'active';
                                                            } ?>" href="index.php"><i class="bi bi-house"></i> Home</a></li>
                    <li class="nav-item"><a class="nav-link <?php if (basename($_SERVER['PHP_SELF']) == 'about.php') {
                                                                echo 'active';
                                                            } ?>" href="about.php"><i class="bi bi-info-circle"></i> About</a></li>
                    <li class="nav-item"><a class="nav-link <?php if (basename($_SERVER['PHP_SELF']) == 'contact.php') {
                                                                echo 'active';
                                                            } ?>" href="contact.php"><i class="bi bi-envelope"></i> Contact</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- Hero Wrapper -->
    <div class="wrapper" id="hero">
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <!-- Header -->
        <section class="hero" id="questionnaire">
            <div class="app-header mb-3"></div>
            <div class="container-fluid text-center">
                <div class="container mt-4">
                    <h2 class="text-center fw-bold">🎶 Explore Categories</h2>
                    <!-- Search -->
                    <div class="row justify-content-center mt-3">
                        <div class="col-md-6">
                            <input type="text" id="searchBar" class="form-control form-control-lg"
                                placeholder="🔍 Search for a song...">
                        </div>
                    </div>
                    <!-- Music Category -->
                    <div id="categoriesContainer">
                        <div class="category-row">
                            <div class="category-title">Music</div>
                            <div class="slider">
                                <div class="song-item"
                                    data-src="https://www.soundhelix.com/examples/mp3/SoundHelix-Song-1.mp3"
                                    data-title="Acoustic Sunrise"
                                    data-img="https://images.unsplash.com/photo-1507874457470-272b3c8d8ee2?w=400">
                                    <img src="https://images.unsplash.com/photo-1507874457470-272b3c8d8ee2?w=400">
                                    <p>Acoustic Sunrise</p>
                                </div>
                                <div class="song-item"
                                    data-src="https://www.soundhelix.com/examples/mp3/SoundHelix-Song-2.mp3"
                                    data-title="City Nights"
                                    data-img="https://imageio.forbes.com/specials-images/imageserve/66a26836115f811da8d2554e/Dubai-marina-at-night/960x0.jpg?height=474&width=711&fit=bounds">
                                    <img
                                        src="https://imageio.forbes.com/specials-images/imageserve/66a26836115f811da8d2554e/Dubai-marina-at-night/960x0.jpg?height=474&width=711&fit=bounds">
                                    <p>City Nights</p>
                                </div>
                                <div class="song-item"
                                    data-src="https://www.soundhelix.com/examples/mp3/SoundHelix-Song-3.mp3"
                                    data-title="Ocean Waves"
                                    data-img="https://images.unsplash.com/photo-1507525428034-b723cf961d3e?w=400">
                                    <img src="https://images.unsplash.com/photo-1507525428034-b723cf961d3e?w=400">
                                    <p>Ocean Waves</p>
                                </div>
                                <div class="song-item"
                                    data-src="https://www.soundhelix.com/examples/mp3/SoundHelix-Song-4.mp3"
                                    data-title="Mountain Echoes"
                                    data-img="https://images.unsplash.com/photo-1501785888041-af3ef285b470?w=400">
                                    <img src="https://images.unsplash.com/photo-1501785888041-af3ef285b470?w=400">
                                    <p>Mountain Echoes</p>
                                </div>
                                <div class="song-item"
                                    data-src="https://www.soundhelix.com/examples/mp3/SoundHelix-Song-5.mp3"
                                    data-title="Calm Breeze"
                                    data-img="https://images.unsplash.com/photo-1470229722913-7c0e2dbbafd3?w=400">
                                    <img src="https://images.unsplash.com/photo-1470229722913-7c0e2dbbafd3?w=400">
                                    <p>Calm Breeze</p>
                                </div>
                                <div class="song-item"
                                    data-src="https://www.soundhelix.com/examples/mp3/SoundHelix-Song-6.mp3"
                                    data-title="Evening Jazz"
                                    data-img="https://images.unsplash.com/photo-1511671782779-c97d3d27a1d4?w=400">
                                    <img src="https://images.unsplash.com/photo-1511671782779-c97d3d27a1d4?w=400">
                                    <p>Evening Jazz</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <?php include 'footer.php'; ?>