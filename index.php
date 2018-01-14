<?php

require "config.php";	//Подключение к БД и задание переменных
require "template.php"; //Подключение парсера
require "menu.php";	//Подключение меню

//$page_data = mysqli_fetch_assoc($r);

$work_url = $_SERVER['REQUEST_URI'];

// считываем запрашиваемый URL
// считываем все URL которые есть в базе
// сравниваем, в противном случае выдаём 404

$r = mysqli_query($link, "select page_url from content where page_url=\"$work_url\"");

if (empty($r)) {
	$page_data = "страница не найдена";
	$test2 = 404;
}


$tpl->get_tpl('page.tpl'); //Открываем файл шаблона
$tpl->set_value('TITLE',$page_data['page_title']);
$tpl->set_value('DESCRIPTION',$page_data['page_description']);
$tpl->set_value('MENU',$cat_menu);
$tpl->set_value('PAGE',$page_data['page_content']);
$tpl->set_value('TEST',$work_url);
$tpl->set_value('TEST2',$test2);
$tpl->tpl_parse(); //Запуск парсинга

echo $tpl->html; //Выводим результаты работы парсера

?>