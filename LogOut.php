<?php
session_start();

echo 'Successfully Log Out!';
unset($_SESSION['username']);
unset($_SESSION['password']);


echo '<META HTTP-EQUIV="Refresh" Content="2; URL=final.html">'; 


?> 