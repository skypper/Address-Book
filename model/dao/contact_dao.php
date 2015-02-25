<?php

class ContactDAO {

    public static function getContacts() {
        $contacts = array();
        $db = DBConnection::getInstance();
        $stmt = $db->prepare("SELECT id, first_name, last_name, zipcode, city_id
            FROM contact ORDER BY id ASC");
        $stmt->execute();
        $stmt->bind_result($id, $first_name, $last_name, $zipcode, $city_id);
        while ($stmt->fetch()) {
            $contact = new Contact();
            $contact->setId($id);
            $contact->setFirstName($first_name);
            $contact->setLastName($last_name);
            $contact->setZipcode($zipcode);
            $city = new City();
            $city->setId($city_id);
            $contact->setCity($city);
            $contacts[] = $contact;
        }
        $stmt->free_result();
        $stmt->close();
        
        foreach ($contacts as $contact) {
            ContactDAO::getDependencies($contact);
        }
        
        return $contacts;
    }

    public static function getContactById($id) {
        $contact = NULL;
        $db = DBConnection::getInstance();
        $stmt = $db->prepare("SELECT first_name, last_name, zipcode, city_id
            FROM contact WHERE id = ?");
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $stmt->bind_result($first_name, $last_name, $zipcode, $city_id);
        if ($stmt->fetch()) {
            $contact = new Contact();
            $contact->setId($id);
            $contact->setFirstName($first_name);
            $contact->setLastName($last_name);
            $contact->setZipcode($zipcode);
            $city = new City();
            $city->setId($city_id);
            $contact->setCity($city);
        }
        $stmt->free_result();
        $stmt->close();
        
        if ($contact != NULL) {
            ContactDAO::getDependencies($contact);
        }
        
        return $contact;
    }

    public static function getContactByName($first_name, $last_name) {
        $contact = NULL;
        $db = DBConnection::getInstance();
        $stmt = $db->prepare("SELECT id, zipcode, city_id 
            FROM contact WHERE first_name = ? AND last_name = ?");
        $stmt->bind_param('s', $first_name);
        $stmt->bind_param('s', $last_name);
        $stmt->bind_result($id, $zipcode, $city_id);
        if ($stmt->fetch()) {
            $contact = new Contact();
            $contact->setId($id);
            $contact->setFirstName($first_name);
            $contact->setLastName($last_name);
            $contact->setZipcode($zipcode);
            $city = new City();
            $city->setId($city_id);
            $contact->setCity($city);
        }
        $stmt->free_result();
        $stmt->close();
        
        if ($contact != null) {
            ContactDAO::getDependencies($contact);
        }
        
        return $contact;
    }

    public static function addContact(Contact $contact) {
        $db = DBConnection::getInstance();
        $stmt = $db->prepare("INSERT INTO contact (first_name, last_name, zipcode, city) VALUE (?, ?, ?, ?)");
        $stmt->bind_param('s', $contact->getFirstName());
        $stmt->bind_param('s', $contact->getLastName());
        $stmt->bind_param('i', $contact->getZipcode());
        $stmt->bind_param('i', $contact->getCity()->getId());
        $stmt->execute();
        $stmt->close();
    }

    public static function editContact(Contact $contact) {
        $db = DBConnection::getInstance();
        $stmt = $db->prepare("UPDATE contact SET first_name = ?, last_name = ?, zipcode = ?, city = ? WHERE id = ?");
        $stmt->bind_param('s', $contact->getFirstName());
        $stmt->bind_param('s', $contact->getLastName());
        $stmt->bind_param('i', $contact->getZipcode());
        $stmt->bind_param('i', $contact->getCity()->getId());
        $stmt->bind_param('i', $contact->getId());
        $stmt->execute();
        $stmt->close();
    }

    public static function getDependencies(Contact $contact) {
        $contact->setCity(CityDAO::getCityById($contact->getCity()->getId()));
    }
    
}

?>
