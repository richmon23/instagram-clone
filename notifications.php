<?php
include_once 'connect.php';
$username = $_GET['username'];

// Mark notifications as seen
$updateNotifications = "UPDATE notifications SET seen = 1 WHERE username = '$username'";
mysqli_query($conn, $updateNotifications);

// Fetch notifications
$notificationQuery = "SELECT * FROM notifications WHERE username = '$username' ORDER BY created_at DESC";
$notificationResult = mysqli_query($conn, $notificationQuery);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Notifications | Instaclone</title>
    <link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <nav>
        <!-- Your navigation code here -->
    </nav>
    <main>
        <center>
            <h1>Notifications</h1>
            <ul>
                <?php
                while ($notification = mysqli_fetch_assoc($notificationResult)) {
                    $post_id = $notification['post_id'];
                    $type = $notification['type'];
                    $triggered_by = $notification['triggered_by'];
                    $created_at = $notification['created_at'];
                    
                    echo "<li><a href='image-detail.php?post_id=$post_id&curr_us=$username'>$triggered_by $type your post at $created_at</a></li>";
                }
                ?>
            </ul>
        </center>
    </main>
</body>
</html>
