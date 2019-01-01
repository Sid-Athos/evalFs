    <body style="background-color:rgba(0,5,5,0.8);margin-top:0px" onload="tableCss();">
        <div class="wrapper">
            <div class="page-header clear-filter">
                <div class="page-header-image" data-parallax="true" style="background-image:url('V/_template/assets/img/header.jpg');"></div>
                
                    <div class="row" style="margin-top:65px">
                        <div class="col-lg-12">
                            <div class="container">
                                <ul class="list-inline" style="height:45px">
                                    <li class="list-inline-item">
                                        <form id="prevForm" method="POST" action="index.php?page=calendar&&ym=<?= $prev; ?>">
                                            <button type="submit" id="prev" onclick="event.preventDefault();slidercss(this.id);" class="btn btn-link">&lt; Mois précèdent</button>
                                        </form>
                                    </li>
                                    <li class="list-inline-item"><div class="container" style="width:400px;height:45px"><span class="title"><?= $title; ?></span><a href="index.php?page=calendar" class="btn btn-link">Mois actuel</a></div></li>
                                    <li class="list-inline-item">
                                        <form id="nextForm" method="POST" action="index.php?page=calendar&&ym=<?= $next; ?>">
                                            <button type="submit" id="next" onclick="event.preventDefault();slidercss(this.id);" class="btn btn-link">Mois suivant &gt;</button>
                                        </form>    
                                    <li class="list-inline-item"></li>
                                </ul>
                            </div>
                        </div>
                    </div>
            
                    <div class="content-center-brand" >
                        
                        <table class="table table-bordered table-dark animated" id="calTable" style="margin:auto;display:none">
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
        query.done(function(response,date){
            //$("#apps"+)
            console.log(document.getElementById("app"+ date));
            $('#answer').html(response);
            console;Log(response);
        });
    });
</script>