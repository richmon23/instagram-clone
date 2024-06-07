<?php
include_once 'connect.php';

// Check if POST and GET parameters exist
$missing_params = [];

if (!isset($_POST['comment'])) {
    $missing_params[] = 'comment';
} else {
    $comment = $_POST['comment'];
}

if (!isset($_GET['post_id'])) {
    $missing_params[] = 'post_id';
} else {
    $post_id = $_GET['post_id'];
}

if (!isset($_GET['username'])) {
    $missing_params[] = 'username';
} else {
    $username = $_GET['username'];
}

if (!isset($_GET['return_to'])) {
    $missing_params[] = 'return_to';
} else {
    $return_to = $_GET['return_to'];
}

if (!empty($missing_params)) {
    echo "Error: Missing required parameters: " . implode(", ", $missing_params);
    exit();
}

// Check if comment is not empty
if (!empty($comment)) {
    // Ensure post_id exists in the posts table
    $post_check = mysqli_query($conn, "SELECT post_id FROM posts WHERE post_id = '$post_id'");
    if (mysqli_num_rows($post_check) > 0) {
        // Insert comment into the comments table
        $result = mysqli_query($conn, "INSERT INTO comments(commentername, post_id, comment_text) VALUES ('$username', '$post_id', '$comment')");

        // Update comments count in the posts table
        $increment_comments = mysqli_query($conn, "UPDATE posts SET comments = comments + 1 WHERE post_id = '$post_id'");
    } else {
        // Handle the case where post_id does not exist
        echo "Error: Post does not exist.";
        exit();
    }
}

// Redirect based on return_to parameter
if ($return_to == "feed") {
    header("Location: feed.php?username=$username");
} else {
    header("Location: image-detail.php?post_id=$post_id&curr_us=$username");
}
exit();
?>
