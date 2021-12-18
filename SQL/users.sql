DROP TABLE movie.users;
DROP TABLE movie.admin;

CREATE TABLE movie.users(
	id SERIAL NOT NULL,
	username VARCHAR(26) NOT NULL,
	password VARCHAR(100) NOT NULL,
	PRIMARY KEY (id)
);

CREATE TABLE movie.admin(
	id INTEGER NOT NULL,
	PRIMARY KEY (id),
	CONSTRAINT admin_users_fk FOREIGN KEY (id) REFERENCES movie.users
);
