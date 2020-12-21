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

    //create function instead
    $emailAndAliasCheck = $pdo->prepare('SELECT * FROM users WHERE email = :email OR alias = :alias');
    $emailAndAliasCheck->bindParam(':email', $email, PDO::PARAM_STR);
    $emailAndAliasCheck->bindParam(':alias', $alias, PDO::PARAM_STR);
    $emailAndAliasCheck->execute();

    $duplicateAliasOrUsername = $emailAndAliasCheck->fetch(PDO::FETCH_ASSOC);

    //check if $password and $confirmPassword match
    if ($password !== $confirmPassword) {
        echo "password do not match";
    } else if ($duplicateAliasOrUsername) {
        echo "alias or email already in use";
    } else

        $statement = $database->prepare('INSERT INTO users (email, password, biography, avatar, alias, create_date) VALUES (:email, :password, :biography, :avatar, :alias, :create_date);');

    if (!$statement) {
        die(var_dump($database->errorInfo()));
    }
    $statement->bindParam(':alias', $alias, PDO::PARAM_STR);
    $statement->bindParam(':email', $email, PDO::PARAM_STR);
    $statement->bindParam(':password', $hashedPwd, PDO::PARAM_STR);
    $statement->bindParam(':biography', $biography, PDO::PARAM_STR);
    $statement->bindParam(':avatar', $avatar, PDO::PARAM_STR);
    $statement->bindParam(':create_date', $dateCreated, PDO::PARAM_STR);
    $statement->execute();

    redirect('/login.php');
}
