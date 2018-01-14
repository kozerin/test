<?php

class template_class
{
	var $values = array();
	var $html;
	
	function get_tpl($tpl_name) //Загрузка шаблона
	{
	if (empty($tpl_name) || !file_exists($tpl_name)) //Проверка на существование
		{
		return false;
		}
	else
		{
		$this->html = join('',file($tpl_name)); //Загружаем файл
		}
	}

	function set_value($key,$var) //Присваивание значений
	{
	$key = '{'.$key.'}';
	$this->values[$key] = $var;
	}

	function tpl_parse() //Парсинг шаблона
	{
	foreach ($this->values as $find => $replace) 
		{
			$this->html = str_replace($find, $replace, $this->html);
		}
	}
}

$tpl = new template_class; //Новый экземпляр класса

?>