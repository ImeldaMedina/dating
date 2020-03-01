<?php

/**
 * CREATE TABLE IF NOT EXISTS member (
member_id int NOT NULL AUTO_INCREMENT,
fname varchar(150),
lname varchar(150),
age int, gender varchar(10),
phone varchar(15),
email varchar(30),
state varchar(30),
seeking varchar(30),
bio varchar(255),
premium tinyint ,
PRIMARY KEY (member_id)
);
 */
/**
 * CREATE TABLE IF NOT EXISTS interest (
interest_id int NOT NULL AUTO_INCREMENT,
interest varchar(150),
type varchar(150),
PRIMARY KEY (interest_id)
);
 */
/**
 * CREATE TABLE memberInterest(
memberInterestId serial,
member_id int NOT NULL,
interest_id int NOT NULL,
PRIMARY KEY(memberInterestId),
FOREIGN KEY(member_id) REFERENCES member(member_id),
FOREIGN KEY(interest_id) REFERENCES interest(interest_id)
);

 */

/**
 * Class Database
 */
class Database
{
    //PDO object
    private $_dbh;

    function __construct()
    {
        try
        {
            //Instantiate a database object
            $this->_dbh = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
//                echo 'Connected to database!';
        } catch(PDOException $e) {
            echo $e ->getMessage();
        }
    }
    function connect()
    {

    }
    function insertMember($member)
    {
        //1. Define the query
        $sql = "INSERT INTO member ( default, fname, lname, age, gender, phone, email, state, seeking,
                bio, premium)
                VALUES (:member_id, :fname, :lName, :age,:gender ,:phoneNum ,:email ,:state ,:seekGender ,
                        :biog, :premium)";

        //2. Prepare the statement
        $statement = $this->_dbh->prepare($sql);

        //3. Bind the parameters
        $statement->bindParam(':member_id', $member->getMemberId());
        $statement->bindParam(':fname', $member->getFname());
        $statement->bindParam(':lName', $member->getLname());
        $statement->bindParam(':age', $member->getAge());
        $statement->bindParam(':gender', $member->getGender());
        $statement->bindParam(':phoneNum', $member->getPhone());
        $statement->bindParam(':email', $member->getEmail());
        $statement->bindParam(':state', $member->getState());
        $statement->bindParam(':seekGender', $member->getSeeking());
        $statement->bindParam(':biog', $member->getBio());
        $statement->bindParam(':premium', $member->getPremium());
        $statement->bindParam(':indoor', $member->getInDoorInterests());
        $statement->bindParam(':outdoor', $member->getOutDoorInterests());
        //4. Execute the statement
        $statement->execute();

        //Get the key of the last inserted row
        $id = $this->_dbh->lastInsertId();
    }

    function getMembers()
    {
        //1. Define the query
        $sql = "SELECT * 
                    FROM member, interest
                    WHERE member.interest = interest.interest_id
                    AND member_id= :member_id";

        //2. Prepare the statement
        $statement = $this->_dbh->prepare($sql);

        //3.Bind the parameters
        $statement->bindParam(':member_id', $member);
        //4. Execute the statement
        $statement->execute();

        //5. Get the result
        $result = $statement-> fetch(PDO::FETCH_ASSOC);
        return $result;
    }
//    member_id
    function getMember($member_id)
    {

    }
//    member_id
    function getInterests($member_id)
    {
    }
}