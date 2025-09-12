<!--Player.php-->
<?php include 'header.php'; ?>
<link rel="stylesheet" href="./css/player_style.css">
<div class="container">
    <!-- Compact Main Player -->
    <div id="card-bg" class="card text-white shadow-lg border-0" style="border-radius: 20px; overflow: hidden;">
        <div class="row g-0 align-items-center">
            <!-- Song Image -->
            <div class="col-md-4 col-12">
                <img id="currentSongImage" src="default.png" alt="Cover"
                    class="w-100 h-100 object-fit-cover"
                    style="max-height: 200px; object-fit: cover;">
            </div>

            <!-- Song Info + Controls -->
            <div class="col-md-8 col-12 p-3">
                <p id="currentCategory" class="text-uppercase small mb-1">Category</p>
                <h4 id="currentSongTitle" class="fw-bold text-success mb-2">Song Title</h4>

                <!-- Progress + Time -->
                <div class="d-flex align-items-center gap-2 mb-2">
                    <span id="currentTime" class="small" style="width:40px;">0:00</span>
                    <input type="range" id="progressBar" value="0" min="0" max="100" step="0.1"
                        class="form-range custom-range" aria-label="Playback progress">
                    <span id="duration" class="small" style="width:40px;">0:00</span>
                </div>

                <!-- Controls -->
                <div class="d-flex align-items-center justify-content-center gap-2 mb-2">
                    <button id="prevBtn" type="button" class="btn btn-outline-light btn-sm rounded-circle" aria-label="Previous">
                        <i class="bi bi-skip-backward-fill fs-6"></i>
                    </button>
                    <button id="playPauseBtn" type="button" class="btn btn-success btn-sm rounded-circle shadow-lg" aria-label="Play/Pause">
                        <i class="bi bi-play fs-5"></i>
                    </button>
                    <button id="nextBtn" type="button" class="btn btn-outline-light btn-sm rounded-circle" aria-label="Next">
                        <i class="bi bi-skip-forward-fill fs-6"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Up Next -->
    <div id="card-bg" class="card flex justify-start items-start text-white p-2 text-start mb-2 mt-4 shadow-lg border-rounded">
        <h6 class="text-white fw-bold w-100 flex justify-start text-start items-start">Similar audios</h6>
    </div>
    <div class="up-next-wrapper position-relative">
        <button id="slideLeft" type="button" class="slider-btn left d-none" aria-label="Scroll left">
            <i class="bi bi-chevron-left"></i>
        </button>
        <div id="upNextContainer" class="up-next-slider" role="list"></div>
        <button id="slideRight" type="button" class="slider-btn right d-none" aria-label="Scroll right">
            <i class="bi bi-chevron-right"></i>
        </button>
    </div>

    <!-- Audio Info -->
    <div id="card-bg" class="card flex justify-start items-start text-white p-2 text-start mb-4 mt-4 shadow-lg border-rounded">
        <h6 class="text-white fw-bold mt-1 mb-1">Audio info</h6>
        <hr>
        <p style="color: rgba(236, 240, 241,.6);">Year added</p>
        <p style="margin-top: -15px;" id="yearAdded" class="text-white">Year added</p>
        <p style="color: rgba(236, 240, 241,.6);">Name</p>
        <p style="margin-top: -15px;" id="songName" class="text-white">Name</p>
        <p style="color: rgba(236, 240, 241,.6);">Description</p>
        <p style="margin-top: -15px;" id="description" class="text-white">Description</p>
        <p style="color: rgba(236, 240, 241,.6);">Category</p>
        <p style="margin-top: -15px;" id="songCategory" class="text-white">Category</p>
    </div>

    <!-- Description Info -->
    <div class="card flex justify-start alert alert-success items-start p-2 text-start mb-4 mt-5 shadow-lg border-rounded">
        <h4 class="font-weight-bold">Essence – Life, Meditate & Relax</h4>
        <hr>
        <p class="lead fs-6">Discover inner peace with guided meditations, calming music, and sleep stories.</p>
    </div>
</div>

<?php include 'footer.php'; ?>

