<?php
include_once('../../../2740/recaptcha/recaptchalib.php');

class MyDatabase {
	
	//Function MyDatabase called when class MyDatabase created
	function MyDatabase() {
		
		// connect to database
    $db_hostname = 'localhost';
    $db_database = 'a200429031';
    $db_username = 'a200429031';
    $db_password = 'paparoach1';
    
    
		//Setup connection store link identifier in $this->db_server

    $this->db_link = mysql_connect($db_hostname, $db_username, $db_password);	
		if ($this->db_link === FALSE){
    	 die("Unable to connect to MySQL: " . mysql_error());
		}

		//Succefully connected (logged in) to MySQL
		//Select the database to be used in MySQL quieries
		$this->query("USE ".$db_database);
	}
	
	function close() {
			mysql_close($this->db_link);
	}
	
	//do MySQL query and return an array of results (rows) using mysql_num_rows
  function query($MySQLString) {
		 //check MySQL query is valid

		 $this->lastQueryID = mysql_query($MySQLString);
		 if ($this->lastQueryID === FALSE) {
  			die("Database query failed: " . mysql_error());
  	 }
		 
		 //loop until no more results
		 // get next result put in nextrow and test for FALSE using the while
		 while ($nextRow = mysql_fetch_assoc($this->lastQueryID)) {
				//add result to rows array
				$rows[$rowCount] = $nextRow;
				$rowCount++;
		 }

		 return $rows;
  }
	//functions for commments
	function addComment($username, $comment, $eventID) {
			$this->query("INSERT INTO comments (Event_ID,comment,username) VALUES('$eventID', '$comment', '$username' )"); 
	}
	
	function editComment($comment, $commentID) {
			$this->query("UPDATE comments SET comment = '".$comment."' WHERE `Comment_ID` = ".$commentID);
	}

	function deleteComment($comment, $commentID) {
			$this->query("DELETE FROM comments WHERE `Comment_ID` = $commentID");
	}
	
	function securityCheck($userLoggedIn, $commentID) {
			
			$results = $this->query("SELECT * FROM comments WHERE `Comment_ID` = $commentID AND `username` = '$userLoggedIn'");
			
			return is_array($results);					
	}
        
	//displays events that are greater than the current date
	function displayUpcomingEvents() {
			$queryResults = $this->query("SELECT * FROM events WHERE `Date` > CURDATE() ORDER BY `Date` ASC LIMIT 0,2");
			
			foreach ($queryResults as $result) {
							//remove p tag to have on one line
							echo '<div id="upcomingevents"><img src="'.$result['Image'].'" alt="'.$result['Description'].'"></img></br>'.$result['Name'].' - '.$result['Date'].'</div>';
                                                        
			}
	}
}

function clean_string($string){
    $string = trim($string);
    $string = utf8_decode($string);
    $string = str_replace("#", "&#35", $string);
    $string = str_replace("%", "&#37", $string);
    if (mysql_real_escape_string($string)) {
    $string = mysql_real_escape_string($string);
    }
    if (get_magic_quotes_gpc()) {
    $string = stripslashes($string);
    }
    return htmlentities($string);
    }
?>