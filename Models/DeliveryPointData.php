<?php

class DeliveryPointData implements JsonSerializable
{
    // Properties to hold delivery point data
    protected $deliveryID, $name, $address1, $address2, $postcode, $deliverer, $lat, $long, $status, $del_photo;

    // Constructor that initializes the object with data from a database row
    public function __construct($dbRow)
    {
        $this->deliveryID = $dbRow['id'];
        $this->name = $dbRow['name'];
        $this->address1 = $dbRow['address_1'];
        $this->address2 = $dbRow['address_2'];
        $this->postcode = $dbRow['postcode'];
        $this->deliverer = $dbRow['realname'];
        $this->lat = $dbRow['lat'];
        $this->long = $dbRow['long'];
        $this->status = $dbRow['status_text'];
        $this->del_photo = $dbRow['del_photo'];
    }

    public function jsonSerialize(): mixed
    {
        return [
            'deliveryID' => $this->deliveryID,
            'name' => $this->name,
            'address1' => $this->address1,
            'address2' => $this->address2,
            'postcode' => $this->postcode,
            'deliverer' => $this->deliverer,
            'lat' => $this->lat,
            'long' => $this->long,
            'status' => $this->status,
            'del_photo' => $this->del_photo
        ];
    }

    // Getter method for deliveryID
    public function getDeliveryID()
    {
        return $this->deliveryID;
    }

    // Setter method for deliveryID
    public function setDeliveryID(mixed $deliveryID)
    {
        $this->deliveryID = $deliveryID;
    }

    // Getter method for name
    public function getName()
    {
        return $this->name;
    }

    // Setter method for name
    public function setName(mixed $name)
    {
        $this->name = $name;
    }

    // Getter method for address1
    public function getAddress1()
    {
        return $this->address1;
    }

    // Setter method for address1
    public function setAddress1(mixed $address1)
    {
        $this->address1 = $address1;
    }

    // Getter method for address2
    public function getAddress2()
    {
        return $this->address2;
    }

    // Setter method for address2
    public function setAddress2(mixed $address2)
    {
        $this->address2 = $address2;
    }

    // Getter method for postcode
    public function getPostcode()
    {
        return $this->postcode;
    }

    // Setter method for postcode
    public function setPostcode(mixed $postcode)
    {
        $this->postcode = $postcode;
    }

    // Getter method for deliverer
    public function getDeliverer()
    {
        return $this->deliverer;
    }

    // Setter method for deliverer
    public function setDeliverer(mixed $deliverer)
    {
        $this->deliverer = $deliverer;
    }

    // Getter method for lat
    public function getLat()
    {
        return $this->lat;
    }

    // Setter method for lat
    public function setLat(mixed $lat)
    {
        $this->lat = $lat;
    }

    // Getter method for long
    public function getLong()
    {
        return $this->long;
    }

    // Setter method for long
    public function setLong(mixed $long)
    {
        $this->long = $long;
    }

    // Getter method for status
    public function getStatus()
    {
        return $this->status;
    }

    // Setter method for status
    public function setStatus(mixed $status)
    {
        $this->status = $status;
    }

    // Getter method for del_photo
    public function getDelPhoto()
    {
        return $this->del_photo;
    }

    // Setter method for del_photo
    public function setDelPhoto(mixed $del_photo)
    {
        $this->del_photo = $del_photo;
    }
}