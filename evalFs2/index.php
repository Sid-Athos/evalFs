<?php
    session_start();
    var_dump($_SESSION);
    var_dump($_REQUEST);
    setlocale(LC_ALL, 'fra');

    date_default_timezone_set ("Europe/Paris");

    switch(isset($_GET)):
        case(isset($_GET['page'])):
            switch($_GET['page']):
                case($_GET['page'] === 'login'):
                        include('C/login.php');
                    break;
                case($_GET['page'] === 'lobby'):
                        //include('C/Functions/PHP/sessionCheck.php');
                        //include('C/lobby.php');
                        header('Location:index.php?page=calendar');
                        echo "duijsqgdijkqgduigqsuidgqsiu";
                    break;
                case($_GET['page'] === 'account'):
                        include('C/Functions/PHP/sessionCheck.php');
                        include('C/account.php');
                    break;
                case($_GET['page'] === 'logout'):
                        include('C/logout.php');
                    break;
                case($_GET['page'] === 'browse'):
                        include('C/browse.php');
                    break;
                case($_GET['page'] === 'events'):
                        include('C/platoons.php');
                    break;
                case($_GET['page'] === 'messages'):
                        include('C/messages.php');
                        echo 'Messagerie';
                    break;
                case($_GET['page'] === 'calendar'):
                        include('C/calendar.php');
                    break;
                default:
                    include('E/404.html');
            endswitch;
            break;
        default:
            include('C/login.php');
    endswitch;
?>