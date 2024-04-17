<?php
/*
  The UserData class represents user data retrieved from the database. It encapsulates properties
  such as userID, userName, password, realName, and userType. This class is used to manipulate
  and retrieve user information in the application.
*/

class UserData {
    // Properties to hold user data
    protected $userID, $userName, $password, $realName, $userType;

    // Constructor that initializes the object with data from a database row
    public function __construct($dbRow) {
        $this->userID = $dbRow['userid'] ?? null;
        $this->userName = $dbRow['username'] ?? null;
        $this->password = $dbRow['password'] ?? null;
        $this->realName = $dbRow['realname'] ?? null;
        $this->userType = $dbRow['usertype'] ?? null;
    }

    // Getter method for userID
    public function getUserID() {
        return $this->userID;
    }

    // Setter method for userID
    public function setUserID($userID) {
        $this->userID = $userID;
    }

    // Getter method for userName
    public function getUserName() {
        return $this->userName;
    }

    // Setter method for userName
    public function setUserName($userName) {
        $this->userName = $userName;
    }

    // Getter method for password
    public function getPassword() {
        return $this->password;
    }

    // Setter method for password
    public function setPassword($password) {
        $this->password = $password;
    }

    // Getter method for realName
    public function getRealName() {
        return $this->realName;
    }

    // Setter method for userID
    public function setRealName($realName) {
        $this->realName = $realName;
    }

    // Getter method for userType
    public function getUserType() {
        return $this->userType;
    }

    // Setter method for userType
    public function setUserType($userType) {
        $this->userType = $userType;
    }
}