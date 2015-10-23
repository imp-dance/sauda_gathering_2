<?php include("head.php");
$currentid = htmlentities($_REQUEST['id']);
if (empty($currentid)){
	$currentid = $_SESSION['user']['id'];
}
$gitinfoq = " 
                SELECT 
		            id, 
		            username, 
		            email 
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
         			<td class="uimgt"><a href="https://en.gravatar.com/"><img src="<?php echo($grav_url); ?>" target="_BLANK" alt="" /></a></td>
         			<td class="unamet"><h3><?php echo($cuname); ?></h3></td>
         		</tr>
         		<tr>
         			<td colspan="2">
         				<!-- Start HTML Code --><iframe WIDTH="200" HEIGHT="400" title="Shoutbox" src="http://shoutbox.widget.me/window.html?uid=sgq4mxwo" frameborder="0" scrolling="auto"></iframe><script src="http://shoutbox.widget.me/v1.js" type="text/javascript"></script><br><a href="http://shoutbox.widget.me" title="Shoutbox Widget">Shout</a><a href="http://shoutbox-tutorials.blogspot.com" title="Shoutbox Tutorials">bo</a><a href="http://www.youtube.com/watch?v=4IBqLxtAbs0" title="Shoutbox Video">x</a><br><!-- End HTML Code -->
         			</td>
         		</tr>
         	</table>
         </div> <!-- container -->
        </div> <!-- jumbotron -->
    <?php include("footer.php") ?>
    <?php include("script.php") ?>
</body>
</html>