<?php

declare(strict_types=1);

require __DIR__ . '/../autoload.php';
$errors = [];

if (isset($_FILES['change-avatar'])) {
    $avatar = $_FILES['change-avatar'];
    // redirect('/profile.php');
    // die(var_dump($avatar));
    if (!in_array($avatar['type'], ['image/jpeg', 'image/png', 'image/jpg', 'image/svg'])) {
        $errors[] = 'The uploaded file type is not allowed.';
        $_SESSION['error'] = 'The uploaded file type is not allowed.';
    }
    if ($avatar['size'] > 2097152) {
        $errors[] = 'The uploaded file exceeded the filesize limit.';
        $_SESSION['error'] = 'The uploaded file exceeded the filesize limit.';
    }

    if (count($errors) === 0) {
        $fileFormat = explode(".", $avatar['name'])[1];
        $avatarName = $_SESSION['user']['id'] . '.' . $fileFormat;
        $destination = __DIR__ . '/uploads/' . $avatarName;
        // die(var_dump($destination));
        move_uploaded_file($avatar['tmp_name'], $destination);
        addAvatar($database, $avatarName, $_SESSION['user']['id']);
        $message = 'The file was successfully uploaded!';
    }
}
if (isset($_POST['change-biography'])) {
}
if (isset($_POST['change-email'])) {
}
if (isset($_POST['change-password'])) {
}

redirect('/profile.php');
