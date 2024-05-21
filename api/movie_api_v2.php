<?php
require_once('config.php');
class Database 
{
    public static function instance()
    {
    static $instance = null;
    if($instance === null)
    $instance = new Database();
    return $instance; }

    public function AddTitle()
    {
        $json_data = file_get_contents("php://input");
        $request_data = json_decode($json_data, true);
        if ($request_data !== null)
        {   
            $name = isset($request_data["name"]) ? $request_data["name"] : null;
            $release_year = isset($request_data["release_year"]) ? $request_data["release_year"] : null;
            $description = isset($request_data["description"]) ? $request_data["description"] : null;
            $duration = isset($request_data["duration"]) ? $request_data["duration"] : null;
            $IMDB_rating = isset($request_data["IMDB_rating"]) ? $request_data["IMDB_rating"] : null;
            $is_movie = isset($request_data["is_movie"]) ? $request_data["is_movie"] : null;
            $language_id = isset($request_data["language_id"]) ? $request_data["language_id"] : null;
            $studio_id = isset($request_data["studio_id"]) ? $request_data["studio_id"] : null;

            if ($name === null || $release_year === null || $description === null || $duration === null ||         
                $is_movie === null) 
            {
                $error_response = array( 
                "status"=> "error",
                "timestamp"=> microtime(true) * 1000,
                "data"=> "Required post parameters(name,release_year,description,duration,is_movie) are missing"   
                );
                header("Content-Type: application/json");
                echo json_encode($error_response);
                return;
            }

            $conn = mysqli_connect(DB_SERVER, DB_USER, DB_PASSWORD, DB_NAME);
            if (!$conn) 
            {
                die("Connection failed: " . mysqli_connect_error());
            }

            $sql_api = "INSERT INTO `titles` (name, release_year, description, duration, IMDB_rating, is_movie, language_id, studio_id) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt = mysqli_prepare($conn, $sql_api);
            mysqli_stmt_bind_param($stmt, "sisidiii", $name, $release_year, $description, $duration, $IMDB_rating, $is_movie, $language_id, $studio_id);
            if (!mysqli_stmt_execute($stmt)) 
            {
                die("Execution failed: ".mysqli_stmt_error($stmt));
            }
            mysqli_stmt_close($stmt);
            mysqli_close($conn);
        }
        else
        {
            $error_response = array( 
                "status"=> "error",
                "timestamp"=> microtime(true) * 1000,
                "data"=> "Post parameters are missing/incorrect"   
                );
                header("Content-Type: application/json");
                echo json_encode($error_response);
        }
    }

    public function RemoveTitle()
    {
        $json_data = file_get_contents("php://input");
        $request_data = json_decode($json_data, true);
        if ($request_data !== null)
        {
            $title_id = isset($request_data["title_id"]) ? $request_data["title_id"] : null;
            if($title_id===null)
            {
                $error_response = array( 
                    "status"=> "error",
                    "timestamp"=> microtime(true) * 1000,
                    "data"=> "Required post parameters are missing"   
                    );
                    header("Content-Type: application/json");
                    echo json_encode($error_response);
                    return;
            }
            $conn = mysqli_connect(DB_SERVER, DB_USER, DB_PASSWORD, DB_NAME);
            if (!$conn) 
            {
                die("Connection failed: " . mysqli_connect_error());
            }

            $sql_check_id = "SELECT COUNT(*) AS count FROM titles WHERE title_id = ?";
            $stmt = mysqli_prepare($conn, $sql_check_id);
            mysqli_stmt_bind_param($stmt, "i", $title_id);
            if (!mysqli_stmt_execute($stmt)) {
                die("Execution failed: ".mysqli_stmt_error($stmt));
            }
            mysqli_stmt_bind_result($stmt, $count);
            mysqli_stmt_fetch($stmt);
            if($count==0)
            {
                $error_response = array( 
                    "status"=> "error",
                    "timestamp"=> microtime(true) * 1000,
                    "data"=> "Title ID not found"   
                    );
                    header("Content-Type: application/json");
                    echo json_encode($error_response); 
            }
            mysqli_stmt_close($stmt);

            $sql_api = "DELETE FROM titles WHERE title_id = ?";
            $stmt = mysqli_prepare($conn, $sql_api);
            mysqli_stmt_bind_param($stmt, "i", $title_id);
            if (!mysqli_stmt_execute($stmt)) {
                die("Execution failed: ".mysqli_stmt_error($stmt));
            }
            mysqli_stmt_close($stmt);
            mysqli_close($conn);
        }
        else
        {
            $error_response = array( 
                "status"=> "error",
                "timestamp"=> microtime(true) * 1000,
                "data"=> "Post parameters are missing/incorrect"   
                );
                header("Content-Type: application/json");
                echo json_encode($error_response);
        }

    }

