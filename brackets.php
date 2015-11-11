<?php
include('../common.php');
$q = $db;
?>

<html>
<head>
<title>jQuery Tournament Brackets</title>
<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.8.16.custom.min.js"></script>
<script type="text/javascript" src="js/jquery.bracket.js"></script>
<script type="text/javascript" src="js/jquery.json-2.3.min.js"></script>

<?php 
if($_GET['tid'])
{
  $q = "SELECT * FROM lan_brackets WHERE tid = :tid";
  $qp = array(":tid" => $_GET['tid']);
  try { 
        // Execute the query to create the user 
        $stmt = $db->prepare($q); 
        $r = $stmt->execute($qp); 
    } 
        catch(PDOException $ex) 
    {
        die("Failed to run query: " . $ex->getMessage()); 
    }
  $data = $stmt->fetch();
  $json = $data['json'];
  if(!empty($json))
    echo '<script type="text/javascript">var autoCompleteData = '.$json.'</script>';
  else
    echo '<script type="text/javascript">var autoCompleteData = {
    teams : [["Devon", ""],["", ""]], results : []}</script>';
}
else
    echo '<script type="text/javascript">var autoCompleteData = {
    teams : [["Devon", ""],["", ""]], results : []}</script>';



if($_GET['secretMode'] == "inlanadminmode")
{ ?>
<script type="text/javascript" src="js/brackets.js"></script>
<?php }
else
{ ?>
<script type="text/javascript" src="js/brackets-rd.js"></script>
<?php } ?>




<link rel="stylesheet" type="text/css" href="css/jquery.bracket.css" />
</head>
<body>

<?php
if($_GET['secretMode'] == "inlanadminmode")
{
$q = "SELECT * FROM sg_turn";
  try { 
      // These two statements run the query against your database table. 
      $stmt = $db->prepare($q); 
      $stmt->execute(); 
  } catch(PDOException $ex) { 
      // Note: On a production website, you should not output $ex->getMessage(). 
      // It may provide an attacker with helpful information about your code.  
      die("Failed to run query: " . $ex->getMessage()); 
  } 
$rows = $stmt->fetchAll();
foreach($rows as $data):
  $dataid = $data['id'];
  $dataname = $data['name'];
  ?>

  <a href="brackets.php?secretMode=inlanadminmode&tid=<?php echo($dataid); ?>"><?php echo($dataname); ?></a>
  
  <?php
endforeach;
}
?>


<div id="autoComplete"></div>
<?php

if($_POST['data'] && $_GET['tid'] != 0 && $_GET['secretMode'] == "inlanadminmode")
{
  $tid = $_GET['tid'];
  $json = $_POST['data'];
  
  $q = "SELECT * FROM lan_brackets WHERE tid = :tid";
  $qp = array(":tid" => $tid);
  try 
  { 
      // These two statements run the query against your database table. 
      $stmt = $db->prepare($q); 
      $stmt->execute($qp); 
  } 
  catch(PDOException $ex) 
  { 
      // Note: On a production website, you should not output $ex->getMessage(). 
      // It may provide an attacker with helpful information about your code.  
      die("Failed to run query: " . $ex->getMessage()); 
  } 
  $rows = $stmt->fetch();
  $numrows = $stmt->numrows();
  
  if($numrows == 0){
    $q = "INSERT INTO lan_brackets (tid, json)
          VALUES (':tid', ':json')";

    $qp = array(
      ":tid" => $tid,
      ":json" => $json);

  }else{

    $q = 'UPDATE lan_brackets SET
    json = ":json"
    WHERE tid = :tid';

    $qp = array(
      ":tid" => $tid,
      ":json" => $json);

  }
  try 
  { 
      // These two statements run the query against your database table. 
      $stmt = $db->prepare($q); 
      $stmt->execute($qp);
  } 
  catch(PDOException $ex) 
  { 
      // Note: On a production website, you should not output $ex->getMessage(). 
      // It may provide an attacker with helpful information about your code.  
      die("Failed to run query: " . $ex->getMessage()); 
  } 
}

?>

</body>
</html>