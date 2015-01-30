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

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/simple-sidebar.css" rel="stylesheet">
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
   ?>


<div class="container">


	<div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">CS53001 Twitter</h1>
        </div>
    </div>

    	<div class="row">
		<div class="alert alert-info">
			<strong> Connected successfully!</strong>
		</div>

		<?php
		// Getting the input parameter (user):
		$userid = $_SESSION['username'];
		$password = $_SESSION['password'];

		// Get the attributes of the user with the given username
		$query = "SELECT UserLarge.User_ID,UserLarge.User_Name, count(*)
		FROM UserLarge
		JOIN FollowLarge
		ON FollowLarge.User1_ID = UserLarge.User_ID
		GROUP BY UserLarge.User_ID
		HAVING count(*) > 5";

		$result = mysqli_query($dbcon, $query)
		  or die('Query failed: ' . mysqli_error($dbcon));

		// Can also check that there is only one tuple in the result
		$tuple = mysqli_fetch_array($result, MYSQL_ASSOC)
		  or die("User $userid not found!");

		$panel_header =  "These are the users have over more than 5 followers";

		// Printing user attributes in HTML

		$table_content = '';

		while ($tuple = mysqli_fetch_row($result)) {
		   $table_content .= "<tr><td>$tuple[0]</td><td>$tuple[1]</td><td>$tuple[2]</td></tr>";
		}

		// Free result
		mysqli_free_result($result);

		// Closing connection
		mysqli_close($dbcon);

		?> 
	</div>

    <div class = "row">

		<div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                        <?php echo $panel_header;?>
                </div>
                <div class="panel-body">
                <table class = "table table-striped table-bordered table-hover dataTable no-footer" style="text-align:center">
					<tr>
				        <th style="text-align:center">User ID</th>
				        <th style="text-align:center">User Name</th>
				        <th style="text-align:center">Number of Follower</th>
				    </tr>
					<tbody>
						<?php echo $table_content;?>
					</tbody>
				</table>    
                </div>
                <div class="panel-footer">

                	<hr>
					Now, you can choose the user you are interested, you can view their files and their twitters posted. Enter User ID in the field. When you are done, click <it>Submit</it> button.
					<p>

					<form method=get action="list_profile.php">

					<input class = "form-control" style = "width:200px" type="text" name="UserId" placeholder = "Enter User ID:"><br />
					<input class = "btn btn-default" type="submit" value="Submit">
					</form>
                    
					<hr>
					Now, you can choose the user you want to follow, Enter User ID in the field. When you are done, click <it>Follow</it> button.
					<p>

					<form method=get action="follow.php">

					<input class = "form-control" style = "width:200px" type="text" name="followedId" placeholder = "Enter User ID:"><br />
					<input class = "btn btn-default" type="submit" value="Follow">
					</form>


					<hr>
					When you choose all the users that you want to follow. click <it>Finish</it> button you can go back to the main page.
					<p>

					<form method=get action="Main.php">
					<input class = "btn btn-default" type="submit" value="Finish">
					</form>

                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>