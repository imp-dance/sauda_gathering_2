<?php include("head.php");
include("header.php"); 
if(!empty($_POST)) 
    { /* start post */ 
        $phonenumber = $_REQUIRE['number'];
        $op = $_REQUIRE['op'];
        if (empty($op) || empty($phonenumber)){
            $error = "Fyll inn alle felt";
        }else{

            $message = "";
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
<div id="jumbotron">
    <div class"supercontainer">
        <div class="jumbotron">
            <div class="container">
                <h1 style="">Glemt brukerinformasjon?</h1>
                <form action="forgot_password.php" method="post">
                    <table>
                        <tr>
                            <td>Ditt Mobilnummer:</td>
                            <td><input type="number" /></td>
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
                            <td><button type="submit" class="btn btn-success moveman">Fortsett</button>
                        </tr>
                    </table>
                </form>
            </div>
        </div>
    </div>
</div>
<?php include("footer.php");
include("script.php"); ?>
