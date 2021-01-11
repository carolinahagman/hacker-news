<?php require __DIR__ . '/app/autoload.php'; ?>
<?php require __DIR__ . '/views/header.php';
if (isset($_SESSION['user'])) {
    $user = $_SESSION['user'];
}

$id = $_GET['id'];
$post = getPostById($database, $id);
$comments = getCommentsByPostId($database, $id);

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
            if (strlen($post['image']) !== 0) : ?><img class="w-full pb-2" src="/app/posts/uploads/<?= $post['image'] ?>" alt="">
            <?php endif; ?>
            <p class=""><?= $post['content']; ?></p>
        </article>
        <div>
            <p><?= $post['create_date']; ?></p>
            <p>upvotes</p>
            <?php if (isset($_SESSION['user'])) :
                $user = $_SESSION['user'];
                if ($user['id'] === $post['user_id']) : ?>
                    <a href="/editPost.php?id=<?= $id ?>">Edit</a>
                <?php endif; ?>

        </div>
        <article>
            <form action="/app/posts/addComment.php?id=<?= $id ?>" method="post">
                <div class="">
                    <label for="new-comment" class="">Write comment</label>
                    <input class="bg-transparent focus:ring-gray-500 focus:border-gray-500 block mb-2 w-full pl-2 pr-12 sm:text-sm border-gray-300 rounded-md placeholder-gray-600 focus:placeholder-gray-200 dark:placeholder-gray-200 dark:focus:placeholder-gray-600 dark:text-gray-200" type="text" name="new-comment" id="new-comment" required>
                    <button type="submit" name="submit" class="text-center text-lg w-28 bg-gray-200 rounded-sm mt-2 uppercase text-gray-900 dark:text-gray-200 dark:bg-gray-800">Comment</button>
                </div>
            </form>
        <?php endif; ?>
        <?php foreach ($comments as $comment) : ?>
            <div><small><?= $comment['alias'] ?></small>
                <div>
                    <p><?= $comment['content'] ?></p>
                    <p>*</p>
                </div>
            </div>
        <?php endforeach; ?>

        </article>
    </section>


</main>
