
        <style>
        . {

            padding-left: 0;

        }
</style>
        <div class="modal fade modal-primary" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-login" style="margin:auto;margin-top:4%">
                <div class="modal-content" style="background-color:#333333">
                    <div class="card card-login card-plain" style="background-color:#333333;width:600px;top:0px;transform:none">
                        <div class="modal-header justify-content-center" style="height:70px">
                            <h5 class="motto" style="font-size:24px;margin-left:25px">
                            Ajouter un rendez-vous
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
                            <div class="progress">
                                <div class="indeterminate"></div>
                            </div>
                        </div>
                        <div class="modal-body" data-background-color >
                            <form class="form" method="POST" action="index.php?page=apps" id="addAppForm" autocomplete="false">
                                <div class="modal-header justify-content-center" style="margin-top:-30px;" >
                                    <h5 class="motto" style="padding:10px">Seuls les champs de date/nom/heure/durée sont obligatoires</h5>
                                </div>
                                <div class="card-body" style="text-align:center">
                                    <div class="form-row" style=" ;width:490px;margin-left:39px">
                                        <div class="input-group no-border input-xs" 
                                        style="max-width:230px;width:230px;height:auto" data-toggle="tooltip" data-placement="left" 
                                        title="Date de l'évènement">
                                            <div class="input-group-prepend" id="prep">
                                                <span class="input-group-text" style="height:auto;">
                                                <i class="now-ui-icons ui-1_calendar-60" style="color:#FFFFFF"></i>
                                                </span>
                                            </div>
                                            <input type="date" onchange="newDate(this)" 
                                            class=" form-check-inline form-control" placeholder="Date de rendez-vous"  
                                            name="appDate" id="0" min="<?= $todays; ?>"
                                            value="<?php if(isset($flagName)){ echo $flagName; } ?>" 
                                            style="border-top-right-radius:0px;border-bottom-right-radius:0px" 
                                            required autocomplete="off" >
                                        </div>
                                        <div class="input-group no-border input-xs " style="width:260px;" data-toggle="tooltip" 
                                        data-placement="right" title="Nom de l'évènement">
                                            <div class="input-group-prepend " id="prep" style=" ">
                                                <span class="input-group-text" style="height:45px">
                                                <i class="now-ui-icons text_align-left" style="color:#FFFFFF"></i>
                                                </span>
                                            </div>
                                            <input type="text" class=" form-check-inline form-control" placeholder="Nom de l'évènement"  
                                            name="appName" id="1" min="<?= $todays; ?>" 
                                            value="<?php if(isset($flagName)){ echo $flagName; } ?>" 
                                            style="height:45px;border-top-right-radius:0px;border-bottom-right-radius:0px" 
                                            required autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class=" form-check-inline" style="position: relative;left:37px;width:480px">
                                            <div class="input-group no-border input-xs " style="left:7px">
                                                <div class="input-group-prepend " id="prep" style=" ">
                                                    <span class="input-group-text" style="height:46px">
                                                    <i class="now-ui-icons text_align-left" style="color:#FFFFFF"></i>
                                                    </span>
                                                </div>
                                                <input type="time" class=" form-check-inline form-control" 
                                                placeholder="Heure de début"  
                                                name="appHour" id="2" min="0" max="23"
                                                value="<?php if(isset($flagName)){ echo $flagName; } ?>" 
                                                data-toggle="tooltip" data-placement="top" 
                                                title="Horaire de début"
                                                style="height:46px;border-top-right-radius:0px;border-bottom-right-radius:0px;
                                                max-width:182px" 
                                                required autocomplete="off"> 
                                            </div>
                                            <div class="input-group no-border input-xs" data-toggle="tooltip" 
                                            data-placement="top" 
                                            title="Catégorie de l'évènement" style="left:-2px">
                                                <div class="input-group-prepend " id="prep" >
                                                    <span class="input-group-text" style="height:45px">
                                                    <i class="now-ui-icons files_box" style="color:#FFFFFF"></i>
                                                    </span>
                                                </div>
                                                <select class=" form-check-inline form-control" 
                                                style="height:45px;widtih:200px" name="appCat" id="3">
                                                    <?php
                                                        for($i = 0; $i < count($res); $i++)
                                                        {
                                                            ?>
                                                                <option style="color:#FFF;background-color:rgb(0,0,0,0.8);border-radius:3px;" 
                                                                value="<?php echo $res[$i]['ID']; ?>">
                                                                <?php echo $res[$i]['name']; ?></option>
                                                            <?php
                                                        }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <?php
                                            if(!empty($patients))
                                            {
                                                ?>
                                        <div class=" form-check-inline" id="patientsSelect" style="position: relative;left:45px;width:480px;left:49px">
                                        <div class="input-group no-border input-xs" data-toggle="tooltip" 
                                            data-placement="top" 
                                            title="Catégorie de l'évènement" style="left:-2px">
                                                <div class="input-group-prepend " id="prep" >
                                                    <span class="input-group-text" style="height:45px">
                                                    <i class="now-ui-icons files_box" style="color:#FFFFFF"></i>
                                                    </span>
                                                </div>
                                                <select class=" form-check-inline form-control" id="4"
                                                style="height:45px;widtih:200px" name="appPat">
                                                    <?php
                                                        for($i = 0; $i < count($patients); $i++)
                                                        {
                                                            ?>
                                                                <option style="color:#FFF;background-color:rgb(0,0,0,0.8);border-radius:3px;" 
                                                                value="<?php echo $patients[$i]['ID']; ?>">
                                                                <?php echo $patients[$i]['name']; ?></option>
                                                            <?php
                                                        }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                            <?php
                                            }
                                        ?>
                                    <div class="content-center-brand" style="margin:auto">
                                        <h5 class="motto" style="width:200px;margin:auto">Choix du patient</h5>
                                        <div class="form-check form-check-radio form-check-inline">
                                            <label class="form-check-label">
                                                <input class="form-check form-check-input" type="radio" name="appRecc" id="rec1" value="1" 
                                                onchange="showIt(this.value);"> 
                                                Nouveau client
                                                <span class="form-check-sign"></span>
                                            </label>
                                        </div>
                                        <div class="form-check form-check-radio form-check-inline">
                                            <label class="form-check form-check-label">
                                                <input class="form-check form-check-input" type="radio" name="appRecc" id="rec2" value="0" 
                                                onchange="showIt(this.value);"> 
                                                Nouveau patient
                                                <span class="form-check-sign"></span>
                                            </label>
                                        </div>
                                        <div class="form-check form-check-radio form-check-inline">
                                            <label class="form-check form-check-label">
                                                <input class="form-check form-check-input" type="radio" name="appRecc" id="rec3" value="2" checked
                                                onchange="showIt(this.value);"> 
                                                Patient existant
                                                <span class="form-check-sign"></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="form-row" id="loulilol" style="display:none;max-width:450px;margin:auto; ">                                        
                                        <div class="input-group no-border input-xs">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">
                                                <i class="now-ui-icons ui-1_email-85" style="color:#FFFFFF"></i>
                                                </span>
                                            </div>
                                            <input type="text" class="form-control" style="color:#FFFFFF" autocomplete="off" id="5"
                                            placeholder="Nom" name="newCliName" 
                                            value="<?php if(isset($res[0]['mail'])){ echo $res[0]['mail']; }?>">
                                        </div>
                                        <div class="input-group no-border input-xs">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">
                                                <i class="now-ui-icons ui-1_email-85" style="color:#FFFFFF"></i>
                                                </span>
                                            </div>
                                            <input type="text" class="form-control" style="color:#FFFFFF" autocomplete="off" id="6"
                                            placeholder="Prénom" name="newCliFiName" 
                                            value="<?php if(isset($res[0]['mail'])){ echo $res[0]['mail']; }?>">
                                        </div>
                                        <div class="input-group no-border input-xs">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">
                                                <i class="now-ui-icons ui-1_email-85" style="color:#FFFFFF"></i>
                                                </span>
                                            </div>
                                            <input type="text" class="form-control" style="color:#FFFFFF" autocomplete="off" id="7"
                                            placeholder="Adresse" name="newCliAdress" 
                                            value="<?php if(isset($res[0]['mail'])){ echo $res[0]['mail']; }?>">
                                        </div>
                                        <div class="input-group no-border input-xs">
                                            <div class="input-group-prepend">
                                            <span class="input-group-text">
                                            <i class="now-ui-icons users_circle-08" style="color:#FFFFFF"></i>
                                            </span>
                                            </div>
                                            <input type="text" class="form-control" placeholder="Code Postal" style="color:#FFFFFF" autocomplete="off" 
                                            title="Alphanumériques, point, underscore, tirets et apostrophe uniquement, minimum 4 caractères" 
                                            name="newCliPost"  pattern="/^[0-9]{5}$/" id="8"
                                            value="<?php if(isset($res[0]['pseudo'])){ echo $res[0]['pseudo']; }?>">
                                        </div>
                                        <div class="input-group no-border input-lg">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">
                                                <i class="fas fa-phone" style="color:#FFFFFF"></i>
                                                </span>
                                            </div>
                                            <input type="text" class="form-control" placeholder="Ville" style="color:#FFFFFF" 
                                             name="newCliTows" id="9"
                                            value="<?php if(isset($res[0]['phone'])){ if($res[0]['phone'] !== NULL){ echo $res[0]['phone']; } }?>" autocomplete="off">
                                        </div>
                                        <div class="input-group no-border input-lg">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">
                                                <i class="fas fa-phone" style="color:#FFFFFF"></i>
                                                </span>
                                            </div>
                                            <input type="phone" class="form-control" placeholder="Téléphone" style="color:#FFFFFF" 
                                            pattern="^[0-9]{10,12}$" name="newCliPhone" id="10"
                                            value="<?php if(isset($res[0]['phone'])){ if($res[0]['phone'] !== NULL){ echo $res[0]['phone']; } }?>" autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="form-row" id="lolilol" style="display:none;max-width:450px;margin:auto; ">
                                        <div class="input-group no-border input-xs">
                                            <div class="input-group-prepend">
                                            <span class="input-group-text">
                                            <i class="now-ui-icons users_circle-08" style="color:#FFFFFF"></i>
                                            </span>
                                            </div>
                                            <input type="text" class="form-control" placeholder="Nom du patient" style="color:#FFFFFF" autocomplete="off" 
                                            title="Alphanumériques, point, underscore, tirets et apostrophe uniquement, minimum 4 caractères" 
                                            name="newPatName"  pattern="/^[a-zA-Z0-9\_\'\.\-]{4,45]$/" id="4"
                                            value="<?php if(isset($res[0]['pseudo'])){ echo $res[0]['pseudo']; }?>">
                                        </div>
                                        <div class="input-group no-border input-lg">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">
                                                <i class="fas fa-phone" style="color:#FFFFFF"></i>
                                                </span>
                                            </div>
                                            <input type="text" class="form-control" placeholder="Prénom du patient" style="color:#FFFFFF" 
                                            pattern="^[0-9]{10,12}$" name="newPatFi" id="5"
                                            value="<?php if(isset($res[0]['phone'])){ if($res[0]['phone'] !== NULL){ echo $res[0]['phone']; } }?>" autocomplete="off">
                                        </div>
                                        <div class="input-group no-border input-lg">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">
                                                <i class="fas fa-phone" style="color:#FFFFFF"></i>
                                                </span>
                                            </div>
                                            <input type="date" class="form-control" placeholder="Date de naissance" style="color:#FFFFFF" 
                                             name="newPatBirth" id="5" max="<?php echo $todays; ?>" id="birthDate"
                                            value="" autocomplete="off">
                                        </div>
                                        <div class="input-group no-border input-lg">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">
                                                <i class="fas fa-phone" style="color:#FFFFFF"></i>
                                                </span>
                                            </div>
                                            <select class=" form-check-inline form-control" id="4"
                                                style="height:45px;widtih:200px" name="NewPatSex">
                                                    <?php
                                                        for($i = 0; $i < count($sex); $i++)
                                                        {
                                                            ?>
                                                                <option style="color:#FFF;background-color:rgb(0,0,0,0.8);border-radius:3px;" 
                                                                value="<?php echo $sex[$i]['ID']; ?>">
                                                                <?php echo $sex[$i]['name']; ?></option>
                                                            <?php
                                                        }
                                                    ?>
                                                </select>
                                        </div>
                                        <div class="input-group no-border input-lg">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">
                                                <i class="fas fa-phone" style="color:#FFFFFF"></i>
                                                </span>
                                            </div>
                                            <input type="text" class="form-control" placeholder="Mode de vie" style="color:#FFFFFF" 
                                            pattern="^[0-9]{10,12}$" name="newPatLs" id="5"
                                            value="<?php if(isset($res[0]['phone'])){ if($res[0]['phone'] !== NULL){ echo $res[0]['phone']; } }?>" autocomplete="off">
                                        </div>
                                        <div class="input-group no-border input-lg">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">
                                                <i class="fas fa-phone" style="color:#FFFFFF"></i>
                                                </span>
                                            </div>
                                            <input type="text" class="form-control" placeholder="Alimentation" style="color:#FFFFFF" 
                                             name="newPatFood" id="5"
                                            value="<?php if(isset($res[0]['phone'])){ if($res[0]['phone'] !== NULL){ echo $res[0]['phone']; } }?>" autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="form-row" style="margin-top:5px">
                                        <div class="input-group no-border input-xs" style="width:485px;left:45px" data-toggle="tooltip" data-placement="top" 
                                        title="Nous servira à localiser l'évènement. Veuillez indiquer au minimum la rue et le code postal (ou la ville)">
                                            <div class="input-group-prepend " id="prepit" style=" ">
                                                <span class="input-group-text"   id="CSSit" style="height:45px">
                                                <i class="now-ui-icons location_pin" style="color:#FFFFFF"></i>
                                                </span>
                                            </div>
                                            <input type="text" class=" form-check-inline form-control" placeholder="Mail"  
                                            name="appPlace" min="<?= $todays; ?>"
                                            value="<?php if(isset($flagName)){ echo $flagName; } ?>" style="height:45px;border-top-right-radius:0px;border-bottom-right-radius:0px" 
                                            autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="form-row" style="max-width:470px;margin:auto; ">
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
    <!-- Modal -->