    public function UpdateTitle()
    {
        $json_data = file_get_contents("php://input");
        $request_data = json_decode($json_data, true);
        if ($request_data !== null)
        {   
            $title_id = isset($request_data["title_id"]) ? $request_data["title_id"] : null;
            $name = isset($request_data["name"]) ? $request_data["name"] : null;
            $release_year = isset($request_data["release_year"]) ? $request_data["release_year"] : null;
            $description = isset($request_data["description"]) ? $request_data["description"] : null;
            $duration = isset($request_data["duration"]) ? $request_data["duration"] : null;
            $IMDB_rating = isset($request_data["IMDB_rating"]) ? $request_data["IMDB_rating"] : null;
            $is_movie = isset($request_data["is_movie"]) ? $request_data["is_movie"] : null;
            $language_id = isset($request_data["language_id"]) ? $request_data["language_id"] : null;
            $studio_id = isset($request_data["studio_id"]) ? $request_data["studio_id"] : null;

            if ($title_id==null) 
            {
                $error_response = array( 
                "status"=> "error",
                "timestamp"=> microtime(true) * 1000,
                "data"=> "Required ID post parameters are missing"   
                );
                header("Content-Type: application/json");
                echo json_encode($error_response);
                return;
            }

            $conn = mysqli_connect(DB_SERVER, DB_USER, DB_PASSWORD, DB_NAME);
            if (!$conn) 
            {
                die("Connection failed: " . mysqli_connect_error());
            }

            $sql_check_id = "SELECT COUNT(*) AS count FROM titles WHERE title_id = ?";
            $stmt = mysqli_prepare($conn, $sql_check_id);
            mysqli_stmt_bind_param($stmt, "i", $title_id);
            if (!mysqli_stmt_execute($stmt)) {
                die("Execution failed: ".mysqli_stmt_error($stmt));
            }
            mysqli_stmt_bind_result($stmt, $count);
            mysqli_stmt_fetch($stmt);
            if($count==0)
            {
                $error_response = array( 
                    "status"=> "error",
                    "timestamp"=> microtime(true) * 1000,
                    "data"=> "Title ID not found"   
                    );
                    header("Content-Type: application/json");
                    echo json_encode($error_response); 
            }
            mysqli_stmt_close($stmt);

            $update_fields = array();
            $update_params = array();
            if ($name !== null) 
            {
                $update_fields[] = "name = ?";
                $update_params[] = $name;
            }
            if ($release_year !== null) 
            {
                $update_fields[] = "release_year = ?";
                $update_params[] = $release_year;
            }   
            if ($description !== null) 
            {
                $update_fields[] = "description = ?";
                $update_params[] = $description;
            }
            if ($duration !== null) 
            {
                $update_fields[] = "duration = ?";
                $update_params[] = $duration;
            }
            if ($IMDB_rating !== null) 
            {
                $update_fields[] = "IMDB_rating = ?";
                $update_params[] = $IMDB_rating;
            }
            if ($is_movie !== null) 
            {
                $update_fields[] = "is_movie = ?";
                $update_params[] = $is_movie;
            }
            if ($language_id !== null) 
            {
                $update_fields[] = "language_id = ?";
                $update_params[] = $language_id;
            }
            if ($studio_id !== null) 
            {
                $update_fields[] = "studio_id = ?";
                $update_params[] = $studio_id;
            }
            $sql_api= "UPDATE titles SET " . implode(", ", $update_fields) . " WHERE title_id = ?";
            $stmt = mysqli_prepare($conn, $sql_api);
            $update_params[] = $title_id; 
            $param_types = str_repeat("s", count($update_params)); 
            mysqli_stmt_bind_param($stmt, $param_types, ...$update_params);
            if (!mysqli_stmt_execute($stmt)) {
                die("Execution failed: " . mysqli_stmt_error($stmt));
            }
            mysqli_stmt_close($stmt);
        }
        else
        {
            $error_response = array( 
                "status"=> "error",
                "timestamp"=> microtime(true) * 1000,
                "data"=> "Post parameters are missing/incorrect"   
                );
                header("Content-Type: application/json");
                echo json_encode($error_response);
        }
    }

