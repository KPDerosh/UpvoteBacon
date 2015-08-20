<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Upvote The Bacon</title>

    <!-- custom css!-->
    <link rel="stylesheet" href="./css/index.css">
    <!-- Bootstrap !-->
    <link rel="stylesheet" href="./css/bootstrap.min.css">
    <!-- jQuery !-->
    <script src="http://ajax.aspnetcdn.com/ajax/jQuery/jquery-1.11.2.min.js"></script>
    <!--Powertip javascript!-->
    <link rel="stylesheet" type="text/css" href="./css/jquery.powertip.css">
    <script src="./js/jquery.powertip.js"></script>
</head>

<body class="body">
    <div style=" width:75%; margin:auto; background-color:#FFFFFF">
        <!--Navigation bar !-->
        <nav class="navbar navbar-default navbar-top" style="display:inline-block;width:100%; margin:auto; margin-bottom:20px;">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#">Upvote Teh Bacon</a>
                </div>
                <div id="navbar" class="navbar-collapse collapse">
                    <ul class="nav navbar-nav">
                        <li class="active"><a href="./index.php">Upvote</a></li>
                        <li><a href="./stats.php">Bacon Statistics</a></li>
                        <li><a href="./donate.php">Donate</a></li>
                    </ul>
                </div>
            </div>
        </nav>
        
        <div id="webpageContentDiv" class="webpageContent">  
            <!-- A blurb about the site telling whats going on.!-->
            <div id="siteBlurb" class="baconQuestion">
                Which type of bacon do you prefer?
                <hr style="border-color: #536DFE">
            </div>

            <!-- Vs table that displays chewy vs crispy nicely!-->
            <table id="vs" class="vsContent">
                <tr>
                    <th onclick="upvoteChewy()" class="chewyInfoHeader">
                        Chewy
                    </th>
                    <th style="font-size:3em; text-align:center;">
                        VS
                    </th>
                    <th onclick="upvoteCrispy()" class="crispyInfoHeader">
                        Crispy
                    </th>
                </tr>
            </table>
        </div>
    </div>
    <!-- JAVASCRIPT FOR THE PAGE !-->
    <script>
        $(document).ready(function(){
            castVote();
            //Get all of the tooltips ready throughout the page once it is loaded.
            $('.upvoteText').powerTip({
                followMouse: 'true'
            }).data('powertip', '<div style="width:450px">Click "Cast Vote" to bring up the voting menu. Then choose which team.');
            $('.upvoteChewy').powerTip({
                followMouse: 'true'
            }).data('powertip', '<div>Upvote Chewy!!!!</div>');
            $('.upvoteCrispy').powerTip({
                followMouse: 'true'
            }).data('powertip', '<div>Upvote Cripsy!!!!</div>');
        });

        /*
        Method to show the upvote table and update the number of times voteing was initiated.
        */
        function castVote(){
            //Load the vote table and load that in the db.
            $.ajax({
                type: "POST",
                dataType: "json",
                url: "ajaxFunctions.php", //Relative or absolute path to response.php file
                data:  { action: 'updatePageLoad' },
                success: function(data) {
                }, 
                async:false
            });
        }

        /*
        Method to increase the number of chewy upvotes.
        */
        function upvoteChewy(){
            $.ajax({
                type: "POST",
                dataType: "json",
                url: "ajaxFunctions.php", //Relative or absolute path to response.php file
                data:  { action: 'upvoteChewy' },
                success: function(data) {

                },
                async:false
            });
            window.location.replace("./stats.php");
        }

        /*
        Method to increase the number of crispy upvotes.
        */
        function upvoteCrispy(){
            $.ajax({
                type: "POST",
                dataType: "json",
                url: "ajaxFunctions.php", //Relative or absolute path to response.php file
                data:  { action: 'upvoteCrispy' },
                success: function(data) {
                }, async:false
            });
            window.location.replace("./stats.php");
            
        }
    </script>
    <script src="./js/bootstrap.min.js"></script>
</body>
</html>
