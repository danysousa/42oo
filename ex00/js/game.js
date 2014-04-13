(function() {
	var canvas = document.getElementById("myCanvas");
	var ctx = canvas.getContext("2d");

	var factor = {
		x: canvas.width / 150,
		y: canvas.height / 100
	};

	var MAX_PP = 100;

	function drawGrid(x, y)
	{
		var color = "#999999";
		var i = -1;
		while (++i <= y)
		{
			ctx.strokeStyle = color;
			ctx.moveTo(0, i * factor.y);
			ctx.lineTo(canvas.width, i * factor.y);
			ctx.stroke();
		}
		var i = -1;
		while (++i <= x)
		{
			ctx.strokeStyle = color;
			ctx.moveTo(i * factor.x, 0);
			ctx.lineTo(i * factor.x, canvas.height);
			ctx.stroke();
		}
	}

	function getDirIndex(dir) {
		var dirs = {
			'west': 0,
			'south': 1,
			'east': 2,
			'north': 3
		};
		return dirs[dir];
	}

	function drawObjects(objects)
	{
		ctx.clearRect(0, 0, 3000, 3000);
		objects.forEach(function(el, i)
		{
			// ships that are alive show their sprite
			if (el.ship_pv > 0) {
				var img = new Image(el.ship_w * factor.x, el.ship_h * factor.y);
				// set the right sprite for the given object direction
				img.src = el.ship_sprite.replace('{{dir}}', getDirIndex(el.ship_dir));
				img.onload = function() {
					// west or east
					if (el.direction % 2 === 0)
						//             image,  posX,                 posY,                   width,                height
						ctx.drawImage(img, el.ship_posX * factor.x, el.ship_posY * factor.y, el.ship_h * factor.y, el.ship_w * factor.x);
					else
						ctx.drawImage(img, el.ship_posX * factor.x, el.ship_posY * factor.y, el.ship_w * factor.x, el.ship_h * factor.y);
				}
			} else {
				// dead ships show something else
				var img = new Image(50, 50);
				// set the right sprite for the given object direction
				img.src = '/ex00/img/redcross.png';
				img.onload = function() {
					//             image,  posX,                 posY,                  width, height
					ctx.drawImage(img, el.ship_posX * factor.x, el.ship_posY * factor.y, 50, 50);
				}
			}
		});
	}

	var game = angular.module('gameApp', []);
 
	game.controller('ActionFormCtrl', function ($http, $scope) {
		$http.get('index.php?action=xhrUser').success(function(user) {
			if (!user.must_play) {
				setInterval(function() {
					window.location = window.location;
				}, 5000);
			}

			$http.get('index.php?action=xhrGame').success(function(game) {
				$scope.user = user;
				$scope.game = game;

				drawObjects($scope.game.ships);
			});
		});

		// the maximum range of the slider, SHOULD BE CHANGED TO THE NUMBER OF PP
		$scope.maxRange = 800;
		// for the moment, dont accept moves
		$scope.moveLocked = true;

		$scope.selectShip = function(id) {
			$scope.game.ships.forEach(function(el) {
				if (el.ship_id === id)
					$scope.selectedShip = el;
			});
		}

		$scope.percentCalc = function(element) {
			if (element === 'valueRepartitionWeapons')
				$scope.movePointsValue = $scope.maxRange - $scope.weaponPointsValue;
			else
				$scope.weaponPointsValue = $scope.maxRange - $scope.movePointsValue;
		}

		$scope.submitRepartition = function() {
			$http({
				url: 'index.php?action=postTurnSubmitRepartition',
				method: "POST",
				headers: {
					"Content-Type": "application/x-www-form-urlencoded"
				},
				data: {
					shipId: $scope.selectedShip.ship_id,
					movePp: parseInt($scope.movePointsValue) / $scope.maxRange * MAX_PP,
					weaponPp: parseInt($scope.weaponPointsValue) / $scope.maxRange * MAX_PP
				}
			}).success(function(data) {
				$scope.repartitionSubmitted = true;
			});
		}

		$scope.rotate = function(direction) {
			var dirs = {'west': 1, 'south': 1, 'east': 1, 'north': 1};
			if (dirs[direction]) {
				$http({
					url: 'index.php?action=postTurnSubmitRotation',
					method: "POST",
					headers: {
						"Content-Type": "application/x-www-form-urlencoded"
					},
					data: {
						direction: direction
					}
				}).success(function(data) {
					$scope.selectedShip.ship_dir = direction;
					$scope.rotationDone = true;
					drawObjects($scope.game.ships);
				});
			} else {
				$scope.rotationDone = true;
			}
		}

		$scope.moveForward = function() {
			$http({
				url: 'index.php?action=postTurnSubmitMove',
				method: "POST"
			}).success(function(data) {
				$scope.moved = true;
				// if the ship was out of bounds and died
				// if the ship hit another ship, lock it !
				if (typeof data.x === 'undefined') {
					alert('Your ship just died from a collision! :(');
					return;
				}
				$scope.selectedShip.ship_posX = data.x;
				$scope.selectedShip.ship_posY = data.y;
				drawObjects($scope.game.ships);
			});
		}
	});

})();