<?php require __DIR__ . '/app/autoload.php'; ?>
<?php require __DIR__ . '/views/header.php'; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Post</title>
</head>

<body>
    <section>
        <?php if (loggedIn()) : ?>
            <form class="flex flex-col items-center" action="/app/posts/store.php" method="post" enctype="multipart/form-data">
                <h1>New Post</h1>
                <div class="">
                    <label for="title" class="">title</label>
                    <input class="bg-transparent focus:ring-gray-500 focus:border-gray-500 block mb-2 w-full pl-2 pr-12 sm:text-sm border-gray-300 rounded-md placeholder-gray-600 focus:placeholder-gray-200 dark:placeholder-gray-200 dark:focus:placeholder-gray-600 dark:text-gray-200" type="text" name="title" id="title" required>
                </div>
                <div class="">
                    <label for="link" class="">link</label>
                    <input class="bg-transparent focus:ring-gray-500 focus:border-gray-500 block mb-2 w-full pl-2 pr-12 sm:text-sm border-gray-300 rounded-md placeholder-gray-600 focus:placeholder-gray-200 dark:placeholder-gray-200 dark:focus:placeholder-gray-600 dark:text-gray-200" type="text" name="link" id="link">
                </div>

                <div class="">
                    <label for="content" class="">content</label>
                    <textarea class="bg-transparent focus:ring-gray-500 focus:border-gray-500 block mb-2 w-full pl-2 pr-12 sm:text-sm border-gray-300 rounded-md placeholder-gray-600 focus:placeholder-gray-200 dark:placeholder-gray-200 dark:focus:placeholder-gray-600 dark:text-gray-200" type="text" name="content" id="content"></textarea>
                </div>

                <button type="submit" name="submit" class="text-center text-lg w-28 bg-gray-200 rounded-sm mt-2 uppercase text-gray-900 dark:text-gray-200 dark:bg-gray-800">Upload</button>
            </form>
        <?php else :
            redirect('/');
        endif; ?>
    </section>

</body>

</html>
