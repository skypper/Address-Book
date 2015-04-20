<?php

class ContactController {

    public static function listAction() {
        $contacts = ContactDAO::getContacts();
        $export_xml = null;
        if (Get::get('export') === 'xml') {
            $export_xml = ContactService::exportToXML($contacts);
        }
        
        render('Contact List', 'contact_list', array(
            'contacts' => $contacts,
            'export_xml' => $export_xml
                )
        );
    }

    public static function manageAction() {
        // ### Form Initialization
        $contactForm = new ContactForm();
        $contactForm->setSubmitted(Post::get('contact_form') !== null);
        var_dump(empty(Request::get('id')));
        var_dump(Post::get('contact_form'));
        if (Request::get('id') !== null) {
            $contact = ContactDAO::getContactById(Request::get('id'));
            $operation = Form::EDIT_OPERATION;
        } else {
            $contact = new Contact();
            $operation = Form::ADD_OPERATION;
        }
        $contactForm->setContact($contact);
        $contactForm->setOperation($operation);
        
        if ($contactForm->getSubmitted() === true) {
            // ### Request Binding
            $contactForm->getContact()->setFirstName(Post::get('first_name'));
            $contactForm->getContact()->setLastName(Post::get('last_name'));
            $contactForm->getContact()->setZipcode(Post::get('zipcode'));
            $contactForm->getContact()->setCity(CityDAO::getCityByName(Post::get('city_name')));

            // ### Form Validation
            $contactValidator = new ContactFormValidator($contactForm);
            $contactValidator->validate();

            if ($contactForm->isValid()) {
                $contactForm->setDisplayed(false);
                switch ($contactForm->getOperation()) {
                    case Form::ADD_OPERATION:
                        ContactDAO::addContact($contactForm->getContact());
                        break;
                    case Form::EDIT_OPERATION:
                        ContactDAO::editContact($contactForm->getContact());
                        break;
                }
            }
        }
        if ($contactForm->getDisplayed() === true) {
            $contactForm->setCities(CityDAO::getCities());
        }

        render('Contact Management', 'contact_mgmt', array('contactForm' => $contactForm));
    }

}

?>
