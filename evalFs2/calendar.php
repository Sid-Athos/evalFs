<?php 
    // Déjà on vacommencer par un copyright
    session_start();
    $_SESSION['ID'] = 6;
    setlocale(LC_ALL, 'fra');
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
        $date = "$ym-$day";
        if ($today == $date) {
            $week .= '<td class="today" data-toggle="tooltip" data-placement="left" title="Ajd" style="width: 250px;min-width: 250px;max-width:250px">';
        } else {
            $week .= '<td style="width: 250px;min-width: 250px;max-width:250px">';
        }
        $week = "$week
        <div class='row'>
            <div class='col-lg-12'>
                <form method='post' class='form-check-inline'>
                    <button type='submit' class='btn btn-secondary form-check form-check-inline'  name='fetchApps' id='date$day' value='$date'
                    data-toggle='tooltip' data-placement='top' title='Afficher les évènements de la journée'>$day</button>
                    <button type='submit' class='btn btn-secondary form-check form-check-inline' name='addApps' value='$date' 
                    data-toggle='tooltip' data-placement='top' title='Ajouter un évènement'
                    onclick='select($day,event);'>Ajouter un event <i class='now-ui-icons ui-1_simple-add form-check-inline' style='color:#decba4'></i></button>
                </form>
            </div>
        </div>
        <div class='row'>
            <div class='col-lg-12'>
                <div class='alert alert-info ml-auto mr-auto' role='alert' style='z-index:4;
                text-align:center;height:45px;color:#FFFFFF;margin-bottom:-18px'>
                    <div class='alert-icon'>
                    </div>
                    <form method='post' class='form-check-inline'>
                    <button type='submit' class='btn btn-secondary form-check form-check-inline bg-transparent' style='box-sizing:unset;outline:inherit;color:#FFFFFF'  name='fetchApps' id='date$day' value='$date'
                    data-toggle='tooltip' data-placement='left' title='Afficher les évènements de la journée'>
                    3 évènements prévus
                    </button>
                </form>
                    <button type='button' class='close' id='kill$day' data-dismiss='alert' aria-label='Close' style='position:relative;top:-45px;right:-15px;color:#FFFFFF'
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
    setlocale(LC_ALL, 'eng');

?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="utf-8" />
  <link rel="apple-touch-icon" sizes="76x76" href="V/_template/assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="V/_template/assets/img/favicon.png">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>
    Glance - <?php if(isset($page)){ echo $page; }?>
  </title>
  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
  <!-- CSS Files -->
  <link href="V/_template/assets/css/bootstrap.min.css" rel="stylesheet" />
  <link href="V/_template/assets/css/now-ui-kit.css?v=1.2.0" rel="stylesheet" />
  <!-- CSS Just for demo purpose, don't include it in your project -->
  <link href="V/_template/assets/demo/demo.css" rel="stylesheet" />
  <script src="V/_template/assets/js/app.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Jura" rel="stylesheet">
    <script src="V/_template/assets/js/core/jquery.min.js" type="text/javascript"></script>
    <script src="V/_template/assets/js/core/popper.min.js" type="text/javascript"></script>
    <script src="V/_template/assets/js/core/bootstrap.min.js" type="text/javascript"></script>

    <!--  Plugin for Switches, full documentation here: http://www.jque.re/plugins/version3/bootstrap.switch/ -->
    <script src="V/_template/assets/js/plugins/bootstrap-switch.js"></script>

    <!--  Plugin for the Sliders, full documentation here: http://refreshless.com/nouislider/ -->
    <script src="V/_template/assets/js/plugins/nouislider.min.js" type="text/javascript"></script>

    <!--  Plugin for the DatePicker, full documentation here: https://github.com/uxsolutions/bootstrap-datepicker --><script src="V/_template/assets/js/plugins/bootstrap-datepicker.js" type="text/javascript"></script>

    <!--  Google Maps Plugin    -->
    <script  src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>
    
              <link href="V/_template/rotate/css/rotating-card.css" rel="stylesheet" />
              <link href="https://netdna.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css" rel="stylesheet" />
 <script>
        id = <?php echo $_SESSION['ID']; ?>;
        function select(day,event){
            event.preventDefault();
            date = String(document.getElementById('date'+ day).value);
            date = date.split('-');
            $('#kill'+ day).tooltip('hide');
            document.getElementById('0').value = date[0]+"-"+date[1]+"-"+date[2];
            $('#loginModal').modal('show');
            $('#0').val(date[0]+"-"+date[1]+"-"+date[2]);
        }
        </script>
    <!-- Control Center for Now Ui Kit: parallax effects, scripts for the example pages etc -->
    <script src="V/_template/assets/js/now-ui-kit.js?v=1.2.0" type="text/javascript"></script>
    <style>
        .container {
            font-family: 'Jura', sans-serif;
            margin: auto;
            margin-top: 15px;
        }
        .list-inline {
            text-align: center;
            margin-bottom: 30px;
        }
        .title {
            font-size: 26px;
            color:#d7d2cc;
        }
        th {
            text-align: center;
        }
        td {
            height: 100px;
        }
        th:nth-of-type(6), td:nth-of-type(6) {
            color: #decba4;
        }
        th:nth-of-type(7), td:nth-of-type(7) {
            color: #decba4;
        }
        .today {
            background-color: rgb(91,971,151,0.2);
            color:#FFFFFF;
        }
        .title{
            color:#FFFFFF;
        }
        .btn.btn-link{
            color:#FFD194;
        }
        tr{
            width:900px;
        }
        .btn.btn-secondary{
            position:relative;
            margin-top:-30px;
            left:0;
            outline:none; 
            border:none;
            background:none;
            height:35px;
            color:#abbaab;
            text-decoration:none;
            
        }
        .btn.btn-secondary:hover{
            position:relative;
            margin-top:-30px;
            left:0;
            outline:none; 
            border:none;
            background:none;
            height:35px;
            color:#abbaab;
            text-decoration:none;
        }
        .btn.btn-secondary:active{
            position:relative;
            margin-top:-30px;
            left:0;
            outline:none; 
            border:none;
            background-color:transparent;
            height:35px;
            color:#abbaab;
            text-decoration:none;
            
        }
        .btn.btn-secondary:focu{
            position:relative;
            margin-top:-30px;
            left:0;
            outline:none; 
            border:none;
            background-color:transparent;
            height:35px;
            color:#abbaab;
            text-decoration:none;
            
        }
        .col-lg-12{
            padding-right:5px;
            padding-left:5px;
        }
        .alert.alert-danger{
            background-color:rgba(255,54,54,.3);
        }
        
        .input-group-text{
            height:38px;
        }
       
        table{
            display:block;
            width:900px;
        }
        table tr{
            display:block;
            width:900px;
        }
        td, th{
            
            width:900px;
        }
        .table.table-bordered.table-dark{
            display:block;
            width:1750px;
            max-width:1750px;
        }
        .card-container{
            width:250px;
        }
        a {

color: #ce943b;

}
a:hover {

color: #ce943b;

}
a:focus {

color: #ce943b;

}
a:active {

color: #ce943b;

}
    </style>
