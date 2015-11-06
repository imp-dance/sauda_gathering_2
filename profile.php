<?php include("head.php");
$currentid = htmlentities($_REQUEST['id']);
if (empty($currentid)){
	$currentid = $_SESSION['user']['id'];
	die('<meta http-equiv="refresh" content="0;url=profile.php?id='.$currentid.'">
');
}
$gitinfoq = " 
                SELECT 
		            id, 
		            username, 
		            email,
                    img
		        FROM morten_users 
                WHERE 
                    id = :currentid 
            "; 
             
            // Define our query parameter values 
            $query_params = array( 
                ':currentid' => $currentid 
            ); 
            try 
            { 
                // Execute the query 
                $stmt = $db->prepare($gitinfoq); 
                $result = $stmt->execute($query_params); 
            } 
            catch(PDOException $ex) 
            { 
                // Note: On a production website, you should not output $ex->getMessage(). 
                // It may provide an attacker with helpful information about your code.  
                die("Failed to run query: " . $ex->getMessage()); 
            } 
         
    // Finally, we can retrieve all of the found rows into an array using fetchAll 
    $row = $stmt->fetch();

    $cemail = $row['email'];
    $cuname = $row['username'];
    $imgurl = $row['img'];

    if (empty($imgurl)){
        $imgurl = "images/defaultprofil.png";
    }
    
    $email = $cemail;
    $default = "http://www.gravatar.com/avatar/00000000000000000000000000000000";
    $size = 80;
    $grav_url = "http://www.gravatar.com/avatar/" . md5( strtolower( trim( $email ) ) ) . "?d=" . urlencode( $default ) . "&s=" . $size;
    ?>
<body>
    <?php include("header.php") ?>
        <div class="jumbotron">
         <div class="container">
         	<table class="utable">
         		<tr>
         			<td class="uimgt"><a href="#"><img src="<?php echo($imgurl); ?>" alt="" /></a></td>
         			<td class="unamet"><h3><?php echo($cuname); ?></h3></td>
         		</tr>
         		<tr>
         			<td colspan="2">
         				
                    </td>
         		</tr>
         	</table>
         </div> <!-- container -->
        </div> <!-- jumbotron -->
    <?php include("script.php") ?>
    <?php include("footer.php") ?>
</body>
</html>