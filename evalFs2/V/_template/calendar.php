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
   

