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
date_default_timezone_set("America/Chicago");
$CommentTime = date("Y-m-d H:i:s");
//ECHO $CommentTime;
$tweetid = $_REQUEST['TweetId'];
$commentsContents = $_REQUEST['CommentsContents'];
$userID = $_SESSION['username'];

// Get the MAX ID of the table of comments 
$query = "SELECT MAX(Comments_ID) FROM CommentsLarge";
$result = mysqli_query($dbcon, $query)
  or die('Query failed: ' . mysqli_error($dbcon));
$tuple = mysqli_fetch_row($result)
  or die('Query failed');


$commentID = $tuple[0]+1;

// Insert into Comments Table First
$query1 = "INSERT INTO CommentsLarge(Comments_ID, Time, Comments_Contents)
VALUES ($commentID, '$CommentTime' ,'$commentsContents')";
$result1 = mysqli_query($dbcon, $query1)
  or die('Insert into Comments Table failed: ' . mysqli_error($dbcon));

// Insert into Make Table
$query2 = "INSERT INTO MakeLarge(User_ID, Comments_ID)
VALUES('$userID', $commentID)";
$result2 = mysqli_query($dbcon, $query2)
  or die('Insert into Make Table failed: ' . mysqli_error($dbcon));

//Insert into BelongsTo Table
$query3 = "INSERT INTO BelongsToLarge(Comments_ID, Tweet_ID)
VALUES($commentID, $tweetid)";
$result3 = mysqli_query($dbcon, $query3)
  or die('Insert into BelongsTo Table failed: ' . mysqli_error($dbcon));


echo 'Successfully Make a Comment';

echo '<META HTTP-EQUIV="Refresh" Content="2; URL=list.php">'; 

// Closing connection
mysqli_close($dbcon);


?> 