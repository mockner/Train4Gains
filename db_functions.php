<?php //db_functions.php

//Functions which take info out of the db and build php objects.

/**************************************************************************************/
/*	SECTION 1.
/*	DB --> PHP OBJECT
/**************************************************************************************/

//	*GET_WORKOUTS_BY_USER*	//
//
//@param $username		The username whos data will be displayed. 
//						For now, it will only be the current user
//
//@returns				An array of workout objects.
function get_workouts_by_user($username)
{
	$query ="SELECT * FROM users WHERE username ='$username'";
	$result = queryMysql($query);
	$user_data = mysql_fetch_array($result);
	$user_id = $user_data['id'];
	
	
	$query = "SELECT * FROM workouts WHERE user_id ='$user_id' ORDER BY date";
	$result = queryMysql($query);
	
	while($workout_data = mysql_fetch_array($result))
	{
		$workout_id = $workout_data['id'];
		$date = $workout_data['date'];
		$title = $workout_data['title'];
		$workout_object = new 
	}
}

//	*GET_WORKOUT_BY_WORKOUT_ID*	//
//
//@param $workout_id	The PRIMARY KEY of the workout to be fetched. 
//						See TABLE workouts in the mysql file.
//
//@returns				A single workout object.
function get_workout_by_workout_id($workout_id)
{
	$workout_id = $workout['id'];
	$date = $workout['date'];
	$title = $workout['title'];

	displayWorkoutTitle($date, $title);

	$query = "SELECT * FROM activities WHERE workout_id='$workout_id'";
	$activities = queryMysql($query);
	
	while($activity = mysql_fetch_array($activities))
	{
		displayActivity($activity);
	}
	echo "</div>";
}

//	*GET_ACTIVITIES_BY_WORKOUT_ID*	//
//
//@param $workout_id	The PRIMARY KEY of the workout containing the actvities to be fetched. 	
//
//@returns				A list of activity objects.
function get_activities_by_workout_id($workout_id)
{

}

//	*GET_PERFORMANCES_BY_ACTIVITY_ID*	//
//
//@param $activity_id	The PRIMARY KEY of the activity containing the performances to be fetched. 	
//
//@returns				A list of performance objects.
function get_performances_by_activity_id($activity_id)
{

}


/**************************************************************************************/
/*	SECTION 2.
/*	PHP OBJECT --> DB
/**************************************************************************************/


//	*SAVE_WORKOUT_FROM_OBJECT*	//
//
//@param $workout	The workout object which is to be saved to the database.
//
//@returns			NOTHING. Just saves the workout in the database.
function save_workout_from_object($workout)
{

}

//	*DELETE_WORKOUT_FROM_OBJECT*	//
//
//@param $workout	The workout object which is to be deleted from the database.
//
//@returns			NOTHING. Just deletes the workout from the database.
function delete_workout_by_id($workout)
{

}

//	*DELETE_ACTIVITY_FROM_OBJECT*	//
//
//@param $activity	The activity object which is to be deleted from the database.
//
//@returns			NOTHING. Just deletes the activity from the database.
function delete_activity_by_id($activity)
{

}

//	*DELETE_PERFORMANCE_FROM_OBJECT*	//
//
//@param $performance	The performance object which is to be deleted from the database.
//
//@returns			NOTHING. Just deletes the performance from the database.
function delete_performance_by_id($performance)
{

}
?>