<?php 
  include('includes/init.inc.php'); // include the DOCTYPE and opening tags
?>
<title>Swish - Login</title>

<?php
  // We'll need a database connection both for retrieving records and for 
  // inserting them.  Let's get it up front and use it for both processes
  // to avoid opening the connection twice.  If we make a good connection, 
  // we'll change the $dbOk flag.
  $dbOk = false;
  
  /* Create a new database connection object, passing in the host, username,
     password, and database to use. The "@" suppresses errors. */
  @ $db = new mysqli('localhost', 'root', 'swish', 'swishdb');
  
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
  if($dbOk){
    include('includes/loginbod.inc.php'); 
  }
?>


<?php include('includes/foot.inc.php'); 
  // footer info and closing tags
?>