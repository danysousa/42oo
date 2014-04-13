<?php

return function() {

	$login = app()->get('session')->get('login');

	if ($login === false) {
		die('Must be logged in.');
	}

	if ($_POST['submit'] == "FIGHT !" && ($_POST['first'] || $_POST['second'] || $_POST['third']))
	{
		$tb_key = array('first', 'second', 'third');
		$i = 0;
		$count = 0;
		while ($i < 3)
		{
			if ($_POST[$tb_key[$i]] == "-- No army ! I'm a warrior --")
			{
				$_POST[$tb_key[$i]] = NULL;
				$tb_key[$i] == NULL;
				$count++;
			}
			$i++;
		}
		if ($count == 3)
			header("Location: ./index.php?action=createArmy");
		$i = 0;
		while ($i < 3)
		{
			if ($tb_key[$i] != NULL)
			{
				$_POST[$tb_key[$i]] = NULL;
				$tb_key[$i] == NULL;
				$count++;
			}
			$i++;
		}

	}
	else
		echo app()->get('view')->render('army');
};