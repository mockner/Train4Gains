<?php //structures.php

class Workout
{
	public $id;
	public $user_id, $date, $title, $activity_list;
}

class Activity
{
	public $id;
	public $workout_id, $type_id;
}

class Performance
{
	public $id;
	public $activity_id, $nsets, $nreps, $d, $d_unit, $t, $w, $w_unit;
}

?>