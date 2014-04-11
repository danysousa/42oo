<!DOCTYPE html>
<html>
<title>Asteroberg le retour du badass !</title>
<body>
	<canvas id="myCanvas" width="2000" height="1300" style="border:1px solid #000000;">
	</canvas>

	<div ng-app="gameApp">
		<div ng-controller="ActionFormCtrl">
		<div ng-show="!!player.name">
			<h1>Hello {{ player.name }}</h1>
			<h2>Players currently in game</h2>
			<ul ng-repeat="o in objects">
				<li>{{ o.player.name }}</li>
			</ul>
			<h2>Choose the ship to use this turn</h2>
			<select name="shipToUse" id="shipToUse" ng-model="chosenShip" ng-repeat="s in playerShips">
				<option value="{{ s.name }}">{{ s.name }}</option>
			</select>
		</div>
	</div>
	<script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.0/jquery.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.2.16/angular.js"></script>
	<script type="text/javascript" src="js/game.js"></script>	
</body>	
</html>