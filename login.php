<div id="login"> <h3> Login</h3> </div> 

<div id="loginform">
<form action='index.php' method='POST'>
Username: <input type='text' name='username'><br/>
Password: <input type='password' name='password'><br/>
<br/>
<input type='submit' name='submit' value='Login'>
</form>
</div>
<div id="register">
<a href='register.php'>Register</a>
</div>
<?php
	
  $username = clean_string($_POST['username']);
  $password = clean_string($_POST['password']);
  
	if ($username&&$password){
		require_once("db_connect.php");
    mysql_select_db("a200429031") or
    die ("<h1>Couldn't find db</h1>");
    $result = mysql_query("SELECT * FROM users WHERE username='$username'");
    $rows = mysql_num_rows($result);
    
    if ($rows>0){
		  $db_username = mysql_result($result,0,'username');
      $db_password = mysql_result($result,0,'password');
      //check username and password match
			if($username==$db_username&&md5($password)==$db_password){
        $_SESSION['username']=$username;
        $_SESSION['logged']="logged";
        header('Location: index.php');
      }
    	else{
				echo "<br>Incorrect password!";
      } 
    }
		else {
				echo "<BR>That user does not exist!";
		}
			
    
    require_once("db_close.php");
  }

?>
