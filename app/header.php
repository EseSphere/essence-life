<?php include 'dbconnections.php'; ?>
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
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
</head>

<body>
  <!-- Navbar -->
  <nav style="background-color: #001F54;" class="navbar navbar-expand-lg fixed-top">
    <div class="container">
      <div class="row w-100">
        <div class="col-md-2 col-2">
          <a class="navbar-brand" href="./index">
            <img src="./images/logo/favicon.png" alt="Essence Life Logo" style="height: 40px;">
          </a>
        </div>
        <div class="col-md-6 col-1"></div>
        <div class="col-md-3 col-8">
          <input type="text" id="searchBar" class="form-control form-control-lg" placeholder="🔍 Search...">
        </div>
        <div class="col-md-1 col-1">
          <i style="color: rgba(189, 195, 199,.8);" class="bi bi-gear fs-2"></i>
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
    <section class="hero mt-5" id="questionnaire">