<?php

include_once("functions.php");

// Set up the ReCatptcha Solution
require_once('../../../2740/recaptcha/recaptchalib.php');
$publickey = "6Ldbd8ASAAAAAL96lIWHSDRmoaVJhgQJuKQwXNbd";
$privatekey = "6Ldbd8ASAAAAAFz8VT29H5w4WLNjsbI-mFY2QkaC";
$resp = recaptcha_check_answer($privatekey,
                                   
$_SERVER["REMOTE_ADDR"],
$_POST["recaptcha_challenge_field"],
$_POST["recaptcha_response_field"]);
$recaptcha_form = recaptcha_get_html($publickey);
    
// Grab and clean the form data
$submit = clean_string($_POST['submit']);
$username = clean_string($_POST['username']);
$password = clean_string($_POST['password']);
$repeatpassword = clean_string($_POST['repeatpassword']);
    
// Create some variables to hold output data
$message = '';
$s_username = '';
    
// Start to use PHP session
session_start();

// Determine whether user is logged in - test for value in &_SESSION
if (isset($_SESSION['logged'])){
    $s_username = $_SESSION['username'];
    $message = "You are already logged in as $s_username.
    Please <a href='logout.php'>logout</a> before
    trying to register.";
    }else{
        // Next block of code will go here
        if ($submit=='Register'){
            // Process submission here
                if (!$resp->is_valid) {
                   // What happens when the CAPTCHA was entered incorrectly
                    $errMessage = $resp->error;
                    $message = "<strong>The reCAPTCHA wasn't entered
                    correctly. Please try again.</strong><br />" .
                    "(reCAPTCHA said: $errMessage)<br />";
                    }else {
                    // Process valid submission data here
                    if ($username&&$password&&$repeatpassword){
                        if ($password==$repeatpassword){
                            // Process details here
                        if (strlen($username)>25) {
                            $message = "Username is too long";
                        }else{
                            if (strlen($password)>25||strlen($password)<6) {
                                $message = "Password must be between 6 and 25
                                characters";
                            }else{
                                // Process details here


                                require_once("db_connect.php"); //include file to do db connect
                                if($db_server){

                                    mysql_select_db("a200429031");
                                    // check whether username exists
                                    $taken = mysql_query("SELECT username FROM users WHERE
                                    username='$username'");
                                    $count = mysql_num_rows($taken);

                                        if ($count>0){

                                            $message = "Username already exists. Please try again.";

                                        }else{
                                               //encrypt password
                                                $password = md5($password);
                                                $query = "INSERT INTO users (username, password) VALUES
                                                            ('$username', '$password')";
                                                mysql_query($query) or die("Insert failed. " . mysql_error() .
                                                                "<br />" . $query);
                                                $message = "<strong>Registration successful!</strong><br />
                                                <a href='index.php'>Return to login page</a>";
                                            }

                                }else{

                                $message = "Error: could not connect to the database.";
                                }
                                require_once("db_close.php"); //include file to do db close


                            }
                        }
                        }else{
                            $message = "Both password feilds must match, please re enter your ";
                        }
                    }else{
                        $message = "Please fill in all fields";
                    }
            }
}
}

?>

<html>
    <head>
        <link rel="stylesheet" type="text/css" href="style.css" />
    </head>
<body>
  <div id="mainwrapper">
	
    <div id ="topbar">
	
	<div id="banner" class="headcontainer">
		
	  <div id="logo" class="headcontainer">
	    
	    <img src="Nightlifetxt.png"/>
	  </div><!--end logo-->
	  
	</div><!--end banner-->
    </div><!--end topbar-->
      
      
      <header>
    
	 <nav class="headcontainer">
                <ul class="clearfix">
                    <li><a href="index.php" title="Home" />HOME</a></li>
                    <li><a href="#" title="About" />ABOUT</a></li>
                    <li><a href="#" title="Blog" />BLOG</a></li>
                    <li><a href="#" title="Links" />LINKS</a></li>
                </ul>
         </nav>
    	   
      </header>
      
      
    <div id="container" class="contain">
        <div id="maincontent">
        <div id="registerpage">
          <form action='register.php' method='post'>
            
            
                
            <div id="registerbar">
            <h2>Register</h2>
            </div><!--end registerbar-->
            
            <div id="registerform">
            <h3><?php echo $message; ?></h3>
            Username:<input type='text' name='username'
            value='<?php echo $username; ?>'></br></br>
            Password: <input type='password' name='password'></br></br>
            Repeat Password: <input type='password' name='repeatpassword'></br></br>
            <input type='submit' name='submit' value='Register'>
            <input name='reset' type='reset' value='Reset'>
                
                
            <div id="recaptcha">    
            <?php
            echo $recaptcha_form;
            ?>
            </div><!--end captcha-->
            </form>
            
            </div><!--end from-->
        </div><!--end register-->
        </div><!--end maincontent-->
    </div><!--end container-->
    
    <div id="footer">
	
	
    </div><!--end footer-->
 </div><!--end mainwrapper-->       


</html>