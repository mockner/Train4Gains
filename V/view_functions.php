<?php //view_functions.php


//	*DISPLAY WORKOUT IN NORMAL VIEW*	//
function display_workout($w)
{
	echo "<div class='workout'>";
	display_workout_title($w->date, $w->title);
	foreach($w->activity_list as &$activity_object)
	{
		display_activity($activity_object);
	}
}

///////////////////////////////////////////////////////////////
function display_workout_title($date, $title)
{
echo "<div class='workoutTitle'>";
echo 	"<div class='date'> $date </div>";
echo 	"<div class='title'> $title </div>";
echo "</div>";
}
/////////////////////////////////////////////////////////
function display_activity($a)
{	
	echo "<div class='activity'>";
	//echo "<div class='activity-id'> $a->id </div>"; //We will deal with this later.
	
	echo	"<div class='activityTitle'>";
	echo		"<div> $a->name </div>";
	echo	"</div>";
	
	foreach($a->performance_list as &$performance_object)
	{
		display_performance($performance_object);
	}
	echo "</div>";
}

//////////////////////////////////////////////////////
function display_performance($p)
{
	echo "<div class='performance'>";
	if ($p->nsets)
	{
		echo "<div class='sets-reps'> $p->nsets sets x $p->nreps reps x</div>";	
	}
	if ($p->weight)
	{
		echo "<div class='weight'> $p->weight $p->w_unit</div>";
	}
	if ($p->dist)
	{
		echo "<div class='dist-height'> $p->dist $p->d_unit</div>";
	}
	if ($p->time)
	{
		echo "<div class='time'> in $p->time</div>";
	}
	echo "</div>";
}





//	*DISPLAY WORKOUT IN EDITOR/BUILDER*	//
function display_edit_workout($w)
{
	echo "<div class='workout'>";
	display_edit_workout_title($w->date, $w->title);
	$activity_list = $w->activity_list;
	foreach($activity_list as &$activity_object)
	{
		display_activity($activity_object);
	}
}

///////////////////////////////////////////////////////////////
function display_edit_workout_title($date, $title)
{
echo "<div class='workoutTitle'>";
echo 	"<div class='date'> $date </div>";
echo 	"<div class='title'> $title </div>";
echo "</div>";
}
/////////////////////////////////////////////////////////
function display_edit_activity($a)
{	
	echo "<div class='activity'>";
	//echo "<div class='activity-id'> $a->id </div>"; //We will deal with this later.
	
	echo	"<div class='activityTitle'>";
	echo		"<div> $a->name </div>";
	echo	"</div>";
	
	foreach($a->performance_list as &$performance_object)
	{
		display_performance($performance_object);
	}
	echo "</div>";
}

//////////////////////////////////////////////////////
function display_edit_performance($p)
{
	echo "<div class='performance'>";
	if ($p->nsets)
	{
		echo "<div class='sets-reps'> $p->nsets sets x $p->nreps reps x</div>";	
	}
	if ($p->weight)
	{
		echo "<div class='weight'> $p->weight $p->w_unit</div>";
	}
	if ($p->dist)
	{
		echo "<div class='dist-height'> $p->dist $p->d_unit</div>";
	}
	if ($p->time)
	{
		echo "<div class='time'> in $p->time</div>";
	}
	echo "</div>";
}
?>