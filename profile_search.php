<?php require("../common.php");
$searchdata = $_REQUEST['username'];

$query = "
	SELECT username,id
	FROM morten_users
	WHERE
	username = :username
	";

$query_params = array( 
            ':username' => $searchdata 
        ); 
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

$row = $stmt->fetch();
		$id=$row['id'];

if ($row->num_rows == 1){
	// Retrieve results (if any)
		die('<meta http-equiv="refresh" content="0; url=profile.php?id='.$id.'">');
}

else {

	die('<meta http-equiv="refresh" content="0; url="members.php?searchdata='.$searchdata.'">');
}