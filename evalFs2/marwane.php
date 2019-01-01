<?php
    include('M/dbConnect.php');



    try 
    {
        $stmt = $db->prepare($query);
        $stmt->execute(
            array(
                ":date"=> $date,
            )
        );
        $res = true;
    }
    catch(PDOException $ex)
    {   
        echo $ex;
        $res = false;
    }

    unset($query);

    $query = "SELECT STR_TO_DATE('".$date."', )";

    try 
    {
        $stmt = $db->prepare($query);
        $stmt->execute(
            array(
                ":date"=> $date,
            )
        );
        $res = $stmt -> fetchAll();
        var_dump($res);
    }
    catch(PDOException $ex)
    {   
        echo $ex;
        $res = false;
    }
?>