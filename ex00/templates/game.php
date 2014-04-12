<!DOCTYPE html>
<html>
<title>Asteroberg le retour du badass !</title>
<body>
	<div ng-app="gameApp">
		<div ng-controller="ActionFormCtrl">
			<div ng-show="user && game">
				<canvas id="myCanvas" width="2000" height="1300" style="border:1px solid #000000;"></canvas>
				<h1>Hello {{ user.name }}</h1>
				<h2>Ships on map</h2>
				<ul ng-repeat="s in game.ships">
					<li>{{ s.ship_class }} [ {{s.ship_posX}}, {{s.ship_posY}}]</li>
				</ul>
				<h2>Choose the ship to use this turn</h2>
				<select name="shipToUse" id="shipToUse" ng-model="chosenShip">
					<option value="{{ s.ship_id }}" ng-repeat="s in game.ships | filter: { user_id: user.id }" ng-selected="$first">{{ s.ship_class }} [ {{s.ship_posX}}, {{s.ship_posY}}]</option>
				</select>
			</div>

			<div ng-show="!user || !game">
				<h1>You are not part of this game. Get the f*ck off!</h1>
			</div>
		</div>
	</div>
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.0/jquery.min.js"></script>
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/angularjs/1.2.16/angular.js"></script>
	<script type="text/javascript" src="js/game.js"></script>	
</body>	
</html>