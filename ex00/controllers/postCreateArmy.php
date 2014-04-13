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
		$tb_class = array();
		while ($i < 3)
		{
			if ($_POST[$tb_key[$i]] == "-- No army ! I'm a warrior --")
			{
				$_POST[$tb_key[$i]] = NULL;
				$count++;
			}
			else
				$tb_class[] = $_POST[$tb_key[$i]];
			$i++;
		}
		if ($count == 3)
			header("Location: ./index.php?action=createArmy");
		$player = new Player(app()->get('session')->get('login'), 0, 0);
		foreach ($tb_class as $value)
		{
			$instance = new $value(0, 0, $player);
			$pv = $instance->getPv();
			$id = app()->get('db')->query("INSERT INTO vaisseau (class, posX, posY, pv, portee, mobile, pp_shield, pp_gun, pp_speed, pp_total)
				VALUES (?, ?, ?, ?, ?, 1, ?, ?, ?, ?)",
				array(
					$value,
					0,
					0,
					$pv,
					'courte',
					0,
					0,
					0,
					0
				));
			$id = app()->get('db')->queryOne("SELECT id FROM vaisseau ORDER BY id DESC LIMIT 1", array());
			$partie = app()->get('db')->queryOne("SELECT id_partie FROM user WHERE id LIKE ?", array(
				app()->get('session')->get('id_usr')
			));
			app()->get('db')->query("INSERT INTO flotte (id_user, id_partie, id_vaisseau) VALUES(?, ?, ?)", array(
				app()->get('session')->get('id_usr'),
				$partie['id_partie'],
				$id['id']
			));
		}

		/*
		**
		**	L'enregistrement en bdd est fait, il reste a recuperer les valeurs
		**	initial tel que la position, et la portee (non presente pour le moment dans la class)
		**
		*/


		echo "Success !";


		/*
		**
		**	redirection vers la map !
		**
		*/

	}
	else
		echo app()->get('view')->render('army');
};