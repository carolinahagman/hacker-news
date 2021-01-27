<?php

declare(strict_types=1);

require __DIR__ . '/../autoload.php';

$postId = $_GET['id'];
$commentId = $_GET['comment'];
$userId = $_SESSION['user']['id'];


if (isset($_POST['new-comment'])) {
    $comment = filter_var($_POST['new-comment'], FILTER_SANITIZE_STRING);
    addComment($database, $comment, $postId, $_SESSION['user']['id']);
}

if (isset($_POST['reply-comment'])) {
    $comment = filter_var($_POST['reply-comment'], FILTER_SANITIZE_STRING);
    $postId =  $_POST['post_id'];
    $commentId =$_POST['comment_id'];
    addCommentReply($database, $comment, $postId, $userId, $commentId);
}

if (isset($_GET['action'])) {
    if ($_GET['action'] === 'edit') {
        $comment = filter_var($_POST['edit-comment-text'], FILTER_SANITIZE_STRING);
        editComment($database, $comment, $commentId);
    }
}

if (isset($_GET['action'])) {
    if ($_GET['action'] === 'delete') {
        deleteComment($database, $commentId, $userId);
    }
}

redirect("/post.php?id=${postId}");
