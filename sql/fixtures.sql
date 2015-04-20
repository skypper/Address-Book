/*
This file setups the database with example data sets
*/

USE address_book;

INSERT INTO city (name) VALUES ('Brasov'), ('Bucuresti'), ('Iasi'), ('Constanta'), ('Cluj');
INSERT INTO contact (first_name, last_name, zipcode, city_id) VALUES
	('CA1', 'foo', 1234, 1),		-- id 1
	('CA2', 'foo', 1234, 1),		-- id 2
	('CB1', 'foo', 1234, 2),		-- id 3
	('CB2', 'foo', 1234, 2),		-- id 4
	('CC1', 'foo', 1234, 3),		-- id 5
	('CC2', 'foo', 1234, 3),		-- id 6
	('CD1', 'foo', 1234, 4),		-- id 7
	('CD2', 'foo', 1234, 4);		-- id 8

/*
INSERT INTO `group` (name, path) VALUES
    ('G1', '1/'), ('G2', '1/2/'), ('G3', '1/2/3/'), ('G4', '1/4/'), ('G5', '1/4/5/'),
    ('G6', '1/4/6/'), ('G7', '1/4/6/7/');
INSERT INTO group_contact (group_id, contact_id) VALUES
	(1, 1), (2, 2), (2, 3), (2, 4);
*/
INSERT INTO `group` (name, path) VALUES
	('Group D', '1/'),		-- id 1
	('Group C', '1/2/'), 	-- id 2
	('Group AA', '1/3/'),	-- id 3
	('Group B', '1/4/'),  	-- id 4
	('Group A', '1/2/5/');	-- id 5 
INSERT INTO group_contact (group_id, contact_id) VALUES
	(1, 7), (1, 8), 
	(2, 5), (2, 6), 
	(3, 1), (3, 2), 
	(4, 3), (4, 4), 
	(5, 1), (5, 2);


	
-- Query ancestors: SELECT * FROM `group` WHERE '1/4/5/' LIKE CONCAT(path, '%');
-- Query descendands: SELECT * FROM `group` WHERE path LIKE '1/4/';

/*
## Query group ancestors of group with a specified id:
SELECT g1.* FROM `group` AS g1
	LEFT JOIN `group` AS g2
	ON g2.id = 1
	WHERE g1.path LIKE CONCAT(g2.path, '%');

## Query all contacts (their ids actually, including inherited) of a specified group (id):
SELECT gc.* FROM `group_contact` AS gc 
	LEFT JOIN `group` AS g1 ON g1.id = 2 
	LEFT JOIN `group` AS g2 ON g2.path LIKE CONCAT(g1.path, '%') 
	WHERE gc.group_id = g2.id;

## Query all contacts (including inherited) of a specifie group (id):
SELECT c.first_name, c.last_name, c.zipcode, ct.name AS city FROM contact AS c
	LEFT JOIN `group` AS g1 ON g1.id = 2 
	LEFT JOIN `group` AS g2 ON g2.path LIKE CONCAT(g1.path, '%')
	LEFT JOIN group_contact AS gc ON gc.group_id = g2.id
	LEFT JOIN city AS ct ON ct.id = c.city_id
	WHERE c.id = gc.contact_id;
*/
