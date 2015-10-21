<body>
<nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <div class="btn-group">
		  <button type="button" class="top-btn btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="margin-left: 15px;">
			Meny <span class="caret"></span>
		  </button>
		  <ul class="dropdown-menu">
			<li><a href="index.php">Hjem</a></li>
			<li><a href="about.php">Om oss</a></li>
			<li><a href="register.php">Registrer deg</a></li>
			<li><a href="#">Min profil</a></li>
			<li><a href="faq.php">FAQ</a></li>
			<li><a href="#">Vilkår</a></li>
			<li><a href="#">Informasjon</a></li>
			<li><a href="#">Arkiv</a></li>
			<li><a href="#">Plasseringsoversikt</a></li>
			<li><a href="#">Påmelding til treffet</a></li>
			<li><a href="#">Påmelding til compoer</a></li>
		  </ul>
		</div>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          
             <?php if(empty($_SESSION['user'])) 
    { 
        ?>
        <form class="navbar-form navbar-right" action="/external_login.php" method="POST">
            <div class="form-group">
              <input type="text" placeholder="Brukernavn" class="form-control" name="username">
            </div>
            <div class="form-group">
              <input type="password" placeholder="Passord" class="form-control" name="password">
            </div>
            <button type="submit" class="btn btn-success">Logg inn</button>
          </form>
        <?php
    } else {
        ?>
        <div class="navbar-right">
            <a href="/logout.php"><button class="btn btn-success">Logg ut</button></a>
            </div>
        <?php
    }
        ?>
        </div><!--/.navbar-collapse -->
      </div>
    </nav>