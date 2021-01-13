<?php

require __DIR__ . '/app/autoload.php';
require __DIR__ . '/views/header.php';
$userId = $_GET['userid'];
$posts = getPostsByUserId($database, $userId); ?>

<section class="flex flex-col items-center">
    <?php foreach ($posts as $post) :
        $upvotesPosts = getUpvotesByPost($database, $post['id']);
        $postDate = formatDate($post['create_date']); ?>
        <div class="w-11/12 max-w-md bg-gray-50 rounded-md m-1 shadow-sm flex justify-between py-3 pl-1 pr-3">
            <div class="flex items-center">
                <div>
                    <button type="submit" id="upvote-btn<?= $post['id'] ?>" class="flex flex-col items-start justify-center upvote-btn">
                        <div class="mr-4 arrow-up black"></div>
                        <small class="w-1/2 upvote-counter"><?= countUpvotes($database, $post['id']) ?></small>
                    </button>

                </div>
                <div class="h-full">
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
                <a class="w-full flex" href="/post.php?id=<?= $post['id'] ?>" <p class="ml-2"><?= countComments($database, $post['id']) ?></p>
                </a>
            </div>
        </div>
    <?php endforeach; ?>
</section>
