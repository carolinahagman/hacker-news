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

    $statement = $database->prepare('INSERT INTO posts (user_id, content, create_date, title, link, image, update_date) VALUES (:userId, :postContent, :dateCreated, :postTitle, :postLink, :imageName, :updateDate);');

    if (!$statement) {
        die(var_dump($database->errorInfo()));
    }
    $statement->BindParam(':userId', $userId);
    $statement->BindParam(':postContent', $postContent);
    $statement->BindParam(':dateCreated', $dateCreated);
    $statement->BindParam(':postTitle', $postTitle);
    $statement->BindParam(':postLink', $postLink);
    $statement->BindParam(':imageName', $imageName);
    $statement->BindParam(':updateDate', $updateDate);
    $statement->execute();
    $id = $database->lastInsertId();
    redirect("/post.php?id=${id}");
}
