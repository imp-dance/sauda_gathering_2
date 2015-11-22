<?php include("head.php");
include("header.php");
if(empty($_SESSION['user']['id'])) {
    die('<meta http-equiv="refresh" content="0; url=login.php">');
}
if (!empty($_POST)){
    $error;
    $code;
    $name = $_POST['name'];
    $name = strip_tags($name);
    $type = $_POST['type'];
    $type = strip_tags($type);
    $game = $_POST['game'];
    $game = strip_tags($game);
    $start = $_POST['startdate'];
    $end = $_POST['enddate'];
    $rules = $_POST['rules'];
    $rules = strip_tags($rules);
    $settings = $_POST['serversettings'];
    $settings = strip_tags($settings);
    if (isset($_POST['annetspill'])){
        $game = $_POST['tannetspill'];
        $game = strip_tags($game);
    }


    // Check if gametype is in array

    $typearray = array(
    "single elimination",
    "double elimination",
    "boiloff");

    if (!in_array($type, $typearray)){
        // Hmmmmmmmm
        $error = 1;
        $code = "1 - Invalid type</p>";
    }

    // Check if valid date
/*
    function validateMysqlDate( $date ){ 
    if (preg_match("/^(\d{4})-(\d{2})-(\d{2}) ([01][0-9]|2[0-3]):([0-5][0-9]):([0-5][0-9])$/", $date, $matches)) { 
        if (checkdate($matches[2], $matches[3], $matches[1])) { 
            return true; 
        } 
    } 
    return false; 
    } 

    if (validateMysqlDate($start) == false || validateMysqlDate($end) == false){
        $error = 1;
        $code = "2 - Feil dato format</p>";
    }*/

    if (empty($name) || empty($game) || empty($start) || empty($end)){
        $error = 1;
        $code = "3 - Fyll ut alle felt</p>";    
    }

    if ($error == 1){
        die("<p class='error-code'>Error! Kode ".$code);
    }

    if ($error != 1){

    $query = "INSERT INTO sg_turn (
        name, 
        type, 
        game, 
        start, 
        end, 
        rules, 
        serversettings) VALUES (
        :name,
        :type,
        :game,
        :start,
        :end,
        :rules,
        :serversettings)";
    $query_params = array( 
        ':name' => $name, 
        ':type' => $type, 
        ':game' => $game, 
        ':start' => $start, 
        ':end' => $end,
        ':rules' => $rules,
        ':serversettings' => $settings
    ); 

    // Run query

    try { 
        // Execute the query to create the user 
        $stmt = $db->prepare($query); 
        $result = $stmt->execute($query_params); 
    } 
        catch(PDOException $ex) 
    {
        die("Failed to run query: " . $ex->getMessage()); 
    } 

    } // error != 1
}
​
?>
<div class="super_container">
  <div class="jumbotron">
    <div class="container">
      <h1>Lag Compo</h1>
    </div>
  </div>
  <div class="container">
    <form action="create_tournament.php" method="post" style="padding:20px;border-left:1px solid #ddd;">
        <table class="creturn">
    <?php
        if ($_POST){
            ?>
            <tr>
                <div class="progress">
                  <div class="progress-bar" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%;">
                    <span class="sr-only">40% Complete</span>
                  </div>
                </div>
            </tr>
            <tr><td colspan='2'>Databasen ble oppdatert. <a href='tournaments.php'>Inviter teams</a>.</td></tr>
            <?php
        }else{
    ?>
            <tr>
                <div class="progress">
                  <div class="progress-bar" role="progressbar" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100" style="width: 10%;">
                    <span class="sr-only">10% Complete</span>
                  </div>
                </div>
            </tr>
            <?php
        }
        ?>
            <tr>
                <td>Namn:</td>
                <td><input type="text" class="form-control" name="name" /></td>
            </tr>
            <tr>
                <td>Type:</td>
                <td>
                    <select name="type">
                        <option value="single elimination">Single Elimination</option>
                        <option value="double elimination">Double Elimination</option>
                        <option value="boiloff">Boiloff</option>
                    </select>
                </td>
            </tr>
            <tr class="defspill">
                <td>Spill:</td>
                <td>
                    <select name="game">
                        <option>League of Legends</option>
                        <option>Rocket League</option>
                        <option>World of Warcraft</option>
                        <option>Counter Strike: Global Offensive</option>
                        <option>Hearthstone</option>
                        <option>Trackmania</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td>Annet spill:</td>
                <td>
                    <div class="input-group">
                      <span class="input-group-addon">
                        <input type="checkbox" id="annetspill" name="annetspill" aria-label="...">
                      </span>
                      <input type="text" class="form-control" disabled id="anspill" name="tannetspill" aria-label="...">
                    </div><!-- /input-group -->
                </td>
            </tr>
            <tr>
                <td>Tid nå:</td>
                <td><input type="text" class="displaytime form-control" disabled /></td>
            </tr>
            <tr>
                <td>Start tid: </td>
                <td><input type="text" name="startdate" class="datepicker form-control" placeholder="2015-09-17 15:00:00" /></td>
            </tr>

            <tr>
                <td>Slutt tid:</td>
                <td><input type="text" name="enddate" placeholder="2017-09-17 21:00:00" style="border-top-right-radius:0;border-bottom-right-radius:0;" class="datepicker form-control" /></td>
                <td> <button type="button" class="btn btn-info moveman" data-toggle="tooltip" data-placement="top" title="Kopier start tid" id="copybutt"><span class="glyphicon glyphicon-pencil"></span> Kopier ned</button>
            </tr>
            <tr>
                <td colspan="2" style="text-align:right;font-size:12px;color:#aaa;">
                    Obs: skriv i start/slutt tid i rett format!
                </td>
            </tr>
            <tr>
                <td valign="top">Regler:</td>
                <td><textarea name="rules"></textarea></td>
            </tr>
            <tr>
                <td valign="top">Server Instillinger:</td>
                <td><textarea name="serversettings"></textarea></td>
            </tr>
            <tr>
                <td colspan="2" style="text-align:right;"><button type="submit" class="btn btn-success moveman"><span class="glyphicon glyphicon-tower"></span> Lag Tournament</buton></td>
            </tr>
        </table>
    </form>
  </div> <!-- /container -->
</div> <!-- /super_container -->
<?php include("script.php");
?>
<script>
$("#copybutt").click(function(){
    $("input[name='enddate'").val($("input[name='startdate'").val());
});
function startTime() {
    var today = new Date();
    var h = today.getHours();
    var m = today.getMinutes();
    var s = today.getSeconds();
    var d = today.getUTCDate();
    var mo = today.getUTCMonth() + 1;
    var y = today.getUTCFullYear();
    m = checkTime(m);
    s = checkTime(s);
    $time = y + "-" + mo + "-" + d + " " + h + ":00:00";
    $(".displaytime").val($time);
    // var t = setTimeout(startTime, 500);
}
function checkTime(i) {
    if (i < 10) {i = "0" + i};  // add zero in front of numbers < 10
    return i;
}
$('#annetspill').change(function(){
    if (this.checked == true){
        $(".defspill").hide();
        $("#anspill").removeAttr("disabled");
    }else{
        $(".defspill").show();
        $("#anspill").val("");
        $("#anspill").attr("disabled", "disabled");
    }
});
$(function () {
  $('[data-toggle="tooltip"]').tooltip()
})
$(document).ready(startTime());
</script>
<?php
include("footer.php"); ?>