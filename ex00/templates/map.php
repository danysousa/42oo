<!DOCTYPE html>
<HTML>
	<HEAD>
		<TITLE>Warhammer Online Battle</TITLE>
		<LINK href="css/map.css" rel="stylesheet" type="text/css">
	</HEAD>
	<BODY>
		<center>
			<div id="global">
				<div id="log_bar">
					<table border="0">
						<tr>
							<td class="header_cell"><a href="index.php?action=login" title=""><?PHP if (array_key_exists('login', $_SESSION)){echo $_SESSION['login'];}else{ echo 'Login';} ?></a></td>
							<td class="header_cell"><a href="index.php?action=login" title=""><?PHP if (array_key_exists('login', $_SESSION)){}else{ echo 'Register';} ?></a></td>
							<td class="header_cell"><a href="index.php?action=logout" title=""><?PHP if (array_key_exists('login', $_SESSION)){echo 'Logout';}?></a></td>
						</tr>
					</table>
				</div>
				<div id="stats_bar">
					<table border="0">
						<tr>
							<td class="stats_cell">LIFEPOINTS[0]</td>
							<td class="stats_cell">MOVEPOINTS[0]</td>
							<td class="stats_cell">POSITION[0|0]</td>
							<td class="stats_cell">FIREPOWER[00]</td>
						</tr>
					</table>
				<div id="global_block">

						<div ng-app="gameApp">
						<div ng-controller="ActionFormCtrl">
							<div ng-show="user && game">
								<h2>Choose the ship to use this turn</h2>
								<div value="{{ s.ship_id }}" class="ship" ng-repeat="s in game.ships | filter: { user_id: user.id }" ng-click="selectShip(s.ship_id)" ng-class="{shipSelected: s === selectedShip}">
									<h3>{{ s.ship_class }} [ {{s.ship_posX}}, {{s.ship_posY}}]</h3>
									<img src="img/{{s.ship_class}}_0.png" alt="">
								</div>
								<div ng-show="selectedShip">
									<form action="" method="POST">
										<input type="range" name="valueRepartitionWeapons" ng-model="weaponPointsValue" ng-change="percentCalc('valueRepartitionWeapons')" min="1" max="400">
										<input type="range" name="valueRepartitionMove" ng-model="movePointsValue" ng-change="percentCalc('valueRepartitionMove')" min="1" max="400">
									</form>
								</div>
								<canvas id="myCanvas" width="1600" height="1000" style="border:1px solid #000000; background: white"></canvas>
							</div>

							<div ng-show="!user || !game">
								<h1>You are not part of this game. Get the f*ck off!</h1>
							</div>
						</div>
					</div>
				</div>
			</div>
		</center>
		<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.0/jquery.min.js"></script>
		<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/angularjs/1.2.16/angular.js"></script>
		<script type="text/javascript" src="js/game.js"></script>

		<style>
			.ship {
				cursor: pointer;
			}

			.shipSelected {
				border: 2px solid red;
			}
		</style>
	</BODY>
</HTML> 
