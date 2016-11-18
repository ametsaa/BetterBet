<?php
//Se connecte à la base
function con() {
  return mysqli_connect('localhost', 'root', '', 'g15');
}



//Ajoute un utilisateur
function ajout_user($prenom, $nom, $pseudo, $address, $money, $email, $password) {
  $db= con();
  $stmt = mysqli_prepare($db, "INSERT INTO User ( first_name, last_name, pseudo, address, money, email, password) VALUES (?,?,?,?,?,?,?)");
  mysqli_stmt_bind_param($stmt, 'ssssiss', $prenom, $nom, $pseudo, $address, $money, $email, $password);
  mysqli_stmt_execute($stmt);
  mysqli_close($db);
}

//Ajoute l'argent souhaite à l'utilisateur
function add_money($id,$money){
  if ($money > 0){
  $db= con();
  $stmt = mysqli_prepare($db, "UPDATE User SET money = ? WHERE id_user = ?");
  mysqli_stmt_bind_param($stmt, 'ii',$money,$id);
  mysqli_stmt_execute($stmt);
  mysqli_close($db);
	}
}

//Récupère l'argent à l'utilisateur
function get_money($id){
    
  $db= con();
  $stmt = mysqli_prepare($db, "SELECT money FROM User WHERE id_user = ?");
  mysqli_stmt_bind_param($stmt, "i", $id);
  mysqli_stmt_execute($stmt);
  mysqli_stmt_bind_result($stmt, $res);
  while(mysqli_stmt_fetch($stmt));
  return $res;
    
}

//Ajoute des parieurs
//Surtout utilisé pour ajouter un nouveau parieur
function add_gambler($inc_gambler,$id_bet) {
	
  $db= con();
  $stmt = mysqli_prepare($db, "UPDATE issue_bet SET nb_gambler = ? WHERE id_bet = ?");
  mysqli_stmt_bind_param($stmt, 'ii',$inc_gambler,$id_bet);
  mysqli_stmt_execute($stmt);
  mysqli_close($db);

}

//Récupère le nombres de parieurs pour une issue d'un match
function get_gambler($id_bet){
    
  $db= con();
  $stmt = mysqli_prepare($db, "SELECT nb_gambler FROM issue_bet WHERE id_bet = ?");
  mysqli_stmt_bind_param($stmt, "i", $id_bet);
  mysqli_stmt_execute($stmt);
  mysqli_stmt_bind_result($stmt, $res);
  while(mysqli_stmt_fetch($stmt));
  mysqli_close($db);
  return $res;
    
}



//Récupere les differents sports du site
function recup_bet_sport() {
		$db = con();
		$res = mysqli_query($db, "select distinct sport from bet");
		mysqli_close($db);
		return $res;
       		
}

//Recupere le nombre de parieur pour un jeu
function recup_gambler_from_game($id_game) {
		$db = con();
		$stmt = mysqli_prepare($db, "SELECT nb_gambler FROM issue_bet WHERE id_game= ?");
		mysqli_stmt_bind_param($stmt, "i", $id_game);
		mysqli_stmt_execute($stmt);
	    $res = mysqli_stmt_get_result($stmt);
		$assoc = mysqli_fetch_all($res, MYSQLI_ASSOC);
	    mysqli_free_result($res);
	    mysqli_close($db);

        return $assoc;	
}

//Recupere les informations de la table id_bet en fonction d'un pari
function recup_issue_bet($id) {
		$db = con();
		$stmt = mysqli_prepare($db, "select * from issue_bet where id_bet= ?");
		mysqli_stmt_bind_param($stmt, "i", $id);
		mysqli_stmt_execute($stmt);
		mysqli_stmt_bind_result($stmt, $data['id_bet'], $data['nb_gambler'], $data['odds'],$data['issue'],$data['result'], $data['win'],$data['id_game']);
		while(mysqli_stmt_fetch($stmt)){
		}		
		return $data;
}


//Verifie un utilisateur 
function test_already_bet($id_user,$id_bet) {
	$db = con();
	$test=0;
	$stmt = mysqli_prepare($db, "select id_bet  from link_bet_user where id_user= ?");
	mysqli_stmt_bind_param($stmt, "i", $id_user);
	mysqli_stmt_execute($stmt);
	mysqli_stmt_bind_result($stmt, $data['id_bet']);
	while(mysqli_stmt_fetch($stmt)){
		if($data['id_bet'] == $id_bet){
			$test=1;
		}
	}		
	return $test;
}


//Met end_bet a 1 dans la base de données
function update_end_bet($id_user,$id_bet) {
	
  $db= con();
  $stmt = mysqli_prepare($db, "UPDATE link_bet_user SET end_bet = 1 WHERE id_bet = ? AND id_user= ?");
  mysqli_stmt_bind_param($stmt, 'ii',$id_bet,$id_user);
  mysqli_stmt_execute($stmt);
  mysqli_close($db);

}

//Récupère end_bet dans la base de données
function get_end_bet($id_user,$id_bet) {
	
  $db= con();
  $stmt = mysqli_prepare($db, "SELECT end_bet FROM link_bet_user WHERE id_bet = ? AND id_user= ?");
  mysqli_stmt_bind_param($stmt, 'ii',$id_bet,$id_user);
  mysqli_stmt_execute($stmt);
  mysqli_stmt_bind_result($stmt, $res['end_bet']);
  while(mysqli_stmt_fetch($stmt));
  mysqli_close($db);
  return $res;
    
}

