<?php include("head.php")?>
    <?php include("header.php")?>
    <!-- Main jumbotron for a primary marketing message or call to action -->
    <?php  if(empty($_SESSION['user'])) 
    { 
        ?>
        
        <?php
    } ?>
    <div class="super_container">
    <div class="jumbotron">
      <div class="container">
        <h1>Velkommen til <br> Sauda Gathering</h1>
        <p><a class="btn btn-success btn-lg" href="register.php" role="button">Meld deg på her &raquo;</a></p>
      </div>
    </div>
    <div class="container">
      <!-- Example row of columns -->
      <div class="row">
        <div class="col-md-4">
		 <div class="panel panel-primary">
			<div class="panel-heading">
				<h3 class="panel-title">Sauda Gathering 2015</h3>
			</div>
		  <div class="panel-body">
          <p class="panel-content">Sauda Gathering 2015 blir arrangert fra lørdag 3. til onsdag 7. oktober. Dette er ett rusfritt arrangement rettet mot ungdom fra ungdomsskulealder og oppover.
<br><br>
Sted: Saudahallen i Sauda, Rogaland.
<br>
Tid: 3. oktober klokka 12:00 til 7. oktober klokka 12.
<br>
Plasser: 150**
<br><br>
Vilkår for påmelding og reglene for arrangementet finner du her: <a href="#">Regler</a>
<br><br>
Priser finner du her: <a href="#">Prisliste</a>
<br><br>
**Vi har plass til 150 deltakere i tillegg til at hver deltaker kan dele plassen sin med én person.
<br><br>
Det vil i tillegg bli solgt dagsbilletter og "ukespass". Dette er kun for adgang til hallen i tidsrommet 08:00 til 23:00. <a href="#">Påmelding</a>
		  </p>
		  </div>
        </div>
       </div>
        <div class="col-md-4">
		 <div class="panel panel-primary">
			<div class="panel-heading">
				<h3 class="panel-title">Planleggingen er i gang</h3>
			</div>
		  <div class="panel-body">
          <p class="panel-content">Planlegging av årets treff er i gang for fullt. Datoen for treffet er satt 3. til 7. oktober, altså i høstferien. Planlagte compoer så langt er:
          <br><br>
          Counter Strike: Global Offensive
          <br><br>
          League of Legends
          <br><br>
          Hearthstone
          <br><br>
          Rocket League
          <br><br>
          FIFA
          <br><br>
          Trackmania
          <br><br>
          Savnet du noe på treffet i fjor eller har tips til oss i forbindelse med planleggingen, ta gjerne kontakt! Kontaktinformasjon finner du nederst på siden eller ved å trykke <a href="#">her</a>.
          </p>
		  </div>
        </div>
       </div>	
        <div class="col-md-4">
		 <div class="panel panel-primary">
			<div class="panel-heading">
				<h3 class="panel-title">Data dag og natt	</h3>
			</div>
		  <div class="panel-body">
          <p class="panel-content">I dag fikk Sauda Gathering besøk av Ryfylke. De ønsket å ta noen bilder og skrev en sak i avisen, blant annet om planleggingen av treffet og om hvorfor vi velger å arrangere.<br><br>Saken innehold også et intervju med Johannes Frøystad og Glenn-Andre Risvold Kalvik. <br><br> Ønsker du å lese hele artikkelen finner du den i papirutgaven av ryfylke eller på ryfylkes nettsider <a href="#">her</a>.
		  </p>
		  </div>
        </div>
       </div>
      </div>
	 </div> <!-- /container -->
  </div> <!-- /super_container -->
    <?php include("script.php")?>
    <?php include("footer.php")?>
