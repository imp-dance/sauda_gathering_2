<?php include("head.php");
include("header.php"); 
if(!empty($_POST)) 
    { /* start post */ 
        $phonenumber = $_REQUIRE['number'];
        $op = $_REQUIRE['op'];
        if (empty($op) || empty($phonenumber)){
            $error = "Fyll inn alle felt";
        }else{

            $message = "Ditt brukernamn er X, emailen din er X og koden din for passord-reset er X - Mvh Sauda Gathering";
            switch($op){
                case "netcom":
                 mail($phonenumber."@sms.netcom.no", "", $message, "From: Sauda Gathering <schart@schart.net>\r\n");
                break;
                case "telenor":
                 mail($phonenumber."@mobilpost.no", "", $message, "From: Sauda Gathering <schart@schart.net>\r\n");
                break;
                case "djuice":

                break;
                case "onecall":

                break;
                case "talkmore":

                break;
                case "chess":

                break;
                case "icenet":

                break;
                case "pepcall":

                break;
                default: 
                  die("pikk");
                break;
            }



            
        }

    } /* end post */
?>
<style>
.SGbigone{
    width:100%;
    margin:10px 0;
}
.SGbigone td{
    padding-bottom:5px;
}
.SGbigone select{
    width:100%;
}
</style>
<div class="super_container">
<div id="jumbotron">
        <div class="jumbotron">
            <div class="container">
                <h1 style="">Glemt brukerinformasjon?</h1>
            </div>
        </div>
        <div class="container" style="padding:20px;min-height:350px;">

            <ul class="nav nav-tabs">
              <li role="presentation" class="active brukem"><a href="#" class="brukemailb">Bruk Email</a></li>
              <li role="presentation" class="bruknu"><a href="#" class="bruknumb">Bruk nummer</a></li>
            </ul>

            <div class="bruknum">
            <form action="forgot_password.php" method="post">
                    <table class="SGbigone">
                        <tr>
                            <td>Ditt Mobilnummer:</td>
                            <td><input type="number" class="form-control" /></td>
                        </tr>
                        <tr>
                            <td>Din operatør:</td>
                            <td>
                                <select name="op">
                                    <option value="netcom">Netcom</option>
                                    <option value="telenor">Telenor</option>
                                    <option value="djuice">Djuice</option>
                                    <option value="onecall">OneCall</option>
                                    <option value="talkmore">Talkmore</option>
                                    <option value="chess">Chess</option>
                                    <option value="icenet">Ice.net</option>
                                    <option value="pepcall">Pepcall</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td><button type="submit" class="btn btn-info moveman">Fortsett</button>
                        </tr>
                    </table>
                </form>
            </div>
            <div class="brukemail">
                <form action="resetpass.php" method="post">
                    <table class="SGbigone">
                        <tr>
                            <td><input type="text" class="form-control" name="email" placeholder="Din E-Mail" /></td>
                        </tr>
                        <tr>
                            <td><button class="btn btn-info" type="submit">Fortsett</button></td>
                        </tr>
                    </table>
                </form>
            </div>

        </div>
                 
            </div>
        </div>
    </div>
</div>
<?php
include("script.php");
?>
<script>
$(document).ready(function(){
    $(".bruknum").hide();
    $(".bruknumb").click(function(){
        $(".brukemail").hide();
        $(".brukem").removeClass("active");
        $(".bruknum").show();
        $(".bruknu").addClass("active");
    });
    $(".brukemailb").click(function(){
        $(".brukemail").show();
        $(".brukem").addClass("active");
        $(".bruknum").hide();
        $(".bruknu").removeClass("active");
    });
});
</script>
<?php
include("footer.php"); ?>
