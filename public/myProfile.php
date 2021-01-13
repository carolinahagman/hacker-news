<?php

require __DIR__ . '/app/autoload.php';
require __DIR__ . '/views/header.php';

if (!loggedIn()) {
    redirect('/');
}
?>
<main class="w-full flex flex-col items-center">
    <div class="flip-card">
        <div class="flip-card-inner">
            <section class="pt-10 w-full max-w-md flex flex-col items-center shadow-md rounded-lg flip-card-front">

                <img class="w-32 h-32 object-cover rounded-full" src="/app/users/uploads/<?= $_SESSION['user']['avatar'] ?>" alt="avatar">
                <ul class="mt-6">
                    <li class="text-lg"><?= $_SESSION['user']['alias']; ?></li>
                    <li class="text-sm">created at <?= formatDate($_SESSION['user']['create_date']); ?></li>
                    <li><button class="font-semibold edit-profile-btn">edit profile</button></li>
                </ul>

                <p class="mt-2 mb-6 text-lg justify-self-start"><?= $_SESSION['user']['biography']; ?></p>
                <div class="pb-10 flex flex-col items-center">
                    <a class="text-4xl font-bold" href="/myPosts.php?userid=<?= $_SESSION['user']['id'] ?>">POSTS</a>
                </div>
            </section>
            <section class="w-full max-w-md flex flex-col items-center shadow-md rounded-lg py-2 flip-card-back">
                <img class="w-12 h-12 object-cover mt-2 rounded-full" src="/app/users/uploads/<?= $_SESSION['user']['avatar'] ?>" alt="avatar">
                <form class="w-full flex flex-col items-center" action="/app/users/editProfile.php" method="post" enctype="multipart/form-data">
                    <div class="flex flex-col items-center">
                        <label for="change-avatar" class="">change avatar</label>
                        <input class="bg-transparent focus:ring-gray-500 focus:border-gray-500 block mb-2 w-full pl-2 pr-12 sm:text-sm border-gray-300 rounded-md placeholder-gray-600 focus:placeholder-gray-200" type="file" accept=".jpg, .jpeg, .png, .svg" name=" change-avatar" id="change-avatar">
                    </div>
                    <div class="">
                        <label for="change-alias" class="">alias</label>
                        <input class="bg-transparent focus:ring-gray-500 focus:border-gray-500 block mb-2 w-full pl-2 pr-12 sm:text-sm border-gray-300 rounded-md placeholder-gray-600 focus:placeholder-gray-200" type="text" name="change-alias" id="change-alias">
                    </div>
                    <div class="">
                        <label for="biography" class="">biography</label>
                        <textarea class="bg-transparent focus:ring-gray-500 focus:border-gray-500 block mb-2 w-full pl-2 pr-12 sm:text-sm border-gray-300 rounded-md placeholder-gray-600 focus:placeholder-gray-200" type="text" name="change-biography" id="change-biography"></textarea>
                    </div>
                    <div class="">
                        <label for="change-email" class="">email</label>
                        <input class="bg-transparent focus:ring-gray-500 focus:border-gray-500 block mb-2 w-full pl-2 pr-12 sm:text-sm border-gray-300 rounded-md placeholder-gray-600 focus:placeholder-gray-200" type="email" name="change-email" id="change-email">
                    </div>
                    <div class="">
                        <label for="change-password" class="">password</label>
                        <input class="bg-transparent focus:ring-gray-500 focus:border-gray-500 block mb-2 w-full pl-2 pr-12 sm:text-sm border-gray-300 rounded-md placeholder-gray-600 focus:placeholder-gray-200" type="password" name="change-password" id="change-password">
                    </div>
                    <button type="submit" name="submit" class="text-center text-lg w-28 bg-gray-200 rounded-sm mt-2 uppercase text-gray-900">Update</button>
                </form>
                <form class="flex flex-col items-center" action="/app/users/editProfile.php" id="delete-profile-form" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="delete-profile" value="true">
                    <button type="submit" name="delete-profile-btn" id="delete-profile-btn" class="text-center text-lg w-28 bg-red-600 rounded-sm mt-2 uppercase text-gray-900 0">Delete</button>
                </form>
                <button id="cancel-btn" class="text-center text-lg w-28 bg-gray-200 rounded-sm mt-2 uppercase text-gray-900 ">Cancel</button>


            </section>
        </div>
    </div>
</main>
<?php require __DIR__ . '/views/footer.php'; ?>