//récupère les données de bet en fonction de l'id
function recup_bet_id($id) {
	$db = con();
	$stmt = mysqli_prepare($db, "select * from bet where id_bet= ?");
	mysqli_stmt_bind_param($stmt, "i", $id);
	mysqli_stmt_execute($stmt);

	mysqli_stmt_bind_result($stmt, $data['sport'],$data['date'],$data['team'], $data['odds'],$data['id_bet'],$data['game'],$data['id_game'], $data['odd_init']);

	while(mysqli_stmt_fetch($stmt)){
	}
	mysqli_close($db);
	return $data;
		
}

//récupère tous les informations des paris par rapport a un sport dans un tableau associatif
function recup_bet_info_sport($sport) {
	$db = con();
	$stmt = mysqli_prepare($db, "select * from bet where sport= ?");
	mysqli_stmt_bind_param($stmt, "s", $sport);
	mysqli_stmt_execute($stmt);
	$res = mysqli_stmt_get_result($stmt);
	$assoc = mysqli_fetch_all($res, MYSQLI_ASSOC);
	mysqli_free_result($res);
	mysqli_close($db);

	return $assoc;	
	
}

//Recupere les données d'un pari lié à un utilisateur
function recup_bet_user($id) {
		$db = con();
		$stmt = mysqli_prepare($db, "SELECT link.id_bet AS id_bet, stake, gain, odds,link.id_game, end_bet, issue, result FROM link_bet_user AS link, issue_bet WHERE link.id_user= ? AND link.id_bet = issue_bet.id_bet");
		mysqli_stmt_bind_param($stmt, "i", $id);
		mysqli_stmt_execute($stmt);
	    $res = mysqli_stmt_get_result($stmt);
		$assoc = mysqli_fetch_all($res, MYSQLI_ASSOC);
	    mysqli_free_result($res);
	    mysqli_close($db);

        return $assoc;		
}


//renvoie 1 pour l'issue du match et 0 pour les autres resultats
function win($id_bet) {
	  $db= con();
	  $stmt = mysqli_prepare($db, "SELECT win FROM issue_bet WHERE id_bet = ?");
	  mysqli_stmt_bind_param($stmt, "i", $id_bet);
	  mysqli_stmt_execute($stmt);
	  mysqli_stmt_bind_result($stmt, $res);
	  while(mysqli_stmt_fetch($stmt));
	  mysqli_close($db);
	  return $res;
}

//recupere l'odd initial pour un match
function get_odds_gambler_id_bet_from_game($id_game) {
		$db = con();
		$stmt = mysqli_prepare($db, "SELECT DISTINCT issue_bet.nb_gambler, issue_bet.id_bet, odd_init FROM issue_bet, bet WHERE issue_bet.id_game = ? AND bet.id_game = ?");
		mysqli_stmt_bind_param($stmt, "ii",$id_game, $id_game);
		mysqli_stmt_execute($stmt);
	    $res = mysqli_stmt_get_result($stmt);
		$assoc = mysqli_fetch_all($res, MYSQLI_ASSOC);
	    mysqli_free_result($res);
	    mysqli_close($db);

        return $assoc;		
}

//Met à jour la cote
function odds_change($id_game) {
	
	$db= con();
	$datas=get_odds_gambler_id_bet_from_game($id_game);
	$total_gambler=0;
	foreach ($datas as $data) {	
		$total_gambler=$total_gambler+$data['nb_gambler'];
		
	}
	
	
		foreach ($datas as $data) {
		$new_odds=0;
		$K = get_gambler($data['id_bet'])/$total_gambler;
		echo $data['id_bet'];
		echo $data['odd_init'];
		
		$new_odds=1+$data['odd_init']/(bcpow(3*$K, 3, 2));
		if ($new_odds < 1.01){
			$new_odds = 1.01;
		}
		else if ($new_odds > 5){
			$new_odds = 5;
		}

		$stmt = mysqli_prepare($db, "UPDATE  issue_bet AS issue, bet SET issue.odds = ?, bet.odds = ? WHERE bet.id_bet = ? AND issue.id_bet = ?");
		mysqli_stmt_bind_param($stmt, 'ddii',$new_odds,$new_odds,$data['id_bet'],$data['id_bet']);
		mysqli_stmt_execute($stmt);
		
	}
	
	mysqli_close($db);
	
}

//Ajoute le lien entre un parieur et son nouveau pari
//Cela se traduit par l'ajout d'une ligne dans la table link_bet_user
function add_line_into_lbu($id_user,$id_bet,$stake,$gain,$id_game){
  $db= con();
  $stmt = mysqli_prepare($db, "INSERT INTO link_bet_user (id_user,id_bet,stake,gain,id_game) VALUES(?,?,?,?,?)");
  mysqli_stmt_bind_param($stmt, 'iiiii',$id_user,$id_bet,$stake,$gain,$id_game);
  mysqli_stmt_execute($stmt);
  mysqli_close($db);
	
}

//Supprime un pari
function delete_bet_into_lbu($id_user,$id_bet){
	
  $db= con();
  $stmt = mysqli_prepare($db, "DELETE FROM link_bet_user WHERE id_user=? AND id_bet=?");
  mysqli_stmt_bind_param($stmt, 'ii',$id_user,$id_bet);
  mysqli_stmt_execute($stmt);
  mysqli_close($db);
}



// Retourn le nombre de paris en cours de l'utilisateur
function nb_paris($id_user){
	
	$db= con();
	$stmt = mysqli_prepare($db, "SELECT id_bet FROM link_bet_user WHERE id_user=?");
	mysqli_stmt_bind_param($stmt, "i", $id_user);
	mysqli_stmt_execute($stmt);
	mysqli_stmt_store_result($stmt);
	$nb = mysqli_stmt_num_rows($stmt);
	return $nb;
}
?>
