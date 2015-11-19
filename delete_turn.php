<?php
// First we execute our common code to connection to the database and start the session 
require("../common.php");
include("head.php");

//Declare shit
$id = $_REQUEST['id'];
if(empty($id)){
	die('<meta http-equiv="refresh" content="0; url=tournaments.php">');
}

$query = "
DELETE FROM sg_turn
WHERE id = :delid
"
;

$query_params = array(
	':delid' => $id
	)
;
try 
    { 
        // Execute the query 
        $stmt = $db->prepare($query); 
        $result = $stmt->execute($query_params); 
    } 
    catch(PDOException $ex) 
    { 
        // Note: On a production website, you should not output $ex->getMessage(). 
        // It may provide an attacker with helpful information about your code.  
        die("Failed to run query: " . $ex->getMessage()); 
    }

die('<meta http-equiv="refresh" content="0; url=tournaments.php">');
?>