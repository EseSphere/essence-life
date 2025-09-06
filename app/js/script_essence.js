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