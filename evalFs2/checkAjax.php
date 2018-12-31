<?php
    include('C/Functions/PHP/messages.php');
    switch(isset($_POST)):
        case(isset($_POST['appName'])):
                include('M/dbConnect.php');
                include('M/otherSql.php');
                $query =
                "INSERT INTO APPOINTMENTS(name, place, notes, appDay, startTime, appCat, userID) 
                VALUES(:set1,:set2, :set3, (
                CASE appDay 
                WHEN DATEDIFF(DATE(CURRENT_TIMESTAMP()),:set4) > 0
                THEN :set5 ELSE NULL
                END),:set6,:set7,:set8);";

                (intval($_POST['appHour']) <10)? $_POST['appHour'] = "0".$_POST['appHour'] : $_POST['appHour'] = $_POST['appHour'];
                if(heightSets(
                    $db,$query,$_POST['appName'],$_POST['appPlace'],$_POST['appNotes'],
                    $_POST['appDate'],$_POST['appDate'],($_POST['appHour'].":".$_POST['appMins'].":00"),
                    $_POST['appCat'],6
                ) == true){
                    $messages = success("Rdv ajouté!");
                    echo $messages;
                } else{
                    $messages = alert("Erreur dans l'ajout du rdv!");
                    echo $messages;
                }
            break;
        case(isset($_POST['date'])):
                $timestamp = strtotime($_POST['date']);
                $todays = date("Y-m-d",strtotime('+1 day',$timestamp));
                echo $todays;
            break;
        default:
    endswitch;
?>