<?php
include("fonctions.php");
session_start();
if (!empty($_SESSION)) {
	$pseudo = $_SESSION['pseudo'];
	$id_user = $_SESSION['id_user'];
}else{

	header('Location: ./login.php');
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

<!-- recup_pari -->
<?php 

if(isset($_GET['id_bet'])){
	
		$data=recup_issue_bet($_GET['id_bet']);
		// on recupere les données d'un pari pour un utilisateur
		$data_bet=recup_bet_id($_GET['id_bet']);
		// on recupere les données d'un pari pour un utilisateur, pas dans la meme table (table bet), quelques infos en plus
		
		$date=$data_bet['date'];
		$sport=$data_bet['sport'];
		$odds=$data_bet['odds'];
		$match=$data_bet['game'];
		$id_game=$data_bet['id_game'];
		
		
		$id_bet=$data['id_bet'];
		$issue_match=$data['issue'];
		
		
		$money = get_money($id_user);
		//on recupere les variables dont on a besoin pour miser sur un pari
		

}

?>

<?php 
if(isset($_POST['stake']) ){
	$stake=$_POST['stake'];
	$gain=($odds * $stake);
	
	//On recupere la mise et on definit le gain
	
	if(isset($_POST['confirm']) && $money > $stake){
		//on ajoute le paris
		add_line_into_lbu($id_user,$id_bet,$stake,$gain,$id_game);
		$debit_money = get_money($id_user) - $stake;
		add_money($id_user, $debit_money);
		// on ajoute le parieur au nombre de parieur quand il confirme sa mise
		$inc_gambler = get_gambler($id_bet) + 1 ;
		add_gambler($inc_gambler,$id_bet);
		odds_change($id_game);
		
		//on incrémente apres la confirmation d'un pari le nombre de parieur et on et à jour les cotes

	}

}




?>



<body>
    <div id="wrapper">
        <nav class="navbar navbar-default navbar-cls-top " style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse"></button>
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
                            <a  href="profil.php"><i class="fa fa-user fa-3x"></i> Profil</a>
                        </li>
                        <li>
                            <a class="active-menu"  href="paris.php"><i class="fa fa-trophy fa-3x"></i> Paris</a>
                        </li>	
			                   

                    </ul>
               
                </div>
            
            </nav>  
        
        <!-- /. NAV SIDE  -->
        <div id="page-wrapper" >
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                     <h2>Miser et gagner !</h2>   
                         <br/>
                    </div>
                </div>
	
				<div class="row">
				<div class="col-md-12">
                  <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover">
                            <thead>
                                <tr>          
                                    <th class="text-center">Sport</th>
                                    <th class="text-center">Match</th>
                                    <th class="text-center">Date</th>
                                    <th class="text-center">Pariez sur la</th>
                                    <th class="text-center">Cote</th>
                                    <th class="text-center">Mise</th>
                                    <th class="text-center">Gain Potentiel</th>                           
                                </tr>
                            </thead>
                            <tbody>
                                <tr >
                                    <td class="text-center"> <? echo $sport ?></td>
                                    <td class="text-center"><? echo $match ?></td>
                                    <td class="text-center"><? echo $date ?></td>
                                    <td class="text-center"><? echo $issue_match ?></td>
                                    <td class="text-center"><? echo $odds ?></td>
                                    <td class="text-center">
                                        
                                            <form class="form-inline" method="post" >
                                            <div class="form-group">
                                                <?php if(test_already_bet($id_user,$id_bet) == 0){ ?>
													<div class="input-group">
														<div class="input-group-addon">€</div>
														<input type="number" min=0 class="form-control" name="stake" placeholder="Gain">
													</div>	
														<button type="submit" class="btn btn-primary">Afficher Gain Potentiel</button>
														
													<?php
														  if(isset($_POST['confirm']) && $money < $stake){
															   echo "Vous n'avez pas assez de crédits, votre pari n'a pas été pris en compte";
															   
														  }
														   else{
															 echo '<button type="submit" class="btn btn-primary" name="confirm">Confirmer Mise</button>';
														   }
													   }
													   else {
														   echo "Votre mise a été prise en compte. Vous avez effectué un pari sur ce résultat";
														   	 echo '<button class="btn btn-primary disabled" type="submit">Vous avez misé.</button>';
															
														
													   }
                                                ?>
                                            </div>
                                            </form>
                                       
                                    </td>
                                    <td class="text-center"><? if(isset($_POST['confirm']) || isset($_POST['stake'])) { echo $gain; }?> €</td>
                                </tr>
                            </tbody>
                        </table>
                  </div>
                </div>
				</div>	
                </div><!-- END ROW  -->
        
            </div><!-- END PAGE INNER  -->  
        </div><!-- END PAGE WRAPPER  -->     
    </div><!-- END BODY WRAPPER  --> 
</body>
</html>
