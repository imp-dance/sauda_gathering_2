<?php 

    // First we execute our common code to connection to the database and start the session 
    require("../common.php"); 
     
    // At the top of the page we check to see whether the user is logged in or not 
    if(empty($_SESSION['user'])) 
    { 
        // If they are not, we redirect them to the login page. 
        header("Location: login.php"); 
         
        // Remember that this die statement is absolutely critical.  Without it, 
        // people can view your members-only content without logging in. 
        die("Redirecting to login.php"); 
    } 
     
    // This if statement checks to determine whether the edit form has been submitted 
    // If it has, then the account updating code is run, otherwise the form is displayed 
    if(!empty($_POST)) 
    { 
        // Make sure the user entered a valid E-Mail address 
        if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) 
        { 
            die("Invalid E-Mail Address"); 
        } 
         
        // If the user is changing their E-Mail address, we need to make sure that 
        // the new value does not conflict with a value that is already in the system. 
        // If the user is not changing their E-Mail address this check is not needed. 
        if($_POST['nick'] != $_SESSION['user']['username']){
             // Define our SQL query 
            $query = " 
                SELECT 
                    1 
                FROM morten_users 
                WHERE 
                    username = :nick 
            "; 
             
            // Define our query parameter values 
            $query_params = array( 
                ':nick' => $_POST['nick'] 
            ); 
             
            try 
            { 
                // Execute the query 
                $stmt = $db->prepare($query); 
                $result = $stmt->execute($query_params); 
            } 
            catch(PDOException $ex) 
            { 
                // Note: On a production website, you should not output $ex->getMessage(). 
                // It may provide an attacker with helpful information about your code.  
                die("Failed to run query: " . $ex->getMessage()); 
            } 
             
            // Retrieve results (if any) 
            $row = $stmt->fetch(); 
            if($row) 
            { 
                die("Nicket er allerede i bruk!"); 
            } 
        }
        if($_POST['email'] != $_SESSION['user']['email']) 
        { 
            // Define our SQL query 
            $query = " 
                SELECT 
                    1 
                FROM morten_users 
                WHERE 
                    email = :email 
            "; 
             
            // Define our query parameter values 
            $query_params = array( 
                ':email' => $_POST['email'] 
            ); 
             
            try 
            { 
                // Execute the query 
                $stmt = $db->prepare($query); 
                $result = $stmt->execute($query_params); 
            } 
            catch(PDOException $ex) 
            { 
                // Note: On a production website, you should not output $ex->getMessage(). 
                // It may provide an attacker with helpful information about your code.  
                die("Failed to run query: " . $ex->getMessage()); 
            } 
             
            // Retrieve results (if any) 
            $row = $stmt->fetch(); 
            if($row) 
            { 
                die("E-mail addressen er allerede i bruk!"); 
            } 
        } 
         
        // If the user entered a new password, we need to hash it and generate a fresh salt 
        // for good measure. 
        if(!empty($_POST['passwordtiss'])) 
        { 
            $salt = dechex(mt_rand(0, 2147483647)) . dechex(mt_rand(0, 2147483647)); 
            $password = hash('sha256', $_POST['passwordtiss'] . $salt); 
            for($round = 0; $round < 65536; $round++) 
            { 
                $password = hash('sha256', $password . $salt); 
            } 
        } 
        else 
        { 
            // If the user did not enter a new password we will not update their old one. 
            $password = null; 
            $salt = null; 
        } 
         
        // Initial query parameter values 
        $query_params = array( 
            ':email' => $_POST['email'], 
            ':user_id' => $_SESSION['user']['id'], 
            ':nick' => $_POST['nick'],
            ':nr' => $_POST['nr'],
            ':kontonr' => $_POST['kontonr']
        ); 
         
        // If the user is changing their password, then we need parameter values 
        // for the new password hash and salt too. 
        if($password !== null) 
        { 
            $query_params[':password'] = $password; 
            $query_params[':salt'] = $salt; 
        } 
         
        // Note how this is only first half of the necessary update query.  We will dynamically 
        // construct the rest of it depending on whether or not the user is changing 
        // their password. 
        $query = " 
            UPDATE morten_users 
            SET 
                email = :email 
                , username = :nick
                , nr = :nr
                , kontonr = :kontonr
        "; 
         
        // If the user is changing their password, then we extend the SQL query 
        // to include the password and salt columns and parameter tokens too. 
        if($password !== null) 
        { 
            $query .= " 
                , password = :password 
                , salt = :salt 
            "; 
        } 
         
        // Finally we finish the update query by specifying that we only wish 
        // to update the one record with for the current user. 
        $query .= " 
            WHERE 
                id = :user_id 
        "; 
         
        try 
        { 
            // Execute the query 
            $stmt = $db->prepare($query); 
            $result = $stmt->execute($query_params); 
        } 
        catch(PDOException $ex) 
        { 
            // Note: On a production website, you should not output $ex->getMessage(). 
            // It may provide an attacker with helpful information about your code.  
            die("Failed to run query: " . $ex->getMessage()); 
        } 
         
        // Now that the user's E-Mail address has changed, the data stored in the $_SESSION 
        // array is stale; we need to update it so that it is accurate. 
        $_SESSION['user']['email'] = $_POST['email']; 
        $_SESSION['user']['username'] = $_POST['nick'];
        $_SESSION['user']['nr'] = $_POST['nr'];
        $_SESSION['user']['kontonr'] = $_POST['kontonr'];
         
        // This redirects the user back to the members-only page after they register 
        header("Location: edit_account.php"); 
         
        // Calling die or exit after performing a redirect using the header function 
        // is critical.  The rest of your PHP script will continue to execute and 
        // will be sent to the user if you do not die or exit. 
        die("Redirecting to edit_account.php"); 
    } 
     
