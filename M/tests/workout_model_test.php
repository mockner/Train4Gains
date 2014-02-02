<?php //workout_model_test.php
include_once '../../header.php';
include_once '../workout_model.php';
include_once '../activity_model.php';
include_once '../performance_model.php';

//	*TEST 1*	//
//Test the get() and save() functions.
echo "<div> Test 1 </div>";
$w = Workout::get(1);
echo "<div> Found workout with id = $w->id</div>";
echo "<div> It has a title of: $w->title and a Date of: $w->date</div>";
$w->title = "new title";
echo "<div>about to save</div>";
Workout::save($w);
echo "<div>saved</div>";
$v = Workout::get(1);
echo "<div>Changed title, saved, and now pulled out of database again via .get() method.</div>";
echo "<div> Now it has a title of: $v->title</div>";

if ($v->title == "new title"){echo "Success!";}
else {echo "Failure.";}

//restore db to normal.
$w->title = "old title";
Workout::save($w);


//	*TEST 2*	//
//Test New and delete:

echo "<div>Test 2</div>";

//Create a new workout.
$w = Workout::create();
$w->user_id = 1;
$w->title = 'test-2';
$w->date = '2014-01-31';
$w->activities = array();

//Create a new activity.
$a = Activity::create();
$a->name = 'squat';
$a->type_id = 1;

//Create a new performance.
$p = Performance::create();
$p->nsets = 6;
$p->nreps = 2;
$p->w = 352;
$p->d = 0;
$p->t = 0;
$p->w_unit = 'lb';

//put them together into a workout with 1 set of 1 activity.
$a->performances[] = $p;
$w->activities[] = $a;

//save.
echo "<div>saving<div>";
Workout::save($w);

//verify save.
$id = $_SESSION['workout_last_insert'];

echo "fetching workout with id = $id";
$v = Workout::get($id);
foreach($v->activities as $a)
{
	echo "<div>activity: $a->name</div>";
	foreach($a->performances as $p)
	{
		foreach(get_object_vars($p) as $var)
		{
			echo "<div> $var <div>";
		}
	}
}
Workout::delete($v);
Workout::get($w->id);
 ?>
 