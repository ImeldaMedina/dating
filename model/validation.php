<?php
//turn on error reporting
ini_set('display_errors', 1);
error_reporting(E_ALL);
class Validation
{
    private $_errors;

    public function __construct()
    {
        $this->_errors = array();
    }

    /**
     * @return array
     */
    public function getErrors()
    {
        return $this->_errors;
    }

    /**
     * @return bool
     */
    public function validForm()
    {
        $this->validName($_POST['fname']);
        $this->validLast($_POST['lName']);
        $this->validAge($_POST['age']);
        $this->validPhone($_POST['phoneNum']);
        $this->validEmail($_POST['email']);
        $this->validOutdoor($_POST['outdoor']);
        $this->validIndoor($_POST['indoor']);
        //If the $errors array is empty, then we have valid data
        return empty($this->_errors);
    }


    //checks to see that a string is all alphabetic REQUIRED
    function validName($fname)
    {
        //First name is required
        if (empty($fname) && ctype_alpha($fname)) {
            $this->_errors['fname'] = "First name is required";
        }
    }

    ////checks to see that a string is all alphabetic REQUIRED
    function validLast($lName)
    {
        //last name is required
        if (empty($lName) && ctype_alpha($lName)) {
            $this->_errors['lName'] = "Last name is required";
        }
    }

    ////    checks to see that an age is numeric and between 18 and 118 REQUIRED
    function validAge($age)
    {
        if (empty($age) && ctype_digit($age) && $age > 18 && $age < 118) {
            $this->_errors['age'] = "Age is required and must be between 18 and 118";
        }
    }
    ////    checks to see that a phone number is valid
    //// (you can decide what constitutes a “valid” phone number)
    function validPhone($phoneNum)
    {
        if (empty($phoneNum) && strlen($phoneNum) == 10 && ctype_digit($phoneNum)) {
            $this->_errors['phoneNum'] = "Please enter a valid phone number";
        }
    }

    ////    checks to see that an email address is valid
    function validEmail($email)
    {
        if (empty($email) && filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->_errors['email'] = "Please enter a valid email";
        }
    }

    //checks each selected outdoor interest against a list of valid option
    function validOutdoor($outdoor)
    {

        if (isset($outdoor)) {
            $this->_errors['outdoor'] = "Please select a valid out-door interest";
        }
    }

    //checks each selected indoor interest against a list of valid option
    function validIndoor($indoor)
    {
        global $f3;
        if (isset($indoor)) {
            $this->_errors['outdoor'] = "Please select a valid in-door interest";
        }


    }
}
//    function validForm()
//    {
//        global $f3;
//        $isValid = true;
//
//        //checks to see that a string is all alphabetic REQUIRED
//        if (!validName($f3->get('fname'))) {
//            $isValid = false;
//            $f3->set("errors['fname']", "Please enter a valid first name");
//        }
//        if (!validLast($f3->get('lName'))) {
//            $isValid = false;
//            $f3->set("errors['lName']", "Please enter a valid last name");
//        }
//        //    checks to see that an age is numeric and between 18 and 118 REQUIRED
//        if (!validAge($f3->get('age'))) {
//            $isValid = false;
//            $f3->set("errors['age']", "Please enter a valid age (between 18 - 118)");
//        }
//        ////    checks to see that a phone number is valid
//        //// (you can decide what constitutes a “valid” phone number) REQUIRED
//        if (!validPhone($f3->get('phoneNum'))) {
//            $isValid = false;
//            $f3->set("errors['phoneNum']", "Please enter a valid phone number");
//        }
//        return $isValid;
//
//    }
//
//    function validForm2()
//    {
//        global $f3;
//        $isValid = true;
//
//        //    checks to see that an email address is valid REQUIRED
//        if (!validEmail($f3->get('email'))) {
//            $isValid = false;
//            $f3->set("errors['email']", "Please enter a valid email");
//        }
//        return $isValid;
//    }
//
//    function validForm3()
//    {
//        global $f3;
//        $isValid = true;
//
//        //checks each selected outdoor interest against a list of valid options OPTIONAL
//        if (!validOutdoor($f3->get('outdoor'))) {
//            $isValid = false;
//            $f3->set("errors['outdoor']", "Please select a valid out-door interest");
//        }
//        //    checks each selected indoor interest against a list of valid options OPTIONAL
//
//        if (!validIndoor($f3->get('indoor'))) {
//            $isValid = false;
//            $f3->set("errors['indoor']", "Please select a valid in-door interest");
//        }
//        return $isValid;
//    }
