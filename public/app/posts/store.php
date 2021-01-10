<?php

declare(strict_types=1);

require __DIR__ . '/../autoload.php';

if (isset($_POST["submit"])) {
    $postTitle = filter_var($_POST['title'], FILTER_SANITIZE_STRING);
    $postLink = filter_var($_POST['link'], FILTER_SANITIZE_URL);
    $postContent = filter_var($_POST['content'], FILTER_SANITIZE_STRING);
    $userId = $_SESSION['user']['id'];
    $dateCreated = date("ymd");
    $updateDate = date("ymd");
    $postImage = $_FILES['post-image'];
    $imageName = "";
    $fileFormat = $_FILES['post-image']['type'];
    $fileSize = $_FILES['post-image']['size'];
    $fileEnding = explode(".", $postImage['name'])[1];
    $imageTitle = implode("", explode(' ', $postTitle));

    if (($fileFormat === 'image/svg' || $fileFormat === 'image/jpg' || $fileFormat === 'image/jpeg' || $fileFormat === 'image/png') && $fileSize <= 2000000) {
        $imageName = date('ymdhis') . $imageTitle . '.' . $fileEnding;
        $destination = __DIR__ . '/uploads/' . $imageName;
        move_uploaded_file($postImage['tmp_name'], $destination);
    }
    createNewPost($database, $userId, $postContent, $dateCreated, $postTitle, $postLink, $imageName, $updateDate);
    $id = $database->lastInsertId();
    redirect("/post.php?id=${id}");
}
