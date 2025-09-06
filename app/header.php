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
  <nav style="background-color: #001F54;" class="navbar navbar-expand-lg fixed-top">
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
    <section class="hero mt-5" id="questionnaire">
      <div class="app-header mb-3"></div>