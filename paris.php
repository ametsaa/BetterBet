<?php
session_start();
include("fonctions.php");
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

<body>
    <div id="wrapper">
        <nav class="navbar navbar-default navbar-cls-top " style="margin-bottom: 0">
            <div class="navbar-header">
                <button class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse"></button>
                <a class="navbar-brand" href="home.php">BetterBets</a> 
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
                            <a class="active-menu" href="paris.php"><i class="fa fa-trophy fa-3x"></i> Paris</a>
                        </li>	
                        <li>
                            <a   href="profil.php"><i class="fa fa-user fa-3x"></i> Profil</a>
                        </li>

                    </ul>
               
                </div>
            
            </nav>  
            <!--  NAV SIDE  -->
                <div id="page-wrapper" >
                    <div id="page-inner">
                        <div class="row">
                            <div class="col-md-12">
                                <h2>Liste des Matchs</h2>   
                                <h5>Content de vous revoir. </h5>
                            </div>
                        </div>
                         <hr />


                     <div class="row">
                        <div class="col-md-12">
                            <div class="btn-group" role="group" aria-label="...">
                                <?php $tmp=recup_bet_sport();
                                    while($sport = mysqli_fetch_assoc($tmp)){ ?>
                                   
                                    <a  class="btn btn-default no-link" href="#<?php echo $sport['sport']; ?>">  <?php echo $sport['sport']; ?> </a>
                                    
                                <?php } ?>
                            </div>
                        </div>
                    </div>			

					<?php  $tmp2=recup_bet_sport();
					while($sport = mysqli_fetch_assoc($tmp2)){ ?>
                    <!-- /. ROW  -->
                    <div class="row">
                        <div class="col-md-12">
                          <!--   TAB -->
                             
                            <div class="panel panel-default">
                                <div class="panel-heading">
									<span id="<?php echo $sport['sport'] ?>"></span>
                                    <h2 class="text-center"> <?php echo $sport['sport'] ?> </h2>
                                </div>
                                <div class="panel-body">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered table-hover">
                                            <thead>
                                                <tr>          
													<th class="text-center">Categorie</th>
                                                    <th class="text-center">Match</th>
                                                    <th class="text-center">Date</th>
                                                    <th class="text-center">Parier sur </th>
                                                    <th class="text-center">Cote</th>
                                                    <th class="text-center">Cliquer ici pour parier</th>                           
                                                </tr>
                                            </thead>
                                            <tbody>
                                               <?php	
                                                $bets = recup_bet_info_sport($sport['sport']);
                                                foreach ($bets as $bet){ ?>
                                                <tr >
													<th class="text-center"> <? echo $bet['sport'] ?></th>
                                                    <td class="text-center"> <? echo $bet['game'] ?></td>
                                                    <td class="text-center"><? echo $bet['date'] ?></td>
                                                    <td class="text-center"><? echo $bet['team'] ?></td>
                                                    <td class="text-center"><? echo $bet['odds'] ?></td>
                                                    <td class="text-center">
                                                        <a class="btn btn-primary" href="stake.php?id_bet=<?php echo $bet['id_bet']; ?>" role="button">Parier</a>
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
                 <?php }?>
        
            </div><!-- END PAGE INNER  -->  
        </div><!-- END PAGE WRAPPER  -->     
    </div><!-- END BODY WRAPPER  --> 
</body>
</html>
