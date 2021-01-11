<?php

require __DIR__ . '/app/autoload.php';
require __DIR__ . '/views/header.php';

if (!loggedIn()) {
    redirect('/');
} ?>

<section class="dark:text-white">
    <div>
        <img class="w-32 rounded-full" src="/app/users/uploads/<?= $_SESSION['user']['avatar'] ?>" alt="avatar">
        <ul>
            <li><?= $user['alias']; ?></li>
            <li>created at <?= $user['create_date']; ?></li>
        </ul>
    </div>
    <p><?= $user['biography']; ?></p>
    <ul>
        <li><a href="">POSTS</a></li>
        <li><a href="">COMMENTS</a></li>
        <li><a href="">UPVOTES</a></li>
    </ul>
</section>
