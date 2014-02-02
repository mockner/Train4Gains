<?php //db_functions.php

//READ THIS FIRST:
//Functions which take info out of the db and build php objects.
//These functions will soon be moved into the classes which they operate on.
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
	
	
	$query = "SELECT id FROM workouts WHERE user_id ='$user_id' ORDER BY date";
	$result = queryMysql($query);
	
	$workout_object_list = array();
	while($workout_data = mysql_fetch_array($result))
	{
		$workout_id = $workout_data['id'];
		$workout_object = get_workout_by_workout_id($workout_id);
		$workout_object_list[] = $workout_object;
	}
	return $workout_object_list;
}

//	*GET_WORKOUT_BY_WORKOUT_ID*	//
//
//@param $workout_id	The PRIMARY KEY of the workout to be fetched. 
//						See TABLE workouts in the mysql file.
//
//@returns				A single workout object.
function get_workout_by_workout_id($workout_id)
{	
	//Fetch row from workout table.
	$query = "SELECT * FROM workouts WHERE id ='$workout_id'";
	$result = queryMysql($query);
	$workout_data = mysql_fetch_array($result);
	
	//Gather workout data.
	$date = $workout_data['date'];
	$title = $workout_data['title'];
	$user_id = $workout_data['user_id'];
	$activity_list = get_activities_by_workout_id($workout_id);
	
	//Build instance of Workout from the gathered data.
	$workout_object = new Workout($workout_id, $user_id, $date, $title, $activity_list);

	return $workout_object;
}

//	*GET_ACTIVITIES_BY_WORKOUT_ID*	//
//
//@param $workout_id	The PRIMARY KEY of the workout containing the actvities to be fetched. 	
//
//@returns				A list of activity objects.
function get_activities_by_workout_id($workout_id)
{
	$query = "SELECT * FROM activities WHERE workout_id='$workout_id'";
	$result = queryMysql($query);
	

	$activity_list = array();
	while($activity_data = mysql_fetch_array($result))
	{
		$activity_id = $activity_data['id'];
		$type_id =  $activity_data['type_id'];
		
		//Get the activity name from the activity_types table.
		$query = "SELECT name FROM activity_types WHERE id = '$type_id'";
		$type_result = queryMysql($query);
		$type_data = mysql_fetch_array($type_result);
		
		//Actual data that will go into the activity object.
		$name = $type_data['name'];
		$performance_list = get_performances_by_activity_id($activity_id);

		$activity = new Activity();
		$activity->id = $activity_id;
		$activity->workout_id = $workout_id;
		$activity->type_id = $type_id;
		$activity->name = $name;
		$activity->performance_list = $performance_list;
		
		$activity_list[] = $activity;
	}
	return $activity_list;
}


//	*GET_PERFORMANCES_BY_ACTIVITY_ID*	//
//
//@param $activity_id	The PRIMARY KEY of the activity containing the performances to be fetched. 	
//
//@returns				A list of performance objects.
function get_performances_by_activity_id($activity_id)
{
	$query = "SELECT * FROM performances WHERE activity_id='$activity_id'";
	$result = queryMysql($query);
	
	$performance_list =  array();
	while($perf_data = mysql_fetch_array($result))
	{
		$performance = new Performance();
		$performance->nsets = $perf_data['nsets'];
		$performance->nreps = $perf_data['nreps'];
		$performance->weight = $perf_data['w'];
		$performance->w_unit = $perf_data['w_unit'];
		$performance->dist = $perf_data['d'];
		$performance->d_unit = $perf_data['d_unit'];
		$performance->time = $perf_data['t'];
		$performance->id = $perf_data['id'];
		
		$performance_list[] = $performance;
		
	}
	return $performance_list;
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