<?php
$content = new TemplatePower("template/admin_aanvragen_bekijken.tpl");
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
    case "inplannen":
        if(isset($_GET['aid']))
        {
            function toonAanvraagGegevens($db,$content)
            {
                $select_aanvraaginfo = $db->prepare("SELECT a.*, a.id AS aanvraag_id, g.*, g.id AS gebruiker_id,
                    DATE_FORMAT(a.datum,'%d-%m-%Y') AS datum
                    FROM aanvraag a, gebruiker g, gebruiker_aanvraag ga
                    WHERE a.id = :aanvraag_id
                    AND a.id = ga.aanvraag_id
                    AND g.id = ga.gebruiker_id
                    AND g.account_type = 'klant'");
                $select_aanvraaginfo->bindParam(":aanvraag_id",$_GET['aid']);
                $select_aanvraaginfo->execute();

                if($select_aanvraaginfo->rowCount() > 0)
                {
                    $content->newBlock("INPLANNEN");
                    while($a = $select_aanvraaginfo->fetch(PDO::FETCH_ASSOC))
                    {
                        $content->assign(array(
                            "AID" => $_GET['aid'],
                            "KID" => $a['gebruiker_id'],
                            "KNAAM" => $a['naam'],
                            "KTUSSENVOEGSEL" => $a['tussenvoegsel'],
                            "KACHTERNAAM" => $a['achternaam'],
                            "DATUM" => $a['datum'],
                            "TIJDSEENHEID" => $a['tijdseenheid'],
                            "AANVRAAG" => $a['aanvraag']
                        ));
                        return $a;
                    }
                }
            }

            function toonMonteurGegevens($db,$content)
            {
                $select_monteurs = $db->query("SELECT * FROM gebruiker
                    WHERE account_type = 'monteur'
                    AND actief = '1'");

                while($m = $select_monteurs->fetch(PDO::FETCH_ASSOC))
                {
                    $content->newBlock("MONTEURS");
                    $content->assign(array(
                        "MNAAM" => $m['naam'],
                        "MTUSSENVOEGSEL" => $m['tussenvoegsel'],
                        "MACHTERNAAM" => $m['achternaam'],
                        "MID" => $m['id']
                    ));
                }
            }

            function selectAanvraagGegevens($db,$content)
            {
                $select_aanvraaginfo = $db->prepare("SELECT a.*, a.id AS aanvraag_id, g.*, g.id AS gebruiker_id,
                    DATE_FORMAT(a.datum,'%d-%m-%Y') AS datum
                    FROM aanvraag a, gebruiker g, gebruiker_aanvraag ga
                    WHERE a.id = :aanvraag_id
                    AND a.id = ga.aanvraag_id
                    AND g.id = ga.gebruiker_id
                    AND g.account_type = 'klant'");
                $select_aanvraaginfo->bindParam(":aanvraag_id",$_GET['aid']);
                $select_aanvraaginfo->execute();

                if($select_aanvraaginfo->rowCount() > 0)
                {
                    while($a = $select_aanvraaginfo->fetch(PDO::FETCH_ASSOC))
                    {
                        return $a;
                    }
                }
            }

            if(isset($_POST['submit']))
            {
                // Plan in is ingedrukt, controleer of er tijden zijn ingevuld en of monteur niet op default staat
                if($_POST['uur'] != "" AND $_POST['min'] != "" AND $_POST['monteur_id'] != "default" AND $_POST['opmerking'] != "")
                {
                    $bError = true;

                    // Alles is ingevuld, check of ingevulde tijden valide zijn
                    $uren = array();
                    $minuten = array();

                    // genereer uren
                    for($i=0;$i<=23;$i++)
                    {
                        if(strlen((string)$i) == 1)
                        {
                            $uren[] = "0".$i."";
                        }
                        else
                        {
                            $uren[] = "".$i."";
                        }
                    }

                    // genereer minuten
                    for($i=0;$i<=59;$i++)
                    {
                        if(strlen((string)$i) == 1)
                        {
                            $minuten[] = "0".$i."";
                        }
                        else
                        {
                            $minuten[] = "".$i."";
                        }
                    }

                    if(in_array($_POST['uur'],$uren) AND in_array($_POST['min'],$minuten))
                    {
                        // De arrays van de functies in deze variabelen returnen
                        $a = selectAanvraagGegevens($db,$content);

                        // De datum in de juiste formaat zetten
                        $dag = substr($a['datum'],0,2);
                        $maand = substr($a['datum'],3,2);
                        $jaar = substr($a['datum'],6,4);
                        $datum = $jaar."-".$maand."-".$dag;

                        // Tijd in juiste formaat zetten
                        $tijd = $_POST['uur'].":".$_POST['min'];

                        $insert_afspraak = $db->prepare("INSERT INTO afspraak SET
                        opmerking = :opmerking,
                        datum = :datum,
                        tijd = :tijd,
                        aanvraag_id = :aanvraag_id");
                        $insert_afspraak->bindParam(":opmerking", $_POST['opmerking']);
                        $insert_afspraak->bindParam(":datum",$datum);
                        $insert_afspraak->bindParam(":tijd",$tijd);
                        $insert_afspraak->bindParam(":aanvraag_id",$_GET['aid']);
                        $insert_afspraak->execute();
                        $afspraak_id = $db->lastInsertId();

                        $insert_koppeling_klant =$db->prepare("INSERT INTO gebruiker_afspraak SET
                        gebruiker_id = :klant_id,
                        afspraak_id = :afspraak_id");
                        $insert_koppeling_klant->bindParam(":klant_id",$a['gebruiker_id']);
                        $insert_koppeling_klant->bindParam(":afspraak_id",$afspraak_id);
                        $insert_koppeling_klant->execute();

                        $insert_koppeling_monteur = $db->prepare("INSERT INTO gebruiker_afspraak SET
                        gebruiker_id = :gebruiker_id,
                        afspraak_id = :afspraak_id");
                        $insert_koppeling_monteur->bindParam(":gebruiker_id",$_POST['monteur_id']);
                        $insert_koppeling_monteur->bindParam(":afspraak_id",$afspraak_id);
                        $insert_koppeling_monteur->execute();

                        $content->newBlock("INGEPLAND");
                        header("Refresh: 1.5; url=index.php?id=21");
                    }
                    else
                    {
                        // Geen geldige tijd, toon melding
                        toonAanvraagGegevens($db,$content);
                        toonMonteurGegevens($db,$content);
                        $content->newBlock("MELDING");
                        $content->assign("MELDING", "<li><b>".$_POST['uur'].":".$_POST['min']."</b> is geen geldige tijd</li>");
                    }
                }
                else
                {
                    toonAanvraagGegevens($db,$content);
                    toonMonteurGegevens($db,$content);
                    $content->newBlock("MELDING");
                    $content->assign("MELDING", "<li>U heeft niet alle velden ingevuld</li>");
                }
            }
            else
            {
                toonAanvraagGegevens($db,$content);
                toonMonteurGegevens($db,$content);
            }
        }
        else
        {
            // geen aanvraagid, toon 404
            $content->newBlock("404");
        }
        break;
    case "annuleren":
        if(isset($_GET['aid']))
        {
            $annuleer_aanvraag = $db->prepare("UPDATE aanvraag SET status = 0 WHERE id = :aanvraag_id");
            $annuleer_aanvraag->bindParam(":aanvraag_id",$_GET['aid']);
            $annuleer_aanvraag->execute();

            // Selecteer gegevens van de klant
            $select_klant = $db->prepare("SELECT g . *, g.id AS gebruiker_id , a . *, a.id AS aanvraag_id , DATE_FORMAT(a.datum,'%d-%m-%Y') AS datum
                FROM gebruiker g, aanvraag a, gebruiker_aanvraag ga
                WHERE account_type =  'klant'
                AND a.id = :aanvraag_id
                AND ga.aanvraag_id = a.id
                AND ga.gebruiker_id = g.id");
            $select_klant->bindParam(":aanvraag_id",$_GET['aid']);
            $select_klant->execute();

            while($row = $select_klant->fetch(PDO::FETCH_ASSOC))
            {
                // Verstuur e-mail naar de klant

                /* VERSTUUR EMAIL */
                // multiple recipients
                $to  = $row['email'];

                // subject
                $subject = 'Uw aanvraag is geannuleerd';

                // message
                $message = "
                <html>
                <head>
                  <title>Uw aanvraag is geannuleerd</title>
                </head>
                <body>
                  Hallo <b>".$row['naam']."</b>, <br><br>
                  Uw aanvraag voor <b>".$row['datum']."</b> tussen <b>".$row['tijdseenheid']."</b> met de aanvraag-ID:
                  <b>".$row['aanvraag_id']."</b> is geannuleerd.
                  <br><br> Als u de reden hiervoor wilt weten, neemt u dan contact op met ons via onze
                  <a href='http://www.mijnketeldoethetniet.comxa.com/index.php?id=2'>online contact-formulier</a>.<br><br>
                  Met vriendelijke groeten,<br>
                  M. Teker
                </body>
                </html>
                ";

                // To send HTML mail, the Content-type header must be set
                $headers  = 'MIME-Version: 1.0' . "\r\n";
                $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

                // Mail it
                mail($to, $subject, $message, $headers);

                $content->newBlock("GEANNULEERD");
                header("Refresh: 2; url=index.php?id=21");
                /* VERSTUUR EMAIL */
            }
        }
        else
        {
            // geen aanvraagid in url, toon 404
            $content->newBlock("404");
        }
        break;
    case "details":
        if(isset($_GET['aid']))
        {
            // er staat een aanvraagid in url, haal gegevens van de aanvraag op
            $select_aanvraaginfo = $db->prepare("SELECT a . * , DATE_FORMAT( a.datum,  '%d-%m-%Y' ) AS datum,
                g.id AS klant_id, g.naam, g.tussenvoegsel, g.achternaam
                FROM aanvraag a, gebruiker g, gebruiker_aanvraag ga
                WHERE a.id NOT
                IN (

                SELECT a.id
                FROM afspraak af, aanvraag a
                WHERE a.id = af.aanvraag_id
                )
                AND a.id = ga.aanvraag_id
                AND g.id = ga.gebruiker_id
                AND a.id = :aanvraag_id");
            $select_aanvraaginfo->bindParam(":aanvraag_id",$_GET['aid']);
            $select_aanvraaginfo->execute();

            // print info naar pagina
            while($row = $select_aanvraaginfo->fetch(PDO::FETCH_ASSOC))
            {
                $content->newBlock("DETAILS");
                $content->assign(array(
                    "AID" => $_GET['aid'],
                    "KID" => $row['klant_id'],
                    "NAAM" => $row['naam'],
                    "TUSSENVOEGSEL" => $row['tussenvoegsel'],
                    "ACHTERNAAM" => $row['achternaam'],
                    "DATUM" => $row['datum'],
                    "TIJDSEENHEID" => $row['tijdseenheid'],
                    "AANVRAAG" => $row['aanvraag']
                ));
            }
        }
        else
        {
            // er staat geen aanvraagid in url, toon 404
            $content->newBlock("404");
        }
        break;
    default:
        // Selecteer alle aanvragen die niet gekoppeld zijn aan een afspraak
        $select_aanvragen = $db->query("SELECT a . * , DATE_FORMAT( a.datum,  '%d-%m-%Y' ) AS datum, g.id AS klant_id
            FROM aanvraag a, gebruiker g, gebruiker_aanvraag ga
            WHERE a.id NOT
            IN (

            SELECT a.id
            FROM afspraak af, aanvraag a
            WHERE a.id = af.aanvraag_id
            )
            AND a.status IS NULL
            AND a.id = ga.aanvraag_id
            AND g.id = ga.gebruiker_id");

        if($select_aanvragen->rowCount() > 0)
        {
            $content->newBlock("OVERZICHT");
            while($row = $select_aanvragen->fetch(PDO::FETCH_ASSOC))
            {
                // Aanvraag verkorten zodat het in het tabel past
                $row['aanvraag'] = substr($row['aanvraag'],0,100);

                $content->newBlock("AANVRAGEN");
                $content->assign(array(
                    "AID" => $row['id'],
                    "KID" => $row['klant_id'],
                    "AANVRAAG" => $row['aanvraag'],
                    "DATUM" => $row['datum'],
                    "TIJDSEENHEID" => $row['tijdseenheid']
                ));
            }
        }
        else
        {
            $content->newBlock("GEEN_AANVRAGEN");
        }
        break;
}