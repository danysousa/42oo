<?php

session_start();

define('GAME_MAX_NUM_SHIPS', 2);
define('GAME_NUM_ROWS', 150);
define('GAME_NUM_COLS', 100);

spl_autoload_register(function($class)
{
	require_once __DIR__ . '/classes/' . $class . '.class.php';
});

if (Game::exists())
{
	$game = Game::loadFromFile();
}
else
{
	$game = new Game();
	$game->addPlayer($neutralPlayer = new Player("Switzerland", Player::INACTIVE, null));
	$game->addBlock(new Asteroberg(rand(0, GAME_NUM_ROWS - 1 - Asteroberg::W), rand(0, GAME_NUM_COLS - 1 - Asteroberg::H), $neutralPlayer));
}

function get($k)
{
	if (!isset($_GET[$k]))
		return false;
	return $_GET[$k];
}
function json($obj)
{
	header('content-type: application/json');
	echo json_encode($obj);
}

if (get('action') === 'addPlayer')
{
	if (count($game->getShips()) >= GAME_MAX_NUM_SHIPS)
	{
		json(false);
		die();
	}
	if (get('name') !== false && get('ship') !== false)
	{
		$name = get('name');
		$player = new Player($name, Player::ACTIVE, session_id());
		$ship = get('ship');
		$ship = new $ship(0, 0, $player);
		$game->addPlayer($player);
		while ($game->getCollisionMatrix()->collision($ship))
		{
			$ship->setX(rand(0, GAME_NUM_ROWS - 1 - $ship::W));
			$ship->setY(rand(0, GAME_NUM_COLS - 1  - $ship::H));
		}
		$game->addShip($ship);
		$game->save();
		json(true);
		die();
	}
}
else if (get('action') === 'start')
{
	$game->start();
	$game->save();
	die();
}
else if (get('action') === 'player')
{
	foreach ($game->getPlayers() as $p)
	{
		if ($p->getSessionId() === session_id())
		{
			json($p->toJson());
			die();
		}
	}
	json(null);
	die();
}
else if (get('action') === 'playerShips')
{
	json($game->currentPlayerShips());
	die();
}
else if (get('action') === 'reset')
{
	$game->reload();
	session_destroy();
	json(true);
	die();
}
else if (get('action') === 'objects')
{
	json($game->toJson());
	die();
}
else if (get('action') === 'board')
{
	include 'templates/game.php';
	$game->save();
	die();
}
else if (get('action') === 'playTurn')
{
}
else
{
	header('location: /ex00/index.php?action=board');
	die();
}