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
        $_SESSION['user']['avatar'] = $avatarName;
    }
}
if (isset($_POST['change-alias'])) {
    $alias = filter_var($_POST['change-alias'], FILTER_SANITIZE_STRING);
    if (aliasExists($database, $alias)) {
        $_SESSION['message'] = "alias already taken";
    } else {
        updateAlias($database, $alias, $_SESSION['user']['id']);
        $_SESSION['user']['alias'] = $alias;
    }
}
if (isset($_POST['change-biography'])) {

    $biography = filter_var($_POST['change-biography'], FILTER_SANITIZE_STRING);
    addBiography($database, $biography, $_SESSION['user']['id']);
    $_SESSION['user']['biography'] = $biography;
}
if (isset($_POST['change-email'])) {

    $email = filter_var($_POST['change-email'], FILTER_SANITIZE_EMAIL);
    if (emailExists($database, $email)) {
        $_SESSION['message'] = "email already taken";
    } else {
        updateEmail($database, $email, $_SESSION['user']['id']);
        $_SESSION['avatar'] = $avatar;
        $_SESSION['user']['email'] = $email;
    }
}
if (isset($_POST['change-password'])) {
    $updatedPwd = password_hash($_POST['change-password'], PASSWORD_DEFAULT);
    updatePwd($database, $updatedPwd, $_SESSION['user']['id']);
    $_SESSION['user']['password'] = $updatedPwd;
}

redirect('/profile.php');
