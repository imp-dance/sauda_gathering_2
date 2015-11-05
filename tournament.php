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
    ?>
    <?php ?>
<div class="super-container" style="background:#fff;">
<div class="jumbotron">
    <div class="container">
        <h1><?php echo($name); ?></h1>
    <!--Container end -->
    </div>
</div>
    <!-- Jumbotron end -->

    <div class="container">

    </div>
</div> <!-- super container -->
<?php include("script.php");
include("footer.php"); ?>