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
    <?php
        $input = $_GET["input"];
        if (!empty(input)) {
            $db_connection = mysql_connect ("localhost", "cs143", "")
                or die ("Error connecting: ".mysql_error());

            mysql_select_db ("CS143", $db_connection)
                or die ("Error selecting database: ".mysql.error());
            
            echo "<h3>Search result for <i>$input</i>:</h3>";
            $input = explode(" ", mysql_real_escape_string($input));
            
            // Search Actor
            $query = "SELECT * FROM Actor WHERE CONCAT(first, ' ', last) LIKE '%$input[0]%'";
            for ($i = 1; $i < count($input); $i++) {
                $query .= "AND CONCAT(first, ' ', last) LIKE '%$input[$i]%'";
            }
            $query .= " ORDER BY first";

            echo "<h3>Matching Actors:</h3>";
            $rs = mysql_query ($query, $db_connection)
                or die ("Error querying: ".mysql_error());
            
            echo "<div class=\"actor_rs\">";

            while ($row = mysql_fetch_row($rs)) {
                echo "<a href=\"actor_info.php?aid=$row[0]\">", $row[2], " ", $row[1], " (", $row[4], ")</a><br/>";
            }
            echo "</div>";

            // Search Movie
            $query = "SELECT * FROM Movie WHERE title LIKE '%$input[0]%'";
            for ($i = 1; $i < count($input); $i++) {
                $query .= "AND title LIKE '%$input[i]%'";
            }
            $query .= " ORDER BY title";

            echo "<h3>Matching Movies:</h3>";
            $rs = mysql_query ($query, $db_connection)
                or die ("Error querying: ".mysql_error());
            
            echo "<div class=\"movie_rs\">";
            // echo "<h3>Matching Movies:</h3>";
            while ($row = mysql_fetch_row($rs)) {
                echo "<a href=\"movie_info.php?mid=$row[0]\">", $row[1], " (", $row[2], ")</a><br/>";
            }
            echo "</div>";            
            mysql_free_result($rs);
            mysql_close($db_connection);
        }
    ?>
</body>
</html>