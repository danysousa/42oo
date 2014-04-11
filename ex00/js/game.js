(function() {
	var KEY_DOWN	= 40;
	var KEY_UP		= 38;
	var KEY_LEFT	= 37;
	var KEY_RIGHT	= 39;
	var canvas = document.getElementById("myCanvas");
	var ctx = canvas.getContext("2d");

	var factor = {
		x: canvas.width / 150,
		y: canvas.height / 100
	};

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
 
	game.controller('ActionFormCtrl', function ($scope, $http)
	{
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