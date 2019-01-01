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

    include('V/_template/htmlTop.php');
    //var_dump($res);
    include('V/_template/navbar.php');
    include('C/Functions/PHP/calendar.php');
    include('V/_template/calendar.php');
    include('V/_template/appDetailsCards.php');
    include('V/_template/appsmodal.php');
    include('V/_template/footer.html');
?>