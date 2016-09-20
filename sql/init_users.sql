SET foreign_key_checks = 0;
DROP TABLE IF EXISTS Users;
DROP TABLE IF EXISTS users;
SET foreign_key_checks = 1;

CREATE TABLE users(
	_id INTEGER AUTO_INCREMENT NOT NULL,
	username VARCHAR(20) NOT NULL UNIQUE,
	password VARCHAR(255) NOT NULL, -- Suitable length for BCRYPT / BLOWFISH
	address VARCHAR(255) NOT NULL,
	fails INTEGER NOT NULL DEFAULT 0,
	locked TIMESTAMP NOT NULL,
	PRIMARY KEY(_id)
);
