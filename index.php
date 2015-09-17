<?php

//MAKE SURE ERRORS ARE SHOWN... MIGHT WANT TO TURN THIS OFF ON A PUBLIC SERVER
error_reporting(E_ALL);
ini_set('display_errors', 'On');


//INCLUDE THE FILES NEEDED...
require_once('view/LoginView.php');
require_once('view/DateTimeView.php');
require_once('view/LayoutView.php');

require_once('controller/Login.php');

require_once('model/User.php');


$admin = new User("Admin","Password");

//CREATE OBJECTS OF THE VIEWS
$v = new LoginView();
$dtv = new DateTimeView();
$lv = new LayoutView();

$loginController = new Login($admin);

$loginController->doLogin();



//$lv->render(false, $v, $dtv);

