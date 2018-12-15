  <style>
	.bg-primary{
		background-color:#333333;
	}
	.dropdown-item{
		height:50px;
	}
	.dropdown-item.dropTop{
		height:40px;
	}
  </style>
  <body class="index-page sidebar-collapse">
  	<!-- NAVBAR -->
  	<nav class="navbar navbar-expand-lg bg-primary fixed-top navbar-transparent" color-on-scroll="600">
		<div class="container">
			<div class="navbar-translate" style="background-color:transparent">
				<a class="navbar-brand" href="index.php?page=lobby" rel="tooltip" title="" data-placement="bottom" target="_self">
					<img src="V/_template/assets/img/logo.png" height="50px" width="75px">
				</a>
					<?php if(isset($actualDate)){ echo $actualDate;} ?>
					<?php if(isset($time)){ echo $time;} ?>
				<button class="navbar-toggler navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
			   		<span class="navbar-toggler-bar top-bar"></span>
					<span class="navbar-toggler-bar middle-bar"></span>
					<span class="navbar-toggler-bar bottom-bar"></span>
			 	</button>
			</div>

		    <div class="collapse navbar-collapse justify-content-end" id="navigation" data-nav-image="V/_template/assets/img/blurred-image-1.jpg">
				<ul class="navbar-nav">
					<li class="nav-item dropdown">
						<a href="#" class="nav-link dropdown-toggle" id="navbarDropdownMenuLink1" data-toggle="dropdown">
							<i class="now-ui-icons design_bullet-list-67"></i>
							<p>Catégorie</p>
						</a>
						  
					<div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink1">
						<?php
							if(!empty($cats))
							{
								?>
									<form action="index.php?page=search" method="POST">
								<?php
								for($i = 0; $i < count($cats);$i++)
								{
									?>
										<button type="submit" class="dropdown-item topDrop" name="fetch" value="<?php echo $cats[$i]['ID']; ?>">
											<?php echo $cats[$i]['Nom']; ?>
										</button>
										<div class="dropdown-divider"></div>									
									<?php
								}
								?>
									</form>
								<?php
							} 
							else
							{
								?>
								<span class="dropdown-item">Aucune catégorie existante.</span>
								<?php
							}
							?>
							<div class="dropdown-divider"></div>
							<form action="index.php?page=lobby" method="POST">
								<button type="submit" class="dropdown-item" name="choice" value="createCat">
									Proposer une catégorie
								</button>
							</form>
						</div>
					</li>
	        		<li class="nav-item dropdown">
						<a href="#" class="nav-link dropdown-toggle" id="navbarDropdownMenuLink1" data-toggle="dropdown">
							<i class="now-ui-icons design_app"></i>
							<p>Salons</p>
						</a>
	          			<div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink1" style="overflow:hidden">
							<form action="index.php?page=lobby" method="POST" style="margin-top:-13px;margin-bottom:-9px">
								<button type="submit" class="dropdown-item" name="choice" value="listPlat">
								<i class="now-ui-icons files_paper" style="margin-left:-13px;margin-bottom:4px"></i>Liste des salons
								</button>
							</form>
							<div class="dropdown-divider"></div>
							<form action="index.php?page=platoons" method="POST"style="margin-top:-9px;margin-bottom:-9px">
								<button type="submit" class="dropdown-item" name="choice" value="handlePlats">
								<i class="now-ui-icons ui-1_settings-gear-63" style="margin-left:-13px;margin-bottom:4px"></i>Gérer mes salons
								</button>
							</form>
							<div class="dropdown-divider"></div>
							<form action="index.php?page=platoons" method="POST" style="margin-top:-9px;margin-bottom:-9px">
								<button type="submit" class="dropdown-item" name="choice" value="createPlat">
								<i class="now-ui-icons ui-1_simple-add" style="margin-left:-13px;margin-bottom:4px;font-weight:950"></i>Créer un salon
								</button>
							</form>
						</div>
					</li>
					<li class="nav-item dropdown">
						<a href="#" class="nav-link dropdown-toggle" id="navbarDropdownMenuLink1" data-toggle="dropdown">
							<i class="now-ui-icons ui-1_settings-gear-63"></i>
							<p>Mon Compte</p>
						</a>
	          			<div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink1" style="overflow:hidden;margin-top:15px">
							<form action="index.php?page=account" method="POST" style="margin-top:-13px;margin-bottom:-9px">
								<button type="submit" class="dropdown-item" name="mod" value="11" style="height:50px">
								<i class="now-ui-icons business_badge" style="margin-top:-13px;margin-bottom:-9px;margin-left:-13px;font-size:16px"></i>Modifier mes informations
								</button>
							</form>
							<div class="dropdown-divider"></div>
							<form action="index.php?page=logout" method="POST"style="margin-top:-9px;margin-bottom:-9px">
								<button type="submit" class="dropdown-item" name="choice" value="handlePlats">
								<i class="now-ui-icons media-1_button-power" style="margin-top:-13px;margin-bottom:-9px;margin-left:-13px;font-size:16px"></i>Déconnexion
								</button>
							</form>
						</div>
					</li>
					<form class="form-inline ml-auto" data-background-color action="index.php?page=browse" method="POST">
		                <div class="input-group">
		                	<div class="input-group-prepend">
		                    	<span class="input-group-text"><i class="now-ui-icons ui-1_zoom-bold"></i></span>
		                	</div>
		                	<input type="text" class="form-control" placeholder="Rechercher">
		                </div>
		            </form>
				</ul>
		    </div>
		</div>
	</nav>