<!DOCTYPE html>
<HTML>
	<HEAD>
		<TITLE>Warhammer Online Battle</TITLE>
		<LINK href="css/login.css" rel="stylesheet" type="text/css">
	</HEAD>
	<BODY>
		<center>
			<img class="float_img" src="http://media.moddb.com/images/groups/1/3/2055/469px-Storm_Warden.png">
			<div id="global">
				<div id="log_bar">
					<table border="0">
						<tr>
							<td class="header_cell"><a href="index.php?action=login" title="">LOGIN</a></td>
							<td class="header_cell"><a href="index.php?action=login" title="">REGISTER</a></td>
							<td class="header_cell"><a href="" title="">ABOUT</a></td>
						</tr>
					</table>
				</div>
				<a href="index.php?action=home" title="Home"><span id="header_title">[LOGIN:PAGE]</span></a>
				<div id="global_block">
					<div class="login_block">
						<span class="login_block_typo">[LOGIN]</span>
						<div class="form_block">
							<form id="login" method="POST" action="./index.php?action=login">
								<input type="text" name="login_login" value="[LOGIN]"><br />
								<input type="password" name="login_password" value="[PASSWORD]"><br />
								<input type="submit" name="login_submit" value="FIGHT">
							</form>
						</div>
					</div>
					<div class="login_block">
						<span class="login_block_typo">[REGISTER]</span>
						<div class="form_block">
							<form id="register" method="POST" action="./index.php?action=login">
								<input type="text" name="register_login" value="[REGISTER_LOGIN]"><br />
								<input type="password" name="register_password" value="[PASSWORD]"><br />
								<input type="submit" name="register_submit" value="FIGHT">
							</form>
						</div>
					</div>
				</div>
				</div>
			</div>
		</center>
	</BODY>
</HTML>
