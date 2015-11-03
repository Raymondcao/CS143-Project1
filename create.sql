CREATE TABLE Movie(
	id int COMMENT 'Movie ID' NOT NULL, 
	title varchar(100) COMMENT 'Movie title' NOT NULL, 
	year int COMMENT 'Release year', 
	rating varchar(10) COMMENT 'MPAA rating', 
	company varchar(50) COMMENT 'Producation company',
	PRIMARY KEY(id)) ENGINE=INNODB; -- Movie ID must be unique

CREATE TABLE Actor(
	id int COMMENT 'Actor ID' NOT NULL, 
	last varchar(20) COMMENT 'Last name', 
	first varchar(20) COMMENT 'First name', 
	sex varchar(6) COMMENT 'Sex of the actor', 
	dob DATE COMMENT 'Date of birth', 
	dod DATE COMMENT 'Date of death',
	PRIMARY KEY(id), -- Actor ID must also be unique
	CHECK(sex='Female' OR sex='Male'), -- sex can either be male or female
	CHECK(dob<dod)) ENGINE=INNODB; -- Date of death cannot be earlier than date of birth

CREATE TABLE Director(
	id int NOT NULL COMMENT 'Director ID', 
	last varchar(20) COMMENT 'Last name', 
	first varchar(20) COMMENT 'First name', 
	dob DATE COMMENT 'Date of birth', 
	dod DATE COMMENT 'Date of death',
	PRIMARY KEY(id), -- Director ID must be unique
	CHECK(dob<dod)) ENGINE=INNODB; -- Date of death cannot be earlier than date of birth

CREATE TABLE MovieGenre(
	mid int COMMENT 'Movie ID', 
	genre varchar(20) COMMENT 'Movie genre',
	FOREIGN KEY(mid) references Movie(id)) ENGINE=INNODB; -- mid must match a id in Movie table

CREATE TABLE MovieDirector(
	mid int COMMENT 'Movie ID', 
	did int COMMENT 'Director ID',
	FOREIGN KEY(mid) references Movie(id), -- mid must match a id in Movie table
	FOREIGN KEY(did) references Director(id)) ENGINE=INNODB; -- did must match a id in Director table

CREATE TABLE MovieActor(
	mid int COMMENT 'Movie ID', 
	aid int COMMENT 'Actor ID', 
	role varchar(50) COMMENT 'Actor role in movie',
	FOREIGN KEY (mid) references Movie(id), -- mid must match a id in Movie table
	FOREIGN KEY (aid) references Actor(id)) ENGINE=INNODB; -- aid must match a id in Actor table


CREATE TABLE Review(
	name varchar(20) COMMENT 'Reviewer name', 
	time TIMESTAMP COMMENT 'Review time', 
	mid int COMMENT 'Movie ID', 
	rating int COMMENT 'Review rating', 
	comment varchar(500) COMMENT 'Reviewer comment',
	FOREIGN KEY (mid) references Movie(id)) ENGINE=INNODB; -- mid must match a id in Movie table

CREATE TABLE MaxPersonID(id int COMMENT 'Max ID assigned to all persons') ENGINE=INNODB;

CREATE TABLE MaxMovieID(id int COMMENT 'Max ID assigned to all movies') ENGINE=INNODB;

