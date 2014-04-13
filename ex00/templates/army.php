<!DOCTYPE html>
<html>
<head>
	<title>Create Army</title>
	<meta charset="utf8">
	<script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
	<script src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
	<?php
		$player = new Player(app()->get('session')->get('login'), 0, 0);
		$instance = new HonorableDuty(0, 0, $player);
		$HonorableDuty = $instance->toJson();
		$instance = new SwordOfAbsolution(0, 0, $player);
		$SwordOfAbsolution = $instance->toJson();
	?>
</head>
<body>
<form action="index.php?action=postCreateArmy" method="post">
	<div>
		<select name='first'>
			<option>-- No army ! I'm a warrior --</option>
			<option>HonorableDuty</option>
			<option>SwordOfAbsolution</option>
		</select>
		<div class="HonorableDuty">
		<?php
		foreach ($HonorableDuty as $key => $value)
		{
			if ($key != 'player')
				echo $key . ": " . $value . "<br />";
		}
		?>
		</div>
		<div class="SwordOfAbsolution">
		<?php
		foreach ($SwordOfAbsolution as $key => $value)
		{
			if ($key != 'player')
				echo $key . ": " . $value . "<br />";
		}
		?>
		</div>
	</div>
	<div>
		<select name='second'>
			<option>-- No army ! I'm a warrior --</option>
			<option>HonorableDuty</option>
			<option>SwordOfAbsolution</option>
		</select>
		<div class="HonorableDuty">
		<?php
		foreach ($HonorableDuty as $key => $value)
		{
			if ($key != 'player')
				echo $key . ": " . $value . "<br />";
		}
		?>
		</div>
		<div class="SwordOfAbsolution">
		<?php
		foreach ($SwordOfAbsolution as $key => $value)
		{
			if ($key != 'player')
				echo $key . ": " . $value . "<br />";
		}
		?>
		</div>
	</div>
	<div>
		<select name='third'>
			<option>-- No army ! I'm a warrior --</option>
			<option>HonorableDuty</option>
			<option>SwordOfAbsolution</option>
		</select>
		<div class="HonorableDuty">
		<?php
		foreach ($HonorableDuty as $key => $value)
		{
			if ($key != 'player')
				echo $key . ": " . $value . "<br />";
		}
		?>
		</div>
		<div class="SwordOfAbsolution">
		<?php
		foreach ($SwordOfAbsolution as $key => $value)
		{
			if ($key != 'player')
				echo $key . ": " . $value . "<br />";
		}
		?>
		</div>
	</div>
	<input name='submit' value='FIGHT !' type="submit">
</form>
</body>
<script>

$(document).ready(function()
{
	$('select').siblings().css('display', 'none');
	$('select').val("-- No army ! I'm a warrior --");
});

$('select').change(function()
{
	$(this).siblings().css('display', 'none');
	if ($(this).val().localeCompare("-- No army ! I'm a warrior --"))
	{
		tmp = '.' + $(this).val();
		$(this).siblings(tmp).css('display', 'block');
	}
})

</script>
</html>