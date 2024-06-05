<?php
    $post_id = $_GET['post_id'];
    $curr_us = $_GET['curr_us'];
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Image Detail | Instaclone</title>
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
        <link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon">
        <link href="css/style.css" rel="stylesheet">
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
         <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
         
            <style>
                * {
                box-sizing: border-box;
                }

                /* Create two equal columns that floats next to each other */
                .column {
                float: left;
                width: 600px;
                padding: 10px;
                height: 550px; /* Should be removed. Only for demonstration */
                border: 1px ; 
                background-color:#ffffff;
                }

                /* Clear floats after the columns */
                .row:after {
                content: "";
                display: table;
                clear: both;
                }
                .vertical-center {
                margin: 0;
                position: absolute;
                top: 50%;
                -ms-transform: translateY(-50%);
                transform: translateY(-50%);
                }
                </style>
        </head>
    <body>
        <nav class="navigation">
            <a href="feed.php?username=<?php echo $curr_us?>">
                <img 
                    src="images/instagram.png"
                    alt="logo"
                    title="logo"
                    class="navigation__logo"
                />
            </a>
            <div class="navigation__icons">
                <a href="explore.html" class="navigation__link">
                    <i class="fa fa-compass"></i>
                </a>
                <a href="#" class="navigation__link">
                    <i class="fa fa-heart-o"></i>
                </a>
                <a href="profile.php" class="navigation__link">
                    <i class="fa fa-user-o"></i>
                </a>
            </div>
        </nav>
        <?php
    include_once 'connect.php';

    $post_id = $_GET['post_id'];
    $curr_us = $_GET['curr_us'];

    // Fetch post details
    $result = mysqli_query($conn, "SELECT
                                        username,
                                        photo,
                                        comments,
                                        datediff(now(), time_stamp) AS created_at
                                    FROM posts
                                    WHERE post_id = $post_id"
                            );
    
    $row = mysqli_fetch_array($result);
    
    $username        = $row['username']; 
    $photo           = $row['photo'];
    $comments        = $row['comments'];
    $created_at      = $row['created_at'];

    // Count total likes for the post
    $likes_result = mysqli_query($conn, "SELECT COUNT(*) as total_likes FROM likes WHERE post_id = $post_id");
    $likes_row = mysqli_fetch_array($likes_result);
    $total_likes = $likes_row['total_likes'];

    // Count total comments for the post
    $comments_result = mysqli_query($conn, "SELECT COUNT(*) as total_comments FROM comments WHERE post_id = $post_id");
    $comments_row = mysqli_fetch_array($comments_result);
    $total_comments = $comments_row['total_comments'];

    // Fetch user profile picture
    $result2 = mysqli_query($conn, "SELECT
                                        profile_picture
                                    FROM users
                                    WHERE username = '$username'"
                            );
    
    $row2 = mysqli_fetch_array($result2);
    $profile_picture = $row2['profile_picture'];                        
?>

<!-- HTML content with modifications for displaying likes and comments -->
<main class="image-detail">
    <section class="image">
        <!-- Display post image and details -->
        <div class="column">
            <img src="<?php echo $photo ?>" class="image__avatar" style="width:100%;height:100%" />
        </div>
        <div class="column">
            <!-- Display post details, comments, and likes -->
            <div class="photo__info">
                <ul class="photo__comments" id="commentlist">
                    <!-- Display comments here -->
                </ul>
            </div>
            <div class="photo__icons">
                <span class="photo__icon">
                    <i class="fa fa-heart-o heart fa-lg"></i> <?php echo $total_likes ?> likes
                </span>
                <span class="photo__icon">
                    <i class="fa fa-comment-o fa-lg"></i> <?php echo $total_comments ?> comments
                </span>
            </div>
            <!-- Rest of the post details and comment section -->
        </div>
    </section>
</main>
        <footer class="footer">
            <nav class="footer__nav">
                <ul class="footer__list">
                    <li class="footer__list-item"><a href="#" class="footer__link">about us</a></li>
                    <li class="footer__list-item"><a href="#" class="footer__link">support</a></li>
                    <li class="footer__list-item"><a href="#" class="footer__link">blog</a></li>
                    <li class="footer__list-item"><a href="#" class="footer__link">press</a></li>
                    <li class="footer__list-item"><a href="#" class="footer__link">api</a></li>
                    <li class="footer__list-item"><a href="#" class="footer__link">jobs</a></li>
                    <li class="footer__list-item"><a href="#" class="footer__link">privacy</a></li>
                    <li class="footer__list-item"><a href="#" class="footer__link">terms</a></li>
                    <li class="footer__list-item"><a href="#" class="footer__link">directory</a></li>
                    <li class="footer__list-item"><a href="#" class="footer__link">language</a></li>
                </ul>
            </nav>
            <span class="footer__copyright">© 2024 instagram</span>
        </footer>
        <script
  src="https://code.jquery.com/jquery-3.2.1.min.js"
  integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="
  crossorigin="anonymous"></script>
        <script src="js/app.js"></script>
    </body>
</html>