<?php

require __DIR__ . '/app/autoload.php';
require __DIR__ . '/views/header.php';



$alias = $_GET['alias'];
$userInfo = getUserProfile($database, $alias);

?>
<main class="w-full flex flex-col items-center">
    <section class=" w-full max-w-md flex flex-col items-center shadow-md rounded-lg">
        <div class="flex mt-3">
            <img class="w-20 h-20 object-cover rounded-full" src="/app/users/uploads/<?= $userInfo['avatar'] ?>" alt="avatar">
            <ul class=" ml-4">
                <li class="text-lg"><?= $userInfo['alias']; ?></li>
                <li class="text-sm">created at <?= $userInfo['create_date']; ?></li>

            </ul>
        </div>
        <p class="mt-2 mb-6  justify-self-start"><?= $userInfo['biography']; ?></p>
        <ul class="pb-10 flex flex-col items-center">
            <li><a href="/myPosts.php?userid=<?= $userInfo['id'] ?>">POSTS</a></li>
        </ul>
    </section>
</main>
<?php require __DIR__ . '/views/footer.php'; ?>
