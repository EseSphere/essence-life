<?php include 'header.php'; ?>

<div class="container-fluid">
    <div id="card-bg" class="card flex justify-start items-start text-white p-3 text-start shadow-lg border-rounded mb-4">
        <div class="text-center">
            <h4 class="text-white fw-bold">Playlists</h4>
            <p class="text-white-50">Create and manage your favorite playlists</p>
        </div>

        <!-- Create Playlist -->
        <form id="createPlaylistForm" class="d-flex gap-2 mb-4">
            <input type="text" name="playlist_name" class="form-control" placeholder="New Playlist Name" required>
            <button type="submit" class="btn btn-success">Create</button>
        </form>
    </div>

    <!-- Playlists -->
    <div id="playlistContainer" class="row g-2 mt-3"></div>

    <hr class="text-white">

    <!-- All Audios Carousel -->
    <div class="d-flex justify-content-between align-items-center mb-2">
        <h5 class="text-white fw-bold mb-0">All Audios</h5>
        <input type="text" id="audioSearch" class="form-control w-auto" placeholder="Search audio...">
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
        const playlistContainer = document.getElementById("playlistContainer");
        const audioLibrary = document.getElementById("audioLibrary");
        const audioSearch = document.getElementById("audioSearch");

        // Carousel navigation
        const prevBtn = document.querySelector(".prev-btn");
        const nextBtn = document.querySelector(".next-btn");

        async function fetchPlaylists() {
            const res = await fetch('playlist_actions.php?action=list');
            const data = await res.json();
            playlistContainer.innerHTML = '';
            data.forEach(pl => {
                const col = document.createElement("div");
                col.className = "col-md-4 col-12";
                const card = document.createElement("div");
                card.className = "playlist-card shadow-lg p-3";
                card.innerHTML = `
                <div class="d-flex justify-content-between align-items-center">
                    <h6 class="mb-0">${pl.name}</h6>
                    <button class="btn btn-sm btn-danger remove-btn"><i class="bi bi-trash"></i></button>
                </div>
                <div class="playlist-audios mt-3"></div>`;
                card.querySelector(".remove-btn").addEventListener("click", async e => {
                    e.stopPropagation();
                    if (!confirm("Delete this playlist?")) return;
                    await fetch(`playlist_actions.php?action=delete&id=${pl.id}`);
                    fetchPlaylists();
                });
                card.addEventListener("click", () => {
                    localStorage.setItem("currentPlaylistId", pl.id);
                    document.querySelectorAll(".playlist-card").forEach(c => c.classList.remove("active"));
                    card.classList.add("active");
                    loadPlaylistAudios(pl.id, card.querySelector(".playlist-audios"));
                });
                col.appendChild(card);
                playlistContainer.appendChild(col);
            });
        }

        async function loadPlaylistAudios(playlistId, container) {
            const res = await fetch(`playlist_actions.php?action=get_audios&playlist_id=${playlistId}`);
            const data = await res.json();
            container.innerHTML = '';
            data.forEach(audio => {
                const div = document.createElement("div");
                div.className = "d-flex justify-content-between align-items-center p-2 mb-2 bg-dark rounded";
                div.innerHTML = `<div class="text-white">${audio.content_name}</div>
                             <button class="btn btn-outline-danger btn-sm"><i class="bi bi-x"></i></button>`;
                div.querySelector("button").addEventListener("click", async e => {
                    e.stopPropagation();
                    await fetch(`playlist_actions.php?action=remove_audio&playlist_id=${playlistId}&audio_id=${audio.id}`);
                    loadPlaylistAudios(playlistId, container);
                });
                container.appendChild(div);
            });
        }

        let allAudios = [];
        async function loadAllAudios() {
            const res = await fetch('playlist_actions.php?action=all_audios');
            allAudios = await res.json();
            renderAudios(allAudios);
        }

        function renderAudios(audios) {
            audioLibrary.innerHTML = '';
            audios.forEach(audio => {
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
                </div>`;
                card.querySelector(".add-btn").addEventListener("click", async () => {
                    const playlistId = localStorage.getItem("currentPlaylistId");
                    if (!playlistId) return alert("Select a playlist first!");
                    await fetch(`playlist_actions.php?action=add_audio&playlist_id=${playlistId}&audio_id=${audio.id}`);
                    fetchPlaylists();
                });
                audioLibrary.appendChild(card);
            });
        }

        audioSearch.addEventListener("input", () => {
            const filtered = allAudios.filter(a => a.content_name.toLowerCase().includes(audioSearch.value.toLowerCase()));
            renderAudios(filtered);
        });

        // Carousel arrows
        prevBtn.addEventListener("click", () => {
            audioLibrary.scrollBy({
                left: -250,
                behavior: 'smooth'
            });
        });
        nextBtn.addEventListener("click", () => {
            audioLibrary.scrollBy({
                left: 250,
                behavior: 'smooth'
            });
        });

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

        document.getElementById("createPlaylistForm").addEventListener("submit", async e => {
            e.preventDefault();
            const name = e.target.playlist_name.value.trim();
            if (!name) return;
            await fetch('playlist_actions.php?action=create', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                },
                body: `name=${encodeURIComponent(name)}`
            });
            e.target.playlist_name.value = '';
            fetchPlaylists();
        });

        fetchPlaylists();
        loadAllAudios();
    });
</script>

<style>
    body {
        background: #0d1117;
        font-family: 'Poppins', sans-serif;
    }

    #card-bg {
        background-color: #192a56;
        font-size: 14px;
    }

    .playlist-card {
        background: #1e2a47;
        border-radius: 15px;
        cursor: pointer;
        transition: all 0.3s ease;
        position: relative;
    }

    .playlist-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.5);
    }

    .playlist-card.active {
        border: 2px solid #1db954;
    }

    .playlist-card h6 {
        font-weight: 600;
    }

    .remove-btn {
        border-radius: 50%;
        padding: 4px 8px;
    }

    .audio-carousel-wrapper {
        position: relative;
    }

    .carousel-btn {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        background: rgba(0, 0, 0, 0.5);
        border: none;
        color: #fff;
        width: 35px;
        height: 35px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        z-index: 10;
    }

    .prev-btn {
        left: 0;
    }

    .next-btn {
        right: 0;
    }

    .carousel-btn:hover {
        background: #1db954;
    }

    .audio-carousel {
        display: flex;
        overflow-x: auto;
        gap: 15px;
        padding-bottom: 10px;
        scroll-snap-type: x mandatory;
    }

    .audio-carousel::-webkit-scrollbar {
        display: none;
    }

    .audio-carousel.dragging {
        cursor: grabbing;
        cursor: -webkit-grabbing;
    }

    .audio-card {
        background: #1b1f38;
        flex-shrink: 0;
        scroll-snap-align: start;
        transition: transform 0.3s, box-shadow 0.3s;
    }

    .audio-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.4);
    }

    .audio-card h6 {
        font-size: 1rem;
        font-weight: 600;
    }

    .audio-card p {
        font-size: 0.85rem;
        margin: 0;
    }

    .add-btn {
        border-radius: 50%;
        width: 32px;
        height: 32px;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 0;
    }
</style>