<div class="modal fade" id="appsModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content" style="box-shadow:none;background-color:transparent;margin-top:180px;margin-left:120px;max-width:250px">
      <div class="modal-header" id="answer2" style="background-color:transparent">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
    </div>
  </div>
</div>
    <div class="modal fade modal-primary" id="confModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-login">
        <div class="modal-content" style="background-color:#fff">
        <div class=" card-login">
        

            <div class="header header-primary text-center" style="max-width:150px">
                            <div class="logo-container" id="answer1">
                            </div>
                        </div>
            </div>
            <div class="modal-body" data-background-color>
            <form class="form" method="" action="">
                <div class="card-body">
                    <button type="button" id="eraseDate" onclick="eraseDates(this.value)" class="btn btn-neutral btn-round btn-lg btn-block ml-auto mr-auto" 
                    name="eraseApps">lancer la suppression</button>
                                                </div>
            </form>
            </div>
        </div>
    </div>
    </div>
    </div>
    <script>
    function killApp(id)
    {
        $('#tooltip'+id).tooltip('hide');
        document.getElementById('rdv'+ id).remove();
        date = document.getElementById('dateApp'+ id).textContent;
        date = date.split("-");
        (Number(date[2]< 10)) ? date[2] = "0"+ date[2]: date[2];
        day = Number(date[2]);
        date = date[0] +"-"+date[1]+"-"+  date[2];        
        query = $.post({
            url : 'indexAjax.php',
            data : 
            {
                'eraseApp': id, 
            }
        });
        check = query.done(function(response){
            $('#eraseAppAnswer').html(response);
            if((Number(document.getElementById('apps'+ date).innerHTML)>0)){
                document.getElementById('apps'+ date).innerHTML = (Number(document.getElementById('apps'+ date).innerHTML) -1);
                day = Number(date[2]);
                document.getElementById("alert"+ day).style.backgroundColor = "";      
            }
        });
    }
        
    function eraseDates(date)
    {
        if(Number(document.getElementById('apps'+ date).innerHTML) > 0)
        {
            
            query = $.post({
                url : 'indexAjax.php',
                data : 
                {
                    'eraseDate': date, 
                    'usrID': String(<?php echo $_SESSION['ID']; ?>), 
                }
            });
            check = query.done(function(response){
                //$("#apps"+)
                $('#answer1').html(response);
               
            });
            document.getElementById('past'+ date).style.display = "none";
            document.getElementById('apps'+ date).innerHTML = "0";
        }
    }
    
    var form;
    var cssClass;
    function tableCss()
    {
        if(localStorage.cssClass === "slideOutLeft")
        {
            document.getElementById('calTable').classList.add("slideInRight");
        }
        else
        {
            document.getElementById('calTable').classList.add("slideInLeft");
        }
        document.getElementById('calTable').style.display= "";

    }
    function slidercss(id)
    {
        id = String(id);
        form = id + "Form";
        setTimeout(function submit(form){ document.getElementById(id + 'Form').submit();},300);
        if(id === "prev")
        {

            document.getElementById('calTable').classList.add("slideOutLeft");
            localStorage.setItem('cssClass',"slideOutLeft");
        }
        else
        {
            document.getElementById('calTable').classList.add("slideOutRight");
            localStorage.setItem('cssClass',"slideOutRight");            
        }
    }
