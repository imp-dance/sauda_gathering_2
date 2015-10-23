<?php include("head.php");
include("header.php"); ?>
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/nb_NO/sdk.js#xfbml=1&version=v2.5&appId=169671199767817";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
    <!-- Main jumbotron for a primary marketing message or call to action -->
    <?php  if(empty($_SESSION['user'])) 
    { 
        ?>
        
        <?php
    } ?>
    <div class="super_container">
     <div class="jumbotron">
      <div class="container">
        <h1>Velkommen til <br> Sauda Gathering!!</h1>
        <p class="inlinecenter"><a class="btn btn-success btn-lg" href="register.php" role="button">Meld deg på her &raquo;</a></p>
      </div>
     </div>
      <div class="container">
      <div class="row">
       <div class="col-md-4" style="width:50%;">

    		 <div class="panel panel-primary">
    			<div class="panel-heading">
    				<h3 class="panel-title">Siste nyheter</h3>
    			</div>
    		 <div class="panel-body">
         <div class="panel-content">
           <div id="myUserPosts"></div>
         </div>
		    </div>
       </div>
      </div>
      <div class="fb-page" style="float:right" data-href="https://www.facebook.com/saudagathering" data-width="500px" data-height="800" data-small-header="false" data-adapt-container-width="false" data-hide-cover="false" data-show-facepile="false" data-show-posts="true"><div class="fb-xfbml-parse-ignore"><blockquote cite="https://www.facebook.com/saudagathering"><a href="https://www.facebook.com/saudagathering">Sauda Gathering</a></blockquote></div></div>
      </div>
	 </div> <!-- /container -->
  </div> <!-- /super_container -->
  <?php include("script.php"); ?>
    <script src="js/jquery.ui.tumblr.rss.js"></script>
    <script>
      $(function(){
      $("#myUserPosts").tumblrRss({username: "SG-Crew", limit: 5});
    });
    </script>
  <?php
  include("footer.php");
  ?>
    
