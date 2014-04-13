<?php

return function() {

	$_JSON = json_decode(file_get_contents('php://input'), TRUE);
	$login = app()->get('session')->get('login');

	if ($login === false) {
		die('Must be logged in.');
	}

	$player = app()->get('db')->queryOne("SELECT * FROM user WHERE name = ?", [$login]);

	if ($player === null) {
		die('Player does not exist.');
	}

	$game = app()->get('db')->queryOne("SELECT * FROM partie WHERE id = ?", [$player['id_partie']]);

	if ($game === null) {
		die('Player has no valid game.');
	}

	if ($game['id_current_player'] !== $player['id']) {
		die('Not your turn.');
	}

	$ship = app()->get('db')->queryOne("SELECT * FROM vaisseau WHERE id = ?", [$player['id_vaisseau']]);

	if ($ship === null) {
		die('No ship with that id for the current player.');
	}

	if ($ship['has_allocated'] === 0) {
		die('Please, allocate PP.');
	}

	if ($ship['has_rotated'] === 0) {
		die('Has not rotated.');
	}

	header('content-type: application/json');

	// do shoot

	if ($ship['rot'] == 'north')
	{
		$y = $ship['posY'] - 15;
		$colision = app()->get('db')->query("SELECT vaisseau.id FROM vaisseau INNER JOIN flotte
		ON vaisseau.id LIKE flotte.id_vaisseau
		WHERE vaisseau.posX LIKE ?
		AND vaisseau.posY >= ?
		AND vaisseau.posY < ?",
		array(
			$ship['posX'],
			$y,
			$ship['posY']
			));
		app()->get('db')->query("UPDATE vaisseau SET has_shooted = 1 WHERE id LIKE ?",
		array(
			$ship['id']
		));
		if ($colision)
		{
			foreach ($colision as $val)
			{
				app()->get('db')->query("UPDATE vaisseau SET pv = 0 WHERE id LIKE ?",
				array(
					$val['id']
				));
			}
		}

	}
	else if ($ship['rot'] == 'south')
	{
		$y = $ship['posY'] + 15;
		$colision = app()->get('db')->query("SELECT vaisseau.id FROM vaisseau INNER JOIN flotte
		ON vaisseau.id LIKE flotte.id_vaisseau
		WHERE vaisseau.posX LIKE ?
		AND vaisseau.posY <= ?
		AND vaisseau.posY > ?",
		array(
			$ship['posX'],
			$y,
			$ship['posY']
			));
		app()->get('db')->query("UPDATE vaisseau SET has_shooted = 1 WHERE id LIKE ?",
		array(
			$ship['id']
		));
		if ($colision)
		{
			foreach ($colision as $val)
			{
				app()->get('db')->query("UPDATE vaisseau SET pv = 0 WHERE id LIKE ?",
				array(
					$val['id']
				));
			}
		}

	}
	else if ($ship['rot'] == 'east')
	{
		$x = $ship['posX'] + 15;
		$colision = app()->get('db')->query("SELECT vaisseau.id FROM vaisseau INNER JOIN flotte
		ON vaisseau.id LIKE flotte.id_vaisseau
		WHERE vaisseau.posY LIKE ?
		AND vaisseau.posX <= ?
		AND vaisseau.posX > ?",
		array(
			$ship['posY'],
			$y,
			$ship['posX']
			));
		if ($colision)
		{
		app()->get('db')->query("UPDATE vaisseau SET has_shooted = 1 WHERE id LIKE ?",
		array(
			$ship['id']
		));
			foreach ($colision as $val)
			{
				app()->get('db')->query("UPDATE vaisseau SET pv = 0 WHERE id LIKE ?",
				array(
					$val['id']
				));
			}
		}

	}
	else if ($ship['rot'] == 'west')
	{
		$x = $ship['posX'] - 15;
		$colision = app()->get('db')->query("SELECT vaisseau.id FROM vaisseau INNER JOIN flotte
		ON flotte.id_partie LIKE ?
		WHERE vaisseau.posY LIKE ?
		AND vaisseau.posX >= ?
		AND vaisseau.posX < ?",
		array(
			$game['id'],
			$ship['posY'],
			$x,
			$ship['posX']
			));
		app()->get('db')->query("UPDATE vaisseau SET has_shooted = 1 WHERE id LIKE ?",
		array(
			$ship['id']
		));
		if ($colision)
		{
			foreach ($colision as $val)
			{
				app()->get('db')->query("UPDATE vaisseau SET pv = 0 WHERE id LIKE ?",
				array(
					$val['id']
				));
			}
		}
	}

	app()->get('db')->query("UPDATE vaisseau SET has_shooted = 0, has_allocated = 0, has_rotated = 0 WHERE id LIKE ?",
		array(
			$ship['id']
		));
	$next_user = app()->get('db')->queryOne("SELECT id_user FROM flotte WHERE id_partie LIKE ? AND id_user != ?",
		array(
			$game['id'],
			$player['id']
		));
	if ($next_user)
	{
		app()->get('db')->queryOne("UPDATE partie set id_current_player =  ?",
			array(
				$next_user['id_user']
			));
	}

};