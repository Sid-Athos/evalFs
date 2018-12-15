<?php
    session_start();
    
    switch(isset($_GET)):
        case(isset($_GET['page'])):
            switch($_GET['page']):
                case($_GET['page'] === 'login'):
                        include('C/login.php');
                    break;
                case($_GET['page'] === 'lobby'):
                        include('C/Functions/PHP/sessionCheck.php');
                        include('C/lobby.php'); 
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
                default:
                    include('E/404.html');
            endswitch;
            break;
        default:
            include('C/login.php');
    endswitch;
?>