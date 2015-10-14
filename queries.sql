SELECT Actor.first, Actor.last FROM (SELECT MovieActor.aid FROM Movie, MovieActor WHERE Movie.title='Die Another Day' and Movie.id=MovieActor.mid) R, Actor WHERE Actor.id=R.aid;
-- First use the movie name to find movie id and use movie id to locate the movie on MovieActor table. Then, we can get actor id from MovieActor table, and use it to find actors name on actor table.

SELECT COUNT(*) FROM Actor AS A WHERE 1 < (SELECT COUNT(*) FROM MovieActor WHERE MovieActor.aid = A.id); 
-- For each actor on actor table, count movies he/she participates in from MovieActor table by his/her actor id. If he/she participate in more than one, he/she will be counted. Return the total count.