    public function GetTitle()
    {
        $json_data = file_get_contents("php://input");
        $request_data = json_decode($json_data, true);
        if ($request_data !== null)
        {   
            $title_id = isset($request_data["title_id"]) ? $request_data["title_id"] : null;
            if ($title_id==null) 
            {
                $error_response = array( 
                "status"=> "error",
                "timestamp"=> microtime(true) * 1000,
                "data"=> "Required title_id missing"   
                );
                header("Content-Type: application/json");
                echo json_encode($error_response);
                return;
            }

            $conn = mysqli_connect(DB_SERVER, DB_USER, DB_PASSWORD, DB_NAME);
            if (!$conn) 
            {
                die("Connection failed: " . mysqli_connect_error());
            }
            $sql_check_id = "SELECT COUNT(*) AS count FROM titles WHERE title_id = ?";
            $stmt = mysqli_prepare($conn, $sql_check_id);
            mysqli_stmt_bind_param($stmt, "i", $title_id);
            if (!mysqli_stmt_execute($stmt)) {
                die("Execution failed: ".mysqli_stmt_error($stmt));
            }
            mysqli_stmt_bind_result($stmt, $count);
            mysqli_stmt_fetch($stmt);
            if($count==0)
            {
                $error_response = array( 
                    "status"=> "error",
                    "timestamp"=> microtime(true) * 1000,
                    "data"=> "Title ID not found"   
                    );
                    header("Content-Type: application/json");
                    echo json_encode($error_response); 
            }
            mysqli_stmt_close($stmt);

            $sql_get="SELECT  t.*,  s.name AS studio_name,  l.name AS language_name, 
                      GROUP_CONCAT(DISTINCT CONCAT(a.first_name, ' ', a.last_name) ORDER BY a.first_name ASC SEPARATOR ', ') AS actor_names,
                      GROUP_CONCAT(DISTINCT CONCAT(dp.first_name, ' ', dp.last_name) ORDER BY dp.first_name ASC SEPARATOR ', ') AS director,
                      GROUP_CONCAT(DISTINCT CONCAT(cp.first_name, ' ', cp.last_name) ORDER BY cp.first_name ASC SEPARATOR ', ') AS crew,
                      GROUP_CONCAT(DISTINCT r.review ORDER BY r.review ASC SEPARATOR ', ') AS reviews,
                      GROUP_CONCAT(DISTINCT g.genre ORDER BY g.genre ASC SEPARATOR ', ') AS genres
                      FROM  titles t
                      INNER JOIN studios s ON t.studio_id = s.studio_id
                      INNER JOIN languages l ON t.language_id = l.language_id
                      INNER JOIN title_actors ta ON t.title_id = ta.title_id
                      INNER JOIN actors a ON ta.actor_id = a.actor_id
                      INNER JOIN title_people tp ON t.title_id = tp.title_id
                      INNER JOIN people p ON tp.person_id = p.person_id
                      LEFT JOIN directors d ON p.person_id = d.person_id
                      LEFT JOIN people dp ON d.person_id = dp.person_id
                      LEFT JOIN crew c ON p.person_id = c.person_id
                      LEFT JOIN people cp ON c.person_id = cp.person_id
                      LEFT JOIN genres g ON t.title_id = g.title_id
                      LEFT JOIN reviews r ON t.title_id = r.title_id
                      WHERE t.title_id = ?";

            $stmt = mysqli_prepare($conn, $sql_get);
            mysqli_stmt_bind_param($stmt, "i", $title_id);
            if (!mysqli_stmt_execute($stmt))
            {
                die("Execution failed: ".mysqli_stmt_error($stmt));
            }
            $result2 = mysqli_stmt_get_result($stmt);
            if ($result2) {

                $rows = array();
                while ($row = mysqli_fetch_assoc($result2)) {
                    $rows[] = $row;
                }
                $response = array( 
                    "status"=> "success",
                    "timestamp"=> microtime(true) *1000,
                    "data"=>$rows
                    );
                    header("Content-Type: application/json");
            }
            mysqli_close($conn);      

            foreach ($response['data'] as &$item) {
                $item['actor_names'] = explode(', ', $item['actor_names']);
                $item['crew'] = explode(', ', $item['crew']);
                $item['reviews'] = explode(', ', $item['reviews']);
                $item['genres'] = explode (',' , $item['genres']);
            }
            $json = json_encode($response);
            echo $json; 
        }
        else
        {
            $error_response = array( 
                "status"=> "error",
                "timestamp"=> microtime(true) * 1000,
                "data"=> "Post parameters are missing/incorrect"   
                );
                header("Content-Type: application/json");
                echo json_encode($error_response);
        }
    }

