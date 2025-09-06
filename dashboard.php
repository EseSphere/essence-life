<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Essence – Calm, Meditate & Relax</title>
    <link rel="stylesheet" href="./css/style2.css">
    <link rel="icon" href="/assets/favicon.ico" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
</head>

<body>
    <!-- Hero Wrapper -->
    <div class="wrapper" id="hero">
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>

        <!-- Header -->
        <section class="hero" id="questionnaire">
            <div style="box-shadow: rgba(17, 12, 46, 0.15) 0px 48px 100px 0px;" class="app-header mb-3">
                <img src="https://cdn-icons-png.flaticon.com/512/891/891419.png" alt="Essence Logo">
                <h1>Essence</h1>
            </div>

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

    <!-- Modal Player -->
    <div id="playerModal"
        style="position:fixed;top:0;left:0;width:100%;height:100%;background:rgba(0,0,0,0.9);display:none;justify-content:center;align-items:center;z-index:1000;padding:10px;">
        <div
            style="background:#1e1e1e;padding:15px;border-radius:12px;text-align:center;max-width:400px;width:100%;height:auto;display:flex;flex-direction:column;justify-content:center;">
            <h2 id="modalTitle" style="color:white;font-size:1.3rem;margin-bottom:10px;"></h2>
            <img id="modalImg" src=""
                style="width:100%;height:auto;max-height:300px;object-fit:cover;border-radius:12px;margin-bottom:10px;">
            <audio id="modalAudio" controls autoplay style="width:100%;margin-bottom:10px;"></audio>
            <div style="display:flex;justify-content:space-between;gap:10px;flex-wrap:wrap;">
                <button id="prevSong" class="btn btn-primary flex-fill">⏮ Previous</button>
                <button id="closeModal" class="btn btn-danger flex-fill">Close</button>
                <button id="nextSong" class="btn btn-primary flex-fill">Next ⏭</button>
            </div>
        </div>
    </div>

    <!-- Persistent Mini Player -->
    <div id="miniPlayer"
        style="position:fixed;bottom:0;left:0;width:100%;background:#1e1e1e;display:flex;align-items:center;justify-content:space-between;padding:5px 10px;z-index:999;display:none;">
        <div style="display:flex;align-items:center;">
            <img id="miniCover" src="" style="width:50px;height:50px;border-radius:8px;object-fit:cover;">
            <p id="miniTitle" style="margin-left:10px;color:white;"></p>
        </div>
        <div>
            <button id="miniPrev" class="btn btn-primary">⏮️</button>
            <button id="miniPlayPause" class="btn btn-success">▶️</button>
            <button id="miniNext" class="btn btn-primary">⏭️</button>
        </div>
    </div>
    <audio id="audioPlayer" style="display:none;"></audio>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/gsap@3.12.5/dist/gsap.min.js"></script>

    <script>
        AOS.init();

        // Particle Animation
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

        // Player Logic
        const songItems = Array.from(document.querySelectorAll('.song-item'));
        const playerModal = document.getElementById('playerModal');
        const modalTitle = document.getElementById('modalTitle');
        const modalImg = document.getElementById('modalImg');
        const closeModal = document.getElementById('closeModal');
        const prevSongBtn = document.getElementById('prevSong');
        const nextSongBtn = document.getElementById('nextSong');

        const miniPlayer = document.getElementById('miniPlayer');
        const miniCover = document.getElementById('miniCover');
        const miniTitle = document.getElementById('miniTitle');
        const miniPlayPause = document.getElementById('miniPlayPause');
        const miniNext = document.getElementById('miniNext');
        const miniPrev = document.getElementById('miniPrev');
        const audioPlayer = document.getElementById('audioPlayer');

        let currentIndex = 0;

        function updateMiniPlayer() {
            miniCover.src = songItems[currentIndex].getAttribute('data-img');
            miniTitle.textContent = songItems[currentIndex].getAttribute('data-title');
        }

        function playSong(index) {
            currentIndex = index;
            const song = songItems[index];
            const src = song.getAttribute('data-src');

            // Update modal
            modalTitle.textContent = song.getAttribute('data-title');
            modalImg.src = song.getAttribute('data-img');

            // Update mini player
            audioPlayer.src = src;
            audioPlayer.play();
            miniPlayer.style.display = 'flex';
            updateMiniPlayer();
            playerModal.style.display = 'flex';
        }

        songItems.forEach((item, index) => {
            item.addEventListener('click', () => playSong(index));
        });

        // Modal close hides only
        closeModal.addEventListener('click', () => playerModal.style.display = 'none');

        // Modal next/prev
        nextSongBtn.addEventListener('click', () => playSong((currentIndex + 1) % songItems.length));
        prevSongBtn.addEventListener('click', () => playSong((currentIndex - 1 + songItems.length) % songItems.length));

        // Mini Player controls
        miniNext.addEventListener('click', () => playSong((currentIndex + 1) % songItems.length));
        miniPrev.addEventListener('click', () => playSong((currentIndex - 1 + songItems.length) % songItems.length));
        miniPlayPause.addEventListener('click', () => {
            if (audioPlayer.paused) {
                audioPlayer.play();
                miniPlayPause.textContent = '⏸️';
            } else {
                audioPlayer.pause();
                miniPlayPause.textContent = '▶️';
            }
        });

        // Keyboard Controls
        document.addEventListener('keydown', (e) => {
            if (playerModal.style.display === 'flex') {
                switch (e.code) {
                    case 'ArrowRight':
                        playSong((currentIndex + 1) % songItems.length);
                        break;
                    case 'ArrowLeft':
                        playSong((currentIndex - 1 + songItems.length) % songItems.length);
                        break;
                    case 'Space':
                        e.preventDefault();
                        if (audioPlayer.paused) audioPlayer.play();
                        else audioPlayer.pause();
                        break;
                }
            }
        });

        // Swipe gestures
        let touchStartX = 0,
            touchEndX = 0;
        const modalContent = playerModal.querySelector('div');
        modalContent.addEventListener('touchstart', e => touchStartX = e.changedTouches[0].screenX);
        modalContent.addEventListener('touchend', e => {
            touchEndX = e.changedTouches[0].screenX;
            const swipeDistance = touchEndX - touchStartX;
            if (Math.abs(swipeDistance) > 50) {
                if (swipeDistance < 0) playSong((currentIndex + 1) % songItems.length);
                else playSong((currentIndex - 1 + songItems.length) % songItems.length);
            }
        });
    </script>
</body>

</html>