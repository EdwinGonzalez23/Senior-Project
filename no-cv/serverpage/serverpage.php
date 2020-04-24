<?php
session_start();
include("info.php"); 
include("../db_connect.php"); 

$LongestWaitTIme;
$CurrentWaitTime;
// Grab all data from database
$serverNameQuery = "SELECT DISTINCT firstname, lastname FROM current_orders NATURAL JOIN humans WHERE serverid = humanid AND tableid = 1";
//$table1= "SELECT * FROM current_orders WHERE tableid = 1 ORDER BY starttime DESC";
$table1 = "SELECT *, (now()::time - starttime) AS current_wait_time FROM current_orders WHERE tableid = 1 ORDER BY starttime DESC";
$longestWaitTime = "SELECT max(longest_wait_time) FROM current_orders WHERE tableid = 1";

// Find Server
$result = pg_query($dbconn, $serverNameQuery);
$serverName = pg_fetch_row($result);

// Find LWT
$result = pg_query($dbconn, $longestWaitTime);
$lwt = pg_fetch_row($result);

//Find Num Guest, LWT, CWT
$result = pg_query($dbconn, $table1);
$row = pg_fetch_array($result);

if ($row[13] > $lwt[0]) {
    $LongestWaitTIme = $row[13];
    $CurrentWaitTime = $row[13];
} else {
    $LongestWaitTIme = $lwt[0];
    $CurrentWaitTime = $row[13];

}

$lh; $lm; $ls;
$ch; $cm; $s;

list($lh, $lm, $ls)=preg_split('[:]',$LongestWaitTIme); // Longest Record Time
list($ch, $cm, $cs)=preg_split('[:]',$CurrentWaitTime);// Current Time (may be longest but not recroded)

?>
<!DOCTYPE html>
<!-- serverpage.php -->
<?php 


?>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">

        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

        <!-- Bootstrap CSS CDN -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">

        <!-- Server CSS Style -->
        <link rel="stylesheet" href="serverstyle.css">

        <!-- Font Awesome JS -->
        <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script>
        <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous"></script>
    </head>


    <body>
        <div class="wrapper">
            <!-- Sidebar  -->
            <nav id="sidebar">
                <div class="sidebar-header">
                    <h3>Welcome:  <span id="server-name"><?php echo $_SESSION["username"]; ?></span></h3>
                    </span>
                    <strong>BS</strong>
                    <div class="picture" >
                        <img src="./tmpserver.jpg" alt="Server" width="180" height="180">
                    </div>
                </div>


                <br>
                <ul class="list-unstyled components">
                    <li class="active">
                        <a href="#homeSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                            <i class="fas fa-home"></i>
                            Server Home
                        </a>
                        <ul class="collapse list-unstyled" id="homeSubmenu">

                            <li>
                                <a href="#party">Party</a>
                            </li>
                            <li>
                                <a href="./server.html">Refresh</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="#">
                            <i class="fas fa-briefcase"></i>
                            How to Get Started
                        </a>
                        <a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                            <i class="fas fa-copy"></i>
                            Pages
                        </a>
                        <ul class="collapse list-unstyled" id="pageSubmenu">
                            <li>
                                <a href="#">Page 1</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="#">
                            <i class="fas fa-question"></i>
                            Help
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <i class="fas fa-paper-plane"></i>
                            Contact
                        </a>
                    </li>
                </ul>

                <ul class="list-unstyled CTAs">   

                </ul>
            </nav>


            <!-- End of side bar stuff -->

            <!-- Top nav area -->
            <div id="content">

                <nav class="navbar navbar-expand-lg navbar-light bg-light">
                    <div class="container-fluid">

                        <button type="button" id="sidebarCollapse" class="btn btn-info">
                            <i class="fas fa-align-left"></i>
                            <span>Toggle Sidebar</span>
                        </button>
                        <button class="btn btn-dark d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                            <i class="fas fa-align-justify"></i>
                        </button>

                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <ul class="nav navbar-nav ml-auto">
                                <h3>
                                    <!-- <button id="logout-button" class="btn btn-info btn-lg float-right" onclick="logout();">Log out</button> -->
                                    <button id="logout-button" class="btn btn-info btn-lg float-right">Log out</button>
                                    
                                </h3>

                            </ul>
                        </div>
                    </div>
                </nav>

                <!-- End of top nav  -->

                <h1><center><b>Server</b></center></h1>
                <div class="line"></div>
                <p><small>
                    <script>
