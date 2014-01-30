<?php
include_once 'functions.php';

//	*SESSION BEGIN OR CONTINUE*	//
session_start();

echo	"<!DOCTYPE html>\n<html><head>";

//	*IMPORT JAVASCRIPT FILES*	//
echo	"<script type='text/javascript' src='javascript/jquery-1.10.2.js'>"; //jQuery
echo	"<script type='text/javascript' src='javascript/header.js'>";	//header.js
echo	"</script>";

//	*IMPORT CSS FILES* 	//
echo  "<link rel='stylesheet' type='text/css' media='screen' href='css/styles.css'>";

//	*SET PAGE VARIABLES*	//
if (isset($_SESSION['user']))
{
	$user = $_SESSION['user'];
	$logged_in = TRUE;
	$userstr = " ($user)";
}
else $logged_in = FALSE;


//	*OPTIONAL: SET  TITLE*	//
echo	"<title>This is the title. Change when ready.</title>";
echo	"</head><body>";
		
		
//	*NAV BAR*	//
echo	"<ul class='menu'>";		
if ($logged_in)
{
	echo	"<li><a href='home.php'>Home</a></li>".
			"<li><a href='builder.php'>Log workout</a></li>".
			"<li><a href='view_log.php'>View log</a></li>".
			"<li><a href='sign_out.php'>Sign out</a></li>";
}
else
{
	echo	"<ul class='menu'>".
			"<li><a href='index.php'>Home</a></li>".
			"<li><a href='sign_up.php'>Sign up</a></li>".
			"<li><a href='sign_in.php'>Sign in</a></li>";
}
echo	"</ul>";
?>


