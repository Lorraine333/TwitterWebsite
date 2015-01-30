<?php
session_start();

// Connection parameters 
$host = 'cspp53001.cs.uchicago.edu';
$username = 'lix1';
$password = 'kevingarnett';
$database = $username.'DB';

// Attempting to connect
$dbcon = mysqli_connect($host, $username, $password, $database)
   or die('Could not connect: ' . mysqli_connect_error());
print 'Connected successfully!<br>';

// Getting the input parameter (user):
$tweetID = $_REQUEST['TweetID'];

//Running all the insert queries
$query4 = "DELETE FROM FavoriteLarge WHERE Tweet_ID = '$tweetID'"; 
$query3 = "DELETE FROM BelongsToLarge WHERE Tweet_ID = '$tweetID'";
$query1 = "DELETE FROM PostLarge WHERE Tweet_ID = '$tweetID'";
$query2 = "DELETE FROM TweetsLarge WHERE ID = '$tweetID'";


$result1 = mysqli_query($dbcon, $query1)
  or die('Query failed: ' . mysqli_error($dbcon));
$result2 = mysqli_query($dbcon, $query2)
  or die('Query failed: ' . mysqli_error($dbcon));
  $result3 = mysqli_query($dbcon, $query2)
  or die('Query failed: ' . mysqli_error($dbcon));
echo "Successfully Delete Tweets";

echo '<META HTTP-EQUIV="Refresh" Content="2; URL=list_tweet.php">'; 


// Closing connection
mysqli_close($dbcon);
?> 