</head>
<body style="background-color:#333333">
<div class="wrapper ml-auto"  style="margin-bottom:200px;padding-left:30px">
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
                 <div class="header" style="border-top-left-radius:5px;border-top-right-radius:5px">
                     <h5 class="motto">"To be or not to be, this is my awesome motto!"</h5>
                 </div>
                 <div class="header">
                     <h5 class="motto">"To be or not to be, this is my awesome motto!"</h5>
                 </div>
                 <div class="header">
                     <h5 class="motto">"To be or not to be, this is my awesome motto!"</h5>
                 </div>
                 <div class="header">
                     <h5 class="motto">"To be or not to be, this is my awesome motto!"</h5>
                 </div>
                 <div class="content">
                     <div class="main" style="background-color:#212529;color:#FFFFFF">
                         <h4 class="text-center">Job Description</h4>
                         <p class="text-center">Web design, Adobe Photoshop, HTML5, CSS3, Corel and many others...</p>
                     </div>
                     <a href="https://creative-tim.com" class="facebook"><i class="fa fa-facebook fa-fw"></i></a>
                     <a href="https://creative-tim.com" class="google"><i class="fa fa-google-plus fa-fw"></i></a>
                     <a href="https://creative-tim.com" class="twitter"><i class="fa fa-twitter fa-fw"></i></a>
                 </div>
                 
                     
             </div> <!-- end back panel -->
         </div> <!-- end card -->
     </div> <!-- end card-container -->
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
                 <div class="header" style="border-top-left-radius:5px;border-top-right-radius:5px">
                     <h5 class="motto">"To be or not to be, this is my awesome motto!"</h5>
                 </div>
                 <div class="header">
                     <h5 class="motto">"To be or not to be, this is my awesome motto!"</h5>
                 </div>
                 <div class="header">
                     <h5 class="motto">"To be or not to be, this is my awesome motto!"</h5>
                 </div>
                 <div class="header">
                     <h5 class="motto">"To be or not to be, this is my awesome motto!"</h5>
                 </div>
                 <div class="content">
                     <div class="main" style="background-color:#212529;color:#FFFFFF">
                         <h4 class="text-center">Job Description</h4>
                         <p class="text-center">Web design, Adobe Photoshop, HTML5, CSS3, Corel and many others...</p>
                     </div>
                 </div>
                 <div class="footer">
                     <div class="social-links text-center">
                         <a href="https://creative-tim.com" class="facebook"><i class="fa fa-facebook fa-fw"></i></a>
                         <a href="https://creative-tim.com" class="google"><i class="fa fa-google-plus fa-fw"></i></a>
                         <a href="https://creative-tim.com" class="twitter"><i class="fa fa-twitter fa-fw"></i></a>
                     </div>
                 </div>
             </div> <!-- end back panel -->
         </div> <!-- end card -->
     </div> <!-- end card-container -->
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
                 <div class="header" style="border-top-left-radius:5px;border-top-right-radius:5px">
                     <h5 class="motto">"To be or not to be, this is my awesome motto!"</h5>
                 </div>
                 <div class="header">
                     <h5 class="motto">"To be or not to be, this is my awesome motto!"</h5>
                 </div>
                 <div class="header">
                     <h5 class="motto">"To be or not to be, this is my awesome motto!"</h5>
                 </div>
                 <div class="header">
                     <h5 class="motto">"To be or not to be, this is my awesome motto!"</h5>
                 </div>
                 <div class="content">
                     <div class="main" style="background-color:#212529;color:#FFFFFF">
                         <h4 class="text-center">Job Description</h4>
                         <p class="text-center">Web design, Adobe Photoshop, HTML5, CSS3, Corel and many others...</p>
                     </div>
                 </div>
                 <div class="footer">
                     <div class="social-links text-center">
                         <a href="https://creative-tim.com" class="facebook"><i class="fa fa-facebook fa-fw"></i></a>
                         <a href="https://creative-tim.com" class="google"><i class="fa fa-google-plus fa-fw"></i></a>
                         <a href="https://creative-tim.com" class="twitter"><i class="fa fa-twitter fa-fw"></i></a>
                     </div>
                 </div>
             </div> <!-- end back panel -->
         </div> <!-- end card -->
     </div> <!-- end card-container -->
     
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
                 <div id="accordion" role="tablist" aria-multiselectable="true" class="card-collapse" style="-moz-transform: scale(-1, 1);
-webkit-transform: scale(-1, 1);
-o-transform: scale(-1, 1);
-ms-transform: scale(-1, 1);
transform: scale(-1, 1);background:transparent">
  <div class="card card-plain" style="background:transparent">
    <div class="card-header" role="tab" id="headingOne">
        <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
          Collapsible Group Item #1

      <i class="now-ui-icons arrows-1_minimal-down"></i>
        </a>
    </div>

    <div id="collapseOne" class="collapse hide" role="tabpanel" aria-labelledby="headingOne">
      <div class="card-body" style="background:transparent;color:rgb(255,255,255,0.7)">
        Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
      </div>
    </div>
  </div>
  <div class="card card-plain" style="background:transparent">
    <div class="card-header" role="tab" id="headingTwo">
    <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
        Collapsible Group Item #2

        <i class="now-ui-icons arrows-1_minimal-down"></i>
        </a>
    </div>
    <div id="collapseTwo" class="collapse" role="tabpanel" aria-labelledby="headingTwo">
      <div class="card-body" style="background:transparent;color:rgb(255,255,255,0.7)">
        Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
      </div>
    </div>
  </div>
  <div class="card card-plain" style="background:transparent">
    <div class="card-header" role="tab" id="headingThree">
    <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree" style="background:transparent">
      Collapsible Group Item #3

      <i class="now-ui-icons arrows-1_minimal-down"></i>
      </a>
    </div>
    <div id="collapseThree" class="collapse" role="tabpanel" aria-labelledby="headingThree" style="background:transparent">
      <div class="card-body" style="background:transparent;color:rgb(255,255,255,0.7)">
        Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
      </div>
    </div>
  </div>
