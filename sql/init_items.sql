CREATE TABLE Items(
	_id INTEGER NOT NULL AUTO_INCREMENT,
	name VARCHAR(32) NOT NULL UNIQUE,
	description text,
	price DOUBLE,
	image VARCHAR(100),
	PRIMARY KEY(_id)
);

INSERT INTO Items(name, description, price, image) VALUES('Deadpool', 'A higly acclaimed blockbuster from 2016', 9.99, "../pictures/deadpool.jpg");
INSERT INTO Items(name, description, price, image) VALUES('Chromecast', 'Google Chromecast 2nd generation', 19.99, "../pictures/chromecast2.jpg");
INSERT INTO Items(name, description, price, image) VALUES('iPhone7', 'Apple\'s latest smartphone', 649, "../pictures/iphone7.jpg");
INSERT INTO Items(name, description, price, image) VALUES('FIFA17', 'Be the first to experience EA-games latest money-grab', 60, "../pictures/fifa17.jpg");
