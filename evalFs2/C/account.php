
<?php

    if(!isset($_GET['page'])){
        header("Location: http://localhost/evalFs/evalFs2/index.php");
    }
    $page = "Gestion de compte";
    include('M/dbConnect.php');
    require_once('M/getSql.php');
    require_once('M/otherSql.php');
    $actualDate = actualDate($db);
    include('C/Functions/PHP/messages.php');
    include('C/Functions/PHP/dateSql.php');
    include('C/Functions/PHP/killAvatar.php');
    include('C/Functions/PHP/daysAvailable.php');

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
    "SELECT *
    FROM ORIGINS";

    $origins = fetchNoSets($db,$query);


    $query =
    "SELECT ID, CONCAT(lastName,' ',firstName) as name
    FROM OWNERS";

    $owners = fetchNoSets($db,$query);
    $today = date('Y-m-j');
    $todays = date('Y-m-d',strtotime('+1 day'));
    $messages = array();

    switch(isset($_POST)):
        case(isset($_POST['handleWork'])):
                

                $todays = date('Y-m-d',strtotime('+1 day'));
                $twoDays = date('Y-m-d',strtotime('+2 days'));

                $daysWorked = 
                "SELECT S.fromTime as De, S.toTime as A, S.workingDay as days,S.ID as ID
                FROM SCHEDULES AS S
                JOIN USER_HAS_SCHEDULE as USC ON USC.scheduleID = S.ID
                JOIN USERS AS U ON U.ID = USC.userID
                WHERE U.ID = :set1
                ORDER BY S.workingDay;";

                $workDays = fetchOneSet($db,$daysWorked,$_SESSION['ID']);

                $daysAvailable = daysAvailable($workDays);
                
                $query =
                "SELECT SPECS.name, SPECS.ID
                FROM SPECS 
                WHERE ID != ALL(SELECT specID FROM SPECCED_IN AS SI WHERE SI.userID = :set1);";

                $specs = fetchOneSet($db,$query,$_SESSION['ID']);
                $holidays = 
                "SELECT DATE(startsAt) as startsAt, DATE(endsAt) as endsAt
                FROM HOLIDAYS
                WHERE userID = :set1";
                $holi = fetchOneSet($db,$holidays,$_SESSION['ID']);
        var_dump($holi);
                $query =
                "SELECT SPECS.name, SPECS.ID
                FROM SPECS 
                WHERE ID = ANY(SELECT specID FROM SPECCED_IN AS SI WHERE SI.userID = :set1);";

                $mySpecs = fetchOneSet($db,$query,$_SESSION['ID']);
                include('V/_template/htmlTop.php');

                include('V/_template/navbar.php');
                include('V/_template/handleWork.php');
            break;
        case(isset($_POST['choice'])):
            switch($_POST['choice']):
                case($_POST['choice'] === 'modWork'):
                        include('V/_template/htmlTop.php');
                        include('V/_template/navbar.php');
                        $array = array("Lundi" => 1, "Mardi" => 2, "Mercredi" => 3,"Jeudi" => 4, "Vendredi" => 5,"Samedi" => 5,"Dimanche" => 7);
                        if(array_key_exists($_POST['addDayWork'],$array)){
                            $query=
                            "INSERT INTO SCHEDULES (fromTime, toTime,workingDay) VALUES(:set1,:set2,:set3)";
                            (!empty($_POST['startDay']) && (strtotime($_POST['startDay']) < strtotime("23:59:15")) && (strtotime($_POST['startDay']) >= strtotime("00:00:00"))) ?$messages: $messages[] = alert("L'heure n'est pas au format adéquat!");
                            (!empty($_POST['endDay']) && (strtotime($_POST['endDay']) < strtotime("23:59:15")) && (strtotime($_POST['endDay']) >= strtotime("00:00:00"))) ? $messages: $messages[] = alert("L'heure n'est pas au format adéquat!");

                            if(threeSets($db,$query,$_POST['startDay'],$_POST['endDay'],$_POST['addDayWork']) === true){
                                $id = $db -> lastInsertId();
                                $query =
                                "INSERT INTO USER_HAS_SCHEDULE(userID,scheduleID) VALUES(:set1,:set2);";
                                twoSets($db,$query,$_SESSION['ID'],$id);
                                $messages[] = success("Journée de travail ajoutée!");
                            } else {
                                $messages[] = alert("Erreur dans le traitement de la requête veuillez réessayer et vérifier les champs.");
                            }
                        }

                        if(preg_match("/^[0-9]{4}[-]{1}[0-1]{1}[0-9]{1}[-]{1}[0-3]{1}[0-9]{1}$/",$_POST['startDate']) 
                        && preg_match("/^[0-9]{4}[-]{1}[0-1]{1}[0-9]{1}[-]{1}[0-3]{1}[0-9]{1}$/",$_POST['endDate']))
                        {
                            if((strtotime($_POST['startDate'])+ 86400) < strtotime($_POST['endDate'])){
                                $query =
                                "SELECT *
                                FROM HOLIDAYS
                                WHERE :set1 BETWEEN startsAt AND endsAt
                                OR :set2 BETWEEN startsAt AND endsAt
                                WHERE userID = :set3";

                                if(empty($check = fetchThreeSets($db,$query,$_POST['startDate'],$_POST['endDate'],$_SESSION['ID'])))
                                {
                                   $query = "INSERT INTO HOLIDAYS(startsAt,endsAt,userID) VALUES(:set1,:set2,:set3)";
                                    if(threeSets($db,$query,$_POST['startDate'],$_POST['endDate'],$_SESSION['ID']))
                                    {
                                        $messages[] = success("Vacances enregistrées");
                                    } else {
                                        $messages[] = alert("une erreur est survenue lors de l'enregistrement de vos vacances");
                                    }
                                } 
                                else {
                                    $messages[] = alert("Vous avez déjà des vacances prévues du ".$check[0]['startsDate']." au ".$check[0]['endsDate']);
                                }
                            }
                        }


                        if(isset($_POST['speccedIn'])){
                            for($i = 0;$i < count($_POST['speccedIn']);$i++)
                            {
                                if(preg_match("/^[0-9]+$/",$_POST['speccedIn'][$i])){
                                    $query =
                                    "INSERT INTO SPECCED_IN(userID,specID) VALUES(:set1,:set2);";
                                    if(twoSets($db,$query,$_SESSION['ID'],$_POST['speccedIn'][$i])){
                                        $messages[] = success("Spécialisation ajoutée!");
                                    }else{
                                        $messages[] = alert("Erreur dans l'ajout d'une spécialité");
                                    }
                                }
                            }
                        }

                        if(isset($_POST['workDays'])){
                            for($i = 0;$i < count($_POST['workDays']);$i++)
                            {
                                if(preg_match("/^[0-9]+$/",$_POST['workDays'][$i])){
                                    $query =
                                    "DELETE FROM USER_HAS_SCHEDULE
                                    WHERE userID = :set1
                                    AND scheduleID = :set2;";

                                    if(twoSets($db,$query,$_SESSION['ID'],$_POST['workDays'][$i])){
                                        unset($query);

                                        $query =
                                        "DELETE FROM SCHEDULES WHERE ID = :set1;";
                                        oneSet($db,$query,$_POST['workDays'][$i]);
                                        $messages[] = success("Journée Supprimée!");
                                    }else{
                                        $messages[] = alert("Erreur dans la suppression");
                                    }
                                }
                            }
                        }

                        $todays = date('Y-m-d',strtotime('+1 day'));
                        $twoDays = date('Y-m-d',strtotime('+2 days'));

                        $daysWorked = 
                        "SELECT S.fromTime as De, S.toTime as A, S.workingDay as days,S.ID as ID
                        FROM SCHEDULES AS S
                        JOIN USER_HAS_SCHEDULE as USC ON USC.scheduleID = S.ID
                        JOIN USERS AS U ON U.ID = USC.userID
                        WHERE U.ID = :set1;";

                        $workDays = fetchOneSet($db,$daysWorked,$_SESSION['ID']);

                        $daysAvailable = daysAvailable($workDays);
                        
                        $query =
                        "SELECT SPECS.name, SPECS.ID
                        FROM SPECS 
                        WHERE ID != ALL(SELECT specID FROM SPECCED_IN AS SI WHERE SI.userID = :set1);";

                        $specs = fetchOneSet($db,$query,$_SESSION['ID']);
                        $query =
                        "SELECT SPECS.name, SPECS.ID
                        FROM SPECS 
                        WHERE ID = ANY(SELECT specID FROM SPECCED_IN AS SI WHERE SI.userID = :set1);";
        
                        $mySpecs = fetchOneSet($db,$query,$_SESSION['ID']);
                        include('V/_template/htmlTop.php');
                        $holidays = 
                        "SELECT DATE(startsAt) as startsAt, DATE(endsAt) as endsAt
                        FROM HOLIDAYS
                        WHERE userID = :set1";
                        $holi = fetchOneSet($db,$holidays,$_SESSION['ID']);
            include('V/_template/navbar.php');
                        include('V/_template/handleWork.php');
                            if(isset($messages)){ 
                                for($i = count($messages)-1; $i > 0;$i--){
                                    echo $messages[$i];
                                }
                            }
                    break;
                case($_POST['choice'] === 'changeBackground'):
                        include('V/_template/htmlTop.php');
                        include('V/_template/navbar.php');
                        if(isset($_POST['cBack']) && isset($_POST['bg']))
                        {
                            if(preg_match("/^[0-9]+$/",$_POST['bg']) && preg_match("/^[0-9]+$/",$_SESSION['ID']))
                            {
                                $bg = $_POST['bg'];
                                $check = updateBackground($db,$bg,$_SESSION['ID']);
                                $res = selectBg($db);
                                $_SESSION['background'] = $res[0]['backPath'];
                                if($check === true)
                                {
                                    $message = success("Background modifié!");
                                    
                                }
                            }
                        }
                        $res = selectBackgrounds($db);
                        include('V/_template/backgroundForm.php');
                    break;
                case($_POST['choice'] === 'mod'):
                        $pattern = "/^[a-zA-Z0-9\_\.\'\-]{4,29}$/";
                        // Check password, nickname and mail integrity
                        if(strlen($_POST['newPseudo']) > 4)
                        {
                            if(preg_match($pattern,$_POST['newPseudo']))
                            {
                                
                                $newPseudo = $_POST['newPseudo'];

                                $query =
                                "UPDATE USERS 
                                SET pseudo = :set1
                                WHERE ID = :set2;";

                                $check = twoSets($db,$query,$newPseudo,$_SESSION['ID']);
                                if($check === true)
                                {
                                    $messages[] = success("Pseudo modifié, <br>votre nouveau pseudonyme est $newPseudo!");
                                }
                                else 
                                {
                                    $messages[] = alert("Erreur lors de la modification du pseudonyme!");                                
                                }
                                unset($check);
                            }
                            else 
                            {
                                $messages[] = alert("Le pseudonyme ne correspond pas au format requis.");
                            }
                            if(isset($message))
                            {
                            }
                        }
                        else if(strlen($_POST['newPseudo']) > 0 && strlen($_POST['newPseudo']) <= 4)
                        {
                            $messages[] = alert("Le mot de passe est trop court!");
                        }
                        if(strlen($_POST['newPassword']) > 5)
                        {
                            if(preg_match($pattern,$_POST['newPassword']))
                            {
                                if($_POST['newPassword'] === $_POST['cNewPassword'])
                                {
                                    $newPassword = hash("ripemd160",$_POST['newPassword']);
                                    $query =
                                        "UPDATE USERS 
                                        SET password = :set1
                                        WHERE ID = :set2
                                        AND password = :set3;";

                                    $check = threeSets($db,$query,$newPassword,$_SESSION['ID'],hash("ripemd160",$_POST['oldPassword']));
                                    if($check === true)
                                    {
                                        $messages[] = success("Mot de passe modifié!");
                                    }
                                    else 
                                    {
                                        $messages[] = alert("Erreur lors de la modification du mot de passe!");                                
                                    }
                                unset($check);
                                }
                                else 
                                {
                                    $messages[] = alert("Les mots de passe ne correspondent pas");
                                }
                            }
                        }
                        
                        if(strlen($_POST['newPhone']) >= 10)
                        {
                            if(preg_match("/^[0-9]{10,12}$/",$_POST['newPhone']))
                            {
                                $newPhone = $_POST['newPhone'];
                                $query =
                                    "UPDATE USERS 
                                    SET phone = :set1
                                    WHERE ID = :set2;";

                                $check = twoSets($db,$query,$newPhone,$_SESSION['ID']);
                                if($check === true)
                                {
                                    $messages[] = success("Téléphone modifié!");
                                }
                                else 
                                {
                                    $messages[] = alert("Erreur lors de la modification du numéro de téléphone, veuillez réessayer plus tard!");                                
                                }
                                unset($check);
                            }    
                        }
                        if(!empty($_POST['newMail']))
                        {
                            if(preg_match("/^[a-zA-Z0-9\.]{2,26}@[a-z]{2,6}.[a-z]{2,5}$/",$_POST['newMail']))
                            {
                                $newMail = $_POST['newMail'];

                                $query =
                                    "UPDATE USERS 
                                    SET mail = :set1
                                    WHERE ID = :set2;";

                                $check = twoSets($db,$query,$newMail,$_SESSION['ID']);
                                if($check === true)
                                {
                                    $messages[]= success("Mail modifié!");
                                }
                                else 
                                {
                                    $messages[] = alert("Erreur lors de la modification du mail, veuillez réessayer plus tard!");                                
                                }
                                unset($check);
                            }    
                            unset($newMail);
                        }
                        if(!empty($_FILES['avatar']['name']))
                        {
                            if(($_FILES['avatar']['type'] === "image/jpeg" || $_FILES['avatar']['type'] === "image/png") && $_FILES['avatar']['size'] <= 1000000)
                            {
                                if(preg_match("/^[0-9]+$/",$_SESSION['ID']))
                                {
                                    if(!is_dir('V/A/')){
                                        mkdir('V/A/');
                                        /** Path pour l'upload */
                                    }
                                    
                                   
                                    $dir='V/A/';
                                    $avatarPath=$dir.basename($_FILES['avatar']['name']);

                                   
                                   if(!empty($_SESSION['avPath']))
                                   {
                                       killAvatar($_SESSION['avPath']);
                                   } 
                                    
                                    $upload = move_uploaded_file($_FILES['avatar']['tmp_name'],$avatarPath);

                                    $query =
                                        "UPDATE USERS 
                                        SET avPath = :set1
                                        WHERE ID = :set2;";

                                    $check = twoSets($db,$query,$avatarPath,$_SESSION['ID']);
                                    if($upload === true && $check === true)
                                    {
                                        $messages[] = success("Photo ajoutée");
                                    $_SESSION['avPath'] = $avatarPath;

                                    }
                                    else 
                                    {
                                        $messages[] = alert("Erreur dans l'ajout de votre photo de profil!");                                    
                                    }
                                } else {
                                    header('refresh:2;url=index.php?page=erreur');
                                }
                            } 
                            else 
                            {
                                $messages[] = alert("Erreur dans le formulaire d'upload d'un avatar. Celui ci doit être au
                                format JPEG ou PNG");
                            }
                        }
                        unset($query,$res);
                        $query = 
                        "SELECT *
                        FROM USERS;";

                        $res = fetchNoSets($db,$query);
                        include('C/Functions/PHP/backupUsers.php');
                        backupUsers($res);
                        unset($res);
                        $query =
                            "SELECT *
                            FROM USERS
                            WHERE ID = :set1;";

                        $res = fetchOneSet($db,$query,$_SESSION['ID']);

                        $holidays = 
                        "SELECT DATE(startsAt) as startsAt, DATE(endsAt) as endsAt
                        FROM HOLIDAYS
                        WHERE userID = :set1";
                        $holi = fetchOneSet($db,$holidays,$_SESSION['ID']);


                        include('V/_template/htmlTop.php');
                        include('V/_template/navbar.php');
                        include('V/_template/account.php');
                    break;
                default:
                    include('E/404.html');
            endswitch;
            break;
        case(isset($_POST['background'])):
                $res = selectBackgrounds($db);
                include('V/_template/backgroundForm.php');
            break;
        default:
            $message = success("Ici, vous pouvez modifier <br>les informations relatives à votre compte");
            $query =
            "SELECT *
            FROM USERS
            WHERE ID = :set1;";

            $res = fetchOneSet($db,$query,$_SESSION['ID']);
            include('V/_template/htmlTop.php');

            include('V/_template/navbar.php');
            
            include('V/_template/account.php');
    endswitch;
    include('V/_template/appsModal.php');

    include('V/_template/footer.html');
?>