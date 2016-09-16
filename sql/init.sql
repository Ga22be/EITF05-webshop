SET foreign_key_checks = 0;
DROP TABLE IF EXISTS Users, Items;
SET foreign_key_checks = 1;

CREATE TABLE Users(
	_id INTEGER AUTO_INCREMENT NOT NULL,
	username VARCHAR(20) NOT NULL UNIQUE,
	password VARCHAR(255) NOT NULL, -- Suitable length for BCRYPT / BLOWFISH
	salt VARCHAR(32) NOT NULL, -- ? Decide on a salt size
	PRIMARY KEY(_id)
);

CREATE TABLE Items(
	_id INTEGER NOT NULL AUTO_INCREMENT,
	name VARCHAR(32) NOT NULL UNIQUE,
	description VARCHAR(255),
	price DOUBLE, 
	PRIMARY KEY(_id)
);

INSERT INTO Users(username, password) VALUES('test1', 'test1');
INSERT INTO Users(username, password) VALUES('test2', 'test2');
INSERT INTO Items(name, description, price) VALUES('test1', 'test1', 9.99);
INSERT INTO Items(name, description, price) VALUES('test2', 'test2', 19.99);
