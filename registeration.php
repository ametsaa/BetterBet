<?php 
  include("fonctions.php");
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

	<?php
	/////////////// INSCRIPTION ////////////
	if(!empty($_POST)){
		$error=0;
		$db=con();
		$res = mysqli_query($db, 'SELECT email FROM User ');
		while($data = mysqli_fetch_assoc($res)){
			 if($data['email'] == $_POST['email']) {
				 ?>	<div class="alert alert-danger">
					<strong>Cet email est déjà utilisé.</strong> 
				</div><?php 
				 $error=1;
			 }
		 }
		mysqli_close($db);
		
		if(!preg_match('/^[a-zA-Z0-9_]+$/',$_POST['pseudo'])){
			?>	<div class="alert alert-danger">
					<strong>Votre pseudo n'est pas valide.</strong> 
				</div><?php 
			$error=1;
		}
		if (strlen($_POST['password']) < 6 ){
			?>	<div class="alert alert-danger">
						<strong>Votre mot ne passe doit comporter au moins six caractères.</strong> 
					</div><?php 
			$error=1;
		}
		
		if($_POST['password'] != $_POST['vpassword']){
		 		?>	<div class="alert alert-danger">
						<strong>Votre mot ne passe ne correspond pas.</strong> 
					</div><?php 
			$error=1;
		}
		
		if(strlen($_POST['last_name']) < 2){
		 		?>	<div class="alert alert-danger">
						<strong>Votre nom n'est pas supérieur à deux caractères.</strong> 
					</div><?php 
			$error=1;
		}
	
		if($error==0){
			$hash = sha1($_POST['password']);
			ajout_user($_POST['first_name'],$_POST['last_name'],$_POST['pseudo'],$_POST['address'],'0',$_POST['email'],$hash);
			?><div class="alert alert-success">
					<strong>Votre compte a été créé ! </strong>
						</div><?php
						
		}
		else{
		?>
			<div class="alert alert-danger">
			<strong>Votre compte n'a pas été créé</strong>
			</div><?php
		}
	}
	/////////////// FIN INSCRIPTION ////////////
	
	?>
<body class="login-img-body">
    <div class="container">
        <div class="row text-center  ">
            <div class="col-md-12">	
                <br /><br />
                <div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3 col-xs-10 col-xs-offset-1" id="test" >
					<div class="panel panel-default">
						<div class="panel-heading">
								 <h2>Inscription à BetterBets!</h2> 
						</div>
					</div>
                </div></div>
                 <br />
            </div>
        </div>
        
         <div class="row text-center">
 
				          
    
        <div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3 col-xs-10 col-xs-offset-1" id="test" >
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <strong>  Nouvel utilisateur ? Inscrivez-vous ! </strong>  
                    </div>
                    <div class="panel-body">
                        <form role="form" method="post">
                            <br/>
                                <div class="form-group input-group">
                                    <span class="input-group-addon"><i class="fa fa-circle-o-notch"  ></i></span>
                                    <input type="text" class="form-control" name ="first_name"placeholder="Votre Prénom" required />
                                </div>
                                <div class="form-group input-group">
                                    <span class="input-group-addon"><i class="fa fa-circle-o-notch"  ></i></span>
                                    <input type="text" class="form-control" name ="last_name"placeholder="Votre Nom" required />
                                </div>
                             <div class="form-group input-group">
                                    <span class="input-group-addon"><i class="fa fa-tag"  ></i></span>
                                    <input type="text" class="form-control" name="pseudo" placeholder="Votre Pseudo" required />
                                </div>
                                 <div class="form-group input-group">
                                    <span class="input-group-addon">@</span>
                                    <!-- Vérification de la structure d'un mail avec input type="mail" -->
                                    <input type="email" class="form-control" name="email" placeholder="Votre Email" required />
                                </div>
                              <div class="form-group input-group">
                                    <span class="input-group-addon"><i class="fa fa-lock"  ></i></span>
                                    <input type="password" class="form-control" name="password" placeholder="Entrer votre mot de passe" required />
                                </div>
                             <div class="form-group input-group">
                                    <span class="input-group-addon"><i class="fa fa-lock"  ></i></span>
                                    <input type="password" class="form-control" name="vpassword" placeholder="Confirmation du mot de passe" required />
                                </div>
                             <div class="form-group input-group">
                                    <span class="input-group-addon"><i class="fa fa-lock"  ></i></span>
                                    <input type="text" class="form-control" name="address" placeholder="Votre adresse" required />
                                </div>
                             <button type="submit" class="btn btn-success">Envoyer mes informations</button>


                            <hr />
                            Déja Inscrit ?  <a href="login.php" >Connectez vous ici.</a>
                            </form>
                    </div>

                </div>
            </div>
                
                
             
	
                
        </div><!-- row-->
   
	</div><!-- rcontainer-->
   
</body>
</html>
