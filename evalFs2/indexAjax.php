<?php

    include('C/Functions/PHP/messages.php');
    $messages = array();
    include('M/dbConnect.php');
    include('M/getSql.php');
    include('M/otherSql.php');

    switch(isset($_POST)):
        case(isset($_POST['eraseApp'])):
                if(preg_match("/^[0-9]+$/",$_POST['eraseApp'])){
                    $query[0] = 
                    "DELETE 
                    FROM BELONGS 
                    WHERE BELONGS.appointmentID = :set1;";

                    $query[1] =
                    "DELETE 
                    FROM APPOINTMENTS 
                    WHERE APPOINTMENTS.ID =:set1
                    AND appDay > CURRENT_TIMESTAMP();";

                    for($i = 0; $i < count($query);$i++)
                    {
                        if(oneSet($db,$query[$i],$_POST['eraseApp']) === true){
                            if($i === 1){
                                $messages[] = success("Suppression confirmée");
                            }
                        } else {
                            $messages[] = alert("Erreur lors du traitement de la requête, veuillez réessayer plus tard.");
                        }
                    }
                    if(count($messages) > 0)
                    {
                        for($i = 0; $i < count($messages); $i++)
                        {
                            echo $messages[$i];
                        }
                        unset($messages);
                    }
                }
            break;
        case(isset($_POST['fetchApps'])):
                (preg_match("/^[0-9]{4}[-]{1}[0-1]{1}[0-9]{1}[-]{1}[0-3]{1}[0-9]{1}$/", $_POST['fetchApps']))? $messages = $messages : $messages[] = alert("Date incorrecte !");
                if(count($messages === 0))
                {
                    $query =
                        "SELECT APPOINTMENTS.ID as appId, APPOINTMENTS.name as appName, dayofmonth(APPOINTMENTS.appDay) as dayNum, monthname(appDay) as monthName, 
                        year(appDay) as years, dayname(appDay) as dayName, APPOINTMENTS.startTime, APPOINTMENTS.place, APPOINTMENTS.notes, APPOINTMENTS.duration
                        ,CATEGORYS.name
                        FROM APPOINTMENTS 
                        JOIN BELONGS ON BELONGS.ID = APPOINTMENTS.ID 
                        JOIN CATEGORYS ON APPOINTMENTS.appCat = CATEGORYS.ID
                        JOIN PATIENTS_HAS_APPOINTMENTS AS PHA ON PHA.appointmentID = APPOINTMENTS.ID
                        JOIN PATIENTS ON PHA. patientID = PATIENTS.ID
                        JOIN CLIENTS_HAS_PATIENTS AS CHP ON CHP.patientID = PATIENTS.ID
                        JOIN OWNERS ON OWNERS.ID = CHP.ownerID
                        WHERE APPOINTMENTS.appDay = :set1
                        AND APPOINTMENTS.userID = :set2
                        ORDER BY APPOINTMENTS.appDay,APPOINTMENTS.startTime;";

                    $res = fetchTwoSets($db,$query,$_POST['fetchApps'],$_POST['usrID']);
                    include('V/_template/appDetailsCards.php');
                }
            break;
        case(isset($_POST['eraseDate'])):
                (preg_match("/^[0-9]{4}[-]{1}[0-1]{1}[0-9]{1}[-]{1}[0-3]{1}[0-9]{1}$/", $_POST['eraseDate']))? $messages = $messages : $messages[] = alert("Date incorrecte !");
                if(count($messages) === 0)
                {
                    $query[0] = 
                    "DELETE 
                    FROM BELONGS 
                    WHERE BELONGS.appointmentID = ANY (SELECT ID FROM APPOINTMENTS WHERE userID = :set1 and appDay = :set2 AND appDay > CURRENT_TIMESTAMP());";

                    $query[1] =
                    "DELETE 
                    FROM APPOINTMENTS 
                    WHERE userID = :set1 
                    and appDay = :set2
                    AND appDay > CURRENT_TIMESTAMP();";

                    for($i = 0; $i < count($query);$i++)
                    {
                        if(twoSets($db,$query[$i],$_POST['usrID'],$_POST['eraseDate']) === true){
                            if($i === 1){
                                $messages[] = success("Suppression confirmée");
                            }
                        } else {
                            $messages[] = alert("Erreur lors du traitement de la requête, veuillez réessayer plus tard.");
                        }
                    }
                }
                if(count($messages) > 0)
                {
                    for($i = 0; $i < count($messages); $i++)
                    {
                        echo $messages[$i];
                    }
                    unset($messages);
                } 
            break;
        case(isset($_POST['appRecc'])):

                if($_POST['appRecc'] === "1")
                {

                    (preg_match("/^[0-9]{1}$/",$_POST['appCat'])) ? $messages = $messages : $messages[] = alert("Catégorie invalide !") ;

                    (!empty($_POST['appHour']) && (strtotime($_POST['appHour']) < strtotime("23:59:15")) && (strtotime($_POST['appHour']) >= strtotime("00:00:00"))) ? $messages = $messages: $messages[] = alert("L'heure n'est pas au format adéquat!");

                    (intval($_POST['timeH']) <= 23 && intval($_POST['timeH']) >= 0) ? $messages = $messages : $messages[] = alert("La duréen'est pas au format adéquat!");

                    (intval($_POST['timeM']) <= 59 && intval($_POST['timeM']) >= 0) ? $messages = $messages : $messages[] = alert("Les minutes ne sont pas au format adéquat!");

                    (preg_match("/^[0-9]{4}[-]{1}[0-1]{1}[0-9]{1}[-]{1}[0-3]{1}[0-9]{1}$/", $_POST['appDate']))? $messages = $messages : $messages[] = alert("Date incorrecte !");
                    
                    (preg_match("/(*UTF8)[A-Za-z0-9\s\'\-\+]+$/", $_POST['appName'])) ?  $messages = $messages : $messages[] = alert("Nom incorrecte !");
                                
                    $today = date('Y-m-j');
                    $today = strtotime($today);
                    $acDate = strtotime($_POST['appDate']);
                    
                    if(count($messages) === 0){

                    }
                        $query =
                        "SELECT *
                        FROM APPOINTMENTS AS APPS
                        JOIN USER_HAS_APPOINTMENTS AS USAP ON APPS.ID = USAP.appointmentID
                        WHERE USAP.userID = :set1
                        AND APPOINTMENTS.appDay = :set2
                        AND (:set3 BETWEEN startTime AND addtime(startTime,'00:30:00')
                        OR startTime Between :set3 AND addtime(:set4,'00:30:00')
                        ORDER BY startTime;";

                        if(!empty($res = fetchFiveSets(
                            $db,
                            $query,
                            $_POST['usrID'],
                            $_POST['appDate'],
                            ($_POST['appHour'].":00"),
                            ($_POST['appHour'].":00"),
                            ($_POST['timeH'].":".$_POST['timeM'].":00")
                            )))
                        {
                            $messages[] = alert("Le rendez-vous ".$res[0]['name']." à ".$res[0]['startTime']." <br>a déjà été pris ce jour là.");
                        }
                        else 
                        {
                            if(!empty($_POST['appPlace']))
                            {
                                $_POST['appPlace'] = htmlspecialchars($_POST['appPlace']);
                            }
                            else 
                            {
                                $_POST['appPlace'] = "Aucun endroit défini";
                            }

                            if(!empty($_POST['appNotes']) && preg_match("/(*UTF8)[A-Za-z0-9\s\'\-\+]+$/",$_POST['appNotes'])) {
                                $_POST['appNotes'] = $_POST['appNotes'] ;
                            } 
                            else 
                            {
                                $_POST['appNotes'] = "Aucune note disponible";
                            }

                            if(($acDate - $today) >= 86400){
                                $query =
                                "INSERT INTO APPOINTMENTS(name, place, notes, appDay, startTime) 
                                VALUES(:set1,:set2, :set3, (
                                CASE appDay 
                                WHEN DATEDIFF(DATE(CURRENT_TIMESTAMP()),:set4) > 0
                                THEN :set5 ELSE NULL
                                END),:set6);";
                                
                                if(sixSets(
                                    $db,$query,$_POST['appName'],$_POST['appPlace'],$_POST['appNotes'],
                                    $_POST['appDate'],$_POST['appDate'],($_POST['appHour'].":00")) == true){

                                    $messages[] = success("Rdv ajouté!");
                                    unset($query,$res);
                                    $id = $db -> lastInsertId();
                                    
                                    $query =
                                    "INSERT INTO BELONGS(categoryID,appointmentID)
                                    VALUES(:set1,:set2);";

                                    twoSets($db,$query,$_POST['appCat'],$id);
                                    unset($id);
                                } else{
                                    $messages[] = alert("Erreur dans l'ajout du rdv!");
                                }
                                
                            } else {
                                $messages[] = alert("La date de rendez-vous ne peut être prise dans le passé!");
                            }
                        }
                } 
                else if($_POST['appRecc'] === "0")
                {

                }
                else
                {
                    $messages[] = alert("Réccurence invalide !");
                }

                if(count($messages) > 0)
                {
                    for($i = 0; $i < count($messages); $i++)
                    {
                        echo $messages[$i];
                    }
                    unset($messages);
                } 
            break;
        case(isset($_POST['date'])):

                $timestamp = strtotime($_POST['date']);
                $todays = date("Y-m-d",strtotime('+1 day',$timestamp));
                echo $todays;
                
            break;
        default:
                echo alert("Try again.");
    endswitch;
?>