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
    if (isset($_POST) && !empty($_POST['name'])) {
      $team_name = $_POST['name'];

      $sql = "SELECT * FROM `teams` WHERE `name` = \"" . $team_name . "\"";
      $userResult = $db->query($sql);
      $userRecord = $userResult->fetch_assoc();

      if ($userRecord['name'] != $team_name) {
        # echo("There's no team with this name.");

        header("Location: teams.php?msg=There is no team with that name.");
        exit;
      } else
      {
        $sql = "SELECT * FROM `user_teams` WHERE `u_id` = \"" . $currentUserId . "\" AND `t_id` = \"" . $userRecord['id'] . "\"";
        $userTeamsResult = $db->query($sql);
        $userTeamsRecord = $userTeamsResult->fetch_assoc();

        if ($userTeamsRecord != NULL) {
          $relationSQL = "DELETE FROM `user_teams` WHERE `u_id` = \"" . $currentUserId . "\" AND `t_id` = \"" . $userRecord['id'] . "\"";
          $relationResult = $db->query($relationSQL);

          header("Location: index.php?msg=You are now off that team.");
          exit;
        }

        header("Location: teams.php?msg=You are not on that team. This should never happen.");
        exit;

        # echo("You are already on that team.");
      }
    } else
    {
        header("Location: teams.php?msg=Invalid input.");
        exit;
    }
  }
?>
