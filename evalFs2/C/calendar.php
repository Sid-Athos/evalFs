<?php
    if(!isset($_GET['page'])){
        header("Location: http://localhost/evalFs/evalFs2/index.php");
    }
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
    "SELECT dayOfmonth(APPOINTMENTS.appDay), COUNT(APPOINTMENTS.ID) as compteur, 
    HOLIDAYS.startsAt as startHolidays, HOLIDAYS.endsAt as endHolidays, SCHEDULES.workingDay
    FROM APPOINTMENTS
    JOIN BELONGS ON BELONGS.ID = APPOINTMENTS.ID 
    JOIN CATEGORYS ON BELONGS.categoryID = CATEGORYS.ID
    JOIN USER_HAS_APPOINTMENTS AS UHA ON UHA.appointmentID = APPOINTMENTS.ID
    JOIN USERS ON USERS.ID = UHA.userID
    JOIN HOLIDAYS ON HOLIDAYS.userID = users.ID
    JOIN USER_HAS_SCHEDULE AS UHS ON UHS.userID = USERS.ID
    JOIN SCHEDULE ON SCHEDULE.ID = UHS.scheduleID
    WHERE USERS.ID = :set1
    AND APPOINTMENTS.appDay LIKE :set2
    AND HOLIDAYS.startsAt LIKE :set3
    GROUP BY APPOINTMENTS.appDay
    ORDER BY APPOINTMENTS.appDay, startTime;";

    $apps = fetchThreeSets($db,$query,$_SESSION['ID'],$date,$date);
    
    $days = array("Lundi" => 1, "Mardi" => 2, "Mercredi" => 3, "Jeudi" => 4, "Vendredi" => 5, "Samedi" => 6, "Dimanche" => 7);
    
    unset($query);

    $query =
    "SELECT PATIENTS.patientName as pName, PATIENTS.ID as ID
    FROM APPOINTMENTS
    JOIN USER_HAS_APPOINTMENTS AS UHA ON UHA.appointmentID = APPOINTMENTS.ID
    JOIN USERS ON USERS.ID = UHA.userID
    JOIN PATIENT_HAS_APPOINTMENTS AS PHA ON PHA.appointmentID = APPOINTMENTS.ID
    JOIN PATIENTS ON PATIENTS.ID = PHA.patientID
    WHERE USERS.ID = :set1;";

    $patients = fetchOneSet($db,$query,$_SESSION['ID']);
    
    include('V/_template/htmlTop.php');
    include('V/_template/navbar.php');
    include('C/Functions/PHP/calendar.php');
    include('V/_template/appsModal.php');
    include('V/_template/calendar.php');
    include('V/_template/footer.html');
?>