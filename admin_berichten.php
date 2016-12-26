<?php
$content = new TemplatePower("template/admin_berichten.tpl");
$content->prepare();

if(isset($_GET['action']))
{
    $action = $_GET['action'];
}
else
{
    $action = NULL;
}

switch($action)
{
    case "antwoord":
        // Check of er een bericht-id staat in de url
        if(isset($_GET['bid']))
        {
            // Controleer of de bericht-id bestaat in db
            $select_bericht = $db->prepare("SELECT * FROM bericht WHERE id = :bid AND antwoord = 0");
            $select_bericht->bindParam(":bid",$_GET['bid']);
            $select_bericht->execute();

            if($select_bericht->rowCount() == 1)
            {
                // Checl of antwoord is ingevuld
                if(isset($_POST['antwoord']) AND $_POST['antwoord'] != '')
                {
                    // Er is een antwoord ingevuld
                    // zet 'antwoord' in db op '1' (true)
                    // Verstuur email naar de gebruiker
                    // Toon notificatie voor de admin
                    $update_bericht = $db->prepare("UPDATE bericht SET antwoord = 1 WHERE id = :bericht_id");
                    $update_bericht->bindParam(":bericht_id",$_GET['bid']);
                    $update_bericht->execute();

                    // Verstuur email
                    while($row = $select_bericht->fetch(PDO::FETCH_ASSOC))
                    {
                        /* VERSTUUR EMAIL */

                        // multiple recipients
                        $to  = $row['email'];

                        // subject
                        $subject = 'Antwoord op uw bericht!';

                        // message
                        $message = "
                        <html>
                        <head>
                          <title>Uw bericht aan mijnketeldoethetniet.nl</title>
                        </head>
                        <body>
                          Hallo ".$row['naam'].", <br><br>
                          U heeft antwoord ontvangen op uw bericht:<br><br>
                          ".$_POST['antwoord']."<br><br>
                          Hieronder uw bericht:<br><br>
                          ".$row['bericht']."
                        </body>
                        </html>
                        ";

                        // To send HTML mail, the Content-type header must be set
                        $headers  = 'MIME-Version: 1.0' . "\r\n";
                        $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

                        // Mail it
                        mail($to, $subject, $message, $headers);

                        /* VERSTUUR EMAIL */

                        if(isset($_POST['submit']))
                        {
                            $content->newBlock("NOTIFICATIE");
                        }
                    }
                }
                else
                {
                    // stuur bericht-gegevens naar pagina
                    while($row = $select_bericht->fetch(PDO::FETCH_ASSOC))
                    {
                        // Als er geen gebruiker_id is, betekent het dat diegene nog geen klant is, dus wijzig ik hier de variabele
                        if($row['gebruiker_id'] == '')
                        {
                            $row['gebruiker_id'] = "<b>Nog geen klant</b>";
                        }

                        $content->newBlock("ANTWOORD");
                        $content->assign(array(
                            "BID" => $row['id'],
                            "GID" => $row['gebruiker_id'],
                            "NAAM" => $row['naam'],
                            "EMAIL" => $row['email'],
                            "TELNR" => $row['telnr'],
                            "BERICHT" => $row['bericht']
                        ));
                    }

                    // Check of de knop is ingedrukt
                    if(isset($_POST['submit']))
                    {
                        // Antwoord is leeg, toon melding
                        $content->newBlock("MELDING");
                        $content->assign("MELDING", "<li>U heeft nog geen antwoord ingevuld.</li>");
                    }
                }


                /*// Bericht bestaat in db
                if(isset($_POST['submit']))
                {
                    // Controleer of er een antwoord is ingevuld
                    if($_POST['antwoord'] != '')
                    {
                        // Er is een antwoord ingevuld
                        echo "ingevuld";
                    }
                    else
                    {
                        // Antwoord is leeg, toon melding
                        $content->newBlock("ANTWOORD");
                        $content->newBlock("MELDING");
                        $content->assign("MELDING", "<li>U heeft nog geen antwoord ingevuld.</li>");
                    }
                }
                else
                {
                    // stuur bericht-gegevens naar pagina
                    while($row = $select_bericht->fetch(PDO::FETCH_ASSOC))
                    {
                        // Als er geen gebruiker_id is, betekent het dat diegene nog geen klant is, dus wijzig ik hier de variabele
                        if($row['gebruiker_id'] == '')
                        {
                            $row['gebruiker_id'] = "<b>Nog geen klant</b>";
                        }

                        $content->newBlock("ANTWOORD");
                        $content->assign(array(
                        "BID" => $row['id'],
                        "GID" => $row['gebruiker_id'],
                        "NAAM" => $row['naam'],
                        "EMAIL" => $row['email'],
                        "TELNR" => $row['telnr'],
                        "BERICHT" => $row['bericht']
                    ));
                    }
                }*/
            }
            else
            {
                // Ongeldige bericht-id
                echo "fout";
            }
        }
        else
        {
            // Toon melding
        }
        break;
    default:
        // Controleer of er (onbeantwoorde) berichten zijn
        $select_berichten = $db->query("SELECT * FROM bericht WHERE antwoord = 0 ORDER BY datum, tijd, gebruiker_id");

        if($select_berichten->rowCount() > 0)
        {
            // Er zijn berichten
            $content->newBlock("OVERZICHT");

            // Haal alle onbeantwoorden berichten uit db
            while($row = $select_berichten->fetch(PDO::FETCH_ASSOC))
            {
                // Als er geen gebruiker_id is, betekent het dat diegene nog geen klant is, dus wijzig ik hier de variabele
                if($row['gebruiker_id'] == '')
                {
                    $row['gebruiker_id'] = "<b>Nog geen klant</b>";
                }

                $content->newBlock("BERICHTEN");
                $content->assign(array(
                    "BID" => $row['id'],
                    "GID" => $row['gebruiker_id'],
                    "NAAM" => $row['naam'],
                    "BERICHT" => $row['bericht'],
                    "EMAIL" => $row['email'],
                    "TELNR" => $row['telnr']
                ));
            }
        }
        else
        {
            // Er zijn geen berichten
            echo "er zijn geen berichten";
        }
        break;
}