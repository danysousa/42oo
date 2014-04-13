<?php

return function() {

	$login = app()->get('session')->get('login');

	if ($login === false || app()->get('session')->get('id_usr') === false) {
		die('Must be logged in.');
	}

	// get the current game ID
	$partie = app()->get('db')->queryOne("SELECT id_partie FROM user WHERE id LIKE ?", array(
		app()->get('session')->get('id_usr')
	));

	if ($partie === null) {
		die('Must have a game.');
	}

	if ($_POST['submit'] == "FIGHT !" && ($_POST['first'] || $_POST['second'] || $_POST['third']))
	{
		$tb_key = array('first', 'second', 'third');
		$i = 0;
		$count = 0;
		$tb_class = array();
		while ($i < 3)
		{
			if ($_POST[$tb_key[$i]] == "-- No army ! I'm a warrior --")
			{
				$_POST[$tb_key[$i]] = NULL;
				$count++;
			}
			else
				$tb_class[] = $_POST[$tb_key[$i]];
			$i++;
		}
		if ($count == 3)
			header("Location: ./index.php?action=createArmy");
		$player = new Player(app()->get('session')->get('login'), Player::ACTIVE, 0);

		// check if classes are valid
		$validClasses = ['HonorableDuty', 'SwordOfAbsolution', 'Asteroberg', 'BlueLeaf', 'BloodPuller', 'PurpleDeath', 'WheelOfMiracle'];
		foreach ($tb_class as $value)
		{
			if (!in_array($value, $validClasses, true))
				die('Invalid ship class.');
		}

		$game = getGame($partie['id_partie']);

		foreach ($tb_class as $value)
		{
			// $value is the class name of the ship

			// while the coords make a collision, make new coords
			$instance = new $value(rand(0, 100 - 1 - $value::W), rand(0, 150 - 1 - $value::H), $player);
			while ($game->hasCollision($instance)) {
				$instance->setX(rand(0, 150 - 1 - $value::W));
				$instance->setY(rand(0, 100 - 1 - $value::H));
			}
			$pv = $instance->getPv();
			$id = app()->get('db')->query("INSERT INTO vaisseau (class, posX, posY, pv, portee, mobile, pp_shield, pp_gun, pp_speed, pp_total)
				VALUES (?, ?, ?, ?, ?, 1, ?, ?, ?, ?)",
				array(
					$value,
					$instance->getX(), // posX
					$instance->getY(), // posY
					$pv,
					'courte', // range
					0, // pp_shield
					0, // pp_gun
					0, // pp_speed
					0 // pp_total
				));
			$id = app()->get('db')->queryOne("SELECT id FROM vaisseau ORDER BY id DESC LIMIT 1", array());
			app()->get('db')->query("INSERT INTO flotte (id_user, id_partie, id_vaisseau) VALUES(?, ?, ?)", array(
				app()->get('session')->get('id_usr'),
				$partie['id_partie'],
				$id['id']
			));
		}
		header('Location: ./index.php?action=gameMap');
	}
	else
		echo app()->get('view')->render('army');
};