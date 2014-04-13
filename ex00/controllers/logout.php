<?php

	return function(){
		app()->get('session')->set('id_usr', NULL);
		app()->get('session')->set('login', NULL);
		session_destroy();
		header('Location: index.php?action=home');
	};