
    <div class="wrapper">
      <div class="page-header clear-filter">
          <div class="page-header-image" data-parallax="true" style="background-image:url('V/_template/assets/img/header.jpg');"></div>
          <div class="container">
          <?php if(isset($message)){ echo $message; }?>                            
            <div>
                <div class="content-center brand" style="margin-top:35%">
                  <div class="col-md-6 ml-auto mr-auto">
                      <div class="card card-login card-plain">
                        <form class="form" method="POST" action="index.php?page=login" autocomplete="false">
                            <div class="card-header text-center">
                              <div class="logo-container mb-3">
                              <!--<a href="" onclick="logoEvent(event)"><img src="V/_template/assets/img/logo.png" alt="Glance logo" style="width:250px;height:200px"></a>-->
                              </div>
                            </div>
                            <div class="card-body" style="text-align:center">
                            <?php if(isset($actualDate)){ echo $actualDate;} ?>
                              <div class="input-group no-border input-lg">
                                  <div class="input-group-prepend">
                                    <span class="input-group-text">
                                    <i class="now-ui-icons users_circle-08" style="color:#FFFFFF"></i>
                                    </span>
                                  </div>
                                  <input type="text" class="form-control" placeholder="Adresse email ou pseudo"  name="mail" id="0" title="Adresse mail ou identifiant"
                                  value="<?php if(isset($flagMail)){ echo $flagMail; } ?>" style="color:#FFFFFF" autocomplete="false" required>
                              </div>
                              <div class="input-group no-border input-lg">
                                  <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="now-ui-icons text_caps-small" style="color:#FFFFFF"></i></span>
                                  </div>
                                  <input type="password" placeholder="Mot de passe" name="password" id="1" class="form-control"
                                  value="<?php if(isset($flagPassword)){ echo $flagPassword; } ?>" style="color:#FFFFFF" required>
                              </div>
                            </div>
                            <div style="cursor:pointer;position:relative;width:180px" class="form-check ml-auto mr-auto" onclick="showPass()" >
                            <label class="form-check-label">
                                  <span onclick="showPass()">Afficher le mot de passe</span>
                                  <input type="checkbox" class="form-check-input" style="color:#FFFFFF" name="passwordCheck" 
                                  value="y">
                                  <span class="form-check-sign form-check-inline">
                                    </span>
                                  </label>
                              </div>
                            <div class="card-footer text-center">
                              <button type="submit" class="btn btn-primary btn-round btn-lg btn-block"
                              name="choice" value="connexion">Connexion</button>
                        </form>
                              <div class="pull-left">
                              <form method="POST" action="index.php?page=login">
                                  <button type="submit" class="sid"
                                  name="choice" value="register">S'inscrire</button>
                                </form>
                              </div>
                              <div class="pull-right">
                              <button type="button" class="sid"
                                    name="info" value="get"
                                    data-toggle="modal" data-target="#exampleModal"
                                >Besoin d'aide?</button>
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
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document" style="position:absolute;margin-top:100px;left:50px">
        <div class="modal-content" style="background-color:#333333;color:#FFFFFF">
          <div class="modal-header" style="text-align:center;white-space:pre-wrap;color:#ce943b">
          <form method="POST" id="reg" action="index.php?page=login">
            <h6 class="modal-title">Nom de compte perdu? Mot de passe oublié? Des questions sur le formulaire? Pas d'inquiétude ;)</h6>
          </div>
          <div class="modal-body" style="text-align:center;white-space:pre-wrap;margin-top:-80px">
            Ton adresse mail ainsi que ton numéro de téléphone te serviront à récupérer ton compte facilement.<br>
            Aussi, ton mail peut tout autant te servir que ton pseudonyme pour te connecter! Ce dernier sera cependant le seul identifiant visible par les autres utilisateurs te concernant.<br>
            Si tu as perdu ton compte, saisis ton mail, nous te renverrons tes informations de connexion par mail et par message!
            <div class="input-group no-border input-lg">
              <div class="input-group-prepend">
                  <span class="input-group-text">
                  <i class="now-ui-icons ui-1_email-85" style="color:#FFFFFF"></i>
                  </span>
              </div>
              <input type="mail" class="form-control" style="color:#FFFFFF" pattern="^[a-zA-Z0-9\.]{2,16}@[a-z]{2,6}.[a-z]{2,5}$" 
               placeholder="Adresse email" autocomplete="off" id="2" name="recMail">
            </div>
            
            <div class="input-group no-border input-lg">
                <div class="input-group-prepend">
                    <span class="input-group-text">
                    <i class="fas fa-phone" style="color:#FFFFFF"></i>
                    </span>
                </div>
                <input type="phone" class="form-control" placeholder="N° de téléphone" id="3" pattern="^[0]{1}[1-9]{1}[0-9]{8,10}$" style="color:#FFFFFF" name="recPhone"
                value="" autocomplete="off">
              </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary" name="choice" value="recover">Récupérer mon compte</button>
            </form>
          </div>
        </div>
      </div>
    </div>
    <!--   Core JS Files   -->
    <script src="V/_template/assets/js/core/jquery.min.js" type="text/javascript"></script>
    <script src="V/_template/assets/js/core/popper.min.js" type="text/javascript"></script>
    <script src="V/_template/assets/js/core/bootstrap.min.js" type="text/javascript"></script>
    <!--  Plugin for Switches, full documentation here: http://www.jque.re/plugins/version3/bootstrap.switch/ -->
    <script src="V/_template/assets/js/plugins/bootstrap-switch.js"></script>
    <!--  Plugin for the Sliders, full documentation here: http://refreshless.com/nouislider/ -->
    <script src="V/_template/assets/js/plugins/nouislider.min.js" type="text/javascript"></script>
    <!--  Plugin for the DatePicker, full documentation here: https://github.com/uxsolutions/bootstrap-datepicker -->
    <script src="V/_template/assets/js/plugins/bootstrap-datepicker.js" type="text/javascript"></script>
    <!--  Google Maps Plugin    -->
    <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>
    <!-- Control Center for Now Ui Kit: parallax effects, scripts for the example pages etc -->
    <script src="V/_template/assets/js/now-ui-kit.js?v=1.2.0" type="text/javascript"></script>
</body>
