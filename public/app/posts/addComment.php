<?php

declare(strict_types=1);

require __DIR__ . '/../autoload.php';

$postId = $_GET['id'];
if (isset($_POST['new-comment'])) {
    $comment = filter_var($_POST['new-comment'], FILTER_SANITIZE_STRING);
    addComment($database, $comment, $postId, $_SESSION['user']['id']);
}
redirect("/post.php?id=${postId}");
