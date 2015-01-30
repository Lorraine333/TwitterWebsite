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

date_default_timezone_set("America/Chicago");

// Getting the input parameter (user):
$userid = $_REQUEST['userid'];
$userName = $_REQUEST['username'];
$gender = $_REQUEST['gender'];
$password = $_REQUEST['password'];
$registerTime = date('Y-m-d H:i:s');

// Get the attributes of the user with the given username
$query = "INSERT INTO UserLarge(User_ID, User_Name, Gender, Password, RegisterTime)
VALUES ('$userid', '$userName', '$gender', '$password', '$registerTime')";

$result = mysqli_query($dbcon, $query)
  or die('Register failed: ' . mysqli_error($dbcon));

$_SESSION['username'] = $userid;
$_SESSION['password'] = $password;

print "Welcome to Tweeter";   

echo '<META HTTP-EQUIV="Refresh" Content="2; URL=Main.php">'; 

// Closing connection
mysqli_close($dbcon);
?> 