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
    function insertMember()
    {

    }
    function getMembers()
    {

    }
//    member_id
    function getMember()
    {

    }
//    member_id
    function getInterests()
    {

    }
}