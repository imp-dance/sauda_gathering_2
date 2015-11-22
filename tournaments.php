<?php include("head.php");
include("header.php");
if(empty($_SESSION['user']['id'])) {
    die('<meta http-equiv="refresh" content="0; url=login.php">');
}
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
                include('actions/gametypetoimage.php'); // Gets imageurl in $theimageurl for game types
                    ?>
                        <li>
                        <img src="images/<?php echo($theimageurl);?>" />
                            <div>
                                <a href="tournament.php?id=<?php echo($row['id']); ?>" class="gotolink">
                                    <span><?php echo($row['name']); ?></span>
                                </a>
                                <div class="adminlinks">
                                    <a href="edit_tournament.php?id=<?php echo($row['id']); ?>" class="redigerlink">
                                        <span class="glyphicon glyphicon-pencil"></span> Rediger
                                    </a>
                                    <a href="" data-toggle="modal" data-target="#myModal" class="redigerlink">
                                        <span class="glyphicon glyphicon-trash"></span> Slett turnering
                                    </a>
                                    <a href="edit_tournament.php?id=<?php echo($row['id']); ?>" class="redigerlink">
                                        <span class="glyphicon glyphicon-play"></span> Start
                                    </a>
                                </div>
                                <div class="brukerlinks">

                                </div>
                             </div>
                             <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                              <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title" id="myModalLabel">Slett Compo</h4>
                                  </div>
                                  <div class="modal-body">
                                    Er du sikker på ta du vill slette "<?php echo($row['name']); ?>"?
                                  </div>
                                  <div class="modal-footer">
                                    <a href="delete_turn.php?id=<?php echo($row['id']); ?>"><button type="button" class="btn btn-primary">Slett</button></a>
                                  </div>
                                </div>
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