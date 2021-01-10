<?php

require __DIR__ . '/app/autoload.php';
require __DIR__ . '/views/header.php';
// require __DIR__ . '/app/posts/editPost.php';

if (!loggedIn()) {
	redirect('/');
}
$id = $_GET['id'];
$post = getPostById($database, $id); ?>

<section>
	<form class="flex flex-col items-center" action="/app/posts/editPost.php?id=<?= $id ?>" method="post" enctype="multipart/form-data">
		<h1>Edit Post</h1>
		<div class="">
			<label for="updated-title" class="">title</label>
			<input class="bg-transparent focus:ring-gray-500 focus:border-gray-500 block mb-2 w-full pl-2 pr-12 sm:text-sm border-gray-300 rounded-md placeholder-gray-600 focus:placeholder-gray-200 dark:placeholder-gray-200 dark:focus:placeholder-gray-600 dark:text-gray-200" value="<?= $post['title'] ?>" type="text" name="updated-title" id="updated-title">
		</div>
		<div class="">
			<label for="updated-link" class="">link</label>
			<input class="bg-transparent focus:ring-gray-500 focus:border-gray-500 block mb-2 w-full pl-2 pr-12 sm:text-sm border-gray-300 rounded-md placeholder-gray-600 focus:placeholder-gray-200 dark:placeholder-gray-200 dark:focus:placeholder-gray-600 dark:text-gray-200" value="<?= $post['link'] ?>" type="text" name="updated-link" id="updated-link">
		</div>
		<div class="">
			<!-- <img class="w-24" src="/app/posts/uploads/<?= $post['image'] ?>" alt=""> -->
			<label for="updated-post-image" class="">update image</label>
			<input class="bg-transparent focus:ring-gray-500 focus:border-gray-500 block mb-2 w-full pl-2 pr-12 sm:text-sm border-gray-300 rounded-md placeholder-gray-600 focus:placeholder-gray-200 dark:placeholder-gray-200 dark:focus:placeholder-gray-600 dark:text-gray-200" type="file" accept=".jpg, .jpeg, .png, .svg" name="updated-post-image" id="updated-post-image">
		</div>
		<div class="">
			<label for="updated-content" class="">content</label>
			<textarea class="bg-transparent focus:ring-gray-500 focus:border-gray-500 block mb-2 w-full pl-2 pr-12 sm:text-sm border-gray-300 rounded-md placeholder-gray-600 focus:placeholder-gray-200 dark:placeholder-gray-200 dark:focus:placeholder-gray-600 dark:text-gray-200" type="text" name="updated-content" id="updated-content"> <?= $post['content'] ?> </textarea>
		</div>

		<button type="submit" name="submit" class="text-center text-lg w-28 bg-gray-200 rounded-sm mt-2 uppercase text-gray-900 dark:text-gray-200 dark:bg-gray-800">Edit post</button>
	</form>
	<form class="flex flex-col items-center" action="/app/posts/editPost.php?id=<?= $id ?>" id="delete-form" method="post" enctype="multipart/form-data">
		<input type="hidden" name="delete-post" value="true">
		<button type="submit" name="delete-post-btn" id="delete-post-btn" class="text-center text-lg w-28 bg-red-600 rounded-sm mt-2 uppercase text-gray-900 dark:text-gray-200">Delete</button>
	</form>
</section>

<?php require __DIR__ . '/views/footer.php'; ?>
