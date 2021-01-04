<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>profile</title>
</head>

<body>
    <?php if (isset($user)) : ?>
        <section>
            <div>
                <img src="/public/app/users/uploads/<?= $user['avatar'] ?>" alt="avatar">
                <ul>
                    <li><?= $user['alias']; ?></li>
                    <li>created at <?= $user['create_date']; ?></li>
                    <li>edit profile</li>
                </ul>
            </div>
            <p><?= $user['biography']; ?></p>

            <ul>
                <li>POSTS</li>
                <li>COMMENTS</li>
                <li>UPVOTES</li>
            </ul>

        </section>

        <section>
            <img src="" alt="avatar">
            <form class="flex flex-col items-center" action="/app/users/editProfile.php" method="post">
                <div class="">
                    <label for="change-avatar" class="">change avatar</label>
                    <input class="bg-transparent focus:ring-gray-500 focus:border-gray-500 block mb-2 w-full pl-2 pr-12 sm:text-sm border-gray-300 rounded-md placeholder-gray-600 focus:placeholder-gray-200 dark:placeholder-gray-200 dark:focus:placeholder-gray-600 dark:text-gray-200" type="file" accept=".jpg, .jpeg, .png, .svg" name=" change-avatar" id="change-avatar">
                </div>
                <div class="">
                    <label for="biography" class="">biography</label>
                    <input class="bg-transparent focus:ring-gray-500 focus:border-gray-500 block mb-2 w-full pl-2 pr-12 sm:text-sm border-gray-300 rounded-md placeholder-gray-600 focus:placeholder-gray-200 dark:placeholder-gray-200 dark:focus:placeholder-gray-600 dark:text-gray-200" type="text" name="biography" id="biography">
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
        </section>
    <?php endif; ?>

</body>

</html>