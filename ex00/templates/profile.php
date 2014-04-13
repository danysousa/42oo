<!DOCTYPE html>
<HTML>
	<HEAD>
		<TITLE>Awesome Starships Battles II</TITLE>
		<LINK href="css/profile.css" rel="stylesheet" type="text/css">
	</HEAD>
	<BODY>
		<img class="float_img" src="http://media.moddb.com/images/groups/1/3/2055/469px-Storm_Warden.png">
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
				<a href="index.php?action=home" title="Home"><span id="header_title">[HOME:PAGE]</span></a>
				<div id="global_block">
					<div class="menu_block">
						<div id="badge">
							<span class="menu_block_typo" id="logname">[<?PHP if(array_key_exists('login', $_SESSION))echo $_SESSION['login']; else echo 'Guest'; ?>]</span><br />
							<span class="menu_block_typo" id="level">LEVEL[??]</span>
							<table border="0" id="score_table">
								<tr>
									<td id="grade">Grade</td>
								</tr>
								<tr>
									<td id="victory">Victories: </td>
								</tr>
								<tr>
									<td id="defeat">Defeats: </td>
								</tr>
								<tr>
									<td id="experience">Experience earned: </td>
								</tr>
						</table>
						</div>
						<img id="profile_img" src="" alt="Profile Picture">
					</div>
					<div class="score_block">
						<table border="0">
							<tr>
								<td class="score"></td>
							</tr>
						</table>
					</div>
				</div>
			</div>
		</center>
	</BODY>
</HTML> 
