<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8" />
    <link rel="apple-touch-icon" sizes="76x76" href="V/_template/assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="V/_template/assets/img/favicon.png">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>
        Timestamped -   <?php
                            (isset($page)) ?  print($page): "";
                        ?>
    </title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
    <!--     Fonts and icons     -->
    <!--     Fonts and icons     -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    <!-- CSS Files -->
    <link href="V/_template/assets/css/bootstrap.min.css" rel="stylesheet" />
    <link href="V/_template/assets/css/now-ui-kit.css?v=1.2.0" rel="stylesheet" />
    <!-- CSS Just for demo purpose, don't include it in your project -->
    <link href="V/_template/assets/demo/demo.css" rel="stylesheet" />
    <script src="V/_template/assets/js/app.js"></script>
    <!--   Core JS Files   -->
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


    <!-- Control Center for Now Ui Kit: parallax effects, scripts for the example pages etc -->
    <script src="V/_template/assets/js/now-ui-kit.js?v=1.2.0" type="text/javascript"></script>    
    <link href="V/_template/rotate/css/rotating-card.css" rel="stylesheet" />
    <link href="https://netdna.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css" rel="stylesheet" />
    <script>
        id = <?php echo $_SESSION['ID']; ?>;
        function select(day,event){
            event.preventDefault();
            date = String(document.getElementById('date'+ day).value);
            date = date.split('-');
            $('#kill'+ day).tooltip('hide');
            (date[2] < 10)? date[2] = "0"+ date[2]: date[2] = date[2];
            $('#loginModal').modal('show');
            document.getElementById('0').value = date[0]+"-"+date[1]+"-"+date[2];
        }

        function myMapz(val)
        {
            console.log(val);
            val = val.split(" ");
            console.log(val);
            if(val.length > 2)
            {
                document.getElementById('showMaps').src = "https://www.google.com/maps/place/"+ val[0] +"+"+ val[1] +"+"+ val[2] +"+"+ val[3] +"+"+ val[4];
                document.getElementById('showMaps').style.display= "block";
                console.log('djhqsgdhjsq');
            }
        }
    </script>
    <link href="https://fonts.googleapis.com/css?family=Armata" rel="stylesheet"> 
    <!-- Control Center for Now Ui Kit: parallax effects, scripts for the example pages etc -->
    <script src="V/_template/assets/js/now-ui-kit.js?v=1.2.0" type="text/javascript"></script>
    <style>
        body{
            font-family: 'Armata', sans-serif;

        }
        .form-check-radio input[type="radio"]:checked + .form-check-sign::after {

width: 6px;
height: 6px;
background-color: #FFFFFF;
border-color: #ffffff;
top: 10px;
left: 10px;
opacity: 1;
color: transparent;

}
        .wrapper{
            font-family: 'Armata', sans-serif;

        }
        .container {
            font-family: 'Armata', sans-serif;
            margin: auto;
        }
        .list-inline {
            text-align: center;
            padding-bottom:10px;
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
        th:nth-of-type(6), td:nth-of-type(6), .others {
            color: #decba4;
        }
        th:nth-of-type(7), td:nth-of-type(7), .others {
            color: #decba4;
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

            color: rgb(0,127,184);

        }
        a:hover {

            color: rgb(0,127,184);

        }
        a:focus {

            color: rgb(0,127,184);

        }
        a:active {

            color: rgb(0,127,184);

        }
        table{
            opacity:0.8;
        }
        .form-control{
            border-top-right-radius:6px;
            border-bottom-right-radius:6px;
            border-top-right-radius:5px;border-bottom-right-radius:5px;
        }
        .form-control:focus{
            border:none;
            outline:none;
            border-color:transparent;
            box-shadow:none;
            border-top-right-radius:5px;border-bottom-right-radius:5px;

        }
        .form-control:active{
            border:none;
            outline:none;
            border-color:transparent;
            box-shadow:none;
            border-top-right-radius:5px;border-bottom-right-radius:5px;


        }
        .btn.btn-link{
            color:#FFF;
            font-size:14px;
        }
        .form-control.mod-input{
            height:99px;
            line-height:14px;
        }
       .form-control:focus {
            border-top: 1px solid #FFFFFF;
            border-right: 1px solid #FFFFFF;
            border-bottom: 1px solid #FFFFFF;
            background-color: transparent;
            color: #FFFFFF;
        }
        .input-group.no-border .input-group-text {
            border-radius:0px;
        }
        .today {
            background-color: rgb(91,971,151,0.2);
            color:#FFFFFF;
        }
        .btn.btn-secondary.form-check.form-check-inline:active{
            background-color:transparent;
            border:none;
        }
        .btn.btn-secondary.form-check.form-check-inline:focus{
            background-color:transparent;
        }
        .btn.btn-secondary.form-check.form-check-inline:hover{
            background-color:transparent;
            border:none;
            box-shadow:none;
        }
        .index-page .page-header {

            height: 100vh;

        }
        .page-header {

            min-height: 100vh;
            max-height: 185vh;
            padding: 0;
            color: #FFFFFF;
            position: relative;
            overflow: hidden;

        }
		.sid{
		border:none;
		background:none;
		text-decoration:none;
		color: #FFFFFF;  /* fallback for old browsers */

		outline:none;
		cursor:pointer;
		}
		.sid:focus{
		border:none;
		background:none;
		text-decoration:none;
		color:orange;
		outline:none;
		}
		
		.btn-primary{
		background-color:#333333;
		}
		.btn-primary:hover{
		background: #f46b45;  /* fallback for old browsers */
		background: -webkit-linear-gradient(to right, #eea849, #f46b45);  /* Chrome 10-25, Safari 5.1-6 */
		background: linear-gradient(to right, #eea849, #f46b45); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */

		}
		.btn-primary:focus{
		background-color:#A43931;
		}
	
		.section{
		text-align:center;
		}
		.card{
		text-align:left;
		}
		.form-check .form-check-sign::after {

			font-family: 'Nucleo Outline';
			content: "\ea22";
			top: 0px;
			text-align: center;
			font-size: 14px;
			opacity: 0;
			color: #FFFFFF;
			border: 0;
			background-color: inherit;

		}
		.form-check-sign .form-check-inline.checkbox::after {
			font-family: 'Nucleo Outline';
			content: "\ea22";
			top: 0px;
			text-align: center;
			font-size: 14px;
			opacity: 0;
			color: #FFFFFF;
			border: 0;
			background-color: inherit;
		}
		.form-check-radio input[type="radio"]:checked + .form-check-sign::after{
			width: 6px;
			height: 6px;
			background-color: #FFFFFF;
			border-color: #ffffff;
			top: 10px;
			left: 10px;
			opacity: 1;
		}
		ul{
			list-style:none;
		}
		body{
			background-color:#333333;
		}
		.section{
			padding-top:20px;
		}
		.wrapper{
			width:101%;
		}
  </style>
  <!-- FontAwesome -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
</head>
