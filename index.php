<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="STYLE.CSS">
    <title>Document</title>
</head>

<body>

    <div class="content">
        <nav>

            <h2 class="logo"><a href="index.php"><i>LearnLoom</i></a></h2>
            <div>
                <ul>
                    <a class="link" href="add.php">
                        <li>ADD</li>
                    </a>
                    <li>About Us</li>
                    <li>Contact</li>
                </ul>

            </div>
        </nav>

        <section class="welcome-section">
            <div class="flex">
                <div>
                    <h1 class="main-heading">Welcome to LearnLoom</h1>
                    
                    <p class="main-content">Empower your knowledge with our wide range of courses and educational resources. Dive into a world of learning and discover new horizons to expand your skills and expertise.</p>
                    
                    <h5 class="updated-at">Updated at: January 1, 2023</h5>
                    <a class="footer-link" href="#">Privacy Policy</a>
                </div>
            </div>
        </section>

        <?php

        $conn = mysqli_connect('localhost', 'tshepiso', '123456', 'cms_db');

        if (!$conn) {
            echo 'Connection error: ' . mysqli_connect_error();
        }

        // Read (Select)
        function getAllArticles()
        {
            global $conn;
            $sql = "SELECT * FROM cms_tb";
            $result = $conn->query($sql);
            $articles = array();
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $articles[] = $row;
                }
            }
            return $articles;
        }

        $articles = getAllArticles(); // Assuming this function fetches articles from the database


        // Delete
        function deleteArticle($id)
        {
            global $conn;
            $sql = "DELETE FROM cms_tb WHERE id=$id";
            if ($conn->query($sql) === TRUE) {
                return true;
            } else {
                return false;
            }
        }

        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            if (isset($_POST['delete'])) {
                $articleIdToDelete = $_POST['article_id'];
                deleteArticle($articleIdToDelete);
                // Refresh the page or redirect to update the displayed articles
                header("Location: {$_SERVER['PHP_SELF']}");
                exit();
            }
        }

        // // Check if there are articles in the array

        if (!empty($articles)) {
            echo '<div class="flex">';
            foreach ($articles as $article) {
                echo '<div>';
                echo '<br>';
                echo '<h1>' . htmlspecialchars($article['title']) . '</h1>';
                echo '<br>';
                echo '<p>' . htmlspecialchars($article['content']) . '</p>';
                echo '<br>';
                echo '<h4>' . "Created at: " . htmlspecialchars($article['created_at']) . '</h4>';
                echo '<br>';
                echo '<h4>' . "Updated at: " . htmlspecialchars($article['created_at']) . '</h4>';
                echo '<br>';

                // Update button directing to update.php
                echo '<form method="get" action="update.php">';
                echo '<input type="hidden" name="article_id" value="' . $article['id'] . '">';
                echo '<button type="submit" name="update">UPDATE</button>';
                echo '</form>';

                // Form for delete button with hidden input for article ID
                echo '<form method="post">';
                echo '<input type="hidden" name="article_id" value="' . $article['id'] . '">';
                echo '<button type="submit" name="delete">DELETE</button>';
                echo '</form>';
                echo '<br>';
                echo '<hr>';
                echo '</div>';
            }
            echo '</div>';
        } else {
            echo "No articles found.";
        }
        ?>
    </div>
    
    <div class="explore-section">
        <h2>Explore More</h2>
        <p>Check out our other categories for more interesting content!</p>
        <a href="search.php" class="button">Explore Categories</a>
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