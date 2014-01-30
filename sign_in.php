<?php // Example 21-7: sign_in.php
include_once 'header.php';
echo "<div class='main'><h3>Please enter your details to log in</h3>";
$error = $user = $pass = "";


//Here is where a user will try to log in.
//The $_POST superglobal variable holds info submitted in the below form's POST request.
//Check to make sure the 'user' field is actually present.
if (isset($_POST['user']))
{
	//Avoid SQL injections in the 'user' and 'pass' fields.
    $user = sanitizeString($_POST['user']);
    $pass = sanitizeString($_POST['pass']);
	
	//Make sure sanitation did not leave us with empty form values.
    if ($user == "" || $pass == "")
    {
        $error = "Not all fields were entered<br />";
    }
    else
    {
		//Query the users table.
        $query = "SELECT username,pwd FROM users
            WHERE username='$user' AND pwd='$pass'";

		
		//Invalid combination? PITY.
        if (mysql_num_rows(queryMysql($query)) == 0)
        {
            $error = "<span class='error'>Username/Password
                      invalid</span><br /><br />";
        }

		//Valid login? Save $_SESSION variables.
        else
        {
            $_SESSION['user'] = $user;
            $_SESSION['pass'] = $pass;
            die("You are now logged in as $user. Please <a href='home.php?view=$user'>" .
                "click here</a> to continue.<br /><br />");
        }
    }
}

echo <<<_END
<form method='post' action='sign_in.php'>$error
<span class='fieldname'>Username</span><input type='text'
    maxlength='16' name='user' value='$user' /><br />
<span class='fieldname'>Password</span><input type='password'
    maxlength='16' name='pass' value='$pass' />
_END;
?>

<br />
<span class='fieldname'>&nbsp;</span>
<input type='submit' value='Login' />
</form><br /></div></body></html>
