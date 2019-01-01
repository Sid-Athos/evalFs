<?php

    include('C/Functions/PHP/messages.php');

    switch(isset($_POST)):
        case(isset($_POST['appRecc'])):
                $messages = array();
                if($_POST['appRecc'] === "1")
                {
                    $_SESSION['ID'] = 6;
                    (empty($_POST['appHour'])) ? $_POST['appHour'] = "0" : $_POST['appHour'];

                    (preg_match("/^[0-9]{1}$/",$_POST['appCat'])) ? $messages = $messages : $messages[] = alert("Catégorie invalide !") ;

                    (intval($_POST['appHour']) <= 23 && intval($_POST['appHour']) >= 0) ? $messages = $messages: $messages[] = alert("L'heure n'est pas au format adéquat!");

                    (intval($_POST['timeH']) <= 23 && intval($_POST['timeH']) >= 0) ? $messages = $messages : $messages[] = alert("La duréen'est pas au format adéquat!");

                    (intval($_POST['appMins']) <= 59 && intval($_POST['appMins']) >= 0) ? $messages = $messages : $messages[] = alert("Les minutes ne sont pas au format adéquat!");

                    (intval($_POST['timeM']) <= 59 && intval($_POST['timeM']) >= 0) ? $messages = $messages : $messages[] = alert("Les minutes ne sont pas au format adéquat!");

                    (preg_match("/^[0-9]{4}[-]{1}[0-1]{1}[0-9]{1}[-]{1}[0-3]{1}[0-9]{1}$/", $_POST['appDate']))? $messages = $messages : $messages[] = alert("Date incorrecte !");
                    
                    (preg_match("/(*UTF8)[A-Za-z0-9\s\'\-\+]$/", $_POST['appName'])) ?  $messages = $messages : $messages[] = alert("Nom incorrecte !");
                                
                    $today = date('Y-m-j');
                    $today = strtotime($today);
                    $acDate = strtotime($_POST['appDate']);
                    
                    if(count($messages) === 0){

                    }
                        include('M/dbConnect.php');
                        include('M/getSql.php');
                        $query =
                        "SELECT *
                        FROM APPOINTMENTS
                        WHERE userID = :set1
                        AND appDay = :set2
                        AND (:set3 BETWEEN startTime AND addtime(:set4,:set5)
                        OR startTime Between :set3 AND addtime(:set4,:set5))
                        ORDER BY startTime;";

                        if(!empty($res = fetchFiveSets(
                            $db,
                            $query,
                            $_SESSION['ID'],
                            $_POST['appDate'],
                            ($_POST['appHour'].":".$_POST['appMins'].":00"),
                            ($_POST['appHour'].":".$_POST['appMins'].":00"),
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
                                $_POST['appPlace'] = 'DEFAULT';
                            }

                            if(!empty($_POST['appNotes']) && preg_match("/(*UTF8)[A-Za-z0-9\s\'\-\+]+$/",$_POST['appNotes'])) {
                                $_POST['appNotes'] = $_POST['appNotes'] ;
                            } 
                            else 
                            {
                                $_POST['appNotes'] = 'DEFAULT';
                            }

                            if(($acDate - $today) >= 86400){
                                    include('M/otherSql.php');
                                    $query =
                                    "INSERT INTO APPOINTMENTS(name, place, notes, appDay, startTime, duration, appCat, userID) 
                                    VALUES(:set1,:set2, :set3, (
                                    CASE appDay 
                                    WHEN DATEDIFF(DATE(CURRENT_TIMESTAMP()),:set4) > 0
                                    THEN :set5 ELSE NULL
                                    END),:set6,:set7,:set8,:set9);";
                    
                                    (intval($_POST['appHour']) <10)? $_POST['appHour'] = "0".$_POST['appHour'] : $_POST['appHour'] = $_POST['appHour'];
                                    (intval($_POST['appMins']) <10)? $_POST['appMins'] = "0".$_POST['appMins'] : $_POST['appMins'] = $_POST['appMins'];
                                    (intval($_POST['timeH']) <10)? $_POST['timeH'] = "0".$_POST['timeH'] : $_POST['timeH'] = $_POST['timeH'];
                                    (intval($_POST['timeM']) <10)? $_POST['timeM'] = "0".$_POST['timeM'] : $_POST['timeM'] = $_POST['timeM'];
                                    
                                    if(nineSets(
                                        $db,$query,$_POST['appName'],$_POST['appPlace'],$_POST['appNotes'],
                                        $_POST['appDate'],$_POST['appDate'],($_POST['appHour'].":".$_POST['appMins'].":00"),($_POST['timeH'].":".$_POST['timeM'].":00"),
                                        $_POST['appCat'],$_SESSION['ID']
                                    ) == true){

                                        $messages[] = success("Rdv ajouté!");
                                        unset($query,$res);
                                        $id = $db -> lastInsertId();
                                        
                                        $query =
                                        "INSERT INTO BELONGS(categoryID,appointmentID)
                                        VALUES(:set1,:set2);";

                                        
                                    } else{
                                        $messages[] = alert("Erreur dans l'ajout du rdv!");
                                    }
                                
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
    endswitch;
?>