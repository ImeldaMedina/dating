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
require_once('model/validation.php');
require_once ('controller/dating-controller.php');

//session start
session_start();

//Instantiate F3
$f3 = Base:: instance();

//turn on Fat-Free error reporting
$f3->set('DEBUG' ,3);

//define arrays
$f3->set('genders', array('male', 'female'));
$f3->set('seekGenders', array('male', 'female'));
$f3->set('indoors', array('tv', 'puzzles', 'movies', 'reading', 'cooking',
    'playing cards', 'board games', 'video games'));
$f3->set('outdoors', array('hiking', 'walking', 'biking', 'climbing', 'swimming', 'collecting'));

//Instantiate controller object
$controller= new DatingController($f3);

//define a default route
$f3->route('GET /', function(){
    $GLOBALS['controller']->home();

});

//define a new root for order
$f3->route('GET|POST /order', function($f3){
    $GLOBALS['controller']->order($f3);
});

$f3->route('GET|POST /order2', function($f3){
    $GLOBALS['controller']->order2($f3);
});

//Get indor and outdoor interests
$f3->route('GET|POST /order3', function($f3){
    $GLOBALS['controller']->order3($f3);
});
//get the results printed
$f3->route('GET|POST /summary', function(){
    $GLOBALS['controller']->summary();
});

//Run F3
$f3->run();
