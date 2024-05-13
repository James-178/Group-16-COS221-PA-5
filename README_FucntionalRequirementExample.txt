*User Registration
INSERT INTO users (username, password, email, created_at, api_key) 
VALUES ('john_doe', 'hashed_secure_password', 'john@example.com', NOW(), 'generated_api_key');

*User Login
SELECT * FROM users 
WHERE username = 'john_doe' 
  AND password = 'hashed_secure_password';

*Update user details
UPDATE users 
SET email = 'new_email@example.com', password = 'new_hashed_secure_password' 
WHERE username = 'john_doe';

*Inspect User API Key
SELECT api_key FROM users 
WHERE username = 'john_doe';

*Update User API Key
UPDATE users 
SET api_key = 'new_generated_api_key' 
WHERE username = 'john_doe';


*Add Movie
INSERT INTO titles (name, release_year, description, duration, IMDB_rating, is_movie, language_id, studio_id) 
VALUES ('New Movie', '2023', 'A thrilling new movie.', 120, 8.5, 1, 1, 1);

*Update Movie Info
UPDATE titles 
SET name = 'Updated Movie', IMDB_rating = 9.0 
WHERE title_id = 1;

*Delete Movie
DELETE FROM titles 
WHERE title_id = 1;

*Add Actor
INSERT INTO actors (first_name, last_name, dob, sex, experience, awards) 
VALUES ('Leonardo', 'DiCaprio', '1974-11-11', 'Male', 25, 'Best Actor');

*Update Actor 
UPDATE actors 
SET first_name = 'Leonardo Wilhelm', last_name = 'DiCaprio' 
WHERE actor_id = 1;

*Delete Actor 
DELETE FROM actors 
WHERE actor_id = 1;

*Add Director
INSERT INTO people (first_name, last_name, role, sex, dob) 
VALUES ('Christopher', 'Nolan', 'director', 'Male', '1970-07-30');

*Update Director
UPDATE people 
SET first_name = 'Christopher', last_name = 'Nolan', sex = 'Male' 
WHERE person_id = 1;

*Delete Director 
DELETE FROM people 
WHERE person_id = 1;

*Filter Movie by Genere
SELECT t.* FROM titles t
JOIN genres g ON t.title_id = g.title_id
WHERE g.genre = 'Action';

*Sort Movie by Rating
SELECT * FROM titles 
ORDER BY IMDB_rating DESC;

*Filter Movie&TV Series by Release Date 
SELECT * FROM titles 
WHERE release_year >= '2020';

*Add User Rating&Comment
INSERT INTO reviews (title_id, user_id, rating, review, created_at) 
VALUES (1, 1, 9, 'Amazing movie!', NOW());

*Select Movie's Comment&Rating
SELECT r.*, u.username FROM reviews r
JOIN users u ON r.user_id = u.user_id
WHERE r.title_id = 1;

*System Recommand
SELECT t.* FROM titles t
JOIN reviews r ON t.title_id = r.title_id
WHERE r.user_id = 1
ORDER BY r.rating DESC
LIMIT 5;

-retrieve all actors involved in a specific listed title by title id
  SELECT * FROM title_actors t JOIN actors a ON a.actor_id = t.actor_id WHERE t.title_id = 17

-retrieve all movies where a certain actor is involved in by actor id
  SELECT * FROM title_actors t JOIN titles m ON m.title_id = t.title_id WHERE t.actor_id = 10

-filter titles by excluding results from a specific studio by name
  SELECT t.* FROM titles t JOIN studios s ON t.studio_id = s.studio_id WHERE s.name != 'Ferry LLC'

-filter titles by excluding results from multiple specific studios by names 
  SELECT t.* FROM titles t JOIN studios s ON t.studio_id = s.studio_id WHERE s.name NOT IN ('Ferry LLC', 'Franecki-Flatley', 'Romaguera-Jacobs')

-recommend up to 10 random titles from the same studio by id
  SELECT * FROM titles WHERE studio_id=12 ORDER BY RAND() LIMIT 10;

-recommend up to 10 random titles from the same director by first and last name:
  SELECT t.* FROM title_people tp 
  INNER JOIN directors d ON tp.person_id = d.person_id 
  INNER JOIN titles t ON tp.title_id = t.title_id 
  INNER JOIN people p ON tp.person_id = p.person_id
  WHERE p.first_name = 'Noah' AND p.last_name = 'Minker' ORDER BY RAND() LIMIT 10;

-select from multiple constraints simultaneously, for example : select shows only, excluding certain studios by name, including specific actor, released after 2000, ordered by imdb rating ascendingly
  SELECT * FROM title_actors t 
  JOIN titles m ON m.title_id = t.title_id 
  JOIN studios s ON m.studio_id = s.studio_id 
  WHERE t.actor_id = 10 AND m.is_movie = 0 
  AND m.release_year > '2000' AND s.name NOT IN ('Ferry LLC', 'Franecki-Flatley') 
  ORDER BY m.IMDB_rating ASC
 

