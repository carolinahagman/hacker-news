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
	<ul class="flex justify-center ">
		<li class="mx-1 <?php $sorting === 'new' ? 'selected' : '' ?>">
			<form action="/?sorting=new" method="POST">
				<button type="submit" id="new-sorting-btn" class=""> new </button>
			</form>
		</li>
		<li class="mx-1 <?php $sorting === 'upvote' ? 'selected' : '' ?>">
			<form action="/?sorting=upvote" method="POST">
				<button type="submit" id="upvote-sorting-btn" class=""> upvotes </button>
			</form>
		</li>
		<li class="mx-1 <?php $sorting === 'comment' ? 'selected' : '' ?>">
			<form action="/?sorting=comment" method="POST"><button type="submit" id="comment-sorting-btn" class=""> comments </button></form>
		</li>
	</ul>
	<section class="flex flex-col items-center ">
		<?php foreach ($posts as $post) :
		?>
			<div class="w-11/12 max-w-md bg-gray-50 rounded-md m-1 "><a class="w-full " href="/post.php?id=<?= $post['id'] ?>">
					<div>upvotes</div>
					<div>
						<h1 class="text-md font-semibold uppercase"><?= $post['title']; ?> <a class="text-sm font-thin lowercase" href="<?= $post['link']; ?>">(link)</a></h1>
						<small class="font-thin">posted by <?= $post['alias']; ?></small>
						<p><?= $post['create_date']; ?></p>
					</div>
					<div> <img src="/app/posts/uploads/<?= $post['image'] ?>" alt="">
						<p> <?php if (isset($_SESSION['user'])) : ?>Comment</p>
					<?php endif; ?><p>4 comments</p>

					</div>
			</div>
			</a>
		<?php endforeach; ?>
	</section>
	<div class="flex justify-center w-full fixed bottom-2"><?php if (isset($_SESSION['user'])) : ?>
			<a class="text-6xl" href="/newPost.php">+</a>
		<?php endif; ?>
	</div>
</main>
<?php require __DIR__ . '/views/footer.php'; ?>
