SET foreign_key_checks = 0;
DROP TABLE IF EXISTS posts;
SET foreign_key_checks = 1;

CREATE TABLE posts(
	_id INTEGER AUTO_INCREMENT NOT NULL,
	username VARCHAR(20),
	usercomment TEXT,
	PRIMARY KEY(_id),
	FOREIGN KEY(username) REFERENCES users(username)
);

INSERT INTO posts(username, usercomment) VALUES('asd', 'Hello my name is asd~');
INSERT INTO posts(username, usercomment) VALUES('asd', 'This is another comment');
INSERT INTO posts(username, usercomment) VALUES('c', 'This is c talking.');
