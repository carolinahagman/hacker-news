<?php

declare(strict_types=1);

require __DIR__ . '/../autoload.php';

// die(var_dump($_POST));
$postId = $_GET['id'];
// $delete = $_GET['delete-post'];
?>
<script>
    console.log(<?php $postId ?>)
</script>
<?php
// die(var_dump($postId));
if (isset($_POST['updated-title'])) {
    $updatedTitle = filter_var($_POST['updated-title'], FILTER_SANITIZE_STRING);
    updatePostTitle($database, $updatedTitle, $postId);
}
if (isset($_POST['updated-link'])) {
    $updatedLink = filter_var($_POST['updated-link'], FILTER_SANITIZE_URL);
    updatePostLink($database, $updatedLink, $postId);
}
if (isset($_FILES['updated-image'])) {
    $updatedImage = $_FILES['updated-image'];
    $fileFormat = $updatedImage['type'];
    $fileSize = $updatedImage['size'];
    $fileEnding = explode(".", $updatedImage['name'][1]);
    $imageTitle = implode("", explode(' ', $_POST['updated-title']));

    if (($fileFormat === 'image/svg' || $fileFormat === 'image/jpg' || $fileFormat === 'image/jpeg' || $fileFormat === 'image/png') && $fileSize <= 2000000) {
        $imageName = date('ymdhis') . $imageTitle . '.' . $fileEnding;
        $destination = __DIR__ . '/uploads/' . $imageName;
        move_uploaded_file($updatedImage['tmp_name'], $destination);
        updatePostImage($database, $imageName, $postId);
    }
}
if (isset($_POST['updated-content'])) {
    $updatedContent =  filter_var($_POST['updated-content'], FILTER_SANITIZE_STRING);
    updatePostContent($database, $updatedContent, $postId);
}
if (isset($_POST['delete-post'])) {
    deletePost($database, $postId);
    redirect("/");
}
redirect("/post.php?id=${postId}");
