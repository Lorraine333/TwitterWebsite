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
$tContent = $_REQUEST['TweetContent'];
$tLocation = $_REQUEST['TweetLocation'];
$userid = $_SESSION['username'];
$tweetT = $_SESSION['TweetT'];
$password = $_SESSION['password'];

// Get the MAX ID of the table of tweets 
$query = "SELECT MAX(ID) FROM TweetsLarge";
$result = mysqli_query($dbcon, $query)
  or die('Query failed: ' . mysqli_error($dbcon));
$tuple = mysqli_fetch_row($result)
  or die('Query failed');


$tweetID = $tuple[0]+1;

//Running all the insert queries
$query1 = "INSERT INTO TweetsLarge(ID, Tweets_Time, Tweets_Contents, Tweets_Location) VALUES ($tweetID, '$tweetT','$tContent','$tLocation')";
$query2 = "INSERT INTO PostLarge(User_ID, Tweet_ID) VALUES ('$userid', $tweetID)";
$result1 = mysqli_query($dbcon, $query1)
  or die('Query failed: ' . mysqli_error($dbcon));
$result2 = mysqli_query($dbcon, $query2)
  or die('Query failed: ' . mysqli_error($dbcon));
echo "Successfully Post Tweets";

echo '<META HTTP-EQUIV="Refresh" Content="2; URL=Main.php">'; 

// Free result
mysqli_free_result($result);

// Closing connection
mysqli_close($dbcon);
?> 