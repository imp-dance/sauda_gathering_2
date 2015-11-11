<?php
include('../common.php');

    /* GROUP UP */

        // Get all teams where joinid is id
    $id = $_REQUEST['id'];
    $getteams = "SELECT * FROM sg_turn_teams WHERE joinid = :joinid ORDER BY rand()";
    $params = array(
    	":joinid" => $id
    );
    try { 
        $stmt = $db->prepare($getteams); 
        $result = $stmt->execute($params); 
    } 
        catch(PDOException $ex) 
    {
        die("Failed to run query: " . $ex->getMessage()); 
    }
        // Check if even or odd
    $rows = $stmt->fetchAll();
    if (empty($rows)){die("empty");}else{}
    $numrows = count($rows);

    $groupcount = 1;
    $groupnames = array();
    $groupids = array();
    $groupid = 0;
    $teamname;

    $numrowsminus = $numrows - 3;


    foreach($rows as $row){
        if ($numrows % 2 == 0) {
            echo($row['teamname']." Even".$groupcount);
            if ($groupcount == 1){
                $teamname = $row['teamname'];
                $groupcount++;
            }else{
                $groupid = $groupid + 1;
                $team = array($row['teamname'], $teamname);
                array_push($groupnames,$team);
                array_push($groupids, $groupid);
                $groupcount = 1;
            }
        }else{

        }
    }
    echo("<br /><br />Groupnames: ");
    print_r($groupnames);
    echo("<br />Groupids:");
    print_r($groupids);
    $newgroups = array(
            "name" => $groupnames,
            "id" => $groupids
        );
    echo("<br /><br />");
    $testid = 1;
    foreach ($groupnames as $row):
        /*
    echo("Game ".$testid.":<br />");
    print_r($row[0]);
    echo(" vs ");
    print_r($row[1]);
    echo("<br />");
    $testid++;*/
    $turnid = $id;
    $bracket = 2;
    $firstteam = $row[0];
    $secondteam = $row[1];
    $firstteamscore = 0;
    $secondteamscore = 0;
    $finished = 0;

    echo("<br /><br />Turnid:".$turnid."<br />Bracket:".$bracket."<br />Firstteam:".$firstteam."<br />Second team:".$secondteam."<br />");
    endforeach;
    /*
    print_r($groupnames[1][0]);
    echo(" vs ");
    print_r($groupnames[1][1]);*/

    

    function singleEl(){
    	/*
			Når team tape, forsvinn
    	*/
    }
    function doubleEl(){
    	/*
			Alle spiller først, taper spiller mot hverandre etterpå, så vinnere.
    	*/
        foreach($rows as $row){
        if ($numrows % 2 == 0) {

            /* PARTAL */ 
            if ($groupcount == 1){
                $teamname = $row['teamname'];
                $groupcount++;
            }else{
                $groupid = $groupid + 1;
                $team = array($row['teamname'], $teamname);
                array_push($groupnames,$team);
                array_push($groupids, $groupid);
                $groupcount = 1;
            }
        }else{
            /* ODDETALL */
        }
    }
    }
    function boiloff(){
    	/*
			Alle i ein bracket, mot hverandre - taper detter ut
    	*/
    }
?>