<?php
    switch(isset($_POST)):
        case(isset($_POST['addName'])):
                include('M/dbConnect.php');
                include('M/otherSql.php');
                $query =
                "INSERT INTO APPOINTMENTS(name, place, appDay,userID)
                VALUES(:set1, :set2, :set3,:set4);";

                fourSets($db,$query,$_POST['addName'],$_POST['addPlace'],$_POST['addDate'],6);
                echo "voilà";
            break;
        case(isset($_POST['date'])):
                $timestamp = strtotime($_POST['date']);
                $todays = date("Y-m-d",strtotime('+1 day',$timestamp));
                echo $todays;
            break;
        default:
    endswitch;
?>