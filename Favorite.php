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

$userid = $_SESSION['username'];
$tweetid = $_REQUEST['FTweetId'];
date_default_timezone_set("America/Chicago");
$likeTime = date("Y-m-d H:i:s");
//echo $likeTime;

// Get the MAX ID of the table of comments 
$query = "INSERT INTO FavoriteLarge(User_ID, Tweet_ID, LikeTime)
VALUES ('$userid', $tweetid, '$likeTime')";

$result = mysqli_query($dbcon, $query)
  or die('Favorite this tweet failed: ' . mysqli_error($dbcon));


echo 'Successfully Favorite this tweet';

echo '<META HTTP-EQUIV="Refresh" Content="2; URL=list.php">'; 

// Closing connection
mysqli_close($dbcon);


?> 