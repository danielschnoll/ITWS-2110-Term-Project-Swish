
<?php
  session_start();
  session_regenerate_id();
  $tmp = session_id();
  session_destroy();
  session_id($tmp);
  unset($tmp);
  session_start();

  header("Location: login.php?msg=You are now logged out.");
  exit;
?>
