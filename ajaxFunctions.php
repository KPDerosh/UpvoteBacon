<?php
    /* if this is an ajax.*/
    if (is_ajax()) {
        /*if the action is set to call a method call it.*/
        if (isset($_POST["action"]) && !empty($_POST["action"])) { //Checks if action value exists
            $action = $_POST["action"];
            /* switch statement for calling methods.*/
            switch($action) { 
                case "updatePageLoad": updatePageLoad(); break;
                case "upvoteChewy": upvoteChewy(); break;
                case "upvoteCrispy": upvoteCrispy(); break;
                case "getStats" : getStats(); break;
            }
        }
    }

    //Function to check if the request is an AJAX request
    function is_ajax() {
        return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest';
    }

    /*get the summoners league that was passed in.*/
    function updatePageLoad(){
        $dbhost = 'localhost';
        $dbuser = 'kderosha';
        $dbpass = 'ilovebacon';
        $connection = mysql_connect($dbhost, $dbuser, $dbpass);
        if(!$connection){
            die('Could not connect: '.mysql_error());
        }
        mysql_select_db('bacon', $connection) or die('Could not select database');
        mysql_query("UPDATE upvotes SET page_loads = page_loads + 1");
        mysql_close($connection);
    }

    function upvoteChewy(){
        $dbhost = 'localhost';
        $dbuser = 'kderosha';
        $dbpass = 'ilovebacon';
        echo "Variables Set";
        $connection = mysql_connect($dbhost, $dbuser, $dbpass);
        echo "Connected to db.";
        if(!$connection){
            die('Could not connect: '.mysql_error());
        }
        echo "Made it passed error.";
        mysql_select_db('bacon', $connection) or die('Could not select database');
        echo "Selected dbBacon";
        mysql_query("UPDATE upvotes SET chewy_upvotes = chewy_upvotes + 1");
        mysql_close($connection);
    }

    function upvoteCrispy(){
        $dbhost = 'localhost';
        $dbuser = 'kderosha';
        $dbpass = 'ilovebacon';
        echo "Variables Set";
        $connection = mysql_connect($dbhost, $dbuser, $dbpass);
        echo "Connected to db.";
        if(!$connection){
            die('Could not connect: '.mysql_error());
        }
        echo "Made it passed error.";
        mysql_select_db('bacon', $connection) or die('Could not select database');
        echo "Selected dbBacon";
        mysql_query("UPDATE upvotes SET crispy_upvotes = crispy_upvotes + 1");
        mysql_close($connection);
    }

    function getStats(){
        header("Content-type: application/json");

         //Get the result with upvotes;
        $servername = "localhost";
        $username = "kderosha";
        $password = "ilovebacon";
        $dbname = "bacon";
        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        } 

        $sql = "SELECT page_loads, chewy_upvotes, crispy_upvotes FROM upvotes";
        $result = $conn->query($sql);
        $chewyUpvotes;
        $crispyUpvotes;
        $page_loads;
        if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
                $chewyUpvotes = $row["chewy_upvotes"];
                $cripsyUpvotes = $row["crispy_upvotes"];
                $page_loads = $row["page_loads"];
            }
        } else {
            echo "0 results";
        }
        $conn->close();
        $json = "{";
        $json = $json.'"page_loads":'.$page_loads.',';
        $json = $json.'"chewy":'.$chewyUpvotes.',';
        $json = $json.'"crispy":'.$cripsyUpvotes;
        $json = $json.'}';
        $data = json_encode($json);
        echo $data;
    }
?>
