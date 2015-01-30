<?php
session_start();
?>

<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML//EN">
<html> 
<head>


<title>CS53001 TBP</title>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>CS53001 TBP</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/simple-sidebar.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>

<?php

// Connection parameters 
$host = 'cspp53001.cs.uchicago.edu';
$username = 'lix1';
$password = 'kevingarnett';
$database = $username.'DB';

// Attempting to connect
$dbcon = mysqli_connect($host, $username, $password, $database)
   or die('Could not connect: ' . mysqli_connect_error());
//print 'Connected successfully!<br>';

// Getting the input parameter (user):

$user = $_SESSION['username'];
$password = $_SESSION['password'];

if(!isset($user)){
	$user = $_REQUEST['Userid'];
//	echo "1";
}
if(!isset($password))
{
	$password = $_REQUEST['Password'];
//	echo "1";
}



// Get the attributes of the user with the given username
$query = "SELECT User_ID, User_Name, Gender, Password, RegisterTime
FROM UserLarge WHERE User_ID = '$user' and Password = '$password'";

$result = mysqli_query($dbcon, $query)
  or die('Query failed: ' . mysqli_error($dbcon));

// Can also check that there is only one tuple in the result
$tuple = mysqli_fetch_row($result)
  or die("The Password or User is wrong!");

?> 

<div id="wrapper">

        <!-- Sidebar -->
        <div id="sidebar-wrapper">
            <ul class="sidebar-nav">
                <li class="sidebar-brand">
                    <a href="#">
                        Your TBP
                    </a>
                </li>
                <li>
                    <a href="list_user.php">Popular User</a>
                </li>
                <li>
                    <a href="list_tweet.php">Your Twittes</a>
                </li>
                <li>
                    <a href="list_tweets_liked.php">Your Favorite Twittes</a>
                </li>
                <li>
                    <a href="list_follow.php">Your Relation</a>
                </li>
                <li>
                    <a href="list.php">All the Twittes</a>
                </li> 
                <li>
                    <a href="LogOut.php">Log Out</a>
                </li>
            </ul>
        </div>
        <!-- /#sidebar-wrapper -->

        <!-- Page Content -->
        <div id="page-content-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">

						<div class="page-header">
						      <h1>User Information</h1>
						</div>

						<div class = "row">
							
                        <div class="col-sm-4">
                        <div class="list-group">
                            <a href="#" class="list-group-item active">User ID</a>
                            <a href="#" class="list-group-item">User Name</a>
                            <a href="#" class="list-group-item">Gender</a>
                            <a href="#" class="list-group-item">Password</a>
                            <a href="#" class="list-group-item">Register Time</a>
                        </div>
                    	</div>

                        <div class="col-sm-4">
                        <div class="list-group">
                            <a href="#" class="list-group-item active"><?php print "$tuple[0]"?></a>
                            <a href="#" class="list-group-item"><?php print "$tuple[1]"?></a>
                            <a href="#" class="list-group-item"><?php print "$tuple[2]"?></a>
                            <a href="#" class="list-group-item"><?php print "$tuple[3]"?></a>
                            <a href="#" class="list-group-item"><?php print "$tuple[4]"?></a>
                        </div>
                    	</div>
                    	
                    </div>

                        <?php

						//print "User <b>$user</b> has the following attributes:";

						// Printing user attributes in HTML
						//print "<li>User ID| User Name| Gender| Password| Register Time ";
						//print '<ul>';
						//print "<li>$tuple[0]| $tuple[1]| $tuple[2]| $tuple[3]| $tuple[4] ";

						//print '</ul>';

						date_default_timezone_set("America/Chicago");
						$_SESSION['TweetT'] = date("Y-m-d H:i:s");
						$_SESSION['username'] = $user;
						$_SESSION['password'] = $password;

							// Free result
						mysqli_free_result($result);

							// Closing connection
						mysqli_close($dbcon);
						?>

						<div class="page-header">
						      <h1>Post Twittes Now!</h1>
						</div>
						

						<form method=get action="PostTweet.php">
							<div class="form-group">
                                <!-- <label>Enter Twitter Content:</label> -->
                                <textarea class="form-control" placeholder="Enter Twittes!" rows="3" name = "TweetContent"></textarea>
                            </div>


						<div class="form-group">
                                <!-- <label>Enter Twitter Location:</label> -->
                                <input class="form-control" placeholder="Enter Location" type="text" name="TweetLocation"></input>
                            </div>

						<input type="submit" class="btn btn-success" value="Post">
						<!-- </form>

                        <a href="#menu-toggle" class="btn btn-sm btn-default" id="menu-toggle">Hide Menu</a> -->
                    </div>
                </div>
            </div>
        </div>
        <!-- /#page-content-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <!-- Menu Toggle Script -->
    <script>
    $("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
    });
    </script>


</body>
</html>
