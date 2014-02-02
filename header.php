<?php

include_once 'functions.php';

//	*SESSION BEGIN OR CONTINUE*	//
session_start();

echo	"<!DOCTYPE html>\n<html><head>";

//	*IMPORT JAVASCRIPT FILES*	//
echo	"<script type='text/javascript' src='javascript/jquery-1.10.2.js'>"; //jQuery
//              ** Import bootstrap.js (after jquery)**                  // 
echo	"<script type='text/javascript' src='javascript/header.js'>";	//header.js
echo	"</script>";

//	*IMPORT CSS FILES* 	//
//              ** Import bootstrap.css**                              // 
echo  "<link rel='stylesheet' type='text/css' media='screen' href='css/styles.css'>";
echo  "<link rel='stylesheet' type='text/css' media='screen' href='css/bootstrap.css'>";

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
if ($logged_in)
{
// **** Elena's styled generating **** // 

    echo	"<nav class='navbar navbar-default'>". 
				"<div class='collapse navbar-collapse'>".
					"<ul class='nav navbar-nav'>".
						"<li class='active'><a href='home.php'>Home</a></li>".
						"<li><a href='builder.php'>Log Workout</a></li>".
						"<li class='active'><a href='view_log.php'>View Log</a></li>". 
					"</ul>".
                         "<ul class='nav navbar-nav navbar-right'>".
                           "<li><a href='sign_out.php'>Sign out</a></li>".
    			 "</ul>".
  		       "</div>".
		     "</nav>"; 
}
else
{

// **** Elena's styled generating  **** // 
        echo    "<nav class='navbar navbar-default'>". 
                       "<div class='collapse navbar-collapse'>".
    		         "<ul class='nav navbar-nav'>".
      		           "<li class='active'><a href='index.php'>Home</a></li>". 
    			 "</ul>".
                         "<ul class='nav navbar-nav navbar-right'>".
                           "<li><a href='sing_up.php'>Sign up</a></li>".
                           "<li><a href='sign_in.php'>Sign in</a></li>".
    			 "</ul>".
  		       "</div>".
		     "</nav>"; 

}
?>


