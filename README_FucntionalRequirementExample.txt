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
