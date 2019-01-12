    <!-- Navbar -->
    <!-- End Navbar -->
    
    <div class="wrapper">
        <div class="page-header clear-filter">
            <div class="page-header-image" data-parallax="true" style="background-image:url('V/_template/assets/img/header.jpg');"></div>
                <div class="container">
                    <?php 
                        $hour = explode(":",$res[0]['startTime']); $hour = $hour[0].":".$hour[1];
                        if(isset($messages)){ 
                            for($i = (count($messages) -1); $i >= 0; $i--)
                            {
                                echo $messages[$i];
                            }
                        }
                        //var_dump($res);
                    ?>                            
                <div class="row" style="margin-top:95px">
                  <div class="col-md-6 ml-auto mr-auto">
                <h4 class="motto">Modification d'un évènement : </h4>
                      <div class=" card-login ">
                            <form class="form" method="POST" action="index.php?page=apps" autocomplete="false">
                                <div class="card-body">
                                    <div id="check">
                                    </div>
                                    <div class="input-group no-border input-lg">
                                        <div class="input-group-prepend" id="prep">
                                        <span class="input-group-text">
                                        <i class="now-ui-icons text_align-center" style="color:#FFFFFF"></i>
                                        </span>
                                        </div>
                                        <input type="text" class="form-control" name="newName" id="0"
                                        data-toggle="tooltip" date-placement="left" title="Intitulé du rendez-vous"
                                        placeholder="<?php if(isset($res[0]['appName'])){ echo $res[0]['appName']; } ?>" style="color:#FFFFFF"  autocomplete="off">
                                    </div>
                                    <div class="input-group no-border input-lg">
                                        <div class="input-group-prepend" id="prep">
                                        <span class="input-group-text">
                                        <i class="now-ui-icons text_align-center" style="color:#FFFFFF"></i>
                                        </span>
                                        </div>
                                        <input type="text" class="form-control"  name="newPlace" id="1"
                                        data-toggle="tooltip" date-placement="left" title="Lieu du rendez-vous"
                                        placeholder="<?php if(isset($res[0]['place'])){ echo $res[0]['place']; } ?>" style="color:#FFFFFF"  autocomplete="off">
                                    </div>
                                    <div class="form-row">
                                        <div class="input-group no-border input-lg" style="max-width:170;left:5px">
                                            <div class="input-group-prepend" id="prep">
                                            <span class="input-group-text">
                                            <i class="now-ui-icons text_align-center" style="color:#FFFFFF"></i>
                                            </span>
                                            </div>
                                            <input type="time" class="form-control"  name="newTime" id="2"
                                            data-toggle="tooltip" date-placement="left" title="Débute à..."
                                            placeholder="<?php if(isset($res[0]['startTime'])){ echo $hour; } ?>" style="color:#FFFFFF;width:100px;max-width:130px"  autocomplete="off">
                                        </div>
                                        <div class="input-group no-border input-lg" style="max-width: 180px;float:right;position: absolute;left: 50%;">
                                            <div class="input-group-prepend" id="prep">
                                            <span class="input-group-text">
                                            <i class="now-ui-icons text_align-center" style="color:#FFFFFF"></i>
                                            </span>
                                            </div>
                                            <input type="date" class="form-control"   name="newDate" id="3"
                                            data-toggle="tooltip" date-placement="left" title="Date de rdv" min="<?php echo $todays; ?>"
                                            placeholder="<?php if(isset($res[0]['appDay'])){ echo $res[0]['appDay']; } ?>" style="color:#FFFFFF"  autocomplete="off">
                                        </div>
                                    </div>
                                    
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
                                                <option type="checkbox" class="form-check-input" style="color:#FFFFFF;background-color:#333"  style="margin:auto"
                                                value="<?php echo $cats[$i]['ID']; ?>">
                                                <span class="form-check-sign form-check-inline">
                                                <?php echo $cats[$i]['name']; ?>
                                                </span></option>
                                        <?php
                                    }
                                ?>
                                </select>
                            </div>
                                <div class="input-group no-border input-lg">
                                        <div class="input-group-prepend" id="prep">
                                        <span class="input-group-text">
                                        <i class="now-ui-icons text_align-center" style="color:#FFFFFF"></i>
                                        </span>
                                        </div>
                                        <textarea class="form-control" placeholder="<?php if(isset($res[0]['notes'])){ echo $res[0]['notes']; } ?>"  name="newNotes"
                                        style="color:#FFFFFF"  autocomplete="off"></textarea>
                                        
                                </div>
                                <div class="-footer text-center">
                                    <button type="submit" class="btn btn-primary btn-round btn-lg btn-block"
                                    name="modApp" value="<?php echo $res[0]['appId'];?>"> Modifier le Rendez-Vous</button>
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