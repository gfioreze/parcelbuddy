<?php
/*This class manages interaction with the database for user-related operations.
It provides methods for adding new users, retrieving user data, and fetching all deliverers*/


require_once('Models/Database.php');
require('Models/UserData.php');

class UserDataSet {
    protected PDO $_dbInstance; // Instance of the Database class
    protected PDO $_dbHandle; // PDO handle for database connection

    // Constructor to initialize the database instance and handle
    public function __construct() {
        $this->_dbInstance = Database::getInstance(); // Get the singleton instance of the database
        $this->_dbHandle = $this->_dbInstance->getdbConnection(); // Get the PDO handle from the database instance
    }

    // Adds a new user to the database
    public function addUser($fullName, $username, $hash, $email) {
        $sqlQuery = 'INSERT INTO delivery_users(realname, username, password, email, usertype) VALUES (?, ?, ?, ?, 2)';
        $statement = $this->_dbHandle->prepare($sqlQuery);
        $statement->bindParam(1, $fullName);
        $statement->bindParam(2, $username);
        $statement->bindParam(3, $hash);
        $statement->bindParam(4, $email);
        $statement->execute();
        return $statement->rowCount(); // Return the number of affected rows
    }

    // Retrieves the username based on the user ID
    public function getUserName($userID) {
        $sqlQuery = 'SELECT realname FROM delivery_users'; // SQL query to retrieve the realname from delivery_users (Incomplete query)
        $statement = $this->_dbHandle->prepare($sqlQuery);
        $statement->execute();
        $statement->bindParam(1, $userID); // Bind the userID parameter
        $statement->execute();
        return $statement->fetch(PDO::FETCH_ASSOC); // Fetch a single row as an associative array
    }

    // Retrieves user data based on the username and password
    public function getLoginData($username, $password) {
        $sqlQuery = 'SELECT * FROM delivery_users WHERE username = ? AND password = ?'; // SQL query to retrieve user data
        $statement = $this->_dbHandle->prepare($sqlQuery);
        $statement->bindParam(1, $username); // Bind the username parameter
        $statement->bindParam(2, $password); // Bind the password parameter
        $statement->execute();
        if ($statement->rowCount() > 0) {
            $row = $statement->fetch();
            return new UserData($row); // Return a new UserData object with the fetched data
        }
        return null; // Return null if no matching user data is found
    }

    public function getAllDeliverers() {
        $sqlQuery = 'SELECT userid, realname FROM delivery_users WHERE usertype = 2 ORDER BY realname ASC';
        $statement = $this->_dbHandle->prepare($sqlQuery);
        $statement->execute();
        $users = [];
        while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
            $users[] = new UserData($row);
        }
        return $users;
    }
}