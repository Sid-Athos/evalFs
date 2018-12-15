<?php
    function noSets($query)
    {
        
        try 
        {
            $stmt = $db->prepare($query);
            $stmt->execute(NULL);
            $res = true;
        }
        catch(PDOException $ex)
        {
            $res = false;   
        }
        return $res;
    }

    function oneSet($query,$set1)
    {
        
        try 
        {
            $stmt = $db->prepare($query);
            $stmt->execute(
                array(
                    ":set1" => $set1
                )
            );
            $res = true;
        }
        catch(PDOException $ex)
        {   
            $res = false;
        }
        return $res; 
    }

    function twoSets($query,$set1,$set2)
    {
        
        try 
        {
            $stmt = $db->prepare($query);
            $stmt->execute(
                array(
                    ":set1" => $set1,
                    ":set2" => $set2
                )
            );
            $res = true;
        }
        catch(PDOException $ex)
        {
            $res = false;   
        }
        return $res; 
    }

    function threeSets($query,$set1,$set2,$set3)
    {
        
        try 
        {
            $stmt = $db->prepare($query);
            $stmt->execute(
                array(
                    ":set1" => $set1,
                    ":set2" => $set2,
                    ":set3" => $set3
                )
            );
            $res = true;
        }
        catch(PDOException $ex)
        {   
            $res = false;
        }
        return $res; 
    }
    
    function fourSets($query,$set1,$set2,$set3,$set4)
    {
        
        try 
        {
            $stmt = $db->prepare($query);
            $stmt->execute(
                array(
                    ":set1" => $set1,
                    ":set2" => $set2,
                    ":set3" => $set3,
                    ":set4" => $set4
                )
            );
            $res = true;
        }
        catch(PDOException $ex)
        {   
            $res = false;
        }
        return $res; 
    }
?>