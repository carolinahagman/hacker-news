<?php

declare(strict_types=1);

require __DIR__ . '/../autoload.php';


if (isset($_REQUEST['userId'], $_REQUEST['commentId'])) {
    $commentId = $_REQUEST['commentId'];
    $userId = $_REQUEST['userId'];
    if (hasUserUpvotedComment($database, $commentId, $userId)) {
        removeUpvoteComment($database, $userId, $commentId);
    } else {
        addUpvoteComment($database, $userId, $commentId);
    }
}
