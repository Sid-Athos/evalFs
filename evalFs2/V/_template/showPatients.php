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
                            <div id="accordion" role="tablist" aria-multiselectable="true" class="card-collapse"  style="margin-top:250px">
                    <div class=" container" style="transform:scale(-1,1);background-color:rgba(16,16,16,0.4);height:auto" >
                    <?php
                        if(!empty($res)){
                            for($i = 0;$i < count($res);$i++){
                                ?>
                        <div class="card-header" role="tab" id="heading<?php echo $i; ?>">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo $i; ?>" aria-expanded="true" aria-controls="collapse<?php echo $i; ?>" style="color:#ED8F03;font-weight:850">
                            <?= $res[$i]['patientName']; ?>
                            <i class="now-ui-icons arrows-1_minimal-down"></i>
                            </a>
                    </div>

                    <div id="collapse<?php echo $i; ?>" class="collapse show" role="tabpanel" aria-labelledby="heading<?php echo $i; ?>">
                    <div class="card-body">
                                                    <h6 class="motto form-check-inline">Sexe : <?= $res[$i]['sexName']; ?></h6>
                                                    <h6 class="motto form-check-inline">Né(e) le : <?php echo $res[$i]['birthDate']; ?></h6>
                                                    <h6 class="motto form-check-inline">Mode de vie : <?php echo $res[$i]['lifeS']; ?></h6>
                                                    <h6 class="motto form-check-inline">Alimentation : <?php echo $res[$i]['patFood']; ?></h6>
                                                    <h6 class="motto form-check-inline">Représentant légal : <?php echo $res[$i]['lastName']; ?> <?php echo $res[$i]['firstName']; ?></h6>
                                                    <h6 class="motto form-check-inline">Téléphone : <?php echo $res[$i]['phone']; ?></h6>
                                                    <h6 class="motto form-check-inline">@ : <?php echo $res[$i]['email']; ?></h6>
                    </div>
                    </div>
                                <?php
                            }
                        }
                    ?>
                    
                </div>
                
                    </div>
                </div>
                </div>
                </div>