<!DOCTYPE html>
<HTML>
	<HEAD>
		<TITLE>Awesome Starships Battles II</TITLE>
		<LINK href="css/login.css" rel="stylesheet" type="text/css">
	</HEAD>
	<BODY>
		<center>
			<img class="float_img" src="http://media.moddb.com/images/groups/1/3/2055/469px-Storm_Warden.png">
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
				<a href="index.php?action=home" title="Home"><span id="header_title">[LOGIN:PAGE]</span></a>
				<div id="global_block">
					<div class="login_block">
						<span class="login_block_typo">[LOGIN]</span>
						<div class="form_block">
							<form id="login" method="POST" action="./index.php?action=login">
								<input type="text" name="login_login" placeholder="[LOGIN]"><br />
								<input type="password" name="login_password" placeholder="[PASSWORD]"><br />
								<input type="submit" name="login_submit" placeholder="FIGHT">
							</form>
						</div>
					</div>
					<div class="login_block">
						<span class="login_block_typo">[REGISTER]</span>
						<div class="form_block">
							<form id="register" method="POST" action="./index.php?action=login">
								<input type="text" name="register_login" placeholder="[REGISTER_LOGIN]"><br />
								<input type="password" name="register_password" placeholder="[PASSWORD]"><br />
								<input type="submit" name="register_submit" placeholder="FIGHT">
							</form>
						</div>
					</div>
				</div>
				</div>
			</div>
		</center>
	</BODY>
</HTML>
