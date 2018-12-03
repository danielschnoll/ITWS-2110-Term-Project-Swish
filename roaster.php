<?php 
  session_start();
  $currentUserId = $_SESSION['userID'];


  include('includes/init.inc.php'); // include the DOCTYPE and opening tags
?>
<title>Swish</title>

<?php
  // We'll need a database connection both for retrieving records and for 
  // inserting them.  Let's get it up front and use it for both processes
  // to avoid opening the connection twice.  If we make a good connection, 
  // we'll change the $dbOk flag.
  $dbOk = false;
  
  /* Create a new database connection object, passing in the host, username,
     password, and database to use. The "@" suppresses errors. */
  @ $db = new mysqli('localhost', 'root', '', 'swishdb');
  
  if ($db->connect_error) {
    echo '<div class="messages">Could not connect to the database. Error: ';
    echo $db->connect_errno . ' - ' . $db->connect_error . '</div>';
  } else {
    $dbOk = true; 
  }

?>

<?php 
  include('includes/head.inc.php'); 
?>

<?php
  if ($dbOk) {
    // This block is for the welcome message at the top center.
    echo '<a class = "brand-logo center"> Hi, ';
    $userQuery = 'SELECT * FROM users WHERE id=' . $currentUserId;
    $userResult = $db->query($userQuery);
    $userRecord = $userResult->fetch_assoc();
    echo $userRecord['username'];
    echo '!</a>';

    // This block is for the links on the right.
    echo '<ul class="right hide-on-med-and-down">';
    echo '<li><a id="navlinks" href="index.php">Home</a></li>';
    echo '<li class="active"><a id="navlinks" href="teams.php">Teams</a></li>';
    echo '<li class="active"><a id="navlinks" href="roaster.php">Roaster</a></li>';
    echo '<li><a id="navlinks" href="login.php">Logout</a></li>';
    echo '</ul>';

    $userResult->free();
  }

?>



<?php include('includes/roosterContent.php'); ?>



<?php

  $colors = array("lime", "red", "pink", "purple", "blue", "teal");
  //echo "I like " . $cars[0] . ", " . $cars[1] . " and " . $cars[2] . ".";


  if ($dbOk) {
    // Get the query of the relationship table: only has the ones with currentUserId
    $relationQuery = 'SELECT * FROM user_teams WHERE u_id='. $currentUserId;
    $relationResult = $db->query($relationQuery);
    $relationNumRecords = $relationResult->num_rows;





    for ($i = 0; $i < $relationNumRecords; $i++) {
      $record = $relationResult->fetch_assoc();



?>

<?php include('includes/eachTeam.php'); ?>

<?php


//echo 'exit>';
echo '<tbody>';

      // Grab the team info from the t_id
      $currentTeamId = $record['t_id'];


      $teamQuery = 'SELECT * FROM teams WHERE id = '. $currentTeamId;
      $teamResult = $db->query($teamQuery);
      $teamRecord = $teamResult->fetch_assoc();
      //echo ("enter");
     // echo '</tr></td>';



      echo $teamRecord['name'];

       
      $teamMembers = 'SELECT * FROM user_teams WHERE u_id='. $currentTeamId;
      $MembersResult = $db->query($teamMembers);
      $numTeamMembers = $MembersResult->num_rows;

      for ($x = 0; $x < $numTeamMembers; $x++) {
        echo '<tr><td>';
        
        $userId = $MembersResult->fetch_assoc();
        $currentUserId = $userId['t_id'];
        
        $currentMember = 'SELECT * FROM users WHERE id = '. $currentUserId;
        $memberResult = $db->query($currentMember);
        $memberInfo = $memberResult->fetch_assoc();

        echo $memberInfo['username'];
        echo '</td><tr>';

        

        $memberResult->free();


      }


      echo("</table> </div> </div> </div></div>");  

      //echo ($i . " and " . $numTeamMembers);


      $MembersResult->free();


      




      $teamResult->free();
    }





    $relationResult->free();
  }

?>



<?php include('includes/foot.inc.php'); 
  // footer info and closing tags
?>