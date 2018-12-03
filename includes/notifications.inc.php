<?php

  if (isset($_GET['msg'])) {
    echo "<script>Materialize.toast('" . $_GET['msg'] . "', 2000)</script>";
  }

  echo "<script>
  </script>
"

?>
