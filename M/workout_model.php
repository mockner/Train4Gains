<?php //workout_model.php

class Workout
{	
	public $id;				
	public $user_id;
	public $date;
	public $title;
	public $activities;
	
	//	*CREATES NEW WORKOUT*	//
	//
	//returns:	A brand new workout object, not yet associated with a table row.
	static function create()
	{
		$w = new Workout;
		return $w;
	}
	
	
	//	*GET EXISTING WORKOUT BY ID*	//
	//
	//$id:		The primary key used to look up a row from the workouts table.
	//returns:	The workout stored at row $id of the workouts table.
	public static function get($id)
	{
		$w = new Workout;
		$w->id = $id;
		
		//Fetch row from workout table.
		$query = "SELECT * FROM workouts WHERE id = '$id'";
		$result = queryMysql($query);
		$workout_data = mysql_fetch_array($result);

		
		//Set workout properties.
		$w->user_id = $workout_data['user_id'];
		$w->date = $workout_data['date'];		//necessary
		$w->title = $workout_data['title'];		//necessary
		$w->activities = Activity::get_all_by_workout_id($id);	//necessary
		
		return $w;
	}
	
/////////////////////////////////////////////////////////////////////////////////////////////
//	*SAVE WORKOUT OBJECT TO DATABASE*	//
//
//	When we overwrite or update an existing Workout, we choose to delete all activities and
//	performances associated with the workout, and insert them again. This greatly simplifies the 
//	save() functions for all 3 Model classes and is not costly, since overwriting is not common.
/////////////////////////////////////////////////////////////////////////////////////////////
	static function save($w)
	{
		//If the workout is already saved in the database...
		if (is_int($w->id))
		{
			//update the row in the workouts table.
			queryMysql("UPDATE workouts SET date = '$w->date', title = '$w->title' WHERE id = $w->id");
			$workout_id = $w->id;
			
			//...and clear out the existing rows from the activity table
			Activity::delete_all_by_workout_id($w->id);
		}
		else //If the workout isnt already in the table, then it was created in an environment that has access to $_SESSION['user'].
		{
			queryMysql("INSERT INTO workouts (title, date, user_id) VALUES ('$w->title', '$w->date', '$w->user_id' )");
			$workout_id = $_SESSION['workout_last_insert']= mysql_insert_id();
			
			//get the id value created for the newly saved workout.
		}
		
		foreach($w->activities as $a)
		{
			Activity::save($a, $workout_id);
		}
		
	}
	//	*DELETE WORKOUT*	//
	
	static function delete($w)
	{
		if (is_int($w->id))
		{
			queryMysql("DELETE FROM workouts WHERE id = $w->id ");
			Activity::delete_all_by_workout_id($w->id);
		}
	}
}

?>