</section>
</div>
<!-- Bottom Navbar -->
<nav style="background-color: #001F54; position:fixed; bottom:0; right:0; left:0;" class="navbar navbar-expand-lg navbar-bottom">
  <div class="container justify-content-around">
    <a class="nav-link <?php if (basename($_SERVER['PHP_SELF']) == './home') {
                          echo 'active';
                        } ?>" href="./home"><i class="bi bi-house-door"></i> Home</a>
    <a class="nav-link <?php if (basename($_SERVER['PHP_SELF']) == './playlist') {
                          echo 'active';
                        } ?>" href="./playlist"><i class="bi bi-music-note-list"></i> Play List</a>
    <a class="nav-link <?php if (basename($_SERVER['PHP_SELF']) == './discover') {
                          echo 'active';
                        } ?>" href="./discover"><i class="bi bi-compass"></i> Discover</a>
    <a class="nav-link <?php if (basename($_SERVER['PHP_SELF']) == './profile') {
                          echo 'active';
                        } ?>" href="./profile"><i class="bi bi-person-circle"></i> Profile</a>
  </div>
</nav>

<!-- Modal Player -->
<div id="audioPlayerContainer" style="display:none; position:fixed; bottom:60px; left:0; right:0; background:#001F54; color:#fff; padding:10px; z-index:999;">
  <div class="player-main w-100" style="position:relative;">
    <div id="currentSongInfo">
      <div class="player-controls">
        <div class="row w-100">
          <div class="col-md-2 col-3 flex items-start justify-start text-start">
            <img id="currentSongImage" src="default.png" alt="Now Playing">
          </div>
          <div class="col-md-8 col-8 flex items-center justify-center text-center">
            <div id="currentSongTitle" style="cursor:pointer; text-decoration:underline;">Song Title</div>
            <input type="range" id="progressBar" value="0" min="0" max="100" step="0.1">
            <span class="player-time" id="currentTime">0:00</span> /
            <span class="player-time" id="duration">0:00</span>
          </div>
          <div class="col-md-8 col-8 flex items-center justify-center text-center">
            <button id="closePlayerBtn" style="position:absolute; top:5px; right:10px; font-size:20px; background:none; border:none; color:#fff; cursor:pointer;">✖</button>
          </div>
          <div class="col-md-2 w-100 flex justify-center items-center text-center">
            <button id="prevBtn">⏮️</button>
            <button id="playPauseBtn">▶️</button>
            <button id="nextBtn">⏭️</button>
          </div>
        </div>
      </div>
    </div>
  </div>
  <audio id="audioPlayer"></audio>
