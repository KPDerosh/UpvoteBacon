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

<body>
    <!-- Header for most pages.!-->
    <div id="header" class="header">
        <div id="logo" class="logo">
            <a href="./index.php">Upvote Bacon Dot COM</a>
        </div>
        <div id="navbarOptions" class="navbar">
            <a href="#upvote" onclick="castVote()">Upvote the bacon /</a>
            <a href="./donate.php">Donate /</a>
            <a href="./stats.php">Stats </a>
        </div>
    </div>

    <!-- A blurb about the site telling whats going on.!-->
    <div id="siteBlurb" class="siteBlurb">
        Ever wondered which bacon is better/more popular, crispy or chewy? We are here to find out and we need your help.
        <hr style="border-color: #536DFE">
    </div>

    <!-- Vs table that displays chewy vs crispy nicely!-->
    <table id="vs" class="vsContent">
        <tr>
            <th class="chewyInfoHeader">
                Crispy
            </th>
            <th style="font-size:3em; text-align:center;">
                VS
            </th>
            <th class="crispyInfoHeader">
                Chewy
            </th>
        </tr>
    </table>

    <!--Little bit of content telling people to vote!-->
    <div id="content" class="content">
        <p class="contentParagraph"> 
        Okay so the idea is... Do you like bacon? Well what kind of question is that.
        Well now is your chance to prove that you like bacon, nay... love bacon. Then the real
        question is. What kind of bacon do you like. For some it may be an easy question. For
        others, it will be hard. We must settle the war between crispy and chewy bacon forever now before things get out of hand. 
        </p>
        <hr style="border-color:#448AFF; width:50%">
        <div style="display:inline-block; margin:auto; width:100%;text-align:center">
        <p onclick="castVote()" id="castVote" class="upvoteText" style="color:black; font-size:3em; margin:10px 0px 10px 0px; cursor:pointer;">Cast Vote</p>
        </div>
    </div>

    <!-- link for nav bar link to take to this part of the page.!-->
    <a name="upvote">
    <!-- Table to upvote which team of bacon people want to win!-->
    <table id="mainUpvoteTable" class="upvoteTable">
        <tr>
            <th class="chewyInfoHeader">
                Team Chewy
            </th>
            <th class="crispyInfoHeader">
                Team Crispy
            </th>
        </tr>
        <tr>
            <td class="chewyInfo">
                <div style="margin:auto; width:50px">
                   <img onclick="upvoteChewy()" class="upvoteButton upvoteChewy" src="./images/upvote.png" width="50" height="50">
                </div>
            </td>
            <td class="crispyInfo">
                <div style="margin:auto; width:50px">
                    <img onclick="upvoteCrispy()" class="upvoteButton upvoteCrispy" src="./images/upvote.png" width="50" height="50">
                </div>
            </td>
        </tr>
    </table>
    </a>

    <!-- JAVASCRIPT FOR THE PAGE !-->
    <script>
        $(document).ready(function(){
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
            $('#mainUpvoteTable').show();
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
            console.log("Disabling cast vote button");
            $('#castVote').hide();
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
