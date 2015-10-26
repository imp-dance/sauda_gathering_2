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
     <div class="jumbotron" style="height: 550px; border-bottom: 50px solid #222;">
      <div class="container" style="padding-bottom: 0;">
        <h1>Velkommen til <br> Sauda Gathering <span class="glyphicon glyphicon-sunglasses"></span></h1>
        <p class="inlinecenter">
        <div class="countdown styled"></div></p>
        <?php
          if (isset($_SESSION['user'])){
        ?>
        <p class="inlinecenter">
          <a class="btn btn-success btn-lg" href="#" role="button" style="margin-top: 0px;">Påmelding til compoer &raquo;</a>
        </p>
        <?php
          }else{
        ?>
        <p class="inlinecenter"><a class="btn btn-success btn-lg" href="register.php" role="button">Meld deg på her &raquo;</a></p>
        <?php
          }
        ?>
      </div>
     </div>
      <div class="container">
      <div class="row">
       <div class="col-md-4" style="width:50%;">

    		 <div class="panel panel-primary">
    			<div class="panel-heading">
    				<h3 class="panel-title">Informasjon og Nyheter</h3>
    			</div>
    		 <div class="panel-body">
         <div class="panel-content">
           <div id="myUserPosts" style="max-height: 580px; overflow-x: hidden; overflow-y: scroll;"></div>
         </div>
		    </div>
       </div>
      </div>
      <div class="fbwrap" style="width:500px;height:650px;float:right;background:url('images/fbload.png') no-repeat top left;">
       <div class="fb-page" style="float:right" data-href="https://www.facebook.com/saudagathering" data-width="500px" data-height="650" data-small-header="false" data-adapt-container-width="false" data-hide-cover="false" data-show-facepile="false" data-show-posts="true"><div class="fb-xfbml-parse-ignore"><blockquote cite="https://www.facebook.com/saudagathering"><a href="https://www.facebook.com/saudagathering">Sauda Gathering</a></blockquote></div></div>
      </div>
      </div>
	 </div> <!-- /container -->
  </div> <!-- /super_container -->
  <?php include("script.php"); ?>
    <script src="js/jquery.ui.tumblr.rss.js"></script>
    <script>
      $(function(){
      $("#myUserPosts").tumblrRss({username: "SG-Crew", limit: 5});
    });
      $(window).resize(function(){
        if ($(window).width() < 1200) {
           $(".fb-page, .fbwrap").attr("data-width", "1000px").css({
              "margin" : "0 auto",
              "float" : "none"
            });
        }else {
          $(".fb-page, .fbwrap").attr("data-width", "800px").css({
                "margin" : "0 auto",
                "float" : "right"
              });
      }
      if ($(window).width() < 525) {
        $(".fb-page, .fbwrap").attr("data-width", "400px").css({
              "margin" : "0 auto",
              "float" : "none"
            });
      }
      });
      
    </script>
    <script src="js/countdown.js"></script>
    <script>
    var endDate = "October 1, 2016 00:00:00";
    $('.countdown').countdown({
          date: endDate,
          render: function(data) {
            $(this.el).html("<div><strong>" + this.leadingZeros(data.days, 3) + "</strong> <span>dager</span></div><div><strong>" + this.leadingZeros(data.hours, 2) + "</strong> <span>timer</span></div>" /* + this.leadingZeros(data.min, 2) + " <span>min</span></div><div>" + this.leadingZeros(data.sec, 2) + " <span>sec</span></div>"*/ + "");
          }
        });
    </script>
  <?php
  include("footer.php");
  ?>
    
