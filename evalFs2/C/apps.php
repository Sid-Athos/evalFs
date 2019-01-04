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
    var_dump($_POST);
    $messages = array();

    switch(isset($_POST)):
        case(isset($_POST['choice'])):
                $today = date('Y-m-j');
                if($_POST['choice'] ==='todayApps')
                {
                    $query = 
                    "SELECT APPOINTMENTS.ID as appId, APPOINTMENTS.name as appName, dayofmonth(APPOINTMENTS.appDay) as dayNum, monthname(appDay) as monthName, 
                    year(appDay) as years, dayname(appDay) as dayName, APPOINTMENTS.startTime, APPOINTMENTS.place, APPOINTMENTS.notes, APPOINTMENTS.duration
                    ,CATEGORYS.name
                    FROM APPOINTMENTS JOIN CATEGORYS ON APPOINTMENTS.appCat = CATEGORYS.ID
                    WHERE APPOINTMENTS.appDay = :set1
                    AND APPOINTMENTS.userID = :set2
                    ORDER BY APPOINTMENTS.appDay,APPOINTMENTS.startTime;";

                    $res = fetchTwoSets($db,$query,$today,$_SESSION['ID']);
                    include('V/_template/htmlTop.php');
                    include('V/_template/navbar.php');
                    include('V/_template/beforeCards.php');
                    include('V/_template/appDetailsCards.php');
                    include('V/_template/afterCards.php');
                    include('V/_template/appsModal.php');   
                    include('V/_template/footer.html');                 
                } else {
                    header("Location: index.php?page=error");
                }
            break;
        case(isset($_POST['modApp']) && preg_match("/^[0-9]+$/",$_POST['modApp'])):

                if(preg_match("/(*UTF8)[A-Za-z0-9\s\'\-\+]+$/",$_POST['newName'])){
                    $query =
                    "UPDATE APPOINTMENTS
                    SET name = :set1
                    WHERE ID = :set2;";

                    if(twoSets($db,$query,$_POST['newName'],$_POST['modApp']))
                    {
                        $messages[] = success("Nom modifié, le nouveau nom est ".$_POST['newName']."!");
                    } else {
                        $messages[] = alert("Erreur lors de la requête...");
                    }
                } else {
                    $messages[] = alert("Catégorie invalide !") ;
                }

                if(preg_match("/(*UTF8)[A-Za-z0-9\s\'\-\+]+$/",$_POST['newNotes'])){
                    $query =
                    "UPDATE APPOINTMENTS
                    SET notes = :set1
                    WHERE ID = :set2;";

                    if(twoSets($db,$query,$_POST['newNotes'],$_POST['modApp']))
                    {
                        $messages[] = success("Notes modifiées!");
                    } else {
                        $messages[] = alert("Erreur lors de la requête...");
                    }
                } else {
                    $messages[] = alert("Notes invalides !") ;
                }

                if(preg_match("/(*UTF8)[A-Za-z0-9\s\'\-\+]+$/",$_POST['newPlace'])){
                    $query =
                    "UPDATE APPOINTMENTS
                    SET place = :set1
                    WHERE ID = :set2;";

                    if(twoSets($db,$query,$_POST['newPlace'],$_POST['modApp']))
                    {
                        $messages[] = success("Lieu modifié, le nouvel endroit est situé au ".$_POST['newPlace']."!");
                    } else {
                        $messages[] = alert("Erreur lors de la requête...");
                    }
                } else {
                    $messages[] = alert("Catégorie invalide !") ;
                }


                if((!empty($_POST['newTime']) && (strtotime($_POST['newTime']) < strtotime("23:59:15")) && (strtotime($_POST['newTime']) >= strtotime("00:00:00"))) && (intval($_POST['newDurH']) <= 99 && intval($_POST['newDurH']) >= 0) && 
                (intval($_POST['newDurM']) <= 59 && intval($_POST['newDurM']) >= 0)){
                    $query =
                        "SELECT *
                        FROM APPOINTMENTS
                        WHERE userID = :set1
                        AND appDay = :set2
                        AND (:set3 BETWEEN startTime AND addtime(startTime,duration)
                        OR startTime Between :set4 AND addtime(:set5,:set6))
                        AND ID != :set7
                        ORDER BY startTime;";

                        if(!empty($res = fetchSixSets(
                            $db,
                            $query,
                            $_SESSION['ID'],
                            $_POST['newDate'],
                            ($_POST['newTime'].":00"),
                            ($_POST['newTime'].":00"),
                            ($_POST['newTime'].":00"),
                            ($_POST['newDurH'].":".$_POST['newDurM'].":00"),
                            $_POST['modApp'])))
                        {
                            $messages[] = alert("Le rendez-vous ".$res[0]['name']." à ".$res[0]['startTime']." <br>a déjà été pris ce jour là.");
                            
                        }
                        else 
                        {
                            if(preg_match("/^[0-9]{4}[-]{1}[0-1]{1}[0-9]{1}[-]{1}[0-3]{1}[0-9]{1}$/",$_POST['newDate'])){
                                $query =
                                "UPDATE APPOINTMENTS
                                SET appDay = (
                                    CASE
                                    WHEN :set1 > CURRENT_TIMESTAMP() 
                                    THEN :set1 
                                    ELSE NULL END
                                    )
                                WHERE ID = :set2;";
            
                                if(twoSets($db,$query,$_POST['newDate'],$_POST['modApp']))
                                {
                                    $messages[] = success("Date modifiée, nouvelle date le ".$_POST['newDate']."!");
                                    $query =
                                        "UPDATE APPOINTMENTS
                                        SET startTime = :set1
                                        WHERE ID = :set2;";
        
                                    if(twoSets($db,$query,($_POST['newTime'].":00"),$_POST['modApp']))
                                    {
                                        $messages = success("Heure modifiée, nouvelle date le ".$_POST['newDate']."!");
                                    } else {
                                        $messages[] = alert("Erreur lors de la requête de modification de l'heure et de la durée...");
                                    }
                                } else {
                                    $messages[] = alert("Erreur lors de la requête de modification de la date...");
                                }
                            } else {
                                $messages[] = alert("Date invalide !") ;
                            }

                        }
                } else {
                    $messages[] = alert("La nouvelle heure ou la durée n'est pas au format adéquat !") ;
                }

                        $query =
                        "SELECT APPOINTMENTS.ID as appId, APPOINTMENTS.name as appName, dayofmonth(APPOINTMENTS.appDay) as dayNum, monthname(appDay) as monthName, 
                        year(appDay) as years, dayname(appDay) as dayName, APPOINTMENTS.startTime as startTime, APPOINTMENTS.place as appPlace, APPOINTMENTS.appDay as appDay,
                        APPOINTMENTS.notes as appNotes, APPOINTMENTS.duration as appDuration
                        ,CATEGORYS.name as appCat, CATEGORYS.ID as catId
                        FROM APPOINTMENTS JOIN CATEGORYS ON APPOINTMENTS.appCat = CATEGORYS.ID
                        WHERE APPOINTMENTS.ID = :set1
                        ORDER BY APPOINTMENTS.appDay,APPOINTMENTS.startTime;";
                        
                        
                        $res = fetchOneSet($db,$query,$_POST['modApp']);
                        unset($query);

                        $query = 
                        "SELECT CATEGORYS.ID, CATEGORYS.name
                        FROM CATEGORYS
                       WHERE CATEGORYS.ID != ALL(
                           SELECT BELONGS.categoryID 
                           FROM BELONGS 
                           WHERE BELONGS.appointmentID = :set1);";

                        $cats = fetchOneSet($db,$query,$_POST['modApp']);
                        include('V/_template/htmlTop.php');
                        include('V/_template/navbar.php');
                        include('V/_template/editAppsForm.php');
                        include('V/_template/appsModal.php');
                        include('V/_template/footer.html');

            break;
        case(isset($_POST['fetchApps'])):
                
                (preg_match("/^[0-9]{4}[-]{1}[0-1]{1}[0-9]{1}[-]{1}[0-3]{1}[0-9]{1}$/", $_POST['fetchApps'])) ? 
                $messages = $messages : $messages[] = alert("Date incorrecte !");

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
            include('E/404.html');
    endswitch;

?>