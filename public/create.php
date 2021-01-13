<?php require __DIR__ . '/app/autoload.php'; ?>
<?php require __DIR__ . '/views/header.php'; ?>



<article class="flex items-center flex-col mt-10 w-screen">
    <?php if (isset($_SESSION['message'])) {
        echo $_SESSION['message'];
        unset($_SESSION['message']);
    } ?>
    <h1 class="mb-5 uppercase text-xl text-gray-900">Create account</h1>

    <form class="flex flex-col items-center" action="/app/users/create.php" method="post">
        <div class="">
            <label for="alias" class="sr-only ">Alias</label>
            <input class="bg-transparent focus:ring-gray-500 focus:border-gray-500 block mb-2 w-full pl-2 pr-12 sm:text-sm border-gray-300 rounded-md placeholder-gray-600 focus:placeholder-gray-200" type="text" name="alias" id="alias" placeholder="alias" required>
        </div>
        <div class="">
            <label for="email" class="sr-only">Email</label>
            <input class="bg-transparent focus:ring-gray-500 focus:border-gray-500 block mb-2 w-full pl-2 pr-12 sm:text-sm border-gray-300 rounded-md placeholder-gray-600 focus:placeholder-gray-200" type="email" name="email" id="email" placeholder="email" required>
        </div>
        <div class="">
            <label for="password" class="sr-only">Password</label>
            <input class="bg-transparent focus:ring-gray-500 focus:border-gray-500 block mb-2 w-full pl-2 pr-12 sm:text-sm border-gray-300 rounded-md placeholder-gray-600 focus:placeholder-gray-200" type="password" name="password" id="password" placeholder="password" required>
        </div>
        <div class="">
            <label for="confirm-password" class="sr-only">Confirm password</label>
            <input class="bg-transparent focus:ring-gray-500 focus:border-gray-500 block mb-2 w-full pl-2 pr-12 sm:text-sm border-gray-300 rounded-md placeholder-gray-600 focus:placeholder-gray-200" type="password" name="confirm-password" id="confirm-password" placeholder="confirm password" required>
        </div>
        <button type="submit" name="submit" class="text-center text-lg w-28 bg-gray-200 rounded-sm mt-2 uppercase text-gray-900">Create</button>
    </form>
</article>

<?php require __DIR__ . '/views/footer.php'; ?>
