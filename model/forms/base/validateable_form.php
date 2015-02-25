<?php

/**
 * 
 */
interface ValidateableForm {

    public function setErrors($errors);

    public function isValid();
}

?>
