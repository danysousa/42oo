<?php

return function() {

	if ($_POST && array_key_exists("register_login", $_POST)
		&& array_key_exists("register_password", $_POST))
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
	else if ($_POST && $_POST['login_login']
			&& $_POST['login_password'])
	{
		$pwd = hash('whirlpool', $_POST['login_password']);
		$verif = app()->get('db')->query("SELECT id FROM user WHERE name LIKE ? AND pwd LIKE ?", array($_POST['login_login'], $pwd));
		if ($verif)
		{
			app()->get('session')->set('login', $_POST['login_login']);
			app()->get('session')->set('id_usr', $verif[0]['id']);
		}
	}
	if (!app()->get('session')->get('login') || !app()->get('session')->get('id_usr'))
		echo app()->get('view')->render('login');
	else
		header('Location: ./index.php?action=home');

};