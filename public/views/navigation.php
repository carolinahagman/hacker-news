<nav class="w-screen p-3">

	<ul class="w-full flex justify-around dark:text-gray-600 ">
		<li class="">
			<a class="text-yellow-600 uppercase font-bold text-xl" href="/index.php"><?= $config['title']; ?></a>
		</li><!-- /nav-item -->

		<li class="">
			<?php if (isset($_SESSION['user'])) : ?>
				<a class="" href="/myProfile.php"><?= $_SESSION['user']['alias'] ?></a>
			<?php endif; ?>
		</li><!-- /nav-item -->

		<li class="">
			<?php if (isset($_SESSION['user'])) : ?>
				<a class="" href="/app/users/logout.php">logout</a>
			<?php else : ?>
				<a class="" href="login.php">login</a>
			<?php endif; ?>
		</li><!-- /nav-item -->
	</ul><!-- /navbar-nav -->
</nav><!-- /navbar -->
