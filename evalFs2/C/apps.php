<?php
    if(!isset($_GET['page'])){
        header("Location: http://localhost/evalFs/evalFs2/index.php");
    }
    include('M/dbConnect.php');
    include('M/getSql.php');
    include('M/otherSql.php');
    include('C/Functions/PHP/messages.php');
    include('C/Functions/PHP/sessionCheck.php');
    $actualDate = actualDate($db);
    include('V/_template/htmlTop.php');
    include('V/_template/navbar.php');
    $messages = array();
    var_dump($_POST);
    switch(isset($_POST)):
        case(isset($_POST['fetchApps'])):
                (preg_match("/^[0-9]{4}[-]{1}[0-1]{1}[0-9]{1}[-]{1}[0-3]{1}[0-9]{1}$/", $_POST['fetchApps']))? $messages = $messages : $messages[] = alert("Date incorrecte !");
                if(count($messages === 0))
                {
                    $query =
                        "SELECT APPOINTMENTS.ID, APPOINTMENTS.name as appName, dayofmonth(APPOINTMENTS.appDay) as dayNum, monthname(appDay) as monthName, 
                        year(appDay) as years, dayname(appDay) as dayName, APPOINTMENTS.startTime, APPOINTMENTS.place, APPOINTMENTS.notes, APPOINTMENTS.duration
                        ,CATEGORYS.name
                        FROM APPOINTMENTS JOIN CATEGORYS ON APPOINTMENTS.appCat = CATEGORYS.ID
                        WHERE APPOINTMENTS.appDay = :set1
                        AND APPOINTMENTS.userID = :set2
                        ORDER BY APPOINTMENTS.appDay,APPOINTMENTS.startTime;";

                    $res = fetchTwoSets($db,$query,$_POST['fetchApps'],$_SESSION['ID']);
                    include('V/_template/appDetailsCards.php');
                }
            break;
        default:
    endswitch;

?>