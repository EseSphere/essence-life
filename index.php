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
  <meta property="og:image" content="https://www.essenceapp.com/assets/images/essence-preview.jpg">
  <meta name="twitter:card" content="summary_large_image">
  <meta name="twitter:title" content="Essence – Calm, Meditate & Relax">
  <meta name="twitter:description" content="Relax, sleep better, and focus with Essence. Guided meditations, calming music, and sleep stories.">
  <meta name="twitter:image" content="https://www.essenceapp.com/assets/images/essence-preview.jpg">
  <link rel="icon" href="/assets/favicon.ico" type="image/x-icon">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;700&display=swap" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script>
    $(document).ready(function() {
      setTimeout(function() {
        window.location.href = "./app/";
      }, 3000);
    });
  </script>

  <style>
    body {
      margin: 0;
      font-family: Arial, sans-serif;
      background-color: #dfe4ea;
    }

    #splash-screen {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background-color: #f0f0f0;
      color: rgba(12, 36, 97, 1.0);
      font-weight: 800;
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      z-index: 1000;
      transition: opacity 0.5s ease;
    }

    #main-content {
      padding: 20px;
    }

    @keyframes fadeInUp {
      0% {
        transform: translateY(100%);
        opacity: 0;
      }

      100% {
        transform: translateY(0%);
        opacity: 1;
      }
    }

    #geosoft-logo {
      animation: 1.5s fadeInUp;
    }

    #slide {
      animation: 3s fadeInUp;
    }
  </style>
</head>

<body>
  <div class="container-fluid" id="splash-screen">
    <div id="splash-logo img-logo">
      <img id="geosoft-logo" src="./images/logo/logo-transparent.png" alt="Geosoft Care Logo" style="width: 250px; height: 250px;">
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/gsap@3.12.5/dist/gsap.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
  <script src="./clone_db.js"></script>
  <!--<script src="script.js"></script>-->
</body>

</html>