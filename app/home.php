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
        <?php
        // Database connection
        $mysqli = new mysqli("localhost", "root", "", "essence_life");
        if ($mysqli->connect_error) {
            die("Connection failed: " . $mysqli->connect_error);
        }

        // Fetch all contents grouped by category
        $sql = "SELECT * FROM contents ORDER BY content_type, id";
        $result = $mysqli->query($sql);

        // Organize data by content_type
        $categories = [];
        while ($row = $result->fetch_assoc()) {
            $categories[$row['content_type']][] = $row;
        }

        // Category descriptions (optional)
        $category_descriptions = [
            'song' => 'Discover relaxing and inspiring tracks to lift your mood and energize your day.',
            'meditation' => 'Calm your mind with soothing tracks designed for meditation, mindfulness, and relaxation.',
            'sleep' => 'Sleep better with calming sounds and peaceful melodies.',
            'story' => 'Engaging stories to entertain and inspire.',
            'motivation' => 'Boost your motivation and productivity with uplifting content.',
            'wisdom' => 'Listen to wise thoughts and guidance to enrich your life.',
            'relaxation' => 'Relax and unwind with peaceful audio tracks.'
        ];

        // Generate HTML
        foreach ($categories as $type => $items) {
            echo '<div class="category-row">';
            echo '<div class="category-title w-100 flex justify-start items-start text-start">' . ucfirst($type);
            if (isset($category_descriptions[$type])) {
                echo '<p class="fw-semibold fs-6">' . $category_descriptions[$type] . '</p>';
            }
            echo '</div>';
            echo '<div class="slider">';
            foreach ($items as $item) {
                echo '<div class="song-item" data-src="' . $item['content_url'] . '" data-title="' . $item['content_name'] . '" data-img="' . $item['image_url'] . '">';
                echo '<img src="' . $item['image_url'] . '">';
                echo '<p>' . $item['content_name'] . ' <br><span style="font-size: 13px;">' . $item['description'] . '</span></p>';
                echo '</div>';
            }
            echo '</div>'; // slider
            echo '</div>'; // category-row
        }

        $mysqli->close();
        ?>
    </div>
</div>

<?php include 'footer.php'; ?>