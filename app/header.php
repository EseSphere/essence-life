<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
  <title>Essence – Life, Meditate & Relax</title>
  <meta name="description" content="Essence helps you find peace and relaxation with guided meditations, sleep stories, calming music, and mindfulness exercises.">
  <meta name="keywords" content="Essence app, meditation, mindfulness, sleep stories, calming music, relaxation, stress relief, wellness">
  <meta name="author" content="Essence Team">
  <meta name="robots" content="index, follow">
  <meta property="og:title" content="Essence – Calm, Meditate & Relax">
  <meta property="og:description" content="Discover inner calm with Essence. Guided meditations, soothing music, and sleep stories to improve focus and relaxation.">
  <meta property="og:type" content="website">
  <meta property="og:url" content="https://www.essenceapp.com">
  <meta property="og:image" content="./images/logo/favicon.png">
  <meta name="twitter:card" content="summary_large_image">
  <meta name="twitter:title" content="Essence – Calm, Meditate & Relax">
  <meta name="twitter:description" content="Relax, sleep better, and focus with Essence. Guided meditations, calming music, and sleep stories.">
  <meta name="twitter:image" content="./images/logo/favicon.png">
  <link rel="stylesheet" href="./css/style2.css">
  <link rel="icon" href="./images/logo/favicon.png" type="image/x-icon">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;700&display=swap" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
</head>

<body>
  <!-- Navbar -->
  <nav style="background-color: #001F54;" class="navbar navbar-expand-lg fixed-top">
    <div class="container">
      <div class="row">
        <div class="col-2 col-md-2">
          <a class="navbar-brand" href="./index">
            <img src="./images/logo/favicon.png" alt="Essence Life Logo" style="height: 40px;">
          </a>
        </div>
        <div class="col-8 col-md-8">
          <input type="text" id="searchBar" class="form-control form-control-lg" placeholder="🔍 Search for a song...">
        </div>
        <div class="col-2 col-md-2">
          <button class="navbar-toggler text-white bg-light" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon text-white"></span>
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
      <div class="app-header"></div>
      <div class="container text-center alert alert-success">
        <h4 class="display-4 font-weight-bold">Essence – Life, <br><small>Meditate & Relax</small></h4>
        <p class="lead">Discover inner peace with guided meditations, calming music, and sleep stories.</p>
      </div>