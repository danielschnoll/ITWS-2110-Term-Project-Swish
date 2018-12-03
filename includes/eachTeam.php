

<div class="row">
  <div class="col s12 m12">
    <?php
      $randomNum = rand(0,9);
      array_push($numsUsed, $randomNum);
      $color = "card ". $colors[$randomNum] ." darken-1";
    ?>
    <div class="<?php  echo($color);?>">
      <div class="card-content white-text">

        <table>
          <thead>
            <tr>
              <th>Team Members </th>
            </tr>
          </thead>
