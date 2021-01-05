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
        $_SESSION['message'] = "password do not match";
        redirect('/create.php');
    } else if (userExists($database, $email, $alias)) {
        $_SESSION['message'] = "alias or email already in use";
        redirect('/create.php');
    } else {
        createUser($database, $email, $hashedPwd, $biography, $avatar, $alias, $dateCreated);
    }
    unset($password);
    unset($confirmPassword);
    // Log in the user after signing up
    $statement = $database->prepare('SELECT * FROM users WHERE alias = :alias');
    $statement->bindParam(':alias', $alias, PDO::PARAM_STR);
    $statement->execute();
    $user = $statement->fetch(PDO::FETCH_ASSOC);
    $_SESSION['user'] = $user;
    $_SESSION['message'] = "You're logged in!";

    redirect('/index.php');
}
