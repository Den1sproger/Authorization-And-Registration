<?php

include 'config.php';


$errors = [];

function validateInput(string $input): string
{
    $input = trim($input);
    $input = stripslashes($input);
    $input = htmlspecialchars($input); 
    return $input;
}


function getUserData(string $email): object
{
    global $conn;
    $sql = "SELECT email, password FROM users WHERE email='$email';";
    $result = $conn->query($sql);
    $conn->close();
    return $result;
}



if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = validateInput($_POST['email']);
    $password = validateInput($_POST['password']);

    if (empty($password) || empty($email)) {
        $errors[] = 'Пожалуйста, заполните все поля';
    }

    if (!str_contains($email, '@')) {
        $errors[] = 'Некорректный email';
    }

    $password = hash('sha256', $password);
    $userData = getUserData($email);
    $row = $userData->fetch_assoc();
    $dbPassword = $row['password'];

    if ($userData->num_rows === 0 || $password !== $dbPassword) {
        $errors[] = 'Неверный email или пароль';
    }

    if (empty($errors)) {
        echo 'Регистрация прошла успешно';
    } else {
        foreach ($errors as $err) {
            echo "$err<br>";
        }
    }
}