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

	$gameInstance = getGame($game['id']);

	header('content-type: application/json');

	// do move
	if (in_array($ship['rot'], ['north', 'south'], true))
	{
		$y = $ship['posY'];
		$y = $ship['rot'] == 'north' ? $y - ($ship['class']::SPEED + $ship['pp_speed']) : $y + ($ship['class']::SPEED + $ship['pp_speed']);

		// check for collisions
		$shipInstance = new $ship['class']($ship['posX'], $y, new Player('name', Player::ACTIVE, 'sessionid'));

		// no collision, go ahead and move the ship
		// check bounds in X
		if ($shipInstance->getX() >= 0 && $shipInstance->getX() < 150
			// check bounds in Y
			&& $shipInstance->getY() >= 0 && $shipInstance->getY() < 100
			// check actual collision
			&& !$gameInstance->hasCollision($shipInstance)) {
			app()->get('db')->query("UPDATE vaisseau SET posY = ? WHERE id = ?", [
				$y,
				$ship['id']
			]);
			echo json_encode([
				'x' => $ship['posX'],
				'y' => $y
			]);
		} else {
			// ATOMIC BOMB ! The collisioner dies instantly !
			app()->get('db')->query("UPDATE vaisseau SET pv = 0 WHERE id LIKE ?",
			array(
				$ship['id']
			));
			$next_user = app()->get('db')->queryOne("SELECT flotte.id_user FROM flotte
			JOIN vaisseau v ON
			v.id LIKE flotte.id_vaisseau
			AND v.pv > 0
			WHERE id_partie LIKE ? AND id_user > ? ORDER BY id_user ASC",
			array(
				$game['id'],
				$player['id']
			));
			if (!$next_user)
			{
				$next_user = app()->get('db')->queryOne("SELECT flotte.id_user FROM flotte
				JOIN vaisseau v ON
				v.id LIKE flotte.id_vaisseau
				AND v.pv > 0
				WHERE id_partie LIKE ? ORDER BY id_user ASC",
				array(
					$game['id']
				));
			}
			if ($next_user)
			{
				app()->get('db')->queryOne("UPDATE partie set id_current_player =  ?",
					array(
						$next_user['id_user']
					));
			}
			app()->get('db')->query("UPDATE vaisseau SET has_shooted = 0, has_allocated = 0, has_rotated = 0 WHERE id LIKE ?",
				array(
					$ship['id']
				));
			echo json_encode('atomic');
		}
	}
	else if (in_array($ship['rot'], ['west', 'east'], true))
	{
		$x = $ship['posX'];
		$x = $ship['rot'] == 'west' ? $x - ($ship['class']::SPEED + $ship['pp_speed']) : $x + ($ship['class']::SPEED + $ship['pp_speed']);


		// check for collisions
		$shipInstance = new $ship['class']($x, $ship['posY'], new Player('name', Player::ACTIVE, 'sessionid'));

		// no collision, go ahead and move the ship
		// check bounds in X
		if ($shipInstance->getX() >= 0 && $shipInstance->getX() < 150
			// check bounds in Y
			&& $shipInstance->getY() >= 0 && $shipInstance->getY() < 100
			// check actual collision
			&& !$gameInstance->hasCollision($shipInstance)) {
			app()->get('db')->query("UPDATE vaisseau SET posX = ? WHERE id = ?", [
				$x,
				$ship['id']
			]);
			echo json_encode([
				'x' => $x,
				'y' => $ship['posY']
			]);
		} else {
			// ATOMIC BOMB ! The collisioner dies instantly !
			app()->get('db')->query("UPDATE vaisseau SET pv = 0 WHERE id LIKE ?",
			array(
				$ship['id']
			));
			$next_user = app()->get('db')->queryOne("SELECT flotte.id_user FROM flotte
			JOIN vaisseau v ON
			v.id LIKE flotte.id_vaisseau
			AND v.pv > 0
			WHERE id_partie LIKE ? AND id_user > ? ORDER BY id_user ASC",
			array(
				$game['id'],
				$player['id']
			));
			if (!$next_user)
			{
				$next_user = app()->get('db')->queryOne("SELECT flotte.id_user FROM flotte
				JOIN vaisseau v ON
				v.id LIKE flotte.id_vaisseau
				AND v.pv > 0
				WHERE id_partie LIKE ? ORDER BY id_user ASC",
				array(
					$game['id']
				));
			}
			if ($next_user)
			{
				app()->get('db')->queryOne("UPDATE partie set id_current_player =  ?",
					array(
						$next_user['id_user']
					));
			}
			app()->get('db')->query("UPDATE vaisseau SET has_shooted = 0, has_allocated = 0, has_rotated = 0 WHERE id LIKE ?",
				array(
					$ship['id']
				));
			echo json_encode('atomic');
		}
	}

};