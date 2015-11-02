<?php include("head.php");
include("header.php");
?>

<?php

$query = "
		SELECT
	        name, 
	        type, 
	        game, 
	        start, 
	        end, 
	        rules, 
	        serversettings
        FROM sg_turn
	    WHERE
	        name = :name,
	        type = :type,
	        game = :game,
	        start = :start,
	        end = :end,
	        rules= :rules,
	        serversettings= :serversettings
    ";

    $query_params = array(
    	":name" => $name,
    	":type" => $type,
    	":game" => $game,
    	":start" => $start,
    	":end" => $end,
    	":rules" => $rules,
    	":serversettings" => $serversettings
    	);

    try 
    { 
        // These two statements run the query against your database table. 
        $stmt = $db->prepare($query); 
        $stmt->execute(); 
    } 
    catch(PDOException $ex) 
    { 
        // Note: On a production website, you should not output $ex->getMessage(). 
        // It may provide an attacker with helpful information about your code.  
        die("Failed to run query: " . $ex->getMessage()); 
    } 
         
    // Finally, we can retrieve all of the found rows into an array using fetchAll 
    $rows = $stmt -> fetch(); 
?>

<div class="jumbotron">
	<div class="container">
		<h1>Compoer</h1>
	<!--Container end -->
	</div>
	<!-- Jumbotron end -->
</div>
<?php include("script.php");
include("footer.php");