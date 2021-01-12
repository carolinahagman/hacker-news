<?php require __DIR__ . '/app/autoload.php'; ?>
<?php require __DIR__ . '/views/header.php';

if (isset($_SESSION['user'])) {
    $user = $_SESSION['user'];
}
$id = $_GET['id'];
$post = getPostById($database, $id);
$comments = getCommentsByPostId($database, $id);
getUpvotesByPost($database, $id);
?>

<main class="w-full flex flex-col items-center">
    <section class="w-11/12 max-w-md">
        <article class="p-4 shadow-md rounded-md mb-2">
            <a href=<?= $post['link']; ?>>
                <h1 class="text-xl uppercase text-center"><?= $post['title']; ?>
                    <?php
                    if (strlen($post['link']) !== 0) : ?>
                        <small class="text-sm font-thin lowercase">(link)</small>
                    <?php endif; ?>
                </h1>
            </a>
            <?php

            if (strlen($post['image']) !== 0) : ?><img class="w-full py-2" src="/app/posts/uploads/<?= $post['image'] ?>" alt="">
            <?php endif; ?>
            <p class=""><?= $post['content']; ?></p>
        </article>
        <div class="flex justify-between mb-2 font-thin">
            <p><?= $post['create_date']; ?></p>
            <?php if (isset($_SESSION['user'])) :
                $user = $_SESSION['user'];
                if ($user['id'] === $post['user_id']) : ?>
                    <a href="/editPost.php?id=<?= $id ?>">Edit</a>
                <?php endif; ?>
            <?php endif; ?>
            <div class="flex">
                <?php if (isset($_SESSION['user'])) : ?>
                    <button data-user-id="<?= $_SESSION['user']['id'] ?>" data-post-id="<?= $post['id'] ?>" type="submit" id="upvote-btn<?= $post['id'] ?>" class="flex flex-col upvote-btn">
                        <div class="mr-4 arrow-up <?= ($_SESSION['user']['id'] === $upvotesUser['user_id']) ? 'orange' : 'black' ?>"></div>
                        <small class="w-1/2 upvote-counter"><?= countUpvotes($database, $post['id']) ?></small>
                    </button>
                <?php else : ?>
                    <button type="submit" id="upvote-btn<?= $post['id'] ?>" class="flex flex-col upvote-btn">
                        <div class="mr-4 arrow-up black"></div>
                        <small class="w-1/2 upvote-counter"><?= countUpvotes($database, $post['id']) ?></small>
                    </button>
                <?php endif; ?>

            </div>
        </div>
        <article>
            <form class="" action="/app/posts/addComment.php?id=<?= $id ?>" method="post">
                <?php if (isset($_SESSION['user'])) :
                    $user = $_SESSION['user']; ?>
                    <label for="new-comment" class="">write comment</label>
                    <div class="flex">
                        <input class="bg-transparent focus:ring-gray-500 focus:border-gray-500 block mb-2 w-full p-2 mr-2 sm:text-sm border-gray-300 rounded-md" type="text" name="new-comment" id="new-comment" required>
                        <button type="submit" name="submit" class="mb-3">
                            <svg width="23" height="23" viewBox="0 0 23 23" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M18.7909 7.9754L18.3406 8.19261C18.3675 8.24873 18.3782 8.31124 18.3716 8.37314C18.3651 8.43503 18.3415 8.49384 18.3035 8.543L18.3034 8.5431L8.02983 21.8485C8.02976 21.8486 8.02968 21.8487 8.02961 21.8488C7.99098 21.8987 7.93913 21.9365 7.88003 21.9581C7.82082 21.9797 7.7567 21.9841 7.69508 21.9707C7.63345 21.9573 7.57684 21.9267 7.53182 21.8824C7.48679 21.8381 7.45521 21.7818 7.44074 21.7202L5.73589 14.401L5.71069 14.2928L5.64212 14.2055L1.00455 8.30304C0.9655 8.25327 0.941324 8.19341 0.934823 8.1304C0.928322 8.06739 0.939763 8.00385 0.967773 7.94713C0.995783 7.89041 1.03922 7.84282 1.09303 7.80984C1.14681 7.77687 1.2088 7.75982 1.27183 7.76068C1.27186 7.76068 1.27189 7.76068 1.27192 7.76068L18.0446 8.00361L18.0447 8.00361C18.1067 8.00449 18.1673 8.02266 18.2196 8.05612C18.2719 8.08958 18.3139 8.137 18.3408 8.19309L18.7909 7.9754ZM18.7909 7.9754C18.8579 8.11518 18.8847 8.27094 18.8683 8.42523C18.852 8.57952 18.7931 8.72625 18.6983 8.84898L18.7909 7.9754ZM6.76617 14.1549L6.40494 14.3293L6.49601 14.7202L7.69305 19.8585L7.93155 20.8823L8.5743 20.0499L15.613 10.9339L15.0019 10.1772L6.76617 14.1549ZM14.7123 9.57343L14.5041 8.62214L3.01273 8.45571L1.96338 8.44051L2.61203 9.26619L5.86764 13.4103L6.11532 13.7255L6.47654 13.5511L14.7123 9.57343Z" fill="#212121" stroke="black" />
                            </svg>
                        </button>
                    </div>
                <?php endif; ?>
            </form>

            <?php foreach ($comments as $comment) : ?>
                <div><a href="/profile.php?alias=<?= $comment['alias'] ?>" class="ml-1"><?= $comment['alias'] ?></a>
                    <div class="flex">
                        <div class="comment-container">
                            <textarea name="edit-comment-text" class="hidden " id="edit-comment-text<?= $comment['id'] ?>"><?= $comment['content'] ?></textarea>
                            <p class="border rounded-md py-1 pl-2 pr-4 mb-2 " id="comment-content<?= $comment['id'] ?>"><?= $comment['content'] ?></p>
                        </div>
                        <?php if (isset($_SESSION['user'])) :
                            if ($_SESSION['user']['alias'] === $comment['alias']) : ?>
                                <div class="dropdown">
                                    <button class="pl-2 pr-4 pt-2 pb-2 dropdown-btn" id="dropbtn<?= $comment['id'] ?>" data-comment-id="<?= $comment['id'] ?>"><svg class="" width="3" height="11" viewBox="0 0 3 11" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <circle cx="1.5" cy="1.5" r="1.5" fill="#212121" />
                                            <circle cx="1.5" cy="5.5" r="1.5" fill="#212121" />
                                            <circle cx="1.5" cy="9.5" r="1.5" fill="#212121" />
                                        </svg>
                                    </button>
                                    <form action="/app/posts/addComment.php?id=<?= $id ?>&comment=<?= $comment['id'] ?>&action=edit" method="post">
                                        <button type="submit" class=" hidden send-edit-btn" id="send-edit-comment-btn<?= $comment['id'] ?>"><svg width="23" height="23" viewBox="0 0 23 23" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M18.7909 7.9754L18.3406 8.19261C18.3675 8.24873 18.3782 8.31124 18.3716 8.37314C18.3651 8.43503 18.3415 8.49384 18.3035 8.543L18.3034 8.5431L8.02983 21.8485C8.02976 21.8486 8.02968 21.8487 8.02961 21.8488C7.99098 21.8987 7.93913 21.9365 7.88003 21.9581C7.82082 21.9797 7.7567 21.9841 7.69508 21.9707C7.63345 21.9573 7.57684 21.9267 7.53182 21.8824C7.48679 21.8381 7.45521 21.7818 7.44074 21.7202L5.73589 14.401L5.71069 14.2928L5.64212 14.2055L1.00455 8.30304C0.9655 8.25327 0.941324 8.19341 0.934823 8.1304C0.928322 8.06739 0.939763 8.00385 0.967773 7.94713C0.995783 7.89041 1.03922 7.84282 1.09303 7.80984C1.14681 7.77687 1.2088 7.75982 1.27183 7.76068C1.27186 7.76068 1.27189 7.76068 1.27192 7.76068L18.0446 8.00361L18.0447 8.00361C18.1067 8.00449 18.1673 8.02266 18.2196 8.05612C18.2719 8.08958 18.3139 8.137 18.3408 8.19309L18.7909 7.9754ZM18.7909 7.9754C18.8579 8.11518 18.8847 8.27094 18.8683 8.42523C18.852 8.57952 18.7931 8.72625 18.6983 8.84898L18.7909 7.9754ZM6.76617 14.1549L6.40494 14.3293L6.49601 14.7202L7.69305 19.8585L7.93155 20.8823L8.5743 20.0499L15.613 10.9339L15.0019 10.1772L6.76617 14.1549ZM14.7123 9.57343L14.5041 8.62214L3.01273 8.45571L1.96338 8.44051L2.61203 9.26619L5.86764 13.4103L6.11532 13.7255L6.47654 13.5511L14.7123 9.57343Z" fill="#212121" stroke="black" />
                                            </svg></button>
                                    </form>
                                    <div id="my-dropdown<?= $comment['id'] ?>" class="dropdown-content">
                                        <button class="edit-comment-btn" data-comment-id="<?= $comment['id'] ?>">Edit</button>
                                        <a href="/app/posts/addComment.php?id=<?= $id ?>&comment=<?= $comment['id'] ?>&action=delete">Delete</a>
                                    </div>
                                </div>
                            <?php endif; ?>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endforeach; ?>

        </article>
    </section>
</main>

<?php require __DIR__ . '/views/footer.php'; ?>
