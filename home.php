<?php
include("fonctions.php");
session_start();
?>
<!DOCTYPE html>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>BetterBets</title>
	<!-- CSS FILES -->
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <link href="assets/css/custom.css" rel="stylesheet" />

</head>


<body>
    <div id="wrapper">
        <nav class="navbar navbar-default navbar-cls-top " style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
                </button>
                <a class="navbar-brand" href="profil.php">BetterBets</a> 
            </div>
					<!-- Affichage de bouton en fonction d'ue connexion ou non -->
					<?php if(!empty($_SESSION)){ ?>
                <div style="color: white; padding: 15px 50px 5px 50px; float: right; font-size: 16px;">
                <a href="logout.php" class="btn btn-blue square-btn-adjust">Déconnexion</a>
				</div>
					<?php } ?>
            

        </nav>   
           <!--  NAV BAR  -->
            <nav class="navbar-default navbar-side">
                <div class="sidebar-collapse">
                    <ul class="nav" id="main-menu">

                        <li class="text-center">
							<!-- Affichage de bouton en fonction d'ue connexion ou non -->
							<?php if (empty($_SESSION)){?>
                            <img src="assets/img/money.png" class="user-image img-responsive" alt="Money"/>
                            <?php } ?>
                            <?php if(!empty($_SESSION)){ ?>
                            <img src="assets/img/find_user.png" class="user-image img-responsive" alt="User"/>
                            <?php } ?>
                        </li>
                        <li  >
                            <a  class="active-menu" href="home.php"><i class="fa fa-home fa-3x"></i> Accueil</a>
                        </li>
                        <?php if (!empty($_SESSION)){?>
                        <li>
                            <a  href="paris.php"><i class="fa fa-trophy fa-3x"></i> Paris</a>
                        </li>	
                         <?php } ?>
                         <?php if (empty($_SESSION)){?>
                        <li>
                            <a   href="login.php"><i class="fa fa-sign-in fa-3x"></i> Connexion</a>
                        </li>	
                        <?php }?>
                        <?php if (!empty($_SESSION)){?>		                   
						<li>
                            <a  href="profil.php"><i class="fa fa-user fa-3x"></i> Profil</a>
                        </li>  
                        <?php }?>	
                    </ul>
               
                </div>
            
            </nav>  
        <!-- /. NAV SIDE  --> 
        <div id="page-wrapper" >
            <div id="page-inner">
				<!-- Page Content -->
				<div class="container">

					<!-- Marketing Icons Section -->
					<div class="row">
						<div class="col-lg-12">
							<h1 class="page-header" id="title">
								<span style="color:red;">Bienvenue BetterBets</span> 
							</h1>
						</div>
					</div>	
					<!-- ROW-->
					<div class="row">
						<div class="col-md-4">
							<div class="panel panel-default">
								<div class="panel-heading">
									<h4><i class="fa fa-fw fa-check"></i> Un site révolutionnaire, vous allez aimer</h4>
								</div>
								<div class="panel-body">
									<p>BetteBets est un site de pari sportif en ligne qui se veut simple <br /><br /></p>
									
								</div>
							</div>
						</div>
						<div class="col-md-4">
							<div class="panel panel-default">
								<div class="panel-heading">
									<h4><i class="fa fa-fw fa-gift"></i> Divers paris, il y en a pour tous et 50 euros offerts à l'inscription</h4>
								</div>
								<div class="panel-body">
									<p>Avec BetterBets c'est 50 euros offert dès l'inscription. Nous pensons à vous. Inscrivez-vous</p>
									
								</div>
							</div>
						</div>
						<div class="col-md-4">
							<div class="panel panel-default">
								<div class="panel-heading">
									<h4><i class="fa fa-fw fa-compass"></i> Facile à utiliser <br /> <br /></h4>
								</div>
								<div class="panel-body">
									<p>Un site conçu pour trouver ce dont vous avez besoin <br /><br /></p>
								</div>
							</div>
						</div>
					</div>
					<!-- END ROW-->

			
					<div class="row">
						<div class="col-lg-12">
							<h2 class="page-header">Votre sport</h2>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6 col-sm-6">
							<a href="portfolio-item.html">
								<img class="img-responsive img-portfolio img-hover" src="assets/img/image_basket_home.jpg" alt="basket1">
							</a>
						</div>
						<div class="col-md-6 col-sm-6">
							<a href="portfolio-item.html">
								<img class="img-responsive img-portfolio img-hover" src="assets/img/rugby.jpg" alt="rugby">
							</a>
						</div>
					 
					</div>
			
					<!-- ROW-->
					<div class="row">
						<div class="col-lg-12">
							<h2 class="page-header">Les règles</h2>
						</div>
					</div>	
					<div class="row">
						<div class="col-md-6">
							<p>Les étapes à suivre pour pouvoir utiliser notre site:</p>
							<ul>
								<li><strong>S'inscrire</strong>
								</li>
								<li>Avoir la majorité</li>
								<li>Ne pas avoir été interdit de jeu</li>
								<li>Se connecter</li>
								<li>Créditer de l'argent</li>
								<li>Parier</li>
							</ul>
							<p>Si vous avez des questions ou un problème veuillez contacter le service client à l'adresse suivant : request@betterbets.com</p>
						</div>
						<div class="col-md-6">
							<img class="img-responsive" src="assets/img/riche.jpg" alt="riche">
						</div>
					</div>
					<!-- END ROW-->

					<hr>

					<div class="well">
						<div class="row">
							<div class="col-md-8">
								<p>Problème d'addiction ?</p>
							</div>
							<div class="col-md-4">
								<a class="btn btn-lg btn-default btn-block" href="http://www.aide-info-jeu.fr/page_engager_demarche_soins.html">Besoin d'aide</a>
							</div>
						</div>
					</div>

					<hr>


				</div>
				<!-- END CONTAINER -->


                <hr />
            
        
            </div><!-- END PAGE INNER  -->  
        </div><!-- END PAGE WRAPPER  -->     
    </div><!-- END BODY WRAPPER  -->   
</body>
</html>
