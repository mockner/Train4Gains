<?php //builder.php

// *WORKOUT BUILDER*	//
//
// Page should contain <div class=workout>, with 
//<workout title> containing date + title.
//
//	For each activity in the workout, should create an edit-activity-box.
//	For each set in an activity, should create an edit-set-box.
//
//
//

echo <<<_END
<script>
function addPerformance(addPerformanceButton)
{
    params  = "type_id=" + type_id
    request = new ajaxRequest()
    request.open("POST", "addPerformance.php", true)
    request.setRequestHeader("Content-type", "application/x-www-form-urlencoded")
    request.setRequestHeader("Content-length", params.length)
    request.setRequestHeader("Connection", "close")
    
    request.onreadystatechange = function()
    {
        if (this.readyState == 4)
            if (this.status == 200)
                if (this.responseText != null)
                    .innerHTML = this.responseText
    }
    request.send(params)
}

function ajaxRequest()
{
    try { var request = new XMLHttpRequest() }
    catch(e1) {
        try { request = new ActiveXObject("Msxml2.XMLHTTP") }
        catch(e2) {
            try { request = new ActiveXObject("Microsoft.XMLHTTP") }
            catch(e3) {
                request = false
    }   }   }
    return request
}
</script>
<div class='main'><h3>Please enter your details to sign up</h3>
_END;

$error = $user = $pass = "";
if (isset($_SESSION['user'])) destroySession();

if (isset($_POST['user']))
{
    $user = sanitizeString($_POST['user']);
    $pass = sanitizeString($_POST['pass']);
    
    if ($user == "" || $pass == "")
        $error = "Not all fields were entered<br /><br />";
    else
    {
        if (mysql_num_rows(queryMysql("SELECT * FROM users
		      WHERE username='$user'")))
            $error = "That username already exists<br /><br />";
        else
		  {
            queryMysql("INSERT INTO users VALUES(null,'$user', '$pass')");
            die("<h4>Account created</h4>Please Log in.<br /><br />");
        }
    }
}

echo <<<_END
<form method='post' action='sign_up.php'>$error
<span class='fieldname'>Username</span>
<input type='text' maxlength='16' name='user' value='$user'
    onBlur='checkUser(this)'/><span id='info'></span><br />
<span class='fieldname'>Password</span>
<input type='text' maxlength='16' name='pass'
    value='$pass' /><br />
_END;





echo <<<_END
		<div id="editor">
			<div class="workout">
				<div class="workout-id"></div>
				<div class="workoutTitle">
					<input class="date" type="date" name="date" placeholder="date"> <!--TODO[javascript]:placeholder=current date. -->
					<input class = "title" type="text" name="title" placeholder="title">
					<button id="toSave" class="save"> save </button>
					<div class="trashcan"> </div>
				</div>
				
				<div class="activity">
					<div class="activity-id">1478</div>
					<div class="activityTitle">
						<div> Squat </div>
						<div class="plus"></div>
						<div class="trashcan"></div>
					</div>
						
					<div class = "set">
						<div class="data-id">60934532</div>
						<div class="sets-reps">
							<div class="label">
								Sets:</div>
							<input class="setInput" type="text" name="distanceInput" size="1">
							<div class="label">
								Reps:</div>
							<input class="repInput" type="text" name="distanceInput" size="1">
						</div>
						<div class="weight">
							<div class="label">
								Weight:</div>
							<input class="weightInput" type="text" name="weightInput" size="1">
							<select class="weightSelect">
								<option value="meter">lb</option>
								<option value="yard">kg</option>
							</select>
						</div>
						<div class="trashcan"> </div>					
					</div>
				</div>
			</div>
			<div id="myActivities">
				<div id="brandNewActivity">
					<div class="label"> New Activity</div>
					<input type="text" name="activity">
					<button id="toAdd" class="add"> add </button>

				</div>
				<div id="favorites">
					<div id="top">Saved Activities</div>
					<div>Squat</div>
					<div>Deadlift</div>
					<div>Bench Press</div>
					<div>One legged band resisted bunny hop.</div>
					<div>Squat</div>
				</div>
			</div>
		</div> 
_END;
?>