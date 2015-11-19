<?php
include("mailto.php");
?>
<div id="footer">
 <div class="container">
   <footer>
    <img src="images/copyright3.png">
    <table style="color: #fff;" class="kontakt">
		<tr>
			<td>
				<p>
		      	<a href="" data-toggle="modal" data-target="#myModal" class="footerlink">Send en email til Sauda Gathering &raquo;</a>
		        </p>	
			</td>
		</tr>
		<tr>
			<td>
				<p>
		      	<a href="#" class="footerlink">Link til Sauda Gathering vakt IRC &raquo; </a>
		        </p>	
			</td>
			<td>
				<p>
					<!-- Link te Saudahallen på google maps -->
		      	<a href="#" class="footerlink">Hvor finner du oss? &raquo; </a>
		        </p>	
			</td>
		</tr>
		<tr class="contactform">
			<td>
				<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
				  <div class="modal-dialog" role="document">
				    <div class="modal-content">
				      <div class="modal-header">
				        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				        <h4 class="modal-title" id="myModalLabel">Send en email</h4>
				      </div>
				      <div class="modal-body">
				        <form class="form-horizontal" role="form" method="post" action="index.php">
						    <div class="form-group">
						        <label for="email" class="col-sm-2 control-label">Email</label>
						        <div class="col-sm-10">
						            <input type="email" class="form-control" id="email" name="email" placeholder="Dinemail@eksempel.com" value="">
						        </div>
						    </div>
						    <div class="form-group">
						        <label for="email" class="col-sm-2 control-label">Emne</label>
						        <div class="col-sm-10">
						            <input type="text" class="form-control" id="emne" name="emne" placeholder="Skriv inn ditt emne her" value="">
						        </div>
						    </div>
						    <div class="form-group">
						        <label for="message" class="col-sm-2 control-label">Melding</label>
						        <div class="col-sm-10">
						            <textarea class="form-control" rows="4" id="melding" name="melding "></textarea>
						        </div>
						    </div>
						    <div class="form-group">
						        <div class="col-sm-10 col-sm-offset-2">
						            <input id="submit" name="submit" type="submit" value="Send" class="btn btn-primary">
						        </div>
						    </div>
						</form>
				      </div>
				    </div>
				  </div>
				</div>
			</td>
		</tr>
    </table>
   </footer>
 </div>
</div>
</body>
</html>