    public function GetAllTitles()
    {   
        $json_data = file_get_contents("php://input");
        $request_data = json_decode($json_data, true);
        if ($request_data !== null)
        {   
            $limit = isset($request_data["limit"]) ? $request_data["limit"] : null;
            $sort = isset($request_data["sort"]) ? $request_data["sort"] : null;
            $order = isset($request_data["order"]) ? $request_data["order"] : null;
            $search = isset($request_data["search"]) ? $request_data["search"] : null;

            if ($limit==null && $sort==null && $order==null && $search==null) 
            {
                $error_response = array( 
                "status"=> "error",
                "timestamp"=> microtime(true) * 1000,
                "data"=> "Required parameters missing"   
                );
                header("Content-Type: application/json");
                echo json_encode($error_response);
                return;
            }

            $conn = mysqli_connect(DB_SERVER, DB_USER, DB_PASSWORD, DB_NAME);
            if (!$conn) 
            {
                die("Connection failed: " . mysqli_connect_error());
            }

            $sql_fin = "SELECT title_id FROM titles";

            if(!(empty($search)))
            {   
                foreach ($search as $column => $value) {

                    $escapedColumn = mysqli_real_escape_string($conn, $column);
                    $escapedValue = mysqli_real_escape_string($conn, $value);
                
                    $condition = "$escapedColumn LIKE '%$escapedValue%'";
                
                    $conditions[] = $condition;
                }
                $whereClause = implode(" AND ", $conditions);
                $sql_fin .= " WHERE $whereClause";
            }

            if(!(empty($sort)))
            {

                $sql_fin=$sql_fin." GROUP BY $sort";
                

                if(!(empty($order)))
                {
                    if (strcasecmp($order, "ASC") === 0 || strcasecmp($order, "DESC") === 0)
                    {
                        $sql_fin=$sql_fin." ORDER BY $sort $order";
                    }
                    else
                    {
                        $error_response = array( 
                            "status" => "error",
                            "timestamp" => microtime(true) * 1000,
                            "data" => "Order parameters are incorrect"   
                        );   
                    }
                }
            }

            if (!empty($limit)) {
                $sql_fin .= " LIMIT ?";
            }
            $stmt = mysqli_prepare($conn, $sql_fin);
            if (!empty($limit)) {
                mysqli_stmt_bind_param($stmt, "i", $limit);
            }
            mysqli_stmt_execute($stmt);
            $result2 = mysqli_stmt_get_result($stmt);
            if ($result2) {

                $rows = array();
            
                while ($row = mysqli_fetch_assoc($result2)) {
                    $rows[] = $row;
                }

                function prepend_t($str) {
                    return "t." . $str;
                }
                  
                $titles = [];
                foreach ($rows as $row) 
                {
                    
                    $title_id= $row['title_id'];
                    $sql_get="SELECT  t.*,  s.name AS studio_name,  l.name AS language_name, 
                    GROUP_CONCAT(DISTINCT CONCAT(a.first_name, ' ', a.last_name) ORDER BY a.first_name ASC SEPARATOR ', ') AS actor_names,
                    GROUP_CONCAT(DISTINCT CONCAT(dp.first_name, ' ', dp.last_name) ORDER BY dp.first_name ASC SEPARATOR ', ') AS director,
                    GROUP_CONCAT(DISTINCT CONCAT(cp.first_name, ' ', cp.last_name) ORDER BY cp.first_name ASC SEPARATOR ', ') AS crew,
                    GROUP_CONCAT(DISTINCT r.review ORDER BY r.review ASC SEPARATOR ', ') AS reviews,
                    GROUP_CONCAT(DISTINCT g.genre ORDER BY g.genre ASC SEPARATOR ', ') AS genres
                    FROM  titles t
                    INNER JOIN studios s ON t.studio_id = s.studio_id
                    INNER JOIN languages l ON t.language_id = l.language_id
                    INNER JOIN title_actors ta ON t.title_id = ta.title_id
                    INNER JOIN actors a ON ta.actor_id = a.actor_id
                    INNER JOIN title_people tp ON t.title_id = tp.title_id
                    INNER JOIN people p ON tp.person_id = p.person_id
                    LEFT JOIN directors d ON p.person_id = d.person_id
                    LEFT JOIN people dp ON d.person_id = dp.person_id
                    LEFT JOIN crew c ON p.person_id = c.person_id
                    LEFT JOIN people cp ON c.person_id = cp.person_id
                    LEFT JOIN genres g ON t.title_id = g.title_id
                    LEFT JOIN reviews r ON t.title_id = r.title_id
                    WHERE t.title_id = $title_id";

                    $result = $conn->query($sql_get);
                    
                    $res = [];
                    if ($result->num_rows > 0) {
                        while ($resrow = $result->fetch_assoc()) {
                            $res[] = $resrow;
                        }
                    }
                    $titles[]=$res;
                }
                $response = array( 
                    "status"=> "success",
                    "timestamp"=> microtime(true) *1000,
                    "data"=>$titles
                    );
                    header("Content-Type: application/json");
                    echo json_encode($response);
            }
            mysqli_close($conn);
        }
        else
        {
            $error_response = array( 
                "status"=> "error",
                "timestamp"=> microtime(true) * 1000,
                "data"=> "Post parameters are missing/incorrect"   
                );
                header("Content-Type: application/json");
                echo json_encode($error_response);            
        }
    }

