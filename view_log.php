<?php //view_log.php

include_once 'header.php';

if (!(isset($_SESSION['user'])))
{
die("You are no longer logged in. Please <a href='index.php'>die.</a><br /><br />");
}

displayAllWorkouts($user);