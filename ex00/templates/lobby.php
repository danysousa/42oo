<!DOCTYPE html>
<HTML>
	<HEAD>
		<TITLE>Warhammer Online Battle</TITLE>
		<LINK href="css/lobby.css" rel="stylesheet" type="text/css">
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
	</HEAD>
	<BODY>
		<img class="float_img" src="http://media.moddb.com/images/groups/1/3/2055/469px-Storm_Warden.png">
		<center>
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
				<a href="index.php?action=home" title="Home"><span id="header_title">[LOBBY:PAGE]</span></a>
				<div id="global_block">
					<div class="menu_block">
					<div id="lobby_block">
					<div id="chat_block">
					<fieldset>
    					<?php print $_SESSION['chatLog']; ?>
    				</fieldset>
    				</div>
    				</div>
    				<form class="lobby_block_typo" action="index.php?action=getChatMsg" method="POST">
    						<input type="text" name="message" id="chat_msg" placeholder="[MESSAGE]" size="40">
    						<input type="submit" value="Send" size="10">
    				</form>
					</div>
				</div>
			</div>
		</center>
	</BODY>
</HTML> 