document.write(Date());
                    </script>
                </small>
                </p>
                <!-- All tables and right side nav -->
                <div id="mySidenav" class ="sidenav" >
                    <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
                    <a onclick="myFunction2()" class="dropbtn">Place Order</a>
                    <div id="myDropdown2" class="dropdown-content">
                        <a onclick="loadForm()"> Test</a>
                        <div id="Output"></div>
                    </div>
                    <a onclick="myFunction()" class="dropbtn">Menu</a>
                    <div id="myDropdown" class="dropdown-content">
                        <a >2 Tacos</a>
                        <a >2 Water</a>
                        <a >2 desserts</a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-4">
                    <table id="bgDiv" >
                            <thead>
                                <tr>
                                    <th>TABLE 1</th>
                                    <td id="warning-t-header"></td>
                                </tr>
                            </thead>
                            <body>
                            <tr><td>Server</td><td><?php echo $serverName[0] . " " .$serverName[1];?></td></tr>
                                <tr><td>Number of guest</td><td><?php echo $row[2];?></td></tr>
                                <tr><td>Longest Time Waiting</td><td><?php echo $LongestWaitTIme ?></td></tr>
                                <!--<tr><td>Timer</td><td><button id="startButton">Start</button></td></tr>-->
                                <tr><td>Time Waiting</td><td id="stopWatch"></td></tr>
                                <tr><td></td><td></td></tr>
                            </body>
                            </table><br><br><br> 
                            <table id="bgDiv2" >
                            <thead >
                                <tr>
                                    <th>TABLE 2</th>
                                    <td></td>
                                </tr>
                            </thead>
                            <body>
                                <tr><td>Name</td><td>Janet</td></tr>
                                <tr><td>Number of guest</td><td>03</td></tr>
                                <tr><td>Longest Time</td><td><?php echo $timer; ?></td></tr>
                                <tr><td>Timer</td><td><button id="startButton2">Start</button></td></tr>
                                <tr><td>Time Waiting</td><td id="stopWatch2">0</td></tr>
                                <tr><td></td><td><button id="resetButton2">Reset</button></td></tr>
                            </body>
                        </table><br>
                    </div>
                    <div class="col-lg-4">
                        <table id="bgDiv3" >
                            <thead >
                                <tr >
                                    <th>TABLE 3</th>
                                    <td></td>
                                </tr>
                            </thead>
                            <body>
                                <tr><td>Name</td><td>Janet</td></tr>
                                <tr><td>Number of guest</td><td>05</td></tr>
                                <tr><td>Longest Time</td><td><?php echo $timer; ?></td></tr>
                                <tr><td>Timer</td><td><button id="startButton3">Start</button></td></tr>
                                <tr><td>Time Waiting</td><td id="stopWatch3">0</td></tr>
                                <tr><td></td><td><button id="resetButton3">Reset</button></td></tr>
                            </body>
                        </table><br>
                        <table id="bgDiv4">
                            <thead >
                                <tr>
                                    <th>TABLE 4</th>
                                    <td></td>
                                </tr>
                            </thead>
                            <body>
                                <tr><td>Name</td><td>Janet</td></tr>
                                <tr><td>Number of guest</td><td>07</td></tr>
                                <tr><td>Longest Time</td><td><?php echo $timer; ?></td></tr>
                                <tr><td>Timer</td><td><button id="startButton4">Start</button></td></tr>
                                <tr><td>Time Waiting</td><td id="stopWatch4">0</td></tr>
                                <tr><td></td><td><button id="resetButton4">Reset</button></td></tr>
                            </body>
                        </table>
                    </div>
                </div>
            </div>







            <!-- jQuery CDN - Slim version (=without AJAX) -->
            <!-- <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script> -->
            <script
			  src="https://code.jquery.com/jquery-3.5.0.min.js"
			  integrity="sha256-xNzN2a4ltkB44Mc/Jz3pT4iU1cmeR0FkXs4pru/JxaQ="
			  crossorigin="anonymous"></script>
            <!-- Popper.JS -->
            <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
            <!-- Bootstrap JS -->
            <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
            <script type="text/javascript">
$(document).ready(function () {
    $('#sidebarCollapse').on('click', function () {
        $('#sidebar').toggleClass('active');
    });
});
            </script>
            <!-- Include with JS directory and other files from senior.zip -->
            <script src="scripts/js/scripts.js"></script>
            <script src="scripts/js/server.js"></script>
            <script>