</div>
                     <h5 class="motto"></h5>
                 </div>
                 <div class="header">
                     <h5 class="motto">"To be or not to be, this is my awesome motto!"</h5>
                 </div>
                 <div class="header">
                     <h5 class="motto">"To be or not to be, this is my awesome motto!"</h5>
                 </div>
                 <div class="header">
                     <h5 class="motto">"To be or not to be, this is my awesome motto!"</h5>
                 </div>
                 <div class="content">
                     <div class="main" style="background-color:#212529;color:#FFFFFF">
                         <h4 class="text-center">Job Description</h4>
                         <p class="text-center">Web design, Adobe Photoshop, HTML5, CSS3, Corel and many others...</p>
                     </div>
                 </div>
                 <div class="footer">
                     <div class="social-links text-center">
                         <a href="https://creative-tim.com" class="facebook"><i class="fa fa-facebook fa-fw"></i></a>
                         <a href="https://creative-tim.com" class="google"><i class="fa fa-google-plus fa-fw"></i></a>
                         <a href="https://creative-tim.com" class="twitter"><i class="fa fa-twitter fa-fw"></i></a>
                     </div>
                 </div>
             </div> <!-- end back panel -->
         </div> <!-- end card -->
     </div> <!-- end card-container -->
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
                 <div class="header" style="border-top-left-radius:5px;border-top-right-radius:5px">
                     <h5 class="motto">"To be or not to be, this is my awesome motto!"</h5>
                 </div>
                 <div class="header">
                     <h5 class="motto">"To be or not to be, this is my awesome motto!"</h5>
                 </div>
                 <div class="header">
                     <h5 class="motto">"To be or not to be, this is my awesome motto!"</h5>
                 </div>
                 <div class="header">
                     <h5 class="motto">"To be or not to be, this is my awesome motto!"</h5>
                 </div>
                 <div class="content">
                     <div class="main" style="background-color:#212529;color:#FFFFFF">
                         <h4 class="text-center">Job Description</h4>
                         <p class="text-center">Web design, Adobe Photoshop, HTML5, CSS3, Corel and many others...</p>
                     </div>
                 </div>
                 <div class="footer">
                     <div class="social-links text-center">
                         <a href="https://creative-tim.com" class="facebook"><i class="fa fa-facebook fa-fw"></i></a>
                         <a href="https://creative-tim.com" class="google"><i class="fa fa-google-plus fa-fw"></i></a>
                         <a href="https://creative-tim.com" class="twitter"><i class="fa fa-twitter fa-fw"></i></a>
                     </div>
                 </div>
             </div> <!-- end back panel -->
         </div> <!-- end card -->
     </div> <!-- end card-container -->
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
                 <div class="header" style="border-top-left-radius:5px;border-top-right-radius:5px">
                     <h5 class="motto">"To be or not to be, this is my awesome motto!"</h5>
                 </div>
                 <div class="header">
                     <h5 class="motto">"To be or not to be, this is my awesome motto!"</h5>
                 </div>
                 <div class="header">
                     <h5 class="motto">"To be or not to be, this is my awesome motto!"</h5>
                 </div>
                 <div class="header">
                     <h5 class="motto">"To be or not to be, this is my awesome motto!"</h5>
                 </div>
                 <div class="content">
                     <div class="main" style="background-color:#212529;color:#FFFFFF">
                         <h4 class="text-center">Job Description</h4>
                         <p class="text-center">Web design, Adobe Photoshop, HTML5, CSS3, Corel and many others...</p>
                     </div>
                 </div>
                 <div class="footer">
                     <div class="social-links text-center">
                         <a href="https://creative-tim.com" class="facebook"><i class="fa fa-facebook fa-fw"></i></a>
                         <a href="https://creative-tim.com" class="google"><i class="fa fa-google-plus fa-fw"></i></a>
                         <a href="https://creative-tim.com" class="twitter"><i class="fa fa-twitter fa-fw"></i></a>
                     </div>
                 </div>
             </div> <!-- end back panel -->
         </div> <!-- end card -->
     </div> <!-- end card-container -->
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
                 <div class="header" style="border-top-left-radius:5px;border-top-right-radius:5px">
                     <h5 class="motto">"To be or not to be, this is my awesome motto!"</h5>
                 </div>
                 <div class="header">
                     <h5 class="motto">"To be or not to be, this is my awesome motto!"</h5>
                 </div>
                 <div class="header">
                     <h5 class="motto">"To be or not to be, this is my awesome motto!"</h5>
                 </div>
                 <div class="header">
                     <h5 class="motto">"To be or not to be, this is my awesome motto!"</h5>
                 </div>
                 <div class="content">
                     <div class="main" style="background-color:#212529;color:#FFFFFF">
                         <h4 class="text-center">Job Description</h4>
                         <p class="text-center">Web design, Adobe Photoshop, HTML5, CSS3, Corel and many others...</p>
                     </div>
                 </div>
                 <div class="footer">
                     <div class="social-links text-center">
                         <a href="https://creative-tim.com" class="facebook"><i class="fa fa-facebook fa-fw"></i></a>
                         <a href="https://creative-tim.com" class="google"><i class="fa fa-google-plus fa-fw"></i></a>
                         <a href="https://creative-tim.com" class="twitter"><i class="fa fa-twitter fa-fw"></i></a>
                     </div>
                 </div>
             </div> <!-- end back panel -->
         </div> <!-- end card -->
     </div> <!-- end card-container -->
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
                 <div class="header" style="border-top-left-radius:5px;border-top-right-radius:5px">
                     <h5 class="motto">"To be or not to be, this is my awesome motto!"</h5>
                 </div>
                 <div class="header">
                     <h5 class="motto">"To be or not to be, this is my awesome motto!"</h5>
                 </div>
                 <div class="header">
                     <h5 class="motto">"To be or not to be, this is my awesome motto!"</h5>
                 </div>
                 <div class="header">
                     <h5 class="motto">"To be or not to be, this is my awesome motto!"</h5>
                 </div>
                 <div class="content">
                     <div class="main" style="background-color:#212529;color:#FFFFFF">
                         <h4 class="text-center">Job Description</h4>
                         <p class="text-center">Web design, Adobe Photoshop, HTML5, CSS3, Corel and many others...</p>
                     </div>
                 </div>
                 <div class="footer">
                     <div class="social-links text-center">
                         <a href="https://creative-tim.com" class="facebook"><i class="fa fa-facebook fa-fw"></i></a>
                         <a href="https://creative-tim.com" class="google"><i class="fa fa-google-plus fa-fw"></i></a>
                         <a href="https://creative-tim.com" class="twitter"><i class="fa fa-twitter fa-fw"></i></a>
                     </div>
                 </div>
             </div> <!-- end back panel -->
         </div> <!-- end card -->
     </div> <!-- end card-container -->
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
                 <div class="header" style="border-top-left-radius:5px;border-top-right-radius:5px">
                     <h5 class="motto">"To be or not to be, this is my awesome motto!"</h5>
                 </div>
                 <div class="header">
                     <h5 class="motto">"To be or not to be, this is my awesome motto!"</h5>
                 </div>
                 <div class="header">
                     <h5 class="motto">"To be or not to be, this is my awesome motto!"</h5>
                 </div>
                 <div class="header">
                     <h5 class="motto">"To be or not to be, this is my awesome motto!"</h5>
                 </div>
                 <div class="content">
                     <div class="main" style="background-color:#212529;color:#FFFFFF">
                         <h4 class="text-center">Job Description</h4>
                         <p class="text-center">Web design, Adobe Photoshop, HTML5, CSS3, Corel and many others...</p>
                     </div>
                 </div>
                 <div class="footer">
                     <div class="social-links text-center">
                         <a href="https://creative-tim.com" class="facebook"><i class="fa fa-facebook fa-fw"></i></a>
                         <a href="https://creative-tim.com" class="google"><i class="fa fa-google-plus fa-fw"></i></a>
                         <a href="https://creative-tim.com" class="twitter"><i class="fa fa-twitter fa-fw"></i></a>
                     </div>
                 </div>
             </div> <!-- end back panel -->
         </div> <!-- end card -->
     </div> <!-- end card-container -->
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
                 <div class="header" style="border-top-left-radius:5px;border-top-right-radius:5px">
                     <h5 class="motto">"To be or not to be, this is my awesome motto!"</h5>
                 </div>
                 <div class="header">
                     <h5 class="motto">"To be or not to be, this is my awesome motto!"</h5>
                 </div>
                 <div class="header">
                     <h5 class="motto">"To be or not to be, this is my awesome motto!"</h5>
                 </div>
                 <div class="header">
                     <h5 class="motto">"To be or not to be, this is my awesome motto!"</h5>
                 </div>
                 <div class="content">
                     <div class="main" style="background-color:#212529;color:#FFFFFF">
                         <h4 class="text-center">Job Description</h4>
                         <p class="text-center">Web design, Adobe Photoshop, HTML5, CSS3, Corel and many others...</p>
                     </div>
                 </div>
                 <div class="footer">
                     <div class="social-links text-center">
                         <a href="https://creative-tim.com" class="facebook"><i class="fa fa-facebook fa-fw"></i></a>
                         <a href="https://creative-tim.com" class="google"><i class="fa fa-google-plus fa-fw"></i></a>
                         <a href="https://creative-tim.com" class="twitter"><i class="fa fa-twitter fa-fw"></i></a>
                     </div>
                 </div>
             </div> <!-- end back panel -->
         </div> <!-- end card -->
     </div> <!-- end card-container -->
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
                 <div class="header" style="border-top-left-radius:5px;border-top-right-radius:5px">
                     <h5 class="motto">"To be or not to be, this is my awesome motto!"</h5>
                 </div>
                 <div class="header">
                     <h5 class="motto">"To be or not to be, this is my awesome motto!"</h5>
                 </div>
                 <div class="header">
                     <h5 class="motto">"To be or not to be, this is my awesome motto!"</h5>
                 </div>
                 <div class="header">
                     <h5 class="motto">"To be or not to be, this is my awesome motto!"</h5>
                 </div>
                 <div class="content">
                     <div class="main" style="background-color:#212529;color:#FFFFFF">
                         <h4 class="text-center">Job Description</h4>
                         <p class="text-center">Web design, Adobe Photoshop, HTML5, CSS3, Corel and many others...</p>
                     </div>
                 </div>
                 <div class="footer">
                     <div class="social-links text-center">
                         <a href="https://creative-tim.com" class="facebook"><i class="fa fa-facebook fa-fw"></i></a>
                         <a href="https://creative-tim.com" class="google"><i class="fa fa-google-plus fa-fw"></i></a>
                         <a href="https://creative-tim.com" class="twitter"><i class="fa fa-twitter fa-fw"></i></a>
                     </div>
                 </div>
             </div> <!-- end back panel -->
         </div> <!-- end card -->
     </div> <!-- end card-container -->
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
                 <div class="header" style="border-top-left-radius:5px;border-top-right-radius:5px">
                     <h5 class="motto">"To be or not to be, this is my awesome motto!"</h5>
                 </div>
                 <div class="header">
                     <h5 class="motto">"To be or not to be, this is my awesome motto!"</h5>
                 </div>
                 <div class="header">
                     <h5 class="motto">"To be or not to be, this is my awesome motto!"</h5>
                 </div>
                 <div class="header">
                     <h5 class="motto">"To be or not to be, this is my awesome motto!"</h5>
                 </div>
                 <div class="content">
                     <div class="main" style="background-color:#212529;color:#FFFFFF">
                         <h4 class="text-center">Job Description</h4>
                         <p class="text-center">Web design, Adobe Photoshop, HTML5, CSS3, Corel and many others...</p>
                     </div>
                 </div>
                 <div class="footer">
                     <div class="social-links text-center">
                         <a href="https://creative-tim.com" class="facebook"><i class="fa fa-facebook fa-fw"></i></a>
                         <a href="https://creative-tim.com" class="google"><i class="fa fa-google-plus fa-fw"></i></a>
                         <a href="https://creative-tim.com" class="twitter"><i class="fa fa-twitter fa-fw"></i></a>
                     </div>
                 </div>
             </div> <!-- end back panel -->
         </div> <!-- end card -->
     </div> <!-- end card-container -->
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
                 <div class="header" style="border-top-left-radius:5px;border-top-right-radius:5px">
                     <h5 class="motto">"To be or not to be, this is my awesome motto!"</h5>
                 </div>
                 <div class="header">
                     <h5 class="motto">"To be or not to be, this is my awesome motto!"</h5>
                 </div>
                 <div class="header">
                     <h5 class="motto">"To be or not to be, this is my awesome motto!"</h5>
                 </div>
                 <div class="header">
                     <h5 class="motto">"To be or not to be, this is my awesome motto!"</h5>
                 </div>
                 <div class="content">
                     <div class="main" style="background-color:#212529;color:#FFFFFF">
                         <h4 class="text-center">Job Description</h4>
                         <p class="text-center">Web design, Adobe Photoshop, HTML5, CSS3, Corel and many others...</p>
                     </div>
                 </div>
                 <div class="footer">
                     <div class="social-links text-center">
                         <a href="https://creative-tim.com" class="facebook"><i class="fa fa-facebook fa-fw"></i></a>
                         <a href="https://creative-tim.com" class="google"><i class="fa fa-google-plus fa-fw"></i></a>
                         <a href="https://creative-tim.com" class="twitter"><i class="fa fa-twitter fa-fw"></i></a>
                     </div>
                 </div>
             </div> <!-- end back panel -->
         </div> <!-- end card -->
     </div> <!-- end card-container -->
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
                 <div class="header" style="border-top-left-radius:5px;border-top-right-radius:5px">
                     <h5 class="motto">"To be or not to be, this is my awesome motto!"</h5>
                 </div>
                 <div class="header">
                     <h5 class="motto">"To be or not to be, this is my awesome motto!"</h5>
                 </div>
                 <div class="header">
                     <h5 class="motto">"To be or not to be, this is my awesome motto!"</h5>
                 </div>
                 <div class="header">
                     <h5 class="motto">"To be or not to be, this is my awesome motto!"</h5>
                 </div>
                 <div class="content">
                     <div class="main" style="background-color:#212529;color:#FFFFFF">
                         <h4 class="text-center">Job Description</h4>
                         <p class="text-center">Web design, Adobe Photoshop, HTML5, CSS3, Corel and many others...</p>
                     </div>
                 </div>
                 <div class="footer">
                     <div class="social-links text-center">
                         <a href="https://creative-tim.com" class="facebook"><i class="fa fa-facebook fa-fw"></i></a>
                         <a href="https://creative-tim.com" class="google"><i class="fa fa-google-plus fa-fw"></i></a>
                         <a href="https://creative-tim.com" class="twitter"><i class="fa fa-twitter fa-fw"></i></a>
                     </div>
                 </div>
             </div> <!-- end back panel -->
         </div> <!-- end card -->
     </div> <!-- end card-container -->
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
                 <div class="header" style="border-top-left-radius:5px;border-top-right-radius:5px">
                     <h5 class="motto">"To be or not to be, this is my awesome motto!"</h5>
                 </div>
                 <div class="header">
                     <h5 class="motto">"To be or not to be, this is my awesome motto!"</h5>
                 </div>
                 <div class="header">
                     <h5 class="motto">"To be or not to be, this is my awesome motto!"</h5>
                 </div>
                 <div class="header">
                     <h5 class="motto">"To be or not to be, this is my awesome motto!"</h5>
                 </div>
                 <div class="content">
                     <div class="main" style="background-color:#212529;color:#FFFFFF">
                         <h4 class="text-center">Job Description</h4>
                         <p class="text-center">Web design, Adobe Photoshop, HTML5, CSS3, Corel and many others...</p>
                     </div>
                 </div>
                 <div class="footer">
                     <div class="social-links text-center">
                         <a href="https://creative-tim.com" class="facebook"><i class="fa fa-facebook fa-fw"></i></a>
                         <a href="https://creative-tim.com" class="google"><i class="fa fa-google-plus fa-fw"></i></a>
                         <a href="https://creative-tim.com" class="twitter"><i class="fa fa-twitter fa-fw"></i></a>
                     </div>
                 </div>
             </div> <!-- end back panel -->
         </div> <!-- end card -->
     </div> <!-- end card-container -->
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
                 <div class="header" style="border-top-left-radius:5px;border-top-right-radius:5px">
                     <h5 class="motto">"To be or not to be, this is my awesome motto!"</h5>
                 </div>
                 <div class="header">
                     <h5 class="motto">"To be or not to be, this is my awesome motto!"</h5>
                 </div>
                 <div class="header">
                     <h5 class="motto">"To be or not to be, this is my awesome motto!"</h5>
                 </div>
                 <div class="header">
                     <h5 class="motto">"To be or not to be, this is my awesome motto!"</h5>
                 </div>
                 <div class="content">
                     <div class="main" style="background-color:#212529;color:#FFFFFF">
                         <h4 class="text-center">Job Description</h4>
                         <p class="text-center">Web design, Adobe Photoshop, HTML5, CSS3, Corel and many others...</p>
                     </div>
                 </div>
                 <div class="footer">
                     <div class="social-links text-center">
                         <a href="https://creative-tim.com" class="facebook"><i class="fa fa-facebook fa-fw"></i></a>
                         <a href="https://creative-tim.com" class="google"><i class="fa fa-google-plus fa-fw"></i></a>
                         <a href="https://creative-tim.com" class="twitter"><i class="fa fa-twitter fa-fw"></i></a>
                     </div>
                 </div>
             </div> <!-- end back panel -->
         </div> <!-- end card -->
     </div> <!-- end card-container -->
     
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
                 <div class="header" style="border-top-left-radius:5px;border-top-right-radius:5px">
                     <h5 class="motto">"To be or not to be, this is my awesome motto!"</h5>
                 </div>
                 <div class="header">
                     <h5 class="motto">"To be or not to be, this is my awesome motto!"</h5>
                 </div>
                 <div class="header">
                     <h5 class="motto">"To be or not to be, this is my awesome motto!"</h5>
                 </div>
                 <div class="header">
                     <h5 class="motto">"To be or not to be, this is my awesome motto!"</h5>
                 </div>
                 <div class="content">
                     <div class="main" style="background-color:#212529;color:#FFFFFF">
                         <h4 class="text-center">Job Description</h4>
                         <p class="text-center">Web design, Adobe Photoshop, HTML5, CSS3, Corel and many others...</p>
                     </div>
                 </div>
                 <div class="footer">
                     <div class="social-links text-center">
                         <a href="https://creative-tim.com" class="facebook"><i class="fa fa-facebook fa-fw"></i></a>
                         <a href="https://creative-tim.com" class="google"><i class="fa fa-google-plus fa-fw"></i></a>
                         <a href="https://creative-tim.com" class="twitter"><i class="fa fa-twitter fa-fw"></i></a>
                     </div>
                 </div>
             </div> <!-- end back panel -->
         </div> <!-- end card -->
     </div> <!-- end card-container -->
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
                 <div class="header" style="border-top-left-radius:5px;border-top-right-radius:5px">
                     <h5 class="motto">"To be or not to be, this is my awesome motto!"</h5>
                 </div>
                 <div class="header">
                     <h5 class="motto">"To be or not to be, this is my awesome motto!"</h5>
                 </div>
                 <div class="header">
                     <h5 class="motto">"To be or not to be, this is my awesome motto!"</h5>
                 </div>
                 <div class="header">
                     <h5 class="motto">"To be or not to be, this is my awesome motto!"</h5>
                 </div>
                 <div class="content">
                     <div class="main" style="background-color:#212529;color:#FFFFFF">
                         <h4 class="text-center">Job Description</h4>
                         <p class="text-center">Web design, Adobe Photoshop, HTML5, CSS3, Corel and many others...</p>
                     </div>
                 </div>
                 <div class="footer">
                     <div class="social-links text-center">
                         <a href="https://creative-tim.com" class="facebook"><i class="fa fa-facebook fa-fw"></i></a>
                         <a href="https://creative-tim.com" class="google"><i class="fa fa-google-plus fa-fw"></i></a>
                         <a href="https://creative-tim.com" class="twitter"><i class="fa fa-twitter fa-fw"></i></a>
                     </div>
                 </div>
             </div> <!-- end back panel -->
         </div> <!-- end card -->
     </div> <!-- end card-container -->
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
                 <div class="header" style="border-top-left-radius:5px;border-top-right-radius:5px">
                     <h5 class="motto">"To be or not to be, this is my awesome motto!"</h5>
                 </div>
                 <div class="header">
                     <h5 class="motto">"To be or not to be, this is my awesome motto!"</h5>
                 </div>
                 <div class="header">
                     <h5 class="motto">"To be or not to be, this is my awesome motto!"</h5>
                 </div>
                 <div class="header">
                     <h5 class="motto">"To be or not to be, this is my awesome motto!"</h5>
                 </div>
                 <div class="content">
                     <div class="main" style="background-color:#212529;color:#FFFFFF">
                         <h4 class="text-center">Job Description</h4>
                         <p class="text-center">Web design, Adobe Photoshop, HTML5, CSS3, Corel and many others...</p>
                     </div>
                 </div>
                 <div class="footer">
                     <div class="social-links text-center">
                         <a href="https://creative-tim.com" class="facebook"><i class="fa fa-facebook fa-fw"></i></a>
                         <a href="https://creative-tim.com" class="google"><i class="fa fa-google-plus fa-fw"></i></a>
                         <a href="https://creative-tim.com" class="twitter"><i class="fa fa-twitter fa-fw"></i></a>
                     </div>
                 </div>
             </div> <!-- end back panel -->
         </div> <!-- end card -->
     </div> <!-- end card-container -->
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
                 <div class="header" style="border-top-left-radius:5px;border-top-right-radius:5px">
                     <h5 class="motto">"To be or not to be, this is my awesome motto!"</h5>
                 </div>
                 <div class="header">
                     <h5 class="motto">"To be or not to be, this is my awesome motto!"</h5>
                 </div>
                 <div class="header">
                     <h5 class="motto">"To be or not to be, this is my awesome motto!"</h5>
                 </div>
                 <div class="header">
                     <h5 class="motto">"To be or not to be, this is my awesome motto!"</h5>
                 </div>
                 <div class="content">
                     <div class="main" style="background-color:#212529;color:#FFFFFF">
                         <h4 class="text-center">Job Description</h4>
                         <p class="text-center">Web design, Adobe Photoshop, HTML5, CSS3, Corel and many others...</p>
                     </div>
                 </div>
                 <div class="footer">
                     <div class="social-links text-center">
                         <a href="https://creative-tim.com" class="facebook"><i class="fa fa-facebook fa-fw"></i></a>
                         <a href="https://creative-tim.com" class="google"><i class="fa fa-google-plus fa-fw"></i></a>
                         <a href="https://creative-tim.com" class="twitter"><i class="fa fa-twitter fa-fw"></i></a>
                     </div>
                 </div>
             </div> <!-- end back panel -->
         </div> <!-- end card -->
     </div> <!-- end card-container -->
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
                 <div class="header" style="border-top-left-radius:5px;border-top-right-radius:5px">
                     <h5 class="motto">"To be or not to be, this is my awesome motto!"</h5>
                 </div>
                 <div class="header">
                     <h5 class="motto">"To be or not to be, this is my awesome motto!"</h5>
                 </div>
                 <div class="header">
                     <h5 class="motto">"To be or not to be, this is my awesome motto!"</h5>
                 </div>
                 <div class="header">
                     <h5 class="motto">"To be or not to be, this is my awesome motto!"</h5>
                 </div>
                 <div class="content">
                     <div class="main" style="background-color:#212529;color:#FFFFFF">
                         <h4 class="text-center">Job Description</h4>
                         <p class="text-center">Web design, Adobe Photoshop, HTML5, CSS3, Corel and many others...</p>
                     </div>
                 </div>
                 <div class="footer">
                     <div class="social-links text-center">
                         <a href="https://creative-tim.com" class="facebook"><i class="fa fa-facebook fa-fw"></i></a>
                         <a href="https://creative-tim.com" class="google"><i class="fa fa-google-plus fa-fw"></i></a>
                         <a href="https://creative-tim.com" class="twitter"><i class="fa fa-twitter fa-fw"></i></a>
                     </div>
                 </div>
             </div> <!-- end back panel -->
         </div> <!-- end card -->
     </div> <!-- end card-container -->
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
                 <div class="header" style="border-top-left-radius:5px;border-top-right-radius:5px">
                     <h5 class="motto">"To be or not to be, this is my awesome motto!"</h5>
                 </div>
                 <div class="header">
                     <h5 class="motto">"To be or not to be, this is my awesome motto!"</h5>
                 </div>
                 <div class="header">
                     <h5 class="motto">"To be or not to be, this is my awesome motto!"</h5>
                 </div>
                 <div class="header">
                     <h5 class="motto">"To be or not to be, this is my awesome motto!"</h5>
                 </div>
                 <div class="content">
                     <div class="main" style="background-color:#212529;color:#FFFFFF">
                         <h4 class="text-center">Job Description</h4>
                         <p class="text-center">Web design, Adobe Photoshop, HTML5, CSS3, Corel and many others...</p>
                     </div>
                 </div>
                 <div class="footer">
                     <div class="social-links text-center">
                         <a href="https://creative-tim.com" class="facebook"><i class="fa fa-facebook fa-fw"></i></a>
                         <a href="https://creative-tim.com" class="google"><i class="fa fa-google-plus fa-fw"></i></a>
                         <a href="https://creative-tim.com" class="twitter"><i class="fa fa-twitter fa-fw"></i></a>
                     </div>
                 </div>
             </div> <!-- end back panel -->
         </div> <!-- end card -->
     </div> <!-- end card-container -->
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
                 <div class="header" style="border-top-left-radius:5px;border-top-right-radius:5px">
                     <h5 class="motto">"To be or not to be, this is my awesome motto!"</h5>
                 </div>
                 <div class="header">
                     <h5 class="motto">"To be or not to be, this is my awesome motto!"</h5>
                 </div>
                 <div class="header">
                     <h5 class="motto">"To be or not to be, this is my awesome motto!"</h5>
                 </div>
                 <div class="header">
                     <h5 class="motto">"To be or not to be, this is my awesome motto!"</h5>
                 </div>
                 <div class="content">
                     <div class="main" style="background-color:#212529;color:#FFFFFF">
                         <h4 class="text-center">Job Description</h4>
                         <p class="text-center">Web design, Adobe Photoshop, HTML5, CSS3, Corel and many others...</p>
                     </div>
                 </div>
                 <div class="footer">
                     <div class="social-links text-center">
                         <a href="https://creative-tim.com" class="facebook"><i class="fa fa-facebook fa-fw"></i></a>
                         <a href="https://creative-tim.com" class="google"><i class="fa fa-google-plus fa-fw"></i></a>
                         <a href="https://creative-tim.com" class="twitter"><i class="fa fa-twitter fa-fw"></i></a>
                     </div>
                 </div>
             </div> <!-- end back panel -->
         </div> <!-- end card -->
     </div> <!-- end card-container -->
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
                 <div class="header" style="border-top-left-radius:5px;border-top-right-radius:5px">
                     <h5 class="motto">"To be or not to be, this is my awesome motto!"</h5>
                 </div>
                 <div class="header">
                     <h5 class="motto">"To be or not to be, this is my awesome motto!"</h5>
                 </div>
                 <div class="header">
                     <h5 class="motto">"To be or not to be, this is my awesome motto!"</h5>
                 </div>
                 <div class="header">
                     <h5 class="motto">"To be or not to be, this is my awesome motto!"</h5>
                 </div>
                 <div class="content">
                     <div class="main" style="background-color:#212529;color:#FFFFFF">
                         <h4 class="text-center">Job Description</h4>
                         <p class="text-center">Web design, Adobe Photoshop, HTML5, CSS3, Corel and many others...</p>
                     </div>
                 </div>
                 <div class="footer">
                     <div class="social-links text-center">
                         <a href="https://creative-tim.com" class="facebook"><i class="fa fa-facebook fa-fw"></i></a>
                         <a href="https://creative-tim.com" class="google"><i class="fa fa-google-plus fa-fw"></i></a>
                         <a href="https://creative-tim.com" class="twitter"><i class="fa fa-twitter fa-fw"></i></a>
                     </div>
                 </div>
             </div> <!-- end back panel -->
         </div> <!-- end card -->
     </div> <!-- end card-container -->
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
                 <div class="header" style="border-top-left-radius:5px;border-top-right-radius:5px">
                     <h5 class="motto">"To be or not to be, this is my awesome motto!"</h5>
                 </div>
                 <div class="header">
                     <h5 class="motto">"To be or not to be, this is my awesome motto!"</h5>
                 </div>
                 <div class="header">
                     <h5 class="motto">"To be or not to be, this is my awesome motto!"</h5>
                 </div>
                 <div class="header">
                     <h5 class="motto">"To be or not to be, this is my awesome motto!"</h5>
                 </div>
                 <div class="content">
                     <div class="main" style="background-color:#212529;color:#FFFFFF">
                         <h4 class="text-center">Job Description</h4>
                         <p class="text-center">Web design, Adobe Photoshop, HTML5, CSS3, Corel and many others...</p>
                     </div>
                 </div>
                 <div class="footer">
                     <div class="social-links text-center">
                         <a href="https://creative-tim.com" class="facebook"><i class="fa fa-facebook fa-fw"></i></a>
                         <a href="https://creative-tim.com" class="google"><i class="fa fa-google-plus fa-fw"></i></a>
                         <a href="https://creative-tim.com" class="twitter"><i class="fa fa-twitter fa-fw"></i></a>
                     </div>
                 </div>
             </div> <!-- end back panel -->
         </div> <!-- end card -->
     </div> <!-- end card-container -->
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
                 <div class="header" style="border-top-left-radius:5px;border-top-right-radius:5px">
                     <h5 class="motto">"To be or not to be, this is my awesome motto!"</h5>
                 </div>
                 <div class="header">
                     <h5 class="motto">"To be or not to be, this is my awesome motto!"</h5>
                 </div>
                 <div class="header">
                     <h5 class="motto">"To be or not to be, this is my awesome motto!"</h5>
                 </div>
                 <div class="header">
                     <h5 class="motto">"To be or not to be, this is my awesome motto!"</h5>
                 </div>
                 <div class="content">
                     <div class="main" style="background-color:#212529;color:#FFFFFF">
                         <h4 class="text-center">Job Description</h4>
                         <p class="text-center">Web design, Adobe Photoshop, HTML5, CSS3, Corel and many others...</p>
                     </div>
                 </div>
                 <div class="footer">
                     <div class="social-links text-center">
                         <a href="https://creative-tim.com" class="facebook"><i class="fa fa-facebook fa-fw"></i></a>
                         <a href="https://creative-tim.com" class="google"><i class="fa fa-google-plus fa-fw"></i></a>
                         <a href="https://creative-tim.com" class="twitter"><i class="fa fa-twitter fa-fw"></i></a>
                     </div>
                 </div>
             </div> <!-- end back panel -->
         </div> <!-- end card -->
     </div> <!-- end card-container -->
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
                 <div class="header" style="border-top-left-radius:5px;border-top-right-radius:5px">
                     <h5 class="motto">"To be or not to be, this is my awesome motto!"</h5>
                 </div>
                 <div class="header">
                     <h5 class="motto">"To be or not to be, this is my awesome motto!"</h5>
                 </div>
                 <div class="header">
                     <h5 class="motto">"To be or not to be, this is my awesome motto!"</h5>
                 </div>
                 <div class="header">
                     <h5 class="motto">"To be or not to be, this is my awesome motto!"</h5>
                 </div>
                 <div class="content">
                     <div class="main" style="background-color:#212529;color:#FFFFFF">
                         <h4 class="text-center">Job Description</h4>
                         <p class="text-center">Web design, Adobe Photoshop, HTML5, CSS3, Corel and many others...</p>
                     </div>
                 </div>
                 <div class="footer">
                     <div class="social-links text-center">
                         <a href="https://creative-tim.com" class="facebook"><i class="fa fa-facebook fa-fw"></i></a>
                         <a href="https://creative-tim.com" class="google"><i class="fa fa-google-plus fa-fw"></i></a>
                         <a href="https://creative-tim.com" class="twitter"><i class="fa fa-twitter fa-fw"></i></a>
                     </div>
                 </div>
             </div> <!-- end back panel -->
         </div> <!-- end card -->
     </div> <!-- end card-container -->
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
                 <div class="header" style="border-top-left-radius:5px;border-top-right-radius:5px">
                     <h5 class="motto">"To be or not to be, this is my awesome motto!"</h5>
                 </div>
                 <div class="header">
                     <h5 class="motto">"To be or not to be, this is my awesome motto!"</h5>
                 </div>
                 <div class="header">
                     <h5 class="motto">"To be or not to be, this is my awesome motto!"</h5>
                 </div>
                 <div class="header">
                     <h5 class="motto">"To be or not to be, this is my awesome motto!"</h5>
                 </div>
                 <div class="content">
                     <div class="main" style="background-color:#212529;color:#FFFFFF">
                         <h4 class="text-center">Job Description</h4>
                         <p class="text-center">Web design, Adobe Photoshop, HTML5, CSS3, Corel and many others...</p>
                     </div>
                 </div>
                 <div class="footer">
                     <div class="social-links text-center">
                         <a href="https://creative-tim.com" class="facebook"><i class="fa fa-facebook fa-fw"></i></a>
                         <a href="https://creative-tim.com" class="google"><i class="fa fa-google-plus fa-fw"></i></a>
                         <a href="https://creative-tim.com" class="twitter"><i class="fa fa-twitter fa-fw"></i></a>
                     </div>
                 </div>
             </div> <!-- end back panel -->
         </div> <!-- end card -->
     </div> <!-- end card-container -->
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
                 <div class="header" style="border-top-left-radius:5px;border-top-right-radius:5px">
                     <h5 class="motto">"To be or not to be, this is my awesome motto!"</h5>
                 </div>
                 <div class="header">
                     <h5 class="motto">"To be or not to be, this is my awesome motto!"</h5>
                 </div>
                 <div class="header">
                     <h5 class="motto">"To be or not to be, this is my awesome motto!"</h5>
                 </div>
                 <div class="header">
                     <h5 class="motto">"To be or not to be, this is my awesome motto!"</h5>
                 </div>
                 <div class="content">
                     <div class="main" style="background-color:#212529;color:#FFFFFF">
                         <h4 class="text-center">Job Description</h4>
                         <p class="text-center">Web design, Adobe Photoshop, HTML5, CSS3, Corel and many others...</p>
                     </div>
                 </div>
                 <div class="footer">
                     <div class="social-links text-center">
                         <a href="https://creative-tim.com" class="facebook"><i class="fa fa-facebook fa-fw"></i></a>
                         <a href="https://creative-tim.com" class="google"><i class="fa fa-google-plus fa-fw"></i></a>
                         <a href="https://creative-tim.com" class="twitter"><i class="fa fa-twitter fa-fw"></i></a>
                     </div>
                 </div>
             </div> <!-- end back panel -->
         </div> <!-- end card -->
     </div> <!-- end card-container -->
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
                 <div class="header" style="border-top-left-radius:5px;border-top-right-radius:5px">
                     <h5 class="motto">"To be or not to be, this is my awesome motto!"</h5>
                 </div>
                 <div class="header">
                     <h5 class="motto">"To be or not to be, this is my awesome motto!"</h5>
                 </div>
                 <div class="header">
                     <h5 class="motto">"To be or not to be, this is my awesome motto!"</h5>
                 </div>
                 <div class="header">
                     <h5 class="motto">"To be or not to be, this is my awesome motto!"</h5>
                 </div>
                 <div class="content">
                     <div class="main" style="background-color:#212529;color:#FFFFFF">
                         <h4 class="text-center">Job Description</h4>
                         <p class="text-center">Web design, Adobe Photoshop, HTML5, CSS3, Corel and many others...</p>

                         <div class="stats-container">
                             <div class="stats">
                                 <h4>235</h4>
                                 <p style="font-size:12px">
                                     Followers
                                 </p>
                             </div>
                             <div class="stats">
                                 <h4>114</h4>
                                 <p style="font-size:12px">
                                     Following
                                 </p>
                             </div>
                             <div class="stats">
                                 <h4>35</h4>
                                 <p style="font-size:12px">
                                     LAST
                                 </p>
                             </div>
                         </div>

                     </div>
                 </div>
                 <div class="footer">
                     <div class="social-links text-center">
                         <a href="https://creative-tim.com" class="facebook"><i class="fa fa-facebook fa-fw"></i></a>
                         <a href="https://creative-tim.com" class="google"><i class="fa fa-google-plus fa-fw"></i></a>
                         <a href="https://creative-tim.com" class="twitter"><i class="fa fa-twitter fa-fw"></i></a>
                     </div>
                 </div>
             </div> <!-- end back panel -->
         </div> <!-- end card -->
     </div> <!-- end card-container -->
    </div>
