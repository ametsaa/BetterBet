<?php
session_start();
include("fonctions.php");
if (!empty($_SESSION)) {
	$pseudo = $_SESSION['pseudo'];
	$email = $_SESSION['email'];
	$money = $_SESSION['money'];
	$first_name = $_SESSION['first_name'];
	$last_name = $_SESSION['last_name'];
    $address = $_SESSION['address'];
	$id_user = $_SESSION['id_user'];
}else{

	header('Location: ./login.php');
}

?>
<?php 
//on recupere les paris d'un utilisateur
$datas=recup_bet_user($id_user); 
$total = nb_paris($id_user);
?>
<?php
	if(isset($_POST['moneyin']) && isset($id_user)){									
        $moneyin = get_money($id_user) + $_POST['moneyin'];
        add_money($id_user, $moneyin);
	}
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
                <button class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse"></button>
                <a class="navbar-brand" href="profil.php">BetterBets</a> 
            </div>
            <div style="color: white; padding: 15px 50px 5px 50px; float: right; font-size: 16px;">
                <a href="logout.php" class="btn btn-blue square-btn-adjust">Déconnexion</a>
            </div>
        </nav>   
           <!--  NAV BAR  -->
            <nav class="navbar-default navbar-side">
                <div class="sidebar-collapse">
                    <ul class="nav" id="main-menu">

                        <li class="text-center">
                            <img src="assets/img/find_user.png" class="user-image img-responsive" alt="Profil"/>
                        </li>
                        <li  >
                            <a   href="home.php"><i class="fa fa-home fa-3x"></i> Accueil</a>
                        </li>
                        <li>
                            <a  href="paris.php"><i class="fa fa-trophy fa-3x"></i> Paris</a>
                        </li>	
                        <li>
                            <a  class="active-menu" href="profil.php"><i class="fa fa-user fa-3x"></i> Profil</a>
                        </li>  

                    </ul>
               
                </div>
            
            </nav>  
        <!-- /. NAV SIDE  --> 
        <div id="page-wrapper" >
            <div id="page-inner">
                <!-- ROW  -->
                <div class="row">
                    <div class="col-md-12">
                     <h2>Bienvenue <?php echo $pseudo ?></h2>   
                     <h5>Content de vous revoir.</h5>
                    </div>
                </div>              
                 <!-- END ROW  -->
                <hr />
                
                <!--  ROW  Box information-->
                <div class="row"> 
                    <div class="col-md-4 col-sm-6 col-xs-6">           
			             <div class="panel panel-back noti-box">
                            <span class="icon-box bg-color-red set-icon">
                                <i class="fa fa-cubes"></i>
                            </span>
                         <div class="text-box" >
                             <p class="main-text"><a class="no-link" href="#bet"> Paris Efféctués</a></p>
                            <p class="text">Total: <?php echo $total  ?></p>
                         </div>
                        </div>
                    </div>

                    <div class="col-md-4 col-sm-6 col-xs-6">          
                        <div class="panel panel-back noti-box">
                            <span class="icon-box bg-color-red set-icon">
                                <i class="fa fa-euro"></i>    
                            </span>
                        <div class="text-box" >
                         <p class="main-text">Créditez Donc!</p>
                         </div>
		                <form class="form-inline" method="post">
						   <div class="form-group">
                                <div class="input-group col-md-8">
                                    <div class="input-group-addon">€</div>
                                    <input type="number" min="0" class="form-control" name="moneyin">
                                </div>
                               <div  class="text-center col-md-4"><button type="submit" class="btn btn-blue">Confirmer</button></div>
								<?php if(isset($_POST['moneyin']) && isset($id_user)){ ?>
									<div class="alert alert-success">
									   <span>Vous avez crédité <?php echo $_POST['moneyin'] ?> euros sur votre compte.</span>
									</div>
								<?php }?>	
				            </div>
						</form>
                        
						</div>
					</div>
					
					<div class="col-md-4 col-sm-6 col-xs-6">           
                        <div class="panel panel-back noti-box">
                            <span class="icon-box bg-color-red set-icon">
                                <i class="fa fa-bars"></i>
                            </span>
                            <div class="text-box" >
                                <p class="main-text">Crédit Actuel</p>
                                <p class="text"><br /><?php echo get_money($id_user) ?></p>
                            </div>
                         </div>
                    </div>
		     
					
                </div>
                <!-- END ROW -->
				<hr>
			   
			
		     <!-- ROW Affichage personnel-->
			  <div class="row">
				<div class="col-md-12">
					<div class="panel-body">
					  <div class="row">
						<div class="col-md-12 lead">Informations Personnelles<hr></div>
					  </div>
					  <div class="row">
						<div class="col-md-4 text-center">
						  <img class="img-circle avatar avatar-original" style="-webkit-user-select:none; 
						  display:block; margin:auto;" src="assets/img/find_user.png" alt="Profil">
						</div>
						<div class="col-md-8">
						  <div class="row">
							<div class="col-md-12">
							  <h1 class="only-bottom-margin"><?php echo $pseudo ?></h1>
							</div>
						  </div>
						  <div class="row">
							<div class="col-md-6">
							  <span class="text-muted">Prénom</span> <?php echo $first_name ?><br>
							  <span class="text-muted">Nom</span> <?php echo $last_name ?><br>
							  <span class="text-muted">Email:</span> <?php echo $email ?><br>
							  <span class="text-muted">Adresse</span> <?php echo $address ?><br>
							  <span class="text-muted">Argent</span> <?php echo get_money($id_user) ?><br>
							</div>
						  </div>
						</div>
					  </div>
					</div>
				 </div>
              </div>
              <!-- END ROW -->

			
                 <!-- ROW Tableau des paris actuels -->
                <hr />
                <span id="bet"></span>
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">  
				        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h2 class="text-center"> Mes Paris </h2>
                            </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover">
                                    <thead>
                                        <tr>          
                                            <th class="text-center">Choix</th>
                                            <th class="text-center">Mise</th>
                                            <th class="text-center">Gain Potentiel</th>
                                            <th class="text-center">Cote</th>
                                            <th class="text-center">Fin du Match</th>
                                            <th class="text-center">Résultats</th> 
                                            <th class="text-center">Annuler le pari</th>                           
                                        </tr>
                                    </thead>
                                    <tbody>  <!-- On affiche chaque sport  -->
                                       <?php  foreach ($datas as $data) { ?>          
                                        <tr >
                                            <td class="text-center"> <? echo $data['issue']; ?></td>
                                            <td class="text-center"><? echo $data['stake']; ?></td>
                                            <td class="text-center"><? echo $data['gain']; ?></td>
                                            <td class="text-center"><? echo $data['odds']; ?></td>           
                                            <td class="text-center">
													<?php 
													//la valeur end-pari est a 0 tant que l'on a pas simulé le pari, ensuite elle prend la valeur 1
													if ($data['end_bet'] == 0){ ?>
														<form class="form-inline" method="post" >
															<button type="submit"  name="<?php echo $data['id_bet']; ?>" class="btn btn-blue">Fin Pari</button>
														</form>  
													</td>						
													<td class="text-center">
													  <?php if (isset($_POST[''.$data['id_bet']]) ) {
																echo $data['result'];
																update_end_bet($id_user,$data['id_bet']);
															   
																if (win($data['id_bet']) == 1){
																	$new_money = get_money($id_user) + $data['gain'];
																	add_money($id_user, $new_money);
																} 
															 }
																
															}
													else { ?>
														<form class="form-inline" method="post" >
															<button type="submit" class="btn btn-blue disabled">Fin Pari</button>
														</form>  
                                            </td>	
														
											<td class="text-center"><?php echo $data['result']; }  ?></td>
											<td class="text-center">
												<form class="form-inline" method="post" >
													<button type="submit" name=" <?php echo "1"; echo $data['id_bet'];  ?>" class="btn btn-blue">Annuler Pari</button>
												</form> 
													 <?php //on ne peut annuler un paris que si end_bet est a zero il fauta ctualiser la page pour voir l'annulation
														$end_bet = get_end_bet($id_user,$data['id_bet']); 
													 if (isset($_POST['1'.$data['id_bet']]) && $end_bet['end_bet'] == 0 ){
														delete_bet_into_lbu($id_user,$data['id_bet']);
													 } 
												?>
											</td>
                                        </tr>
									   <?php }?>                                  
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        </div>
                    </div>
                </div><!-- END ROW  -->
        
            </div><!-- END PAGE INNER  -->  
        </div><!-- END PAGE WRAPPER  -->     
    </div><!-- END BODY WRAPPER  -->   
</body>
</html>
