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
require_once('model/validation.php');
//Instantiate F3
$f3 = Base:: instance();

//turn on Fat-Free error reporting
$f3->set('DEBUG' ,3);

//define arrays
$f3->set('indoor', array('tv', 'puzzles', 'movies', 'reading', 'cooking',
    'playing cards', 'board games', 'video games'));
$f3->set('outdoor', array('hiking', 'walking', 'biking', 'climbing', 'swimming', 'collecting'));

//define a default route
$f3->route('GET /', function(){
    $view = new Template();
    echo $view->render('views/home.html');

});

//define a new root for order
$f3->route('GET|POST /order', function($f3){
    //If form has been submitted, validate
    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        //Get data from the form
        $fName = $_POST['fName'];
        $lName = $_POST['lName'];
        $age = $_POST['age'];
        $gender = $_POST['gender'];
        $phoneNum = $_POST['phoneNum'];

        //Add data to hive
        $f3->set('fName', $fName);
        $f3->set('lName', $lName);
        $f3->set('age', $age);
        $f3->set('gender', $gender);
        $f3->set('phoneNum', $phoneNum);

        //if data is valid
        if (validForm()) {
            $_SESSION['fName'] = $fName;
            $_SESSION['lName'] = $lName;
            $_SESSION['age'] = $age;
            $_SESSION['gender'] = $gender;
            $_SESSION['phoneNum'] = $phoneNum;
            //redirect to form 2
            $f3->reroute('/order2');
        }
    }
    $view = new Template();
    echo $view->render('views/form1.html');
});

$f3->route('GET|POST /order2', function($f3){
    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            //Get data from the form
            $email = $_POST['email'];
            $state = $_POST['state'];
            $seekGender = $_POST['seekGender'];
            $biog = $_POST['biog'];

            //add date to hive
            $f3->set('email', $email);
            $f3->set('state', $state);
            $f3->set('seekGender', $seekGender);
            $f3->set('biog', $biog);

            //if data is valid
            if (validForm2()) {
                $_SESSION['email'] = $email;
                $_SESSION['state'] = $state;
                $_SESSION['seekGender'] = $seekGender;
                $_SESSION['biog'] = $biog;
                //redirect to summary
                $f3->reroute('/order3');
            }
        }
    }
    //Display order form
    $view = new Template();
    echo $view->render('views/form2.html');
});

//Get indor and outdoor interests
$f3->route('GET|POST /order3', function($f3){
    //If form has been submitted, validate
    if($_SERVER['REQUEST_METHOD'] == 'POST') {

        //Get data from form
        if(!empty($_POST['indoor'])) {
            $selectedIndoor = $_POST['indoor'];
        }
        $f3->set('SelectedIndoor', $selectedIndoor);

        $_SESSION['in'] = array();
        if (isset($selectedIndoor)) {
            foreach ($selectedIndoor as $value) {
                $_SESSION['inter'] .= $value . " ";
            }
        }
//    Get data from the form
        //Get data from form
        if(!empty($_POST['outdoor'])) {
            $selectedOutdoor = $_POST['outdoor'];
        }
        $f3->set('outdoor', $selectedOutdoor);

        $_SESSION['int'] = array();
        if (isset($selectedOutdoor)) {
            foreach ($selectedOutdoor as $val) {
                $_SESSION['out'] .= $val . " ";
            }
        }
        if (validForm3()) {
            $_SESSION['out'] = $selectedOutdoor;
            $_SESSION['inter'] = $selectedIndoor;
            //redirect to summary
            $f3->reroute('/summary');
        }
    }
    $view = new Template();
    echo $view->render('views/form3.html');
});
//get the results printed
$f3->route('GET|POST /summary', function(){
//    $_SESSION['in-door[]'] = $_POST['in-door[]'];

    $view = new Template();
    echo $view->render('views/results.html');
    //this will wipe everything
    session_destroy();
});

//Run F3
$f3->run();

////Get data from form
//$indoor = $_POST['in-door'];
//
//$_SESSION['in'] = array();
//if (isset($indoor)) {
//    foreach ($indoor as $value) {
//        $_SESSION['inter'] .= $value . " ";
//    }
//}
////    Get data from the form
//$outdoor = $_POST['out-door'];
//
//$_SESSION['int'] = array();
//if (isset($outdoor)) {
//    foreach ($outdoor as $val) {
//        $_SESSION['out'] .= $val . " ";
//    }
//}
//}