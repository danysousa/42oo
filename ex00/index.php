<?php

session_start();

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
	$game->addBlock(new Asteroberg(30, 30, $neutralPlayer));
	// add ships etc...
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
	if (get('name') !== false && get('ship') !== false)
	{
		$name = get('name');
		$player = new Player($name, Player::ACTIVE, session_id());
		$ship = get('ship');
		$x = rand(0, 149 - $ship::W);
		$y = rand(0, 99 - $ship::H);
		$game->addShip(new $ship($x, $y, $player));
		$game->addPlayer($player);
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