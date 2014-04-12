<?php

return function() {

	app()->get('session')->set('login', NULL);
	if ( $_POST && $_POST['register_login']
		&& $_POST['register_password']
		&& ($_POST['register_submit'] == 'FIGHT'))
	{
		$pwd = hash('whirlpool', $_POST['register_password']);
		$verif = app()->get('db')->query("SELECT name FROM user WHERE name LIKE ?", array($_POST['register_login']));
		if (!$verif)
		{
			app()->get('db')->query("INSERT INTO user (name, pwd) VALUES(?, ?)", array($_POST['register_login'], $pwd));
			app()->get('session')->set('login', $_POST['register_login']);
			$id = app()->get('db')->query("SELECT id FROM user WHERE name LIKE ?", array($_POST['register_login']));
			app()->get('session')->set('id_usr', $id);
		}
	}
	if (!app()->get('session')->get('login'))
		echo app()->get('view')->render('login');
	else
		echo app()->get('view')->render('index');

};