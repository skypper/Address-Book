USE address_book;

INSERT INTO city (name) VALUES ('Brasov'), ('Bucuresti'), ('Iasi'), ('Constanta'), ('Cluj');
INSERT INTO contact (first_name, last_name, zipcode, city_id) VALUES
    ('Tudor', 'Anastasiu', '500228', 1),
    ('Alexandru', 'Sava', '433000', 2),
    ('Laurentiu', 'Nasui', '500233', 3),
    ('Alex', 'Zotoiu', '544122', 4);
