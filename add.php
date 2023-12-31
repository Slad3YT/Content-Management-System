<?php
$conn = mysqli_connect('localhost', 'tshepiso', '123456', 'cms_db');

if (!$conn) {
    echo 'Connection error: ' . mysqli_connect_error();
}

// Create (insert)
function createArticle($title, $content)
{
    global $conn;

    $title = mysqli_real_escape_string($conn, $title);
    $content = mysqli_real_escape_string($conn, $content);

    $sql = "INSERT INTO cms_tb (title, content) VALUES ('$title', '$content')";

    if (!mysqli_query($conn, $sql)) {
        echo 'query error: ' . mysqli_error($conn);
    }else {
        header("Location: index.php");  
        exit();
    }
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $title = $_POST['title'];
    $content = $_POST['content'];

    // Check if both title and content are not empty before creating the article
    if (!empty($title) && !empty($content)) {
        createArticle($title, $content);
    } else {
        echo "Please fill in both title and content fields.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
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

    <form action="add.php" method="post">
        <h1>Add a new article</h1>
        <br>

        <label for="title">Title: </label>
        <input type="text" name="title" id="title"><br><br>
        <label for="content">Content: </label>
        <input type="text" name="content" id="content">
        <br>
        <br>
        <input class="button" type="submit" value="Submit">
        <a href="index.php" class="button">Back to Home</a>
    </form>
</body>

</html>
