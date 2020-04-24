<?php session_start();?>
<!DOCTYPE html>
<!-- hostpage.php  -->
<?php 
    include('../db_connect.php');
    
    // Retrieve List of Parties
	$newPartyData = "SELECT orders.orderid, partyname, partysize, tableid, serverid FROM orders WHERE checkouttime IS NULL ORDER BY orders.orderid";

	$execute_newPartyData = pg_query($dbconn, $newPartyData) or die('Query failed: ' . pg_last_error());
	
	$showTime = "SELECT lastvisit FROM list_curr_orders";
	$execute_showTime = pg_query($newPartyData) or die('Query failed: ' . pg_last_error());

?>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

    <!-- Bootstrap CSS CDN -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css"
        integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
    <!-- My CSS -->
    <link rel="stylesheet" href="hoststyle.css">

    <!-- Font Awesome JS -->
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js"
        integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous">
    </script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js"
        integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous">
    </script>
</head>


<body>
    <div class="wrapper">
        <!-- Sidebar  -->
        <nav id="sidebar">
            <div class="sidebar-header">
                <h3>Welcome: <span id="ename"></span></h3>
                </span>
                <strong>BS</strong>
            </div>

            <br>
            <ul class="list-unstyled components">
                <li class="active">
                    <a href="#homeSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                        <i class="fas fa-home"></i>
                        Host Home
                    </a>
                    <ul class="collapse list-unstyled" id="homeSubmenu">

                        <li>
                            <a href="#party">Party</a>
                        </li>
                        <li>
                            <a href="./hostpage.php">Refresh</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <!--<a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                            <i class="fas fa-copy"></i>
                            Pages
                        </a>
                        <ul class="collapse list-unstyled" id="pageSubmenu">
                            <li>
                                <a href="#">Page 1</a>
                            </li>
                        </ul>
                    </li><-->
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
                <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">
                    Add a party
                </button>
            </ul>

            <ul class="list-unstyled CTAs">
                <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#assignTableModal">
                    Assign Table
                </button>
            </ul>
            <ul class="list-unstyled CTAs">
                <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#checkOutModal">
                    Check Out
                </button>
            </ul>
            <ul class="list-unstyled CTAs">
                <form action="../db_scripts/new_table_visit.php">
                    <input class="btn btn-info btn-lg" type="submit" value="Table Visit">
                </form>
            </ul>


        </nav>

        <!-- The Modal -->
        <div class="modal fade" id="myModal">
            <div class="modal-dialog">
                <div class="modal-content">

                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">Enter Party Info</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>

                    <!-- Modal body -->
                    <div class="modal-body">

                        <form action="../db_scripts/new_party.php">
                            <input type="text" class="form-control" name="pName" placeholder="Enter Name for Party"
                                required>
                            <input type="number" class="form-control" name="guestAmount" placeholder="How many guests?"
                                required>
                            <br>
                            <button type="Submit" class="btn btn-info">Submit</button>

                        </form>
                    </div>
                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    </div>

                </div>
            </div>
        </div>

        <!-- Assign Table Modal -->
        <div class="modal fade" id="assignTableModal">
            <div class="modal-dialog">
                <div class="modal-content">

                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">Assign Party to Table </h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>

                    <!-- Modal body -->
                    <div class="modal-body">

                        <form action="../db_scripts/seat_party.php">
                            <input type="number" class="form-control" name="oid" placeholder="Order ID">
                            <!-- <input type="text" class="form-control" name="serverAssigned" placeholder="Server Assigned"
                                required> -->
                            <select name="serverAssigned" class="custom-select mr-sm-2">
                                <option>Choose Sever</option>
                                <option value="2">Edwin</option>
			    	<option value="4">Victor</option>
                            </select>
                            <input type="number" class="form-control" name="tableNumber"
                                placeholder="Enter Table Number" required>
                            <br>
                            <button type="Submit" class="btn btn-info">Submit</button>

                        </form>
                    </div>
                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    </div>

                </div>
            </div>
        </div>

        <!-- Check Out Modal -->
        <!-- The Modal -->
        <div class="modal fade" id="checkOutModal">
            <div class="modal-dialog">
                <div class="modal-content">

                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">Party Checkout</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>

                    <!-- Modal body -->
                    <div class="modal-body">

                        <form action="../db_scripts/check_out.php">
                            <input type="text" class="form-control" name="oid" placeholder="OrderID" required>
                            <input type="number" class="form-control" name="exp" placeholder="Guess Experience"
                                required>
                            <br>
                            <button type="Submit" class="btn btn-info">Submit</button>

                        </form>
                    </div>
                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    </div>

                </div>
            </div>
        </div>


        <!-- End of Modal -->


        <!-- End of side bar stuff -->

        <!-- Top nav area -->
        <div id="content">

            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="container-fluid">

                    <button type="button" id="sidebarCollapse" class="btn btn-info">
                        <i class="fas fa-align-left"></i>
                        <span>Toggle Sidebar</span>
                    </button>
                    <button class="btn btn-dark d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse"
                        data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation">
                        <i class="fas fa-align-justify"></i>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="nav navbar-nav ml-auto">
                            <h3>
                                <!-- <button class="btn btn-info btn-lg float-right" onclick="logout();">Log out</button> -->
                                <button id="logout-button" class="btn btn-info btn-lg float-right">Log out</button>
                            </h3>

                        </ul>
                    </div>
                </div>
            </nav>

            <!-- End of top nav  -->

            <h1>
                <center><b>Host</b></center>
            </h1>
            <div class="line"></div>
            <p><small>
                    <script>
                        document.write(Date());
                    </script>
                </small>
            </p>

            <table class="table table-bordered" id="js-table">
                <thead class="thead-light">
                    <tr>
                        <th>Party Order</th>
                        <th>Name</th>
                        <th>Number of Guests</th>
                        <th>Table ID</th>
                        <th>Server ID</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $i = 0;
                        while($line = pg_fetch_array($execute_newPartyData, null, PGSQL_ASSOC)){
                            foreach ($line as $col_value){
                                echo "<td>$col_value</td>";
                                $i++;
                                if ($i > 4){
                                    echo "</tr>";
                                    echo "<tr>";
                                    $i = 0;
                                }
                            }
                        }
                    ?>
                </tbody>
            </table>


        </div>
    </div>

    <!-- jQuery CDN - Slim version (=without AJAX) -->
    <!-- <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script> -->
    <script src="https://code.jquery.com/jquery-3.5.0.min.js"
        integrity="sha256-xNzN2a4ltkB44Mc/Jz3pT4iU1cmeR0FkXs4pru/JxaQ=" crossorigin="anonymous"></script>
    <!-- Popper.JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"
        integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous">
    </script>
    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"
        integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous">
    </script>
    <script type="text/javascript">
        $(document).ready(function () {
            $('#sidebarCollapse').on('click', function () {
                $('#sidebar').toggleClass('active');
            });
        });
    </script>


    <script src="scripts/js/scripts.js"></script>
    <script src="scripts/js/host-scripts.js"></script>
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
