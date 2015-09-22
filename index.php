<?php

//MAKE SURE ERRORS ARE SHOWN... MIGHT WANT TO TURN THIS OFF ON A PUBLIC SERVER
//error_reporting(E_ALL);
//ini_set('display_errors', 'On');



//INCLUDE THE FILES NEEDED...
require_once('view/LoginView.php');
require_once('view/DateTimeView.php');
require_once('view/LayoutView.php');

require_once('controller/Login.php');

require_once('model/User.php');

//set the life ot the cookie to be 0 sec
session_set_cookie_params(0);

session_start();

//set the initial value for $_SESSION['Logged']
if(!isset($_SESSION['Logged']))
	$_SESSION['Logged'] = false;

$admin = new User("Admin","Password");

$loginController = new Login($admin);

$loginController->doLogin();




