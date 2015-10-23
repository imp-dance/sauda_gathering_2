<?php include("head.php");
include("header.php"); ?>
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
     <!--Her begynne columns med nyhetssaker -->
      <div class="container">
      <div class="row">
        <div class="col-md-4">
    		 <div class="panel panel-primary">
    			<div class="panel-heading">
    				<h3 class="panel-title">Sauda Gathering 2015</h3>
    			</div>
    		 <div class="panel-body">
         <div class="panel-content">
            <p>Sauda Gathering 2015 blir arrangert fra lørdag 3. til onsdag 7. oktober. Dette er ett rusfritt arrangement rettet mot ungdom fra ungdomsskulealder og oppover.</p>
            <p>Sted: Saudahallen i Sauda, Rogaland.</p>
            <p>Tid: 3. oktober klokka 12:00 til 7. oktober klokka 12.</p>
            <p>Plasser: 150**</p>
            <p>Vilkår for påmelding og reglene for arrangementet finner du her: <a href="#">Regler</a></p>
            <p>Priser finner du her: <a href="#">Prisliste</a></p>
            <p>**Vi har plass til 150 deltakere i tillegg til at hver deltaker kan dele plassen sin med én person.</p>
            <p>Det vil i tillegg bli solgt dagsbilletter og "ukespass". Dette er kun for adgang til hallen i tidsrommet 08:00 til 23:00. <a href="#">Påmelding</a></p>
         </div>
		    </div>
       </div>
      </div>
       <div class="col-md-4">
    		<div class="panel panel-primary">
    		 <div class="panel-heading">
    		  <h3 class="panel-title">Planleggingen er i gang</h3>
    		 </div>
    		  <div class="panel-body">
          <div class="panel-content">
          <p>Planlegging av årets treff er i gang for fullt. Datoen for treffet er satt 3. til 7. oktober, altså i høstferien. Planlagte compoer så langt er:</p>
          <p>Counter Strike: Global Offensive</p>
          <p>League of Legends</p>
          <p>Hearthstone</p>
          <p>Rocket League</p>
          <p>FIFA</p>
          <p>Trackmania</p>
          <p>Savnet du noe på treffet i fjor eller har tips til oss i forbindelse med planleggingen, ta gjerne kontakt! Kontaktinformasjon finner du nederst på siden eller ved å trykke <a href="#">her</a>.</p>
      </div>
		  </div>
        </div>
       </div>	
        <div class="col-md-4">
		 <div class="panel panel-primary">
			<div class="panel-heading">
				<h3 class="panel-title">Data dag og natt	</h3>
			</div>
		  <div class="panel-body">
          <div class="panel-content">
            <p>I dag fikk Sauda Gathering besøk av Ryfylke. De ønsket å ta noen bilder og skrev en sak i avisen, blant annet om planleggingen av treffet og om hvorfor vi velger å arrangere.</p>
            <p>Saken innehold også et intervju med Johannes Frøystad og Glenn-Andre Risvold Kalvik. <br><br> Ønsker du å lese hele artikkelen finner du den i papirutgaven av ryfylke eller på ryfylkes nettsider <a href="#">her</a>.</p>
		  </div>
		  </div>
        </div>
       </div>
      </div>
	 </div> <!-- /container -->
  </div> <!-- /super_container -->
    <?php include("footer.php");
    include("script.php"); ?>
