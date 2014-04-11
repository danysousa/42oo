(function() {
	var canvas = document.getElementById("myCanvas");
	var ctx = canvas.getContext("2d");

	$.get("/ex00/index.php?action=objects", function(data)
	{
		data.forEach(function(el, i) {
			if (el.alive) {
				var img = new Image(el.w * 10, el.h * 10);
				img.src = el.sprite;
				img.onload = function() {
					ctx.drawImage(img, el.x * 10, el.y * 10, el.w * 10, el.h * 10);
				}
			}
		});
	});
})();