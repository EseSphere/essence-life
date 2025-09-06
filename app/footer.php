    </section>
    </div>
    <!-- Bottom Navbar -->
    <nav style="background-color: #001F54; position:fixed; bottom:0; right:0; left:0;" class="navbar navbar-expand-lg navbar-bottom">
      <div class="container justify-content-around">
        <a class="nav-link" href="#hero"><i class="bi bi-house-door"></i> Home</a>
        <a class="nav-link" href="#questionnaire"><i class="bi bi-bullseye"></i> Goals</a>
        <a class="nav-link" href="#features"><i class="bi bi-stars"></i> Features</a>
        <a class="nav-link" href="#cta"><i class="bi bi-download"></i> Get App</a>
        <a class="nav-link" href="#footer"><i class="bi bi-envelope"></i> Contact</a>
      </div>
    </nav>

    <!-- Modal Player -->
    <div id="playerModal" style="position:fixed;bottom:60px;left:0;width:100%;height:100%;background:#001F54;display:none;justify-content:center;align-items:center;z-index:1000;padding:10px;">
      <div style="background:#001F54;padding:15px;border-radius:12px;text-align:center;max-width:400px;width:100%;height:auto;display:flex;flex-direction:column;justify-content:center;">
        <h2 id="modalTitle" style="color:white;font-size:1.3rem;margin-bottom:10px;"></h2>
        <img id="modalImg" src="" style="width:100%;height:auto;max-height:300px;object-fit:cover;border-radius:12px;margin-bottom:10px;">
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
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="./js/script_essence.js"></script>
    <script src="script.js"></script>
    </body>

    </html>