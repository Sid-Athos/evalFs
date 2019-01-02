<?php

    $page = "Calendrier";
    include('M/dbConnect.php');
    include('M/getSql.php');
    include('M/otherSql.php');
    include('C/Functions/PHP/messages.php');
    include('C/Functions/PHP/sessionCheck.php');
    $actualDate = actualDate($db);
    
    $query = 
    "SELECT *
    FROM CATEGORYS;";
    
    $res = fetchNoSets($db,$query);
    if (isset($_GET['ym'])) { // l'utilisateur a cliqué sur mois suivant ou mois précédent
        $ym = $_GET['ym'];
    } else {
        $ym = date('Y-m');
    }
    unset($query);
    $date = "$ym%";

    $query =
    "SELECT dayOfmonth(APPOINTMENTS.appDay), APPOINTMENTS.name, APPOINTMENTS.place, APPOINTMENTS.notes, APPOINTMENTS.appDay,  
    APPOINTMENTS.startTime, APPOINTMENTS.duration, CATEGORYS.name, COUNT(APPOINTMENTS.ID) as compteur
    FROM CATEGORYS 
    JOIN APPOINTMENTS
    ON CATEGORYS.ID = APPOINTMENTS.appCat
    WHERE APPOINTMENTS.userID = :set1
    AND appDay LIKE :set2
    GROUP BY APPOINTMENTS.appDay
    ORDER BY APPOINTMENTS.appDay, startTime;";

    $apps = fetchTwoSets($db,$query,$_SESSION['ID'],$date);
    
    include('V/_template/htmlTop.php');
    include('V/_template/navbar.php');
    include('C/Functions/PHP/calendar.php');
    include('V/_template/appsModal.php');
    include('V/_template/calendar.php');
    include('V/_template/footer.html');
?>