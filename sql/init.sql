SET foreign_key_checks = 0;
DROP TABLE IF EXISTS Users, Items;
SET foreign_key_checks = 1;

CREATE TABLE Users(
	_id INTEGER AUTO_INCREMENT NOT NULL,
	username VARCHAR(20) NOT NULL UNIQUE,
	password VARCHAR(255) NOT NULL, -- Suitable length for BCRYPT / BLOWFISH
	-- salt VARCHAR(32) NOT NULL, -- ? Decide on a salt size
	PRIMARY KEY(_id)
);

CREATE TABLE Items(
	_id INTEGER NOT NULL AUTO_INCREMENT,
	name VARCHAR(32) NOT NULL UNIQUE,
	description text,
	price DOUBLE,
	PRIMARY KEY(_id)
);

INSERT INTO Users(username, password) VALUES('test1', 'test1');
INSERT INTO Users(username, password) VALUES('test2', 'test2');
INSERT INTO Items(name, description, price) VALUES('Deadpool (Blu-Ray)', 'A higly acclaimed blockbuster from 2016', 9.99);
INSERT INTO Items(name, description, price) VALUES('Chromecast', 'Google Chromecast 2nd generation', 19.99);
