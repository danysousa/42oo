<!DOCTYPE html>
<html>
<head>
	<title>Awesome Starships Battles II</title>
	<meta charset="utf8">
	<LINK href="css/army.css" rel="stylesheet" type="text/css">
	<script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
	<script src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
	<?php
		$player = new Player(app()->get('session')->get('login'), 0, 0);
		$instance = new HonorableDuty(0, 0, $player);
		$HonorableDuty = $instance->toJson();
		$instance = new SwordOfAbsolution(0, 0, $player);
		$SwordOfAbsolution = $instance->toJson();
		$instance = new BlueLeaf(0, 0, $player);
		$BlueLeaf = $instance->toJson();
		$instance = new BloodPuller(0, 0, $player);
		$BloodPuller = $instance->toJson();
		$instance = new PurpleDeath(0, 0, $player);
		$PurpleDeath = $instance->toJson();
	?>
</head>
<body>
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
<a href="index.php?action=home" title="Home"><span id="header_title">[CREATE:ARMY]</span></a>
<div id="global_block">
<form action="index.php?action=postCreateArmy" method="post">
	<div>
		<select class=".select" name='first'>
			<option>-- No army ! I'm a warrior --</option>
			<option>HonorableDuty</option>
			<option>SwordOfAbsolution</option>
			<option>BlueLeaf</option>
			<option>BloodPuller</option>
			<option>PurpleDeath</option>
		</select>
		<div class="HonorableDuty">
		<?php
			echo '<img style="margin-bottom:20px;" src="'.str_replace('{{dir}}', '0', $HonorableDuty['sprite']).'">'.'<br />';
			echo 'Name: '.$HonorableDuty['name'].'<br />';
			echo 'Speed: '.$HonorableDuty['speed'].'<br />';
			echo 'Inertia: '.$HonorableDuty['inertia'].'<br />';
			echo 'LifePoints: '.$HonorableDuty['pv'].'<br />';
			echo 'ShieldPoints: '.$HonorableDuty['shield'].'<br />';
		?>
		</div>
		<div class="SwordOfAbsolution">
		<?php
			echo '<img style="margin-bottom:20px;" src="'.str_replace('{{dir}}', '0', $SwordOfAbsolution['sprite']).'">'.'<br />';
			echo 'Name: '.$SwordOfAbsolution['name'].'<br />';
			echo 'Speed: '.$SwordOfAbsolution['speed'].'<br />';
			echo 'Inertia: '.$SwordOfAbsolution['inertia'].'<br />';
			echo 'LifePoints: '.$SwordOfAbsolution['pv'].'<br />';
			echo 'ShieldPoints: '.$SwordOfAbsolution['shield'].'<br />';
		?>
		</div>
		<div class="BlueLeaf">
		<?php
			echo '<img style="margin-bottom:20px;" src="'.str_replace('{{dir}}', '0', $BlueLeaf['sprite']).'">'.'<br />';
			echo 'Name: '.$BlueLeaf['name'].'<br />';
			echo 'Speed: '.$BlueLeaf['speed'].'<br />';
			echo 'Inertia: '.$BlueLeaf['inertia'].'<br />';
			echo 'LifePoints: '.$BlueLeaf['pv'].'<br />';
			echo 'ShieldPoints: '.$BlueLeaf['shield'].'<br />';
		?>
		</div>
		<div class="BloodPuller">
		<?php
			echo '<img style="margin-bottom:20px;" src="'.str_replace('{{dir}}', '0', $BloodPuller['sprite']).'">'.'<br />';
			echo 'Name: '.$BloodPuller['name'].'<br />';
			echo 'Speed: '.$BloodPuller['speed'].'<br />';
			echo 'Inertia: '.$BloodPuller['inertia'].'<br />';
			echo 'LifePoints: '.$BloodPuller['pv'].'<br />';
			echo 'ShieldPoints: '.$BloodPuller['shield'].'<br />';
		?>
		</div>
		<div class="PurpleDeath">
		<?php
			echo '<img style="margin-bottom:20px;" src="'.str_replace('{{dir}}', '0', $PurpleDeath['sprite']).'">'.'<br />';
			echo 'Name: '.$PurpleDeath['name'].'<br />';
			echo 'Speed: '.$PurpleDeath['speed'].'<br />';
			echo 'Inertia: '.$PurpleDeath['inertia'].'<br />';
			echo 'LifePoints: '.$PurpleDeath['pv'].'<br />';
			echo 'ShieldPoints: '.$PurpleDeath['shield'].'<br />';
		?>
		</div>
	</div>
	<div>
		<select class=".select" name='second'>
			<option>-- No army ! I'm a warrior --</option>
			<option>HonorableDuty</option>
			<option>SwordOfAbsolution</option>
			<option>BlueLeaf</option>
			<option>BloodPuller</option>
			<option>PurpleDeath</option>
		</select>
		<div class="HonorableDuty">
		<?php
			echo '<img style="margin-bottom:20px;" src="'.str_replace('{{dir}}', '0', $HonorableDuty['sprite']).'">'.'<br />';
			echo 'Name: '.$HonorableDuty['name'].'<br />';
			echo 'Speed: '.$HonorableDuty['speed'].'<br />';
			echo 'Inertia: '.$HonorableDuty['inertia'].'<br />';
			echo 'LifePoints: '.$HonorableDuty['pv'].'<br />';
			echo 'ShieldPoints: '.$HonorableDuty['shield'].'<br />';
		?>
		</div>
		<div class="SwordOfAbsolution">
		<?php
			echo '<img style="margin-bottom:20px;" src="'.str_replace('{{dir}}', '0', $SwordOfAbsolution['sprite']).'">'.'<br />';
			echo 'Name: '.$SwordOfAbsolution['name'].'<br />';
			echo 'Speed: '.$SwordOfAbsolution['speed'].'<br />';
			echo 'Inertia: '.$SwordOfAbsolution['inertia'].'<br />';
			echo 'LifePoints: '.$SwordOfAbsolution['pv'].'<br />';
			echo 'ShieldPoints: '.$SwordOfAbsolution['shield'].'<br />';
		?>
		</div>
		<div class="BlueLeaf">
		<?php
			echo '<img style="margin-bottom:20px;" src="'.str_replace('{{dir}}', '0', $BlueLeaf['sprite']).'">'.'<br />';
			echo 'Name: '.$BlueLeaf['name'].'<br />';
			echo 'Speed: '.$BlueLeaf['speed'].'<br />';
			echo 'Inertia: '.$BlueLeaf['inertia'].'<br />';
			echo 'LifePoints: '.$BlueLeaf['pv'].'<br />';
			echo 'ShieldPoints: '.$BlueLeaf['shield'].'<br />';
		?>
		</div>
		<div class="BloodPuller">
		<?php
			echo '<img style="margin-bottom:20px;" src="'.str_replace('{{dir}}', '0', $BloodPuller['sprite']).'">'.'<br />';
			echo 'Name: '.$BloodPuller['name'].'<br />';
			echo 'Speed: '.$BloodPuller['speed'].'<br />';
			echo 'Inertia: '.$BloodPuller['inertia'].'<br />';
			echo 'LifePoints: '.$BloodPuller['pv'].'<br />';
			echo 'ShieldPoints: '.$BloodPuller['shield'].'<br />';
		?>
		</div>
		<div class="PurpleDeath">
		<?php
			echo '<img style="margin-bottom:20px;" src="'.str_replace('{{dir}}', '0', $PurpleDeath['sprite']).'">'.'<br />';
			echo 'Name: '.$PurpleDeath['name'].'<br />';
			echo 'Speed: '.$PurpleDeath['speed'].'<br />';
			echo 'Inertia: '.$PurpleDeath['inertia'].'<br />';
			echo 'LifePoints: '.$PurpleDeath['pv'].'<br />';
			echo 'ShieldPoints: '.$PurpleDeath['shield'].'<br />';
		?>
		</div>
	</div>
	<div>
		<select class=".select" name='third'>
			<option>-- No army ! I'm a warrior --</option>
			<option>HonorableDuty</option>
			<option>SwordOfAbsolution</option>
			<option>BlueLeaf</option>
			<option>BloodPuller</option>
			<option>PurpleDeath</option>
		</select>
		<div class="HonorableDuty">
		<?php
			echo '<img style="margin-bottom:20px;" src="'.str_replace('{{dir}}', '0', $HonorableDuty['sprite']).'">'.'<br />';
			echo 'Name: '.$HonorableDuty['name'].'<br />';
			echo 'Speed: '.$HonorableDuty['speed'].'<br />';
			echo 'Inertia: '.$HonorableDuty['inertia'].'<br />';
			echo 'LifePoints: '.$HonorableDuty['pv'].'<br />';
			echo 'ShieldPoints: '.$HonorableDuty['shield'].'<br />';
		?>
		</div>
		<div class="SwordOfAbsolution">
		<?php
			echo '<img style="margin-bottom:20px;" src="'.str_replace('{{dir}}', '0', $SwordOfAbsolution['sprite']).'">'.'<br />';
			echo 'Name: '.$SwordOfAbsolution['name'].'<br />';
			echo 'Speed: '.$SwordOfAbsolution['speed'].'<br />';
			echo 'Inertia: '.$SwordOfAbsolution['inertia'].'<br />';
			echo 'LifePoints: '.$SwordOfAbsolution['pv'].'<br />';
			echo 'ShieldPoints: '.$SwordOfAbsolution['shield'].'<br />';
		?>
		</div>
		<div class="BlueLeaf">
		<?php
			echo '<img style="margin-bottom:20px;" src="'.str_replace('{{dir}}', '0', $BlueLeaf['sprite']).'">'.'<br />';
			echo 'Name: '.$BlueLeaf['name'].'<br />';
			echo 'Speed: '.$BlueLeaf['speed'].'<br />';
			echo 'Inertia: '.$BlueLeaf['inertia'].'<br />';
			echo 'LifePoints: '.$BlueLeaf['pv'].'<br />';
			echo 'ShieldPoints: '.$BlueLeaf['shield'].'<br />';
		?>
		</div>
		<div class="BloodPuller">
		<?php
			echo '<img style="margin-bottom:20px;" src="'.str_replace('{{dir}}', '0', $BloodPuller['sprite']).'">'.'<br />';
			echo 'Name: '.$BloodPuller['name'].'<br />';
			echo 'Speed: '.$BloodPuller['speed'].'<br />';
			echo 'Inertia: '.$BloodPuller['inertia'].'<br />';
			echo 'LifePoints: '.$BloodPuller['pv'].'<br />';
			echo 'ShieldPoints: '.$BloodPuller['shield'].'<br />';
		?>
		</div>
		<div class="PurpleDeath">
		<?php
			echo '<img style="margin-bottom:20px;" src="'.str_replace('{{dir}}', '0', $PurpleDeath['sprite']).'">'.'<br />';
			echo 'Name: '.$PurpleDeath['name'].'<br />';
			echo 'Speed: '.$PurpleDeath['speed'].'<br />';
			echo 'Inertia: '.$PurpleDeath['inertia'].'<br />';
			echo 'LifePoints: '.$PurpleDeath['pv'].'<br />';
			echo 'ShieldPoints: '.$PurpleDeath['shield'].'<br />';
		?>
		</div>
	</div>
	<input name='submit' value='FIGHT !' type="submit">
</form>
</div>
</div>
</center>
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