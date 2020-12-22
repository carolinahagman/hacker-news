<?php

declare(strict_types=1);

require __DIR__ . '/../autoload.php';

if (isset($_POST["submit"])) {
    $alias = filter_var($_POST['alias'], FILTER_SANITIZE_STRING);
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirm-password'];
    $dateCreated = date('ymd');
    $hashedPwd = password_hash($password, PASSWORD_DEFAULT);
    $avatar = "profile.svg";
    $biography = "";


    //check if $password and $confirmPassword match
    if ($password !== $confirmPassword) {
        echo "password do not match";
    } else if (userExists($database, $email, $alias)) {
        echo "alias or email already in use";
    } else {
        createUser($database, $email, $hashedPwd, $biography, $avatar, $alias, $dateCreated);
    }
    unset($password);
    unset($confirmPassword);
    redirect('/login.php');
}