function openNav(){
    document.getElementById("mySidenav").style.width="250px";}
    function closeNav(){
        document.getElementById("mySidenav").style.width="0";}

        function loadForm(){
            document.getElementById("#Output").load("form.html")
        }



            </script>



            <script>
function test(){
    document.getElementById("form");
}

function myFunction() {
    document.getElementById("myDropdown").classList.toggle("show");
}
function myFunction2() {
    document.getElementById("myDropdown2").classList.toggle("show");
}

// Close the dropdown if the user clicks outside of it
window.onclick = function(event) {
    if (!event.target.matches('.dropbtn')) {
        var dropdowns = document.getElementsByClassName("dropdown-content");
        var i;
        for (i = 0; i < dropdowns.length; i++) {
            var openDropdown = dropdowns[i];
            if (openDropdown.classList.contains('show')) {
                openDropdown.classList.remove('show');
            }
        }
    }
}

            </script>


            <!-- Victor original server javascript in the following script -->
            <script type="text/javascript">
//table 1
var x = "<?php echo $cs?>";
var x2 = "<?php echo $cm?>";
if (x == 0 && x2 == 0) {
    $('#warning-t-header').html("Unassigned")
} else {
    window.onload = (function (e) {
        setInterval(function () {
                    $("#stopWatch").html(""+ x2 +" : "+x);
                    x++;
                    if(x >=60){x=0; x2++;}
                                }, 1000);
});
}


setInterval(function () {
    var bgColor = $("#bgDiv").css("background-color");
     if (x2 < 5)
        $("#bgDiv").css("background-color", "#32CD32")
    else if(x2 < 10 )
        $("#bgDiv").css("background-color", "Yellow")
    else 
        $("#bgDiv").css("background-color", "Red")
}, 1000);


//table 2
var j = 1;
var j2 = 0;
$("#startButton2").click(function (e) {
        setInterval(function () {
                    $("#stopWatch2").html(""+ j2 +" : "+j);
                    j++;
                    if(j >=60){j=0; j2++;}
                                }, 1000);
});

$("#resetButton2").click(function (e) {
        j = 0;j2=0;
});

setInterval(function () {
    var bgColor = $("#bgDiv2").css("background-color");
    if (j <= '10')
        $("#bgDiv2").css("background-color", "#32CD32")
    else if(j <= '20')
        $("#bgDiv2").css("background-color", "Yellow")
    else
        $("#bgDiv2").css("background-color", "Red")
}, 1000);
 
//table 3
var k = 1,k2=0;
$("#startButton3").click(function (e) {
        setInterval(function () {
                    $("#stopWatch3").html(""+k2+" : "+k);
                    k++;
                    if(k >= 60){k=0; k2++;}
                                }, 1000);
});

$("#resetButton3").click(function (e) {
        k = 0;k2=0;
});

setInterval(function () {
    var bgColor = $("#bgDiv3").css("background-color");
    if (k <= '10')
        $("#bgDiv3").css("background-color", "#32CD32")
    else if(k <= '20')
        $("#bgDiv3").css("background-color", "Yellow")
    else
        $("#bgDiv3").css("background-color", "Red")
}, 1000);

//table 4
var z = 1,z2=0;
$("#startButton4").click(function (e) {
        setInterval(function () {
                    $("#stopWatch4").html(""+z2+" : "+z);
                    z++;
                    if(z >= 60){z=0; z2++;}
                                }, 1000);
});

$("#resetButton4").click(function (e) {
        z = 0;z2=0;
});

setInterval(function () {
    var bgColor = $("#bgDiv4").css("background-color");
    if (z <= '10')
        $("#bgDiv4").css("background-color", "#32CD32")
    else if(z <= '20')
        $("#bgDiv4").css("background-color", "Yellow")
    else
        $("#bgDiv4").css("background-color", "Red")
}, 1000);

            </script>

            <!-- Logout -->
            <script>
                $('#logout-button').click(function (e) {
                    //e.preventDefault();
                    console.log('pushing button')
                    $.get('../php_scripts/logout.php', function (data, textStatus, jqXHR) { // success callback
                        console.log(textStatus)
                        console.log(data)
                        if (textStatus === "success") {
                            $(location).attr('href', data);
                        }
                    });
                });
            </script>


    </body>
</html>