<div class="section section-cards section-gold" id="basic-elements" style="background-color:transparent">

    <div class="row">
        <div class="col-lg-12">
            <div class="container">
                <ul class="list-inline" style="height:45px">
                    <li class="list-inline-item"><a href="?ym=<?= $prev; ?>" class="btn btn-link">&lt; Mois précèdent</a></li>
                    <li class="list-inline-item"><div class="container" style="width:400px;height:45px"><span class="title"><?= $title; ?></span></div></li>
                    <li class="list-inline-item"><a href="?ym=<?= $next; ?>" class="btn btn-link">Mois suivant &gt;</a></li>
                </ul>
                <p class="text-right"><a href="calendar.php" data-toggle="tooltip" data-placement="top" title="Revenir au mois actuel">Mois en cours</a></p>
                </div>
        
    <div class="content-center-brand">
        
        <table class="table table-bordered table-dark" style="margin:auto">
            <thead>
                <tr style="width:900px">
                    <th style="width:250px;min-width: 250px;">Lundi</th>
                    <th style="width:250px;min-width: 250px;">Mardi</th>
                    <th style="width:250px;min-width: 250px;">Mercredi</th>
                    <th style="width:250px;min-width: 250px;">Jeudi</th>
                    <th style="width: 250px;min-width: 250px;">Vendredi</th>
                    <th style="width:250px;min-width: 250px;" title="CI LI">Samedi</th>
                    <th style="width:250px;min-width: 250px;" title="WIK AND">Dimanche</th>
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
    <?php
    var_dump($_POST);
    ?>
                </div>
                </div>
                </div></div>
