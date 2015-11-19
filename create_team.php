<?php
include('../common.php');
if (isset($_POST)){
	if (empty($_SESSION['user'])){
		die("Hmf.");
	}
	$teamname = $_POST['teamname'];
	$players = $_SESSION['user']['id'];
	$joinid = $_POST['turnid'];
	/* Sjekk om typen har lagt team før */
		$checkifonly = "SELECT * FROM sg_turn_teams WHERE joinid = :joinid AND owner = :ownerid";
		$params = array(
			":joinid" => $joinid,
			":ownerid" => $_SESSION['user']['id']
		);

		try{
		$stmt = $db->prepare($checkifonly);
		$result = $stmt->execute($params);
		}
		catch(PDOException $ex){
			die("Failed to run query #1: " . $ex->getMessage());
		}
		$row = $stmt->fetchAll();
		if (count($row) > 0){
			die("Du har allerede ett team!".$row['teamname']);
		}
	/* Sjekk om typen er i ett team fra før */
		$checkifonlytwo = "SELECT * FROM sg_turn_teams WHERE joinid = :joinid";
		$paramstwo = array(
			":joinid" => $joinid
		);
		try{
		$stmttwo = $db->prepare($checkifonlytwo);
		$resulttwo = $stmttwo->execute($paramstwo);
		}
		catch(PDOException $ex){
			die("Failed to run query #2: " . $ex->getMessage());
		}
		$rowtwo = $stmttwo->fetchAll();
		$isin = 0;
		foreach ($rowtwo as $row){

			// Looping every team in turnament

			$teamid = $row['id'];

			$checkifin = "SELECT * FROM sg_turn_teams WHERE joinid = :joinid";
			$params = array(
				":joinid" => $teamid
			);
			try{
				$stmt = $db->prepare($checkifin);
				$result = $stmt->execute($params);
			}
			catch(PDOException $ex){
				die("Failed to run query #3: " . $ex->getMessage());
			}
			$isin = $stmt->fetch();
			if (count($isin) > 0){
				$isin++;
			}
		}
		if ($isin > 0){
			die("Inni team! ".$isin);
		}
	/* Slutt error check 
	Nå vill me legga inn det nye teamet,
	*/
	$q = "INSERT INTO sg_turn_teams (
		teamname,
		joinid,
		owner) VALUES (
		:teamname,
		:joinid,
		:owner)";
	$qparams = array(
		":teamname" => $teamname,
		":joinid" => $joinid,
		":owner" => $_SESSION['user']['id']
		);
	try { 
        // Execute the query to create the user 
        $qstmt = $db->prepare($q); 
        $qresult = $qstmt->execute($qparams); 
    } 
        catch(PDOException $ex) 
    {
        die("Failed to run query #4: " . $ex->getMessage()); 
    } 
    /* Få siste id */
    $getlastid = "SELECT * FROM sg_turn_teams WHERE teamname = :teamname ORDER BY id ASC";
    $params = array(
    	":teamname" => $teamname
    	);
    try { 
        // Execute the query to create the user 
        $stmt = $db->prepare($getlastid); 
        $result = $stmt->execute($params); 
    } 
        catch(PDOException $ex) 
    {
        die("Failed to run query #4: " . $ex->getMessage()); 
    } 
    $row = $stmt->fetch();
    $teamids = $row['id'];

    /* Så legg in player */
    $q = "INSERT INTO sg_turn_players (
		playerid,
		teamid) VALUES (
		:playerid,
		:teamid)";
	$qparams = array(
		":playerid" => $_SESSION['user']['id'],
		":teamid" => $teamids
		);
	try { 
        // Execute the query to create the user 
        $qstmt = $db->prepare($q); 
        $qresult = $qstmt->execute($qparams); 
    } 
        catch(PDOException $ex) 
    {
        die("Failed to run query #4: " . $ex->getMessage()); 
    } 
    die('<meta http-equiv="refresh" content="0; url=tournament.php?id='.$joinid.'">');
}	// isset post
?>