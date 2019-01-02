
<?php
    $page = "Gestion de compte";
    include('V/_template/htmlTop.php');
    include('M/dbConnect.php');
    require_once('M/getSql.php');
    require_once('M/otherSql.php');
    $actualDate = actualDate($db);
    include('V/_template/navbar.php');
    include('C/Functions/PHP/messages.php');
    include('C/Functions/PHP/killAvatar.php');

    switch(isset($_POST)):
        case(isset($_POST['choice'])):
            switch($_POST['choice']):
                case($_POST['choice'] === 'changeBackground'):
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
                        unset($message);
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
                                    
                                    $query = 
                                    "SELECT avPath
                                    FROM USERS
                                    WHERE ID = :set1;";

                                    $actualAvatar = fetchOneSet($db,$query,$_SESSION['ID']);
                                    $dir='V/A/';
                                    $avatarPath=$dir.basename($_FILES['avatar']['name']);

                                    if(!empty($actualAvatar['avPath']))
                                    {
                                    
                                        killAvatar("V/A",$actualAvatar['avPath']);
                                    }
                                    $upload = move_uploaded_file($_FILES['avatar']['tmp_name'],$avatarPath);

                                    $query =
                                        "UPDATE USERS 
                                        SET avPath = :set1
                                        WHERE ID = :set2;";

                                    $check = twoSets($db,$query,$avatarPath,$_SESSION['ID']);
                                    if($upload === true && $check === true)
                                    {
                                        $_SESSION['avatar'] = $avatarPath;
                                        $messages[] = success("Photo ajoutée");
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
            include('V/_template/account.php');
    endswitch;
    include('V/_template/footer.html');
?>