<?php //performance_model.php



class Performance
{
	public $id;
	public $performance_id; 
	public $nsets, $nreps, $d, $d_unit, $t, $w, $w_unit;
	
//////////////////////////////////////////////////////////////////////////////////////////////////////
//	*CREATE*	//
//
//@returns				A new Performance object.
//////////////////////////////////////////////////////////////////////////////////////////////////////

	static function create()
	{
		$p = new Performance;
		return $p;
	}
	
//////////////////////////////////////////////////////////////////////////////////////////////////////
//	*GET*	//
//
//@param $id	The PRIMARY KEY of the performance to be fetched. 	
//
//@returns				A Performance object corresponding to a row of the performances table.
//////////////////////////////////////////////////////////////////////////////////////////////////////

	static function get($id)
	{
		$result = queryMysql("SELECT * FROM performances WHERE id = '$id'");
		$row = mysql_fetch_array($result);
		$p = get_performance_from_sql_row($row);
		
		return $p;
	}
	
//////////////////////////////////////////////////////////////////////////////////////////////////////
//	*GET_ALL_BY_ACTIVITY_ID*	//
//
//@param $activity_id	The PRIMARY KEY of the activity containing the performances to be fetched. 	
//
//@returns				A list of performance objects.
//////////////////////////////////////////////////////////////////////////////////////////////////////

	static function get_all_by_activity_id($activity_id)
	{
		//Make the query.
		$result = queryMysql("SELECT * FROM performances WHERE activity_id='$activity_id'");
		
		//The list to be returned.
		$performances = array();
		
		while($row = mysql_fetch_array($result))
		{	
			$p = Performance::get_performance_from_sql_row($row);
			$performances[] = $p;
		}
		return $performances;
	}
	
//////////////////////////////////////////////////////////////////////////////////////////////////////
//	*SAVE*	//
//
//@param $activity_id	The PRIMARY KEY of the activity associated with the saved performances.
//
//@returns				A list of performance objects.
//////////////////////////////////////////////////////////////////////////////////////////////////////

	static function save($p,$activity_id)
	{
		queryMysql(	"INSERT INTO performances(nreps, nsets, d, d_unit, t, w, w_unit, activity_id) VALUES ('$p->nreps', '$p->nsets', '$p->d', '$p->d_unit', '$p->t', '$p->w', '$p->w_unit', '$activity_id')");
	}
	
//////////////////////////////////////////////////////////////////////////////////////////////////////
//	*DELETE*	//
//
//@param $activity		Activity to be deleted	
//////////////////////////////////////////////////////////////////////////////////////////////////////

	static function delete($p)
	{
		//Delete row from the performances table.
		queryMysql("DELETE FROM activities WHERE id = $p->id ");

		//Get all performances who belong to this performance, and delete them.
		foreach($a.performances as $p)
		{
			Performance::delete($p);
		}
	}
	
//////////////////////////////////////////////////////////////////////////////////////////////////////
//	*DELETE_ALL_BY_ACTIVITY_ID*	//
//
//@param $activity_id		Activity id associated with performances to be deleted.
//////////////////////////////////////////////////////////////////////////////////////////////////////

	static function delete_all_by_activity_id($activity_id)
	{
		//Delete row from the performances table.
		queryMysql("DELETE FROM performances WHERE activity_id = $activity_id ");
	}
	
	function is_valid()
	{
		return true;
	}
	
	static function get_performance_from_sql_row($row)
	{
			$performance = new Performance();
			$performance->id = $row[ 'id'];
			$performance->nsets = $row[ 'nsets'];
			$performance->nreps = $row[ 'nreps'];
			$performance->d = $row[ 'd'];
			$performance->d_unit = $row[ 'd_unit'];
			$performance->t = $row[ 't'];
			$performance->w = $row[ 'w'];
			$performance->w_unit = $row[ 'w_unit'];
			
			return $performance;
	}
}



?>