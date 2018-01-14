<?php

$dbhost = 'localhost';
$dbname = 'work';
$dbuser = 'root';
$dbpassword = 'stormbringer84';

$link = mysqli_connect ($dbhost,$dbuser,$dbpassword,$dbname); //Подключение к БД

// Проверка подключения к БД

if (mysqli_connect_errno())
{
    printf("Не удалось подключиться: %s\n", mysqli_connect_error());
    exit();
}

?>