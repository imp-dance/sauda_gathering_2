<?php include("head.php");
include("header.php"); if(empty($_SESSION['user'])){ die('<meta http-equiv="refresh" content="0; url=login.php">'); }?>
<div class="super_container">
    <div class="jumbotron">
      <div class="container">
        <h1>Sauda Gathering<br>Vakt-IRC</h1>
      </div>
    </div>
    <div class="container">
      <!-- Example row of columns -->
      <iframe src="https://kiwiirc.com/client/irc.kiwiirc.com/?nick=<?php echo($_SESSION['user']['username']); ?>#SG2016-Vakt" style="border:0; width:100%; height:450px;"></iframe> 
	 </div> <!-- /container -->
  </div> <!-- /super_container -->
    <?php include("script.php");
    include("footer.php"); ?>