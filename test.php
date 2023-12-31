<?php
// Include your function and establish database connection
include 'index.php'; // Replace with the actual filename

// Test data for creating an article
$testTitle = "Test Article Title";
$testContent = "This is a test article content.";

// Call the createArticle function
$articleCreated = createArticle($testTitle, $testContent);

if ($articleCreated) {
    echo "Article created successfully!";
} else {
    echo "Failed to create the article.";
}
?>