$("#addAppForm").submit(function(event){
        event.preventDefault();
        date = document.getElementById('0').value;
        if(document.getElementById('rec1').checked === true)
        {
            query = $.post({
                url : 'indexAjax.php',
                data : 
                {
                    'appName': $('input[name=appName]').val(), 
                    'usrID': String(<?php echo $_SESSION['ID']; ?>), 
                    'appDate': $('input[name=appDate]').val(), 
                    'appCat' : $('select[name=appCat]').val(),
                    'appNotes' : $('textarea[name=appNotes]').val(),
                    'appPlace' : $('input[name=appPlace]').val(),
                    'appHour' : $('input[name=appHour]').val(),
                    'appEnd' : $('input[name=endDate]').val(),
                    'appFreq' : $('input[name=appFreq]').val(),
                    'appRecc' : $('input[name=appRecc]').val(),
                    'timeH' : $('input[name=durationHour]').val(),
                    'timeM' : $('input[name=durationMins]').val(),
                }
            });
        }
        else
        {
            query = $.post({
                url : 'indexAjax.php',
                data : 
                {
                    'appName': $('input[name=appName]').val(), 
                    'usrID': String(<?php echo $_SESSION['ID']; ?>), 
                    'appDate': $('input[name=appDate]').val(), 
                    'appCat' : $('select[name=appCat]').val(),
                    'appNotes' : $('textarea[name=appNotes]').val(),
                    'appPlace' : $('input[name=appPlace]').val(),
                    'appHour' : $('input[name=appHour]').val(),
                    'appRecc' : $('input[name=appRecc]').val(),
                    'timeH' : $('input[name=durationHour]').val(),
                    'timeM' : $('input[name=durationMins]').val(),    
                }
            });
        }
        check = query.done(function(response){
            //$("#apps"+)
            $('#answer').html(response);
           
        });
        setTimeout(function () {countIt(check);},1500);
    });

    function countIt(check)
    {
        if(typeof  check === "object"){
            var regex = /Rdv/;
            var found = document.getElementById('alert').innerText.match(regex);
            if(found != null)
            {
                date = document.getElementById('0').value;
                day = date.split("-");
                day = Number(day[2]);
                lol = document.getElementById('alert');
                document.getElementById('apps'+ date).innerHTML = (Number(document.getElementById('apps'+ date).innerHTML) +1);
                if(Number(document.getElementById('apps'+ date).innerHTML) > 0){
                    document.getElementById('past'+ date).style.display = "";
                    document.getElementById("alert"+ day).style.backgroundColor = "#833ab4";      
                }
            }
        }
    }

    function deleteApps(date,event)
    {   
        date = date.split("-");
        (Number(date[2]< 10)) ? date[2] = "0"+ date[2]: date[2];
        day = Number(date[2]);
        date = date[0] +"-"+date[1]+"-"+  date[2];
        if(Number(document.getElementById('apps'+ date).innerHTML) > 0)
        {
            event.preventDefault();
            $('#confModal').modal('show');
            document.getElementById("eraseDate").value = date;

        }
        document.getElementById("alert"+ day).style.backgroundColor = "rgba(44, 168, 255, 0.8)";
        document.getElementById("past"+ date).style.display = "";
    }
    function getMyApps(date,event){
            event.preventDefault();
            date = document.getElementById('kill'+ date).value;
            date = date.split("-");
            (Number(date[2]< 10)) ? date[2] = "0"+ date[2]: date[2];
            date = date[0] +"-"+date[1]+"-"+  date[2];
            query = $.post({
            url : 'indexAjax.php',
            data : 
            {
                'fetchApps': date, 
                'usrID': String(<?php echo $_SESSION['ID']; ?>), 
            }
            });
            check = query.done(function(response){
                //$("#apps"+)
                $('#appsModal').modal("show");
                $('#answer2').html(response);
            
            });
    }
</script>