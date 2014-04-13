<!DOCTYPE html>
<html>
<head>
	<title>Installation</title>
	<meta charset="utf8"/>
	<?php
		if ($_POST)
		{
			if ($_POST['mdp'])
			{
				if (!file_exists('config_custom.php'))
				{
					$content = "<?php " . PHP_EOL . "$" . "GLOBALS" . "['DB_PASSWORD']" . "='" . $_POST['mdp'] . "';";
					$fp = fopen("config_custom.php","w+b");
					fwrite($fp,$content);
					fclose($fp);
					$link = mysqli_connect('localhost', 'root', $_POST['mdp']);
					var_dump($link);
					mysqli_multi_query($link, file_get_contents("rush.sql"));
					header('Location: ./index.php');
				}
			}
		}

	?>
</head>
<body>
	<form action="install.php" method="post">
		<input name="mdp" type="password" placeholder="password">
		<input name="submit" type="submit" value="Je permet la connexion à phpmyadmin contre un sourire :)">
	</form>
</body>
</html>