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

    $statement = $database->prepare('INSERT INTO posts (user_id, content, create_date, title, link, update_date) VALUES (:userId, :postContent, :dateCreated, :postTitle, :postLink, :updateDate);');

    if (!$statement) {
        die(var_dump($database->errorInfo()));
    }
    $statement->BindParam(':userId', $userId);
    $statement->BindParam(':postContent', $postContent);
    $statement->BindParam(':dateCreated', $dateCreated);
    $statement->BindParam(':postTitle', $postTitle);
    $statement->BindParam(':postLink', $postLink);
    $statement->BindParam(':updateDate', $updateDate);
    $statement->execute();
}

redirect('/');
