SELECT Actor.first, Actor.last FROM (SELECT MovieActor.aid FROM Movie, MovieActor WHERE Movie.title='Die Another Day' and Movie.id=MovieActor.mid) R, Actor WHERE Actor.id=R.aid;
