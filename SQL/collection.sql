DROP TABLE movie.collection;

CREATE TABLE movie.collection(
	user_id integer NOT NULL,
	movie_id character varying(10) NOT NULL,
	PRIMARY KEY (user_id, movie_id),
	CONSTRAINT collection_users_fk FOREIGN KEY (user_id) REFERENCES movie.users(id) ON DELETE CASCADE,
	CONSTRAINT collection_movies_fk FOREIGN KEY (movie_id) REFERENCES movie.movie(idimdb)
);
