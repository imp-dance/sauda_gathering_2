<?php include("head.php"); 
    include("header.php"); 

    $turn_id = $_REQUEST['id'];
    if (empty($turn_id)){
        die('<meta http-equiv="refresh" content="0; url=tournaments.php">');
    }
    $getinfo = "SELECT * FROM sg_turn WHERE id = :id";
    $getinfoparams = array(
        ':id' => $turn_id);
    try { 
        // Execute the query to create the user 
            $stmtabc = $db->prepare($getinfo); 
            $resultabc = $stmtabc->execute($getinfoparams); 
    } 
    catch(PDOException $ex) {
            die("Failed to run query: " . $ex->getMessage()); 
    } 
    $row = $stmtabc->fetch();
    if (empty($row)){
        die('<meta http-equiv="refresh" content="0; url=tournaments.php">');
    }
    // Declare shit
    $name = $row['name'];
    $type = $row['type'];
    $game = $row['game'];
    $start = $row['start'];
    $end = $row['end'];
    $rules = $row['rules'];
    $settings = $row['serversettings'];
    $month = substr($start, 5, 2);
    $day = substr($start, 8, 2);
    $time = substr($start, 11, 5);
    include('actions/gametypetoimage.php'); // Gets imageurl in $theimageurl for game types
    ?>
    <?php ?>
<div class="super-container" style="background:#fff;">
<div class="jumbotron">
    <div class="container" style="background:url('images/<?php echo($theimageurl); ?>') top left no-repeat;background-color:#000;">
        <h1 style="font-size:42px;"><?php echo($name); ?></h1>
    <!--Container end -->
    </div>
</div>
    <!-- Jumbotron end -->

    <div class="container" style="padding:20px;">
        <h2>Denne compoen er ikke startet enda</h2>
        <h4>Compoen starter <u><?php echo($month."/".$day." kl ".$time); ?></u></h4>
        <button class="btn btn-default join"><span class="glyphicon glyphicon-chevron-right" style="color:#000;"></span> Bli med på compo <span class="label label-info">2</span></button>
        <button class="btn btn-default"><span class="glyphicon glyphicon-play" style="color:#000;"></span> Start compo</button>
        <button class="btn btn-default"><span class="glyphicon glyphicon-pencil" style="color:#000;"></span> Rediger compo</button>

<br /><br />
    <div class="teams" style="display:none;">
            <div class="team">
            <h5>Team 1</h5>
                <table class="table">
                        <tr>
                            <td>Player 1</td>
                            <td>Player 2</td>
                            <td>Player 3</td>
                            <td>Player 4</td>
                            <td><button class="btn btn-info">Spør om å bli med</button></td>
                        </tr>
                </table>
            </div>
            <div class="team">
            <h5>Team 2</h5>
                <table class="table">
                        <tr>
                            <td>Player 1</td>
                            <td>Player 2</td>
                            <td>Player 3</td>
                            <td><button class="btn btn-info">Spør om å bli med</button></td>
                        </tr>
                </table>
            </div>
    </div>
    </div> <!-- container -->
</div> <!-- super container -->
<?php include("script.php");
?>
<script>
$(".join").click(function(){
    $(".teams").slideToggle();
});
</script>
<?php
include("footer.php"); ?>