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
                            <div class="progress">
                                <div class="indeterminate"></div>
                            </div>
                        </div>
                        <div class="modal-body" data-background-color >
                            <form class="form" method="POST" action="index.php?page=apps" id="addAppForm" autocomplete="false">
                                <div class="modal-header justify-content-center" style="margin-top:-30px;margin-bottom:-30px" >
                                    <h5 class="motto" style="padding:10px">Seuls les champs de date/nom/heure/durée sont obligatoires</h5>
                                </div>
                                <div class="card-body" style="text-align:center">
                                    <div class="form-row" style="margin-top:11px;width:490px;margin-left:39px">
                                        <div class="input-group no-border input-xs" 
                                        style="max-width:230px;width:230px;" data-toggle="tooltip" data-placement="left" 
                                        title="Date de l'évènement">
                                            <div class="input-group-prepend" id="prep">
                                                <span class="input-group-text" style="height:45px;margin-top:11px">
                                                <i class="now-ui-icons ui-1_calendar-60" style="color:#FFFFFF"></i>
                                                </span>
                                            </div>
                                            <input type="date" onchange="newDate(this)" 
                                            class="form-check form-check-inline form-control" placeholder="Date de rendez-vous"  
                                            name="appDate" id="0" min="<?= $todays; ?>"
                                            value="<?php if(isset($flagName)){ echo $flagName; } ?>" 
                                            style="border-top-right-radius:0px;border-bottom-right-radius:0px" 
                                            required autocomplete="off" >
                                        </div>
                                        <div class="input-group no-border input-xs " style="width:260px;" data-toggle="tooltip" 
                                        data-placement="right" title="Nom de l'évènement">
                                            <div class="input-group-prepend " id="prep" style="margin-top:11px">
                                                <span class="input-group-text" style="height:45px">
                                                <i class="now-ui-icons text_align-left" style="color:#FFFFFF"></i>
                                                </span>
                                            </div>
                                            <input type="text" class="form-check form-check-inline form-control" placeholder="Nom de l'évènement"  
                                            name="appName" id="1" min="<?= $todays; ?>" 
                                            value="<?php if(isset($flagName)){ echo $flagName; } ?>" 
                                            style="height:45px;border-top-right-radius:0px;border-bottom-right-radius:0px" 
                                            required autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-check form-check-inline" style="position: relative;left:45px;width:480px">
                                            <div class="input-group no-border input-xs " data-toggle="tooltip" data-placement="right" 
                                            title="Horaire de début">
                                                <div class="input-group-prepend " id="prep" style="margin-top:10px">
                                                    <span class="input-group-text" style="height:46px">
                                                    <i class="now-ui-icons text_align-left" style="color:#FFFFFF"></i>
                                                    </span>
                                                </div>
                                                <input type="number" class="form-check form-check-inline form-control" 
                                                placeholder="Heure de début"  
                                                name="appHour" id="1" min="0" max="23"
                                                value="<?php if(isset($flagName)){ echo $flagName; } ?>" 
                                                style="height:46px;border-top-right-radius:0px;border-bottom-right-radius:0px" 
                                                required autocomplete="off"> 
                                                <span style="position:relative;top:20px;margin-right:10px">H</span>
                                                <div class="input-group-prepend " id="prep" style="margin-top:10px">
                                                    <span class="input-group-text" style="height:46px">
                                                    <i class="now-ui-icons text_align-left" style="color:#FFFFFF"></i>
                                                    </span>
                                                </div>
                                                <input type="number" class="form-check form-check-inline form-control" placeholder="Minutes"  
                                                name="appMins" id="1" min="0" max="55" step="5"
                                                value="<?php if(isset($flagName)){ echo $flagName; } ?>" 
                                                style="height:46px;border-top-right-radius:0px;border-bottom-right-radius:0px" 
                                                required autocomplete="off"> 
                                                <span style="position:relative;top:20px">M</span>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-check form-check-inline" style="position: relative;left:45px;width:480px">
                                                <div class="input-group no-border input-xs " data-toggle="tooltip" data-placement="right" 
                                                title="Durée">
                                                    <div class="input-group-prepend " id="prep" style="margin-top:11px">
                                                        <span class="input-group-text" style="height:46px">
                                                        <i class="now-ui-icons text_align-left" style="color:#FFFFFF"></i>
                                                        </span>
                                                    </div>
                                                    <input type="number" class="form-check form-check-inline form-control" 
                                                    placeholder="Heure de début"  
                                                    name="durationHour" id="1" min="0" max="23"
                                                    value="<?php if(isset($flagName)){ echo $flagName; } ?>" 
                                                    style="height:46px;border-top-right-radius:0px;border-bottom-right-radius:0px" 
                                                    required autocomplete="off"> 
                                                    <span style="position:relative;top:20px;margin-right:10px">H</span>
                                                    <div class="input-group-prepend " id="prep" style="margin-top:11px">
                                                        <span class="input-group-text" style="height:46px">
                                                        <i class="now-ui-icons text_align-left" style="color:#FFFFFF"></i>
                                                        </span>
                                                    </div>
                                                    <input type="number" class="form-check form-check-inline form-control" placeholder="Minutes"  
                                                    name="durationMins" id="1" min="0" max="55" step="5"
                                                    value="<?php if(isset($flagName)){ echo $flagName; } ?>" 
                                                    style="height:46px;border-top-right-radius:0px;border-bottom-right-radius:0px" 
                                                    required autocomplete="off"> 
                                                    <span style="position:relative;top:20px">M</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="input-group no-border input-xs" style="width:485px;left:45px" data-toggle="tooltip" 
                                        data-placement="top" 
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
                                                            <option style="color:#FFF;background-color:rgb(0,0,0,0.8);border-radius:3px;" 
                                                            value="<?php echo $res[$i]['ID']; ?>">
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
                                                <input class="form-check-input" type="radio" name="appRecc" id="rec1" value="1" 
                                                onchange="showIt(this.value);"> 
                                                Évènement récurrent
                                                <span class="form-check-sign"></span>
                                            </label>
                                        </div>
                                        <div class="form-check form-check-radio form-check-inline">
                                            <label class="form-check-label">
                                                <input class="form-check-input" type="radio" name="appRecc" checked id="rec2" value="0" 
                                                onchange="showIt(this.value);"> 
                                                Évènement ponctuel
                                                <span class="form-check-sign"></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="form-row" id="loulilol" style="display:none;margin-top:10px">
                                        <div class="input-group no-border input-xs" style="width:485px;left:45px" data-toggle="tooltip" data-placement="top" 
                                        title="Date de fin de réccurence">
                                            <div class="input-group-prepend " id="prep" style="margin-top:10px">
                                                <span class="input-group-text" style="height:46px">
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
                                                <span class="input-group-text"   id="CSSit" style="height:45px">
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
    <script>
    
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
        console.log(date);
        if(document.getElementById('rec1').checked === true)
        {
            query = $.post({
                url : 'indexAjax.php',
                data : 
                {
                    'appName': $('input[name=appName]').val(), 
                    'appDate': $('input[name=appDate]').val(), 
                    'appCat' : $('select[name=appCat]').val(),
                    'appNotes' : $('textarea[name=appNotes]').val(),
                    'appPlace' : $('input[name=appPlace]').val(),
                    'appHour' : $('input[name=appHour]').val(),
                    'appMins' : $('input[name=appMins]').val(),
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
                    'appDate': $('input[name=appDate]').val(), 
                    'appCat' : $('select[name=appCat]').val(),
                    'appNotes' : $('textarea[name=appNotes]').val(),
                    'appPlace' : $('input[name=appPlace]').val(),
                    'appHour' : $('input[name=appHour]').val(),
                    'appMins' : $('input[name=appMins]').val(),
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
            console.log('obejction');
            var regex = /Rdv/;
            var found = document.getElementById('alert').innerText.match(regex);
            if(found != null)
            {
                date = document.getElementById('0').value;
                console.log(date);
                lol = document.getElementById('alert');
                console.log(lol);
                document.getElementById('apps'+ date).innerHTML = (Number(document.getElementById('apps'+ date).innerHTML) +1);
            }
        }
    }
</script>