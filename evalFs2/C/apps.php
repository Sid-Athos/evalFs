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
    
    $messages = array();
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
                    include('V/_template/htmlTop.php');
                    include('V/_template/navbar.php');
                    include('V/_template/appDetailsCards.php');
                }
            break;
        case(isset($_POST['editApp'])):
                    if(preg_match("/^[0-9]+$/",$_SESSION['ID']) && preg_match("/^[0-9]+$/",$_POST['editApp']))
                    {
                        $query =
                        "SELECT APPOINTMENTS.ID as appId, APPOINTMENTS.name as appName, dayofmonth(APPOINTMENTS.appDay) as dayNum, monthname(appDay) as monthName, 
                        year(appDay) as years, dayname(appDay) as dayName, APPOINTMENTS.startTime as startTime, APPOINTMENTS.place as appPlace, APPOINTMENTS.appDay as appDay,
                        APPOINTMENTS.notes as appNotes, APPOINTMENTS.duration as appDuration
                        ,CATEGORYS.name as appCat, CATEGORYS.ID as catId
                        FROM APPOINTMENTS JOIN CATEGORYS ON APPOINTMENTS.appCat = CATEGORYS.ID
                        WHERE APPOINTMENTS.ID = :set1
                        ORDER BY APPOINTMENTS.appDay,APPOINTMENTS.startTime;";
                        
                        
                        $res = fetchOneSet($db,$query,$_POST['editApp']);
                        unset($query);
                        $query = 
                        "SELECT CATEGORYS.ID, CATEGORYS.name
                        FROM CATEGORYS
                       WHERE CATEGORYS.ID != ALL(
                           SELECT BELONGS.categoryID 
                           FROM BELONGS 
                           WHERE BELONGS.appointmentID = :set1);";

                        $cats = fetchOneSet($db,$query,$_POST['editApp']);
                        include('V/_template/htmlTop.php');
                        include('V/_template/navbar.php');
                        include('V/_template/editAppsForm.php');
                        include('V/_template/appsModal.php');
                        include('V/_template/footer.html');
                    } else {
                        header("Location: index.php?page=login");
                    }
                break;
        default:
    endswitch;

?>