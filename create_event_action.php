<?php
  session_start();
  $currentUserId = $_SESSION['userID'];

  /* Create a new database connection object, passing in the host, username,
   password, and database to use. The "@" suppresses errors. */

  @ $db = new mysqli('localhost', 'root', '', 'swishdb');

  if ($db->connect_error) {
      echo '<div class="messages">Could not connect to the database. Error: ';
      echo $db->connect_errno . ' - ' . $db->connect_error . '</div>';
  } else
  {
    if (isset($_POST)) {
      $home_name = $_POST['home_name'];
      $away_name = $_POST['away_name'];
      $location = $_POST['location'];
      $date= $_POST['date'];
      $time= $_POST['time'];
      $datetime = $date . ' ' . $time;

      $sql = "SELECT * FROM `teams` WHERE `name` = \"" . $home_name . "\"";
      $homeResult = $db->query($sql);
      $homeRecord = $homeResult->fetch_assoc();

      $sql = "SELECT * FROM `teams` WHERE `name` = \"" . $away_name . "\"";
      $awayResult = $db->query($sql);
      $awayRecord = $awayResult->fetch_assoc();

      if($homeRecord['name'] != $home_name || $awayRecord['name'] != $away_name) {
        # echo("One of these teams doesn't exist.");

        header("Location: teams.php?alert=One of these teams does not exist.");
        exit;
      } else
      {
        $relationSQL = "INSERT INTO `events` (home_id, away_id, date, location, home_score, away_score) VALUES (\"" . $homeRecord['id'] . "\", \"" . $awayRecord['id'] . "\", \"" . $datetime . "\", \"" . $location . "\", 0, 0)";
        $relationResult = $db->query($relationSQL);

        header("Location: index.php");
        exit;
      }
    }
  }
?>
