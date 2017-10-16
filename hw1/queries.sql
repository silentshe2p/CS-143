-- Q1: Names of all the actors in the movie 'Death to Smoochy' (<firstname> <lastname>)

SELECT DISTINCT CONCAT(Actor.first, ' ', Actor.last) AS DTS_Actors
FROM Actor INNER JOIN
(SELECT MovieActor.aid
FROM Movie INNER JOIN MovieActor ON Movie.id = MovieActor.mid
WHERE Movie.title = 'Death to Smoochy') AS Nq ON Actor.id = Nq.aid;

-- Q2: Count of all directors who directed at least 4 movies

SELECT DISTINCT COUNT(Ct.did) AS Directed_aleast_4 FROM
(SELECT did, COUNT(mid) FROM MovieDirector GROUP BY did) AS Ct
WHERE Ct.did >= 4;

-- Q3: Names of all the movies with both IMDb and Rotten Tomatoes rating > 90

SELECT M.title AS Highly_rated_titles
FROM Movie AS M INNER JOIN MovieRating AS Mr ON M.id = Mr.mid 
WHERE Mr.imdb > 90 AND Mr.rot > 90;

-- Q4: Top 10 genres based on number tickets sold

SELECT DISTINCT genre AS Top_10_genres 
FROM MovieGenre AS Mg INNER JOIN 
(SELECT mid FROM Sales ORDER BY ticketsSold DESC) AS Sl LIMIT 10;