?> 
<?php include("head.php") ?>
<body>
    <?php include("header.php") ?>
        <div class="jumbotron">
         <div class="container alignleft">
            <h1 style="font-size: 60px";>Konto</h1>
            <div class="upacf">
            <form action="edit_account.php" method="post"> 
              <table>
                <thead>
                    <tr>
                        <td colspan="2">Brukerinformasjon</td>
                    </tr>
                </thead>
                 <tr>
                   <td>Nick</td>
                   <td><input name="nick" type="text" value="<?php echo htmlentities($_SESSION['user']['username'], ENT_QUOTES, 'UTF-8'); ?>" />
                </tr>
                 <tr>
                   <td>Email</td>
                   <td><input name="email" type="email" value="<?php echo htmlentities($_SESSION['user']['email'], ENT_QUOTES, 'UTF-8'); ?>" />
                </tr>
                 <tr>
                   <td>Mobilnr</td>
                   <td><input name="nr" type="number" value="<?php echo htmlentities($_SESSION['user']['nr'], ENT_QUOTES, 'UTF-8'); ?>" />
                </tr>
                 <tr>
                   <td>Kontonr</td>
                   <td><input name="kontonr" type="text" value="<?php echo htmlentities($_SESSION['user']['kontonr'], ENT_QUOTES, 'UTF-8'); ?>" />
                </tr>
                <tr>
                   <td colspan="2">
                    <br />
                    <button type="submit" class="btn btn-success moveman newsub"><span class="glyphicon glyphicon-floppy-disk"></span> Lagre</button>

                    <a href="new_pass.php"><button type="button" class="btn btn-success redi moveman newsub"><span class="glyphicon glyphicon-question-sign"></span> Nytt Passord</button></a>

                </td>
                </tr>
              </table> 
            </form>
            </div>
            <div class="upacf">
             <form enctype="multipart/form-data" action="actions/change_img.php" method="POST">
              <table>
                <thead>
                    <tr>
                        <td colspan="2">Oppdater Profilbilde</td>
                    </tr>
                </thead><?php
                if (isset($_GET['up'])) {
                if ($_GET['up'] == "true"){
                ?>
                <tr>
                    <td><br /><strong><span class="glyphicon glyphicon-thumbs-up"></span> Bildet ble oppdatert</strong></td>
                </tr>
                <?php
                }
                }
                ?>
                 <tr>
                    <td><br /><input name="uploaded" accept="image/*" type="file" /><br />
                    <button class="btn btn-success moveman newsub" type="submit"><span class="glyphicon glyphicon-upload"></span> Last Opp</button>
                </td>
            </tr>
        </table>
             </form> 
            </div>
            <div class="clear"></div>
         </div> <!-- container -->
        </div> <!-- jumbotron -->
    <?php include("script.php") ?>
    <!--<script src="js/dropzone.js"></script>
    <script>
    $(document).ready(function(){
        $('input[type="file"]').hide();
        $(".dz-default span").text("Slipp bildet her");

        
    });
    </script>-->
    <?php include("footer.php") ?>
</body>
</html>
