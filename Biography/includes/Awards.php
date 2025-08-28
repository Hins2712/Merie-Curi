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

    $visit_count = $conn->query("SELECT COUNT(*) AS count FROM Visits")->fetch_assoc()['count'];

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
</body>
</html>