<?php

function getGame($gameId) {
	$gameShipsDb = app()->get('db')->query(
		"SELECT v.id ship_id, v.rot ship_dir, v.class ship_class, v.posX ship_posX, v.posY ship_posY, v.pv ship_pv, v.portee ship_range, v.mobile ship_mobile, u.id user_id, u.name user_name,
			v.has_allocated ship_has_allocated, v.has_rotated ship_has_rotated, v.has_shooted ship_has_shooted
		FROM flotte f JOIN vaisseau v
		ON f.id_vaisseau = v.id JOIN user u
		ON u.id = f.id_user JOIN partie p
		ON p.id = ? WHERE f.id_partie = ?", [
		$gameId,
		$gameId
	]);
	
	// add all presently available ships
	$game = new Game();
	foreach ($gameShipsDb as $dbShip) {
		if ($dbShip['ship_pv'] > 0)
			$game->addShip(new $dbShip['ship_class']($dbShip['ship_posX'], $dbShip['ship_posY'], new Player($dbShip['user_name'], Player::ACTIVE, 'sessionid')));
	}

	return $game;
}