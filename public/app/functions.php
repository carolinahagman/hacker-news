<?php

declare(strict_types=1);

function redirect(string $path)
{
    header("Location: ${path}");
    exit;
}
//FUNCTIONS FOR USERS
//check if alias or email exists
function aliasExists(PDO $database, string $alias): bool
{
    $aliasCheck = $database->prepare('SELECT * FROM users WHERE alias = :alias');
    $aliasCheck->bindParam(':alias', $alias, PDO::PARAM_STR);
    $aliasCheck->execute();

    $aliasExists = $aliasCheck->fetch(PDO::FETCH_ASSOC);
    return !!$aliasExists;
}
function emailExists(PDO $database, string $email): bool
{
    $emailCheck = $database->prepare('SELECT * FROM users WHERE email = :email');
    $emailCheck->bindParam(':email', $email, PDO::PARAM_STR);
    $emailCheck->execute();

    $emailExists = $emailCheck->fetch(PDO::FETCH_ASSOC);
    return !!$emailExists;
}

function getUserInfo(PDO $database, string $userEmail): array
{
    $statement = $database->prepare('SELECT * FROM users WHERE email = :userEmail');
    $statement->bindParam(':userEmail', $userEmail, PDO::PARAM_STR);
    $statement->execute();

    $userInfo = $statement->fetch(PDO::FETCH_ASSOC);
    return $userInfo;
}
//create user
function createUser(PDO $database, string $email, string $hashedPwd, string $biography, string $avatar, string $alias, string $dateCreated): void
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
function getUserProfile(PDO $database, string $alias): array
{
    $statement = $database->prepare('SELECT * FROM users WHERE alias = :alias');
    $statement->bindParam(':alias', $alias, PDO::PARAM_STR);
    $statement->execute();

    $userInfo = $statement->fetch(PDO::FETCH_ASSOC);
    if (is_array($userInfo)) {
        return $userInfo;
    }
    redirect('/');
    return [];
}
//delete user
function deleteUser(PDO $database, int $userId): void
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
function addAvatar(PDO $database, string $avatar, int $userId): void
{
    $statement = $database->prepare('UPDATE users SET avatar = :avatar WHERE id = :userId;');
    $statement->bindParam(':avatar', $avatar, PDO::PARAM_STR);
    $statement->bindParam(':userId', $userId, PDO::PARAM_INT);
    $statement->execute();
}
function addBiography(PDO $database, string $biography, int $userId): void
{
    $statement = $database->prepare('UPDATE users SET biography = :biography WHERE id = :userId;');
    $statement->bindParam(':biography', $biography, PDO::PARAM_STR);
    $statement->bindParam(':userId', $userId, PDO::PARAM_INT);
    $statement->execute();
}
function updateAlias(PDO $database, string $alias, int $userId): void
{
    $statement = $database->prepare('UPDATE users SET alias = :alias WHERE id = :userId;');
    $statement->bindParam(':alias', $alias, PDO::PARAM_STR);
    $statement->bindParam(':userId', $userId, PDO::PARAM_INT);
    $statement->execute();
}
function updateEmail(PDO $database, string $email, int $userId): void
{
    $statement = $database->prepare('UPDATE users SET email = :email WHERE id = :userId;');
    $statement->bindParam(':email', $email, PDO::PARAM_STR);
    $statement->bindParam(':userId', $userId, PDO::PARAM_INT);
    $statement->execute();
}
function updatePwd(PDO $database, string $password, int $userId): void
{
    $statement = $database->prepare('UPDATE users SET password = :password WHERE id = :userId;');
    $statement->bindParam(':password', $password, PDO::PARAM_STR);
    $statement->bindParam(':userId', $userId, PDO::PARAM_INT);
    $statement->execute();
}
//FUNCTIONS FOR POSTS
//get all posts in an array
function getAllPosts(PDO $database): array
{
    $statement = $database->query('SELECT posts.id, posts.title, posts.link, posts.content, posts.create_date, posts.image, posts.user_id, users.alias
	FROM posts INNER JOIN users on users.id = posts.user_id;');
    $posts = $statement->fetchAll(PDO::FETCH_ASSOC);
    return $posts;
}
function getPostsByUserId(PDO $database, int $userId): array
{
    $statement = $database->prepare('SELECT posts.id, posts.title, posts.link, posts.content, posts.create_date, posts.image, posts.user_id, users.alias
    FROM posts INNER JOIN users on users.id = posts.user_id WHERE users.id = :userId');
    $statement->bindParam(':userId', $userId, PDO::PARAM_INT);
    $statement->execute();
    $posts = $statement->fetchAll(PDO::FETCH_ASSOC);
    return $posts;
}
function getPostById(PDO $database, int $postId): array
{
    $statement = $database->prepare('SELECT * FROM posts WHERE id = :postId');
    $statement->bindParam(':postId', $postId, PDO::PARAM_INT);
    $statement->execute();

    $post = $statement->fetch(PDO::FETCH_ASSOC);
    return $post;
}
function createNewPost(PDO $database, int $userId, string $postContent, int $dateCreated, string $postTitle, string $postLink, string $imageName, int $updateDate): void
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
function updatePostTitle(PDO $database, string $updatedTitle, int $postId): void
{
    $statement = $database->prepare('UPDATE posts SET title  = :updatedTitle WHERE id = :postId;');
    $statement->bindParam(':updatedTitle', $updatedTitle, PDO::PARAM_STR);
    $statement->bindParam(':postId', $postId, PDO::PARAM_INT);
    $statement->execute();
}
function updatePostLink(PDO $database, string $updatedLink, int $postId): void
{
    $statement = $database->prepare('UPDATE posts SET link  = :updatedLink WHERE id = :postId;');
    $statement->bindParam(':updatedLink', $updatedLink, PDO::PARAM_STR);
    $statement->bindParam(':postId', $postId, PDO::PARAM_INT);
    $statement->execute();
}
function updatePostImage(PDO $database, string $updatedImage, int $postId): void
{
    $statement = $database->prepare('UPDATE posts SET image  = :updatedImage WHERE id = :postId;');
    $statement->bindParam(':updatedImage', $updatedImage, PDO::PARAM_STR);
    $statement->bindParam(':postId', $postId, PDO::PARAM_INT);
    $statement->execute();
}
function updatePostContent(PDO $database, string $updatedContent, int $postId): void
{
    $statement = $database->prepare('UPDATE posts SET content  = :updatedContent WHERE id = :postId;');
    $statement->bindParam(':updatedContent', $updatedContent, PDO::PARAM_STR);
    $statement->bindParam(':postId', $postId, PDO::PARAM_INT);
    $statement->execute();
}
function deletePost(PDO $database, string $postId): void
{
    $statement = $database->prepare('DELETE FROM posts where id = :postId');
    $statement->bindParam(':postId', $postId, PDO::PARAM_INT);
    $statement->execute();
}
function sortByDate($post1, $post2): int
{
    return $post2['create_date'] - $post1['create_date'];
}
//FUNCTIONS FOR COMMENTS
function addComment(PDO $database, string $comment, int $postId, int $userId): void
{
    $statement = $database->prepare('INSERT INTO comments (post_id, user_id, content) VALUES (:postId, :userId, :content);');
    $statement->bindParam(':postId', $postId, PDO::PARAM_INT);
    $statement->bindParam(':userId', $userId, PDO::PARAM_INT);
    $statement->bindParam(':content', $comment, PDO::PARAM_STR);
    $statement->execute();
}

function getCommentsByPostId(PDO $database, int $postId): array
{
    $statement = $database->prepare('SELECT comments.*, users.alias  FROM comments INNER JOIN users on comments.user_id = users.id WHERE comments.post_id = :postId');
    $statement->bindParam(':postId', $postId, PDO::PARAM_INT);
    $statement->execute();
    $comments = $statement->fetchAll(PDO::FETCH_ASSOC);
    return $comments;
}
function getCommentsByUserId(PDO $database, int $userId): array
{
    $statement = $database->prepare('SELECT comments.*, users.alias
    FROM comments INNER JOIN users on users.id = comments.user_id WHERE users.id = :userId');
    $statement->bindParam(':userId', $userId, PDO::PARAM_INT);
    $statement->execute();
    $comments = $statement->fetchAll(PDO::FETCH_ASSOC);
    return $comments;
}

function countComments(PDO $database, int $postId)
{
    $comments = getCommentsByPostId($database, $postId);
    $commentsCount = count($comments);
    return $commentsCount === 1 ? '1 comment' : "$commentsCount comments";
}

function deleteComment(PDO $database, int $commentId, int $userId): void
{
    $statement = $database->prepare('DELETE FROM comments where id = :commentId AND user_id = :userId');
    $statement->bindParam(':commentId', $commentId, PDO::PARAM_INT);
    $statement->bindParam(':userId', $userId, PDO::PARAM_INT);
    $statement->execute();
}
//FUNCTIONS FOR UPVOTES
function addUpvote(PDO $database, int $userId, int $postId): void
{
    $statement = $database->prepare('insert into upvotes (post_id, user_id) values (:postId, :userId);');
    $statement->bindParam(':postId', $postId, PDO::PARAM_INT);
    $statement->bindParam(':userId', $userId, PDO::PARAM_INT);
    $statement->execute();
}
function removeUpvote(PDO $database, int $userId, int $postId): void
{
    $statement = $database->prepare('DELETE FROM upvotes WHERE post_id = :postId AND user_id = :userId');
    $statement->bindParam(':postId', $postId, PDO::PARAM_INT);
    $statement->bindParam(':userId', $userId, PDO::PARAM_INT);
    $statement->execute();
}
function getUpvotesByUser(PDO $database, int $userId): array
{
    $statement = $database->prepare('SELECT * FROM upvotes where user_id = :userId');
    $statement->bindParam(':userId', $userId, PDO::PARAM_INT);
    $statement->execute();

    $upvotes = $statement->fetchAll(PDO::FETCH_ASSOC);
    return $upvotes;
}
function getUpvotesByPost(PDO $database, int $postId): array
{
    $statement = $database->prepare('SELECT * FROM upvotes where post_id = :postId');
    $statement->bindParam(':postId', $postId, PDO::PARAM_INT);
    $statement->execute();

    $upvotes = $statement->fetchAll(PDO::FETCH_ASSOC);
    return $upvotes;
}
function countUpvotes(PDO $database, int $postId): int
{
    $upvotes = getUpvotesByPost($database, $postId);
    $upvoteCount = count($upvotes);
    return $upvoteCount;
}
function hasUserUpvotedPost(PDO $database, int $postId, int $userId): bool
{
    $upvoteCheck = $database->prepare('SELECT * FROM upvotes WHERE post_id = :postId AND user_id = :userId');
    $upvoteCheck->bindParam(':postId', $postId, PDO::PARAM_INT);
    $upvoteCheck->bindParam(':userId', $userId, PDO::PARAM_INT);
    $upvoteCheck->execute();

    $upvoteExists = $upvoteCheck->fetch(PDO::FETCH_ASSOC);
    return !!$upvoteExists;
}
function formatDate(string $date): string
{
    $dateParts = str_split($date);
    $dateStr = $dateParts[0] . $dateParts[1] . "-" . $dateParts[2] . $dateParts[3] . "-" . $dateParts[4] . $dateParts[5];
    $date = strtotime($dateStr);
    $formattedDate = date('jS F Y', $date);
    return $formattedDate;
}
