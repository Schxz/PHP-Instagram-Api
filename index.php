<?php
include "src/SchxzInstagram.php";

use Schxz\Instagram;

$insta = new Schxz\Instagram;
$Posts = $insta->loadUser("instagram")->getPosts(24);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Instagram - User Profile</title>
    <link rel="stylesheet" href="css/style.css">

</head>

<body>
    <div class="content-wrapper">

        <div class="img"><img src="<?= $insta->User->profile_pic_url_hd; ?>" /></div>
        <div class="wave -one"></div>
        <div class="wave -two"></div>
        <div class="wave -three"></div>
        <div class="user">
            <div class="profile--info"><span class="username"><?= $insta->User->full_name; ?> </span><span>@<?= $insta->User->username; ?></span><br /><span class="userquote"><?= $insta->User->biography; ?></span></div>
            <div class="user-social-wrapper">
                <div class="user-info user-posts"><span><?= $insta->numberFormat($insta->User->edge_owner_to_timeline_media->count); ?></span><span>Posts</span></div>
                <div class="user-info user-followers"><span><?= $insta->numberFormat($insta->User->edge_followed_by->count); ?></span><span>followers</span></div>
                <div class="user-info user-following"><span><?= $insta->numberFormat($insta->User->edge_follow->count); ?></span><span>following</span></div>
            </div>
            <div class="shots">
                <?php foreach ($Posts as $key => $Post) { ?>
                    <div title="<?= $Post->node->edge_media_to_caption->edges[0]->node->text; ?>" class="shot"><img src="<?= $Post->node->display_url; ?>" /></div>
                <?php } ?>
            </div>
        </div>
    </div>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js'></script>
    <script src='https://use.fontawesome.com/f09496b7cc.js'></script>
    <script src="js/script.js"></script>

</body>
</html>