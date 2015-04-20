CREATE DATABASE IF NOT EXISTS address_book;
USE address_book;

DROP TABLE IF EXISTS contact;
DROP TABLE IF EXISTS city;
DROP TABLE IF EXISTS `group`;
DROP TABLE IF EXISTS group_contact;

CREATE TABLE city (
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    name varchar(50),
    UNIQUE KEY (name)
);
CREATE TABLE contact (
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    first_name VARCHAR(30) NOT NULL,
    last_name VARCHAR(30) NOT NULL,
    zipcode VARCHAR(6) NOT NULL,
    city_id INT NOT NULL,
    FOREIGN KEY (city_id) REFERENCES city(id) ON DELETE CASCADE,
    UNIQUE KEY (first_name, last_name)
);
-- Using Path Enumeration Model for the group hierarchy
CREATE TABLE `group` (
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(30) NOT NULL,
    path VARCHAR(1000) NOT NULL,			-- This field is used to store the path from the root
    UNIQUE KEY (name)
);
CREATE TABLE group_contact (
    group_id INT NOT NULL REFERENCES `group`(id),
    contact_id INT NOT NULL REFERENCES contact(id),
    UNIQUE KEY (group_id, contact_id)
);
/*
CREATE TABLE group_group (
    parent INT NOT NULL REFERENCES `group`(id),
    child INT NOT NULL REFERENCES `group`(id),
    UNIQUE KEY (parent, child)
);*/
