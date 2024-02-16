<?php


$serverName = "localhost";
$userName = "root";
$password = "Myneosha1!";
$dbname = "web_id";


$conn = new mysqli($serverName, $userName, $password, $dbname);

if ($conn->connect_error) {
    die("Ошибка подключения: " . $conn->connect_error);
}