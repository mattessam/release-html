<html>


<?php
require_once('functions.php');
$db_events = new MyDatabase();

function showHtmlResults ($queryResults) {
	//connect to database
	$db_events = new MyDatabase();
	//Format results
	//for each row as $result

	foreach ($queryResults as $result) {
		echo "<br>";
		echo '<h6><div id="blackbox">'.$result['Name']." , ".$result['Location']."</div></h6>";	 
		echo "<br>";
		echo '<p><img id="eventimage" src="'.$result['Image'].'" alt="Event Image"></img>'.'</p>';
		echo '<div id="description">'.$result['Description']."</div>";
		echo "<br>";
		echo '<div id="date"> <h2>Date:</h2>'.$result['Date']."</div>";
		echo "<br>";
		echo '<div id="lastentry"> <h2>Last Entry:</h2>'.$result['LastEntry']."</div>";
		echo "<blockquote>";
		echo '<div id="comment"> <h3> Comments </h3></div>';
				
  	$commentResults = $db_events->query("SELECT * FROM `comments` WHERE `Event_ID` = '".$result['Event_ID']."'");
		
		foreach ($commentResults as $comment) {
       echo '<div id="commentbox" ';
			 if ($_SESSION['username']==$comment['username']) {
			 		echo 'style="padding:10px;background-color:#ebedfb;">';
					echo '<h5>'.$comment['username'].':</h5>';
			 		?>

					<!--edit form -->
					
					<form action='index.php' method='POST'>
					<textarea name="editComment" rows="1" cols="25"><?php echo $comment['comment']; ?></textarea>
						<input type="hidden" name="editComment_ID" value=<?php echo $comment['Comment_ID']; ?>>
					
					<input type='submit' name='updateComment' value='Update'>
					</form>
					<!--delete form-->
					<form action='index.php' method='POST'>
					<input type="hidden" name="deleteComment_ID" value=<?php echo $comment['Comment_ID']; ?>>
					<input type='submit' name='deleteComment' value='Delete'>
					</form>
					<?php
			 }
			 else {
			 			echo '>'; //end comment div style tag i.e. no style because username did not match logged in username
			 			echo '<h6>'.$comment['username'].':</h6>'.$comment['comment'];
			 }
			 
			 echo "</div>";
		}
    echo "</blockquote>";
    
		//session_start();
    if (isset($_SESSION['logged'])) {
     echo "<br>Add Comment for event ".$result['Name']."<br>";
     ?>
     <form action='index.php' method='POST'>
     <textarea name="comment" rows="1" cols="25"></textarea>
     <input type="hidden" name="commentEventID" value="<?php echo $result['Event_ID']; ?>">
     <input type='submit' name='addComment' value='Add Comment'>
     </form> 
     <?php
    }
  }
}

if (isset($_POST['eventDate'])) {
	//get seperate day month year and put in array using explode with / seperator
  $dateParts = explode('/', $_POST['eventDate']);
	$day=$dateParts[1];
	$month=$dateParts[0];
	$year=$dateParts[2];
	
	//format date to SQL type
	$sqlDateFormat = date("Y-m-j", mktime(0,0,0,date($month), date($day), date($year)));
	
	
	if (isset($_POST['todaysEvents'])) {
	
  	//search for events on todays date
		$queryResults = $db_events->query("SELECT * FROM `events` WHERE `Date` = CURDATE()");
		//search for events after AND on todays date
		$queryResults = $db_events->query("SELECT * FROM `events` WHERE `Date` = CURDATE() OR `Date` = '".$sqlDateFormat."' ORDER BY `Date` ASC");
  	
	}
	else {
		//search for events after event date
  	$queryResults = $db_events->query("SELECT * FROM `events` WHERE `Date` = '".$sqlDateFormat."' ORDER BY `Date` ASC");
	
	}
 ?>
 <div id="resultsbar">
 <h6> Events matching your search: </h6>
 </div>
 <div id="eventbar">

<?php showHtmlResults($queryResults); ?>
		  
		</div>
	</body>
</html>

<?php
}

if (isset($_POST['search'])) {
	$searchTerm = clean_string($_POST['searchTerm']);	
  
  $queryResults = $db_events->query("SELECT * FROM `events` WHERE `Name` LIKE '%\\".$searchTerm."%' OR `Description` LIKE '%\\".$searchTerm."%'");
  
	if ($queryResults) {
		 	echo " Your search returned the following results ";
?>     
		 <div id="eventbar">

<?php showHtmlResults($queryResults); ?>
		  
		</div>
<?php
	}
	else {
			 echo "Sorry your search returned no results, try fewer words";
	}
}

?>

</html>