    public function GetLanguages()
    {
        $json_data = file_get_contents("php://input");
        $data = json_decode($json_data, true);
        $conn = mysqli_connect(DB_SERVER, DB_USER, DB_PASSWORD, DB_NAME);
        if (!$conn) 
        {
            die("Connection failed: " . mysqli_connect_error());
        }

        if ($data!==null)
        {
           // $title_id = isset($request_data["title_id"]) ? $request_data["title_id"] : null;

            $sql_language = "SELECT name FROM languages";
            $result = mysqli_query($conn, $sql_language);
            $languages = array();
            while ($row = mysqli_fetch_assoc($result)) 
            {
                $languages[] = $row['name'];
            }
            if (empty($languages) )
            {
                $error_response = array(
                    "status" => "error",
                    "timestamp" => microtime(true) * 1000,
                    "data" => "Language not found"
                );
                header("Content-Type: application/json");
                echo json_encode($error_response);
                return;
            }
            else
            {
                $result = array(
                "status" => "success",
                "timestamp" => time(),
                "data" => array(
                    "language" => $languages
                )
            );
            http_response_code(200);
            header('Content-Type: application/json');
            echo json_encode($result);
        }
        }


    }

    public function GetGenres()
    {
        $json_data = file_get_contents("php://input");
        $data = json_decode($json_data, true);
        $conn = mysqli_connect(DB_SERVER, DB_USER, DB_PASSWORD, DB_NAME);
        if (!$conn) 
        {
            die("Connection failed: " . mysqli_connect_error());
        }

        if ($data!==null)
        {
           // $title_id = isset($request_data["title_id"]) ? $request_data["title_id"] : null;

            $sql_genre = "SELECT DISTINCT genre FROM genres";
            $result = mysqli_query($conn, $sql_genre);
            $genres = array();
            while ($row = mysqli_fetch_assoc($result)) 
            {
                $genres[] = $row['genre'];
            }
            if (empty($genres) )
            {
                $error_response = array(
                    "status" => "error",
                    "timestamp" => microtime(true) * 1000,
                    "data" => "Genres not found"
                );
                header("Content-Type: application/json");
                echo json_encode($error_response);
                return;
            }
            else
            {
                $result = array(
                "status" => "success",
                "timestamp" => time(),
                "data" => array(
                    "genres" => $genres
                )
            );
            http_response_code(200);
            header('Content-Type: application/json');
            echo json_encode($result);
        }
        }


    }

