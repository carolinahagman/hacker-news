<?php

declare(strict_types=1);

require __DIR__ . '/../autoload.php';
// require __DIR__ . '/../../views/header.php';

$commentId = $_GET['comment_id'];

$comments = getComment($database, $commentId);

foreach ($comments as $comment) :
$postId = $comment['post_id'] . "<br />";
$commentUserId = $comment['user_id'] . "<br />";
$commentContent = $comment['content'] . "<br />";
$commentId = $comment['id'] . "<br />";
endforeach;

?>

<body>
<main class="w-full flex flex-col items-center">
    <section class="w-11/12 max-w-md">
        <article class="p-4 shadow-md rounded-md mb-2">
        <?= $commentContent; ?>
                <form action="addComment.php?id=<?= $id ?>&comment=<?= $comment['id'] ?>&action=reply" method="post" class="flex">
                    <div class="comment-container">
                        <input hidden type="integer" value="<?= $commentId; ?>" id="comment_id" name="comment_id">
                        <input hidden type="integer" value="<?= $postId; ?>" id="post_id" name="post_id">
                        <label for="reply-comment-text" class="sr-only">reply comment</label>
                        <textarea name="reply-comment" class="hidden" id="reply-comment"></textarea>
                        <p class="border rounded-md py-1 pl-2 pr-4 mb-2 " id="comment-content"></p>
                    </div>

                        <button type="submit" class=" hidden send-edit-btn ml-1 " id="send-edit-comment-btn"><svg width="23" height="23" viewBox="0 0 23 23" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M18.7909 7.9754L18.3406 8.19261C18.3675 8.24873 18.3782 8.31124 18.3716 8.37314C18.3651 8.43503 18.3415 8.49384 18.3035 8.543L18.3034 8.5431L8.02983 21.8485C8.02976 21.8486 8.02968 21.8487 8.02961 21.8488C7.99098 21.8987 7.93913 21.9365 7.88003 21.9581C7.82082 21.9797 7.7567 21.9841 7.69508 21.9707C7.63345 21.9573 7.57684 21.9267 7.53182 21.8824C7.48679 21.8381 7.45521 21.7818 7.44074 21.7202L5.73589 14.401L5.71069 14.2928L5.64212 14.2055L1.00455 8.30304C0.9655 8.25327 0.941324 8.19341 0.934823 8.1304C0.928322 8.06739 0.939763 8.00385 0.967773 7.94713C0.995783 7.89041 1.03922 7.84282 1.09303 7.80984C1.14681 7.77687 1.2088 7.75982 1.27183 7.76068C1.27186 7.76068 1.27189 7.76068 1.27192 7.76068L18.0446 8.00361L18.0447 8.00361C18.1067 8.00449 18.1673 8.02266 18.2196 8.05612C18.2719 8.08958 18.3139 8.137 18.3408 8.19309L18.7909 7.9754ZM18.7909 7.9754C18.8579 8.11518 18.8847 8.27094 18.8683 8.42523C18.852 8.57952 18.7931 8.72625 18.6983 8.84898L18.7909 7.9754ZM6.76617 14.1549L6.40494 14.3293L6.49601 14.7202L7.69305 19.8585L7.93155 20.8823L8.5743 20.0499L15.613 10.9339L15.0019 10.1772L6.76617 14.1549ZM14.7123 9.57343L14.5041 8.62214L3.01273 8.45571L1.96338 8.44051L2.61203 9.26619L5.86764 13.4103L6.11532 13.7255L6.47654 13.5511L14.7123 9.57343Z" fill="#212121" stroke="black" />
                        </svg></button>
        </article>
    </section>
</main>
</body>
</html>