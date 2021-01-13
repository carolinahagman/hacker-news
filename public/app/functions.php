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
function getUserProfile($database, $alias): array
{
    $statement = $database->prepare('SELECT * FROM users WHERE alias = :alias');
    $statement->bindParam(':alias', $alias, PDO::PARAM_STR);
    $statement->execute();

    $userInfo = $statement->fetch(PDO::FETCH_ASSOC);
    return $userInfo;
}
//delete user
function deleteUser($database, $userId)
{
    $statement = $database->prepare('DELETE FROM posts WHERE user_id = :userId');
    $statement->bindParam(':userId', $userId, PDO::PARAM_INT);
    $statement->execute();

    $statement = $database->prepare('DELETE FROM upvotes WHERE user_id = :userId');
    $statement->bindParam(':userId', $userId, PDO::PARAM_INT);
    $statement->execute();

    $statement = $database->prepare('DELETE FROM comments WHERE user_id = :userId');
    $statement->bindParam(':userId', $userId, PDO::PARAM_INT);
    $statement->execute();

    $statement = $database->prepare('DELETE FROM users WHERE id = :userId');
    $statement->bindParam(':userId', $userId, PDO::PARAM_INT);
    $statement->execute();
    session_destroy();
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
    $statement->bindParam(':avatar', $avatar, PDO::PARAM_STR);
    $statement->bindParam(':userId', $userId, PDO::PARAM_INT);
    $statement->execute();
}
function addBiography($database, $biography, $userId): void
{
    $statement = $database->prepare('UPDATE users SET biography = :biography WHERE id = :userId;');
    $statement->bindParam(':biography', $biography, PDO::PARAM_STR);
    $statement->bindParam(':userId', $userId, PDO::PARAM_INT);
    $statement->execute();
}
function updateAlias($database, $alias, $userId): void
{
    $statement = $database->prepare('UPDATE users SET alias = :alias WHERE id = :userId;');
    $statement->bindParam(':alias', $alias, PDO::PARAM_STR);
    $statement->bindParam(':userId', $userId, PDO::PARAM_INT);
    $statement->execute();
}
function updateEmail($database, $email, $userId): void
{
    $statement = $database->prepare('UPDATE users SET email = :email WHERE id = :userId;');
    $statement->bindParam(':email', $email, PDO::PARAM_STR);
    $statement->bindParam(':userId', $userId, PDO::PARAM_INT);
    $statement->execute();
}
function updatePwd($database, $password, $userId): void
{
    $statement = $database->prepare('UPDATE users SET password = :password WHERE id = :userId;');
    $statement->bindParam(':password', $password, PDO::PARAM_STR);
    $statement->bindParam(':userId', $userId, PDO::PARAM_INT);
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
function getPostsByUserId($database, $userId): array
{
    $statement = $database->prepare('SELECT posts.id, posts.title, posts.link, posts.content, posts.create_date, posts.image, posts.user_id, users.alias
    FROM posts INNER JOIN users on users.id = posts.user_id WHERE users.id = :userId');
    $statement->bindParam(':userId', $userId, PDO::PARAM_INT);
    $statement->execute();
    $posts = $statement->fetchAll(PDO::FETCH_ASSOC);
    return $posts;
}
function getPostById($database, $postId): array
{
    $statement = $database->prepare('SELECT * FROM posts WHERE id = :postId');
    $statement->bindParam(':postId', $postId, PDO::PARAM_INT);
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
    $statement->BindParam(':userId', $userId, PDO::PARAM_INT);
    $statement->BindParam(':postContent', $postContent, PDO::PARAM_STR);
    $statement->BindParam(':dateCreated', $dateCreated, PDO::PARAM_INT);
    $statement->BindParam(':postTitle', $postTitle, PDO::PARAM_STR);
    $statement->BindParam(':postLink', $postLink, PDO::PARAM_STR);
    $statement->BindParam(':imageName', $imageName, PDO::PARAM_STR);
    $statement->BindParam(':updateDate', $updateDate, PDO::PARAM_INT);
    $statement->execute();
}
//update database with new inputs
function updatePostTitle($database, $updatedTitle, $postId): void
{
    $statement = $database->prepare('UPDATE posts SET title  = :updatedTitle WHERE id = :postId;');
    $statement->bindParam(':updatedTitle', $updatedTitle, PDO::PARAM_STR);
    $statement->bindParam(':postId', $postId, PDO::PARAM_INT);
    $statement->execute();
}
function updatePostLink($database, $updatedLink, $postId): void
{
    $statement = $database->prepare('UPDATE posts SET link  = :updatedLink WHERE id = :postId;');
    $statement->bindParam(':updatedLink', $updatedLink, PDO::PARAM_STR);
    $statement->bindParam(':postId', $postId, PDO::PARAM_INT);
    $statement->execute();
}
function updatePostImage($database, $updatedImage, $postId): void
{
    $statement = $database->prepare('UPDATE posts SET image  = :updatedImage WHERE id = :postId;');
    $statement->bindParam(':updatedImage', $updatedImage, PDO::PARAM_STR);
    $statement->bindParam(':postId', $postId, PDO::PARAM_INT);
    $statement->execute();
}
function updatePostContent($database, $updatedContent, $postId): void
{
    $statement = $database->prepare('UPDATE posts SET content  = :updatedContent WHERE id = :postId;');
    $statement->bindParam(':updatedContent', $updatedContent, PDO::PARAM_STR);
    $statement->bindParam(':postId', $postId, PDO::PARAM_INT);
    $statement->execute();
}
function deletePost($database, $postId): void
{
    $statement = $database->prepare('DELETE FROM posts where id = :postId');
    $statement->bindParam(':postId', $postId, PDO::PARAM_INT);
    $statement->execute();
}
function sortByDate($post1, $post2): int
{
    return $post2['create_date'] - $post1['create_date'];
}
// function sortByUpvotes($database, $post1, $post2): int
// {
// }
function sortByComments($post1, $post2): int
{
    return 1;
    // return $post2['upvotes']
}
//FUNCTIONS FOR COMMENTS
function addComment($database, $comment, $postId, $userId): void
{
    $statement = $database->prepare('INSERT INTO comments (post_id, user_id, content) VALUES (:postId, :userId, :content);');
    $statement->bindParam(':postId', $postId, PDO::PARAM_INT);
    $statement->bindParam(':userId', $userId, PDO::PARAM_INT);
    $statement->bindParam(':content', $comment, PDO::PARAM_STR);
    $statement->execute();
}

function getCommentsByPostId($database, $postId): array
{
    $statement = $database->prepare('SELECT comments.*, users.alias  FROM comments INNER JOIN users on comments.user_id = users.id WHERE comments.post_id = :postId');
    $statement->bindParam(':postId', $postId, PDO::PARAM_INT);
    $statement->execute();
    $comments = $statement->fetchAll(PDO::FETCH_ASSOC);
    return $comments;
}

function countComments($database, $postId)
{
    $comments = getCommentsByPostId($database, $postId);
    $commentsCount = count($comments);
    return $commentsCount === 1 ? '1 comment' : "$commentsCount comments";
}

function deleteComment($database, $commentId, $userId): void
{
    $statement = $database->prepare('DELETE FROM comments where id = :commentId AND user_id = :userId');
    $statement->bindParam(':commentId', $commentId, PDO::PARAM_INT);
    $statement->bindParam(':userId', $userId, PDO::PARAM_INT);
    $statement->execute();
}
//FUNCTIONS FOR UPVOTES
function addUpvote($database, $userId, $postId): void
{
    $statement = $database->prepare('insert into upvotes (post_id, user_id) values (:postId, :userId);');
    $statement->bindParam(':postId', $postId, PDO::PARAM_INT);
    $statement->bindParam(':userId', $userId, PDO::PARAM_INT);
    $statement->execute();
}
function removeUpvote($database, $userId, $postId): void
{
    $statement = $database->prepare('DELETE FROM upvotes WHERE post_id = :postId AND user_id = :userId');
    $statement->bindParam(':postId', $postId, PDO::PARAM_INT);
    $statement->bindParam(':userId', $userId, PDO::PARAM_INT);
    $statement->execute();
}
function getUpvotesByPost($database, $postId): array
{
    $statement = $database->prepare('SELECT * FROM upvotes where post_id = :postId');
    $statement->bindParam(':postId', $postId, PDO::PARAM_INT);
    $statement->execute();

    $upvotes = $statement->fetchAll(PDO::FETCH_ASSOC);
    // die(var_dump($upvotes));
    return $upvotes;
}
function countUpvotes($database, $postId): int
{
    $upvotes = getUpvotesByPost($database, $postId);
    $upvoteCount = count($upvotes);
    // die(var_dump($upvoteCount));
    return $upvoteCount;
}
function hasUserUpvotedPost($database, $postId, $userId): bool
{
    $upvoteCheck = $database->prepare('SELECT * FROM upvotes WHERE post_id = :postId AND user_id = :userId');
    $upvoteCheck->bindParam(':postId', $postId, PDO::PARAM_INT);
    $upvoteCheck->bindParam(':userId', $userId, PDO::PARAM_INT);
    $upvoteCheck->execute();

    $upvoteExists = $upvoteCheck->fetch(PDO::FETCH_ASSOC);
    return !!$upvoteExists;
}
//TODO:FIX THIS!!!
function formatDate($date): string
{
    $dateCreate = (date_create($date));
    return (date_format($dateCreate, 'jS F Y'));
}
