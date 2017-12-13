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

    <h3>Add Comment</h3>

    <div>
        <form action="add_comment.php" method="GET">
            Name:<br>
            <input type="text" name="name" value="Villager A" maxlength="20"><br><br>
            Movie:<br>
            <select name="mid">
            <?php
                $db_connection = mysql_connect ("localhost", "cs143", "")
                    or die ("Error connecting: ".mysql_error());

                mysql_select_db ("CS143", $db_connection)
                    or die ("Error selecting database: ".mysql.error());

                // Query movies for option
                $query = "SELECT * FROM Movie ORDER BY title";
                $rs = mysql_query ($query, $db_connection)
                    or die ("Error querying: ".mysql_error());
                $mid = $_GET["mid"];
                while ($row = mysql_fetch_row($rs)) {
                    // There is a movie in url
                    if (!is_null(mid) && $mid == $row[0])
                        echo "<option value=\"$row[0]\" selected>", $row[1], " (", $row[2], ")</option>";
                    // There is not
                    else
                        echo "<option value=\"$row[0]\">", $row[1], " (", $row[2], ")</option>";
                }
                mysql_free_result($rs);
                mysql_close($db_connection);
            ?>
            </select><br><br>
            Rating:<br>
            <select name="rating">
                <option value="5">5</option>
                <option value="4">4</option>
                <option value="3">3</option>
                <option value="2">2</option>
                <option value="1">1</option>
            </select><br><br>
            Comment:<br>
            <textarea name="comment" maxlength="500" cols="80" rows="8"></textarea><br><br>
            <input type="submit" class="add_btn" value="Add"/>
        </form>
    </div>

    <?php
        $name = $_GET["name"];
        $mid = $_GET["mid"];
        $rating = $_GET["rating"];
        $comment = $_GET["comment"];

        if (!empty($name)) {
            $db_connection = mysql_connect ("localhost", "cs143", "")
                or die ("Error connecting: ".mysql_error());

            mysql_select_db ("CS143", $db_connection)
                or die ("Error selecting database: ".mysql.error());

            $name = mysql_real_escape_string($name);
            $mid = (int)$mid;
            $rating = (int)$rating;
            $comment = mysql_real_escape_string($comment);

            // Insert into Review
            $query = empty($comment) ? "INSERT INTO Review VALUES ('$name', NOW(), '$mid', '$rating', NULL)" 
                                    : "INSERT INTO Review VALUES ('$name', NOW(), '$mid', '$rating', '$comment')";
            $rs = mysql_query ($query, $db_connection)
                or die ("Error querying: ".mysql_error());
            mysql_free_result($rs);
            mysql_close($db_connection);
        }
    ?>
</body>
</html>