<?php

if (!file_exists('config_custom.php'))
{
	header('Location: ./install.php');
}

define('GAME_PP', 100);

require_once __DIR__ . '/functions.php';

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

if (!isset($_GET) && !$app->get('session')->get('login'))
{
	if ($_GET['action'] != 'login')
		header('Location: ./index.php?action=login');
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
	'logout' => require_once __DIR__.'/controllers/logout.php',
	'home' => require_once __DIR__ . '/controllers/home.php',
	'profile' => require_once __DIR__.'/controllers/profile.php',
	'lobby' => require_once __DIR__.'/controllers/lobby.php',
	'gameMap' => require_once __DIR__.'/controllers/map.php',
	'createArmy' => require_once __DIR__.'/controllers/createArmy.php',
	// the page that allows to create a game or join a game
	'createGame' => require __DIR__ . '/controllers/createGame.php',
	// the script that saves a created game
	'postCreateGame' => require __DIR__ . '/controllers/postCreateGame.php',
	// the script that saves when a player joins a game
	'postJoinGame' => require __DIR__ . '/controllers/postJoinGame.php',
	// view the game board
	'viewGameBoard' => require __DIR__ . '/controllers/viewGameBoard.php',
	// the script that saves when a player create his own army
	'postCreateArmy' => require __DIR__ . '/controllers/postCreateArmy.php',

	// XHR API for AngularJS
	// get information about the currently logged in user
	'xhrUser' => require __DIR__ . '/controllers/xhrUser.php',
	// get the game associated with the currently logged in user
	'xhrGame' => require __DIR__ . '/controllers/xhrGame.php',
	'getChatMsg' => require __DIR__ . '/controllers/lobbyChat.php',

	// Choosing, rotating, moving and shooting
	'postTurnSubmitRepartition' => require __DIR__ . '/controllers/postTurnSubmitRepartition.php',
	'postTurnSubmitRotation' => require __DIR__ . '/controllers/postTurnSubmitRotation.php',
	'postTurnSubmitMove' => require __DIR__ . '/controllers/postTurnSubmitMove.php',
	'postShoot' => require __DIR__ . '/controllers/postShoot.php',
);

// check if an action applies for this request and execute it
if (isset($_GET['action']) && isset($actions[$_GET['action']])) {
	try {
		$actions[$_GET['action']]();
	} catch (Exception $e) {
		@file_put_contents(__DIR__ . '/error_log.txt', sprintf("Error: line %d in file %s / %s => %s\n", $e->getLine(), $e->getFile(), date('l jS \of F Y h:i:s A'), $e->getMessage()), FILE_APPEND);
		http_response_code(500);
		echo sprintf("An error occured. Check the log file.");
	}
// or return a 404
} else {
	header('Location: ./index.php?action=login');
}
