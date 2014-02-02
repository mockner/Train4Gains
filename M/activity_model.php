<?php //activity_model.php

class Activity
{
	public $id;
	public $workout_id, $type_id;
	public $name;
	public $perfomances;
	
///////////////////////////////////////////////////////////////////////////////////////////////	
//	*CREATE*	//
//
//@returns		A new Activity object.
///////////////////////////////////////////////////////////////////////////////////////////////
	static function create()
	{
		return new Activity;
	}
	
///////////////////////////////////////////////////////////////////////////////////////////////	
//	*GET*	//
//
//@param $id	The PRIMARY KEY of the Activity to be fetched.
//
//@returns		An Activity object representing stored activity data.
///////////////////////////////////////////////////////////////////////////////////////////////
	static function get($id)
	{
		$result = queryMysql("SELECT * FROM activities WHERE id = '$id'");
		$row = mysql_fetch_array($result);
		$a = get_activity_from_sql_row($row);
		return $a;
	}

//////////////////////////////////////////////////////////////////////////////////////////////	
//	*GET_ALL_BY_WORKOUT_ID*	//
//
//@param $workout_id	The PRIMARY KEY of the workout containing the actvities to be fetched. 	
//
//@returns				A list of activity objects.
///////////////////////////////////////////////////////////////////////////////////////////////

	static function get_all_by_workout_id($workout_id)
	{
		//Make the query.
		$result = queryMysql("SELECT * FROM activities WHERE workout_id='$workout_id'");
		
		//The list to be returned.
		$activity_list = array();
		while($row = mysql_fetch_array($result))
		{
			$a = Activity::get_activity_from_sql_row($row);
			$activity_list[] = $a;
		}
		return $activity_list;
	}
	
//////////////////////////////////////////////////////////////////////////////////////////////	
//	*SAVE*	//	saves activity into activities table, and attached performances into performances table.
//
//@param 	$a				The activity to be saved	
//			$workout_id		The workout that the activity is associated with. (MUST be attached to a workout.)
///////////////////////////////////////////////////////////////////////////////////////////////

	static function save($a, $workout_id)
	{
		queryMysql("INSERT INTO activities (type_id, workout_id) VALUES ('$a->type_id', '$workout_id' )");
		
		$activity_id = mysql_insert_id();
		foreach($a->performances as $p)
		{
			Performance::save($p, $activity_id);
		}
	}

//////////////////////////////////////////////////////////////////////////////////////////////	
//	*DELETE*	//
//
//@param $a				The activity to be deleted.	
//
//Deletes the corresponding row from the activity table. 
//Also deletes all associated rows in the performances table, because no performance should
//exist without a parent activity.
///////////////////////////////////////////////////////////////////////////////////////////////

	static function delete($a)
	{
		//Delete row from the activities table.
		queryMysql("DELETE FROM activities WHERE id = $a->id ");

		//Get all performances who belong to this activity, and delete them.
		Performance::delete_all_by_activity_id($a->id);
	}
	
//////////////////////////////////////////////////////////////////////////////////////////////	
//	*DELETE_ALL_BY_WORKOUT_ID*	//
//
//@param $workout_id				The workout_id associated with the activities to be deleted.	
//
///////////////////////////////////////////////////////////////////////////////////////////////

	static function delete_all_by_workout_id($workout_id)
	{
		foreach(Activity::get_all_by_workout_id($workout_id) as $a)
		{
			Activity::delete($a);
		}
	}
//////////////////////////////////////////////////////////////////////////////////////////////	
//	*GET_ACTIVITY_FROM_SQL_ROW*	//
//
//@param $row		row containing activity data
//
//returns 			activity object.	
///////////////////////////////////////////////////////////////////////////////////////////////
	private static function get_activity_from_sql_row($row)
	{
			$id 		= 	$row[ 'id'];
			$type_id 	=  	$row['type_id'];
			
			//Get the activity name from the activity_types table.
			$type_result = queryMysql("SELECT name FROM activity_types WHERE id = '$type_id'");
			$type_data = mysql_fetch_array($type_result);
			
			$name 		= 	$type_data['name'];
			
			//Create an instance and load it up.
			$activity = new Activity();
			
			$activity->id 			= $id;
			$activity->type_id 		= $type_id;
			$activity->name 		= $name;
			$activity->performances = Performance::get_all_by_activity_id($id);
			
			return $activity;
	}
	
	

}

?>