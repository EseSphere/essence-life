<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Music Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
        }

        h2 {
            margin-top: 20px;
        }

        ul {
            list-style: none;
            padding-left: 0;
        }

        li {
            margin: 5px 0;
            cursor: pointer;
        }

        li:hover {
            color: blue;
        }

        .song {
            margin-left: 20px;
        }
    </style>
</head>

<body>
    <h1>Music Dashboard</h1>
    <div>
        <h2>Categories</h2>
        <ul id="categoriesList"></ul>
    </div>

    <div>
        <h2>Subcategories</h2>
        <ul id="subcategoriesList"></ul>
    </div>

    <div>
        <h2>Songs</h2>
        <ul id="songsList"></ul>
    </div>

    <script>
        // DOM elements
        const categoriesList = document.getElementById("categoriesList");
        const subcategoriesList = document.getElementById("subcategoriesList");
        const songsList = document.getElementById("songsList");

        // Open (or create) the database
        function initDB() {
            return new Promise((resolve, reject) => {
                const request = indexedDB.open("MusicDB", 1);

                request.onupgradeneeded = function(event) {
                    const db = event.target.result;

                    // Create object store for categories
                    const categoryStore = db.createObjectStore("categories", {
                        keyPath: "id",
                        autoIncrement: true
                    });
                    categoryStore.createIndex("name", "name", {
                        unique: true
                    });

                    // Create object store for songs
                    const songStore = db.createObjectStore("songs", {
                        keyPath: "id",
                        autoIncrement: true
                    });
                    songStore.createIndex("subcategory", "subcategory", {
                        unique: false
                    });
                    songStore.createIndex("category", "category", {
                        unique: false
                    });

                    // Define categories and subcategories
                    const categories = [{
                            name: "Home",
                            subcategories: ["Music", "Soundscapes", "Sleep Stories", "Meditations", "Movement"]
                        },
                        {
                            name: "Meditate",
                            subcategories: ["Featured", "Quick & Easy", "Sleep Better", "Coping With Anxiety", "For Beginners", "Mindfulness at Work", "Series", "Practice Tips with Tamara", "Find Your Calm"]
                        },
                        {
                            name: "Sleep",
                            subcategories: ["Featured", "Popular Sleep Stories", "Celebrated Voices", "Sleep Stories for Kids", "Trains", "Fiction Sleep Stories", "Non-Fiction Sleep Stories", "Nature Stories", "Refreshing Nap Stories", "Travel", "ASMR Stories"]
                        },
                        {
                            name: "Music",
                            subcategories: ["Featured", "Bilateral Stimulation", "Focus & Flow", "Uplift", "Piano", "Ambient & Atmospheric", "Electronic", "Classical & Strings", "Soundscapes", "New Releases"]
                        },
                        {
                            name: "For Work",
                            subcategories: ["Professional Growth", "Quick Breaks", "Managing Overwhelm", "Get Focused", "Navigating Relationships", "Work Life Balance", "Confidence and Self-Compassion", "Mindset and Motivation", "Music", "Soundscapes", "Group Exercises", "Movement", "Resources"]
                        },
                        {
                            name: "Wisdom",
                            subcategories: ["Featured", "Popular Daily Jay", "Series", "Calm Conversations", "Inspiring Stories", "Seize the Day", "The Spark"]
                        },
                        {
                            name: "Calm Kids",
                            subcategories: ["Favorite Characters", "The Classics", "Sleep Stories for Kids", "Mindfulness Programs for Kids", "Lullabies", "Soundscapes", "Nap Time", "Movement"]
                        },
                        {
                            name: "Movement",
                            subcategories: ["Featured", "Afternoon Boost", "Recent Daily Moves", "Start Here", "For Work"]
                        }
                    ];

                    // Add categories
                    categories.forEach(category => categoryStore.add(category));

                    // Add sample songs
                    categories.forEach(category => {
                        category.subcategories.forEach(sub => {
                            songStore.add({
                                category: category.name,
                                subcategory: sub,
                                title: `${sub} Song 1`,
                                artist: "Artist A",
                                duration: "3:30"
                            });
                            songStore.add({
                                category: category.name,
                                subcategory: sub,
                                title: `${sub} Song 2`,
                                artist: "Artist B",
                                duration: "4:00"
                            });
                        });
                    });
                };

                request.onsuccess = e => resolve(e.target.result);
                request.onerror = e => reject(e.target.errorCode);
            });
        }

        // Fetch all categories
        async function getAllCategories(db) {
            return new Promise((resolve, reject) => {
                const transaction = db.transaction("categories", "readonly");
                const store = transaction.objectStore("categories");
                const request = store.getAll();
                request.onsuccess = () => resolve(request.result);
                request.onerror = () => reject(request.error);
            });
        }

        // Fetch songs by subcategory
        async function getSongsBySubcategory(db, subcategoryName) {
            return new Promise((resolve, reject) => {
                const transaction = db.transaction("songs", "readonly");
                const store = transaction.objectStore("songs");
                const index = store.index("subcategory");
                const request = index.getAll(subcategoryName);
                request.onsuccess = () => resolve(request.result);
                request.onerror = () => reject(request.error);
            });
        }

        // Show subcategories
        function showSubcategories(category) {
            subcategoriesList.innerHTML = "";
            songsList.innerHTML = "";
            category.subcategories.forEach(sub => {
                const li = document.createElement("li");
                li.textContent = sub;
                li.onclick = () => showSongs(sub);
                subcategoriesList.appendChild(li);
            });
        }

        // Show songs
        function showSongs(subcategory) {
            songsList.innerHTML = "";
            dbPromise.then(db => {
                getSongsBySubcategory(db, subcategory).then(songs => {
                    songs.forEach(song => {
                        const li = document.createElement("li");
                        li.classList.add("song");
                        li.textContent = `${song.title} - ${song.artist} (${song.duration})`;
                        songsList.appendChild(li);
                    });
                });
            });
        }

        // Initialize DB and load categories
        let dbPromise = initDB();
        dbPromise.then(db => {
            getAllCategories(db).then(categories => {
                categories.forEach(cat => {
                    const li = document.createElement("li");
                    li.textContent = cat.name;
                    li.onclick = () => showSubcategories(cat);
                    categoriesList.appendChild(li);
                });
            });
        }).catch(err => console.error("DB init failed:", err));
    </script>
</body>

</html>