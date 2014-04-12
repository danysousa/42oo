<!DOCTYPE html>
<html>
<head>
	<title>Create Army</title>
	<meta charset="utf8">
	<?php
		$player = new Player(app()->get('session')->get('login'), 0, 0);
		$instance = new HonorableDuty(0, 0, $player);
		$HonorableDuty = $instance->toJson();
		$instance = new SwordOfAbsolution(0, 0, $player);
		$SwordOfAbsolution = $instance->toJson();
	?>
</head>
<body>
	<select onclick="changeInfo()">
		<option>HonorableDuty</option>
		<option>SwordOfAbsolution</option>
	</select>
		<div id="HonorableDuty">
		<?php
		foreach ($HonorableDuty as $key => $value)
		{
			if ($key != 'player')
				echo $key . ": " . $value . "<br />";
		}
		?>
		</div>
		<div class='block' id="SwordOfAbsolution">
		<?php
		foreach ($SwordOfAbsolution as $key => $value)
		{
			if ($key != 'player')
				echo $key . ": " . $value . "<br />";
		}
		?>
		</div>
</body>
</script>
</html>