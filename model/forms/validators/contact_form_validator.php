<?php

class ContactFormValidator implements FormValidator {

    private $contactForm;
    private $errors = array();

    public function __construct(ValidateableForm $contactForm) {
        $this->contactForm = $contactForm;
    }

    public function validate() {
        // Checks if all form fields are filled
        $this->validateEmptyFields();
        if (count($this->errors) === 0) {
            // Checks if the Contact Name is not already in the Address Book
            $this->validateUniqueName();
            // Checks if the Zip Code is numeric
            $this->validateZipcode();
            // Checks the integrity of the received City Name
            $this->validateCity();
        }

        $this->contactForm->setErrors($this->errors);
    }

    private function validateEmptyFields() {
        if (strlen($this->contactForm->getContact()->getFirstName()) === 0) {
            $this->errors[] = 'First Name is required.';
        }
        if (strlen($this->contactForm->getContact()->getLastName()) === 0) {
            $this->errors[] = 'Last Name is required.';
        }
        if (strlen($this->contactForm->getContact()->getZipcode()) === 0) {
            $this->errors[] = 'Zip Code is required.';
        }
        if (strlen($this->contactForm->getContact()->getCity()->getName()) === 0) {
            $this->errors[] = 'Please select a City.';
        }
    }

    private function validateUniqueName() {
        switch ($this->contactForm->getOperation()) {
            case Form::ADD_OPERATION:
                // Search for a Contact entry with the same name
                $contact = ContactDAO::getContactByName($this->contactForm->getContact()->getFirstName(), $this->contactForm->getContact()->getLastName());
                if ($contact !== NULL) {
                    $this->errors[] = 'There is already a person with the same name in the Address Book.';
                }
                break;
            case Form::EDIT_OPERATION:
                // Search for a Contact entry with the same name
                $contact = ContactDAO::getContactByName($this->contactForm->getContact()->getFirstName(), $this->contactForm->getContact()->getLastName());
                if ($contact !== null) {
                    if ($contact->getId() !== $this->contactForm->getContact()->getId()) {
                        $this->errors[] = 'There is already a person with the same name in the Address Book.';
                    }
                }
                break;
        }
    }

    private function validateCity() {
        // Search for a City entry with the same name
        $city = CityDAO::getCityByName($this->contactForm->getContact()->getCity()->getName());
        if ($city === NULL) {
            $this->errors[] = '';
        }
    }

    private function validateZipcode() {
        if (!is_numeric(($this->contactForm->getContact()->getZipcode()))) {
            $this->errors[] = 'Zip Code must be a number.';
        }
    }

}

?>
