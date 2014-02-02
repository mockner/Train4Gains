<?php //view_log.php

include_once 'header.php';
include_once 'view_functions.php';
include_once 'db_functions.php';
if (!(isset($_SESSION['user'])))
{
die("You are no longer logged in. Please <a href='index.php'>die.</a><br /><br />");
}
$workout_list = get_workouts_by_user($user);
foreach($workout_list as &$workout_object)
{
	display_workout($workout_object);
}
