<?php

require __DIR__ . '/app/autoload.php';
require __DIR__ . '/views/header.php';

$posts = getAllPosts($database);
if (isset($_SESSION['user'])) {
    $upvotesUser = getUpvotesByUser($database, $_SESSION['user']['id']);
}
$sorting = 'new';
if (isset($_GET['sorting'])) {
    $sorting = $_GET['sorting'];
}
switch ($sorting) {
    case 'upvote':
        usort($posts, function ($a, $b) use ($database) {
            return count(getUpvotesByPost($database, $b['id'])) - count(getUpvotesByPost($database, $a['id']));
        });
        break;
    case 'comment':
        usort($posts, function ($a, $b) use ($database) {
            return count(getCommentsByPostId($database, $b['id'])) - count(getCommentsByPostId($database, $a['id']));
        });
        break;

    default:
        usort($posts, "sortByDate");
        break;
}
?>
<main>
    <ul class="flex justify-center">
        <li class="mx-1 <?php $sorting === 'new' ? 'selected' : '' ?>">
            <form action="/?sorting=new" method="POST">
                <button type="submit" id="new-sorting-btn" class="">new</button>
            </form>
        </li>
        <li class="mx-1 <?php $sorting === 'upvote' ? 'selected' : '' ?>">
            <form action="/?sorting=upvote" method="POST">
                <button type="submit" id="upvote-sorting-btn" class="">upvotes</button>
            </form>
        </li>
        <li class="mx-1 <?php $sorting === 'comment' ? 'selected' : '' ?>">
            <form action="/?sorting=comment" method="POST">
                <button type="submit" id="comment-sorting-btn" class="">
                    comments
                </button>
            </form>
        </li>
    </ul>
    <section class="flex flex-col items-center">
        <?php foreach ($posts as $post) :
            $upvotesPosts = getUpvotesByPost($database, $post['id']);
            $postDate = formatDate($post['create_date']); ?>
            <div class="w-11/12 max-w-md bg-gray-50 rounded-md m-1 shadow-sm flex justify-between py-3 pl-1 pr-3">
                <div class="flex items-center">
                    <div>
                        <?php if (isset($_SESSION['user'])) : ?>
                            <button data-user-id="<?= $_SESSION['user']['id'] ?>" data-post-id="<?= $post['id'] ?>" type="submit" id="upvote-btn<?= $post['id'] ?>" class="flex flex-col items-start justify-center upvote-btn">
                                <div class="mr-4 arrow-up <?= in_array(array('user_id' => $_SESSION['user']['id'], 'post_id' => $post['id']), $upvotesUser) ? 'orange' : 'black' ?>"></div>
                                <small class="w-1/2 upvote-counter"><?= countUpvotes($database, $post['id']) ?></small>
                            </button>
                        <?php else : ?>
                            <button type="submit" id="upvote-btn<?= $post['id'] ?>" class="flex flex-col items-start justify-center upvote-btn">
                                <div class="mr-4 arrow-up black"></div>
                                <small class="w-1/2 upvote-counter"><?= countUpvotes($database, $post['id']) ?></small>
                            </button>
                        <?php endif; ?>
                    </div>
                    <div class="h-full flex flex-col">
                        <h1 class="text-md font-semibold uppercase">
                            <?= $post['title']; ?>
                            <?php
                            if (strlen($post['link']) !== 0) : ?>
                                <a class="text-sm font-thin lowercase" href="<?= $post['link']; ?>">(link)</a>
                            <?php endif; ?>
                        </h1>
                        <small class="font-thin ">posted by
                            <a href="/profile.php?alias=<?= $post['alias'] ?>"><?= $post['alias']; ?> </a> </small>
                        <small><?= $postDate ?></small>
                    </div>
                </div>
                <div class="flex flex-col items-end justify-between">
                    <?php if (strlen($post['image']) !== 0) : ?>
                        <img class="w-16 h-16 object-cover" src="/app/posts/uploads/<?= $post['image'] ?>" alt="" />
                    <?php else : ?>
                        <div></div>
                    <?php endif; ?>
                    <a class="" href="/post.php?id=<?= $post['id'] ?>"><?= countComments($database, $post['id']) ?>
                    </a>
                </div>
            </div>
        <?php endforeach; ?>
    </section>
    <div class="flex justify-center w-full sticky bottom-0">
        <?php if (isset($_SESSION['user'])) : ?>
            <a class="text-4xl text-center w-full bg-white pb-2" href="/newPost.php">+</a>
        <?php endif; ?>
    </div>
</main>
<?php require __DIR__ . '/views/footer.php'; ?>
