<?php
/**
 * @author Imelda Medina
 * @version 1.0
 * 1/15/2020
 * 328/dating.index.php
 * instantiating home.html
 */
//Turn on error reporting
ini_set('display_errors',1);
error_reporting(E_ALL);
//Require autoload file
require("vendor/autoload.php");
//Instantiate F3
$f3 = Base:: instance();

//define a default route
$f3->route('GET /', function(){
    $view = new Template();
    echo $view->render('views/home.html');
});
//Run F3
$f3->run();
