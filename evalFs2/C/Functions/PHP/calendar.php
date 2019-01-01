<?php 
    // Déjà on vacommencer par un copyright
    setlocale(LC_ALL, 'fra');

    date_default_timezone_set ("Europe/Paris");
    
    if (isset($_GET['ym'])) { // l'utilisateur a cliqué sur mois suivant ou mois précédent
        $ym = $_GET['ym'];
    } else {
        $ym = date('Y-m');
    }
    $timestamp = strtotime($ym);  
    if ($timestamp === false) {
        $ym = date('Y-m');
        $timestamp = strtotime($ym . '-01');
    }
    
    $today = date('Y-m-j');
    $todays = date('Y-m-d',strtotime('+1 day'));
    //$day = date('')
    $title = utf8_encode(ucfirst(strftime('%B,  %Y', $timestamp)));
    $prev = date('Y-m', strtotime('-1 month', $timestamp));
    $next = date('Y-m', strtotime('+1 month', $timestamp));
    // Number of days in the month
    $daysCount = date('t', $timestamp);
    // 1:Mon 2:Tue 3: Wed ... 7:Sun
    $str = date('N', $timestamp);
    $week = '';
    // Add empty cell(s)
    $week = $week.str_repeat('<td style="min-width:250px;width:250px;min-width: 250px;"></td>', $str - 1);
    for ($day = 1; $day <= $daysCount; $day++, $str++) {
        //($day < 10) ? $day = "0$day" : $day = $day;
        $date = "$ym-$day";
        if ($today == $date) {
            $week .= '<td class="today" data-toggle="tooltip" data-placement="left" title="Ajd" style="background-color:rgba(78,239,56,0.4);width: 250px;min-width: 250px;max-width:250px">';
        } else {
            $week .= '<td style="width: 250px;min-width: 250px;max-width:250px">';
        }
        $week = "$week
        <div class='row'>
            <div class='col-lg-12' style='margin:auto'>
                <form method='post' class='form-check-inline'>
                    <button type='submit' class='btn btn-secondary form-check form-check-inline'  name='fetchApps' value='$date'
                    data-toggle='tooltip' data-placement='top' title='Afficher les évènements de la journée'
                    style='text-align:center;left:10px;font-size:14px'>$day</button>
                    <button type='submit' class='btn btn-secondary form-check form-check-inline' name='addApps' value='$date' 
                    data-toggle='tooltip' data-placement='top' title='Ajouter un évènement' style='text-align:center;left:20px;font-size:14px;width:180px'
                    onclick='select($day,event);'>Ajouter un évènement <i class='now-ui-icons ui-1_simple-add form-check-inline' style='color:#4ca1af'></i></button>
                </form>
            </div>
        </div>
        <div class='row'>
            <div class='col-lg-12'>
                <div class='alert alert-info ml-auto mr-auto' role='alert' style='z-index:4;
                text-align:center;height:85px;color:#FFFFFF;margin-bottom:-12px;vertical-align:bottom;width:102%;left:-2px;right:0px'>
                    <div class='alert-icon'>
                    </div>
                    <form method='post' class='form-check-inline' >
                    <button type='submit' class='btn btn-secondary form-check form-check-inline bg-transparent ml-auto mr-auto' 
                    style='position:relative;box-sizing:unset;outline:inherit;color:#FFFFFF;vertical-align:bottom;top:25px;text-align:center;left:15px;'  name='fetchApps'  value='$date'
                    data-toggle='tooltip' data-placement='left' title='Afficher les évènements de la journée' id='date$day'>
                    <span id='apps$date'>33</span> évènement(s) prévu(s)
                    </button>
                </form>
                    <button type='button' class='close' id='kill$day' data-dismiss='alert' aria-label='Close' style='position:relative;right:-15px;color:#FFFFFF'
                    data-toggle='tooltip' data-placement='right' title='Supprimer tous les évènements de la journée' onclick='select($day,event);'>
                        <span aria-hidden='true' >
                            <i class='now-ui-icons ui-1_simple-remove' ></i>
                        </span>
                    </button>
                </div>
            </div>
        </div>
    </td>";
        if ($str % 7 == 0 || $day == $daysCount) {
            if ($day == $daysCount && $str % 7 != 0) {
                $week = $week.str_repeat('<td style="min-width:250px;width:250px;min-width: 250px;"></td>', 7 - $str % 7);
            }
            $weeks[] = "<tr>$week</tr>";
            $week = '';
        }
    }
    for($i = 0; $i < 8;$i++)
    {
        $_POST[$i] = $i;
    }
    $page = 'calendar';
?>