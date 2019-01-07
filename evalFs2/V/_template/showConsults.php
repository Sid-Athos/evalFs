<div class="wrapper">
        <div class="page-header clear-filter">
            <div class="page-header-image" data-parallax="true" style="background-image:url(
            <?php if(isset($_SESSION['background'])){ echo $_SESSION['background']; } else { echo "V/_template/assets/img/header.jpg"; } ?>);"></div>
                <div class="container"style="margin:auto;height:auto;margin-bottom:150px">
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
                        <h6 class="motto form-check-inline" style="color:rgba(242, 112, 156, 0.7)">Intitulé : </h6><?php echo $prevCons[$i]['appName']; ?>
                        <h6 class="motto form-check-inline" style="color:rgba(242, 112, 156, 0.7)">Raison : </h6><?php echo $prevCons[$i]['reason']; ?>
                        <h6 class="motto form-check-inline" style="color:rgba(242, 112, 156, 0.7)">État mental :</h6> <?php echo $prevCons[$i]['mState']; ?>
                        <h6 class="motto form-check-inline" style="color:rgba(242, 112, 156, 0.7)">État physique :</h6> <?php echo $prevCons[$i]['pState']; ?>
                        <h6 class="motto form-check-inline" style="color:rgba(242, 112, 156, 0.7)">Tempérament :</h6> <?php echo $prevCons[$i]['temp']; ?>
                        <h6 class="motto form-check-inline" style="color:rgba(242, 112, 156, 0.7)">Notes :</h6> <?php echo $prevCons[$i]['cNotes']; ?>
                        <h6 class="motto form-check-inline" style="color:rgba(242, 112, 156, 0.7)">Poids :</h6> <?php echo $prevCons[$i]['weight']; ?> kg    
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