    public function Register()
    {
        $json_data = file_get_contents("php://input");
        $request_data = json_decode($json_data, true);
        $conn = mysqli_connect(DB_SERVER, DB_USER, DB_PASSWORD, DB_NAME);
        if (!$conn) 
        {
            die("Connection failed: " . mysqli_connect_error());
        }
        if ($request_data !== null)
        {   
            $password = isset($request_data["password"]) ? $request_data["password"] : null;
            $first_name = isset($request_data["first_name"]) ? $request_data["first_name"] : null;
            $last_name = isset($request_data["last_name"]) ? $request_data["last_name"] : null;
            $email = isset($request_data["email"]) ? $request_data["email"] : null;
            $dob = isset($request_data["dob"]) ? $request_data["dob"] : null;

            if (empty($first_name) || empty($last_name) || empty($email) || empty($password)) {
                http_response_code(400);
                echo json_encode(array("error" => "All fields are required"));
                return;
            }


            if (strlen($first_name)>50 || strlen($last_name)>50 || strlen($email)>50 || strlen($password)>55) {
                http_response_code(400);
                echo json_encode(array("error" => "Character length exceeded"));
                return;
            }

            if ((!preg_match("/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/", $email)) || (!filter_var($email, FILTER_VALIDATE_EMAIL)) ) {
                http_response_code(400);
                echo json_encode(array("error" => "Invalid Email"));
                return;
            }
            if (!(preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[^a-zA-Z0-9\s]).{8,}$/', $password))) {
                http_response_code(400);
                echo json_encode(array("error" => "Invalid Password"));
                return;
            }

            $sql_check_email = "SELECT COUNT(*) AS count FROM users WHERE email = ?";
            $stmt = mysqli_prepare($conn, $sql_check_email);
            mysqli_stmt_bind_param($stmt, "s", $email);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_bind_result($stmt, $count);
            mysqli_stmt_fetch($stmt);
            if ($count > 0) 
            {
                $error_response = array(
                    "status" => "error",
                    "timestamp" => microtime(true) * 1000,
                    "data" => "Email already registered"
                );
                header("Content-Type: application/json");
                echo json_encode($error_response);
                return;
            } 
            mysqli_stmt_close($stmt);

            $salt=bin2hex(random_bytes(10));
            $salted_password=$salt.$password;
            $hashed_password = password_hash($salted_password, PASSWORD_BCRYPT);
            do {
                $api_key = bin2hex(random_bytes(10));
                $sql = "SELECT COUNT(api_key) AS count FROM users WHERE api_key = '$api_key'";
                $result = mysqli_query($conn, $sql);
                $row = mysqli_fetch_assoc($result);
            } while ($row['count'] > 0);

            $sql = "INSERT INTO users (first_name, last_name, dob, email, salt, password,api_key) VALUES (?, ?, ?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sssssss", $first_name, $last_name, $dob,$email, $salt,$hashed_password, $api_key);
            if (!($stmt->execute())) {
                echo "Error: " . $stmt->error;
            }else{
                echo json_encode(array("status" => "success"));
            }
            $stmt->close();
            $conn->close();
        }
        else
        {
            $error_response = array( 
                "status"=> "error",
                "timestamp"=> microtime(true) * 1000,
                "data"=> "Post parameters are missing/incorrect"   
                );
                header("Content-Type: application/json");
                echo json_encode($error_response);
        }
    }

    public function Login()
    {   
        $json_data = file_get_contents("php://input");
        $request_data = json_decode($json_data, true);
        $conn = mysqli_connect(DB_SERVER, DB_USER, DB_PASSWORD, DB_NAME);
        if (!$conn) 
        {
            die("Connection failed: " . mysqli_connect_error());
        }
        if ($request_data !== null)
        {   
            $password = isset($request_data["password"]) ? $request_data["password"] : null;
            $email = isset($request_data["email"]) ? $request_data["email"] : null;

            $sql_salt = "SELECT salt,password,api_key FROM users WHERE email=?";
            $stmt = mysqli_prepare($conn, $sql_salt);
            mysqli_stmt_bind_param($stmt, "s", $email); 
            mysqli_stmt_execute($stmt);
            $stmt->bind_result($salt,$stored_hash,$api_key);
            $stmt->fetch();
            $password=$salt.$password;
            $stmt->close();

            if (password_verify($password, $stored_hash))
            {
                $response_data = array(
                    "status" => "success",
                    "timestamp" => microtime(true) * 1000, 
                    "data" => array(
                        "apikey" => $api_key
                    )
                );

                header("Content-Type: application/json");
                echo json_encode($response_data);
                return;
            }
            else
            {
                $error_response = array( 
                    "status"=> "error",
                    "timestamp"=> microtime(true) * 1000,
                    "data"=> "Email/Password incorrect"   
                    );
                    header("Content-Type: application/json");
                    echo json_encode($error_response);
                    return;
            }
        }
        else
        {
            $error_response = array( 
                "status"=> "error",
                "timestamp"=> microtime(true) * 1000,
                "data"=> "Post parameters are missing/incorrect"   
                );
                header("Content-Type: application/json");
                echo json_encode($error_response);
        }
    }

    public function getStudios()
    {
        $json_data = file_get_contents("php://input");
        $request_data = json_decode($json_data, true);
        $conn = mysqli_connect(DB_SERVER, DB_USER, DB_PASSWORD, DB_NAME);

        if (!$conn) 
        {
            die("Connection failed: " . mysqli_connect_error());
        }

        
        $querystudio = "SELECT * from studios";

        $result = $conn->query($querystudio);

        $res = [];
        if ($result->num_rows > 0) 
        {
            while ($resrow = $result->fetch_assoc()) 
            {
                $res[] = $resrow;
            }
        }

        $titles[]=$res;

        $response = array( 
            "status"=> "success",
            "timestamp"=> microtime(true) *1000,
            "data"=>$titles
            );

            header("Content-Type: application/json");
            echo json_encode($response);

        	mysqli_close($conn);


    }

}

    


