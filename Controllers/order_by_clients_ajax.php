<?php
/* On update l'historique côté vets; ici on controle et on dit KESSKONFAI*/
    include('../Models/db_connect.php');
    $a = explode('-',$_GET['a']);
    $o = $_GET['o'];

    switch($a):
        case($a[1] === 'breed'):
                    $query = 
                    "SELECT pet_name, ID, breed, colour, sex, date_of_birth,microchip_tatoo, history
                    FROM patients
                    WHERE
                    owner_ID = :ID
                    ORDER BY breed ";
            break;
        case($a[1] === 'name'):
                    $query = 
                    "SELECT pet_name, ID, breed, colour, sex, date_of_birth,microchip_tatoo, history
                    FROM patients
                    WHERE
                    owner_ID = :ID
                    ORDER BY pet_name ";
            break;
        case($a[1] === 'color'):
                    $query = 
                    "SELECT pet_name, ID, breed, colour, sex, date_of_birth,microchip_tatoo, history
                    FROM patients
                    WHERE
                    owner_ID = :ID
                    ORDER BY colour ";
            break;
        case($a[1] === 'sex'):
                    $query = 
                    "SELECT pet_name, ID, breed, colour, sex, date_of_birth,microchip_tatoo, history
                    FROM patients
                    WHERE
                    owner_ID = :ID
                    ORDER BY sex ";
                break;
        case($a[1] === 'date'):
                    $query = 
                    "SELECT pet_name, ID, breed, colour, sex, date_of_birth,microchip_tatoo, history
                    FROM patients
                    WHERE
                    owner_ID = :ID
                    ORDER BY date_of_birth ";
            break;
        case($a[1] === 'chip'):
                    $query = 
                    "SELECT pet_name, ID, breed, colour, sex, date_of_birth,microchip_tatoo, history
                    FROM patients
                    WHERE
                    owner_ID = :ID
                    ORDER BY microchip_tatoo ";
            break;
        case($a[1] === 'hist'):
                $query = 
                "SELECT pet_name, ID, breed, colour, sex, date_of_birth,microchip_tatoo, history
                FROM patients
                WHERE
                owner_ID = :ID
                ORDER BY history ";
            break;
        default:
    endswitch;
    if($a[0] === 'desc'){
        $query = $query.'DESC';
    } else {
        $query = $query.'ASC';
    }
    if(isset($query)){
        include('../Models/order_by_clients.php');
        $patients_rows = order_by($query,$o,$db);
    }
?>