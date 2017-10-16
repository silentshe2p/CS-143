-- Primary key contraints violations

-- PRIMARY KEY(id) in Movie violation by inserting duplicate id
INSERT INTO Movie VALUES (2, 'A', 2000, 'R', 'AC');
-- ERROR 1062 (23000): Duplicate entry '2' for key 'PRIMARY'

-- PRIMARY KEY(id) in Actor violation by inserting duplicate id
INSERT INTO Actor VALUES (1, 'A', 'B', 'Female', '19750525', NULL);
-- ERROR 1062 (23000): Duplicate entry '1' for key 'PRIMARY'

-- PRIMARY KEY(id) in Director violation by inserting duplicate id
INSERT INTO Director VALUES (3141, 'A', 'B', '19501025', NULL);
-- ERROR 1062 (23000): Duplicate entry '3141' for key 'PRIMARY'


-- Referential integrity contraints violations

-- FOREIGN KEY(mid) REFERENCES Movie(id) in Sales violation by deleting a movie from Movie that mid referring to
DELETE FROM Movie WHERE id = 2;
-- ERROR 1451 (23000): Cannot delete or update a parent row: a foreign key constraint fails (`TEST`.`Sales`, CONSTRAINT `Sales_ibfk_1` FOREIGN KEY (`mid`) REFERENCES `Movie` (`id`))

-- FOREIGN KEY(aid) REFERENCES Actor(id) in MovieActor violation by deleting a actor from Actor that aid referring to
DELETE FROM Actor WHERE id = 20;
-- ERROR 1451 (23000): Cannot delete or update a parent row: a foreign key constraint fails (`TEST`.`MovieActor`, CONSTRAINT `MovieActor_ibfk_1` FOREIGN KEY (`aid`) REFERENCES `Actor` (`id`))

-- FOREIGN KEY(mid) REFERENCES Movie(id) in MovieGenre violation by inserting a genre for a non-existing-in-Movie movie
INSERT INTO MovieGenre VALUES (1, 'Horror');
-- ERROR 1452 (23000): Cannot add or update a child row: a foreign key constraint fails (`TEST`.`MovieGenre`, CONSTRAINT `MovieGenre_ibfk_1` FOREIGN KEY (`mid`) REFERENCES `Movie` (`id`))

-- FOREIGN KEY(did) REFERENCES Director(id) in MovieDirector violation by deleting a director from Director that did referring to
DELETE FROM Director WHERE id = 23141;	
-- ERROR 1451 (23000): Cannot delete or update a parent row: a foreign key constraint fails (`TEST`.`MovieDirector`, CONSTRAINT `MovieDirector_ibfk_1` FOREIGN KEY (`did`) REFERENCES `Director` (`id`))

-- FOREIGN KEY(mid) REFERENCES Movie(id) in MovieDirector violation by inserting a director for a non-existing-in-Movie movie
INSERT INTO MovieDirector VALUES (1,113);
-- ERROR 1452 (23000): Cannot add or update a child row: a foreign key constraint fails (`TEST`.`MovieDirector`, CONSTRAINT `MovieDirector_ibfk_1` FOREIGN KEY (`did`) REFERENCES `Director` (`id`))

-- FOREIGN KEY(mid) REFERENCES Movie(id) in Review violation by inserting a review for a non-existing-in-Movie movie
INSERT INTO Review VALUES ('Jeff', '2017-10-15 12:34:56', 4715, 5, 'I like it!');
-- ERROR 1452 (23000): Cannot add or update a child row: a foreign key constraint fails (`TEST`.`Review`, CONSTRAINT `Review_ibfk_1` FOREIGN KEY (`mid`) REFERENCES `Movie` (`id`))


-- CHECK contraints violations

-- CHECK(imdb >= 0 AND imdb <= 100) violation by updating imdb to be out of bound
UPDATE MovieRating SET imdb = -25 WHERE mid = 12;

-- CHECK(rot >= 0 AND rot <= 100) violation by updating rot to be out of bound
UPDATE MovieRating SET rot = 250 WHERE mid = 12;

-- CHECK(rating >= 0 AND rating <= 5) violation by inserting a review with an out-of-bound rating
INSERT INTO Review VALUES ('Bezos', '2017-10-15 12:34:56', 12, 6, 'I like it too!');
