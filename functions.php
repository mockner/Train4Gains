<?php // Example 21-1: functions.php
$dbhost  = 'localhost';    // Unlikely to require changing
$dbname  = 'train4gains';       // Modify these...
$dbuser  = 'mockner';   // ...variables according
$dbpass  = 'mjo2591';   // ...to your installation
$appname = "Train4Gains"; // ...and preference

//Connect to db.
mysql_connect($dbhost, $dbuser, $dbpass) or die(mysql_error());
mysql_select_db($dbname) or die(mysql_error());


//////////////////////////
// *DATABASE FUNCTIONS*	//
//////////////////////////

function createTable($name, $query)
{
    queryMysql("CREATE TABLE IF NOT EXISTS $name($query)");
    echo "Table '$name' created or already exists.<br />";
}

function queryMysql($query)
{
    $result = mysql_query($query) or die(mysql_error());
	 return $result;
}




//////////////////////////////////////////////////////
function displayAllWorkouts($user)
{
	$query ="SELECT * FROM users WHERE username ='$user'";
	$result = queryMysql($query);
	$user_data = mysql_fetch_array($result);
	$user_id = $user_data['id'];
	
	
	$query = "SELECT * FROM workouts WHERE user_id ='$user_id' ORDER BY date";
	$result = queryMysql($query);
	
	while($workout = mysql_fetch_array($result))
	{
		displayWorkout($workout);
	}
}


////////////////////////////////////////////////////////
function destroySession()
{
    $_SESSION=array();
    
    if (session_id() != "" || isset($_COOKIE[session_name()]))
        setcookie(session_name(), '', time()-2592000, '/');

    session_destroy();
}

function sanitizeString($var)
{
    $var = strip_tags($var);
    $var = htmlentities($var);
    $var = stripslashes($var);
    return mysql_real_escape_string($var);
}

function showProfile($user)
{
    if (file_exists("$user.jpg"))
        echo "<img src='$user.jpg' align='left' />";

    $result = queryMysql("SELECT * FROM profiles WHERE user='$user'");

    if (mysql_num_rows($result))
    {
        $row = mysql_fetch_row($result);
        echo stripslashes($row[1]) . "<br clear=left /><br />";
    }
}
?>
