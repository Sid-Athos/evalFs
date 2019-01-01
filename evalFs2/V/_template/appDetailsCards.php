<div class="wrapper"  >
            <div class="content-center-brand" style="margin:auto;max-width:1900px;min-width:1900px;padding-top:70px">
            <?php
            $compteur = 0;
            for($i = 0; $i <  32; $i++)
            {
                ?>
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
                                <div id="accordion" role="tablist" aria-multiselectable="true" class="card-collapse" 
                                style="-moz-transform: scale(-1, 1);-webkit-transform: scale(-1, 1);-o-transform: scale(-1, 1);
                                -ms-transform: scale(-1, 1);transform: scale(-1, 1);background:transparent">
                                    <div class="card card-plain" style="background:transparent">
                                        <div class="card-header" role="tab" id="heading<?php echo $compteur; ?>" style="text-align:center">
                                            <a data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo $compteur; ?>" aria-expanded="false" aria-controls="collapse<?php echo $compteur; ?>">
                                            Infos pratiques
                                            <i class="now-ui-icons arrows-1_minimal-down"></i>
                                            </a>
                                        </div>
                                        <div id="collapse<?php echo $compteur; ?>" class="collapse hide" role="tabpanel" aria-labelledby="heading<?php echo $compteur; $compteur++?>">
                                            <div class="card-body" style="background:transparent;color:rgb(255,255,255,0.7)">
                                                Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 
                                                3 wolf moon officia aute, non cupidatat skateboard dolor brunch. 
                                                Food truck quinoa nesciunt laborum eiusmod. 
                                                Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. 
                                                Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. 
                                                Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth 
                                                nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card card-plain" style="background:transparent">
                                        <div class="card-header" role="tab" id="heading<?php echo $compteur; ?>" style="text-align:center">
                                            <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo $compteur; ?>" 
                                            aria-expanded="false" aria-controls="collapse<?php echo $compteur; ?>">
                                            Participant(s)
                                            <i class="now-ui-icons arrows-1_minimal-down"></i>
                                            </a>
                                        </div>
                                        <div id="collapse<?php echo $compteur; ?>" class="collapse" role="tabpanel" aria-labelledby="heading<?php echo $compteur; $compteur++?>">
                                            <div class="card-body" style="background:transparent;color:rgb(255,255,255,0.7)">
                                                Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 
                                                3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. 
                                                Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. 
                                                Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. 
                                                Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth 
                                                nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <h5 class="motto">Tobby or not tobby? Dat ist da kwechtionne</h5>
                                <div class="header">
                                    <h5 class="motto">"To be or not to be, this is my awesome motto!"</h5>
                                </div>
                                <div class="header">
                                    <h5 class="motto">"To be or not to be, this is my awesome motto!"</h5>
                                </div>
                                <div class="header">
                                    <h5 class="motto">"To be or not to be, this is my awesome motto!"</h5>
                                </div>
                            </div>
                            <div class="content" style="margin-bottom:-80px;background-color:transparent">
                                <div class="main" style="background-color:transparent;color:#FFFFFF" >
                                    <h4 class="text-center">Job Description</h4>
                                    <p class="text-center">Web design, Adobe Photoshop, HTML5, CSS3, Corel and many others...</p>
                                </div>
                            </div>
                            <div class="footer">
                                <div class="social-links text-center">
                                    <a href="#" class="facebook"><i class="fa fa-facebook fa-fw"></i></a>
                                    <a href="#" class="google"><i class="fa fa-google-plus fa-fw"></i></a>
                                    <a href="#" class="twitter"><i class="fa fa-twitter fa-fw"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
            }
            ?>
            </div>
        </div>
        