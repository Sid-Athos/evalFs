    <!-- Navbar -->
    <!-- End Navbar -->
    
    <div class="wrapper">
        <div class="page-header clear-filter">
            <div class="page-header-image" data-parallax="true" style="background-image:url('V/_template/assets/img/header.jpg');"></div>
                <div class="container">
                    <?php 
                        $hour = explode(":",$res[0]['startTime']); $hour = $hour[0].":".$hour[1];
                        if(isset($messages)){ 
                            for($i = count($messages) -1; $i >= 0; $i--)
                            {
                                echo $messages[$i];
                            }
                        }
                    ?>                            
                <div class="content-center brand">
                <h4 class="motto">Modification d'un évènement : </h4>
                  <div class="col-md-6 ml-auto mr-auto">
                      <div class=" card-login ">
                            <form class="form" method="POST" action="index.php?page=platoons" autocomplete="false">
                                <div class="card-body">
                                    <div id="check">
                                    </div>
                                    <div class="input-group no-border input-lg">
                                        <div class="input-group-prepend" id="prep">
                                        <span class="input-group-text">
                                        <i class="now-ui-icons text_align-center" style="color:#FFFFFF"></i>
                                        </span>
                                        </div>
                                        <input type="text" class="form-control" placeholder="Intitulé du rendez-vous"  name="newName" id="0"
                                        data-toggle="tooltip" date-placement="left" title="Intitulé du rendez-vous"
                                        value="<?php if(isset($res[0]['appName'])){ echo $res[0]['appName']; } ?>" style="color:#FFFFFF" required autocomplete="off">
                                    </div>
                                    <div class="input-group no-border input-lg">
                                        <div class="input-group-prepend" id="prep">
                                        <span class="input-group-text">
                                        <i class="now-ui-icons text_align-center" style="color:#FFFFFF"></i>
                                        </span>
                                        </div>
                                        <input type="text" class="form-control" placeholder="Lieu"  name="newPlace" id="0"
                                        data-toggle="tooltip" date-placement="left" title="Lieu du rendez-vous"
                                        value="<?php if(isset($res[0]['appPlace'])){ echo $res[0]['appPlace']; } ?>" style="color:#FFFFFF" required autocomplete="off">
                                    </div>
                                    <div class="form-row">
                                    <div class="input-group no-border input-lg" style="max-width:170;left:5px">
                                        <div class="input-group-prepend" id="prep">
                                        <span class="input-group-text">
                                        <i class="now-ui-icons text_align-center" style="color:#FFFFFF"></i>
                                        </span>
                                        </div>
                                        <input type="time" class="form-control" placeholder="Heure de commencement"  name="newTime" id="0"
                                        value="<?php if(isset($res[0]['startTime'])){ echo $hour; } ?>" style="color:#FFFFFF" required autocomplete="off">
                                    </div>
                                    <div class="input-group no-border input-lg" style="max-width: 180px;float:right;position: absolute;left: 50%;">
                                        <div class="input-group-prepend" id="prep">
                                        <span class="input-group-text">
                                        <i class="now-ui-icons text_align-center" style="color:#FFFFFF"></i>
                                        </span>
                                        </div>
                                        <input type="date" class="form-control" placeholder="Date du Rendez-vous"  name="newDate" id="0"
                                        data-toggle="tooltip" date-placement="left" title="Date de rdv"
                                        value="<?php if(isset($res[0]['appDay'])){ echo $res[0]['appDay']; } ?>" style="color:#FFFFFF" required autocomplete="off">
                                    </div></div>
                                <h3 class="motto">Sélectionnez une catégorie de référencement :</h3>
                                <div class="input-group no-border input-xs" data-toggle="tooltip" 
                                            data-placement="top" 
                                            title="Catégorie de l'évènement" style="left:-2px">
                                            <div class="input-group-prepend " id="prep" >
                                                <span class="input-group-text" style="height:38px">
                                                <i class="now-ui-icons files_box" style="color:#FFFFFF"></i>
                                                </span>
                                            </div>
                                <select name="newCat" class="form-control">
                                    <option type="checkbox" class="form-check-input" style="color:#FFFFFF;background-color:rgba(0,0,0,0.7)" name="addCat[]" style="margin:auto"
                                    value="<?php echo $res[0]['catId']; ?>" date-toggle="tooltip" data-placement="right" title="Catégorie actuelle">
                                            <span class="form-check-sign form-check-inline">
                                                <?php echo $res[0]['appCat']; ?>
                                            </span>
                                    </option>
                                <?php
                                
                                    for($i = 0;$i < count($cats);$i++)
                                    {
                                        ?>
                                                <option type="checkbox" class="form-check-input" style="color:#FFFFFF;background-color:#333" name="addCat[]" style="margin:auto"
                                                value="<?php echo $cats[$i]['ID']; ?>">
                                                <span class="form-check-sign form-check-inline">
                                                <?php echo $cats[$i]['name']; ?>
                                                </span></option>
                                        <?php
                                    }
                                ?>
                                </select></div>
                                <div class="input-group no-border input-lg">
                                        <div class="input-group-prepend" id="prep">
                                        <span class="input-group-text">
                                        <i class="now-ui-icons text_align-center" style="color:#FFFFFF"></i>
                                        </span>
                                        </div>
                                        <textarea type="time" class="form-control" placeholder="Notes"  name="newNotes" id="0"
                                        value="" style="color:#FFFFFF" required autocomplete="off"><?php if(isset($res[0]['appNotes'])){ echo $res[0]['appNotes']; } ?>
                                        </textarea>
                                </div>
                                <div class="-footer text-center">
                                    <button type="submit" class="btn btn-primary btn-round btn-lg btn-block" onclick="subPlatoon(event)"
                                    name="choice" value="addPlat">Créer mon salon</button>
                                </form>
                                <div class="pull-right">
                                    <button type="button" class="sid"
                                    name="info" value="get" data-toggle="modal" data-target="#exampleModal">Besoin d'aide?
                                    </button>
                                </div>
                        </div>
                      </div>
                  </div>
                </div>
            </div>
          </div>
        </div>
      </div>
    </div>    
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" >
      <div class="modal-dialog" role="document" style="position:absolute;margin-top:20%;left:50px">
        <div class="modal-content" style="background-color:#333333;color:#FFFFFF">
          <div class="modal-header" style="text-align:center;color:#ce943b;margin:auto;font-size:24px">
            Le mot de l'équipe
          </div>
          <div class="modal-body" style="text-align:center;white-space:pre-wrap;margin-top:0px">
            Les règles qui régissent le choix du nom de la room sont les mêmes que celles qui s'appliquent au pseudonyme<br>(Aucun caractère spécial autorisé sauf les -,-,')
          </div>
        </div>
      </div>
    </div>