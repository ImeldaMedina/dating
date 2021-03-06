<?php

/**
 * @author Imelda Medina
 * @Version 5.0
 * Class Member will get ans set name, last, age, gender, and phone of the user
 */
class Member
{
    private $_fname;
    private $_lname;
    private $_gender;
    private $_age;
    private $_phone;
    private $_email;
    private $_state;
    private $_seeking;
    private $_bio;
    private $_premium;


    /**
     * Memeber constructor.
     * @param $fname represents the first name of the user.
     * @param $lname represents the last name of the user.
     * @param $gender represents the gender of hte user.
     * @param $age represents the age of the user.
     * @param $phone represents the phone number of the user.
     */
    public function __construct($fname, $lname, $gender, $age, $phone)
    {
        $this->_fname = $fname;
        $this->_lname = $lname;
        $this->_gender = $gender;
        $this->_age = $age;
        $this->_phone = $phone;

    }
    /**
     * gets the first name of the user.
     * @return represents first name of the user.
     */
    public function getFname()
    {
        return $this->_fname;
    }

    /**
     * @param mixed $fname represents the first name of the user
     */
    public function setFname($fname)
    {
        $this->_fname = $fname;
    }

    /**
     * @return mixed returns the last name of the user
     */
    public function getLname()
    {
        return $this->_lname;
    }

    /**
     * @param mixed $lname represents the last name of the user
     */
    public function setLname($lname)
    {
        $this->_lname = $lname;
    }

    /**
     * @return the gender of the user
     */
    public function getGender()
    {
        return $this->_gender;
    }

    /**
     * @param $gender represents the gender of the user
     */
    public function setGender($gender)
    {
        $this->_gender = $gender;
    }
    /**
     * @return mixed the age of the user
     */
    public function getAge()
    {
        return $this->_age;
    }

    /**
     * @param mixed $age represents the age of the user
     */
    public function setAge($age)
    {
        $this->_age = $age;
    }

    /**
     * @return the phone number passed by the user
     */
    public function getPhone()
    {
        return $this->_phone;
    }

    /**
     * @param $phone represents the phone number of the user
     */
    public function setPhone($phone)
    {
        $this->_phone = $phone;
    }

    /**
     * @return the email of the user
     */
    public function getEmail()
    {
        return $this->_email;
    }

    /**
     * @param  $email represents the email of the user
     */
    public function setEmail($email)
    {
        $this->_email = $email;
    }

    /**
     * @return the state of the user
     */
    public function getState()
    {
        return $this->_state;
    }

    /**
     * @param $state represents the state provided by the user
     */
    public function setState($state)
    {
        $this->_state = $state;
    }

    /**
     * @return the gender that the user is seeking for
     */
    public function getSeeking()
    {
        return $this->_seeking;
    }

    /**
     * @param  $seeking represets the gender that the user is looking for
     */
    public function setSeeking($seeking)
    {
        $this->_seeking = $seeking;
    }

    /**
     * @return the biography of the user
     */
    public function getBio()
    {
        return $this->_bio;
    }

    /**
     * @param  $bio represents the biography of the user
     */
    public function setBio($bio)
    {
        $this->_bio = $bio;
    }

    /**
     * @return gets if the member is premium or not
     */
    public function getPremium()
    {
        return $this->_premium;
    }

    /**
     * @param sets member to premium or not
     */
    public function setPremium($premium)
    {
        $this->_premium = $premium;
    }
}