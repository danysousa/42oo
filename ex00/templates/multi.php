<!DOCTYPE html>
<HTML>
	<HEAD>
		<TITLE>Warhammer Online Battle</TITLE>
		<LINK href="css/multi.css" rel="stylesheet" type="text/css">
	</HEAD>
	<BODY>
		<center>
			<img class="float_img" src="http://media.moddb.com/images/groups/1/3/2055/469px-Storm_Warden.png">
			<div id="global">
				<div id="log_bar">
					<table border="0">
						<tr>
							<td class="header_cell"><a href="login.html" title="">LOGIN</a></td>
							<td class="header_cell"><a href="login.html" title="">REGISTER</a></td>
							<td class="header_cell"><a href="" title="">ABOUT</a></td>
						</tr>
					</table>
				</div>
				<a href="index.php" title="Home"><span id="header_title">[MULTI:PAGE]</span></a>
				<div id="global_block">
					<div class="login_block">
						<span class="login_block_typo">[CREATE:GAME]</span>
						<div class="form_block">
							<form id="login" method="POST">
								<input type="text" name="create_game_name" value="[GAME:NAME]"><br />
								<input type="submit" name="create_game_submit" value="FIGHT">
							</form>
						</div>
					</div>
					<div class="login_block">
						<span class="login_block_typo">[JOIN:GAME]</span>
						<div class="form_block">
							<form id="register" method="POST">
								<input type="text" name="join_game_login" value="[GAME:NAME]"><br />
								<input type="submit" name="join_game_submit" value="FIGHT">
							</form>
						</div>
					</div>
				</div>
				</div>
			</div>
		</center>
	</BODY>
</HTML> 