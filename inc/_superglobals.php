<?php

interface Container {

    public static function get($key);

    public static function set($key, $value);
    
}

abstract class Superglobal implements Container {

    private static $values = array();

    public static function get($key) {
        if (array_key_exists($key, self::$values)) {
            return self::$values[$key];
        }
    }

    public static function set($key, $value) {
        self::$values[$key] = $value;
    }

    public static function init(array $values) {
        self::$values = $values;
    }

}

class Get extends Superglobal {
    public static function set($key, $value) {
        parent::set($key, $value);
        $_GET[$key] = $value;
    }
}

class Post extends Superglobal {
    public static function set($key, $value) {
        parent::set($key, $value);
        $_POST[$key] = $value;
    }
}

class Request extends Superglobal {
    public static function set($key, $value) {
        parent::set($key, $value);
        $_GET[$key] = $_POST[$key] = $value;
    }
}

Get::init($_GET);
Post::init($_POST);

// Which parameter dominates (GET or POST)?
Request::init(array_merge($_GET, $_POST));
?>
