<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = htmlspecialchars($_POST['username']);
    $password = htmlspecialchars($_POST['password']);

    $xml = simplexml_load_file('users.xml');

    $userFound = false;

    foreach ($xml->user as $user) {
        if ($user->username == $username && password_verify($password, $user->password)) {
            $_SESSION['username'] = (string) $user->username;
            $userFound = true;
            break;
        }
    }

    if ($userFound) {
        header('Location: home.php');
    } else {
        echo "Invalid username or password.";
    }
}
