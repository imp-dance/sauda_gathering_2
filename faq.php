<?php include("head.php") ?>
<body>
    <?php include("header.php") ?>
    <div class="super_container">
        <div class="jumbotron">
         <div class="container">
            <h1 style="font-size: 60px";> FAQ <br> ofte stilte spørsmål</h1> 
         </div> <!-- container -->
        </div> <!-- jumbotron -->
        <div class="container">
         	<div class="row">
                <ol class="breadcrumb">
                  <li><a href="#pameld">Påmelding</a></li>
                  <li><a href="#minprof">Min Profil</a></li>
                  <li><a href="#compo">Compo</a></li>
                  <li><a href="#galleri">Galleri</a></li>
                  <li><a href="#forum">Forum</a></li>
                </ol>
         		<table class="faqt">
                    <tr valign="top" class="faqheading">
                        <td colspan="2" style="text-align: center;" name="pameld" id="pameld"><h2 style="font-size: 40px;">PÅMELDING</h2></td>
                    </tr>
         			<tr valign="top">
         				<td><strong>Kan jeg bytte plass etter at jeg har betalt?</strong></td>
         				<td>Ja, betalingen og plassnummeret er uavhengige. Du kan bytte plass helt frem til rett før treffet starter.</td>
         			</tr>
         			<tr valign="top">
         				<td><strong>Kan jeg betale med nettbank?</strong></td>
         				<td>Ja, det er mulig å betale med nettbank, men husk at medlemsnummer og navn må være med i betalingsinformasjon.
Medlemsnummeret ditt finner du i "Endre profil" i "innstillinger" menyen.</td>
         			</tr>
                    <tr valign="top">
                        <td><strong>Hvordan finner jeg medlemsnummeret mitt?</strong></td>
                        <td>Det kan du finne ved å gå inn på linken "Endre profil" i menyen "innstillinger" til venstre. 
Du kan også finner det under "Betalingsinfo" i samme meny.
Pass på å få alt riktig skrevet!</td>
                    </tr>
         			<tr valign="top">
         				<td><strong>Hvorfor får jeg ikke e-post?</strong></td>
         				<td>Noen kan oppleve problemer med at meldingene fra registreringsprosessen blir oppfattet som søppelpost/junkmail. Dette gjelder f.eks. de som bruker Hotmail. E-posten vil da havne i junkmail mappa.</td>
         			</tr>
                    <tr valign="top" class="faqheading">
                        <td name="minprof" id="minprof" colspan="2" style="text-align: center;"><h2 style="font-size: 40px;">MIN PROFIL</h2></td>
                    </tr>
                    <tr valign="top">
                        <td><strong>Hvordan bytter jeg passord?</strong></td>
                        <td>For å bytte passord må du være pålogget.
Trykk på "Konto" oppe i høyre hjørne og skriv inn ditt nye passord i feltet på siden.</p></td>
                    </tr>
                    <tr valign="top">
                        <td><strong>Hvordan bytter jeg nick?</strong></td>
                        <td>For å bytte nick må du være pålogget.
Trykk på "Endre profil" i innstillinger menyen og bytt nick helt nederst på siden.</td>
                    </tr>
         			<tr valign="top">
         				<td><strong>Hva er et profilbilde?</strong></td>
         				<td>Dette er bildet som dukker opp på din egen profil-side, i faktaboksen. 
Det skal vise et bilde av deg selv, slik at andre kan bruke bildet i sammenheng med nicket ditt og bedre huske hvem du er.</p></td>
         			</tr>
                    <tr valign="top">
                        <td><strong>Hvordan laster jeg opp et profilbilde?</strong></td>
                        <td>For å laste opp et profilbilde går du inn på "Endre profil" og laster opp et bilde.

NB! Bildet kan maks være på 100KB og MÅ være jpg. Anbefalt størrelse er 100x100 piksler. Bilder over denne størrelsen blir krympet.</p></td>
                    </tr>
                    <tr valign="top">
                        <td><strong>Hvordan laster jeg opp et profilbilde?</strong></td>
                        <td>For å laste opp et profilbilde går du inn på "Endre profil" og laster opp et bilde.

NB! Bildet kan maks være på 100KB og MÅ være jpg. Anbefalt størrelse er 100x100 piksler. Bilder over denne størrelsen blir krympet.</p></td>
                    </tr>
                    <tr valign="top">
                        <td><strong>Hvordan laster jeg opp en avatar?</strong></td>
                        <td>For å laste opp et icon/avatar går du inn på "Endre profil" og laster opp et bilde.

NB! Bildet kan maks være på 50KB og MÅ være jpg. Størrelsen MÅ være 50x50 piksler.</p></td>
                    </tr>
                    <tr valign="top" class="faqheading">
                        <td name="compo" id="compo" colspan="2" style="text-align: center;"><h2 style="font-size: 40px;">COMPO</h2></td>
                    </tr>
                    <tr valign="top">
                        <td><strong>Hvem kan delta i compoer?</strong></td>
                        <td>Kun ordinære deltakere på Sauda Gathering kan delta i compoer, dvs. de som har betalt for en egen plass på treffet. Personer med dagspass (50,- NOK) har derfor ikke mulighet for å delta i compoer.</p></td>
                    </tr>
                    <tr valign="top">
                        <td><strong>Hvordan melder jeg meg på compoer?</strong></td>
                        <td>For å melde deg på en compo trykker du på "Meny" i venstre hjørne og velger kategorien "Påmelding til compoer". På denne siden kan du se hvilke compoer som blir arrangert dette året og lage/melde deg på et lag ved ulike turneringer.</p></td>
                    </tr>
                    <tr valign="top" class="faqheading">
                        <td name="galleri" id="galleri" colspan="2" style="text-align: center;"><h2 style="font-size: 40px;">GALLERI</h2></td>
                    </tr>
                    <tr valign="top" class="faqheading">
                        <td name="forum" id="forum" colspan="2" style="text-align: center;"><h2 style="font-size: 40px;">FORUM</h2></td>
                    </tr>
         		</table>
         	</div>
         </div>
    </div>
    <?php include("script.php") ?>
    <script>
    $(window).on("hashchange", function () {
        window.scrollTo(window.scrollX, window.scrollY - 60);
    });
    </script>
    <?php include("footer.php") ?>
</body>
</html>