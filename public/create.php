<?php require __DIR__ . '/app/autoload.php'; ?>
<?php require __DIR__ . '/views/header.php'; ?>

<article>
    <h1>Create account</h1>

    <form action="/app/users/create.php" method="post">
        <div class="">
            <label for="alias" class="sr-only">Alias</label>
            <input class="" type="text" name="alias" id="alias" placeholder="alias" required>
        </div>
        <div class="">
            <label for="email" class="sr-only">Email</label>
            <input class="" type="email" name="email" id="email" placeholder="email" required>
        </div>

        <div class="">
            <label for="password" class="sr-only">Password</label>
            <input class="" type="password" name="password" id="password" placeholder="password" required>
        </div>
        <div class="">
            <label for="password" class="sr-only">Confirm password</label>
            <input class="" type="password" name="confirm-password" id="confirm-password" placeholder="confirm password" required>
        </div>


        <button type="submit" name="submit" class="">Create</button>
    </form>
</article>

<?php require __DIR__ . '/views/footer.php'; ?>
