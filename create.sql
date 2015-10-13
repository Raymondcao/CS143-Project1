create table Movie(id int COMMENT 'Movie ID', title varchar(100) COMMENT 'Movie title', year int COMMENT 'Release year', rating varchar(10) COMMENT 'MPAA rating', company varchar(50) COMMENT 'Producation company');

create table Actor(id int COMMENT 'Actor ID', last varchar(20) COMMENT 'Last name', first varchar(20) COMMENT 'First name', sex varchar(6) COMMENT 'Sex of the actor', dob DATE COMMENT 'Date of birth', dod DATE COMMENT 'Date of death');

create table Director(id int COMMENT 'Director ID', last varchar(20) COMMENT 'Last name', first varchar(20) COMMENT 'First name', dob DATE COMMENT 'Date of birth', dod DATE COMMENT 'Date of death');

create table MovieGenre(mid int COMMENT 'Movie ID', genre varchar(20) COMMENT 'Movie genre');

create table MovieDirector(mid int COMMENT 'Movie ID', did int COMMENT 'Director ID');

create table MovieActor(mid int COMMENT 'Movie ID', aid int COMMENT 'Actor ID', role varchar(50) COMMENT 'Actor role in movie');

create table Review(name varchar(20) COMMENT 'Reviewer name', time TIMESTAMP COMMENT 'Review time', mid int COMMENT 'Movie ID', rating int COMMENT 'Review rating', comment varchar(500) COMMENT 'Reviewer comment');

create table MaxPersonID(id int COMMENT 'Max ID assigned to all persons');

create table MaxMovieID(id int COMMENT 'Max ID assigned to all movies');

