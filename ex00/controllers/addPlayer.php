<?php

// require function() {
// 	if (count($game->getShips()) >= GAME_MAX_NUM_SHIPS)
// 	{
// 		json(false);
// 		die();
// 	}
// 	if (get('name') !== false && get('ship') !== false)
// 	{
// 		$name = get('name');
// 		$player = new Player($name, Player::ACTIVE, session_id());
// 		$ship = get('ship');
// 		$ship = new $ship(0, 0, $player);
// 		$game->addPlayer($player);
// 		// While the ship creates a collision, we try new coordinates
// 		while ($game->hasCollision($ship))
// 		{
// 			$ship->setX(rand(0, GAME_NUM_ROWS - 1 - $ship::W));
// 			$ship->setY(rand(0, GAME_NUM_COLS - 1  - $ship::H));
// 		}
// 		$game->addShip($ship);
// 		$game->save();
// 		json(true);
// 		die();
// 	}
// };
