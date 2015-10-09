<?php

//MAKE SURE ERRORS ARE SHOWN... MIGHT WANT TO TURN THIS OFF ON A PUBLIC SERVER
error_reporting(E_ALL);
ini_set('display_errors', 'On');



//INCLUDE THE FILES NEEDED...
require_once('view/LoginView.php');
require_once('view/DateTimeView.php');
require_once('view/LayoutView.php');
require_once('view/RegisterView.php');
require_once('view/NavigationView.php');

require_once('controller/LoginController.php');
require_once('controller/MasterController.php');
require_once('controller/RegisterController.php');

require_once('model/UserList.php');
require_once('model/User.php');
require_once('model/UserDAL.php');
require_once('model/SessionModel.php');

//set the life ot the cookie to be 0 sec
session_set_cookie_params(0);
session_start();

$model = new SessionModel();

$logView = new LoginView($model);
$regView = new RegisterView();
$navigationView = new NavigationView($model);

$mc = new MasterController($model,$logView,$regView,$navigationView);
$mc->generate();

$layoutView = new LayoutView();
$dateView = new DateTimeView();

if($navigationView->inRegistrationForm())
	$layoutView->renderRegister($model->isLoggedIn(),$regView,$dateView,$navigationView);
else $layoutView->renderLogin($model->isLoggedIn(),$logView,$dateView,$navigationView);