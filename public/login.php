<?php

require __DIR__ . '/app/autoload.php';
require __DIR__ . '/views/header.php'; ?>

<article class="flex items-center flex-col mt-10 w-screen">
    <?php if (isset($_SESSION['error'])) {
        echo $_SESSION['error'];
        unset($_SESSION['error']);
    } ?>
    <h1 class="mb-5 uppercase text-xl text-gray-900 dark:text-gray-200">Login</h1>
    <form class="flex flex-col items-center" action="app/users/login.php" method="post">
        <div class="form-group">
            <label for="email" class="sr-only">Email</label>
            <input class="bg-transparent focus:ring-gray-500 focus:border-gray-500 block mb-2 w-full pl-2 pr-12 sm:text-sm border-gray-300 rounded-md placeholder-gray-600 focus:placeholder-gray-200 dark:placeholder-gray-200 dark:focus:placeholder-gray-600 dark:text-gray-200" type="email" name="email" id="email" placeholder="email" required>
        </div><!-- /form-group -->

        <div class="form-group">
            <label for="password" class="sr-only">Password</label>
            <input class="bg-transparent focus:ring-gray-500 focus:border-gray-500 block mb-2 w-full pl-2 pr-12 sm:text-sm border-gray-300 rounded-md placeholder-gray-600 focus:placeholder-gray-200 dark:placeholder-gray-200 dark:focus:placeholder-gray-600 dark:text-gray-200" type="password" name="password" id="password" placeholder="password" required>
        </div><!-- /form-group -->

        <button type="submit" class="text-center text-lg w-28 bg-gray-200 rounded-sm mt-2 uppercase text-gray-900 dark:text-gray-200 dark:bg-gray-800">Login</button>
        <a class="text-gray-900 dark:text-gray-200 mt-2" href="#">forgot password?</a>
        <a class="text-gray-900 dark:text-gray-200" href="/create.php">create account</a>
    </form>
</article>

<?php require __DIR__ . '/views/footer.php'; ?>
