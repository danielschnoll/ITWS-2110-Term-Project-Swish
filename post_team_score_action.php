<?php
    session_start();
    $currentUserId = $_SESSION['userID'];

    /* Create a new database connection object, passing in the host, username,
    password, and database to use. The "@" suppresses errors. */
    @ $db = new mysqli('localhost', 'root', '', 'swishdb');
    if ($db->connect_error) {
        echo '<div class="messages">Could not connect to the database. Error: ';
        echo $db->connect_errno . ' - ' . $db->connect_error . '</div>';
    } 

    else{
        if (isset($_POST)){
            $home_name = $_POST['home_name'];
            $away_name = $_POST['away_name'];
            $home_score = $_POST['home_score'];
            $away_score = $_POST['away_score'];

            $sql = "SELECT * FROM `teams` WHERE `name` = \"$home_name\"";
            $homeResult = $db->query($sql);
            $homeData = $homeResult->fetch_assoc();

            $sql = "SELECT * FROM `teams` WHERE `name` = \"$away_name\"";
            $awayResult = $db->query($sql);
            $awayData = $awayResult->fetch_assoc();

            if($homeData['name'] != $home_name || $awayData['name'] != $away_name){
                header("Location: teams.php?msg=One of these teams does not exist.");
            }
            else{
                $homeID = $homeData['id'];
                $awayID = $awayData['id'];

                //Check if user is on the team where the score is being reported
                $u_sql = "SELECT * FROM `user_teams` WHERE `u_id` = $currentUserId and (`t_id` = $homeID or `t_id`= $awayID)";
                $userValidationResult = $db->query($u_sql);
                $userValidationData = $userValidationResult->fetch_assoc();
                $user_teamID = $userValidationData['id'];
                if(!$user_teamID){
                    header("Location: teams.php?msg=You are not a member of either of these teams.");
                    exit;
                }

                //Find the game that was played and update that event score
                $sql = "SELECT * FROM `events` WHERE `home_score` = 0 and `away_score` = 0 and `home_id` = $homeID and `away_id` = $awayID";

                $updateResult = $db->query($sql);
                $updateRowData = $updateResult->fetch_assoc();
                $updateRowID = $updateRowData['id'];

                if(!$updateRowID){
                    header("Location: teams.php?msg=The score cannot be updated.");
                    exit;
                }
                else{
                    $relationSQL = "UPDATE `events` SET `home_score` = $home_score , `away_score` = $away_score WHERE `id` = $updateRowID";
                    $relationResult = $db->query($relationSQL);

                    //Update the team win:loss ratio
                    if($home_score > $away_score){
                        $relationSQL = "UPDATE `teams` SET `wins` = `wins`+ 1 WHERE `id` = $homeID";
                        $relationResult = $db->query($relationSQL);
                        $relationSQL = "UPDATE `teams` SET `losses` = `losses`+ 1 WHERE `id` = $awayID";
                        $relationResult = $db->query($relationSQL);
                    }
                    //Away team won
                    if($away_score > $home_score){
                        $relationSQL = "UPDATE `teams` SET `wins` = `wins`+ 1 WHERE `id` = $awayID";
                        $relationResult = $db->query($relationSQL);
                        $relationSQL = "UPDATE `teams` SET `losses` = `losses`+ 1 WHERE `id` = $homeID";
                        $relationResult = $db->query($relationSQL);
                    }
                    header("Location: index.php?msg=The score was updated!");
                }
                exit;
            }
        }
     }
?>