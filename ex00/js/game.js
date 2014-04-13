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

	function drawObjects(objects)
	{
		objects.forEach(function(el, i)
		{
			if (el.alive) {
				var img = new Image(el.w * factor.x, el.h * factor.y);
				// set the right sprite for the given object direction
				img.src = el.sprite.replace('{{dir}}', el.direction);
				img.onload = function()
				{
					// west or east
					if (el.direction % 2 === 0)
						ctx.drawImage(img, el.x * factor.x, el.y * factor.y, el.h * factor.y, el.w * factor.x);
					else
						ctx.drawImage(img, el.x * factor.x, el.y * factor.y, el.w * factor.x, el.h * factor.y);
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
				// if the ship was out of bounds and died
				if (data.shipDied) {
					alert('Your ship just died... :(');
					return;
				}
				// if the ship hit another ship, lock it !
				if (data.shipLocked) {
					alert('Your ship was locked :(');
					return;
				}
				$scope.selectedShip.ship_posX = data.x;
				$scope.selectedShip.ship_posY = data.y;
				$scope.moved = true;
			});
		}

		/*
		$http.get('/ex00/index.php?action=player').success(function(player)
		{
			$scope.player = player;
		});
		$http.get('/ex00/index.php?action=playerShips').success(function(ships)
		{
			$scope.playerShips = ships;
		});
		$http.get('/ex00/index.php?action=objects').success(function(objects)
		{
			ctx.clearRect(0, 0, canvas.height, canvas.width);
			drawGrid(150, 100);
			drawObjects(objects);
			$scope.objects = objects;
		});
		*/

		// document.addEventListener('keydown', function(event) 
		// {
		// 	if ($scope.chosenShip)
		// 	{
		// 	    if(event.keyCode == KEY_LEFT) 
		// 	    {
		// 			$http.get('/ex00/index.php?action=move&x=-1&y=0&id=').success(function(objects)
		// 			{
		// 				ctx.clearRect(0, 0, canvas.height, canvas.width);
		// 				drawGrid(150, 100);
		// 				drawObjects(objects);
		// 				$scope.objects = objects;
		// 			});
		// 	    }
		// 	    else if(event.keyCode == KEY_RIGHT) 
		// 	    {
		// 			$http.get('/ex00/index.php?action=move&x=1&y=0').success(function(objects)
		// 			{
		// 				ctx.clearRect(0, 0, canvas.height, canvas.width);
		// 				drawGrid(150, 100);
		// 				drawObjects(objects);
		// 				$scope.objects = objects;
		// 			});
		// 	    }
		// 	    else if(event.keyCode == KEY_UP) 
		// 	    {
		// 			$http.get('/ex00/index.php?action=move&x=0&y=1').success(function(objects)
		// 			{
		// 				ctx.clearRect(0, 0, canvas.height, canvas.width);
		// 				drawGrid(150, 100);
		// 				drawObjects(objects);
		// 				$scope.objects = objects;
		// 			}); 
		// 	    }
		// 	    else if(event.keyCode == KEY_DOWN) 
		// 	    {
		// 			$http.get('/ex00/index.php?action=move&x=0&y=-1').success(function(objects)
		// 			{
		// 				ctx.clearRect(0, 0, canvas.height, canvas.width);
		// 				drawGrid(150, 100);
		// 				drawObjects(objects);
		// 				$scope.objects = objects;
		// 			});
		// 	    }
		// 	}
		// });
	});

})();