<?php
    // First we execute our common code to connection to the database and start the session 
    require("../common.php"); 
     if($_REQUEST['password_confirm'] != $_REQUEST['password']){
    die('<meta http-equiv="refresh" content="0; url=register.php?error=pass_unequal">');
}
    // This if statement checks to determine whether the registration form has been submitted 
    // If it has, then the registration code is run, otherwise the form is displayed 
    if(!empty($_POST)) 
    { 
        // Ensure that the user has entered a non-empty username 
        if(empty($_POST['username'])) 
        { 
            // Note that die() is generally a terrible way of handling user errors 
            // like this.  It is much better to display the error with the form 
            // and allow the user to correct their mistake.  However, that is an 
            // exercise for you to implement yourself. 
            die("Please enter a username."); 
        } 
         
        // Ensure that the user has entered a non-empty password 
        if(empty($_POST['password'])) 
        { 
            die("Please enter a password."); 
        } 
         
        // Make sure the user entered a valid E-Mail address 
        // filter_var is a useful PHP function for validating form input, see: 
        // http://us.php.net/manual/en/function.filter-var.php 
        // http://us.php.net/manual/en/filter.filters.php 
        if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) 
        { 
            die("Invalid E-Mail Address"); 
        } 
         
        // We will use this SQL query to see whether the username entered by the 
        // user is already in use.  A SELECT query is used to retrieve data from the database. 
        // :username is a special token, we will substitute a real value in its place when 
        // we execute the query. 
        $query = " 
            SELECT 
                1 
            FROM morten_users 
            WHERE 
                username = :username 
        "; 
         
        // This contains the definitions for any special tokens that we place in 
        // our SQL query.  In this case, we are defining a value for the token 
        // :username.  It is possible to insert $_POST['username'] directly into 
        // your $query string; however doing so is very insecure and opens your 
        // code up to SQL injection exploits.  Using tokens prevents this. 
        // For more information on SQL injections, see Wikipedia: 
        // http://en.wikipedia.org/wiki/SQL_Injection 
        $query_params = array( 
            ':username' => $_POST['username'] 
        ); 
         
        try 
        { 
            // These two statements run the query against your database table. 
            $stmt = $db->prepare($query); 
            $result = $stmt->execute($query_params); 
        } 
        catch(PDOException $ex) 
        { 
            // Note: On a production website, you should not output $ex->getMessage(). 
            // It may provide an attacker with helpful information about your code.  
            die("Failed to run query: " . $ex->getMessage()); 
        } 
         
        // The fetch() method returns an array representing the "next" row from 
        // the selected results, or false if there are no more rows to fetch. 
        $row = $stmt->fetch(); 
         
        // If a row was returned, then we know a matching username was found in 
        // the database already and we should not allow the user to continue. 
        if($row) 
        { 
            die('<meta http-equiv="refresh" content="0; url=register.php?error=username_taken">'); 
        } 
         
        // Now we perform the same type of check for the email address, in order 
        // to ensure that it is unique. 
        $query = " 
            SELECT 
                1 
            FROM morten_users 
            WHERE 
                email = :email 
        "; 
         
        $query_params = array( 
            ':email' => $_POST['email'] 
        ); 
         
        try 
        { 
            $stmt = $db->prepare($query); 
            $result = $stmt->execute($query_params); 
        } 
        catch(PDOException $ex) 
        { 
            die("Failed to run query: " . $ex->getMessage()); 
        } 
         
        $row = $stmt->fetch(); 
         
        if($row) 
        { 
            die('<meta http-equiv="refresh" content="0; url=register.php?error=email_taken">'); 
        } 
         
        // An INSERT query is used to add new rows to a database table. 
        // Again, we are using special tokens (technically called parameters) to 
        // protect against SQL injection attacks. 
        $query = " 
            INSERT INTO morten_users ( 
                username, 
                password, 
                salt, 
                email,
                nr 
            ) VALUES ( 
                :username, 
                :password, 
                :salt, 
                :email,
                :nr
            ) 
        "; 
         
        // A salt is randomly generated here to protect again brute force attacks 
        // and rainbow table attacks.  The following statement generates a hex 
        // representation of an 8 byte salt.  Representing this in hex provides 
        // no additional security, but makes it easier for humans to read. 
        // For more information: 
        // http://en.wikipedia.org/wiki/Salt_%28cryptography%29 
        // http://en.wikipedia.org/wiki/Brute-force_attack 
        // http://en.wikipedia.org/wiki/Rainbow_table 
        $salt = dechex(mt_rand(0, 2147483647)) . dechex(mt_rand(0, 2147483647)); 
         
        // This hashes the password with the salt so that it can be stored securely 
        // in your database.  The output of this next statement is a 64 byte hex 
        // string representing the 32 byte sha256 hash of the password.  The original 
        // password cannot be recovered from the hash.  For more information: 
        // http://en.wikipedia.org/wiki/Cryptographic_hash_function 
        $password = hash('sha256', $_POST['password'] . $salt); 
        // Next we hash the hash value 65536 more times.  The purpose of this is to 
        // protect against brute force attacks.  Now an attacker must compute the hash 65537 
        // times for each guess they make against a password, whereas if the password 
        // were hashed only once the attacker would have been able to make 65537 different  
        // guesses in the same amount of time instead of only one. 
        for($round = 0; $round < 65536; $round++) 
        { 
            $password = hash('sha256', $password . $salt); 
        } 
         
        // Here we prepare our tokens for insertion into the SQL query.  We do not 
        // store the original password; only the hashed version of it.  We do store 
        // the salt (in its plaintext form; this is not a security risk). 
        $query_params = array( 
            ':username' => $_POST['username'], 
            ':password' => $password, 
            ':salt' => $salt, 
            ':email' => $_POST['email'], 
            ':nr' => $_POST['nr']
        ); 
         
        try 
        { 
            // Execute the query to create the user 
            $stmt = $db->prepare($query); 
            $result = $stmt->execute($query_params); 
        } 
        catch(PDOException $ex) 
        { 
            // Note: On a production website, you should not output $ex->getMessage(). 
            // It may provide an attacker with helpful information about your code.  
            die("Failed to run query: " . $ex->getMessage()); 
        } 
         
        // This redirects the user back to the login page after they register 
        header("Location: index.php"); 
         
        // Calling die or exit after performing a redirect using the header function 
        // is critical.  The rest of your PHP script will continue to execute and 
        // will be sent to the user if you do not die or exit. 
        die("Redirecting to login.php"); 
    } 
