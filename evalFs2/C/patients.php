<?php

    if(!isset($_GET['page'])){
        header("Location: http://localhost/evalFs/evalFs2/index.php");
    }
    $page = "Patients";
    include('M/dbConnect.php');
    include('M/getSql.php');
    include('M/otherSql.php');
    include('C/Functions/PHP/messages.php');
    $actualDate = actualDate($db);
    include('V/_template/htmlTop.php');
    include('V/_template/navbar.php');
    $query = 
    "SELECT *
    FROM CATEGORYS;";
    
    $cats = fetchNoSets($db,$query);
    $query =
    "SELECT PATIENTS.patientName as name, PATIENTS.ID as ID,OWNERS.lastName as owName, OWNERS.firstName as owFirst, OWNERS.phone as owPhone
    FROM PATIENTS
    JOIN CLIENTS_HAS_PATIENTS AS CHP ON PATIENTS.ID = CHP.patientID
    JOIN OWNERS ON CHP.ownerID = OWNERS.ID;";

    $patients = fetchNoSets($db,$query);
    
    unset($query);

    $query =
    "SELECT *
    FROM SEX";

    $sex = fetchNoSets($db,$query);

    unset($query);

    $query =
    "SELECT ID, CONCAT(lastName,' ',firstName) as name
    FROM OWNERS";

    $owners = fetchNoSets($db,$query);
    $today = date('Y-m-j');
    $todays = date('Y-m-d',strtotime('+1 day'));
    switch(isset($_POST)):
        case(isset($_POST['patientID'])):
                $query = 
                "SELECT APPOINTMENTS.ID as appId, APPOINTMENTS.name as appName, dayofmonth(APPOINTMENTS.appDay) as dayNum, monthname(appDay) as monthName, 
                year(appDay) as years, dayname(appDay) as dayName, PATIENTS.ID as patID, APPOINTMENTS.startTime, APPOINTMENTS.place, APPOINTMENTS.notes,
                CONSULTATIONS.reason, CONSULTATIONS.food, CONSULTATIONS.mindState as mState,CONSULTATIONS.phyState AS pState, CONSULTATIONS.temper as temp,CONSULTATIONS.notes as cNotes, CONSULTATIONS.weight, CONSULTATIONS.recommandations AS recs, DATE(CONSULTATIONS.consDate) AS consDate, TIME(CONSULTATIONS.consDate) as consH
                FROM APPOINTMENTS 
                JOIN CONSULTATIONS AS CONSULTATIONS ON CONSULTATIONS.appointmentID = APPOINTMENTS.ID
                JOIN PATIENT_HAS_APPOINTMENTS AS PHA ON PHA.appointmentID = APPOINTMENTS.ID
                JOIN PATIENTS ON PHA.patientID = PATIENTS.ID
                JOIN USER_HAS_APPS ON APPOINTMENTS.ID = USER_HAS_APPS.appointmentID
                JOIN SEX ON SEX.ID = PATIENTS.sexID
                WHERE PATIENTS.ID = :set1
                AND APPOINTMENTS.status = 1
                AND USER_HAS_APPS.userID = :set2
                ORDER BY APPOINTMENTS.appDay,APPOINTMENTS.startTime;";

                $prevCons = fetchTwoSets($db,$query,$_POST['patientID'],$_SESSION['ID']);
                include('V/_template/showConsults.php');
                include('V/_template/footer.html');
            break;
        default:
            $query =
            "SELECT PATIENTS.ID as patID, PATIENTS.patientName, PATIENTS.birthDate, OWNERS.email, OWNERS.lastName, OWNERS.firstName, SEX.name AS sexName,
            OWNERS.address, OWNERS.postCode, OWNERS.city, OWNERS.phone, PATIENTS.lifeStyle as lifeS, PATIENTS.food AS patFood
            FROM APPOINTMENTS 
            JOIN BELONGS ON BELONGS.appointmentID = APPOINTMENTS.ID 
            JOIN CATEGORYS ON BELONGS.categoryID = CATEGORYS.ID
            JOIN PATIENT_HAS_APPOINTMENTS AS PHA ON PHA.appointmentID = APPOINTMENTS.ID
            JOIN PATIENTS ON PHA.patientID = PATIENTS.ID
            JOIN CLIENTS_HAS_PATIENTS AS CHP ON CHP.patientID = PATIENTS.ID
            JOIN OWNERS ON OWNERS.ID = CHP.ownerID
            JOIN USER_HAS_APPS ON APPOINTMENTS.ID = user_has_apps.appointmentID
            JOIN SEX ON SEX.ID = PATIENTS.sexID
            WHERE USER_HAS_APPS.userID = :set1 GROUP BY PATIENTS.ID
            ORDER BY APPOINTMENTS.appDay,APPOINTMENTS.startTime
            ;";

            $res = fetchOneSet($db,$query,$_SESSION['ID']);
            include('V/_template/showPatients.php');
            include('V/_template/footer.html');
    endswitch;
    include('V/_template/appsModal.php');

?>