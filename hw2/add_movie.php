<html>
<head>
    <title>CS143 Project 1B</title>
    <link type="text/css" rel="stylesheet" href="./main.css"/> 
</head>

<body>
    <div class="navbar">
        <a href="./main.html">Project 1B</a>
        <div class="dropdown">
            <button class="drop_btn" onclick="show_add()">Adding to Database</button>
            <div class="drop_content" id="my_add">
                <a href="./add_actor_director.php">Add Actor/Director</a>
                <a href="./add_movie.php">Add Movie</a>
                <a href="./add_comment.php">Add Comment</a>
                <a href="./add_actor-movie.php">Add Actor-Movie</a>
                <a href="./add_director-movie.php">Add Director-Movie</a>
            </div>
        </div>

        <div class="search">
            <form action="./search.php" method="GET">
                <input class="search_box" type="text" name="input" placeholder="Your favorite Actor/Actress/Movie">
                <input class="search_btn" type="submit" value="search"/>
            </form>
        </div>
    </div>
    <script src="./main.js"></script>
    <h3>Add Movie</h3>

    <div>
        <form action="./add_movie.php" method="GET">
            Title:<br>
            <input type="text" name="title" maxlength="100"><br><br>
            Company:<br>
            <input type="text" name="company" maxlength="50"><br><br>
            Year:<br>
            <input type="text" name="year" maxlength="4"><br><br>
            MPAA Rating:<br>
            <select name="rating">
                <option value="G">G</option>
                <option value="NC-17">NC-17</option>
                <option value="PG">PG</option>
                <option value="PG-13">PG-13</option>
                <option value="R">R</option>
                <option value="surrendere">surrendere</option>
            </select><br><br>
            Genre:
            <table>
                <tr>
                    <td><input type="checkbox" name="genre[]" value="Action">Action</td>
                    <td><input type="checkbox" name="genre[]" value="Adult">Adult</td>
                    <td><input type="checkbox" name="genre[]" value="Adventure">Adventure</td>
                    <td><input type="checkbox" name="genre[]" value="Animation">Animation</td>
                    <td><input type="checkbox" name="genre[]" value="Comedy">Comedy</td>
                </tr>
                <tr>
                    <td><input type="checkbox" name="genre[]" value="Crime">Crime</td>
                    <td><input type="checkbox" name="genre[]" value="Documentary">Documentary</td>
                    <td><input type="checkbox" name="genre[]" value="Drama">Drama</td>
                    <td><input type="checkbox" name="genre[]" value="Family">Family</td>
                    <td><input type="checkbox" name="genre[]" value="Fantasy">Fantasy</td>
                </tr>
                <tr>
                    <td><input type="checkbox" name="genre[]" value="Horror">Horror</td>
                    <td><input type="checkbox" name="genre[]" value="Musical">Musical</td>
                    <td><input type="checkbox" name="genre[]" value="Mystery">Mystery</td>
                    <td><input type="checkbox" name="genre[]" value="Romance">Romance</td>
                    <td><input type="checkbox" name="genre[]" value="Sci-Fi">Sci-Fi</td>
                </tr>
                <tr>
                    <td><input type="checkbox" name="genre[]" value="Short">Short</td>
                    <td><input type="checkbox" name="genre[]" value="Thriller">Thriller</td>
                    <td><input type="checkbox" name="genre[]" value="War">War</td>
                    <td><input type="checkbox" name="genre[]" value="Western">Western</td>
                </tr>
            </table><br><br>
            <input type="submit" class="add_btn" value="Add"/>
        </form>
    </div>

    <?php
        $title = $_GET["title"];
        $company = $_GET["company"];
        $year = $_GET["year"];
        $rating = $_GET["rating"];
        $genre = $_GET["genre"];

        if (!empty($title) && !empty($company) && !empty($year)) {
            $db_connection = mysql_connect ("localhost", "cs143", "")
                or die ("Error connecting: ".mysql_error());

            mysql_select_db ("CS143", $db_connection)
                or die ("Error selecting database: ".mysql.error()); 
                
            $title = mysql_real_escape_string($title);
            $company = mysql_real_escape_string($company);
            $year = (int)($year);

            // Generate id
            mysql_query ("UPDATE MaxMovieID SET id = id + 1", $db_connection)
                or die ("Error querying: ".mysql_error());
            $rs = mysql_query ("SELECT id FROM MaxMovieID", $db_connection)
                or die ("Error querying: ".mysql_error());
            $row = mysql_fetch_row($rs);
            $id = $row[0];
            
            // Insert to Movie and MovieGenre
            $query = "INSERT INTO Movie VALUES ($id, '$title', '$year', '$rating', '$company')";
            $rs = mysql_query ($query, $db_connection)
                or die ("Error querying: ".mysql_error());

            for ($i = 0; $i < count($genre); $i++ ) {
                $query = "INSERT INTO MovieGenre VALUES ($id, '$genre[$i]')";
                $rs = mysql_query ($query, $db_connection)
                    or die ("Error querying: ".mysql_error());
            }
            mysql_free_result($rs);
            mysql_close($db_connection);
        }
    ?>
</body>
</html>