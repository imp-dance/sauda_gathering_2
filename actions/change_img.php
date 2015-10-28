<?php    
    include('../../common.php');
    if (empty($_SESSION['user'])){
    	die('<meta http-equiv="refresh" content="0; url=../index.php?login-feil">');
    }
	 $target = "upload/"; 
	 $filename = strtolower(basename( $_FILES['uploaded']['name']));
	 $filename = substr(md5(time()), 0, 5)."-".$filename;
	 $target = $target . $filename; 
	 $ok=1; 
	 
	 //This is our size condition 
	 if ($uploaded_size > 350000) 
	 { 
	 echo "Your file is too large.<br>"; 
	 $ok=0; 
	 } 
	 
	 //This is our limit file type condition 
	 if ($uploaded_type =="text/php") 
	 { 
	 echo "No PHP files<br>"; 
	 $ok=0; 
	 } 
	 
	 //Here we check that $ok was not set to 0 by an error 
	 if ($ok==0) 
	 { 
	 Echo "Sorry your file was not uploaded"; 
	 } 
	 
	 //If everything is ok we try to upload it 
	 else 
	 { 
	 if(move_uploaded_file($_FILES['uploaded']['tmp_name'], $target)) 
	 { 
	 	$query = " 
            UPDATE morten_users 
            SET 
                img = :img 
            WHERE 
                id = :user_id 
        "; 
        $query_params = array( 
            ':img' => "actions/".$target, 
            ':user_id' => $_SESSION['user']['id']
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

	 echo '<meta http-equiv="refresh" content="0; url=../edit_account.php?up=true">'; 
	 } 
	 else 
	 { 
	 echo "Sorry, there was a problem uploading your file."; 
	 } 
	 } 

?>