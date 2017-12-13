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
    <div>
    <?php
        $mid = $_GET["mid"];
        if (!empty($mid)) {
            $db_connection = mysql_connect ("localhost", "cs143", "")
                or die ("Error connecting: ".mysql_error());

            mysql_select_db ("CS143", $db_connection)
                or die ("Error selecting database: ".mysql.error());

            // Movie Info
            $query = "SELECT * FROM Movie WHERE id = $mid";
            $rs = mysql_query($query, $db_connection)
                or die ("Error querying: ".mysql_error());
            $row = mysql_fetch_row($rs);

            echo "<h3>$row[1] ($row[2])</h3>";
            echo "Rating: $row[3]<br><br>";
            echo "Company: $row[4]<br><br>";

            // Related Actors
            $query = "SELECT id, first, last, role FROM Actor, MovieActor WHERE mid = $mid AND id = aid ORDER BY first";
            $rs = mysql_query($query, $db_connection)
                or die ("Error querying: ".mysql_error());

            echo "<h3>Starred:</h3>";
            echo "<table>";
            echo "<tr>";
            echo "<th>Actor</th>";
            echo "<th>Role</th>";
            echo "</tr>";

            while ($row = mysql_fetch_row($rs)) {
                echo "<tr>";
                echo "<td><a href=\"./actor_info.php?aid=$row[0]\">$row[1] $row[2]</a></td>";
                echo "<td>$row[3]</td>";
                echo "</tr>";
            }
            echo "</table><br><br>";
            
            // Comment
            echo "<h3>Comment:</h3>";
            echo "<a href=\"./add_comment.php?mid=$mid\">Rate this Movie!</a><br>";
            $query = "SELECT AVG(rating), COUNT(rating) FROM Review WHERE mid = $mid";
            $rs = mysql_query($query, $db_connection)
                or die ("Error querying: ".mysql_error());
            $row = mysql_fetch_row($rs);
            echo ($row[0] == 0) ? "Average Score: N/A<br>" : "Average Score: $row[0]/5 from $row[1] review(s)<br>";

            $query = "SELECT name, time, rating, comment FROM Review WHERE mid = $mid ORDER BY time DESC";
            $rs = mysql_query($query, $db_connection)
                or die ("Error querying: ".mysql_error());
            while ($row = mysql_fetch_row($rs))
                echo "<br>$row[0] gave a $row[2] on $row[1]", (is_null($row[3]) ? "<br>" : " with a comment:<br><div class=\"comment\">$row[3]</div><br>");         
            mysql_free_result($rs);
            mysql_close($db_connection);
        }
    ?>
    </div>
</body>
</html>