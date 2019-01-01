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

    include('V/_template/htmlTop.php');
    //var_dump($res);
    include('V/_template/navbar.php');
    include('V/_template/calendar.php');
?>