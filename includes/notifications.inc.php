<?php

  if (isset($_GET['alert'])) {
    echo "<script>Materialize.toast('" . $_GET['alert'] . "', 2000)</script>";
  }

?>
