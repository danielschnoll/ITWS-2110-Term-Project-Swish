<?php 
  include('includes/init.inc.php'); // include the DOCTYPE and opening tags
?>
<title>Swish - Make an Account</title>

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


<style>
  form{
    height: 200px;
    color: black;
  }
</style>

<div class = "row"></div>
<div class = "row"></div>
<div class = "row"></div>
<div class="section"></div>
<div class = "container">
  <div class = "row">
    <div class="col s12">
      <div class = "card">
        <div class = "card-content text-black">
          <form class = "container" action = "account_create_action.php" method = "post">
            <div class = "row">

              <div class="input-field col s12 ">
                <input name = "email" id="email" type="email" class="validate">
                <label for="email">Email</label>
              </div>
              <div class="input-field col s12">
                <input name = "username" id="username" type="text" class="validate">
                <label for="username">Name</label>
              </div>
              <div class="input-field col s12">
                <input name = "password" id="password" type="password" class="validate">
                <label for="password">Password</label>
              </div>
              <div class="input-field col s6 m2 l2">
                <button class="btn waves-effect waves-light" type="submit" name="action">
                  Submit <i class="material-icons right">send</i>
                </button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>


<?php include('includes/foot.inc.php'); 
  // footer info and closing tags
?>
