
<?php
  session_start();
  session_regenerate_id();
  $tmp = session_id();
  session_destroy();
  session_id($tmp);
  unset($tmp);
  session_start();

  header("Location: login.php?alert=You have been logged out.");
  exit;
?>
