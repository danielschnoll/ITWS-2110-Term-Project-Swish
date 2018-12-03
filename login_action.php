<?php
	/* Create a new database connection object, passing in the host, username,
	 password, and database to use. The "@" suppresses errors. */

    @ $db = new mysqli('localhost', 'root', '', 'swishdb');

	if ($db->connect_error) {
    	echo '<div class="messages">Could not connect to the database. Error: ';
    	echo $db->connect_errno . ' - ' . $db->connect_error . '</div>';
  } else
  {
  	/* Grabs the password from the form and hashes it for comparison to the password stored in the table*/

    $email = $_POST['email'];
	$hashedpw = password_hash($_POST['password'], PASSWORD_DEFAULT);

	$sql = "SELECT * FROM `users` WHERE `email` = \"" . $email . "\"";
	$userResult = $db->query($sql);
	$userRecord = $userResult->fetch_assoc();

    if (password_verify($_POST['password'], $userRecord['password'])){
      session_start();
      $_SESSION['userID'] = $userRecord['id'];

      header("Location: index.php?msg=You have been logged in.");
      exit;
    } else
    {
        header("Location: login.php?msg=You do not have an account.");
        exit;

    	# echo ("You do not have an account");
    }

    $userResult->free();
  }
?>
