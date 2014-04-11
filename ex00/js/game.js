(function() {
	var canvas = document.getElementById("myCanvas");
	var ctx = canvas.getContext("2d");

	var factor = {
		x: canvas.width / 150,
		y: canvas.height / 100
	};

	function grid(x, y)
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

	grid(150, 100);

	$.get("/ex00/index.php?action=objects", function(data)
	{
		data.forEach(function(el, i) {
			if (el.alive) {
				var img = new Image(el.w * factor.x, el.h * factor.y);
				img.src = el.sprite;
				img.onload = function() {
					ctx.drawImage(img, el.x * factor.x, el.y * factor.y, el.w * factor.x, el.h * factor.y);
				}
			}
		});
	});

	var game = angular.module('gameApp', []);
 
	game.controller('ActionFormCtrl', function ($scope, $http)
	{
		$http.get('/ex00/index.php?action=objects').success(function(data) {
			$scope.objects = data;
			data.forEach(function(el, i) {
				if (el.alive) {
					var img = new Image(el.w * factor.x, el.h * factor.y);
					img.src = el.sprite;
					img.onload = function() {
						ctx.drawImage(img, el.x * factor.x, el.y * factor.y, el.w * factor.x, el.h * factor.y);
					}
				}
			});
		});
	});
})();