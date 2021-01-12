<?php

require __DIR__ . '/app/autoload.php';
require __DIR__ . '/views/header.php';

$posts = getAllPosts($database);
$sorting = 'new';
if (isset($_GET['sorting'])) {
    $sorting = $_GET['sorting'];
}
switch ($sorting) {
    case 'upvote':
        usort($posts, "sortByUpvotes");
        break;
    case 'comment':
        usort($posts, "sortByComments");
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
        ?>

            <div class="w-11/12 max-w-md bg-gray-50 rounded-md m-1 shadow-sm flex justify-between py-3 pl-1 pr-3">

                <div class="flex items-center">
                    <div>
                        <div class="mr-4 arrow-up"></div>
                        <small>20</small>
                    </div>
                    <div class="h-full">
                        <h1 class="text-md font-semibold uppercase">
                            <?= $post['title']; ?>
                            <?php
                            if (strlen($post['link']) !== 0) : ?>
                                <a class="text-sm font-thin lowercase" href="<?= $post['link']; ?>">(link)</a>
                            <?php endif; ?>
                        </h1>
                        <small class="font-thin">posted by
                            <a href="/profile.php?alias=<?= $post['alias'] ?>"><?= $post['alias']; ?> </a> </small>
                        <p><?= $post['create_date']; ?></p>
                    </div>
                </div>
                <div class="flex flex-col items-end justify-between">
                    <?php if (strlen($post['image']) !== 0) : ?>
                        <img class="w-16 h-16 object-cover" src="/app/posts/uploads/<?= $post['image'] ?>" alt="" />
                    <?php else : ?>
                        <div></div>
                    <?php endif; ?>
                    <a class="w-full flex" href="/post.php?id=<?= $post['id'] ?>" <p class="ml-2"><?= countComments($database, $post['id']) ?></p>
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
