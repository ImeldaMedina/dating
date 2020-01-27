<?php
/**
 * @author Imelda Medina
 * @version 1.0
 * 1/15/2020
 * 328/dating.index.php
 * instantiating home.html
 */
//$indoor= $_SESSION['in-door[]'] = $_POST['in-door[]'];
session_start();
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
//define a new root
$f3->route('GET /order', function(){
    $view = new Template();
    echo $view->render('views/form1.html');
});
$f3->route('POST /order2', function(){
//   var_dump($_POST);
    $_SESSION['fName'] = $_POST['fName'];
    $_SESSION['lName'] = $_POST['lName'];
    $_SESSION['age'] = $_POST['age'];
    $_SESSION['gender'] = $_POST['gender'];
    $_SESSION['phoneNum'] = $_POST['phoneNum'];
    $view = new Template();
    echo $view->render('views/form2.html');
});
$f3->route('POST /order3', function(){
//    var_dump($_POST);
    $_SESSION['email'] = $_POST['email'];
    $_SESSION['state'] = $_POST['state'];
    $_SESSION['seekGender'] = $_POST['seekGender'];
    $_SESSION['biog'] = $_POST['biog'];
    $view = new Template();
    echo $view->render('views/form3.html');
});
//get the indoor and outdoor interests
$f3->route('POST /summary', function(){
//    $_SESSION['in-door[]'] = $_POST['in-door[]'];
    $indoor=$_POST['in-door'];
    $_SESSION['in'] = array();
    if(!empty($indoor)){
        foreach ($indoor as $value){
            array_push($_SESSION['in'],$value);
        }
    }
    foreach ($_SESSION['in'] as $value){
        $_SESSION['inter'] .= $value .',';
    }

//    $_SESSION['out-door[]'] = $_POST['out-door[]'];
    $outdoor=$_POST['out-door'];
    $_SESSION['int'] = array();
    if(!empty($outdoor)){
        foreach ($outdoor as $val){
            array_push($_SESSION['int'],$val);
        }
    }
    foreach ($_SESSION['int'] as $value){
        $_SESSION['out'] .= $value .',';
    }
    $view = new Template();
    echo $view->render('views/results.html');
});

//Run F3
$f3->run();
