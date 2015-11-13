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


    $getteams = "SELECT * FROM sg_turn_teams WHERE joinid = :turnid";
    $params = array(
        ":turnid" => $turn_id
    );
    try { 
        $stmt = $db->prepare($getteams); 
        $resultabc = $stmt->execute($params); 
    } 
        catch(PDOException $ex) {
        die("Failed to run query: " . $ex->getMessage()); 
    }
    $rows = $stmt->fetchAll();
    $numrows = count($rows);
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

    <div class="container first" style="padding:20px;">
        <div class="hidethisshit">
        <h2>Denne compoen er ikke startet enda</h2>
        <h4>Compoen starter <u><?php echo($month."/".$day." kl ".$time); ?></u></h4>
        <button class="btn btn-default join"><span class="glyphicon glyphicon-chevron-right" style="color:#000;"></span> Bli med på compo <span class="label label-info"><?php echo($numrows); ?></span></button>
        <button class="btn btn-default"><span class="glyphicon glyphicon-play" style="color:#000;"></span> Start compo</button>
        <a href="edit_tournament.php?id=<?php echo($turn_id); ?>"><button class="btn btn-default"><span class="glyphicon glyphicon-pencil" style="color:#000;"></span> Rediger compo</button></a>

<br /><br /></div>
    <div class="teams" style="display:none;">
        <div class="team"><?php if($numrows == 0){ echo("Ingen teams er meldt på enda...<br /><br />"); } ?>
            <div class="btn-group" role="group" aria-label="...">
              <button type="button" class="btn btn-default stepone"><span class="glyphicon glyphicon-arrow-left" style="color:#000;"></span> Tilbake</button>
              <button class="btn btn-success lagteam">Lag team</buton>
        </div>

        </div>
        <?php

        foreach ($rows as $row){
            $teamname = $row['teamname'];
            $players = $row['players'];
            $player = explode(",", $players);
        ?>
            <div class="team">
            <h5><?php echo($teamname); ?></h5>
                <table class="table">
                        <tr>
                            <?php
                            $first = 1;
                                foreach($player as $person){
                            ?>
                            <td><?php 
                            if ($first == 1){
                                echo("<strong>".$person."</strong>");
                            }else{
                                echo($person); 
                            }
                            ?></td>
                            <?php
                                $first = 2;
                                } //foreach
                            ?>
                            <td><button class="btn btn-info">Spør om å bli med</button></td>
                        </tr>
                </table>
            </div>
        <?php
        } // foreach
        ?>
    </div>
    </div> <!-- container -->
    <div class="container second" style="display:none;">
        <h3>Lag team</h3>
        <form action="create_team.php">
        <table class="table" style="width:100%;">
            <tr>
                <td><input type="text" name="teamname" placeholder="Team navn" class="form-control" /></td>
            </tr>
            <tr>
                <td>
                    <div class="btn-group" role="group" aria-label="...">
                      <button class="btn btn-default steptwo moveman" type="button"><span class="glyphicon glyphicon-arrow-left" style="color:#000"></span> Tilbake</button>
                      <button type="submit" class="btn btn-default"><span style="color:#000;" class="glyphicon glyphicon-plus"></span> Lag team</button>
                    </div>
                </td>
            </tr>
        </table>
        </form>
    </div>
</div> <!-- super container -->
<?php include("script.php");
?>
<script>
$(".join").click(function(){
    //$(".teams").slideToggle(200);
    //$(".hidethisshit").slideToggle(200);
    stepTwo();
});
$(".lagteam").click(function(){
    //$(".first").slideUp(200);
    //$(".second").delay(200).slideDown(200);
    stepThree();
});
$(".steptwo").click(function(){
    stepTwo();
});
$(".stepone").click(function(){
    stepOne();
});
function stepOne(){
    $(".second").slideUp(200);
    $(".teams").slideUp(200);
    $(".first").delay(200).slideDown(200);
    $(".hidethisshit").delay(200).slideDown(200);
}
function stepTwo(){
    $(".second").slideUp(200);
    $(".hidethisshit").slideUp(200);
    $(".first").delay(200).slideDown(200);
    $(".teams").delay(200).slideDown(200);
}
function stepThree(){
    $(".first").slideUp(200);
    $(".second").delay(200).slideDown();
}
</script>
<?php
include("footer.php"); ?>