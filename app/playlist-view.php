<?php include 'header.php'; ?>

<div class="container-fluid">
    <div id="card-bg" class="card flex text-white justify-start items-start p-3 text-start shadow-lg border-rounded mb-4">
        <div class="text-center">
            <h4 class="fw-bold">Playlists</h4>
            <p>Create and manage your favorite playlists</p>
        </div>

        <!-- Create Playlist -->
        <form id="createPlaylistForm" class="d-flex gap-2 mb-4">
            <input id="createPlaylistInput" type="text" class="form-control" placeholder="New Playlist" required>
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
</div>

<?php include 'footer.php'; ?>

<script>
    document.addEventListener("DOMContentLoaded", async () => {

        // ---------------- IndexedDB Setup ----------------
        const dbPromise = new Promise((resolve, reject) => {
            const req = indexedDB.open("essence_life", 1);
            req.onupgradeneeded = e => {
                const db = e.target.result;
                if (!db.objectStoreNames.contains("playlists")) db.createObjectStore("playlists", {
                    keyPath: "id",
                    autoIncrement: true
                });
                if (!db.objectStoreNames.contains("contents")) {
                    const store = db.createObjectStore("contents", {
                        keyPath: "id",
                        autoIncrement: true
                    });
                    store.createIndex("content_name", "content_name", {
                        unique: false
                    });
                }
                if (!db.objectStoreNames.contains("playlist_audios")) {
                    const store = db.createObjectStore("playlist_audios", {
                        keyPath: "id",
                        autoIncrement: true
                    });
                    store.createIndex("playlist_id", "playlist_id", {
                        unique: false
                    });
                    store.createIndex("audio_id", "audio_id", {
                        unique: false
                    });
                }
            };
            req.onsuccess = e => resolve(e.target.result);
            req.onerror = e => reject(e.target.error);
        });

        // ---------------- Helper Functions ----------------
        async function getStore(storeName, mode = "readonly") {
            const db = await dbPromise;
            const tx = db.transaction(storeName, mode);
            return tx.objectStore(storeName);
        }

        async function getAll(storeName) {
            const store = await getStore(storeName);
            return new Promise(resolve => {
                const result = [];
                store.openCursor().onsuccess = e => {
                    const cursor = e.target.result;
                    if (cursor) {
                        result.push(cursor.value);
                        cursor.continue();
                    } else resolve(result);
                };
            });
        }

        async function addItem(storeName, data) {
            const store = await getStore(storeName, "readwrite");
            store.add(data);
        }

        async function deleteItem(storeName, id) {
            const store = await getStore(storeName, "readwrite");
            store.delete(id);
        }

        async function getAudiosByPlaylist(playlistId) {
            const store = await getStore("playlist_audios");
            return new Promise(resolve => {
                const result = [];
                const idx = store.index("playlist_id");
                idx.openCursor(IDBKeyRange.only(playlistId)).onsuccess = e => {
                    const cursor = e.target.result;
                    if (cursor) {
                        result.push(cursor.value);
                        cursor.continue();
                    } else resolve(result);
                };
            });
        }

        async function addAudioToPlaylist(playlistId, audioId) {
            const store = await getStore("playlist_audios", "readwrite");
            const exists = await getAudiosByPlaylist(playlistId);
            if (!exists.some(a => a.audio_id === audioId)) {
                store.add({
                    playlist_id: playlistId,
                    audio_id: audioId
                });
            }
        }

        async function removeAudioFromPlaylist(playlistId, audioId) {
            const store = await getStore("playlist_audios", "readwrite");
            const idx = store.index("playlist_id");
            idx.openCursor(IDBKeyRange.only(playlistId)).onsuccess = e => {
                const cursor = e.target.result;
                if (cursor) {
                    if (cursor.value.audio_id === audioId) cursor.delete();
                    cursor.continue();
                }
            };
        }

        // ---------------- DOM References ----------------
        const playlistContainer = document.getElementById("playlistContainer");
        const audioLibrary = document.getElementById("audioLibrary");
        const audioSearch = document.getElementById("audioSearch");
        const createPlaylistForm = document.getElementById("createPlaylistForm");
        const createPlaylistInput = document.getElementById("createPlaylistInput");

        // ---------------- Initial Sample Audios ----------------
        const sampleAudios = [{
                content_name: "Morning Meditation",
                content_type: "Meditation",
                image_url: "default.png"
            },
            {
                content_name: "Relaxing Ocean",
                content_type: "Nature",
                image_url: "default.png"
            },
            {
                content_name: "Sleep Stories",
                content_type: "Story",
                image_url: "default.png"
            },
            {
                content_name: "Calm Piano",
                content_type: "Music",
                image_url: "default.png"
            }
        ];
        const existingAudios = await getAll("contents");
        if (existingAudios.length === 0) {
            for (const audio of sampleAudios) await addItem("contents", audio);
        }

        // ---------------- Render Functions ----------------
        async function renderPlaylists() {
            const playlists = await getAll("playlists");
            playlistContainer.innerHTML = '';
            playlists.forEach(pl => {
                const col = document.createElement("div");
                col.className = "col-md-4 col-12";
                const card = document.createElement("div");
                card.className = "playlist-card shadow-lg p-3";
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
                    await deleteItem("playlists", pl.id);
                    renderPlaylists();
                });

                card.addEventListener("click", () => {
                    localStorage.setItem("currentPlaylistId", pl.id);
                    document.querySelectorAll(".playlist-card").forEach(c => c.classList.remove("active"));
                    card.classList.add("active");
                    renderPlaylistAudios(pl.id, card.querySelector(".playlist-audios"));
                });

                col.appendChild(card);
                playlistContainer.appendChild(col);
            });
        }

        async function renderPlaylistAudios(playlistId, container) {
            const relations = await getAudiosByPlaylist(playlistId);
            const allAudios = await getAll("contents");
            container.innerHTML = '';
            relations.forEach(rel => {
                const audio = allAudios.find(a => a.id === rel.audio_id);
                if (!audio) return;
                const div = document.createElement("div");
                div.className = "d-flex justify-content-between align-items-center p-2 mb-2 bg-dark rounded";
                div.innerHTML = `<div class="text-white">${audio.content_name}</div>
                             <button class="btn btn-outline-danger btn-sm"><i class="bi bi-x"></i></button>`;
                div.querySelector("button").addEventListener("click", async e => {
                    e.stopPropagation();
                    await removeAudioFromPlaylist(playlistId, audio.id);
                    renderPlaylistAudios(playlistId, container);
                });
                container.appendChild(div);
            });
        }

        let allAudios = [];
        async function renderAudios(filteredAudios = null) {
            const audios = filteredAudios || await getAll("contents");
            allAudios = audios;
            audioLibrary.innerHTML = '';
            audios.forEach(audio => {
                const card = document.createElement("div");
                card.className = "audio-card d-flex flex-column p-2 shadow-sm rounded text-white";
                card.style.minWidth = "200px";
                card.innerHTML = `
                <div class="mb-2">
                    <img src="${audio.image_url}" class="w-100 rounded" style="height:120px; object-fit:cover;">
                </div>
                <div class="d-flex flex-column justify-content-between flex-grow-1">
                    <h6 class="mb-1 text-white text-start">${audio.content_name}</h6>
                    <p class="text-white-50 mb-2 text-start">${audio.content_type}</p>
                    <button class="btn btn-success btn-sm align-self-start add-btn"><i class="bi bi-plus-lg"></i></button>
                </div>`;
                card.querySelector(".add-btn").addEventListener("click", async () => {
                    const playlistId = parseInt(localStorage.getItem("currentPlaylistId"));
                    if (!playlistId) return alert("Select a playlist first!");
                    await addAudioToPlaylist(playlistId, audio.id);
                    renderPlaylists();
                });
                audioLibrary.appendChild(card);
            });
        }

        // ---------------- Event Listeners ----------------
        createPlaylistForm.addEventListener("submit", async e => {
            e.preventDefault();
            const name = createPlaylistInput.value.trim();
            if (!name) return;
            await addItem("playlists", {
                name
            });
            createPlaylistInput.value = '';
            renderPlaylists();
        });

        audioSearch.addEventListener("input", () => {
            const filtered = allAudios.filter(a => a.content_name.toLowerCase().includes(audioSearch.value.toLowerCase()));
            renderAudios(filtered);
        });

        // ---------------- Carousel Scroll ----------------
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

        // ---------------- Initial Render ----------------
        renderPlaylists();
        renderAudios();

    });
</script>