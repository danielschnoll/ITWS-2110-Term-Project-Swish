<?php
  session_start();
  $currentUserId = $_SESSION['userID'];

  /* Create a new database connection object, passing in the host, username,
   password, and database to use. The "@" suppresses errors. */
  @ $db = new mysqli('localhost', 'root', '', 'swishdb');
  if ($db->connect_error) {
      echo '<div class="messages">Could not connect to the database. Error: ';
      echo $db->connect_errno . ' - ' . $db->connect_error . '</div>';
  } 

  else{
    if (isset($_POST)){
      $team_name = $_POST['name'];

      $sql = "SELECT * FROM `teams` WHERE `name` = \"" . $team_name . "\"";

      $userResult = $db->query($sql);

      $userRecord = $userResult->fetch_assoc();

      if($userRecord['name'] != $team_name){
        echo("There's no team with this name.");
      }
      else{
        
        $relationSQL = "INSERT INTO `user_teams` (u_id, t_id) VALUES (\"" . $currentUserId . "\", \"" . $userRecord['id'] . "\")";
        $relationResult = $db->query($relationSQL);

        header("Location: index.php");
        exit;
      }
    }
    
    
  }
?>