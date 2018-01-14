<?php

//Получаем массив нашего меню из БД в виде массива
function getCat($link){
	$sql = 'SELECT * FROM `menu`';
	$res = $link->query($sql);

	//Создаем масив где ключ массива является ID меню
	$cat = array();
	while($row = $res->fetch_assoc()){
		$cat[$row['id']] = $row;
	}
	return $cat;
}

//Функция построения дерева из массива
function getTree($dataset) {
	$tree = array();

	foreach ($dataset as $id => &$node) {    
		//Если нет вложений
		if (!$node['parent']){
			$tree[$id] = &$node;
		}else{ 
			//Если есть потомки то перебераем массив
            $dataset[$node['parent']]['childs'][$id] = &$node;
		}
	}
	return $tree;
}

$cat  = getCat($link); //Запрашиваем из базы массив с данными 
$tree = getTree($cat); //Преобразуем массив в дерево

//Функция вывода HTML
function tplMenu($category){

if (($category['parent'] == 0) and (!isset($category['childs']))) {
$menu = "<li class=\"nav-item\"><a class=\"nav-link\" href=\"http://localhost$category[pageurl]\">".$category['content'].'</a></li>';	
}
		
if (isset($category['childs'])){

$menu .= '<li class="nav-item dropdown"><a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">'.$category['content'].'</a>
<div class="dropdown-menu dropdown-primary" aria-labelledby="navbarDropdownMenuLink">'
. showCat($category['childs']) .'</div></li>';
}

if ($category['parent']<> 0) {
$menu .= "<a class=\"dropdown-item\" href=\"http://localhost$category[pageurl]\">".$category['content'].'</a>';
}
	
	return $menu;
}

//Функция рекурсивного вывода шаблона
function showCat($data){
	$string = '';
	foreach($data as $item){
		$string .= tplMenu($item);
	}
	return $string;
}

//Выводим получившееся HTML меню в переменную
$cat_menu = showCat($tree);

?>