<?php

$route['*']['/'] = array('HomeController', 'index');
$route['*']['/home'] = array('HomeController', 'index');
$route['*']['/article'] = array('HomeController', 'article');
$route['*']['/login'] = array('HomeController', 'login');
$route['*']['/contact'] = array('HomeController', 'contact');
$route['*']['/about'] = array('HomeController', 'about');

$route['post']['/login'] = array('LoginController', 'login');
$route['*']['/logout'] = array('LoginController', 'logout');
$route['*']['/super_admin'] = array('SuperAdminController', 'index');
$route['*']['/finance'] = array('FinanceController', 'index');


//Article
$route['*']['/manage_article'] = array('ArticleController', 'manageArticlePage');
$route['post']['/article/create_article'] = array('ArticleController', 'createArticle');


//Super Administrator rights
$route['*']['/create_user'] = array('SuperAdminController', 'createUserPage');
$route['*']['/manage_user'] = array('SuperAdminController', 'manageUserPage');
$route['post']['/super_admin/create_user'] = array('SuperAdminController', 'createUser');
$route['get']['/super_admin/get_user_list'] = array('SuperAdminController', 'getUserList');
$route['get']['/super_admin/get_one_user/:id'] = array('SuperAdminController', 'getOneUser');


//Validation
$route['*']['/validate/check_username'] = array('ValidateController', 'checkUsername');
$route['*']['/validate/check_email'] = array('ValidateController', 'checkEmail');

//Error page
$route['*']['/error'] = array('ErrorController', 'index');
$route['*']['/deny_access'] = array('ErrorController', 'banUser');

//test
$route['*']['/text_ck'] = array('HomeController', 'testck');

//---------- Delete if not needed ------------
$admin = array('admin'=>'1234');

//view the logs and profiles XML, filename = db.profile, log, trace.log, profile
$route['*']['/debug/:filename'] = array('MainController', 'debug', 'authName'=>'DooPHP Admin', 'auth'=>$admin, 'authFail'=>'Unauthorized!');

//show all urls in app
$route['*']['/allurl'] = array('MainController', 'allurl', 'authName'=>'DooPHP Admin', 'auth'=>$admin, 'authFail'=>'Unauthorized!');

//generate routes file. This replace the current routes.conf.php. Use with the sitemap tool.
$route['post']['/gen_sitemap'] = array('MainController', 'gen_sitemap', 'authName'=>'DooPHP Admin', 'auth'=>$admin, 'authFail'=>'Unauthorized!');

//generate routes & controllers. Use with the sitemap tool.
$route['post']['/gen_sitemap_controller'] = array('MainController', 'gen_sitemap_controller', 'authName'=>'DooPHP Admin', 'auth'=>$admin, 'authFail'=>'Unauthorized!');

//generate Controllers automatically
$route['*']['/gen_site'] = array('MainController', 'gen_site', 'authName'=>'DooPHP Admin', 'auth'=>$admin, 'authFail'=>'Unauthorized!');

//generate Models automatically
$route['*']['/gen_model'] = array('MainController', 'gen_model', 'authName'=>'DooPHP Admin', 'auth'=>$admin, 'authFail'=>'Unauthorized!');


?>