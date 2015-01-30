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

			// Get the user's favorite tweet
			$query = "SELECT distinct PostLarge.User_ID, UserLarge.User_Name, TweetsLarge.ID, TweetsLarge.Tweets_Contents
			FROM TweetsLarge, PostLarge, FollowLarge, UserLarge
			WHERE TweetsLarge.ID = PostLarge.Tweet_ID AND PostLarge.User_ID = FollowLarge.User2_ID
			AND PostLarge.User_ID = UserLarge.User_ID
			AND FollowLarge.User1_ID = '$userid'";	

			$result = mysqli_query($dbcon, $query)
			  or die('Query failed: ' . mysqli_error($dbcon));

			// Can also check that there is only one tuple in the result
			$tuple = mysqli_fetch_array($result)
			  or die("User $userid hasn't follow anyone, go to choose some popular user to follow!");

			$panel_header =  "These are the tweets for the user you have followed";

			// Printing user attributes in HTML
			
			$table_content = "<tr><td>$tuple[0]</td><td>$tuple[1]</td><td>$tuple[2]</td><td>$tuple[3]</td></tr>";
			while ($tuple = mysqli_fetch_row($result)) {
			   $table_content .= "<tr><td>$tuple[0]</td><td>$tuple[1]</td><td>$tuple[2]</td><td>$tuple[3]</td></tr>";
			}


			$query1 = "SELECT distinct PostLarge.User_ID, UserLarge.User_Name, TweetsLarge.ID, TweetsLarge.Tweets_Contents
			FROM TweetsLarge, PostLarge, UserLarge
			WHERE TweetsLarge.ID = PostLarge.Tweet_ID 
			AND PostLarge.User_ID = UserLarge.User_ID
			AND PostLarge.User_ID = '$userid'";

			$result1 = mysqli_query($dbcon, $query1)
			  or die('Query failed: ' . mysqli_error($dbcon));

			// Can also check that there is only one tuple in the result
			$tuple1 = mysqli_fetch_array($result1)
			  or die("User $userid hasn's like any tweets!");

			// Printing user attributes in HTML
			
			$table_content1 = "<tr><td>$tuple1[0]</td><td>$tuple1[1]</td><td>$tuple1[2]</td><td>$tuple1[3]</td></tr>";
			while ($tuple1 = mysqli_fetch_row($result1)) {
			   $table_content1 .= "<tr><td>$tuple1[0]</td><td>$tuple1[1]</td><td>$tuple1[2]</td><td>$tuple1[3]</td></tr>";
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
				        <th style="text-align:center">Twitter ID</th>
				        <th style="text-align:center">Twitter Content</th>
				    </tr>
					<tbody>
						<?php echo $table_content;?>
						<?php echo $table_content1;?>
					</tbody>
				</table>    
                </div>
                <div class="panel-footer">
                    
					
					<hr>
					Now, you can choose the tweets you want to see the comments. Enter Tweets ID in the required field. When you are done, click <it>Show Comments</it> button.
					<p>

					<form method=get action="ListComments.php">
					<input class = "form-control" style = "width:200px" type="text" name="CTweetId" placeholder = "Enter Twitter ID:"><br />
					<input class = "btn btn-default" type="submit" value="Submit">
					</form>

					<hr>
					Now, you can choose the tweets you like. Enter Tweets ID in the required field. When you are done, click <it>Like</it> button.
					<p>

					<form method=get action="Favorite.php">
					<input class = "form-control" style = "width:200px" type="text" name="FTweetId" placeholder = "Enter Twitter ID:"><br />
					<input class = "btn btn-default" type="submit" value="Like">
					</form>

					<hr>
					Now, you can choose the tweets you want to make comments to. Enter Tweets ID and Comments Contents in the required field. When you are done, click <it>Comment</it> button.
					<p>

					<form method=get action="Comments.php">
					<input class = "form-control" style = "width:200px" type="text" name="TweetId" placeholder = "Enter Twitter ID:"><br />
					<textarea class="form-control" placeholder="Enter Comments!" rows="3" name = "CommentsContents"></textarea><br />
					

					<input class = "btn btn-default" type="submit" value="Make Comments">
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