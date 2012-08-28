<?php
if(!empty($_REQUEST['logout'])){
//	$redirect = str_replace('?logout=1&', '?', $_SERVER['REQUEST_URI']);
//	$redirect = str_replace('?logout=1', '', $redirect);
//	$redirect = str_replace('&logout=1', '', $redirect);
	$redirect = '/personal/login.php';
	unset($_SESSION['CUSER']);
	header('location: '.$redirect);
}elseif (!empty($_REQUEST['auth_submit'])){
	// check login-pass
	if( $USER->authorizeUser($_REQUEST['login'], $_REQUEST['password']) === false){
		$USER->setAuthorizationError(true);
		$USER->setAuthorizationErrorMessage('WRONG_AUTHORIZATION');
	}
}elseif (!empty($_SESSION['CUSER']) ){
	// if user already authorized
	$USER->fillInfo($_SESSION['CUSER']);
}
?>