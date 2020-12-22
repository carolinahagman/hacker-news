<?php

declare(strict_types=1);

function redirect(string $path)
{
    header("Location: ${path}");
    exit;
}

//check if alias or email exists
function userExists($database, $email, $alias)
{
    $emailAndAliasCheck = $database->prepare('SELECT * FROM users WHERE email = :email OR alias = :alias');
    $emailAndAliasCheck->bindParam(':email', $email, PDO::PARAM_STR);
    $emailAndAliasCheck->bindParam(':alias', $alias, PDO::PARAM_STR);
    $emailAndAliasCheck->execute();

    $userExists = $emailAndAliasCheck->fetch(PDO::FETCH_ASSOC);
    return $userExists;
}

//create user
function createUser($database, $email, $hashedPwd, $biography, $avatar, $alias, $dateCreated)
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
