<?php
// index.php (Homepage)
session_start();
include 'db.php';  // For checking login, featured content
 
// Fetch featured content (e.g., latest or random)
$stmt = $pdo->query("SELECT * FROM content ORDER BY RAND() LIMIT 5");
$featured = $stmt->fetchAll(PDO::FETCH_ASSOC);
 
// Fetch trending (e.g., based on views, but for simplicity, random)
$stmt = $pdo->query("SELECT * FROM content ORDER BY RAND() LIMIT 10");
$trending = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Netflix Clone - Home</title>
    <style>
        /* Amazing Netflix-like CSS: Black background, red accents, modern fonts */
        body { background-color: #141414; color: #fff; font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; margin: 0; padding: 0; }
        header { background: #000; padding: 20px; display: flex; justify-content: space-between; align-items: center; }
        .logo { color: #E50914; font-size: 2em; font-weight: bold; }
        nav a { color: #fff; margin: 0 15px; text-decoration: none; }
        .carousel { position: relative; height: 500px; overflow: hidden; }
        .carousel img { width: 100%; height: 100%; object-fit: cover; position: absolute; top: 0; left: 0; opacity: 0; transition: opacity 1s; }
        .carousel img.active { opacity: 1; }
        .content-section { padding: 20px; }
        .row { display: flex; overflow-x: auto; }
        .item { margin: 10px; width: 200px; cursor: pointer; }
        .item img { width: 100%; border-radius: 5px; }
        .item h3 { font-size: 1em; }
        /* Responsive */
        @media (max-width: 768px) { .carousel { height: 300px; } .item { width: 150px; } }
    </style>
</head>
<body>
    <header>
        <div class="logo">NETFLIX CLONE</div>
        <nav>
            <a href="index.php">Home</a>
            <a href="search.php">Search</a>
            <a href="watchlist.php">Watchlist</a>
            <?php if (isset($_SESSION['user_id'])): ?>
                <a href="profile.php">Profile</a>
                <a href="#" onclick="logout()">Logout</a>
            <?php else: ?>
                <a href="login.php">Login</a>
                <a href="signup.php">Signup</a>
            <?php endif; ?>
        </nav>
    </header>
    <section class="carousel">
        <?php foreach ($featured as $index => $item): ?>
            <img src="<?php echo $item['poster_url']; ?>" alt="<?php echo $item['title']; ?>" class="<?php echo $index === 0 ? 'active' : ''; ?>">
        <?php endforeach; ?>
    </section>
    <section class="content-section">
        <h2>Trending</h2>
        <div class="row">
            <?php foreach ($trending as $item): ?>
                <div class="item" onclick="location.href='watch.php?id=<?php echo $item['id']; ?>'">
                    <img src="<?php echo $item['poster_url']; ?>" alt="<?php echo $item['title']; ?>">
                    <h3><?php echo $item['title']; ?></h3>
                </div>
            <?php endforeach; ?>
        </div>
    </section>
    <script>
        // Carousel JS
        let current = 0;
        const images = document.querySelectorAll('.carousel img');
        setInterval(() => {
            images[current].classList.remove('active');
            current = (current + 1) % images.length;
            images[current].classList.add('active');
        }, 5000);
 
        // Logout function with JS redirect
        function logout() {
            fetch('logout.php', { method: 'POST' })
                .then(() => location.href = 'index.php');
        }
    </script>
</body>
</html>
