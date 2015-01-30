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

				// Connection parameters 
				$host = 'cspp53001.cs.uchicago.edu';
				$username = 'lix1';
				$password = 'kevingarnett';
				$database = $username.'DB';

				// Attempting to connect
				$dbcon = mysqli_connect($host, $username, $password, $database)
				   or die('Could not connect: ' . mysqli_connect_error());

				// Getting the input parameter (user):
				$userid = $_SESSION['username'];

				// Get the user followed by the given userid
				$query = "SELECT DISTINCT UserLarge.User_ID, UserLarge.User_Name
				FROM UserLarge, FollowLarge
				WHERE FollowLarge.User2_ID = UserLarge.User_ID
				AND FollowLarge.User1_ID = '$userid'";

				$result = mysqli_query($dbcon, $query)
				  or die('Query failed: ' . mysqli_error($dbcon));

				// Can also check that there is only one tuple in the result
				$tuple = mysqli_fetch_row($result);
				  

				$panel_header =  "User <b>$userid</b> followed:";

				// Printing user attributes in HTML

				
				$table_content = "<tr><td>$tuple[0]</td><td>$tuple[1]</td></tr>";
				while ($tuple = mysqli_fetch_row($result)) {
				   $table_content .= "<tr><td>$tuple[0]</td><td>$tuple[1]</td></tr>";
				}

				// Get the user information following the given userid
				$query1 = "SELECT DISTINCT UserLarge.User_ID, UserLarge.User_Name
				FROM UserLarge, FollowLarge
				WHERE FollowLarge.User1_ID = UserLarge.User_ID
				AND FollowLarge.User2_ID = '$userid'";

				$result1 = mysqli_query($dbcon, $query1)
				  or die('Query failed: ' . mysqli_error($dbcon));

				// Can also check that there is only one tuple in the result
				$tuple1 = mysqli_fetch_row($result1);
				 


				$panel_header1 =  "User following <b>$userid</b>:";

				// Printing user attributes in HTML
			
				$table_content1 = "<tr><td>$tuple[0]</td><td>$tuple[1]</td></tr>";
				while ($tuple = mysqli_fetch_row($result1)) {
				   $table_content1 .= "<tr><td>$tuple[0]</td><td>$tuple[1]</td></tr>";
				}




				// Free result
				mysqli_free_result($result);
				mysqli_free_result($result1);

				// Closing connection
				mysqli_close($dbcon);
				?> 

	</div>

    <div class = "row">

		<div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                        <?php echo $panel_header ;?>
                </div>
                <div class="panel-body">
                	<table class = "table table-striped table-bordered table-hover dataTable no-footer" style="text-align:center">
						<tr>
				        	<th style="text-align:center">User ID</th>
				        	<th style="text-align:center">User Name</th>
				    	</tr>
						<tbody>
							<?php echo $table_content;?>
						</tbody>
					</table> 
				</div>


				<div class = "panel-heading">
					<?php echo $panel_header1 ;?>
				</div>
				
				<div class="panel-body">
					<table class = "table table-striped table-bordered table-hover dataTable no-footer" style="text-align:center">
						<tr>
				        	<th style="text-align:center">User ID</th>
				        	<th style="text-align:center">User Name</th>
				    	</tr>
						<tbody>
							<?php echo $table_content1;?>
						</tbody>
					</table> 
				</div>

                </div>
                <div class="panel-footer">

					<hr>
					Click <it>Back</it> button you can go back to the main page.
					<p>

					<form method=get action="Main.php">
					<input class = "btn btn-default" type="submit" value="Back">
					</form>

                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>