</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
<script src="https://cdn.jsdelivr.net/npm/gsap@3.12.5/dist/gsap.min.js"></script>
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<!--<script src="script.js"></script>-->
<script>
  document.addEventListener("DOMContentLoaded", () => {
    // Intercept all internal link clicks
    document.body.addEventListener("click", async e => {
      const link = e.target.closest("a.ajax-link");
      if (!link) return;
      e.preventDefault();

      const url = link.href;
      const res = await fetch(url);
      const html = await res.text();

      // Load HTML into main container
      document.getElementById("pageContent").innerHTML = html;

      // Re-run your category/audio initialization
      if (typeof populateCategories === "function") {
        populateCategories();
      }

      // Update browser URL without reloading
      history.pushState(null, "", url);
    });

    // Handle browser back/forward buttons
    window.addEventListener("popstate", async () => {
      const res = await fetch(location.href);
      const html = await res.text();
      document.getElementById("pageContent").innerHTML = html;
      if (typeof populateCategories === "function") {
        populateCategories();
      }
    });
  });

  async function populateCategories() {
    const dbName = "essence_life";
    const dbVersion = 1;
    const db = await new Promise((resolve, reject) => {
      const request = indexedDB.open(dbName, dbVersion);
      request.onsuccess = e => resolve(e.target.result);
      request.onerror = e => reject(e.target.error);
    });

    // Fetch all contents
    const tx = db.transaction("contents", "readonly");
    const store = tx.objectStore("contents");
    const allContents = await new Promise(resolve => {
      const items = [];
      store.openCursor().onsuccess = function(event) {
        const cursor = event.target.result;
        if (cursor) {
          items.push(cursor.value);
          cursor.continue();
        } else {
          resolve(items);
        }
      };
    });

    // Group by content_type
    const categories = {};
    allContents.forEach(item => {
      const type = item.content_type || "unknown";
      if (!categories[type]) categories[type] = [];
      categories[type].push(item);
    });

    const categoryDescriptions = {
      'song': 'Discover relaxing and inspiring tracks to lift your mood and energize your day.',
      'meditation': 'Calm your mind with soothing tracks designed for meditation, mindfulness, and relaxation.',
      'sleep': 'Sleep better with calming sounds and peaceful melodies.',
      'story': 'Engaging stories to entertain and inspire.',
      'motivation': 'Boost your motivation and productivity with uplifting content.',
      'wisdom': 'Listen to wise thoughts and guidance to enrich your life.',
      'relaxation': 'Relax and unwind with peaceful audio tracks.'
    };

    const container = document.getElementById("categoriesContainer");

    // Player elements
    const playerContainer = document.getElementById("audioPlayerContainer");
    const audioPlayer = document.getElementById("audioPlayer");
    const currentSongTitle = document.getElementById("currentSongTitle");
    const currentSongImage = document.getElementById("currentSongImage");
    const playPauseBtn = document.getElementById("playPauseBtn");
    const nextBtn = document.getElementById("nextBtn");
    const prevBtn = document.getElementById("prevBtn");
    const progressBar = document.getElementById("progressBar");
    const currentTimeElem = document.getElementById("currentTime");
    const durationElem = document.getElementById("duration");
    const closePlayerBtn = document.getElementById("closePlayerBtn");

    // Check if user closed player previously
    const playerClosed = localStorage.getItem("playerClosed") === "true";

    // Hide player on load
    playerContainer.style.display = "none";

    let currentCategory = null;
    let currentIndex = -1;
    let currentPlaylist = [];

    function formatTime(seconds) {
      const min = Math.floor(seconds / 60);
      const sec = Math.floor(seconds % 60).toString().padStart(2, "0");
      return `${min}:${sec}`;
    }

    function showPlayer() {
      if (playerContainer.style.display === "none") {
        playerContainer.style.display = "flex";
      }
    }

    function playSong(category, index) {
      // Re-enable player if it was permanently closed
      if (localStorage.getItem("playerClosed") === "true") {
        localStorage.removeItem("playerClosed");
      }

      const item = categories[category][index];
      if (!item) return;

      currentCategory = category;
      currentIndex = index;
      currentPlaylist = categories[category];

      audioPlayer.src = item.content_url;
      audioPlayer.play();
      playPauseBtn.textContent = "⏸️";
      showPlayer();

      currentSongTitle.textContent = `${item.content_name} (${category})`;
      currentSongImage.src = item.image_url || 'default.png';

      // Save song metadata for play.php page
      localStorage.setItem("currentSongData", JSON.stringify({
        src: item.content_url,
        title: item.content_name,
        img: item.image_url || "default.png",
        category: category,
        currentTime: 0,
        paused: false
      }));

      // Highlight currently playing song
      document.querySelectorAll(".song-item").forEach(el => el.classList.remove("playing"));
      const allSongs = Array.from(document.querySelectorAll(".song-item"));
      const songDiv = allSongs.find(div => div.getAttribute("data-src") === item.content_url);
      if (songDiv) songDiv.classList.add("playing");
    }

    audioPlayer.addEventListener("ended", () => {
      if (currentIndex + 1 < currentPlaylist.length) {
        playSong(currentCategory, currentIndex + 1);
      } else {
        playPauseBtn.textContent = "▶️";
      }
    });

    audioPlayer.addEventListener("timeupdate", () => {
      if (audioPlayer.duration) {
        progressBar.value = (audioPlayer.currentTime / audioPlayer.duration) * 100;
        currentTimeElem.textContent = formatTime(audioPlayer.currentTime);
        durationElem.textContent = formatTime(audioPlayer.duration);
      }
    });

    progressBar.addEventListener("input", () => {
      if (audioPlayer.duration) {
        audioPlayer.currentTime = (progressBar.value / 100) * audioPlayer.duration;
      }
    });

    playPauseBtn.addEventListener("click", () => {
      if (audioPlayer.paused) {
        audioPlayer.play();
        playPauseBtn.textContent = "⏸️";
      } else {
        audioPlayer.pause();
        playPauseBtn.textContent = "▶️";
      }
    });

    nextBtn.addEventListener("click", () => {
      if (currentIndex + 1 < currentPlaylist.length) {
        playSong(currentCategory, currentIndex + 1);
      }
    });

    prevBtn.addEventListener("click", () => {
      if (currentIndex > 0) {
        playSong(currentCategory, currentIndex - 1);
      }
    });

    // Close button hides player + stops audio + prevents auto-restore
    closePlayerBtn.addEventListener("click", () => {
      audioPlayer.pause(); // Stop audio
      audioPlayer.src = ""; // Clear source
      playerContainer.style.display = "none";
      localStorage.setItem("playerClosed", "true"); // mark closed
      localStorage.removeItem("audioPlayerState"); // clear playback state
    });

    // --- Redirect to play.php when clicking title ---
    currentSongTitle.addEventListener("click", () => {
      if (!audioPlayer.src) return; // do nothing if no song is playing

      const state = {
        src: audioPlayer.src,
        currentTime: audioPlayer.currentTime,
        paused: audioPlayer.paused,
        title: currentSongTitle.textContent,
        img: currentSongImage.src,
        category: currentCategory
      };
      localStorage.setItem("currentSongData", JSON.stringify(state));

      window.location.href = "./player";
    });

    // --- Restore audio state if not closed ---
    if (!playerClosed) {
      const savedState = localStorage.getItem("audioPlayerState");
      if (savedState) {
        const state = JSON.parse(savedState);
        if (state.src) {
          audioPlayer.src = state.src;
          audioPlayer.currentTime = state.currentTime || 0;
          currentSongTitle.textContent = state.title || "Song Title";
          currentSongImage.src = state.img || "default.png";
          playerContainer.style.display = "flex";
          if (!state.paused) audioPlayer.play();
          playPauseBtn.textContent = audioPlayer.paused ? "▶️" : "⏸️";
        }
      }
    }

    // --- Save audio state every second ---
    setInterval(() => {
      if (!audioPlayer.src) return;
      const state = {
        src: audioPlayer.src,
        currentTime: audioPlayer.currentTime,
        paused: audioPlayer.paused,
        title: currentSongTitle.textContent,
        img: currentSongImage.src,
        category: currentCategory
      };
      localStorage.setItem("audioPlayerState", JSON.stringify(state));
    }, 1000);

    // Populate categories
    container.innerHTML = "";
    for (const type in categories) {
      const items = categories[type];
      const rowDiv = document.createElement("div");
      rowDiv.classList.add("category-row");

      const titleDiv = document.createElement("div");
      titleDiv.className = "category-title w-100 justify-start items-flex-start text-start";
      titleDiv.innerHTML = `${type.charAt(0).toUpperCase() + type.slice(1)}`;
      if (categoryDescriptions[type]) {
        const p = document.createElement("p");
        p.className = "fs-6 text-start";
        p.textContent = categoryDescriptions[type];
        titleDiv.appendChild(p);
      }
      rowDiv.appendChild(titleDiv);

      const sliderDiv = document.createElement("div");
      sliderDiv.className = "slider";

      items.forEach((item, idx) => {
        const songDiv = document.createElement("div");
        songDiv.className = "song-item";
        songDiv.setAttribute("data-src", item.content_url || "");
        songDiv.setAttribute("data-title", item.content_name || "");
        songDiv.setAttribute("data-img", item.image_url || "");

        const img = document.createElement("img");
        img.src = item.image_url || "";
        songDiv.appendChild(img);

        const p = document.createElement("p");
        p.innerHTML = `${item.content_name || ""} <br><span style="font-size: 13px;">${item.description || ""}</span>`;
        songDiv.appendChild(p);

        songDiv.addEventListener("click", () => playSong(type, idx));

        sliderDiv.appendChild(songDiv);
      });

      rowDiv.appendChild(sliderDiv);
      container.appendChild(rowDiv);
    }
  }

  window.addEventListener("load", populateCategories);

  function getGreeting(name) {
    const hour = new Date().getHours();
    let greeting;

    if (hour < 12) {
      greeting = "Good Morning";
    } else if (hour < 18) {
      greeting = "Good Afternoon";
    } else {
      greeting = "Good Evening";
    }

    return `${greeting} ${name}`;
  }

  document.getElementById("greeting").textContent = getGreeting("Samson");
</script>

</body>

</html>