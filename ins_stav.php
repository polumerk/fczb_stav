<?php

header('Content-type: text/html; charset=utf-8');

echo "<a href='index.php'>Вернуться назад</a> <br />"; 

if (isset($_POST['pass']) && $_POST['pass'] === 'govno') {
	echo 'parol uspex';
}
else {
	echo "
		<form id='password' action='ins_stav.php' method='post'>
		Введи пароль, уёба! <input type='password' name='pass' size='10'>
		<input type='submit' value='Сохранить ставки'>
		</form>
	";
}
