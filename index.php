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
    echo '<li class="active"><a id="navlinks" href="index.php">Home</a></li>';
    echo '<li><a id="navlinks" href="teams.php">Teams</a></li>';
    echo '<li><a id="navlinks" href="login.php">Logout</a></li>';
    echo '</ul>';

    $userResult->free();
  }
?>

<?php include('includes/teamblock.inc.php'); ?>

<?php
  // This block is for the teams block on the left.

  // Need to record these now so we don't have to loop through the table again
  $totalWins = 0;
  $totalLosses = 0;

  if ($dbOk) {
    // Get the query of the relationship table: only has the ones with currentUserId
    $relationQuery = 'SELECT * FROM user_teams WHERE u_id='. $currentUserId;
    $relationResult = $db->query($relationQuery);
    $relationNumRecords = $relationResult->num_rows;

    echo '<tbody>';
    for ($i = 0; $i < $relationNumRecords; $i++) {
      $record = $relationResult->fetch_assoc();
      echo '<tr><td>';

      // Grab the team info from the t_id
      $currentTeamId = $record['t_id'];

      $teamQuery = 'SELECT * FROM teams WHERE id = '. $currentTeamId;
      $teamResult = $db->query($teamQuery);
      $teamRecord = $teamResult->fetch_assoc();

      // Recording the table content

      echo $teamRecord['name'];
      echo '</td><td>';
      echo $teamRecord['wins'];

      $totalWins += $teamRecord['wins'];
      echo ':';
      echo $teamRecord['losses'];

      $totalLosses += $teamRecord['losses'];
      echo '</td></tr>';

      $teamResult->free();
    }

    $relationResult->free();
  }
?>

<?php include('includes/upcoming.inc.php'); ?>

<?php
  // This block is for the upcoming events block in the middle

  if ($dbOk) {

    // Get the query of the events table: only has the one past today's date
    $eventsQuery = 'SELECT * FROM events WHERE NOW() < date';
    $eventsResult = $db->query($eventsQuery);
    $eventsNumRecords = $eventsResult->num_rows;

    echo '<tbody>';

    for ($i = 0; $i < $eventsNumRecords; $i++) {
      // "Boolean" values to track whether this event is either a home game or not,
      // -1 indicates it's not and 1 indicates it is

      $isHome = -1;
      $homeTeamId = 0;
      $isAway = -1;
      $awayTeamId = 0;

      $eventsRecord = $eventsResult->fetch_assoc();

      // Get the query of the relationship table, but only
      // the ones with the current user

      $relationQuery = 'SELECT * FROM user_teams WHERE u_id='. $currentUserId;
      $relationResult = $db->query($relationQuery);
      $relationNumRecords = $relationResult->num_rows;

      // Loop through the relationship table

      for ($j = 0; $j < $relationNumRecords; $j++) {
        $relationRecord = $relationResult->fetch_assoc();

        // This checks if it's a home game

        if ($eventsRecord['home_id'] == $relationRecord['t_id']) {
          $isHome = 1;
          $homeTeamId = $eventsRecord['home_id'];
          $awayTeamId = $eventsRecord['away_id'];
        }

        // This checks if it's an away game

        if ($eventsRecord['away_id'] == $relationRecord['t_id']) {
          $isAway = 1;
          $homeTeamId = $eventsRecord['home_id'];
          $awayTeamId = $eventsRecord['away_id'];
        }
      }

      $relationResult->free();

      // This checks if either of the booleans were set to true,
      // and puts it onto the website if it is
      if ($isHome == 1 || $isAway == 1) {

        echo '<tr><td>';

        // Get the name of the home team

        $homeTeamQuery = 'SELECT name FROM teams WHERE id='.  $homeTeamId;
        $homeTeamResult = $db->query($homeTeamQuery);
        $homeTeamRecord = $homeTeamResult->fetch_assoc();

        // This if statement is to check if the user is part of
        // these teams, and bold the team name if they are

        if ($isHome == 1) {
          echo '<strong><i>' . $homeTeamRecord['name'] . '</i></strong>';
        } else
        {
          echo $homeTeamRecord['name'];
        }

        echo '</td><td>';

        $homeTeamResult->free();

        // Get the name of the away team

        $awayTeamQuery = 'SELECT name FROM teams WHERE id='.  $awayTeamId;
        $awayTeamResult = $db->query($awayTeamQuery);
        $awayTeamRecord = $awayTeamResult->fetch_assoc();

        // This if statement is to check if the user is part of
        // these teams, and bold the team name if they are

        if ($isAway == 1) {
          echo '<strong><i>' . $awayTeamRecord['name'] . '</i></strong>';
        } else
        {
          echo $awayTeamRecord['name'];
        }

        echo '</td><td>';

        $awayTeamResult->free();

        // This is for recording the location and time in the table

        echo $eventsRecord['location'];
        echo '</td><td>';

        $date = strtotime($eventsRecord['date']);

        echo date('m-d-Y, H:i', $date);
        echo '</td><td></tr>';
      }

      echo '</tbody>';
    }

    $eventsResult->free();
  }
?>

<?php include('includes/personalstats.inc.php'); ?>

<?php
    // This block is for the personal statistics block on the right

  if ($dbOk) {
    echo '<tbody><tr><td>Win / Loss Ratio</td><td>';
    echo $totalWins;
    echo ':';
    echo $totalLosses;
    echo '</td></tr><tr><td>Total Games Played</td><td>';
    echo $totalLosses + $totalWins;
    echo '</td></tr></tbody>';
  }
?>

<?php include('includes/foot.inc.php');
  // footer info and closing tags
?>
