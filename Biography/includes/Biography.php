<?php
    session_start();
    include "Biography_db.php";
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    $conn = getConnection();
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $ip = $_SERVER['REMOTE_ADDR'];
    $user_agent = $_SERVER['HTTP_USER_AGENT'];
    $page_url = $_SERVER['REQUEST_URI'];
    $sql = "INSERT INTO Visits (ip_address, page_url, user_agent) VALUES ('$ip', '$page_url', '$user_agent')";
    $conn->query($sql);

    $visit = $conn->query("SELECT COUNT(*) AS count FROM Visits")->fetch_assoc()['count'];

    $person = $conn->query("SELECT * FROM Person LIMIT 1")->fetch_assoc();
    $person_id = $person['person_id'];

    $education = $conn->query("SELECT * FROM Education WHERE person_id = $person_id");
    $career = $conn->query("SELECT * FROM Career WHERE person_id = $person_id");
    $research = $conn->query("SELECT * FROM Research WHERE person_id = $person_id");
    $awards = $conn->query("SELECT * FROM Awards WHERE person_id = $person_id");
    $works = $conn->query("SELECT * FROM Works WHERE person_id = $person_id");
    $gallery = $conn->query("SELECT * FROM Gallery WHERE person_id = $person_id");
    $references = $conn->query("SELECT * FROM `References` WHERE person_id = $person_id");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Marie Curie Biography</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <link rel="stylesheet" type="text/css" href="../assets/css/style.php">

