<?php include 'header.php'; ?>

<div class="app-header"></div>
<div class="container text-center alert alert-success">
    <h4 class="display-4 font-weight-bold">Essence – Life, <br><small>Meditate & Relax</small></h4>
    <p class="lead">Discover inner peace with guided meditations, calming music, and sleep stories.</p>
</div>

<div class="container-fluid">
    <div class="w-full flex justify-start items-start text-start mt-2">
        <h4 class="font-bold text-white" id="greeting"></h4>
        <p class="text-white">Recently Added</p>
    </div>
    <hr>
    <!-- Music Category -->
    <div id="categoriesContainer">
        <div class="category-row">
            <div class="category-title w-100 justify-start items-flex-start text-start">Music
                <p class="fs-6 text-start">Discover songs in a real way to go</p>
            </div>
            <div class="slider">
                <div class="song-item"
                    data-src="https://www.soundhelix.com/examples/mp3/SoundHelix-Song-1.mp3"
                    data-title="Acoustic Sunrise"
                    data-img="https://images.unsplash.com/photo-1507874457470-272b3c8d8ee2?w=400">
                    <img src="https://images.unsplash.com/photo-1507874457470-272b3c8d8ee2?w=400">
                    <p>Acoustic Sunrise <br><span style="font-size: 13px;">Song - Frank Hugin</span></p>
                </div>
            </div>
        </div>

        <div class="category-row">
            <div class="category-title w-100 justify-start items-flex-start text-start">Meditation
                <p class="fs-6 text-start">Experience more meditations in a different way</p>
            </div>
            <div class="slider">
                <div class="song-item"
                    data-src="https://www.soundhelix.com/examples/mp3/SoundHelix-Song-1.mp3"
                    data-title="Acoustic Sunrise"
                    data-img="https://images.unsplash.com/photo-1507874457470-272b3c8d8ee2?w=400">
                    <img src="https://images.unsplash.com/photo-1507874457470-272b3c8d8ee2?w=400">
                    <p>Acoustic Sunrise <br><span style="font-size: 13px;">Meditation - Frank Hugin</span></p>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>