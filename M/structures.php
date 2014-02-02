<?php //structures.php

//All id values need to be stored silently in the front end somewhere, preferable attached to the objects they represent.
//For example, the id field in each performance should be attached to the front end representation of the performance,
//but it should not be visible to the user.



class Activity
{
	public $id;
	public $workout_id, $type_id;
	public $name;
	public $performance_list;
	
}

class Performance
{
	public $id;
	public $activity_id; 
	public $nsets, $nreps, $d, $d_unit, $t, $w, $w_unit;
}

?>