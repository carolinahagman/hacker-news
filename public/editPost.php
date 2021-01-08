<?php require __DIR__ . '/app/autoload.php';
require __DIR__ . '/views/header.php';

if (!loggedIn()) {
    redirect('/');
}
$id = $_GET['id'];
$post = getPostById($database, $id); ?>

<section>
    <form class="flex flex-col items-center" action="/app/posts/store.php" method="post" enctype="multipart/form-data">
        <h1>Edit Post</h1>
        <div class="">
            <label for="title" class="">title</label>
            <input class="bg-transparent focus:ring-gray-500 focus:border-gray-500 block mb-2 w-full pl-2 pr-12 sm:text-sm border-gray-300 rounded-md placeholder-gray-600 focus:placeholder-gray-200 dark:placeholder-gray-200 dark:focus:placeholder-gray-600 dark:text-gray-200" value="<?= $post['title'] ?>" type="text" name="title" id="title" required>
        </div>
        <div class="">
            <label for="link" class="">link</label>
            <input class="bg-transparent focus:ring-gray-500 focus:border-gray-500 block mb-2 w-full pl-2 pr-12 sm:text-sm border-gray-300 rounded-md placeholder-gray-600 focus:placeholder-gray-200 dark:placeholder-gray-200 dark:focus:placeholder-gray-600 dark:text-gray-200" value="<?= $post['link'] ?>" type="text" name="link" id="link">
        </div>
        <div class="">
            <img class="w-24" src="/app/posts/uploads/<?= $post['image'] ?>" alt="">
            <input class="bg-transparent focus:ring-gray-500 focus:border-gray-500 block mb-2 w-full pl-2 pr-12 sm:text-sm border-gray-300 rounded-md placeholder-gray-600 focus:placeholder-gray-200 dark:placeholder-gray-200 dark:focus:placeholder-gray-600 dark:text-gray-200" type="file" accept=".jpg, .jpeg, .png, .svg" name="post-image" id="post-image">
        </div>
        <div class="">
            <label for="content" class="">content</label>
            <textarea class="bg-transparent focus:ring-gray-500 focus:border-gray-500 block mb-2 w-full pl-2 pr-12 sm:text-sm border-gray-300 rounded-md placeholder-gray-600 focus:placeholder-gray-200 dark:placeholder-gray-200 dark:focus:placeholder-gray-600 dark:text-gray-200" type="text" name="content" id="content"> <?= $post['content'] ?> </textarea>
        </div>

        <button type="submit" name="submit" class="text-center text-lg w-28 bg-gray-200 rounded-sm mt-2 uppercase text-gray-900 dark:text-gray-200 dark:bg-gray-800">Upload</button>
    </form>
</section>
