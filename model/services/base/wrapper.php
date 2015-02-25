<?php

class Statement extends mysqli_stmt {

    public function fetch() {
        parent::fetch();
    }

}

class Result extends mysqli_result implements IteratorAggregate, ArrayAccess {

    public function getIterator() {
        
    }

    public function offsetExists($offset) {
        
    }

    public function offsetGet($offset) {
        
    }

    public function offsetSet($offset, $value) {
        
    }

    public function offsetUnset($offset) {
        
    }

}

?>
