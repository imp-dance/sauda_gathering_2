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
<style>
.tournament-list{
    list-style:none;
    margin:10px 0;
    padding:0 0;
}
.tournament-list li, .tournament-list li a{
    display:block;
}
.tournament-list li a{
    padding:10px;
    background:#eee;
    font-size:22px;
    color:#000;
    border-bottom:1px solid #aaa;
}
.tournament-list li a:hover{
    background:#d9d9d9;
    text-decoration:none;
}
</style>
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
                <?php foreach($rows as $row): ?> 
                    <li>
                        <a href="tournament.php?id=<?php echo($row['id']); ?>">
                            <?php echo($row['name']); ?>
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>
</div> <!-- super container -->
<?php include("script.php");
include("footer.php");