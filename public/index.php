<?php

require __DIR__ . '/app/autoload.php';
require __DIR__ . '/views/header.php';

$posts = getAllPosts($database); ?>
<main>
	<ul class="flex justify-center ">
		<li class="mx-1">new</li>
		<li class="mx-1">upvotes</li>
		<li class="mx-1">comments</li>
	</ul>
	<section>
		<?php foreach ($posts as $post) :
		?>
			<a class="" href="/post.php?id=<?= $post['id'] ?>">
				<div>upvotes</div>
				<div>
					<h1><?= $post['title']; ?> <a class="" href="<?= $post['link']; ?>">(link)</a></h1>
					<small>posted by <?= $post['alias']; ?></small>
					<p><?= $post['create_date']; ?></p>
				</div>
				<div><img src="" alt=""> </div>
			</a>
		<?php endforeach; ?>
	</section>
	<div class="flex justify-center w-full fixed bottom-2"><?php if (isset($_SESSION['user'])) : ?>
			<a class="text-6xl" href="/newPost.php">+</a>
		<?php endif; ?>
	</div>
</main>
<?php require __DIR__ . '/views/footer.php'; ?>
