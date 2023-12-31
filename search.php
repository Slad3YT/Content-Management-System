<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="searchstyle.css">
    <title>Search Results - LearnLoom</title>
</head>

<body>

    <nav>
        <h2 class="logo"><a href="index.php"><i>LearnLoom</i></a></h2>
        <div>
            <ul>
                <li><a href="add.php">ADD</a></li>
                <li>About Us</li>
                <li>Contact</li>
            </ul>

        </div>
    </nav>

    <div class="content">
        <section class="search-results">
            <form action="search.php" class="search-form" method="GET">
                <input type="text" name="search_query" class="search-input" placeholder="Search...">
                <button type="submit" class="search-button">Search</button>
            </form>
            <br>
            <h2>Search Results</h2>
            <?php
            $conn = mysqli_connect('localhost', 'tshepiso', '123456', 'cms_db');
            if (!$conn) {
                echo 'Connection error: ' . mysqli_connect_error();
            }

            if ($_SERVER["REQUEST_METHOD"] === "GET" && isset($_GET['search_query'])) {
                $searchQuery = $_GET['search_query'];
                $sql = "SELECT * FROM cms_tb WHERE title LIKE '%$searchQuery%' OR content LIKE '%$searchQuery%'";


                $result = $conn->query($sql);

                if ($result) {
                    if ($result->num_rows > 0) {

                        echo '<br>';
                        echo '<h3 class="closest-results">The closest results to ' . $searchQuery . '</h3>';
                        echo '<br>';
                        echo '<br>';
                        while ($row = $result->fetch_assoc()) {

                            echo '<div>';

                            echo '<h3>' . htmlspecialchars($row['title']) . '</h3>';
                            echo '<p>' . htmlspecialchars($row['content']) . '</p>';
                            echo '</div>';
                        }

                        echo '<div class="refine-search">';
                        echo '<h3>Refine Your Search</h3>';
                        echo '<form action="refine_search.php" method="GET">';
                        echo '<input type="text" name="refine_query" placeholder="Refine your search...">';
                        echo '<button type="submit">Refine</button>';
                        echo '</form>';
                        echo '</div>';
                    } else {
                        echo "No results found.";
                    }
                } else {
                    echo "Query failed: " . $conn->error; // Display the SQL error, if any
                }
            }

            ?>
        </section>
    </div>

    <footer>
        <div class="footer-content">
            <p>&copy; 2023 LearnLoom. All rights reserved.</p>
            <ul class="footer-links">
                <li><a href="#">Privacy Policy</a></li>
                <li><a href="#">Terms of Use</a></li>
                <li><a href="#">Contact Us</a></li>
            </ul>
        </div>
    </footer>
</body>

</html>