</head>
<body>
    <header>
        <div id="visit-count">Visits: <?php echo $visit_count; ?></div>

        <div class="header-container1">
            <ul class="list-header1">
                <li class="logo-header"><a href="../public/index.php">
                    <img id="logo" src="../assets/images/Logo.jpg" alt="Marie Curie Logo">
                </a></li>
                <li>
                    <h1>Marie Curie - Pioneer of Radioactivity</h1>
                </li>
                <li id="search-header" class="header-empty">
                    <form action="../includes/search-product.php" method="GET" class="search-container">
                        <input type="text" name="query" class="search" placeholder="Search" required>
                        <i class="bi bi-search"></i>
                        <button type="submit" class="search-button">Search</button>
                    </form>
                </li>
            </ul>
        </div>
        <div class="header-container2">
        <ul class="menu">
            <li class="brand">
                <a href="../includes/Biography.php">Biography</a>
                    <ul class="submenu">
                        
                    </ul>
            </li>
            <li class="brand">
                <a href="../includes/Research.php">Research</a>
                    <ul class="submenu">

                    </ul>
            </li>
            <li class="brand">
                <a href="../includes/Awards.php">Awards and Honors</a>
                    <ul class="submenu">
                        
                    </ul>
            </li>
            <li class="brand">
                <a href="../includes/Works.php">Selected Works</a>
                    <ul class="submenu">

                    </ul>
            </li>
            <li class="brand">
                <a href="../includes/References.php">References</a>
                    <ul class="submenu">

                    </ul>
            </li>
            <li class="brand">
                <a href="../includes/Sitemap.php">Site Map</a>
                    <ul class="submenu">

                    </ul>
            </li>
        </ul>
        </div>
    </header>

    <main>
        <section id="biography" >
            <h2>Biography</h2>
            <p><?php echo $person['biography']; ?></p>
            <h3>Education</h3>
            <ul>
                <?php while($row = $education->fetch_assoc()) { ?>
                    <li><?php echo $row['institution'] . " (" . $row['start_year'] . "-" . $row['end_year'] . "): " . $row['degree'] . " in " . $row['field'] . " - " . $row['description']; ?></li>
                <?php } ?>
            </ul>
            <h3>Career and Challenges</h3>
            <div class="timeline">
                <?php $i = 0; while($row = $career->fetch_assoc()) { $side = ($i % 2 == 0) ? 'left' : 'right'; ?>
                    <div class="container <?php echo $side; ?>">
                        <div class="content">
                            <h4><?php echo $row['title'] . " at " . $row['organization'] . " (" . $row['start_year'] . "-" . $row['end_year'] . ")"; ?></h4>
                            <p><?php echo $row['description']; ?></p>
                            <?php if ($row['is_challenge']) echo "<p><strong>Challenge:</strong> Overcame difficulties in this role.</p>"; ?>
                        </div>
                    </div>
                <?php $i++; } ?>
            </div>
            <h3>Gallery</h3>
            <div class="gallery">
                <?php while($row = $gallery->fetch_assoc()) { ?>
                    <img src="<?php echo $row['image_url']; ?>" alt="<?php echo $row['caption']; ?>">
                <?php } ?>
            </div>
        </section>
        <section id="research">
            <h2>Research</h2>
            <ul>
                <?php while($row = $research->fetch_assoc()) { ?>
                    <li><?php echo $row['title'] . " (" . $row['year'] . "): " . $row['description']; if ($row['is_nobel_related']) echo " (Nobel-related)"; ?></li>
                <?php } ?>
            </ul>
        </section>
        <section id="awards">
            <h2>Awards and Honors</h2>
            <ul>
                <?php while($row = $awards->fetch_assoc()) { ?>
                    <li><?php echo $row['award_name'] . " (" . $row['year'] . ") from " . $row['organization'] . ": " . $row['description']; ?></li>
                <?php } ?>
            </ul>
        </section>
        <section id="works">
            <h2>Selected Works</h2>
            <ul>
                <?php while($row = $works->fetch_assoc()) { ?>
                    <li><?php echo $row['title'] . " (" . $row['type'] . ", " . $row['publication_year'] . "): " . $row['description']; if ($row['link']) echo " <a href='{$row['link']}'>Link</a>"; ?></li>
                <?php } ?>
            </ul>
        </section>
        <section id="references">
            <h2>References</h2>
            <ul>
                <?php while($row = $references->fetch_assoc()) { ?>
                    <li><?php echo $row['title'] . " - " . $row['source'] . ": <a href='{$row['link']}'>{$row['link']}</a> - " . $row['description']; ?></li>
                <?php } ?>
            </ul>
        </section>
        <section id="sitemap">
            <h2>Site Map</h2>
            <ul>
                <li><a href="Biography.php">Biography</a></li>
                <li><a href="Research.php">Research</a></li>
                <li><a href="Awards.php">Awards and Honors</a></li>
                <li><a href="Works.php">Selected Works</a></li>
                <li><a href="References.php">References</a></li>
                <li><a href="Sitemap.php">Site Map</a></li>
            </ul>
        </section>
    </main>
    <div id="ticker">
        <span id="ticker-text"></span>
    </div>
    <script>
        const sections = document.querySelectorAll('section');
        const links = document.querySelectorAll('nav a');
        function showSection(id) {
            sections.forEach(sec => sec.classList.remove('active'));
            document.querySelector(id).classList.add('active');
            links.forEach(link => link.classList.remove('active'));
            document.querySelector(`a[href="${id}"]`).classList.add('active');
        }
        links.forEach(link => {
            link.addEventListener('click', (e) => {
                e.preventDefault();
                const id = link.getAttribute('href');
                showSection(id);
                history.pushState(null, null, id);
            });
        });
        window.addEventListener('popstate', () => {
            showSection(window.location.hash || '#biography');
        });
        showSection(window.location.hash || '#biography');

        sections.forEach(sec => {
            sec.style.transition = 'opacity 0.5s';
            sec.style.opacity = 0;
        });
        const activeSec = document.querySelector('section.active');
        if (activeSec) activeSec.style.opacity = 1;

        function updateTicker() {
            const now = new Date();
            const dateTime = now.toLocaleString('en-US', { timeZone: 'Asia/Ho_Chi_Minh' }); // Adjusted for +07
            let location = 'Location: Unknown';
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(pos => {
                    location = `Location: Lat ${pos.coords.latitude.toFixed(2)}, Long ${pos.coords.longitude.toFixed(2)}`;
                    document.getElementById('ticker-text').textContent = `${dateTime} - ${location}   `;
                }, () => {
                    document.getElementById('ticker-text').textContent = `${dateTime} - ${location}   `;
                });
            } else {
                document.getElementById('ticker-text').textContent = `${dateTime} - ${location}   `;
            }
        }
        updateTicker();
        setInterval(updateTicker, 1000);
    </script>
</body>
</html>

<?php
$conn->close();

?>
