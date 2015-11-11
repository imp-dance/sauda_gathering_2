<?php
include('../common.php');
    $id = $_REQUEST['id'];

    $gettype = "SELECT * FROM sg_turn WHERE id = :id";
    $params = array(":id" => $id);
    try { $stmt = $db->prepare($gettype); $result = $stmt->execute($params); }catch(PDOException $ex){die("Failed to run query");}
    $turndata = $stmt->fetch();
    $turntype = $turndata['type'];
    switch ($turntype){
        case "single elimination":
            singleEl($db, $id);
        break;
        case "double elimination":
            doubleEl($db, $id);
        break;
        case "boiloff":
            boiloff($db, $id);
        break;
    }
    /* GROUP UP */

        // Get all teams where joinid is id
    

        //Check if no results
    /*if (empty($rows)){die("empty");}
    
        //Set up for grouping
    /*
    $numrows = count($rows);
    $groupcount = 1;
    $groupnames = array();
    $groupids = array();
    $groupid = 0;
    $teamname;
    $numrowsminus = $numrows - 3;
        //Loop for 
    foreach($rows as $row){
        if ($numrows % 2 == 0) {

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

    foreach ($groupnames as $row):
    $turnid = $id;
    $bracket = 2;
    $firstteam = $row[0];
    $secondteam = $row[1];
    $firstteamscore = 0;
    $secondteamscore = 0;
    $finished = 0;

    echo("<br /><br />Turnid:".$turnid."<br />Bracket:".$bracket."<br />Firstteam:".$firstteam."<br />Second team:".$secondteam."<br />");
    endforeach;
    */    

    function singleEl($db, $id){
        $getteams = "SELECT * FROM sg_turn_teams WHERE joinid = :joinid ORDER BY rand()";
        $paramss = array(":joinid" => $id);
        try { 
            $stmt = $db->prepare($getteams); 
            $result = $stmt->execute($paramss); 
        }catch(PDOException $ex){
            die("Failed to run query");
        }
        $rows = $stmt->fetchAll();
}


    function doubleEl($db, $id){
    	/*
			Alle spiller først, taper spiller mot hverandre etterpå, så vinnere.
    	*/
        $getteams = "SELECT * FROM sg_turn_teams WHERE joinid = :joinid ORDER BY rand()";
        $paramss = array(":joinid" => $id);
        try { 
            $stmt = $db->prepare($getteams); 
            $result = $stmt->execute($paramss); 
        }catch(PDOException $ex){
            die("Failed to run query");
        }
        $rows = $stmt->fetchAll();
        $numrows = count($rows);
        $numrowss = $numrows - 1;
        $groupcount = 1;
        $groupnames = array();
        $groupids = array();
        $groupbracket = array();
        $groupid = 0;
        $teamname;

        $odde = 0;
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
                /* ODDETAL */
                if ($odde < $numrowss){
                    if ($groupcount == 1){
                        $teamname = $row['teamname'];
                        $groupcount++;
                    }else{
                        $groupid = $groupid + 1;
                        $team = array($row['teamname'], $teamname);
                        array_push($groupnames,$team);
                        array_push($groupids, $groupid);
                        array_push($groupbracket, 1);
                        $groupcount = 1;
                        /* INSERT MATCH/GROUP INTO DB */
                        $insq = "INSERT INTO sg_turn_groups (turnid, bracket, firstteam, secondteam) VALUES (:turnid, 1, ':firstteam', ':secondteam')";
                        $parmsa = array(
                            ":turnid" => $id,
                            ":firstteam" => $team[0],
                            ":secondteam" => $team[1]
                            );
                        /* run query */
                    }
                    $odde++;
                    echo("Bracket 1<br />");
                }else{
                /* Now there should be one left */
                    $groupid = $groupid + 1;
                    $teamsarray = array($row['teamname'], "Winner");
                    array_push($groupnames, $teamsarray);
                    array_push($groupbracket, 2); // higher bracket
                    array_push($groupids, $groupid);
                    echo("Bracket 2");

                    /* INSERT MATCH/GROUP INTO DB */
                    $insq = "INSERT INTO sg_turn_groups (turnid, bracket, firstteam, secondteam) VALUES (:turnid, 2, ':firstteam', ':secondteam')";
                    $parmsa = array(
                        ":turnid" => $id,
                        ":firstteam" => $row['teamname'],
                        ":secondteam" => "Winner"
                    );
                    /* run query */
                }
            }
        }
        foreach ($groupnames as $row):
        $turnid = $id;
        $bracket = 2;
        $firstteam = $row[0];
        $secondteam = $row[1];
        $firstteamscore = 0;
        $secondteamscore = 0;
        $finished = 0;

        echo("<br /><br />Turnid:".$turnid."<br />Bracket:".$bracket."<br />Firstteam:".$firstteam."<br />Second team:".$secondteam."<br />");
        endforeach;
    }
    function boiloff($db, $id){
    	/*
			Alle i ein bracket, mot hverandre - taper detter ut
    	*/
    }


?>