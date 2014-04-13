<?php

function getGame($gameId) {
	// get the ships for this game
	$gameShipsDb = app()->get('db')->query(
		"SELECT v.id ship_id, v.rot ship_dir, v.class ship_class, v.posX ship_posX, v.posY ship_posY, u.id user_id, u.name user_name
		FROM flotte f JOIN vaisseau v
		ON f.id_vaisseau = v.id JOIN user u
		ON u.id = f.id_user JOIN partie p
		ON p.id = ?",
		[
			$gameId
		]
	);
	
	// add all presently available ships
	$game = new Game();
	foreach ($gameShipsDb as $dbShip) {
		$game->addShip(new $dbShip['ship_class']($dbShip['ship_posX'], $dbShip['ship_posY'], new Player($dbShip['user_name'], Player::ACTIVE, 'sessionid')));
	}

	return $game;
}