<?php
class DatingController{
    private $_f3; //router
    private $_val; //validation


    public function __construct($f3)
    {
        $this->_f3 = $f3;
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
//            //Get data from the form
            $fname = $_POST['fname'];
            $lName = $_POST['lName'];
            $age = $_POST['age'];
            $gender = $_POST['gender'];
            $phoneNum = $_POST['phoneNum'];
            $premium = $_POST['premium'];

            //Add data to hive
            $f3->set('fname', $fname);
            $f3->set('lName', $lName);
            $f3->set('age', $age);
            $f3->set('gender', $gender);
            $f3->set('phoneNum', $phoneNum);
            $f3->set('premium',$premium);

            //check if the premium is selected
            $premium = isset($_POST['premium']);
            $_SESSION['premium'] = $premium;
            if(isset($_POST['premium'])){
                $member = new PremiumMember($fname, $lName, $age, $gender, $phoneNum);
            }
            else{
                $member = new Member($fname, $lName, $age, $gender, $phoneNum);
            }
            //if data is valid
            if (validForm()) {
            //store the data in member object if its valid
                $_SESSION['member'] = $member;
                //redirect to form 2
                $f3->reroute('/order2');
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

                //add date to hive
                $f3->set('email', $email);
                $f3->set('state', $state);
                $f3->set('seekGender', $seeking);
                $f3->set('biog', $bio);

                //if data is valid
                if (validForm2()) {
//                    $_SESSION['member'] = $member;
                    $_SESSION['member']->setEmail($email);;
                    $_SESSION['member']->setState($state);
                    $_SESSION['member']->setSeeking($seeking);
                    $_SESSION['member']->setBio($bio);


                    //redirect to order 3 or summary if premium is checked
                   if(isset($_SESSION['premium'])){
                       $f3->reroute('/order3');
                   }
                   else{
                        $f3->reroute('/summary');
                   }
                }
            }
        //Display order form
        $view = new Template();
        echo $view->render('views/form2.html');
    }
    public function order3($f3)
    {
        //If form has been submitted, validate
        if($_SERVER['REQUEST_METHOD'] == 'POST') {

            //Get data from form
            if(!empty($_POST['indoor'])) {
                $selectedIndoor = $_POST['indoor'];
            }
            $f3->set('selectedIndoor', $selectedIndoor);

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
            $f3->set('selectedOutdoor', $selectedOutdoor);

            $_SESSION['int'] = array();
            if (isset($selectedOutdoor)) {
                foreach ($selectedOutdoor as $val) {
                    $_SESSION['out'] .= $val . " ";
                }
            }
            if (validForm3()) {
                //store the data in member object if its valid
                $_SESSION['out']=$selectedOutdoor;
                $_SESSION['inter']=$selectedIndoor;
                $_SESSION['member']->setOutDoorInterests($_SESSION['out']);
                $_SESSION['member']->setInDoorInterests($_SESSION['inter']);

                //redirect to summary
                $f3->reroute('/summary');
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