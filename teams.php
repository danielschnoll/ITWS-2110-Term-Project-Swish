<?php 
  session_start();

  if (!isset($_SESSION['userID'])) {
    header("Location: login.php?msg=Please login.");
    exit;
  }

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
  } else
  {
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
    echo '<li class="active"><a id="navlinks" href="teams.php">Team Management</a></li>';

    echo '<li><a id="navlinks" href="roster.php">Roster</a></li>';
    echo '<li><a id="navlinks" href="login.php">Logout</a></li>';
    echo '<li><a id="navlinks" href="logout_action.php">Logout</a></li>';
    echo '</ul>';

    $userResult->free();
  }

?>

<?php include('includes/teamsforms.inc.php');
?>

<?php include('includes/notifications.inc.php');
?>

<?php include('includes/foot.inc.php'); 
  // footer info and closing tags
?>
