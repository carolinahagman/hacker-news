<?php

declare(strict_types=1);

function redirect(string $path)
{
    header("Location: ${path}");
    exit;
}
//FUNCTIONS FOR USERS
//check if alias or email exists
function aliasExists($database, $alias): bool
{
    $aliasCheck = $database->prepare('SELECT * FROM users WHERE alias = :alias');
    $aliasCheck->bindParam(':alias', $alias, PDO::PARAM_STR);
    $aliasCheck->execute();

    $aliasExists = $aliasCheck->fetch(PDO::FETCH_ASSOC);
    return !!$aliasExists;
}

function emailExists($database, $email): bool
{
    $emailCheck = $database->prepare('SELECT * FROM users WHERE email = :email');
    $emailCheck->bindParam(':email', $email, PDO::PARAM_STR);
    $emailCheck->execute();

    $emailExists = $emailCheck->fetch(PDO::FETCH_ASSOC);
    return !!$emailExists;
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
//delete user
function deleteUser($database, $userId)
{
    $statement = $database->prepare('DELETE FROM posts WHERE user_id = :userId');
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
function updatePwd($database, $password, $userId): void
{
    $statement = $database->prepare('UPDATE users SET password = :password WHERE id = :userId;');
    $statement->bindParam(':password', $password);
    $statement->bindParam(':userId', $userId);
    $statement->execute();
}

//FUNCTIONS FOR POSTS
//get all posts in an array
function getAllPosts($database): array
{
    $statement = $database->query('SELECT posts.id, posts.title, posts.link, posts.content, posts.create_date, posts.image, posts.user_id, users.alias
	FROM posts INNER JOIN users on users.id = posts.user_id;');
    $posts = $statement->fetchAll(PDO::FETCH_ASSOC);
    return $posts;
}
function getPostById($database, $postId): array
{
    $statement = $database->prepare('SELECT * FROM posts WHERE id = :postId');
    $statement->bindParam(':postId', $postId);
    $statement->execute();

    $post = $statement->fetch(PDO::FETCH_ASSOC);
    return $post;
}
function createNewPost($database, $userId, $postContent, $dateCreated, $postTitle, $postLink, $imageName, $updateDate): void
{
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
}
//update database with new inputs
function updatePostTitle($database, $updatedTitle, $postId): void
{
    $statement = $database->prepare('UPDATE posts SET title  = :updatedTitle WHERE id = :postId;');
    $statement->bindParam(':updatedTitle', $updatedTitle);
    $statement->bindParam(':postId', $postId);
    $statement->execute();
}
function updatePostLink($database, $updatedLink, $postId): void
{
    $statement = $database->prepare('UPDATE posts SET link  = :updatedLink WHERE id = :postId;');
    $statement->bindParam(':updatedLink', $updatedLink);
    $statement->bindParam(':postId', $postId);
    $statement->execute();
}
function updatePostImage($database, $updatedImage, $postId): void
{
    $statement = $database->prepare('UPDATE posts SET image  = :updatedImage WHERE id = :postId;');
    $statement->bindParam(':updatedImage', $updatedImage);
    $statement->bindParam(':postId', $postId);
    $statement->execute();
}
function updatePostContent($database, $updatedContent, $postId): void
{
    $statement = $database->prepare('UPDATE posts SET content  = :updatedContent WHERE id = :postId;');
    $statement->bindParam(':updatedContent', $updatedContent);
    $statement->bindParam(':postId', $postId);
    $statement->execute();
}
function deletePost($database, $postId): void
{
    $statement = $database->prepare('DELETE FROM posts where id = :postId');
    $statement->bindParam(':postId', $postId);
    $statement->execute();
}

function sortByDate($post1, $post2): int
{
    return $post2['create_date'] - $post1['create_date'];
}

function sortByUpvotes($post1, $post2): int
{
    return 1;
    // return $post2['upvotes']
}
function sortByComments($post1, $post2): int
{
    return 1;
    // return $post2['upvotes']
}

//FUNCTIONS FOR COMMENTS
function addComment($database, $comment, $postId, $userId): void
{
    $statement = $database->prepare('INSERT INTO comments (post_id, user_id, content) VALUES (:postId, :userId, :content);');
    $statement->bindParam(':postId', $postId);
    $statement->bindParam(':userId', $userId);
    $statement->bindParam(':content', $comment);
    $statement->execute();
}
