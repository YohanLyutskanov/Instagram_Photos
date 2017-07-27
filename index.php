<!DOCTYPE html>
<html>
<link rel="stylesheet" href="css/bootstrap.css">
<head>
    <meta charset="utf-8">
</head>
<body  class="test">

<?php
session_start();

if (isset($_SESSION['user_info'])) { // if user is logged in
    $user_info = $_SESSION['user_info']; // get user info array
    $full_name = $_SESSION['user_info']['data']['full_name']; // get full name
    $username = $_SESSION['user_info']['data']['username']; // get username
    $media_count = $_SESSION['user_info']['data']['counts']['media']; // get media count
    $followers_count = $_SESSION['user_info']['data']['counts']['followed_by']; // get followers
    $following_count = $_SESSION['user_info']['data']['counts']['follows']; // get following
    $profile_picture = $_SESSION['user_info']['data']['profile_picture']; // get profile picture
    ?>
    <link rel="stylesheet" href="css/bootstrap.css">
    <div class="container" style="text-align:center;"><br>
        <header>
            <a href="recent.php">
                <button class="btn btn-primary">Photos</button>
            </a>
            <a href="logout.php">
                <button class="btn btn-primary">Log Out</button>
            </a>
        </header>
        <div class="col-md-4 col-md-offset-4">
            <h2>Welcome <?php echo $full_name; ?>!</h2>
            <p><img src="<?php echo $profile_picture; ?>"></p>
            <h3>Your username: <?php echo $username; ?></h3>
            <h3>Media count: <?php echo $media_count; ?></h3>
            <h3>Followers count: <?php echo $followers_count; ?></h3>
            <h3>Following count: <?php echo $following_count; ?></h3>

        </div>
    </div>

    <?php
} else { // if user is not logged in
    echo '<div class="col-md-4 col-md-offset-4">
<h3 style="text-align: center">
<a style="color: blue" href="login.php">
<button class="btn btn-primary">Log In With Instagram</button>
</a>
</h3>
</div>';
}
?>
</body>
</html>