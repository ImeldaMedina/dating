<?php

/**
 * @author Imelda Medina
 * @version 5.0
 * Class PremiumMember gets and sets the indoor and outdoor interests.
 */
class PremiumMember extends Member
{
    /**
     * @var $_inDoorInterests
     */
    private $_inDoorInterests;
    /**
     * @var $_outDoorInterests
     */
    private $_outDoorInterests;


    /**
     * PremiumMember constructor.
     * @param $_inDoorInterests
     * @param $_outDoorInterests
     */
    //    public function __construct()
    public function __construct($fname, $lname,$gender, $age,  $phone)
    {
        parent::__construct($fname, $lname,$gender, $age,  $phone);
//        $this->_inDoorInterests = $_inDoorInterests;
//        $this->_outDoorInterests = $_outDoorInterests;
    }

    /**
     * @return indoor interest
     */

    public function getInDoorInterests()
    {
        return $this->_inDoorInterests;
    }

    /**
     * @param $inDoorInterests represents the indoor interests
     */
    public function setInDoorInterests($inDoorInterests)
    {
        $this->_inDoorInterests = $inDoorInterests;
    }

    /**
     * @return outdoor interest
     */
    public function getOutDoorInterests()
    {
        return $this->_outDoorInterests;
    }

    /**
     * @param mixed $outDoorInterests represents the outdoor interests
     */
    public function setOutDoorInterests($outDoorInterests)
    {
        $this->_outDoorInterests = $outDoorInterests;
    }
}