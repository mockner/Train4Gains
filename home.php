<?php //home.php
include_once 'header.php';

if (!(isset($_SESSION['user'])))
{
die("You are no longer logged in. Please <a href='index.php'>die.</a><br /><br />");
}

echo "welcome $user";
//Displays the users home screen, including:
//
//	1. link to builder.
//	2. link to visualizations
//	3. list of goals and or display of progress.
//	4. link to log.
//
//
//