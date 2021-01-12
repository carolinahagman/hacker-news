<?php

declare(strict_types=1);

require __DIR__ . '/../autoload.php';



if (isset($_REQUEST['userId'], $_REQUEST['postId'])) {
    $postId = $_REQUEST['postId'];
    $userId = $_REQUEST['userId'];
    if (hasUserUpvotedPost($database, $postId, $userId)) {
        removeUpvote($database, $userId, $postId);
    } else {
        addUpvote($database, $userId, $postId);
    }
}

// $postId = $_GET['id'];
// if (isset($_POST['submit'])) {
//     $userId = $_SESSION['user']['id'];
//     addUpvote($database, $userId, $postId);
// }



// redirect('/');
