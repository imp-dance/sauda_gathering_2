<?php include("head.php"); 
// At the top of the page we check to see whether the user is logged in or not 
    /*if(empty($_SESSION['user'])) 
    { 
        // If they are not, we redirect them to the login page. 
        echo('<meta http-equiv="refresh" content="0; url=login.php">');
         
        // Remember that this die statement is absolutely critical.  Without it, 
        // people can view your members-only content without logging in. 
        die("Redirecting to login.php"); 
    } */
     
    // Everything below this point in the file is secured by the login system 
     
    // We can retrieve a list of members from the database using a SELECT query. 
    // In this case we do not have a WHERE clause because we want to select all 
    // of the rows from the database table. 
    $query = " 
        SELECT 
            id, 
            username, 
            email 
        FROM morten_users 
        ORDER BY username
    "; 
     
    try 
    { 
        // These two statements run the query against your database table. 
        $stmt = $db->prepare($query); 
        $stmt->execute(); 
    } 
    catch(PDOException $ex) 
    { 
        // Note: On a production website, you should not output $ex->getMessage(). 
        // It may provide an attacker with helpful information about your code.  
        die("Failed to run query: " . $ex->getMessage()); 
    } 
         
    // Finally, we can retrieve all of the found rows into an array using fetchAll 
    $rows = $stmt->fetchAll(); 
?>
<body>
    <?php include("header.php"); ?>
        <div class="jumbotron">
         <div class="container">
            <h1 style="font-size: 60px";>Påmeldte</h1>
            <div class="fuckthis">
            <span class="input_field glyphicon glyphicon-search"></span>
            <input type="text" id="search" class="widesearch" value="<?php if(!empty($_REQUEST['sdata'])){echo($_REQUEST['sdata']);} ?>" placeholder="Trykk her for å søke etter brukere"/>
        </div>
            <table class="memberlist">
            	<?php foreach($rows as $row): ?> 
        <tr class="member"> 
            <td>#<?php echo $row['id']; ?></td> <!-- htmlentities is not needed here because $row['id'] is always an integer --> 
            <td class="membername"><a href="profile.php?id=<?php echo $row['id']; ?>"><?php echo htmlentities($row['username'], ENT_QUOTES, 'UTF-8'); ?></a></td> 
            <!-- <td><?php /* echo htmlentities($row['email'], ENT_QUOTES, 'UTF-8'); */ ?></td>  -->
        </tr> 
    <?php endforeach; ?> 
            </table>
         </div> <!-- container -->
        </div> <!-- jumbotron -->
    <?php include("script.php"); ?>
    <script>
    $("#search").keyup(function(){
        _this = this;
        // Show only matching TR, hide rest of them
        $.each($(".memberlist tbody").find("tr"), function() {
            console.log($(this).text());
            if($(this).text().toLowerCase().indexOf($(_this).val().toLowerCase()) == -1)
               $(this).hide();
            else
                 $(this).show();                
        });
    }); 
    $(document).ready(function(){
        $("#search").keyup();
        $("#search").focus();
    })
    </script>
    <?php include("footer.php"); ?>
</body>
</html>