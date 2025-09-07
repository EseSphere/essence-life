<?php include 'header.php'; ?>

<div class="container-fluid">
    <div class="w-full flex justify-start items-start text-start mt-2">
        <h4 class="font-bold text-white" id="greeting"></h4>
        <p class="text-white">Recently Added</p>
    </div>
    <hr>
    <!-- Music Category -->
    <div id="categoriesContainer">
        <div class="category-row">
            <!--<div class="category-title">Music</div>-->
            <div class="slider mt-5">
                <div class="song-item"
                    data-src="https://www.soundhelix.com/examples/mp3/SoundHelix-Song-1.mp3"
                    data-title="Acoustic Sunrise"
                    data-img="https://images.unsplash.com/photo-1507874457470-272b3c8d8ee2?w=400">
                    <img src="https://images.unsplash.com/photo-1507874457470-272b3c8d8ee2?w=400">
                    <p>Acoustic Sunrise <br><span style="font-size: 13px;">Meditation - Frank Hugin</span></p>
                </div>
                <div class="song-item"
                    data-src="https://www.soundhelix.com/examples/mp3/SoundHelix-Song-2.mp3"
                    data-title="City Nights"
                    data-img="https://imageio.forbes.com/specials-images/imageserve/66a26836115f811da8d2554e/Dubai-marina-at-night/960x0.jpg?height=474&width=711&fit=bounds">
                    <img
                        src="https://imageio.forbes.com/specials-images/imageserve/66a26836115f811da8d2554e/Dubai-marina-at-night/960x0.jpg?height=474&width=711&fit=bounds">
                    <p>City Nights <br><span style="font-size: 13px;">Meditation - Frank Hugin</span></p>
                </div>
                <div class="song-item"
                    data-src="https://www.soundhelix.com/examples/mp3/SoundHelix-Song-3.mp3"
                    data-title="Ocean Waves"
                    data-img="https://images.unsplash.com/photo-1507525428034-b723cf961d3e?w=400">
                    <img src="https://images.unsplash.com/photo-1507525428034-b723cf961d3e?w=400">
                    <p>Ocean Waves <br><span style="font-size: 13px;">Sleep - Frank Hugin</span></p>
                </div>
                <div class="song-item"
                    data-src="https://www.soundhelix.com/examples/mp3/SoundHelix-Song-4.mp3"
                    data-title="Mountain Echoes"
                    data-img="https://images.unsplash.com/photo-1501785888041-af3ef285b470?w=400">
                    <img src="https://images.unsplash.com/photo-1501785888041-af3ef285b470?w=400">
                    <p>Mountain Echoes <br><span style="font-size: 13px;">Wisdom - Frank Hugin</span></p>
                </div>
                <div class="song-item"
                    data-src="https://www.soundhelix.com/examples/mp3/SoundHelix-Song-5.mp3"
                    data-title="Calm Breeze"
                    data-img="https://images.unsplash.com/photo-1470229722913-7c0e2dbbafd3?w=400">
                    <img src="https://images.unsplash.com/photo-1470229722913-7c0e2dbbafd3?w=400">
                    <p>Calm Breeze <br><span style="font-size: 13px;">Meditation - Frank Hugin</span></p>
                </div>
                <div class="song-item"
                    data-src="https://www.soundhelix.com/examples/mp3/SoundHelix-Song-6.mp3"
                    data-title="Evening Jazz"
                    data-img="https://images.unsplash.com/photo-1511671782779-c97d3d27a1d4?w=400">
                    <img src="https://images.unsplash.com/photo-1511671782779-c97d3d27a1d4?w=400">
                    <p>Evening Jazz <br><span style="font-size: 13px;">Meditation - Frank Hugin</span></p>
                </div>
            </div>

        </div>
    </div>
</div>

<?php include 'footer.php'; ?>