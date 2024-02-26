<?php
require_once('Models/Database.php');
require_once('Models/DeliveryPointData.php');

class DeliveryPointDataSet
{
    protected PDO $_dbInstance; // Instance of the Database class
    protected PDO $_dbHandle; // PDO handle for database connection

    // Constructor to initialize the database instance and handle
    public function __construct()
    {
        $this->_dbInstance = Database::getInstance(); // Get the singleton instance of the database
        $this->_dbHandle = $this->_dbInstance->getdbConnection(); // Get the PDO handle from the database instance
    }

    // Fetches detailed information about delivery points, including join operations, and returns an array of DeliveryPointData objects
    public function getDeliveryPointInfo()
    {
        $sqlQuery = 'SELECT delivery_point.id, delivery_point.name, delivery_point.address_1, delivery_point.address_2, delivery_point.postcode, delivery_users.realname, delivery_point.lat, delivery_point.long, delivery_status.status_text, delivery_point.del_photo
                    FROM delivery_point
                    LEFT JOIN delivery_users ON delivery_point.deliverer = delivery_users.userid
                    LEFT JOIN delivery_status ON delivery_point.status = delivery_status.id'; // SQL query with join operations
        $statement = $this->_dbHandle->prepare($sqlQuery); // Prepare a PDO statement
        $statement->execute(); // Execute the PDO statement
        $deliveryPointInfo = [];
        while ($row = $statement->fetch()) {
            $deliveryPointInfo[] = new DeliveryPointData($row); // Create DeliveryPointData objects and add them to the array
        }
        return $deliveryPointInfo;
    }

    // Fetches a delivery point corresponding to a client's name searched
    public function getDeliveryPointByName($searchTerm)
    {
        $sqlQuery = 'SELECT delivery_point.id, delivery_point.name, delivery_point.address_1, delivery_point.address_2, delivery_point.postcode, delivery_users.realname, delivery_point.lat, delivery_point.long, delivery_status.status_text, delivery_point.del_photo
        FROM delivery_point
         LEFT JOIN delivery_users ON delivery_point.deliverer = delivery_users.userid
         LEFT JOIN delivery_status ON delivery_point.status = delivery_status.id
        WHERE delivery_point.id = ? OR delivery_point.name = ? OR delivery_point.address_1 = ? OR delivery_users.realname = ? OR delivery_status.status_text = ?';
        $statement = $this->_dbHandle->prepare($sqlQuery); // Prepare a PDO statement
        $statement->bindParam(1, $searchTerm);
        $statement->bindParam(2, $searchTerm);
        $statement->bindParam(3, $searchTerm);
        $statement->bindParam(4, $searchTerm);
        $statement->bindParam(5, $searchTerm);
        $statement->execute(); // Execute the PDO statement
        $deliveryPointInfo = [];
        while ($row = $statement->fetch()) {
            $deliveryPointInfo[] = new DeliveryPointData($row); // Create DeliveryPointData objects and add them to the array
        }
        return $deliveryPointInfo;
    }

    // Fetches the columns id and the status from the table delivery_status
    public function getDeliveryStatus()
    {
        $sqlQuery = 'SELECT id ,status_text FROM delivery_status'; // SQL query to retrieve a single delivery point
        $statement = $this->_dbHandle->prepare($sqlQuery); // Prepare a PDO statement
        $statement->execute(); // Execute the PDO statement
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    // Fetches information about a single delivery point based on its ID
    public function getSingleDeliveryPoint($deliveryID)
    {
        $sqlQuery = 'SELECT * FROM delivery_point WHERE id = ?'; // SQL query to retrieve a single delivery point
        $statement = $this->_dbHandle->prepare($sqlQuery); // Prepare a PDO statement
        $statement->bindParam(1, $deliveryID); // Bind the deliveryID parameter
        $statement->execute(); // Execute the PDO statement
        return $statement->fetch(PDO::FETCH_ASSOC); // Fetch a single row as an associative array
    }

    // Adds a new delivery point to the database
    public function addNewDeliveryPoint($recipient, $address1, $address2, $postcode, $lat, $long, $deliverer, $status)
    {
        $sqlQuery = 'INSERT into delivery_point(name, address_1, address_2, postcode, lat, `long`, deliverer, status) VALUES (?, ?, ?, ?, ?, ?, ?, ?)';
        $statement = $this->_dbHandle->prepare($sqlQuery);
        $statement->bindParam(1, $recipient);
        $statement->bindParam(2, $address1);
        $statement->bindParam(3, $address2);
        $statement->bindParam(4, $postcode);
        $statement->bindParam(5, $lat);
        $statement->bindParam(6, $long);
        $statement->bindParam(7, $deliverer);
        $statement->bindParam(8, $status, PDO::PARAM_INT);
        $statement->execute();
        // Return the number of affected rows
        return $statement->rowCount();
    }

    // Updates an existing delivery point in the database
    public function updateDeliveryPoint($recipient, $address1, $address2, $postcode, $deliverer, $lat, $long, $status, $id)
    {
        try {
            $sqlQuery = 'UPDATE delivery_point 
                        SET name = ?, address_1 = ?, address_2 = ?, postcode = ?, deliverer = ?, lat = ?, `long` = ?, status = ?
                      WHERE id = ?'; // SQL query to update a delivery point
            $statement = $this->_dbHandle->prepare($sqlQuery);
            $statement->bindParam(1, $recipient);
            $statement->bindParam(2, $address1);
            $statement->bindParam(3, $address2);
            $statement->bindParam(4, $postcode);
            $statement->bindParam(5, $deliverer);
            $statement->bindParam(6, $lat);
            $statement->bindParam(7, $long);
            $statement->bindParam(8, $status);
            $statement->bindParam(9, $id);
            $statement->execute();
            return $statement->rowCount(); // Return the number of affected rows
        } catch (PDOException $e) {
            echo 'Error updating delivery point ' . $e->getMessage();
            return 0; // Return 0 if an error occurs
        }
    }

    // Deletes a delivery point from the database based on its ID
    public function deleteDeliveryPoint($deliveryID)
    {
        $sqlQuery = 'DELETE from delivery_point WHERE id = ?'; // SQL query to delete a delivery point
        $statement = $this->_dbHandle->prepare($sqlQuery);
        $statement->bindParam(1, $deliveryID);
        $statement->execute();
        return $statement->rowCount(); // Return the number of affected rows
    }
}