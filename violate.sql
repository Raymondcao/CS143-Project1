insert into Actor values(10, 'Burger', 'King', 'Male', '19900101', \N);
	-- there exist an actor, who has id=10. Since id is primary key, id should be unique.
ERROR 1062 (23000): Duplicate entry '10' for key 'PRIMARY'

insert into Actor values(1020524, 'Burger', 'King', 'Undefined', '19900101', \N);
	-- 	however, as mentioned on sepcs, CHECK doesn't work in mysql. Undefined should not be filled under sex column
-- Query OK, 1 row affected, 1 warning (0.01 sec)

insert into Actor values(1020523, 'Burger', 'King', 'Undefined', '19900101', '19800101');
	-- same as above, date of death should not be earlier than date of birth
-- Query OK, 1 row affected, 1 warning (0.00 sec)

insert into Movie values(2, 'Burger', 1990, 'R', 'Fat');
	-- there exist a movie that has id=2. Since id is primary key, id should be unique.
-- ERROR 1062 (23000): Duplicate entry '2' for key 'PRIMARY'

insert into Director values(16, 'Burger', 'King', '19900101', '19800101');
	-- there exist a director, who has id=16. Since id is primary key, id should be unique.
-- ERROR 1062 (23000): Duplicate entry '16' for key 'PRIMARY'

insert into Director values(63953, 'Burger', 'King', '19900101', '19800101');
	-- date of death should not be earlier than date of birth
-- Query OK, 1 row affected (0.00 sec)

insert into MovieGenre values(236836, 'Burger');
	-- there isn't a movie that has id = 236836. Since mid is set to be a foreign key constraint in this table, there should exist a row that has id=mid in movie table.
-- ERROR 1452 (23000): Cannot add or update a child row: a foreign key constraint fails (`CS143`.`MovieGenre`, CONSTRAINT `MovieGenre_ibfk_1` FOREIGN KEY (`mid`) REFERENCES `Movie` (`id`))

insert into MovieDirector values(2, 59362);
	-- there isn't a director that has id = 59362. Since did is set to be a foreign key constraint in this table, there should exist a row that has id=did in director table.
-- ERROR 1452 (23000): Cannot add or update a child row: a foreign key constraint fails (`CS143`.`MovieDirector`, CONSTRAINT `MovieDirector_ibfk_2` FOREIGN KEY (`did`) REFERENCES `Director` (`id`))

insert into MovieDirector values(243621, 16);
	-- there isn't a movie that has id = 243621. Since mid is set to be a foreign key constraint in this table, there should exist a row that has id=mid in movie table.
-- ERROR 1452 (23000): Cannot add or update a child row: a foreign key constraint fails (`CS143`.`MovieDirector`, CONSTRAINT `MovieDirector_ibfk_1` FOREIGN KEY (`mid`) REFERENCES `Movie` (`id`))

insert into MovieActor values(243621, 10, 'cheese');
		-- there isn't a movie that has id = 243621. Since mid is set to be a foreign key constraint in this table, there should exist a row that has id=mid in movie table.
-- ERROR 1452 (23000): Cannot add or update a child row: a foreign key constraint fails (`CS143`.`MovieActor`, CONSTRAINT `MovieActor_ibfk_1` FOREIGN KEY (`mid`) REFERENCES `Movie` (`id`))

insert into MovieActor values(2, 1945810, 'cheese');
	-- there isn't a actor that has id = 1945810. Since aid is set to be a foreign key constraint in this table, there should exist a row that has id=aid in actor table.
-- ERROR 1452 (23000): Cannot add or update a child row: a foreign key constraint fails (`CS143`.`MovieActor`, CONSTRAINT `MovieActor_ibfk_2` FOREIGN KEY (`aid`) REFERENCES `Actor` (`id`))

mysql> insert into Review values('BK', '20151013', 243621, 10, 'Whopper');
	-- there isn't a movie that has id = 243621. Since mid is set to be a foreign key constraint in this table, there should exist a row that has id=mid in movie table.
-- ERROR 1452 (23000): Cannot add or update a child row: a foreign key constraint fails (`CS143`.`Review`, CONSTRAINT `Review_ibfk_1` FOREIGN KEY (`mid`) REFERENCES `Movie` (`id`))
