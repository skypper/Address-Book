CREATE DATABASE IF NOT EXISTS address_book;
USE address_book;

CREATE TABLE IF NOT EXISTS city (
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    name varchar(50),
    UNIQUE KEY (name)
);
CREATE TABLE IF NOT EXISTS contact (
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    first_name VARCHAR(30) NOT NULL,
    last_name VARCHAR(30) NOT NULL,
    zipcode VARCHAR(6) NOT NULL,
    city_id INT NOT NULL,
    FOREIGN KEY (city_id) REFERENCES city(id) ON DELETE CASCADE,
    UNIQUE KEY (first_name, last_name)
);
CREATE TABLE IF NOT EXISTS `group` (
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(30) NOT NULL,
    UNIQUE KEY (name)
);
CREATE TABLE IF NOT EXISTS contact_group (
    contact INT NOT NULL REFERENCES contact(id),
    `group` INT NOT NULL REFERENCES `group`(id),
    UNIQUE KEY (contact, `group`)
);
CREATE TABLE IF NOT EXISTS group_group (
    parent INT NOT NULL REFERENCES `group`(id),
    child INT NOT NULL REFERENCES `group`(id),
    UNIQUE KEY (parent, child)
);