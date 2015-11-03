<?php

header('Content-type: text/html; charset=utf-8');

if (isset($_POST['sob'])) {

require(__DIR__ . '/vendor/autoload.php');


$params = array_merge(
    require(__DIR__ . '/config.php')
);

$db = new MysqliDb ($params['db_config']);	
	
	foreach ($_POST['sob'] as $key => $value) {
		$id_sob = $key;
		foreach ($value as $val=>$a) {
			 $data[$val] = str_replace(',', '.', $a);
		}

		$db->where ('id', $id_sob);
		if ($db->update ('sob', $data))
		  { echo "Успешно обновлена запись ({$data['com']},{$data['kef']}). <br />"; }
		else
		  { echo "Ошибка при обновлении ({$data['com']},{$data['kef']}). Error: ".$db->getLastError(); }

	}


}