<?php

class App {
	protected $instances = array();

	public function __construct() {
		// activate error display
		ini_set('display_errors', 1);
		error_reporting(E_ALL);
		// handle all errors
		set_error_handler(function($errno, $errstr) {
			throw new Exception($errstr);
		}, E_ALL);
		// load config file
		require_once __DIR__ . '/config.php';
		// autoload all classes
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
$app->set('db', new Database('localhost', $GLOBALS['DB_USER'], $GLOBALS['DB_PASSWORD'], $GLOBALS['DB_NAME']));
$app->set('view', new View(__DIR__ . '/templates'));

function app() {
	return $GLOBALS['app'];
}

/*
 * Setup controllers.
 *
 * Each controller is a closure returned from a controller file.
 * A controller can access the Application (and all instances like db, session)
 * through the function `app()`.
 */
$actions = array(
	'addPlayer' => require __DIR__ . '/controllers/addPlayer.php',
	'createGame' => require_once __DIR__ . '/controllers/createGame.php',
	'login' => require __DIR__ . '/controllers/login.php',
	'home' => require_once __DIR__ . '/controllers/home.php',
	'profile' => require_once __DIR__.'/controllers/profile.php',
	// the page that allows to create a game or join a game
	'createGame' => require __DIR__ . '/controllers/createGame.php',
	// the script that saves a created game
	'postCreateGame' => require __DIR__ . '/controllers/postCreateGame.php',
	// the script that saves when a player joins a game
	'postJoinGame' => require __DIR__ . '/controllers/postJoinGame.php',
);

// check if an action applies for this request and execute it
if (isset($_GET['action']) && isset($actions[$_GET['action']])) {
	try {
		$actions[$_GET['action']]();
	} catch (Exception $e) {
		@file_put_contents(__DIR__ . '/error_log.txt', sprintf("Error: %s => %s\n", date('l jS \of F Y h:i:s A'), $e->getMessage()), FILE_APPEND);
		http_response_code(500);
		echo sprintf("An error occured. Check the log file.");
	}
// or return a 404
} else {
	http_response_code(404);
	echo sprintf("404, not found.");
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
