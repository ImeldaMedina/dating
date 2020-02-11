<?php
//turn on error reporting
ini_set('display_errors', 1);
error_reporting(E_ALL);

function validForm()
{
    global $f3;
    $isValid = true;

//checks to see that a string is all alphabetic REQUIRED
    if (!validName($f3->get('fName'))) {
        $isValid = false;
        $f3->set("errors['fName']", "Please enter a valid first name");
    }
    if (!validLast($f3->get('lName'))) {
        $isValid = false;
        $f3->set("errors['lName']", "Please enter a valid last name");
    }
//    checks to see that an age is numeric and between 18 and 118 REQUIRED
    if (!validAge($f3->get('age'))) {
        $isValid = false;
        $f3->set("errors['age']", "Please enter a valid age (between 18 - 118)");
    }
////    checks to see that a phone number is valid
//// (you can decide what constitutes a “valid” phone number) REQUIRED
    if (!validPhone($f3->get('phoneNum'))) {
        $isValid = false;
        $f3->set("errors['phoneNum']", "Please enter a valid phone number");
    }
    return $isValid;

}
function validForm2(){
    global $f3;
    $isValid = true;

//    checks to see that an email address is valid REQUIRED
    if(!validEmail($f3->get('email'))){
        $isValid = false;
        $f3->set("errors['email']", "Please enter a valid email");
    }
    return $isValid;
}
function validForm3(){
    global $f3;
    $isValid = true;

//checks each selected outdoor interest against a list of valid options OPTIONAL
    if(!validOutdoor($f3->get('outdoor'))){
        $isValid = false;
        $f3->set("errors['outdoor']", "Please select a valid out-door interest");
    }
//    checks each selected indoor interest against a list of valid options OPTIONAL

    if(!validIndoor($f3->get('indoor'))){
        $isValid = false;
        $f3->set("errors['indoor']", "Please select a valid in-door interest");
    }
    return $isValid;
}
//checks to see that a string is all alphabetic REQUIRED
function validName($fName){
    return !empty($fName) && ctype_alpha($fName);
}
////checks to see that a string is all alphabetic REQUIRED
function validLast($lName){
    return !empty($lName) && ctype_alpha($lName);
}
////    checks to see that an age is numeric and between 18 and 118 REQUIRED
function validAge($age){
    if(ctype_digit($age) && $age > 18 && $age < 118){
        return !empty($age);
    }
}
////    checks to see that a phone number is valid
//// (you can decide what constitutes a “valid” phone number)
function validPhone($phoneNum){
    if(strlen($phoneNum)==10 && ctype_digit($phoneNum)){
        return !empty($phoneNum);
    }
}
////    checks to see that an email address is valid
function validEmail($email){
    if(filter_var($email, FILTER_VALIDATE_EMAIL)){
        return !empty($email);
    }
}

//checks each selected outdoor interest against a list of valid option
function validOutdoor($outdoor){
    global $f3;
    return true;
//    global $f3;
//    return in_array($outdoor, $f3->get('outdoors'));
}

//checks each selected indoor interest against a list of valid option
function validIndoor($indoor){
   global $f3;
   return true;
//    return in_array($indoor, $f3->get('indoors'));

}
