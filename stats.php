<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <title>Upvote Statistics</title>
    <!--Local Includes!-->
    <link rel="stylesheet" href="./css/index.css">
    <link rel="stylesheet" href="./css/stats.css">
    <script src="./css/charts/Chart.Core.js"></script>
    <script src="./css/charts/Chart.Doughnut.js"></script>

    <!-- Bootstrap and jquery includes!-->
    <link rel="stylesheet" href="./css/bootstrap.min.css">
    <script src="http://ajax.aspnetcdn.com/ajax/jQuery/jquery-1.11.2.min.js"></script>
    
    <!--Power tip includes !-->
    <link rel="stylesheet" type="text/css" href="./css/jquery.powertip.css">
    <script src="./js/jquery.powertip.js"></script>
</head>

<?php
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
?>
<body>
    <div id="header" class="header">
        <div id="logo" class="logo">
        <a href="./index.php">
        Upvote Bacon Dot COM</a>
        </div>
        <div id="navbarOptions" class="navbar">
            <a href="./index.php">Upvote the bacon /</a>
            <a href="./donate.php">Donate /</a>
        </div>
    </div>
   
    <table id="vs" class="vsContent">
        <tr>
            <th class="chewyInfoHeader">
                Chewy
            </th>
            <th class="crispyInfoHeader">
                Crispy
            </th>
        </tr>
        <tr >
            <td id="chewyUpvotes" class="upvotesTd">
                <?php
                    echo '<div id="chewyUpvotes">'.$chewyUpvotes.'</div>';
                ?>
            </td>
            <td class="upvotesTd">
                <?php
                    echo '<div id="crispyUpvotes">'.$cripsyUpvotes.'</div>';
                ?>
            </td>
        </tr>
         <tr>
            <td style="padding: 20px 0px 0px 0px;" colspan="2">
                <canvas id="upvoteChart" style="width:100%;"></canvas>
            </td>
        </tr>    
    </table>

    <script>
    $(document).ready(function(){
        var chewyUps = $('#chewyUpvotes').text().trim();
        var crispyUps = $('#crispyUpvotes').text().trim();
        console.log(chewyUps);
        console.log(crispyUps);
        var data = [
            {
                value: chewyUps,
                color:"#F7464A",
                highlight: "#FF5A5E",
                label: "Chewy"
            },
            {
                value: crispyUps,
                color: "#46BFBD",
                highlight: "#5AD3D1",
                label: "Crispy"
            }
        ]
        var ctx = document.getElementById("upvoteChart").getContext("2d");
        var myNewChart = new Chart(ctx).Pie(data, {
            //Boolean - Whether we should show a stroke on each segment
            segmentShowStroke : true,

            //String - The colour of each segment stroke
            segmentStrokeColor : "#fff",

            //Number - The width of each segment stroke
            segmentStrokeWidth : 2,

            //Number - The percentage of the chart that we cut out of the middle
            percentageInnerCutout : 50, // This is 0 for Pie charts

            //Number - Amount of animation steps
            animationSteps : 75,

            //String - Animation easing effect
            animationEasing : "easeOutCirc",

            //Boolean - Whether we animate the rotation of the Doughnut
            animateRotate : true,

            //Boolean - Whether we animate scaling the Doughnut from the centre
            animateScale : false,

            //String - A legend template
            legendTemplate : "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<segments.length; i++){%><li><span style=\"background-color:<%=segments[i].fillColor%>\"></span><%if(segments[i].label){%><%=segments[i].label%><%}%></li><%}%></ul>"

        });
    });
    </script>
    <script src="./js/bootstrap.min.js"></script>
</body>
</html>
