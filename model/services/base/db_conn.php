<?php

class DBConnection {

    public static function getInstance() {
        static $conn = NULL;
        if ($conn === NULL) {
            require 'config/db.php';
            $conn = new mysqli($db['server'], $db['user'], $db['password'], $db['schema']);
        }
        return $conn;
    }

}

?>