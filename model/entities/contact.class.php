<?php

/**
 * A contact entry in the Address Book
 * 
 * @author Tudor Anastasiu <tg.anastasiu@gmail.com>
 */
class Contact {

    private $id;
    private $firstName;
    private $lastName;
    private $zipcode;
    private $city;

    public function __construct() {
        $this->city = new City();
    }

    public function init($first_name, $last_name, $zipcode, $city) {
        $this->firstName = $first_name;
        $this->lastName = $last_name;
        $this->zipcode = $zipcode;
        $this->city = $city;
    }

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getFirstName() {
        return $this->firstName;
    }

    public function setFirstName($firstName) {
        $this->firstName = $firstName;
    }

    public function getLastName() {
        return $this->lastName;
    }

    public function setLastName($lastName) {
        $this->lastName = $lastName;
    }

    public function getZipcode() {
        return $this->zipcode;
    }

    public function setZipcode($zipcode) {
        $this->zipcode = $zipcode;
    }

    public function getCity() {
        return $this->city;
    }

    public function setCity($city) {
        $this->city = $city;
    }

}

?>
