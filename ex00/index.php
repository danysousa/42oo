<?php

session_start();

spl_autoload_register(function($class)
{
	require_once __DIR__ . '/' . $class . '.class.php';
});

if (Game::exists())
{
	$game = Game::loadFromFile();
}
else
{
	$game = new Game();
	$game->addPlayer($p1 = new Player("conrad"));
	$game->addPlayer($p2 = new Player("arthur"));
	$game->addShip(new SwordOfAbsolution(0, 0, $p1));
	$game->addShip(new HonorableDuty(148, 95, $p2));
	// add ships etc...
}

var_dump($game);