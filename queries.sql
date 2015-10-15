SELECT Actor.first, Actor.last FROM (SELECT MovieActor.aid FROM Movie, MovieActor WHERE Movie.title='Die Another Day' and Movie.id=MovieActor.mid) R, Actor WHERE Actor.id=R.aid;
-- First use the movie name to find movie id and use movie id to locate the movie on MovieActor table. Then, we can get actor id from MovieActor table, and use it to find actors name on actor table.

SELECT COUNT(*) FROM Actor AS A WHERE 1 < (SELECT COUNT(*) FROM MovieActor WHERE MovieActor.aid = A.id); 
-- For each actor on actor table, count movies he/she participates in from MovieActor table by his/her actor id. If he/she participate in more than one, he/she will be counted. Return the total count.

-- Find all movies name that are directed by the director of movie "If... Dog... Rabbit..."
SELECT Movie.title FROM (SELECT mid FROM MovieDirector WHERE  did =(SELECT MovieDirector.did FROM Movie, MovieDirector WHERE Movie.title='If... Dog... Rabbit...' and Movie.id=MovieDirector.mid)) AS R, Movie WHERE R.mid = Movie.id;
-- First use the movie name to find movie id and use movie id to locate the movie on MovieDirector table. Then, we can get director id from MovieDirector table, and use it to find movie ids that directed by this did on MovieDirector table. Finally, use these mids to get movie titles on Movie