$database = Database::instance();
if ($_SERVER["REQUEST_METHOD"] === "POST") {
     
    $json_data = file_get_contents("php://input");

    $request_data = json_decode($json_data, true);
    if ($request_data !== null)
    {   
        if ($request_data["type"] === "Register") {
            $database->Register();
            return;
        }
        if ($request_data["type"] === "Login") {
            $database->Login();
            return;
        }
        
        $api_key = isset($request_data["api_key"]) ? $request_data["api_key"] : null;

        if($api_key === null)
        {
            $error_response = array( 
                "status"=> "error",
                "timestamp"=> microtime(true) * 1000,
                "data"=> "API key missing"   
                );
                header("Content-Type: application/json");
                echo json_encode($error_response);
                return;
        }

        $conn = mysqli_connect(DB_SERVER, DB_USER, DB_PASSWORD, DB_NAME);
        if (!$conn) 
        {
            die("Connection failed: " . mysqli_connect_error());
        }

        $sql_check_key = "SELECT COUNT(*) AS count FROM users WHERE api_key = ?";
        $stmt = mysqli_prepare($conn, $sql_check_key);
        mysqli_stmt_bind_param($stmt, "s", $api_key);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $count);
         mysqli_stmt_fetch($stmt);
        if ($count == 0) 
        {
            $error_response = array(
                "status" => "error",
                "timestamp" => microtime(true) * 1000,
                "data" => "API key not found"
            );
            header("Content-Type: application/json");
            echo json_encode($error_response);
            return;
        } 
        mysqli_stmt_close($stmt);

        if($request_data["type"] === "studios")
        {
            $database->getStudios();
            return;
        }

        if($request_data["type"] === "GetTitle")
        {
            $database->GetTitle();
            return;
        }

        if($request_data["type"] === "GetGenres")
        {
            $database->GetGenres();
            return;
        }

        if($request_data["type"] === "GetLanguages")
        {
            $database->GetLanguages();
            return;
        }

        if($request_data["type"] === "GetAllTitles")
        {
            $database->GetAllTitles();
            return;
        }

        $sql_check_admin = "SELECT is_admin FROM users WHERE api_key = ?";
        $stmt = mysqli_prepare($conn, $sql_check_admin);
        mysqli_stmt_bind_param($stmt, "s", $api_key); 
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $isadmin);
        mysqli_stmt_fetch($stmt);
        if($isadmin==0)
        {
            $error_response = array( 
                "status"=> "error",
                "timestamp"=> microtime(true) * 1000,
                "data"=> "User not admin"   
                );
                header("Content-Type: application/json");
                echo json_encode($error_response); 
                return;            
        }
        mysqli_stmt_close($stmt);


        if ($request_data["type"] === "AddTitle") {
            $database->AddTitle();
        }
        else if($request_data["type"] === "RemoveTitle")
        {   
            $database->RemoveTitle();
        }
        else if($request_data["type"] === "UpdateTitle")
        {
            $database->UpdateTitle();
        }
        

        else
        {
            $error_response = array( 
                "status"=> "error",
                "timestamp"=> microtime(true) * 1000,
                "data"=> "Post type parameters are missing/incorrect"   
                );
                header("Content-Type: application/json");
                echo json_encode($error_response);  
                return;
        }
    }  
}


?>