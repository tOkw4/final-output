<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = htmlspecialchars($_POST['username']);
    $password = htmlspecialchars($_POST['password']);

    $xml = new DOMDocument();
    $xml->load('users.xml');

    $root = $xml->getElementsByTagName('users')->item(0);

    $user = $xml->createElement('user');

    $userUsername = $xml->createElement('username', $username);
    $userPassword = $xml->createElement('password', password_hash($password, PASSWORD_DEFAULT));

    $user->appendChild($userUsername);
    $user->appendChild($userPassword);

    $root->appendChild($user);

    $xml->save('users.xml');

    echo "Registration successful. <a href='index.html'>Login here</a>";
}
