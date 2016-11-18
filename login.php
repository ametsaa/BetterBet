<?php 
  include("fonctions.php");
  ?>
<!DOCTYPE html>

<?php 
	
	if(!empty($_POST)){
		$db=con();
		$res = mysqli_query($db, 'SELECT * FROM User');
		$hash = sha1($_POST['password']);
		while($line = mysqli_fetch_assoc($res)){
			
			if($line['password'] == $hash && $line['email']==$_POST['email']){
				session_start();
				$_SESSION['email'] = $line['email'];
				$_SESSION['money'] = $line['money'];
				$_SESSION['first_name'] = $line['first_name'];
				$_SESSION['last_name'] = $line['last_name'];
				$_SESSION['pseudo'] = $line['pseudo'];
				$_SESSION['address'] = $line['address'];
				$_SESSION['id_user'] = $line['id_user'];
				echo 'Vous etes bien logué';
				header('Location: ./profil.php');
			}
			else {
				echo  '<div class="alert alert-danger">
						<strong>Mauvais login / password. Merci de recommencer</strong> 
					   </div>';
			}
			
		}
		mysqli_free_result($res);
	}   
		
	
?>
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
    <div class="container">
        <div class="row text-center ">
            <div class="col-md-12">
                <br /><br />
                <h2> Connexion</h2>
                <br />
            </div>
        </div>
        
        <div class="row ">
               
              <div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3 col-xs-10 col-xs-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <strong>   Entrer vos identifiants </strong>  
                    </div>
                    <div class="panel-body">
                        <form method="post">
                            <br />
                            <div class="form-group input-group">
                                <span class="input-group-addon"><i class="fa fa-tag"  ></i></span>
                                <input type="email" class="form-control" name="email" placeholder="Votre email " required />
                            </div>
                            <div class="form-group input-group">
                                <span class="input-group-addon"><i class="fa fa-lock"  ></i></span>
                                <input type="password" class="form-control"  name="password" placeholder="Votre Mot de Passe" required />
                            </div>
                            <button type="submit"  class="btn btn-primary ">Connectez vous</button>
                            <hr />
                            <span>Pas encore inscrit ?<a href="registeration.php" > Cliquez ici </a> </span>
                        </form>
                    </div>

                </div>
              </div>
                
                
        </div>
        
    </div>


</body>
</html>
