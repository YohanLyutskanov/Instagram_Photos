<?php
include "Data/getUserData.php";
?>
    <link rel="stylesheet" href="css/bootstrap.css">
    <div class="container" style="text-align:center;"><br>
        <header class="clearfix">
            <a style="text-align: end" href="index.php">
                <button class="btn btn-primary">Your Profile</button>
            </a>
            <a href="search_date.php">
                <button class="btn btn-primary">Filter by Date</button>
            </a>
            <a href="search_location.php">
                <button class="btn btn-primary">Filter by Location</button>
            </a>
            <a style="text-align:start" href="logout.php">
                <button class="btn btn-primary">Log Out</button>
            </a>
            <br><br>
            <img src="pics/logo.png" alt="Instagram logo" height="80" width="80">
            <h1>Instagram</h1>
            <h3>My photos</h3>
        </header>
        <body class="test">
        <div class="col-md-4 col-md-offset-4">
            <?php
            foreach ($get_recent_media->data as $media) {
                $content = '';
                if ($media->type === 'video') {
                    // video
                    $poster = $media->images->low_resolution->url;
                    $source = $media->videos->standard_resolution->url;
                    $content .= "<video class=\"media video-js vjs-default-skin\" width=\"250\" height=\"250\" poster=\"{$poster}\"
                           data-setup='{\"controls\":true, \"preload\": \"auto\"}'>
                             <source src=\"{$source}\" type=\"video/mp4\" />
                           </video>";
                } else {
                    // image
                    $image = $media->images->low_resolution->url;
                    $content .= "<img class=\"media\" src=\"{$image}\"/>";
                }
                $likes = $media->likes->count;
                if (empty($media->location->name)) {
                    $location = "Unknown";
                } else {
                    $location = $media->location->name;
                }
                $date = date('d/M/Y', $media->created_time);
                $content .= "<p>Likes: {$likes}</p><p>Location: {$location}</p><p>Date: {$date}</p><hr>";
                echo $content;
            }
            ?>
        </body>
        <footer>
            <p>
                <b>Script By Yohan Lyutskanov </b><br>
                <a href="https://github.com/YohanLyutskanov">
                    <b>Visit my GitHub profile</b>
                </a>
            </p>
        </footer>
    </div>
<?php exit; ?>