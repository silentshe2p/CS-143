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
    <h3>Add Director-Movie</h3>

    <div>
        <form action="add_director-movie.php" method="GET">
            <?php
                $db_connection = mysql_connect ("localhost", "cs143", "")
                    or die ("Error connecting: ".mysql_error());

                mysql_select_db ("CS143", $db_connection)
                    or die ("Error selecting database: ".mysql.error());
                    
                // Query directors for option
                $query = "SELECT * FROM Director ORDER BY last";
                $rs = mysql_query ($query, $db_connection)
                    or die ("Error querying: ".mysql_error());

                echo "Director:<br><select name=\"did\">";
                while ($row = mysql_fetch_row($rs))
                    echo "<option value=\"$row[0]\">", $row[1], ", ", $row[2], " (", $row[3], ")</option>";
                echo "</select><br><br>";
                mysql_free_result($rs); 

                // Query movies for option
                $query = "SELECT * FROM Movie ORDER BY title";
                $rs = mysql_query ($query, $db_connection)
                    or die ("Error querying: ".mysql_error());

                echo "Movie:<br><select name=\"mid\">";
                while ($row = mysql_fetch_row($rs))
                    echo "<option value=\"$row[0]\">", $row[1], " (", $row[2], ")</option>";
                echo "</select><br><br>";    
                mysql_free_result($rs);       
                mysql_close($db_connection);
            ?>
            <input type="submit" class="add_btn" value="Add"/>
        </form>
    </div>

    <?php
        $did = $_GET["did"];
        $mid = $_GET["mid"];
        
        if (!empty($did) && !empty($mid)) {
            $db_connection = mysql_connect ("localhost", "cs143", "")
                or die ("Error connecting: ".mysql_error());

            mysql_select_db ("CS143", $db_connection)
                or die ("Error selecting database: ".mysql.error());

            $did = (int)$did;
            $mid = (int)$mid;

            // Insert into MovieDirector
            $query = "INSERT INTO MovieDirector VALUES ('$mid', '$did')";    
            $rs = mysql_query ($query, $db_connection)
                or die ("Error querying: ".mysql_error());
            mysql_free_result($rs);
            mysql_close($db_connection); 
        }
    ?>
</body>
</html>