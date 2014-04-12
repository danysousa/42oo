<?php

class App {
	protected $instances = array();

	public function __construct() {
		require_once __DIR__ . '/config.php';
		spl_autoload_register(function($class) {
			require_once __DIR__ . '/classes/' . $class . '.class.php';
		});
	}

	public function set($k, $v) {
		$this->instances[$k] = $v;
	}

	public function get($k) {
		return $this->instances[$k];
	}
}

$GLOBALS['app'] = $app = new App();

$app->set('session', new Session());
$app->set('db', new Database('localhost', DB_USER, DB_PASSWORD, DB_NAME));

function app() {
	return $GLOBALS['app'];
}

$actions = array(
	'addPlayer' => require __DIR__ . '/controllers/addPlayer.php',
	''
);

if (isset($_GET['action']) && isset($action[$_GET['action']])) {
	$action[$_GET['action']]();
} else {
	echo '404';
}

/*
define('GAME_MAX_NUM_SHIPS', 2);
define('GAME_NUM_ROWS', 150);
define('GAME_NUM_COLS', 100);

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
*/

/*

// Add a player and it's ship
if (get('action') === 'addPlayer')
{
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
else if(get('action') === 'move' && (int)get('id'))
{
	//move ships with $game->getShips()[get('id')]->set[X/Y]();
	if ((int)get('x') && ((int)get('x') === -1 || (int)get('x') === 1))
		$game->getShips()[(int)get('id')]->setX($game->getShips()[get('id')]->getX() + ((int)get('x') * $game->getShips()[get('id')]->getSpeed()));	
	else if((int)get('y') && ((int)get('y') === -1 || (int)get('y') === 1))
		$game->getShips()[(int)get('id')]->setY($game->getShips()[get('id')]->getY() + ((int)get('y') * $game->getShips()[get('id')]->getSpeed()));
	json(true);
	$game->save();
	die();
}
else if(get('action') === 'rotate' && get('id'))
{
	//Rotate ships with $game->getShips()[get('id')]->setDirection();
	if ((int)get('dir') >= 0 && (int)get('dir') < 4)
		$game->getShips()[(int)get('id')]->setDirection((int)get('dir'));
	json(true);
	$game->save();
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
else if (get('action') === 'display')
{
	echo "<pre>";
	var_dump($game);
	echo "</pre>";
}
else if (get('action') === 'playTurn')
{
}
else
{
	header('location: /ex00/index.php?action=board');
	die();
}
*/