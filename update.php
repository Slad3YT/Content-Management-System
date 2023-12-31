<?php
$conn = mysqli_connect('localhost', 'tshepiso', '123456', 'cms_db');

if (!$conn) {
    echo 'Connection error: ' . mysqli_connect_error();
}

function updateArticle($id, $title, $content)
{
    global $conn;
    $title = mysqli_real_escape_string($conn, $title);
    $content = mysqli_real_escape_string($conn, $content);
    $currentTimestamp = date("Y-m-d H:i:s");

    $sql = "UPDATE cms_tb SET title='$title', content='$content', updated_at='$currentTimestamp' WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        echo "Article updated successfully";
        return true;
    } else {
        echo "Error: " . $conn->error;
        return false;
    }
}

if ($_SERVER["REQUEST_METHOD"] === "GET" && isset($_GET['article_id'])) {
    $id = $_GET['article_id'];

    $sql = "SELECT * FROM cms_tb WHERE id=$id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $article = $result->fetch_assoc();
        $title = $article['title'];
        $content = $article['content'];
    } else {
        echo "Article not found.";
    }
}

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['submit'])) {
    $id = $_POST['article_id'];
    $newTitle = $_POST['title'];
    $newContent = $_POST['content'];

    updateArticle($id, $newTitle, $newContent);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="addstyle.css">
    <title>LearnLoom</title>
</head>

<body>
<nav>

<h2 class="logo"><a href="index.php"><i>LearnLoom</i></a></h2>
<div>
    <ul>
        
        <li>About Us</li>
        <li>Contact</li>
    </ul>

</div>
</nav>

    <br>
    <br>

    <form action="update.php" method="post">
        <h1>Update article</h1>
        <br>

        <label for="title">Title: </label>
        <input type="text" name="title" id="title" value="<?php echo isset($title) ? htmlspecialchars($title) : ''; ?>"><br><br>
        <label for="content">Content: </label>
        <input type="text" name="content" id="content" value="<?php echo isset($content) ? htmlspecialchars($content) : ''; ?>">
        <br>
        <br>
        <input type="hidden" name="article_id" value="<?php echo isset($_GET['article_id']) ? $_GET['article_id'] : ''; ?>">
        <input class="button" type="submit" name="submit" value="Update">

        <a href="index.php" class="button">Back to Home</a>
    </form>

    
</body>

</html>
