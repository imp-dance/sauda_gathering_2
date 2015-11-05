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
                <li> Årets compoer </li>
                <?php foreach($rows as $row):
                $nospacegame = $row['game'];
                $nospacegame = strtolower($nospacegame);
                $nospacegame = str_replace(" ", "-", $nospacegame);
                ?>
                    <li class="game <?php echo($nospacegame);?>">
                        <a href="tournament.php?id=<?php echo($row['id']); ?>">
                            <?php echo($row['game']); ?>
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>
</div> <!-- super container -->
<?php include("script.php");
include("footer.php");