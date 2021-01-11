<?php

require __DIR__ . '/app/autoload.php';
require __DIR__ . '/views/header.php';

if (!loggedIn()) {
    redirect('/');
}
?>
<main class="w-full flex flex-col items-center">
    <section class=" w-full max-w-md flex flex-col items-center shadow-md rounded-lg">
        <div class="flex">
            <img class="w-20 rounded-full" src="/app/users/uploads/<?= $_SESSION['user']['avatar'] ?>" alt="avatar">
            <ul class="mt-6 ml-4">
                <li class="text-lg"><?= $_SESSION['user']['alias']; ?></li>
                <li class="text-xs">created at <?= $_SESSION['user']['create_date']; ?></li>
                <li><button class="font-semibold">edit profile</button></li>
            </ul>
        </div>
        <p class="mt-2 mb-6  justify-self-start"><?= $_SESSION['user']['biography']; ?></p>
        <ul class="pb-10 flex flex-col items-center">
            <li><a href="">POSTS</a></li>
            <li><a href="">COMMENTS</a></li>
            <li><a href="">UPVOTES</a></li>
        </ul>
    </section>
    <section class="w-full max-w-md flex flex-col items-center shadow-md rounded-lg">
        <img class="w-12 mt-2 rounded-full" src="/app/users/uploads/<?= $_SESSION['user']['avatar'] ?>" alt="avatar">
        <form class="w-full flex flex-col items-center" action="/app/users/editProfile.php" method="post" enctype="multipart/form-data">
            <div class="flex flex-col items-center">
                <label for="change-avatar" class="">change avatar</label>
                <input class="bg-transparent focus:ring-gray-500 focus:border-gray-500 block mb-2 w-full pl-2 pr-12 sm:text-sm border-gray-300 rounded-md placeholder-gray-600 focus:placeholder-gray-200 dark:placeholder-gray-200 dark:focus:placeholder-gray-600 dark:text-gray-200" type="file" accept=".jpg, .jpeg, .png, .svg" name=" change-avatar" id="change-avatar">
            </div>
            <div class="">
                <label for="change-alias" class="">alias</label>
                <input class="bg-transparent focus:ring-gray-500 focus:border-gray-500 block mb-2 w-full pl-2 pr-12 sm:text-sm border-gray-300 rounded-md placeholder-gray-600 focus:placeholder-gray-200 dark:placeholder-gray-200 dark:focus:placeholder-gray-600 dark:text-gray-200" type="text" name="change-alias" id="change-alias">
            </div>
            <div class="">
                <label for="biography" class="">biography</label>
                <textarea class="bg-transparent focus:ring-gray-500 focus:border-gray-500 block mb-2 w-full pl-2 pr-12 sm:text-sm border-gray-300 rounded-md placeholder-gray-600 focus:placeholder-gray-200 dark:placeholder-gray-200 dark:focus:placeholder-gray-600 dark:text-gray-200" type="text" name="change-biography" id="change-biography"></textarea>
            </div>
            <div class="">
                <label for="change-email" class="">email</label>
                <input class="bg-transparent focus:ring-gray-500 focus:border-gray-500 block mb-2 w-full pl-2 pr-12 sm:text-sm border-gray-300 rounded-md placeholder-gray-600 focus:placeholder-gray-200 dark:placeholder-gray-200 dark:focus:placeholder-gray-600 dark:text-gray-200" type="email" name="change-email" id="change-email">
            </div>
            <div class="">
                <label for="change-password" class="">password</label>
                <input class="bg-transparent focus:ring-gray-500 focus:border-gray-500 block mb-2 w-full pl-2 pr-12 sm:text-sm border-gray-300 rounded-md placeholder-gray-600 focus:placeholder-gray-200 dark:placeholder-gray-200 dark:focus:placeholder-gray-600 dark:text-gray-200" type="password" name="change-password" id="change-password">
            </div>
            <button type="submit" name="submit" class="text-center text-lg w-28 bg-gray-200 rounded-sm mt-2 uppercase text-gray-900 dark:text-gray-200 dark:bg-gray-800">Update</button>
        </form>
        <!-- <form class="flex flex-col items-center" action="/app/users/editProfile.php" id="delete-profile-form" method="post" enctype="multipart/form-data">
		<input type="hidden" name="delete-profile" value="true">
		<button type="submit" name="delete-profile-btn" id="delete-profile-btn" class="text-center text-lg w-28 bg-red-600 rounded-sm mt-2 uppercase text-gray-900 dark:text-gray-200">Delete</button>
	</form> -->
    </section>
</main>
