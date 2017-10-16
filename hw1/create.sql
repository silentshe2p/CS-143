CREATE TABLE Movie (
	id INT NOT NULL, 
	title VARCHAR(100) NOT NULL, 
	year INT NOT NULL, 
	rating VARCHAR(10), 
	company VARCHAR(50) NOT NULL,
	-- id should be an unique identifier for each movie
	PRIMARY KEY(id)
	) ENGINE = InnoDB;

CREATE TABLE Actor (
	id INT NOT NULL, 
	last VARCHAR(20) NOT NULL, 
	first VARCHAR(20) NOT NULL, 
	sex VARCHAR(6) NOT NULL, 
	dob DATE NOT NULL, 
	dod DATE,
	-- id should be an unique identifier for each actor
	PRIMARY KEY(id)
	) ENGINE = InnoDB;

CREATE TABLE Sales (
	mid INT NOT NULL, 
	ticketsSold INT NOT NULL, 
	totalIncome INT NOT NULL,
    -- each sale should associate with an unique movie(mid)
    PRIMARY KEY(mid),
	-- every movie(mid) should be associated with a movie(id) in Movie	
	FOREIGN KEY(mid) REFERENCES Movie(id)    
 	) ENGINE = InnoDB;

CREATE TABLE Director (
	id INT NOT NULL, 
	last VARCHAR(20) NOT NULL, 
	first VARCHAR(20) NOT NULL, 
	dob DATE NOT NULL, 
	dod DATE,
	-- id should be an unique identifier for each director
	PRIMARY KEY(id)
	) ENGINE = InnoDB;

CREATE TABLE MovieGenre (
	mid INT NOT NULL, 
	genre VARCHAR(20) NOT NULL,
	-- every movie(mid) should be associated with a movie(id) in Movie
	FOREIGN KEY(mid) REFERENCES Movie(id)
	) ENGINE = InnoDB;

CREATE TABLE MovieDirector (
	mid INT NOT NULL, 
	did INT NOT NULL,
	-- every director(did) should correspond to a director(id) in Director
	FOREIGN KEY(did) REFERENCES Director(id),
	-- every movie(mid) should be associated with a movie(id) in Movie	
	FOREIGN KEY(mid) REFERENCES Movie(id)
	) ENGINE = InnoDB;

CREATE TABLE MovieActor (
	mid INT NOT NULL, 
	aid INT NOT NULL, 
	role VARCHAR(50) NOT NULL,
	-- every actor(aid) should correspond to a actor(id) in Director
	FOREIGN KEY(aid) REFERENCES Actor(id),
	-- every movie(mid) should be associated with a movie(id) in Movie	
	FOREIGN KEY(mid) REFERENCES Movie(id)	
	) ENGINE = InnoDB;

CREATE TABLE MovieRating (
	mid INT NOT NULL, 
	imdb INT, 
	rot INT,
	-- each rating should associate with an unique movie(mid)
	PRIMARY KEY(mid),	
	-- every movie(mid) should be associated with a movie(id) in Movie
	FOREIGN KEY(mid) REFERENCES Movie(id),
	-- both rating value should be in range 0 to 100
	CHECK(imdb >= 0 AND imdb <= 100),
	CHECK(rot >= 0 AND rot <= 100)
	);

CREATE TABLE Review (
	name VARCHAR(20) NOT NULL, 
	time TIMESTAMP NOT NULL, 
	mid INT NOT NULL,
	rating INT,
	comment VARCHAR(500),
	-- every movie(mid) reviewed should be associated with a movie(id) in Movie
	FOREIGN KEY(mid) REFERENCES Movie(id),
	-- Amazon has review rating range from 0 to 5
	CHECK(rating >= 0 AND rating <= 5)	
	);

CREATE TABLE MaxPersonID (id INT NOT NULL) ENGINE = InnoDB;

CREATE TABLE MaxMovieID (id INT NOT NULL) ENGINE = InnoDB;