<script>
    document.addEventListener("DOMContentLoaded", () => {
        const audioPlayer = document.getElementById("audioPlayer");
        const currentSongTitle = document.getElementById("currentSongTitle");
        const currentSongImage = document.getElementById("currentSongImage");
        const currentCategoryEl = document.getElementById("currentCategory");
        const playPauseBtn = document.getElementById("playPauseBtn");
        const progressBar = document.getElementById("progressBar");
        const currentTimeElem = document.getElementById("currentTime");
        const durationElem = document.getElementById("duration");
        const prevBtn = document.getElementById("prevBtn");
        const nextBtn = document.getElementById("nextBtn");
        const upNextContainer = document.getElementById("upNextContainer");

        const yearAdded = document.getElementById("yearAdded");
        const songName = document.getElementById("songName");
        const description = document.getElementById("description");
        const songCategory = document.getElementById("songCategory");

        let currentPlaylist = [];
        let currentIndex = -1;

        function formatTime(seconds) {
            if (!isFinite(seconds) || isNaN(seconds)) return "0:00";
            const min = Math.floor(seconds / 60);
            const sec = Math.floor(seconds % 60).toString().padStart(2, "0");
            return `${min}:${sec}`;
        }

        function formatDate(dateString) {
            if (!dateString) return "Unknown";
            const d = new Date(dateString);
            if (isNaN(d)) return dateString;
            return d.toLocaleDateString(undefined, {
                year: "numeric",
                month: "long",
                day: "numeric"
            });
        }

        function setPlayPauseIcon() {
            const icon = playPauseBtn.querySelector("i");
            if (!icon) return;
            if (audioPlayer.paused) {
                icon.className = "bi bi-play fs-5";
                playPauseBtn.classList.remove("btn-danger");
                playPauseBtn.classList.add("btn-success");
            } else {
                icon.className = "bi bi-pause fs-5";
                playPauseBtn.classList.remove("btn-success");
                playPauseBtn.classList.add("btn-danger");
            }
        }

        function highlightActiveSong() {
            const cards = Array.from(upNextContainer.querySelectorAll(".song-card"));
            cards.forEach((card, i) => card.classList.toggle("active", i === currentIndex));
        }

        // Play a song from the currentPlaylist by index
        function playSong(index) {
            const song = currentPlaylist[index];
            if (!song) return;
            currentIndex = index;

            audioPlayer.src = song.content_url;
            audioPlayer.play().catch(() => {}); // ignore auto-play rejections
            currentSongTitle.textContent = song.content_name || "Untitled";
            currentSongImage.src = song.image_url || "default.png";
            currentCategoryEl.textContent = (song.content_type || "Category").toUpperCase();

            // Fill audio info (formatted)
            yearAdded.textContent = formatDate(song.created_at || song.createdAt || "");
            songName.textContent = song.content_name || "Untitled";
            description.textContent = song.description || "No description";
            songCategory.textContent = song.content_type || "Unknown";

            setPlayPauseIcon();
            highlightActiveSong();

            // persist for other pages and for reload
            localStorage.setItem("currentSongData", JSON.stringify({
                src: song.content_url,
                currentTime: 0,
                paused: false,
                title: song.content_name,
                img: song.image_url || "default.png",
                category: song.content_type,
                index: index,
                description: song.description,
                created_at: song.created_at
            }));
        }

        // Restore last saved state (if any)
        (function restore() {
            const saved = localStorage.getItem("currentSongData");
            if (!saved) return;
            try {
                const state = JSON.parse(saved);
                if (state && state.src) {
                    currentSongTitle.textContent = state.title || "Song Title";
                    currentSongImage.src = state.img || "default.png";
                    currentCategoryEl.textContent = (state.category || "Category").toUpperCase();
                    audioPlayer.src = state.src;
                    audioPlayer.currentTime = state.currentTime || 0;

                    yearAdded.textContent = formatDate(state.created_at || "");
                    songName.textContent = state.title || "Untitled";
                    description.textContent = state.description || "No description";
                    songCategory.textContent = state.category || "Unknown";

                    if (!state.paused) {
                        audioPlayer.play().catch(err => {
                            /* autoplay restrictions may prevent play; user can press play */
                        });
                    }
                    setPlayPauseIcon();
                    currentIndex = Number.isFinite(state.index) ? state.index : -1;
                }
            } catch (e) {
                console.warn("Failed to parse currentSongData:", e);
            }
        })();

        // Load Up Next from IndexedDB (same category as current song if possible)
        async function loadUpNext() {
            try {
                const db = await new Promise((resolve, reject) => {
                    const req = indexedDB.open("essence_life", 1);
                    req.onsuccess = e => resolve(e.target.result);
                    req.onerror = e => reject(e.target.error);
                });

                const tx = db.transaction("contents", "readonly");
                const store = tx.objectStore("contents");
                const allContents = await new Promise(resolve => {
                    const items = [];
                    const cursorReq = store.openCursor();
                    cursorReq.onsuccess = e => {
                        const cursor = e.target.result;
                        if (cursor) {
                            items.push(cursor.value);
                            cursor.continue();
                        } else {
                            resolve(items);
                        }
                    };
                    cursorReq.onerror = () => resolve([]);
                });

                const savedState = JSON.parse(localStorage.getItem("currentSongData") || "{}");
                const category = savedState.category || "song";

                // build playlist: items with same category, fallback to all
                currentPlaylist = allContents.filter(it => (it.content_type || "").toString() === category.toString());
                if (!currentPlaylist.length) currentPlaylist = allContents;

                // render the up next cards
                upNextContainer.innerHTML = "";
                currentPlaylist.forEach((song, idx) => {
                    const card = document.createElement("div");
                    card.className = "song-card";
                    card.dataset.index = idx;
                    card.innerHTML = `
                    <img src="${song.image_url || 'default.png'}" alt="${(song.content_name || 'Untitled').replace(/"/g,'') }">
                    <p title="${(song.content_name || 'Untitled')}">${song.content_name || 'Untitled'}</p>
                `;
                    card.addEventListener("click", () => {
                        playSong(idx);
                        window.scrollTo({
                            top: 0,
                            behavior: 'smooth'
                        });
                    });
                    upNextContainer.appendChild(card);
                });

                // If we restored a song earlier but currentIndex is -1,
                // locate it in the newly-built currentPlaylist by matching src.
                if (audioPlayer.src && currentIndex === -1) {
                    const idx = currentPlaylist.findIndex(s => s.content_url === audioPlayer.src);
                    if (idx >= 0) {
                        currentIndex = idx;
                        highlightActiveSong();
                        updateAudioInfoIfNeeded(currentPlaylist[currentIndex]);
                    }
                } else {
                    highlightActiveSong();
                }

                // update arrows
                updateArrowVisibility();
            } catch (err) {
                console.error("Failed to load Up Next:", err);
            }
        }

        // helper: ensure info card shows full details for a song object when available
        function updateAudioInfoIfNeeded(song) {
            if (!song) return;
            yearAdded.textContent = formatDate(song.created_at || "");
            songName.textContent = song.content_name || "Untitled";
            description.textContent = song.description || "No description";
            songCategory.textContent = song.content_type || "Unknown";
        }

        // UI updates for time/progress
        function updateTimeUI() {
            if (audioPlayer.duration && isFinite(audioPlayer.duration)) {
                const pct = (audioPlayer.currentTime / audioPlayer.duration) * 100;
                progressBar.value = isNaN(pct) ? 0 : pct;
                currentTimeElem.textContent = formatTime(audioPlayer.currentTime);
                durationElem.textContent = formatTime(audioPlayer.duration);
            } else {
                progressBar.value = 0;
                currentTimeElem.textContent = formatTime(audioPlayer.currentTime || 0);
                durationElem.textContent = "0:00";
            }
        }

        audioPlayer.addEventListener("play", setPlayPauseIcon);
        audioPlayer.addEventListener("pause", setPlayPauseIcon);
        audioPlayer.addEventListener("timeupdate", updateTimeUI);
        audioPlayer.addEventListener("loadedmetadata", updateTimeUI);

        audioPlayer.addEventListener("ended", () => {
            if (currentIndex + 1 < currentPlaylist.length) playSong(currentIndex + 1);
            else setPlayPauseIcon();
        });

        progressBar.addEventListener("input", e => {
            if (audioPlayer.duration) {
                const pct = Number(e.target.value) / 100;
                currentTimeElem.textContent = formatTime(pct * audioPlayer.duration);
            }
        });
        progressBar.addEventListener("change", e => {
            if (audioPlayer.duration) {
                const pct = Number(e.target.value) / 100;
                audioPlayer.currentTime = pct * audioPlayer.duration;
            }
        });

        // Robust play/pause handler (awaits play promise)
        playPauseBtn.addEventListener("click", async (e) => {
            e.preventDefault();

            // If there's no audio src, try to set it from playlist
            if (!audioPlayer.src || audioPlayer.src === "") {
                // if playlist exists and currentIndex is -1, try to find saved song
                const saved = JSON.parse(localStorage.getItem("currentSongData") || "{}");
                if (currentPlaylist.length && (currentIndex === -1 || currentPlaylist[currentIndex]?.content_url !== saved.src)) {
                    // attempt to find saved in currentPlaylist
                    let idx = -1;
                    if (saved.src) idx = currentPlaylist.findIndex(s => s.content_url === saved.src);
                    if (idx === -1) idx = 0; // fallback to first
                    currentIndex = idx;
                    // set audio src
                    audioPlayer.src = currentPlaylist[currentIndex].content_url;
                    updateAudioInfoIfNeeded(currentPlaylist[currentIndex]);
                    highlightActiveSong();
                }
            }

            try {
                if (audioPlayer.paused) {
                    // Wait for play to resolve; if browser blocks it will throw
                    await audioPlayer.play();
                } else {
                    audioPlayer.pause();
                }
            } catch (err) {
                // Play may be blocked by autoplay policies; inform UI but let user retry
                console.warn("Playback error (user interaction may be required):", err);
            } finally {
                setPlayPauseIcon();
            }
        });

        prevBtn.addEventListener("click", () => {
            if (currentIndex > 0) playSong(currentIndex - 1);
        });
        nextBtn.addEventListener("click", () => {
            if (currentIndex + 1 < currentPlaylist.length) playSong(currentIndex + 1);
        });

        // Save playback state every second (single interval)
        if (!window.__playerStateSaver) {
            window.__playerStateSaver = setInterval(() => {
                if (!audioPlayer.src) return;
                localStorage.setItem("currentSongData", JSON.stringify({
                    src: audioPlayer.src,
                    currentTime: audioPlayer.currentTime || 0,
                    paused: audioPlayer.paused,
                    title: currentSongTitle.textContent,
                    img: currentSongImage.src,
                    category: currentPlaylist[currentIndex]?.content_type || (currentCategoryEl.textContent || "").toLowerCase(),
                    index: currentIndex,
                    created_at: yearAdded.textContent,
                    description: description.textContent
                }));
            }, 1000);
        }

        // ===== Slider navigation arrows =====
        const slideLeft = document.getElementById("slideLeft");
        const slideRight = document.getElementById("slideRight");

        function updateArrowVisibility() {
            if (!upNextContainer || !slideLeft || !slideRight) return;
            const maxScrollLeft = upNextContainer.scrollWidth - upNextContainer.clientWidth;
            if (upNextContainer.scrollLeft <= 10) {
                slideLeft.classList.add("d-none");
            } else {
                slideLeft.classList.remove("d-none");
            }
            if (upNextContainer.scrollLeft >= maxScrollLeft - 10) {
                slideRight.classList.add("d-none");
            } else {
                slideRight.classList.remove("d-none");
            }
        }

        upNextContainer.addEventListener("scroll", updateArrowVisibility);
        window.addEventListener("resize", updateArrowVisibility);

        slideLeft.addEventListener("click", () => {
            upNextContainer.scrollBy({
                left: -220,
                behavior: "smooth"
            });
            setTimeout(updateArrowVisibility, 300);
        });
        slideRight.addEventListener("click", () => {
            upNextContainer.scrollBy({
                left: 220,
                behavior: "smooth"
            });
            setTimeout(updateArrowVisibility, 300);
        });

        // initialize
        loadUpNext();
        setTimeout(updateArrowVisibility, 300);
    });
</script>