?>

  <?php
    
        
    // Create connection
    $conn = mysqli_connect($servername, $username, $password);
        
    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
    echo "Connected successfully";
   ?>
<!-- Default template -->
<?php include("head.php");
include("header.php"); ?>
    <!-- Main jumbotron for a primary marketing message or call to action -->
    <div class="jumbotron">
      <div class="container">
      <h1>Registrering</h1> 
        <form action="register.php" method="post" style="margin: 10px auto">
            <table class="regtable">
                <tr>
                    <td colspan="2">
                        <?php
                        if(!empty($_REQUEST['error'])){
                        ?>
                        <div class="alert alert-danger alert-dismissible" style="text-shadow:none !important;" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <strong>Obs!</strong> 
                        <?php
                        if($_REQUEST['error'] == "email_taken") {
                        ?>
                        Denne email-adressen er allerede i bruk  
                        <?php
                            }
                        ?>

                        <?php
                        if($_REQUEST['error'] == "username_taken") {
                        ?>
                          Dette brukernavnet er allerede i bruk  
                        <?php
                            }
                        ?>

                        <?php
                        if($_REQUEST['error'] == "pass_unequal") {
                        ?>
                          Passordene er ikke like  
                        <?php
                            }
                        ?>
                        </div>    
                        <?php
                        }
                        ?>
                        <input type="checkbox" name="ckbox" required />
                        <label for="ckbox">Når du registrerer deg aksepterer du <a href="terms.php" target="_blank">vilkårene</a></label>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="username">Brukernavn</label>:
                    </td>
                    <td>
                        <input type="text" id="username" name="username" required placeholder="Brukernavn"
                oninvalid="this.setCustomValidity('Vennligst skriv inn et gyldig brukernavn')"
                oninput="setCustomValidity('')"  />
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="email">E-Mail</label>:
                    </td>
                    <td>
                        <input type="email" name="email" value="" autocomplete="off" required placeholder="Email"
                oninvalid="this.setCustomValidity('Vennligst skriv inn en gyldig email')"
                oninput="setCustomValidity('')" /> 
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="password">Passord</label>:
                    </td>
                    <td>
                        <input type="password" name="password" value="" autocomplete="off" required placeholder="Passord"
                oninvalid="this.setCustomValidity('Vennligst skriv inn ett gyldig passord')"
                oninput="setCustomValidity('')" /> 
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="password_confirm">Bekreft passordet ditt</label>:
                    </td>
                    <td>
                        <input type="password" name="password_confirm" value="" autocomplete="off" required placeholder="Vennligst gjenta passordet"
                oninvalid="this.setCustomValidity('Vennligst skriv inn ett gyldig passord')"
                oninput="setCustomValidity('')" /> 
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="nr">Mobilnummer</label>:
                    </td>
                    <td>
                        <!--
                        Detta her:

                        oninvalid="this.setCustomValidity('Error message')"
                        oninput="setCustomValidity('')" />

                        Lar oss setta en custom error message i et input field med attribute "required"
                        -->
                        <input type="text" name="nr" value="" autocomplete="off" required placeholder="Mobilnummer"
                oninvalid="this.setCustomValidity('Vennligst skriv inn ett gyldig mobilnummer')"
                oninput="setCustomValidity('')" /> 
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input class="btn btn-success btn-lg" type="submit" value="Registrer deg"/> 
                    </td>
                </tr>
            </table>
        </form>
      </div>
    </div>
	 </div> <!-- /container -->
<?php 
include("script.php");
include("footer.php");
 ?>