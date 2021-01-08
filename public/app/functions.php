<?php

declare(strict_types=1);

function redirect(string $path)
{
    header("Location: ${path}");
    exit;
}

//check if alias or email exists
function userExists($database, $email, $alias): array
{
    $emailAndAliasCheck = $database->prepare('SELECT * FROM users WHERE email = :email OR alias = :alias');
    $emailAndAliasCheck->bindParam(':email', $email, PDO::PARAM_STR);
    $emailAndAliasCheck->bindParam(':alias', $alias, PDO::PARAM_STR);
    $emailAndAliasCheck->execute();

    $userExists = $emailAndAliasCheck->fetch(PDO::FETCH_ASSOC);
    return $userExists;
}

//create user
function createUser($database, $email, $hashedPwd, $biography, $avatar, $alias, $dateCreated): void
{
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
}
//check if user is logged in
function loggedIn(): bool
{
    return isset($_SESSION['user']);
}
//update the database with new inputs
function addAvatar($database, $avatar, $userId): void
{
    $statement = $database->prepare('UPDATE users SET avatar = :avatar WHERE id = :userId;');
    $statement->bindParam(':avatar', $avatar);
    $statement->bindParam(':userId', $userId);
    $statement->execute();
}

function addBiography($database, $biography, $userId): void
{
    $statement = $database->prepare('UPDATE users SET biography = :biography WHERE id = :userId;');
    $statement->bindParam(':biography', $biography);
    $statement->bindParam(':userId', $userId);
    $statement->execute();
}

function updateAlias($database, $alias, $userId): void
{
    $statement = $database->prepare('UPDATE users SET alias = :alias WHERE id = :userId;');
    $statement->bindParam(':alias', $alias);
    $statement->bindParam(':userId', $userId);
    $statement->execute();
}

function updateEmail($database, $email, $userId): void
{
    $statement = $database->prepare('UPDATE users SET email = :email WHERE id = :userId;');
    $statement->bindParam(':email', $email);
    $statement->bindParam(':userId', $userId);
    $statement->execute();
}
