## Actions

Actions can be called like so:

`GET|POST http://example.com/ex00/index.php?action=[action name][GET params]`

### Adding players and ships to the game

Adds a player and his ship to the game.

Action name: `addPlayer`
Type: `GET`
Return type: `application/json`

Params:
* `name`: the player's public name
* `ship`: the player ship type, one of [`HonorableDuty`, `SwordOfAbsolution`]

### Starting the game

Starts the game, effectively locking down registrations and addition of ships.

Action name: `start`
Type: `GET`
Return type: `application/json`

### Deleting the current game

Action name: `reset`
Type: `GET`
Return type: `application/json`

### Getting information about the logged in player

Gets information about the current player from the session.

Action name: `player`
Type: `GET`
Return type: `application/json`

### Getting the ships of the current player

Gets information about the current player from the session.

Action name: `playerShips`
Type: `GET`
Return type: `application/json`

### Getting all game MapObject (ships, blocks)

Returns information about the Game's objects available on the map.

Action name: `objects`
Type: `GET`
Return type: `application/json`

### Viewing the game board

View the game board in HTML, including the canvas and possible actions to take
for the current player.

Action name: `board`
Type: `GET`
Return type: `text/html`

### View game information

View bunch of information about the current game.

Action name: `display`
Type: `GET`
Return type: `text/html`

### Move an object

Action name: `move`
Type: `GET`
Return type: `text/html`

Params:
* `id`: object id
* `x`: one of [-1, 1], incompatible with `y`
* `y`: one of [-1, 1], incompatible with `x`

### Rotate an object

Action name: `rotate`
Type: `GET`
Return type: `text/html`

Params:
* `id`: object id
* `dir`: the new direction of the object