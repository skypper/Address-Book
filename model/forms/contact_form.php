<?php

class ContactForm implements Form, ValidateableForm {

    private $contact;
    private $cities;
    private $submitted = false;
    private $operation;
    private $errors = array();
    private $displayed = true;
    
    public function getContact() {
        return $this->contact;
    }

    public function setContact($contact) {
        $this->contact = $contact;
    }

    public function getCities() {
        return $this->cities;
    }

    public function setCities($cities) {
        $this->cities = $cities;
    }

    public function getSubmitted() {
        return $this->submitted;
    }

    public function setSubmitted($submitted) {
        $this->submitted = $submitted;
    }

    public function getOperation() {
        return $this->operation;
    }

    public function setOperation($operation) {
        $this->operation = $operation;
    }

    public function getDisplayed() {
        return $this->displayed;
    }

    public function setDisplayed($displayed) {
        $this->displayed = $displayed;
    }

    public function getErrors() {
        return $this->errors;
    }

    public function setErrors($errors) {
        $this->errors = $errors;
    }
    
    public function isValid() {
        return count($this->errors) === 0;
    }

}

?>
