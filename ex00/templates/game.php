<!DOCTYPE html>
<html>
<title>Asteroberg le retour du badass !</title>
<body>
	<div ng-app="gameApp">
		<div ng-controller="ActionFormCtrl">
			<div ng-show="user && game">
				<canvas id="myCanvas" width="2000" height="1300" style="border:1px solid #000000;"></canvas>
				<h1>Hello {{ user.name }}</h1>
				<h2>users currently in game</h2>
				<ul ng-repeat="o in objects">
					<li>{{ o.user.name }}</li>
				</ul>
				<h2>Choose the ship to use this turn</h2>
				<select name="shipToUse" id="shipToUse" ng-model="chosenShip" ng-repeat="s in userShips">
					<option value="{{ s.name }}">{{ s.name }}</option>
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