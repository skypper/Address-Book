<?php

class ContactService {

    public static function exportToXML($contacts) {
        $xml = new XMLWriter();
        $xml->openMemory();
        $xml->startDocument('1.0', 'UTF-8');
        $xml->startElement('address_book');
        for ($i = 0; $i < count($contacts); $i++) {
            $contact = $contacts[$i];
            $xml->startElement('contact');
            $xml->writeAttribute('first_name', $contact->getFirstName());
            $xml->writeAttribute('last_name', $contact->getLastName());
            $xml->writeAttribute('zipcode', $contact->getZipcode());
            $xml->writeAttribute('city', $contact->getCity()->getName());
            $xml->endElement(); // contact
        }

        $xml->endElement(); // address_book
        $xml->endDocument();
        return $xml->outputMemory();
    }

}

?>
