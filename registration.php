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


function isAlreadyExists(string $email): bool
{
    global $conn;
    $sql = "SELECT * FROM users WHERE email='$email';";
    $result = $conn->query($sql);
    $conn->close();
    return $result->num_rows > 0;
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = validateInput($_POST['name']);
    $surname = validateInput($_POST['surname']);
    $birthDate = validateInput($_POST['birth-date']);
    $country = $_POST['country'];
    $email = validateInput($_POST['email']);
    $password = validateInput($_POST['password']);
    $passwordAgain = validateInput($_POST['password-again']);

    if (empty($name) || empty($surname) || empty($birthDate)
        || empty($country) || empty($email)
        || empty($password) || empty($passwordAgain)) {
        $errors[] = 'Пожалуйста, заполните все поля';
    }

    if (!str_contains($email, '@')) {
        $errors[] = 'Некорректный email';
    }

    if ($password !== $passwordAgain) {
        $errors[] = 'Пароли не совпадают';
    }

    if (isAlreadyExists($email)) {
        $errors[] = 'Пользователь с таким email уже существует';
    }

    if (empty($errors)) {
        $password = hash('sha256', $password);
        $sql = "INSERT INTO users (name, surname, birth_date, country, email, password) VALUES ('$name', '$surname', '$birthDate', '$country', '$email', '$password');";
        $result = $conn->query($sql);
        echo 'Регистрация прошла успешно';
    } else {
        foreach ($errors as $err) {
            echo "$err<br>";
        }
    }
}