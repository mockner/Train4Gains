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
function displayWorkoutTitle($date, $title)
{
echo "<div class='workout-id hidden'></div>";
echo "<div class='workoutTitle'>";
echo "<div class='date'> $date </div>";
echo "<div class='title'> $title </div>";
echo "</div>";
}

//////////////////////////////////////////////////////////
function displayWorkout($workout)
{
	$workout_id = $workout['id'];
	$date = $workout['date'];
	$title = $workout['title'];

	echo "<div class='workout'>";
	displayWorkoutTitle($date, $title);

	$query = "SELECT * FROM activities WHERE workout_id='$workout_id'";
	$activities = queryMysql($query);
	
	while($activity = mysql_fetch_array($activities))
	{
		displayActivity($activity);
	}
	echo "</div>";
}

/////////////////////////////////////////////////////////
function displayEditActivity($activity)
{
	$activity_id = $activity['id'];
	$type_id = $activity['type_id'];
	
	echo "<div class='activity'>";
	echo "<div class='activity-id'></div>";
	
	$query = "SELECT * FROM activity_types WHERE id='$type_id'";
	$activity_type = mysql_fetch_array(queryMysql($query));
	$name = $activity_type['name'];
	
	echo	"<div class='activityTitle'>";
	echo		"<div> $name </div>";
	echo	"</div>";
	
	$query = "SELECT * FROM performances WHERE activity_id='$activity_id'";
	$performances = queryMysql($query);
	
	while($performance = mysql_fetch_array($performances))
	{
		displayPerformance($performance);
	}
}

//////////////////////////////////////////////////////
function displayPerformance($performance)
{
	$nsets = $performance['nsets'];
	$nreps = $performance['nreps'];
	$weight = $performance['w'];
	$w_unit = $performance['w_unit'];
	$dist = $performance['d'];
	$d_unit = $performance['d_unit'];
	$time = $performance['t'];
	
	echo "<div class='performance'>";
	if ($nsets)
	{
		echo "<div class='sets-reps'> $nsets sets x $nreps reps x</div>";	
	}
	if ($weight)
	{
		echo "<div class='weight'> $weight $w_unit</div>";
	}
	if ($dist)
	{
		echo "<div class='dist-height'> $dist $d_unit</div>";
	}
	if ($time)
	{
		echo "<div class='time'> in $time</div>";
	}
	echo "</div>";
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
