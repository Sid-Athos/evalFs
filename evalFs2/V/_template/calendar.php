<?php 
    // Déjà on vacommencer par un copyright
    $_SESSION['ID'] = 6;
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
                    33 évènement(s) prévu(s)
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

    <body style="background-color:rgba(0,5,5,0.8);margin-top:0px">
        <div class="wrapper">
            <div class="page-header clear-filter">
                <div class="page-header-image" data-parallax="true" style="background-image:url('V/_template/assets/img/header.jpg');"></div>
                
                    <div class="row" style="margin-top:65px">
                        <div class="col-lg-12">
                            <div class="container">
                                <ul class="list-inline" style="height:45px">
                                    <li class="list-inline-item"><a href="index.php?page=calendar&&ym=<?= $prev; ?>" class="btn btn-link">&lt; Mois précèdent</a></li>
                                    <li class="list-inline-item"><div class="container" style="width:400px;height:45px"><span class="title"><?= $title; ?></span><a href="index.php?page=calendar" class="btn btn-link">Mois actuel</a></div></li>
                                    <li class="list-inline-item"><a href="index.php?page=calendar&&ym=<?= $next; ?>" class="btn btn-link">Mois suivant &gt;</a></li>
                                    <li class="list-inline-item"></li>
                                </ul>
                            </div>
                        </div>
                    </div>
            
                    <div class="content-center-brand" >
                        
                        <table class="table table-bordered table-dark" style="margin:auto">
                            <thead>
                                <tr style="width:900px">
                                    <th style="width:250px;min-width: 250px;">Lundi</th>
                                    <th style="width:250px;min-width: 250px;">Mardi</th>
                                    <th style="width:250px;min-width: 250px;">Mercredi</th>
                                    <th style="width:250px;min-width: 250px;">Jeudi</th>
                                    <th style="width: 250px;min-width: 250px;">Vendredi</th>
                                    <th style="width:250px;min-width: 250px;" data-toggle="tooltip" data-placement="top" title="CI LI">Samedi</th>
                                    <th style="width:250px;min-width: 250px;" data-toggle="tooltip" data-placement="top" title="WIK AND">Dimanche</th>
                                </tr>
                            </thead>
                            <tbody style="width:900px">
                                <?php
                                    foreach ($weeks as $week) {
                                        echo $week;
                                    }
                                ?>
                            </tbody>
                        </table>
                        
                    </div>
            </div>
        </div> 
        
        <div class="wrapper"  >
            <div class="content-center-brand" style="margin:auto;max-width:1900px;min-width:1900px;padding-top:70px">
            <?php
            $compteur = 0;
            for($i = 0; $i <  32; $i++)
            {
                ?>
            <div class="card-container form-check-inline"  data-toggle="tooltip" data-placement="right" title="Passez la souris par dessus la carte pour voir apparaître le planning">
                    <div class="card" style="border:none;width:250px;position:relative;top:-200px">
                        <div class="front" style="background-color:#212529;border:none;border-top-left-radius:5px;border-top-right-radius:5px">
                            <div class="header" style="background-color:rgba(44, 95, 255);text-align:center;z-index:99;border-top-left-radius:5px;border-top-right-radius:5px">
                                <h2 class="motto" style="z-index:99;color:#FFFFFF;font-size:20px">Samedi 8 Décembre 2018</span>
                            </div>
                            <div class="user" style="z-index:2;border:none">
                                <img class="img-circle" src="V/_template/assets/img/header.jpg" style="z-index:-2;border:none">
                            </div>
                            <div class="content">
                                <div class="main" style="background-color:#212529;color:rgba(255,255,255,0.7)">
                                    <h3 class="name">Inna Corman</h3>
                                    <p class="profession">Product Manager</p>

                                    <p class="text-center">"I'm the new Sinatra, and since I made it here I can make it anywhere, yeah, they love me everywhere"</p>
                                </div>
                                
                            </div>
                        </div> <!-- end front panel -->
                        <div class="back" style="overflow-y:scroll;overflow-x:hidden;background-color:#212529;border-top-left-radius:5px;border-top-right-radius:5px">
                            <div class="content" style="border-top-left-radius:5px;border-top-right-radius:5px">
                                <div id="accordion" role="tablist" aria-multiselectable="true" class="card-collapse" 
                                style="-moz-transform: scale(-1, 1);-webkit-transform: scale(-1, 1);-o-transform: scale(-1, 1);
                                -ms-transform: scale(-1, 1);transform: scale(-1, 1);background:transparent">
                                    <div class="card card-plain" style="background:transparent">
                                        <div class="card-header" role="tab" id="heading<?php echo $compteur; ?>" style="text-align:center">
                                            <a data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo $compteur; ?>" aria-expanded="false" aria-controls="collapse<?php echo $compteur; ?>">
                                            Infos pratiques
                                            <i class="now-ui-icons arrows-1_minimal-down"></i>
                                            </a>
                                        </div>
                                        <div id="collapse<?php echo $compteur; ?>" class="collapse hide" role="tabpanel" aria-labelledby="heading<?php echo $compteur; $compteur++?>">
                                            <div class="card-body" style="background:transparent;color:rgb(255,255,255,0.7)">
                                                Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 
                                                3 wolf moon officia aute, non cupidatat skateboard dolor brunch. 
                                                Food truck quinoa nesciunt laborum eiusmod. 
                                                Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. 
                                                Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. 
                                                Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth 
                                                nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card card-plain" style="background:transparent">
                                        <div class="card-header" role="tab" id="heading<?php echo $compteur; ?>" style="text-align:center">
                                            <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo $compteur; ?>" 
                                            aria-expanded="false" aria-controls="collapse<?php echo $compteur; ?>">
                                            Participant(s)
                                            <i class="now-ui-icons arrows-1_minimal-down"></i>
                                            </a>
                                        </div>
                                        <div id="collapse<?php echo $compteur; ?>" class="collapse" role="tabpanel" aria-labelledby="heading<?php echo $compteur; $compteur++?>">
                                            <div class="card-body" style="background:transparent;color:rgb(255,255,255,0.7)">
                                                Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 
                                                3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. 
                                                Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. 
                                                Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. 
                                                Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth 
                                                nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <h5 class="motto">Tobby or not tobby? Dat ist da kwechtionne</h5>
                                <div class="header">
                                    <h5 class="motto">"To be or not to be, this is my awesome motto!"</h5>
                                </div>
                                <div class="header">
                                    <h5 class="motto">"To be or not to be, this is my awesome motto!"</h5>
                                </div>
                                <div class="header">
                                    <h5 class="motto">"To be or not to be, this is my awesome motto!"</h5>
                                </div>
                            </div>
                            <div class="content" style="margin-bottom:-80px;background-color:transparent">
                                <div class="main" style="background-color:transparent;color:#FFFFFF" >
                                    <h4 class="text-center">Job Description</h4>
                                    <p class="text-center">Web design, Adobe Photoshop, HTML5, CSS3, Corel and many others...</p>
                                </div>
                            </div>
                            <div class="footer">
                                <div class="social-links text-center">
                                    <a href="#" class="facebook"><i class="fa fa-facebook fa-fw"></i></a>
                                    <a href="#" class="google"><i class="fa fa-google-plus fa-fw"></i></a>
                                    <a href="#" class="twitter"><i class="fa fa-twitter fa-fw"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
    </div>
                <?php
            }
            ?>
            </div>
        </div>
        <div class="modal fade modal-primary" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-login" style="margin:auto;margin-top:4%">
                <div class="modal-content" style="background-color:#333333">
                    <div class="card card-login card-plain" style="background-color:#333333;width:600px;top:0px;transform:none">
                        <div class="modal-header justify-content-center" style="height:70px">
                            <h5 class="motto" style="font-size:24px;margin-left:25px">
                            Ajouter un évènement
                            </h5>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                                <i class="now-ui-icons ui-1_simple-remove" style="color:#decba4"></i>
                            </button>

                            <div class="header header-primary text-center">
                                <div class="logo-container">
                                    <img src="/assets/img/now-logo.png" alt="">
                                </div>
                            </div>
                        </div>
                        <div id="answer" class="modal-header justify-content-center answer">
                        </div>
                        <div class="modal-body" data-background-color >
                            <form class="form" method="POST" action="index.php?page=login" id="addAppForm" autocomplete="false">
                                <div class="modal-header justify-content-center" style="margin-top:-30px;margin-bottom:-30px" >
                                    <h5 class="motto" style="padding:10px">Seuls les champs de date/nom/heure/durée sont obligatoires</h5>
                                </div>
                                <div class="card-body" style="text-align:center">
                                    <div class="form-check form-check-inline " style="position:relative;left: 30px;">
                                        <div class="input-group no-border input-xs" style="max-width:210px;width:210px;left:-15px" data-toggle="tooltip" data-placement="left" title="Date de l'évènement">
                                            <div class="input-group-prepend" id="prep" style="margin-top:10px">
                                                <span class="input-group-text" style="height:46px">
                                                <i class="now-ui-icons ui-1_calendar-60" style="color:#FFFFFF"></i>
                                                </span>
                                            </div>
                                            <input type="date" onchange="newDate(this)" 
                                            class="form-check form-check-inline form-control" placeholder="Date de rendez-vous"  name="appDate" id="0" min="<?= $todays; ?>"
                                            value="<?php if(isset($flagName)){ echo $flagName; } ?>" style="height:45px;border-top-right-radius:0px;border-bottom-right-radius:0px" 
                                            required autocomplete="off" >
                                        </div>
                                    </div>
                                    <div class="form-check form-check-inline" style="float: right;position: relative;right: 5px;">
                                        <div class="input-group no-border input-xs " style="width:260px;" data-toggle="tooltip" data-placement="right" title="Nom de l'évènement">
                                            <div class="input-group-prepend " id="prep" style="margin-top:10px">
                                                <span class="input-group-text" style="height:46px">
                                                <i class="now-ui-icons text_align-left" style="color:#FFFFFF"></i>
                                                </span>
                                            </div>
                                            <input type="text" class="form-check form-check-inline form-control" placeholder="Nom de l'évènement"  
                                            name="appName" id="1" min="<?= $todays; ?>" 
                                            value="<?php if(isset($flagName)){ echo $flagName; } ?>" style="height:45px;border-top-right-radius:0px;border-bottom-right-radius:0px" 
                                            required autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-check form-check-inline" style="position: relative;left:45px;width:480px">
                                            <div class="input-group no-border input-xs " data-toggle="tooltip" data-placement="right" title="Horaire de début">
                                                <div class="input-group-prepend " id="prep" style="margin-top:11px">
                                                    <span class="input-group-text" style="height:45px">
                                                    <i class="now-ui-icons text_align-left" style="color:#FFFFFF"></i>
                                                    </span>
                                                </div>
                                                <input type="number" class="form-check form-check-inline form-control" placeholder="Heure de début"  
                                                name="appHour" id="1" min="0" max="23"
                                                value="<?php if(isset($flagName)){ echo $flagName; } ?>" style="height:46px;border-top-right-radius:0px;border-bottom-right-radius:0px" 
                                                required autocomplete="off"> <span style="position:relative;top:20px;margin-right:10px">H</span>
                                                <div class="input-group-prepend " id="prep" style="margin-top:11px">
                                                    <span class="input-group-text" style="height:46px">
                                                    <i class="now-ui-icons text_align-left" style="color:#FFFFFF"></i>
                                                    </span>
                                                </div>
                                                <input type="number" class="form-check form-check-inline form-control" placeholder="Minutes"  
                                                name="appMins" id="1" min="0" max="55" step="5"
                                                value="<?php if(isset($flagName)){ echo $flagName; } ?>" style="height:46px;border-top-right-radius:0px;border-bottom-right-radius:0px" 
                                                required autocomplete="off"> <span style="position:relative;top:20px">M</span>
                                            </div>
                                        </div>
                                        <div class="input-group no-border input-xs" style="width:485px;left:45px" data-toggle="tooltip" data-placement="top" 
                                        title="Catégorie de l'évènement">
                                            <div class="input-group-prepend " id="prep" style="margin-top:11px">
                                                <span class="input-group-text" style="height:46px">
                                                <i class="now-ui-icons files_box" style="color:#FFFFFF"></i>
                                                </span>
                                            </div>
                                            <select class="form-check form-check-inline form-control" 
                                            style="height:46px" name="appCat">
                                                <?php
                                                    for($i = 0; $i < count($res); $i++)
                                                    {
                                                        ?>
                                                            <option style="color:#FFF;background-color:rgb(0,0,0,0.8);border-radius:3px;" value="<?php echo $res[$i]['ID']; ?>">
                                                            <?php echo $res[$i]['name']; ?></option>
                                                        <?php
                                                    }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    
                                    <div class="content-center-brand" style="margin:auto">
                                        <h5 class="motto" style="width:200px;margin:auto">Récurrence</h5>
                                        <div class="form-check form-check-radio form-check-inline">
                                            <label class="form-check-label">
                                                <input class="form-check-input" type="radio" name="appRecc" id="rec1" value="1" onchange="showIt(this.value);document.getElementById('endDate').value = document.getElementById('1').value"> Évènement récurrent
                                                <span class="form-check-sign"></span>
                                            </label>
                                        </div>
                                        <div class="form-check form-check-radio form-check-inline">
                                            <label class="form-check-label">
                                                <input class="form-check-input" type="radio" name="appRecc" checked id="rec2" value="0" onchange="showIt(this.value);document.getElementById('endDate').value = document.getElementById('1').value"> Évènement ponctuel
                                                <span class="form-check-sign"></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="form-row" id="loulilol" style="display:none;margin-top:10px">
                                        <div class="input-group no-border input-xs" style="width:485px;left:45px" data-toggle="tooltip" data-placement="top" 
                                        title="Date de fin de réccurence">
                                            <div class="input-group-prepend " id="prep" style="margin-top:10px">
                                                <span class="input-group-text" style="height:45px">
                                                <i class="now-ui-icons location_pin" style="color:#FFFFFF"></i>
                                                </span>
                                            </div>
                                            <input type="date" class="form-check form-check-inline form-control" name="endDate" min="<?= $todays; ?>" id="endDate"
                                            value="<?php if(isset($flagName)){ echo $flagName; } ?>" style="height:45px;border-top-right-radius:0px;border-bottom-right-radius:0px" 
                                            autocomplete="off">
                                        </div>
                                        <div class="content-center-brand" style="margin:auto;margin-top:-25px">
                                        <br>
                                        <h5 class="motto" style="width:200px;margin:auto">Fréquence</h5>
                                        <div class="form-check form-check-radio form-check-inline">
                                            <label class="form-check-label">
                                                <input class="form-check-input" type="radio" name="appFreq" id="freq1" value="1">Chaques jours
                                                <span class="form-check-sign"></span>
                                            </label>
                                        </div>
                                        <div class="form-check form-check-radio form-check-inline">
                                            <label class="form-check-label">
                                                <input class="form-check-input" type="radio" name="appFreq" id="freq2" value="7">Chaques semaine
                                                <span class="form-check-sign"></span>
                                            </label>
                                        </div>
                                        <div class="form-check form-check-radio form-check-inline">
                                            <label class="form-check-label">
                                                <input class="form-check-input" type="radio" name="appFreq" id="freq3" value="month">Chaques mois
                                                <span class="form-check-sign"></span>
                                            </label>
                                        </div>
                                        </div>
                                    </div>
                                    <div class="form-row" style="margin-top:5px">
                                        <div class="input-group no-border input-xs" style="width:485px;left:45px" data-toggle="tooltip" data-placement="top" 
                                        title="Nous servira à localiser l'évènement. Veuillez indiquer au minimum la rue et le code postal (ou la ville)">
                                            <div class="input-group-prepend " id="prepit" style="margin-top:10px">
                                                <span class="input-group-text" style="height:45px">
                                                <i class="now-ui-icons location_pin" style="color:#FFFFFF"></i>
                                                </span>
                                            </div>
                                            <input type="text" class="form-check form-check-inline form-control" placeholder="Adresse"  
                                            name="appPlace" min="<?= $todays; ?>"
                                            value="<?php if(isset($flagName)){ echo $flagName; } ?>" style="height:45px;border-top-right-radius:0px;border-bottom-right-radius:0px" 
                                            autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="form-row" style="margin-top:12px">
                                        <div class="form-check" style="margin:auto;width:470px;left:5px" data-toggle="tooltip" data-placement="right" title="Notes (non obligatoires)">
                                            <div class="input-group no-border input-lg">
                                                <div class="input-group-prepend" >
                                                    <span class="input-group-text" style="height:80px"><i class="now-ui-icons files_paper" style="color: #FFFFFF"></i></span>
                                                </div>
                                            <textarea placeholder="Pense-bête" name="appNotes" id="1" class="form-control mod-input" 
                                            rows="10" lines="50" 
                                            value="<?php if(isset($flagPassword)){ echo $flagPassword; } ?>" style="color:#FFFFFF"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer text-center ml-auto">
                                
                                    <button type="submit" class="btn btn-default btn-round ml-auto mr-auto" style="">Enregistrer le rendez-vous</button>
                                </div>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
            <!-- Footer -->
        <footer class="page-footer font-small stylish-color-dark pt-4" style="background-color:#000;color:#FFFFFF;margin-bottom:-15px;">
            <div class="container text-center text-md-left">
                <div class="row">
                    <div class="col-md-4 mx-auto">
                        <h5 class="font-weight-bold text-uppercase mt-3 mb-4">TimeStamped</h5>
                        <p>Un projet réalisé par Sid wallah</p>
                    </div>
                <hr class="clearfix w-100 d-md-none">
                    <div class="col-md-2 mx-auto">
                    </div>
                <hr class="clearfix w-100 d-md-none">
                    <div class="col-md-2 mx-auto">
                    </div>
                <hr class="clearfix w-100 d-md-none">
                    <div class="col-md-2 mx-auto">
                        <h5 class="font-weight-bold text-uppercase mt-3 mb-4">Créé par</h5>
                        <ul class="list-unstyled" style="color:orange">
                            <li>
                                Sid Bennaceur
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <hr>
            <ul class="list-unstyled list-inline text-center">
                <li class="list-inline-item">
                    <a class="btn-floating btn-fb mx-1">
                    <i class="fab fa-facebook-f" style="font-size:24px"></i>
                    </a>
                </li>
                <li class="list-inline-item">
                    <a class="btn-floating btn-tw mx-1">
                    <i class="fas fa-feather" style="font-size:24px"></i> Nous écrire
                    </a>
                </li>
                <li class="list-inline-item">
                    <a class="btn-floating btn-gplus mx-1">
                    <i class="fa fa-google-plus" style="font-size:24px"> </i>
                    </a>
                </li>
                <li class="list-inline-item">
                    <a class="btn-floating btn-li mx-1">
                    <i class="fa fa-linkedin" style="font-size:24px"> </i>
                    </a>
                </li>
                <li class="list-inline-item">
                    <a class="btn-floating btn-dribbble mx-1">
                    <i class="fa fa-dribbble" style="font-size:24px"> </i>
                    </a>
                </li>
            </ul>
        </footer>
    </body>
</html>

<script>
$("#addAppForm").submit(function(event){
        event.preventDefault();
        query = $.post({
            url : 'checkAjax.php',
            data : 
            {
                'appName': $('input[name=appName]').val(), 
                'appDate': $('input[name=appDate]').val(), 
                'appCat' : $('select[name=appCat]').val(),
                'appNotes' : $('textarea[name=appNotes]').val(),
                'appPlace' : $('input[name=appPlace]').val(),
                'appHour' : $('input[name=appHour]').val(),
                'appMins' : $('input[name=appMins]').val(),

            }
        });
        query.done(function(response){
            $('#answer').html(response);
        });
    });
</script>