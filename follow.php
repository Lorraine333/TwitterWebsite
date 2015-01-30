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
$user1id = $_SESSION['username'];
$user2id = $_REQUEST['followedId'];

// Get the attributes of the user with the given username
$query = "INSERT INTO FollowLarge(User1_ID, User2_ID)
VALUES ('$user1id', '$user2id')";

$result = mysqli_query($dbcon, $query)
  //or die('Follow failed: ' . mysqli_error($dbcon));
or die('Follow failed, you have followed this user.' );

echo 'Successfully Follow This User';

echo '<META HTTP-EQUIV="Refresh" Content="2; URL=list_user.php">'; 

// Closing connection
mysqli_close($dbcon);


?> 
