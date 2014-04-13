<?php

	return function(){

		$login = app()->get('session')->get('login');
		$message = $_POST['message'];
		$history = array();
		$historyLog = array();
		$newMessage = array();

		if (file_exists('./private') === True)
			$history = unserialize(file_get_contents('./private/logs'));
		else
			mkdir('./private', 0777);

		foreach ($history as $key => $value) {
				$historyLog[] = '<p class="chat_typo" style="color:white;text-align:left;font-size:16px;font-family:monospace;">'.$value['date'].' '.$value['login'].':'.'</p><p style="color:#52AEF3;text-align:left;font-family:monospace;font-size:18px;">'.$value['message'].'</p><br /><br />';
			}

		$newMessage['date'] = date('d:m:Y H:i:s');
		$newMessage['login'] = $login;
		$newMessage['message'] = $message;

		$history[] = $newMessage;
		$historyLog[] = '<p class="chat_typo" style="color:white;text-align:left;font-size:16px;font-family:monospace;">'.$newMessage['date'].' '.$newMessage['login'].':'.'</p><p style="color:#52AEF3;text-align:left;font-family:monospace;font-size:18px;">'.$newMessage['message'].'</p><br /><br />';

		app()->get('session')->set('chatLog', implode('', $historyLog));

		file_put_contents('./private/logs', serialize($history));
		header('Location: index.php?action=lobby');
	}

?>