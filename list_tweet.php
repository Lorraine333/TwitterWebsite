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
			//print 'Connected successfully!<br>';

			// Getting the input parameter (user):
			$userid = $_SESSION['username'];
			$password = $_SESSION['password'];

			// Get the attributes of the user with the given username
			$query = "SELECT ID, Tweets_Time, Tweets_Contents, Tweets_Location
			FROM TweetsLarge, PostLarge, UserLarge
			WHERE TweetsLarge.ID = PostLarge.Tweet_ID
			AND PostLarge.User_ID = UserLarge.`User_ID`
			AND UserLarge.`Password` = '$password'
			AND UserLarge.User_ID = '$userid'";
		
			$result = mysqli_query($dbcon, $query)
			  or die('Query failed: ' . mysqli_error($dbcon));

			// Can also check that there is only one tuple in the result
			$tuple = mysqli_fetch_row($result)
			  or die("User $userid haven't send a twitter!");

			$panel_header = "User <b>$userid</b> <b>$ID</b> has the following tweets:";

			// Printing user attributes in HTML

			$table_content = "<tr><td>$tuple[0]</td><td>$tuple[1]</td><td>$tuple[2]</td><td>$tuple[3]</td></tr>";		
			while ($tuple = mysqli_fetch_row($result)) {
			   $table_content .= "<tr><td>$tuple[0]</td><td>$tuple[1]</td><td>$tuple[2]</td><td>$tuple[3]</td></tr>";
			}
			print '</ul>';

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
				        <th style="text-align:center">Twitter ID</th>
				        <th style="text-align:center">Twitter Time</th>
				        <th style="text-align:center">Twitter Content</th>
				        <th style="text-align:center">Twitter Location</th>
				    </tr>
					<tbody>
						<?php echo $table_content;?>
					</tbody>
				</table>    
                </div>
                <div class="panel-footer">
                    
					<hr>
					Now, you can choose the tweets you want to delete. Enter Tweets ID in the required field. When you are done, click <it>Delete</it> button.
					<p>

					<form method=get action="DeleteTweet.php">
					<input class = "form-control" style = "width:200px" type="text" name="TweetID" placeholder = "Enter Twitter ID:"><br />
					<input class = "btn btn-default" type="submit" value="Delete">
					
					</form>

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