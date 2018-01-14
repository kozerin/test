<?php

$work_url = $_SERVER['REQUEST_URI'];

// считываем запрашиваемый URL
// считываем все URL которые есть в базе
// сравниваем, в противном случае выдаём 404

$r = mysqli_query($link, "select * from content");

?>