<div class="modal fade modal-primary" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-login" style="margin:auto;margin-top:10%">
    <div class="modal-content" style="background-color:#333333">
      <div class="card card-login card-plain" style="background-color:#333333">
        <div class="modal-header justify-content-center">
          <button type="button" class="close" data-dismiss="loginModal" aria-hidden="true">
            <i class="now-ui-icons ui-1_simple-remove"></i>
          </button>

          <div class="header header-primary text-center">
                          <div class="logo-container">
                              <img src="/assets/img/now-logo.png" alt="">
                          </div>
                      </div>
        </div>
        <div class="modal-body" data-background-color>
        <form class="form" method="POST" action="index.php?page=login" autocomplete="false">
                            <div class="card-header text-center">
                            </div>
                            <div class="card-body" style="text-align:center">
                            <?php if(isset($actualDate)){ echo "$actualDate";} ?>
                              <div class="input-group no-border input-lg">
                                  <div class="input-group-prepend">
                                    <span class="input-group-text">
                                    <i class="now-ui-icons users_circle-08" style="color:#FFFFFF"></i>
                                    </span>
                                    <input type="date" class="form-control" name="appDate" id="0" min="<?= $today; ?>"
                                     style="color:#FFFFFF" required>
                                  </div>
                              </div>
                              <div class="input-group no-border input-lg">
                                  <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="now-ui-icons text_caps-small" style="color:#FFFFFF"></i></span>
                                  </div>
                                  <input type="password" placeholder="Mot de passe" name="password" id="1" class="form-control"
                                  value="<?php if(isset($flagPassword)){ echo $flagPassword; } ?>" style="color:#FFFFFF" required>
                              </div>
                            </div>
        </div>
        <div class="modal-footer text-center">
          <a href="#pablo" class="btn btn-neutral btn-round btn-lg btn-block">Get Started</a>
        </div>
        </form>
        <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>

      </div>
    </div>
  </div>
</div>
                
   
</body>
</html>