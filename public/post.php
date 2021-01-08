<?php require __DIR__ . '/app/autoload.php'; ?>
<?php require __DIR__ . '/views/header.php'; ?>

<main>
    <article>
        <a href="">
            <h1>This is the title</h1>
        </a>
        <p>This is where the content will be</p>
    </article>
    <div>
        <p>date</p>
        <p>likes</p>
    </div>
    <section>
        <div class="">
            <label for="new-comment" class="">Write comment</label>
            <input class="bg-transparent focus:ring-gray-500 focus:border-gray-500 block mb-2 w-full pl-2 pr-12 sm:text-sm border-gray-300 rounded-md placeholder-gray-600 focus:placeholder-gray-200 dark:placeholder-gray-200 dark:focus:placeholder-gray-600 dark:text-gray-200" type="text" name="new-comment" id="new-comment" required>
            <button type="submit" name="submit" class="text-center text-lg w-28 bg-gray-200 rounded-sm mt-2 uppercase text-gray-900 dark:text-gray-200 dark:bg-gray-800">Comment</button>
        </div>

    </section>


</main>
