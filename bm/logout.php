<?php

	require_once "admin/black-min.php";

	if ($SM->stop()) {
		$BMURL->goToLogin();
		exit();
	} else {
		$BMURL->goToStart();
		exit();	
	}
	