<?php

require __DIR__ . '/app/autoload.php';
require __DIR__ . '/views/header.php';
$userId = $_GET['userid'];
$posts = getPostsByUserId($database, $userId);
$comments = getCommentsByUserId($database, $userId); 
$upvotesPosts = getUpvotesByUser($database, $userId);
$upvotesComments = getUpvotesCommentByUser($database, $userId); ?>

<section class="flex flex-col items-center">
<!-- Get all posts and their votes  -->
<div class="pb-10 flex flex-col items-center">
<h1 class="text-4xl font-bold">POSTS</h1>
</div>
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
                <a class="w-full flex" href="/post.php?id=<?= $post['id'] ?>"> <p class="ml-2"><?= countComments($database, $post['id']) ?></p>
                </a>
            </div>
        </div>
    <?php endforeach; ?>

<!-- Get all comments and their votes  -->
<div class="pb-10 flex flex-col items-center">
<h1 class="text-4xl font-bold">COMMENTS</h1>
</div>
    <?php foreach ($comments as $comment) :
        $upvotesComment = getUpvotesByComment($database, $comment['id']);
        $commentDate = formatDate($comment['create_date']); ?>
        <div class="w-11/12 max-w-md bg-gray-50 rounded-md m-1 shadow-sm flex justify-between py-3 pl-1 pr-3">
            <div class="flex items-center">
                <div>
                    <button type="submit" id="upvoteComment-btn<?= $comment['id'] ?>" class="flex flex-col items-start justify-center upvoteComment-btn">
                        <div class="mr-4 arrow-up black"></div>
                        <small class="w-1/2 upvote-counter"><?= countCommentUpvotes($database, $comment['id']) ?></small>
                    </button>
                </div>
                <div class="h-full">
                    <h1 class="text-md font-semibold uppercase">
                        <?= $comment['content']; ?>
                    </h1>
                    <small class="font-thin ">Commented by
                        <a href="/profile.php?alias=<?= $comment['alias'] ?>"><?= $comment['alias']; ?> </a> </small>
                    <small><?= $commentDate ?></small>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
<!-- Get all votes a user has made on posts   -->
<div class="pb-10 flex flex-col items-center">
<h1 class="text-4xl font-bold">UPVOTES</h1>
</div>
    <?php foreach ($upvotesPosts as $upvotePost) :
        $post = getPostById($database, $upvotePost['post_id']);

        $createDate = formatDate($post['create_date']); ?>
        <div class="w-11/12 max-w-md bg-gray-50 rounded-md m-1 shadow-sm flex justify-between py-3 pl-1 pr-3">
            <div class="flex items-center">
                <div class="h-full">
                    <h1 class="text-md font-semibold uppercase">
                        <?= $post['title']; ?>
                    </h1>
                    <small class="font-thin ">post upvoted by
                        <a href="/profile.php?alias=<?= $comment['alias'] ?>"><?= $comment['alias']; ?> </a> </small>
                    <small><?= $createDate ?></small>
                </div>
            </div>
        </div>
    <?php endforeach; ?>

<!-- Get all votes a user has made on comments   -->
    <?php foreach ($upvotesComments as $upvoteComment) :
        $comments = getComment($database, $upvoteComment['comment_id']);
        foreach ($comments as $comment1) :
            $commentContent = $comment1['content'];
            $commentId = $comment1['id'];
            $createDate = $comment1['create_date'];
        endforeach;
        $createDate = formatDate($createDate); ?>

        <div class="w-11/12 max-w-md bg-gray-50 rounded-md m-1 shadow-sm flex justify-between py-3 pl-1 pr-3">
            <div class="flex items-center">
                <div class="h-full">
                    <h1 class="text-md font-semibold uppercase">
                        <?= $commentContent; ?>
                    </h1>
                    <small class="font-thin ">comment upvoted by
                        <a href="/profile.php?alias=<?= $comment['alias'] ?>"><?= $comment['alias']; ?> </a> </small>
                    <small><?= $createDate ?></small>
                </div>
            </div>
        </div>
    <?php endforeach; ?>

</section>
