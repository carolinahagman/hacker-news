<?php

require __DIR__ . '/app/autoload.php';
require __DIR__ . '/views/header.php';

if (!loggedIn()) {
    redirect('/');
}
?>

<section class="dark:text-white">
    <div>
        <img class="w-32 rounded-full" src="/app/users/uploads/<?= $_SESSION['user']['avatar'] ?>" alt="avatar">
        <ul>
            <li><?= $_SESSION['user']['alias']; ?></li>
            <li>created at <?= $_SESSION['user']['create_date']; ?></li>
            <li><button>edit profile</button></li>
        </ul>
    </div>
    <p><?= $_SESSION['user']['biography']; ?></p>
    <ul>
        <li><a href="">POSTS</a></li>
        <li><a href="">COMMENTS</a></li>
        <li><a href="">UPVOTES</a></li>
    </ul>
</section>
<section>
    <img class="w-16 rounded-full" src="/app/users/uploads/<?= $_SESSION['user']['avatar'] ?>" alt="avatar">
    <form class="flex flex-col items-center" action="/app/users/editProfile.php" method="post" enctype="multipart/form-data">
        <div class="">
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
