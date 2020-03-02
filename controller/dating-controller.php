<?php

class DatingController{
    private $_f3; //router
    private $_val; //validation


    public function __construct($f3)
    {
        $this->_f3 = $f3;
        $this->_val = new Validation();

    }
    public function admin()
    {
        $membersTotal = $GLOBALS['db']->getMembers();
        $this->_f3->set('member', $membersTotal);

        $view = new Template();
        echo $view->render('views/admin.php');
    }
    public function home()
    {
        $view = new Template();
        echo $view->render('views/home.html');
    }


    public function order($f3)
    {
        //If form has been submitted, validate
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            //if data is valid
            if ($this->_val->validForm()) {

                //Get the form values
                $fname = $_POST['fname'];
                $lName = $_POST['lName'];
                $age = $_POST['age'];
                $gender = $_POST['gender'];
                $phoneNum = $_POST['phoneNum'];

                //Instantiate a member object
                //check if the premium is selected
                $premium = isset($_POST['premium']);
                $_SESSION['premium'] = $premium;
                if(isset($_POST['premium'])){
                    $member = new PremiumMember($fname, $lName, $age, $gender, $phoneNum);
                }
                else{
                    $member = new Member($fname, $lName, $age, $gender, $phoneNum);
                }
//                $GLOBALS['db']->insertMember($member);
//                var_dump($member);

                //store the data in member object if its valid
                $_SESSION['member'] = $member;
                //redirect to form 2
                $f3->reroute('/order2');
            }
            else{
                //Data was not valid
                //Get errors from Validator and add to f3 hive
                $this->_f3->set('errors', $this->_val->getErrors());
                //var_dump($this->_f3->get('errors'));

                //Add POST array data to f3 hive for "sticky" form
                $this->_f3->set('member', $_POST);
            }
        }
        $view = new Template();
        echo $view->render('views/form1.html');
    }

    public function order2($f3)
    {
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                //Get data from the form
                    $email = $_POST['email'];
                    $state = $_POST['state'];
                    $seeking = $_POST['seekGender'];
                    $bio = $_POST['biog'];
                //if data is valid
                if ($this->_val->validForm()) {

                    $memberOthers = $_SESSION['member'];
                    $memberOthers->setEmail($email);
                    $memberOthers->setState($state);
                    $memberOthers->setSeeking($seeking);
                    $memberOthers->setBio($bio);
                    $_SESSION['member'] = $memberOthers;

//                    $_SESSION['member']->setEmail($email);
//                    $_SESSION['member']->setState($state);
//                    $_SESSION['member']->setSeeking($seeking);
//                    $_SESSION['member']->setBio($bio);

                    //redirect to order 3 or summary if premium is checked
                    if ($_SESSION['member'] instanceof PremiumMember) {
                        $f3->reroute('/order3');

                    } else {
                        $GLOBALS['db']->insertMember($_SESSION['member']);
                        $f3->reroute('/summary');
                    }

                } else{
                    //Data was not valid
                    //Get errors from Validator and add to f3 hive
                    $this->_f3->set('errors', $this->_val->getErrors());
                    //var_dump($this->_f3->get('errors'));

                    //Add POST array data to f3 hive for "sticky" form
                    $this->_f3->set('member', $_POST);
                }
            }

        //Display order form
        $view = new Template();
        echo $view->render('views/form2.html');
    }
    public function order3($f3)
    {
        //If form has been submitted, validate
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

                //Get data from form
                if (!empty($_POST['indoor'])) {
                    $selectedIndoor = $_POST['indoor'];
                }
                $f3->set('selectedIndoor', $selectedIndoor);

                $_SESSION['in'] = array();
                if (isset($selectedIndoor)) {
                    foreach ($selectedIndoor as $value) {
                        $_SESSION['inter'] .= $value . " ";
                    }
                }

                //Get data from form
                if (!empty($_POST['outdoor'])) {
                    $selectedOutdoor = $_POST['outdoor'];
                }
                $f3->set('selectedOutdoor', $selectedOutdoor);

                $_SESSION['int'] = array();
                if (isset($selectedOutdoor)) {
                    foreach ($selectedOutdoor as $val) {
                        $_SESSION['out'] .= $val . " ";
                    }
                }
                //if data is valid
                if ($this->_val->validForm()) {

                    $memberOther = $_SESSION['member'];
                    $memberOther->setOutDoorInterests($selectedOutdoor);
                    $memberOther->setnDoorInterests($selectedIndoor);
                    $_SESSION['member'] = $memberOther;

                    $GLOBALS['db']->insertMember($_SESSION['member'], $selectedOutdoor);
                    $GLOBALS['db']->insertMember($_SESSION['member'], $selectedIndoor);
                    //store the data in member object if its valid
                $_SESSION['out'] = $selectedOutdoor;
                $_SESSION['inter'] = $selectedIndoor;
                $_SESSION['member']->setOutDoorInterests($_SESSION['out']);
                $_SESSION['member']->setInDoorInterests($_SESSION['inter']);


//                redirect to summary
                $f3->reroute('/summary');
            } else {
                //Data was not valid
                //Get errors from Validator and add to f3 hive
                $this->_f3->set('errors', $this->_val->getErrors());
                //var_dump($this->_f3->get('errors'));

                //Add POST array data to f3 hive for "sticky" form
                $this->_f3->set('member', $_POST);
            }
        }
        $view = new Template();
        echo $view->render('views/form3.html');

    }
    public function summary()
    {
        $view = new Template();
        echo $view->render('views/results.html');
        //this will wipe everything
        session_destroy();
        $_SESSION = array();
    }
}