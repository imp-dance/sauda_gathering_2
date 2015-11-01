<?php include("head.php");
include("header.php");

if (!empty($_POST)){
  $params = array(
  "tournament[name]" => "My Tourney",
  "tournament[tournament_type]" => "single elimination",
  "tournament[url]" => "my_toruney",
  "tournament[description]" => "Challonge is <strong>AWESOME</strong>"
  );
$tournament = $c->makeCall("tournaments", $params, "post");
$tournament = $c->createTournament($params);
}

?>
<div class="super_container">
  <div class="jumbotron">
    <div class="container">
      <h1>Lag Compo</h1>
    </div>
  </div>
  <div class="container">
    <form action="create_tournament.php" method="post">
    	<table>
    		<tr>
    			<td>Namn:</td>
    			<td><input type="text" name="name" /></td>
    		</tr>
    		<tr>
    			<td>Type:</td>
    			<td>
    				<select>
    					<option value="single elimination">Single Elimination</option>
    				</select>
    			</td>
    		</tr>
    		<tr>
    			<td colspan="2"><input type="submit" value="Lag Turnament" /></td>
    		</tr>
    	</table>
    </form>
  </div> <!-- /container -->
</div> <!-- /super_container -->
<?php include("script.php");
include("footer.php"); ?>