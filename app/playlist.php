<?php include 'header.php'; ?>

<link rel="stylesheet" href="./css/playlist_style.css">
<div class="container-fluid">
    <div id="card-bg" class="card flex text-white justify-start items-start p-3 text-start shadow-lg border-rounded mb-4">
        <div class="text-center">
            <h4 class="fw-bold">Playlists</h4>
            <p>Create and manage your favorite playlists</p>
        </div>

        <!-- Create Playlist -->
        <form id="createPlaylistForm" class="d-flex gap-2 mb-4">
            <input id="createPlaylistInput" type="text" name="playlist_name" class="form-control" placeholder="New Playlist" required>
            <button type="submit" class="btn btn-success">Create</button>
        </form>
    </div>

    <!-- Playlists -->
    <div id="playlistContainer" class="row g-2 mt-3"></div>

    <hr class="text-white">

    <!-- All Audios Carousel -->
    <div id="card-bg" class="d-flex alert justify-content-between p-3 align-items-center mb-2">
        <h5>All Audios</h5>
        <input type="text" id="audioSearch" class="form-control w-auto" placeholder="Search...">
    </div>
    <div class="audio-carousel-wrapper position-relative">
        <button class="carousel-btn prev-btn"><i class="bi bi-chevron-left"></i></button>
        <div id="audioLibrary" class="audio-carousel d-flex gap-3 overflow-auto py-2"></div>
        <button class="carousel-btn next-btn"><i class="bi bi-chevron-right"></i></button>
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
    document.addEventListener("DOMContentLoaded", async () => {
        const playlistContainer = document.getElementById("playlistContainer");
        const audioLibrary = document.getElementById("audioLibrary");
        const audioSearch = document.getElementById("audioSearch");
        const createPlaylistForm = document.getElementById("createPlaylistForm");
        const createPlaylistInput = document.getElementById("createPlaylistInput");

        // ---------- IndexedDB Setup ----------
        const dbPromise = new Promise((resolve, reject) => {
            const request = indexedDB.open("essence_life", 1);
            request.onupgradeneeded = e => {
                const db = e.target.result;
                if (!db.objectStoreNames.contains("playlists")) {
                    db.createObjectStore("playlists", {
                        keyPath: "id",
                        autoIncrement: true
                    });
                }
                if (!db.objectStoreNames.contains("contents")) {
                    db.createObjectStore("contents", {
                        keyPath: "id",
                        autoIncrement: true
                    });
                }
                if (!db.objectStoreNames.contains("playlist_audios")) {
                    db.createObjectStore("playlist_audios", {
                        keyPath: "id",
                        autoIncrement: true
                    });
                }
            };
            request.onsuccess = e => resolve(e.target.result);
            request.onerror = e => reject(e.target.error);
        });

        // ---------- Helper Functions ----------
        async function addPlaylist(name) {
            const db = await dbPromise;
            return new Promise((resolve, reject) => {
                const tx = db.transaction("playlists", "readwrite");
                const store = tx.objectStore("playlists");
                const req = store.add({
                    name
                });
                req.onsuccess = e => resolve(e.target.result);
                req.onerror = e => reject(e.target.error);
            });
        }

        async function getAllPlaylists() {
            const db = await dbPromise;
            return new Promise(resolve => {
                const tx = db.transaction("playlists", "readonly");
                const store = tx.objectStore("playlists");
                const req = store.getAll();
                req.onsuccess = e => resolve(e.target.result);
            });
        }

        async function deletePlaylist(id) {
            const db = await dbPromise;
            return new Promise(resolve => {
                const tx = db.transaction("playlists", "readwrite");
                const store = tx.objectStore("playlists");
                store.delete(id);
                tx.oncomplete = () => resolve();
            });
        }

        async function getAllAudios() {
            const db = await dbPromise;
            return new Promise(resolve => {
                const tx = db.transaction("contents", "readonly");
                const store = tx.objectStore("contents");
                const req = store.getAll();
                req.onsuccess = e => resolve(e.target.result);
            });
        }

        async function getPlaylistAudios(playlistId) {
            const db = await dbPromise;
            return new Promise(resolve => {
                const tx = db.transaction("playlist_audios", "readonly");
                const store = tx.objectStore("playlist_audios");
                const req = store.getAll();
                req.onsuccess = e => {
                    const all = e.target.result;
                    resolve(all.filter(pa => pa.playlist_id === playlistId));
                };
            });
        }

        async function addAudioToPlaylist(playlistId, audioId) {
            const db = await dbPromise;
            return new Promise(resolve => {
                const tx = db.transaction("playlist_audios", "readwrite");
                const store = tx.objectStore("playlist_audios");

                // Prevent duplicates
                const getAllReq = store.getAll();
                getAllReq.onsuccess = e => {
                    const all = e.target.result;
                    const exists = all.find(pa => pa.playlist_id === playlistId && pa.audio_id === audioId);
                    if (!exists) {
                        store.add({
                            playlist_id: playlistId,
                            audio_id: audioId
                        });
                    }
                };

                tx.oncomplete = () => resolve();
            });
        }

        async function removeAudioFromPlaylist(id) {
            const db = await dbPromise;
            return new Promise(resolve => {
                const tx = db.transaction("playlist_audios", "readwrite");
                const store = tx.objectStore("playlist_audios");
                store.delete(id);
                tx.oncomplete = () => resolve();
            });
        }

        // ---------- Render Functions ----------
        async function renderPlaylists() {
            const playlists = await getAllPlaylists();
            playlistContainer.innerHTML = '';
            playlists.forEach(pl => {
                const col = document.createElement("div");
                col.className = "col-md-4 col-12";
                const card = document.createElement("div");
                card.className = "playlist-card shadow-lg p-3";
                card.style.border = "1px solid #40739e";
                card.innerHTML = `
                <div class="d-flex justify-content-between align-items-center">
                    <h6 class="mb-0">${pl.name}</h6>
                    <button class="btn btn-sm btn-danger remove-btn"><i class="bi bi-trash"></i></button>
                </div>
                <div class="playlist-audios mt-3"></div>
            `;

                card.querySelector(".remove-btn").addEventListener("click", async e => {
                    e.stopPropagation();
                    if (!confirm("Delete this playlist?")) return;
                    await deletePlaylist(pl.id);
                    renderPlaylists();
                });

                card.addEventListener("click", async () => {
                    localStorage.setItem("currentPlaylistId", pl.id);
                    document.querySelectorAll(".playlist-card").forEach(c => c.classList.remove("active"));
                    card.classList.add("active");
                    await renderPlaylistAudios(pl.id, card.querySelector(".playlist-audios"));
                });

                col.appendChild(card);
                playlistContainer.appendChild(col);
            });
        }

        async function renderPlaylistAudios(playlistId, container) {
            const audios = await getAllAudios();
            const playlistAudios = await getPlaylistAudios(playlistId);
            container.innerHTML = '';
            playlistAudios.forEach(pa => {
                const audio = audios.find(a => a.id === pa.audio_id);
                if (!audio) return;
                const div = document.createElement("div");
                div.className = "d-flex justify-content-between align-items-center p-2 mb-2 bg-dark rounded text-white";
                div.innerHTML = `<span>${audio.content_name}</span>
                             <button class="btn btn-outline-danger btn-sm"><i class="bi bi-x"></i></button>`;
                div.querySelector("button").addEventListener("click", async e => {
                    e.stopPropagation();
                    await removeAudioFromPlaylist(pa.id);
                    await renderPlaylistAudios(playlistId, container);
                });
                container.appendChild(div);
            });
        }

        async function renderAudios(filter = '') {
            const audios = await getAllAudios();
            const filtered = audios.filter(a => a.content_name.toLowerCase().includes(filter.toLowerCase()));
            audioLibrary.innerHTML = '';
            filtered.forEach(audio => {
                const card = document.createElement("div");
                card.className = "audio-card d-flex flex-column p-2 shadow-sm rounded text-white";
                card.style.minWidth = "200px";
                card.innerHTML = `
                <div class="mb-2">
                    <img src="${audio.image_url || 'default.png'}" class="w-100 rounded" style="height:120px; object-fit:cover;">
                </div>
                <div class="d-flex flex-column justify-content-between flex-grow-1">
                    <h6 class="mb-1 text-white text-start">${audio.content_name}</h6>
                    <p class="text-white-50 mb-2 text-start">${audio.content_type}</p>
                    <button class="btn btn-success btn-sm align-self-start add-btn"><i class="bi bi-plus-lg"></i></button>
                </div>
            `;

                card.querySelector(".add-btn").addEventListener("click", async () => {
                    const playlistId = Number(localStorage.getItem("currentPlaylistId"));
                    if (!playlistId) return alert("Select a playlist first!");
                    await addAudioToPlaylist(playlistId, audio.id);
                    await renderPlaylists();

                    // Refresh audios inside the selected playlist
                    const activeCard = document.querySelector(".playlist-card.active");
                    if (activeCard) {
                        await renderPlaylistAudios(playlistId, activeCard.querySelector(".playlist-audios"));
                    }
                });

                audioLibrary.appendChild(card);
            });
        }

        // ---------- Event Listeners ----------
        createPlaylistForm.addEventListener("submit", async e => {
            e.preventDefault();
            const name = createPlaylistInput.value.trim();
            if (!name) return;
            await addPlaylist(name);
            createPlaylistInput.value = '';
            await renderPlaylists();
        });

        audioSearch.addEventListener("input", e => renderAudios(e.target.value));

        // Carousel navigation
        const prevBtn = document.querySelector(".prev-btn");
        const nextBtn = document.querySelector(".next-btn");
        prevBtn.addEventListener("click", () => audioLibrary.scrollBy({
            left: -250,
            behavior: 'smooth'
        }));
        nextBtn.addEventListener("click", () => audioLibrary.scrollBy({
            left: 250,
            behavior: 'smooth'
        }));

        // Drag to scroll
        let isDown = false,
            startX, scrollLeft;
        audioLibrary.addEventListener("mousedown", e => {
            isDown = true;
            audioLibrary.classList.add("dragging");
            startX = e.pageX - audioLibrary.offsetLeft;
            scrollLeft = audioLibrary.scrollLeft;
        });
        audioLibrary.addEventListener("mouseleave", () => {
            isDown = false;
            audioLibrary.classList.remove("dragging");
        });
        audioLibrary.addEventListener("mouseup", () => {
            isDown = false;
            audioLibrary.classList.remove("dragging");
        });
        audioLibrary.addEventListener("mousemove", e => {
            if (!isDown) return;
            e.preventDefault();
            const x = e.pageX - audioLibrary.offsetLeft;
            const walk = (x - startX) * 2;
            audioLibrary.scrollLeft = scrollLeft - walk;
        });

        // Initial render
        await renderPlaylists();
        await renderAudios();
    });
</script>