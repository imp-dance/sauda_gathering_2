<?php include("head.php");
include("header.php");
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
        $code = "1";
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
        $code = "2";
    }

    if ($error == 1){
        die("Error! Kode ".$code);
    }

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
      <h1>Lag Compo</h1>
    </div>
  </div>
  <div class="container">
    <form action="create_tournament.php" method="post" style="padding:20px;">
        <table class="creturn">
            <tr>
                <td>Namn:</td>
                <td><input type="text" name="name" /></td>
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
            <tr>
                <td>Spill:</td>
                <td>
                    <input type="text" name="game" />
                </td>
            </tr>
            <tr>
                <td>Start tid (yyyy-mm-dd hh:mm:ss):</td>
                <td><input type="text" name="startdate" class="datepicker" placeholder="2015-09-17 15:00:00" /></td>
            </tr>

            <tr>
                <td>Slutt tid (yyyy-mm-dd hh:mm:ss):</td>
                <td><input type="text" name="enddate" placeholder="2015-09-17 21:00:00" class="datepicker" /></td>
            </tr>
            <tr>
                <td>Regler:</td>
                <td><textarea name="rules"></textarea></td>
            </tr>
            <tr>
                <td>Server Instillinger:</td>
                <td><textarea name="serversettings"></textarea></td>
            </tr>
            <tr>
                <td colspan="2"><input type="submit" value="Lag Turnament" /></td>
            </tr>
        </table>
    </form>
    <?php
        if ($_POST){
            echo("Databasen ble oppdatert");
        }
    ?>
  </div> <!-- /container -->
</div> <!-- /super_container -->
<?php include("script.php");
?>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
<script>
</script>
<?php
include("footer.php"); ?>