<?php

class Superglobals implements ArrayAccess {

    private $values = array();

    public function offsetExists($offset) {
        return $this->values[$offset] !== null;
    }

    public function offsetGet($offset) {
        if (array_key_exists($offset, $this->values)) {
            return $this->values[$offset];
        }
    }

    public function offsetSet($offset, $value) {
        $this->values[$offset] = $value;
    }

    public function offsetUnset($offset) {
        unset($this->values[$offset]);
    }

}

?>
