<div class="wrapper">
        <div class="page-header clear-filter">
            <div class="page-header-image" data-parallax="true" style="background-image:url(
            <?php if(isset($_SESSION['background'])){ echo $_SESSION['background']; } else { echo "V/_template/assets/img/header.jpg"; } ?>);"></div>
                <div class="container" style="margin:auto;height:auto;">
                <?php 
                    if(isset($messages))
                    { 
                        if(!empty($messages))
                        {
                            for($i = count($messages) - 1; $i >= 0 ; $i--)
                            {
                                echo $messages[$i];
                            }
                        }
                    }
                ?>                            
                        <div class="content-center-brand">
                            <div class="col-md-6 col-xs-8  ml-auto mr-auto" data-toggle="tooltip" data-placement="right" title="Liste de vos patients">
                            <div id="accordion" role="tablist" aria-multiselectable="true" class="card-collapse"  style="margin-top:90px">
                    <div class=" container" style="transform:scale(-1,1);background-color:rgba(16,16,16,0.4);height:auto" >
                    <?php
                        if(!empty($prevCons)){
                            for($i = 0;$i < count($prevCons);$i++){
                                $hours = explode(":",$prevCons[$i]['consH']);
                            $hours = $hours[0].":".$hours[1];
                            $datesC = explode("-",$prevCons[$i]['consDate']);
                            $datesC = "$datesC[2]-$datesC[1]-$datesC[0]";
                                ?>
                        <div class="card-header" role="tab" id="heading<?php echo $i; ?>">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo $i; ?>" aria-expanded="true" aria-controls="collapse<?php echo $i; ?>" style="color:#ED8F03;font-weight:850">
                            Consultation du <?= $datesC;?> à <?= $hours; ?>
                            <i class="now-ui-icons arrows-1_minimal-down"></i>
                            </a>
                    </div>

                    <div id="collapse<?php echo $i; ?>" class="collapse show" role="tabpanel" aria-labelledby="heading<?php echo $i; ?>">
                    <div class="card-body">
                        <h6 class="motto">Intitulé : <br><?php echo $prevCons[$i]['appName']; ?><br></h6>
                        <h6 class="motto">Raison : <br><?php echo $prevCons[$i]['reason']; ?><br></h6>
                        <h6 class="motto">État mental : <br><?php echo $prevCons[$i]['mState']; ?><br></h6>
                        <h6 class="motto">État physique : <br><?php echo $prevCons[$i]['pState']; ?><br></h6>
                        <h6 class="motto">Tempérament : <br><?php echo $prevCons[$i]['temp']; ?></h6>
                        <h6 class="motto">Notes : <br><?php echo $prevCons[$i]['cNotes']; ?><br></h6>
                        <h6 class="motto">Poids : <br><?php echo $prevCons[$i]['weight']; ?> kg<br></h6>    
                    </div>
                    </div>
                                <?php
                            }
                        
                        ?>
                    
                        <?php }else {
                            echo alert("Aucune consultation effectuée avec ce patient");
                        }
                        ?>
                        </div>
                    </div>
                </div>
                </div>
                </div>