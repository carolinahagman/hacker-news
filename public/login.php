<?php require __DIR__ . '/app/autoload.php'; ?>
<?php require __DIR__ . '/views/header.php'; ?>

<article>
    <h1>Login</h1>

    <form action="app/users/login.php" method="post">
        <div class="form-group">
            <label for="email" class="sr-only">Email</label>
            <input class="form-control" type="email" name="email" id="email" placeholder="email" required>
        </div><!-- /form-group -->

        <div class="form-group">
            <label for="password" class="sr-only">Password</label>
            <input class="form-control" type="password" name="password" id="password" placeholder="password" required>
        </div><!-- /form-group -->

        <button type="submit" class="btn btn-primary">Login</button>
        <a href="/create.php">Create account</a>
    </form>
</article>

<?php require __DIR__ . '/views/footer.php'; ?>
