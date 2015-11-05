<?php include("head.php");
include("header.php");
$editid = $_GET['id'];
/*if (!is_numeric($editid)){
    die("luring");
}*/
if (empty($editid)){
    die('<meta http-equiv="refresh" content="0; url=tournaments.php">');
}
$getinfo = "SELECT * FROM sg_turn WHERE id = :id";
$getinfoparams = array(
    ':id' => $editid);
try { 
    // Execute the query to create the user 
        $stmtabc = $db->prepare($getinfo); 
        $resultabc = $stmtabc->execute($getinfoparams); 
} 
catch(PDOException $ex) {
        die("Failed to run query: " . $ex->getMessage()); 
} 
$row = $stmtabc->fetch();
// Declare shit
$current_name = $row['name'];
$current_type = $row['type'];
$current_game = $row['game'];
$current_start = $row['start'];
$current_end = $row['end'];
$current_rules = $row['rules'];
$current_settings = $row['serversettings'];




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

    // Check if gametype is in array

    $typearray = array(
    "single elimination",
    "double elimination",
    "boiloff");

    if (!in_array($type, $typearray)){
        // Hmmmmmmmm
        $error = 1;
        $code = "1 - Invalid type spill</p>";
    }

    // Check if valid date

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
    }
    
    if (empty($name) || empty($game) || empty($start) || empty($end)){
        $error = 1;
        $code = "3 - Fyll ut alle felt</p>";    
    }

    if ($error == 1){
        die("<p class='error-code'>Error! Kode ".$code);
    }

    $ttquery = "UPDATE sg_turn SET
        name = :name,
        type = :type,
        game = :game,
        start = :start,
        end = :end,
        rules = :rules,
        serversettings = :serversettings
        WHERE
        id = :id";
    $ttquery_params = array( 
        ':name' => $name, 
        ':type' => $type, 
        ':game' => $game, 
        ':start' => $start, 
        ':end' => $end,
        ':rules' => $rules,
        ':serversettings' => $settings,
        ':id' => $editid
    ); 

    // Run query

    try { 
        // Execute the query to create the user 
        $teststmt = $db->prepare($ttquery); 
        $testresult = $teststmt->execute($ttquery_params); 
    } 
        catch(PDOException $ex) 
    {
        die("Failed to run query: " . $ex->getMessage()); 
    }
    die('<meta http-equiv="refresh" content="0; url=edit_tournament.php?id='.$editid.'">');
}
​
?>
<style>
.creturn td{
    padding-top:10px;
}
.creturn textarea{
    border-color:#ccc;
}
</style>
<div class="super_container">
  <div class="jumbotron">
    <div class="container">
      <h1>Rediger Compo</h1>
    </div>
  </div>
  <div class="container">
    <form action="edit_tournament.php?id=<?php echo($editid); ?>" method="post" style="padding:20px;">
        <table class="creturn">
    <?php
    ?>
            <tr>
                <td>Namn:</td>
                <td><input type="text" name="name" value="<?php echo($current_name); ?>" /></td>
            </tr>
            <tr>
                <td>ID:</td>
                <td><input type="text" value="<?php echo($editid); ?>" disabled /></td>
            </tr>
            <tr>
                <td>Type:</td>
                <td>
                    <select name="type">
                        <option value="<?php echo($current_type); ?>"><?php echo($current_type); ?></option>
                        <option value="single elimination">Single Elimination</option>
                        <option value="double elimination">Double Elimination</option>
                        <option value="boiloff">Boiloff</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td>Spill:</td>
                <td>
                    <input type="text" name="game" value="<?php echo($current_game); ?>" />
                </td>
            </tr>
            <tr>
                <td>Tid nå:</td>
                <td><input type="text" class="displaytime" disabled /></td>
            </tr>
            <tr>
                <td>Start tid (yyyy-mm-dd hh:mm:ss):</td>
                <td><input type="text" name="startdate" class="datepicker" value="<?php echo($current_start); ?>" placeholder="2015-09-17 15:00:00" /></td>
            </tr>

            <tr>
                <td>Slutt tid (yyyy-mm-dd hh:mm:ss):</td>
                <td><input type="text" name="enddate" value="<?php echo($current_end); ?>" placeholder="2015-09-17 21:00:00" class="datepicker" /></td>
            </tr>
            <tr>
                <td>Regler:</td>
                <td><textarea name="rules"><?php echo($current_rules); ?></textarea></td>
            </tr>
            <tr>
                <td>Server Instillinger:</td>
                <td><textarea name="serversettings"><?php echo($current_settings); ?></textarea></td>
            </tr>
            <tr>
                <td colspan="2" style="text-align:right;"><button type="submit" class="btn btn-success moveman"><span class="glyphicon glyphicon-thumbs-up"></span> Oppdater Tournament</button></td>
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
    $time = y + "-" + mo + "-" + d + " " + h + ":" + m + ":" + s;
    $(".displaytime").val($time);
    var t = setTimeout(startTime, 500);
}
function checkTime(i) {
    if (i < 10) {i = "0" + i};  // add zero in front of numbers < 10
    return i;
}
$(document).ready(startTime());
</script>
<?php
include("footer.php"); ?>