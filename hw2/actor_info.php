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
            $aid = $_GET["aid"];
            if (!empty($aid)) {
                $db_connection = mysql_connect ("localhost", "cs143", "")
                    or die ("Error connecting: ".mysql_error());

                mysql_select_db ("CS143", $db_connection)
                    or die ("Error selecting database: ".mysql.error());

                // Actor Info
                $query = "SELECT * FROM Actor WHERE id = $aid";
                $rs = mysql_query($query, $db_connection)
                    or die ("Error querying: ".mysql_error());
                $row = mysql_fetch_row($rs);

                echo "<h3>$row[2] $row[1]</h3>";
                echo "Sex: $row[3]<br><br>";
                echo "DOB: $row[4]<br><br>";
                echo "DOD: ", (is_null($dod) ? "N/A" : "$row[5]"), "<br><br>";

                // Related movies
                $query = "SELECT title, year, mid, role FROM Movie, MovieActor WHERE aid = $aid AND id = mid ORDER BY year";
                $rs = mysql_query($query, $db_connection)
                    or die ("Error querying: ".mysql_error());

                echo "<h3>Had a Role in:</h3>";
                echo "<table>";
                echo "<tr>";
                echo "<th>Role</th>";
                echo "<th>Movie</th>";
                echo "</tr>";

                while ($row = mysql_fetch_row($rs)) {
                    echo "<tr>";
                    echo "<td>$row[3]</td>";
                    echo "<td><a href=\"./movie_info.php?mid=$row[2]\">$row[0] ($row[1])</a></td>";
                    echo "</tr>";
                }
                echo "</table>"; 
                mysql_free_result($rs);
                mysql_close($db_connection);
            } 
        ?>
    </div>
</body>
</html>