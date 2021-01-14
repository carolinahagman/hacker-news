<?php

declare(strict_types=1);

require __DIR__ . '/../autoload.php';

if (isset($_POST['email'])) {
    $userEmail = filter_var($_POST['email'], FILTER_SANITIZE_URL);
    if (!emailExists($database, $userEmail)) {
        $_SESSION['error'] = "Sorry, email doesn't exist";
        redirect('/login.php');
    }
    $userInfo = getUserInfo($database, $userEmail);
    $to = $userEmail;
    $password = 'password123';
    $userId = $userInfo['id'];
    $hashedPwd = password_hash($password, PASSWORD_DEFAULT);
    updatePwd($database, $hashedPwd, $userId);

    $subject = "Password";
    $txt = "Your password is : $password. Remember to change the password!";
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
    $headers .= "From: hagmancarolina@gmail.com" . "\r\n" .
        "CC: hagmancarolina@gmail.com";
    mail($to, $subject, $txt, $headers);
    $_SESSION['message'] = "Password sent to your email";
    redirect('/login.php');
}
