<?php

class CityDAO {

    public static function getCities() {
        $cities = array();
        $db = DBConnection::getInstance();
        $stmt = $db->prepare("SELECT * FROM city ORDER BY name ASC");
        $stmt->execute();
        $stmt->bind_result($id, $name);
        while ($stmt->fetch()) {
            $city = new City();
            $city->setId($id);
            $city->setName($name);
            $cities[] = $city;
        }
        $stmt->free_result();
        $stmt->close();
        return $cities;
    }

    public static function getCityById($id) {
        $city = NULL;
        $db = DBConnection::getInstance();
        $stmt = $db->prepare("SELECT name FROM city WHERE id = ?");
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $stmt->bind_result($name);
        if ($stmt->fetch()) {
            $city = new City();
            $city->setId($id);
            $city->setName($name);
        }
        $stmt->free_result();
        $stmt->close();
        return $city;
    }
    
    public static function getCityByName($name) {
        $city = NULL;
        $db = DBConnection::getInstance();
        $stmt = $db->prepare("SELECT id FROM city WHERE name = ?");
        $stmt->bind_param('s', $name);
        $stmt->execute();
        $stmt->bind_result($id);
        if ($stmt->fetch()) {
            $city = new City();
            $city->setId($id);
            $city->setName($name);
        }
        $stmt->free_result();
        $stmt->close();
        return $city;
    }

}

?>
