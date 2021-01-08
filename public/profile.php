<?php require __DIR__ . '/app/autoload.php';
 require __DIR__ . '/views/header.php';

if (!loggedIn()) {
    redirect('/');
}
