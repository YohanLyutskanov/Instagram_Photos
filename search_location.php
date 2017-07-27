<?php include "Data/getUserData.php"; ?>
    <link rel="stylesheet" href="css/bootstrap.css">
    <div class="container" style="text-align:center;">
    <div class="col-md-4 col-md-offset-4"><br>
        <a style="text-align: end" href="index.php">
            <button class="btn btn-primary">Profile</button>
        </a>
        <a href="recent.php">
            <button class="btn btn-primary">Photos</button>
        </a>
        <a style="text-align:start" href="logout.php">
            <button class="btn btn-primary">Log Out</button>
        </a>
        <form name="filter_location" method="post">
            <h2>Please choose location</h2>
            <input type="text" minlength=3 name="location" placeholder="Enter location">
            <input type="submit" class="btn btn-primary" name="sbmLocation" value="Search">
        </form>
        <body class="test">

        <?php if (isset($_POST['location']) && isset($_POST['sbmLocation'])) { ?>

            <header class="clearfix">
                <img src="pics/logo.png" alt="Instagram logo" height="80" width="80">
                <h1>Instagram</h1>
                <h3>My photos</h3>
            </header>
            <?php
            $match = false;
            $location_searched = $_POST['location'];
            foreach ($get_recent_media->data as $media) {
                if (empty($media->location->name)) {
                    $location = "Unknown";
                } else {
                    $location = $media->location->name;
                }
                if (stripos($location, $location_searched) !== false) {
                    $content = '';
                    // output media
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
                    $date = date('d/M/Y', $media->created_time);
                    $content .= "<p>Likes: {$likes}</p><p>Location:<b> {$location}</b></p><p>Date: {$date}</p><hr>";
                    // output media
                    $match = true;
                    echo $content;
                }
            }
            if ($match != true) {
                echo "<h1 style='color: red'>Sorry, no results matched your search</h1>";
            }
        }
        ?>
            </body>
        <footer>
            <p>
                <b>Script By Yohan Lyutskanov </b><br>
                <a href="https://github.com/YohanLyutskanov">
                    <b>Visit my GitHub profile</b>
                </a>            </p>
        </footer>
    </div>
<?php exit; ?>