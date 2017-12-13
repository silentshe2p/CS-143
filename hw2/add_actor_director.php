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
    <h3>Add Actor/Director</h3>

    <div>
        <form action="./add_actor_director.php" method="GET">
            <input type="radio" name="catag" value="Actor" checked="true">Actor
            <input type="radio" name="catag" value="Director">Director<br><br>
            First Name:<br>
            <input type="text" name="first" maxlength="20"><br><br>
            Last Name:<br>
            <input type="text" name="last" maxlength="20"><br><br>
            <input type="radio" name="sex" value="Male" checked="true">Male
            <input type="radio" name="sex" value="Female">Female<br><br>
            DOB: (YYYY-MM-DD)<br>
            <input type="text" name="dob" maxlength="10"><br><br>
            DOD: (YYYY-MM-DD or blank)<br>
            <input type="text" name="dod" maxlength="10"><br><br>
            <input type="submit" class="add_btn" value="Add"/>
        </form>
    </div>

    <?php
        $catagory = $_GET["catag"];
        $first = $_GET["first"];
        $last = $_GET["last"];
        $sex = $_GET["sex"];
        $dob = $_GET["dob"];
        $dod = $_GET["dod"];

        if (!empty($first) && !empty($last) && !empty($dob)) {
            $db_connection = mysql_connect ("localhost", "cs143", "")
                or die ("Error connecting: ".mysql_error());

            mysql_select_db ("CS143", $db_connection)
                or die ("Error selecting database: ".mysql.error()); 
                
            $first = mysql_real_escape_string($first);
            $last = mysql_real_escape_string($last);
            $dob = mysql_real_escape_string($dob);
            if (!empty($dod))
                $dod = mysql_real_escape_string($dod);
            
            // Generate id
            mysql_query ("UPDATE MaxPersonID SET id = id + 1", $db_connection)
                or die ("Error querying: ".mysql_error());
            $rs = mysql_query ("SELECT id FROM MaxPersonID", $db_connection)
                or die ("Error querying: ".mysql_error());
            $row = mysql_fetch_row($rs);
            $id = $row[0];

            // Insert to Actor or Director
            if ($catagory == "Actor")
                $query = empty($dod) ? "INSERT INTO Actor VALUES ($id, '$last', '$first', '$sex', '$dob', NULL)" 
                                    : "INSERT INTO Actor VALUES ($id, '$last', '$first', '$sex', '$dob', '$dod')";
            else
                $query = empty($dod) ? "INSERT INTO Director VALUES ($id, '$last', '$first', '$dob', NULL)" 
                                    : "INSERT INTO Director VALUES ($id, '$last', '$first', '$dob', '$dod')";

            $rs = mysql_query ($query, $db_connection)
                or die ("Error querying: ".mysql_error());
            mysql_free_result($rs);
            mysql_close($db_connection);
        }
    ?>
</body>
</html>