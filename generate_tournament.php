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


    /*

    ///SINGLE ELIMINATION///

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

    /*

    ///DOUBLE ELIMINATION///

    */

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
        $rows = $stmt->fetchAll(); // fetch information from query
        $numrows = count($rows); // used for even numbers
        $numrowss = $numrows - 1; // used for odd numbers
        $groupcount = 1; // counter
        $groupnames = array(); // names of teams in array [][]
        $groupids = array(); // which id
        $groupbracket = array(); // which bracket
        $groupid = 0; // count 1 every other
        $teamname; // updated every other to store one team's name
        $odde = 0; // counter

        foreach($rows as $row){ // for every team that is in this tournament
            if ($numrows % 2 == 0) { // if even
                /* PARTAL */ 
                if ($groupcount == 1){
                    $teamname = $row['teamname']; // store first team
                    $groupcount++;
                }else{ // every other
                    $groupid = $groupid + 1;
                    $team = array($row['teamname'], $teamname); //put last teamname & this teamname in array
                    array_push($groupnames,$team); //push teamnames to array
                    array_push($groupids, $groupid); //not really nessecary
                    $groupcount = 1; //reset "every other"
                }

            }else{ // if odd
                /* ODDETAL 
                    Basically do the same until there is one left...
                */
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
                        $insq = "INSERT INTO sg_turn_groups (turnid, bracket, firstteam, secondteam) VALUES (:turnid, :bracket, :firstteam, :secondteam)";
                        $parmsa = array(
                            ":turnid" => $id,
                            ":firstteam" => $team[0],
                            ":secondteam" => $team[1],
                            ":bracket" => 1
                            );
                        /* run query */
                        try { 
                            $stmt = $db->prepare($insq); 
                            $result = $stmt->execute($parmsa); 
                        }catch(PDOException $ex){
                            die("Failed to run query" . $ex->getMessage());
                        }
                    }
                    $odde++;
                    echo("Bracket 1<br />");
                }else{
                /* Now there should be one left */
                    $groupid = $groupid + 1;
                    $teamsarray = array($row['teamname'], "Winner"); //this match should be $teamname vs undefined - the winner of a previous match.
                    array_push($groupnames, $teamsarray);
                    array_push($groupbracket, 2); // higher bracket
                    array_push($groupids, $groupid);
                    echo("Bracket 2");

                    /* INSERT MATCH/GROUP INTO DB */
                    $insq = "INSERT INTO sg_turn_groups (turnid, bracket, firstteam, secondteam) VALUES (:turnid, :bracket, :firstteam, :secondteam)";
                    $parmsa = array(
                        ":turnid" => $id,
                        ":firstteam" => $row['teamname'],
                        ":secondteam" => "Winner",
                        ":bracket" => 2
                    );
                    /* run query */
                    try { 
                        $stmt = $db->prepare($insq); 
                        $result = $stmt->execute($parmsa); 
                    }catch(PDOException $ex){
                        die("Failed to run query");
                    }

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


    /*

    ///BOILOFF///

    */

    function boiloff($db, $id){
    	/*
			Alle i ein bracket, mot hverandre - taper detter ut
    	*/
    }


?>