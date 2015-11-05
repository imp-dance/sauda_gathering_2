<?php include("head.php");
include("header.php");
?>

<?php

$query = "SELECT * FROM sg_turn ORDER BY start DESC";
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
    $rows = $stmt -> fetchAll(); 
?>
<div class="super-container" style="background:#fff;">
<div class="jumbotron">
	<div class="container">
		<h1>Compoer</h1>
	<!--Container end -->
	</div>
</div>
    <!-- Jumbotron end -->

    <div class="container">
        <div class="row">
            <ul class="tournament-list">
                <?php foreach($rows as $row):
                //Her fjerne me alle kolon og gjør all space te bindestrek
                $nospacegame = $row['game'];
                $nospacegame = strtolower($nospacegame);
                $nospacegame = str_replace(" ", "-", $nospacegame);
                $game = $row['game'];
                        switch($game) {
                        case "League of Legends":
                            $theimageurl = "game-league.png";
                            break;
                        case "Counter Strike: Global Offensive":
                            $theimageurl = "game-cs.png";
                            break;
                        case "Rocket League":
                            $theimageurl = "game-rocket.png";
                            break;
                        default:
                            $theimageurl = "game-default.png";
                            break;
                    }
                    ?>
                        <li>
                        <img src="images/<?php echo($theimageurl);?>" />
                            <div>
                                <a href="tournament.php?id=<?php echo($row['id']); ?>" class="gotolink">
                                    <span><?php echo($row['name']); ?></span>
                                </a>
                                <div class="adminlinks">
                                    <a href="#" class="redigerlink">
                                        Rediger
                                    </a>
                                    <a href="#" class="redigerlink">
                                        Tiss
                                    </a>
                                </div>
                             </div>
                        </li>
                    <?php endforeach; ?>
                    </ul>
                </div>
            </div>
            <?php
                include("script.php");
                include("footer.php");
            ?>