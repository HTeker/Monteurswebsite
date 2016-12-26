<?php
$content = new TemplatePower("template/monteur_afspraken_bekijken.tpl");
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
    case "details":
        if(isset($_GET['afid']))
        {
            // Er staat een afspraakid in de url
            $select_afspraak = $db->prepare("SELECT af . * , a.aanvraag, DATE_FORMAT(af.datum,'%d-%m-%Y') AS datum,
                DATE_FORMAT(af.tijd,'%h:%i') AS tijd
                FROM afspraak af, aanvraag a, gebruiker g, gebruiker_afspraak gaf
                WHERE g.id = :gebruiker_id
                AND af.id = :afspraak_id
                AND a.id = af.aanvraag_id
                AND g.id = gaf.gebruiker_id
                AND af.id = gaf.afspraak_id");
            $select_afspraak->bindParam(":gebruiker_id",$_SESSION['gebruiker_id']);
            $select_afspraak->bindParam(":afspraak_id",$_GET['afid']);
            $select_afspraak->execute();

            if($select_afspraak->rowCount() > 0)
            {
                $content->newBlock("DETAILS");
                // Selecteer de klant
                while($row = $select_afspraak->fetch(PDO::FETCH_ASSOC))
                {
                    $select_klant = $db->prepare("SELECT g. *
                        FROM gebruiker g, afspraak af, gebruiker_afspraak gaf
                        WHERE af.id = :afspraak_id
                        AND g.account_type =  'klant'
                        AND af.id = gaf.afspraak_id
                        AND g.id = gaf.gebruiker_id");
                    $select_klant->bindParam(":afspraak_id",$_GET['afid']);
                    $select_klant->execute();

                    while($rij = $select_klant->fetch(PDO::FETCH_ASSOC))
                    {
                        $content->assign(array(
                            "AFID" => $row['id'],
                            "AID" => $row['aanvraag_id'],
                            "AANVRAAG" => $row['aanvraag'],
                            "DATUM" => $row['datum'],
                            "TIJD" => $row['tijd'],
                            "OPMERKING" => $row['opmerking'],
                            "KID" => $rij['id']
                        ));
                    }
                }
            }
            else
            {
                // geen afspraken
                $content->newBlock("404");
            }
        }
        else
        {
            // Er staat geen id in de url
        }
/*        if(isset($_GET['afid']))
        {
            // Er is een afspraakid in de url, select afspraken
            $select_afspraken = $db->prepare("SELECT af . * , a.aanvraag, DATE_FORMAT(af.datum,'%d-%m-%Y') AS datum,
            DATE_FORMAT(af.tijd,'%h:%i') AS tijd
            FROM afspraak af, aanvraag a, gebruiker g, gebruiker_afspraak gaf
            WHERE g.id = :gebruiker_id
            AND a.id = af.aanvraag_id
            AND g.id = gaf.gebruiker_id
            AND af.id = gaf.afspraak_id");
            $select_afspraken->bindParam(":gebruiker_id",$_SESSION['gebruiker_id']);
            $select_afspraken->execute();

            if($select_afspraken->rowCount() > 0)
            {
                // Selecteer de bijhorende monteur
                while($row = $select_afspraken->fetch(PDO::FETCH_ASSOC))
                {
                    $select_monteur = $db->prepare("SELECT g . *
                        FROM gebruiker g, afspraak af, gebruiker_afspraak gaf
                        WHERE af.id = :afspraak_id
                        AND g.account_type =  'monteur'
                        AND af.id = gaf.afspraak_id
                        AND g.id = gaf.gebruiker_id");
                    $select_monteur->bindParam(":afspraak_id",$_GET['afid']);
                    $select_monteur->execute();

                    while($rij = $select_monteur->fetch(PDO::FETCH_ASSOC))
                    {
                        $content->newBlock("DETAILS");
                        $content->assign(array(
                            "AFID" => $row['id'],
                            "AID" => $row['aanvraag_id'],
                            "AANVRAAG" => $row['aanvraag'],
                            "DATUM" => $row['datum'],
                            "TIJD" => $row['tijd'],
                            "MNAAM" => $rij['naam'],
                            "MTUSSENVOEGSEL" => $rij['tussenvoegsel'],
                            "MACHTERNAAM" => $rij['achternaam']
                        ));

                    }
                }
            }

        }
        else
        {
            $content->newBlock("404");
        }*/
        break;
    case "afronden":
        if(isset($_GET['afid']))
        {
            // er staat een afspraakid in de url
            if(isset($_POST['submit']))
            {
                // Formulier is verstuurd
                // Controleren of vereiste velden zijn ingevuld
                $bError = false;
                $aVereist = array("omschrijving","werkzaamheden","materialen");
                $aErrorVelden = array();
                $sMeldingen = NULL;

                foreach($aVereist as $sVeld)
                {
                    if($_POST[$sVeld] == '')
                    {
                        $bError = true;
                        $aErrorVelden[] = $sVeld;
                    }
                }

                if(!$bError)
                {
                    // Alle velden zijn ingevuld, verwerk
                    $insert_afspraak = $db->prepare("INSERT INTO afgeronde_afspraken SET
                        afspraak_id = :afspraak_id,
                        omschrijving = :omschrijving,
                        werkzaamheden = :werkzaamheden,
                        materialen = :materialen");
                    $insert_afspraak->bindParam(":afspraak_id",$_GET['afid']);
                    $insert_afspraak->bindParam(":omschrijving",$_POST['omschrijving']);
                    $insert_afspraak->bindParam(":werkzaamheden",$_POST['werkzaamheden']);
                    $insert_afspraak->bindParam(":materialen",$_POST['materialen']);
                    $insert_afspraak->execute();

                    $content->newBlock("AFGEROND");
                }
                else
                {
                    // Vereiste velden zijn niet ingevuld, toon melding
                    $content->newBlock("AFRONDEN");
                    $content->assign("AFID",$_GET['afid']);
                    $content->newBlock("MELDING");
                    $sMeldingen = NULL; // Variabele aanmaken om error-meldingen in op te slaan
                    foreach($aErrorVelden as $sVeld)
                    {
                        $sMeldingen = $sMeldingen."<li>U dient <b style='font-size: 16px;'>".$sVeld."</b> in te vullen</li>";
                        $content->assign("MELDING", $sMeldingen);
                    }
                }
            }
            else
            {
                // de knop is nog niet ingedrukt
                $content->newBlock("AFRONDEN");
                $content->assign("AFID",$_GET['afid']);
            }
        }
        else
        {
            // er staat geen afspraakid in de url
            $content->newBlock("404");
        }
        break;
    default:
        $select_afspraken = $db->prepare("SELECT af . * , DATE_FORMAT( af.datum,  '%d-%m-%Y' ) AS datum, DATE_FORMAT( af.tijd,  '%h:%i' ) AS tijd, a.aanvraag
            FROM aanvraag a, afspraak af, gebruiker g, gebruiker_afspraak gaf
            WHERE g.id = :monteur_id
            AND g.account_type =  'monteur'
            AND g.id = gaf.gebruiker_id
            AND af.id = gaf.afspraak_id
            AND a.id = af.aanvraag_id
            AND af.id NOT IN (
                SELECT af.id
                FROM afspraak af, afgeronde_afspraken afaf
                WHERE af.id = afaf.afspraak_id
            )");
        $select_afspraken->bindParam(":monteur_id",$_SESSION['gebruiker_id']);
        $select_afspraken->execute();

        if($select_afspraken->rowCount() > 0)
        {
            $content->newBlock("OVERZICHT");
            while($row = $select_afspraken->fetch(PDO::FETCH_ASSOC))
            {
                // Aanvraag verkorten zodat het in het tabel past
                $row['aanvraag'] = substr($row['aanvraag'],0,100);

                // Selecteer de klant-gegevens
                $select_klant = $db->prepare("SELECT g. *
                    FROM gebruiker g, afspraak af, gebruiker_afspraak gaf
                    WHERE af.id = :afspraak_id
                    AND g.account_type =  'klant'
                    AND af.id = gaf.afspraak_id
                    AND g.id = gaf.gebruiker_id");
                $select_klant->bindParam(":afspraak_id",$row['id']);
                $select_klant->execute();

                while($rij = $select_klant->fetch(PDO::FETCH_ASSOC))
                {
                    $content->newBlock("AFSPRAKEN");
                    $content->assign(array(
                        "AFID" => $row['id'],
                        "KID" => $rij['id'],
                        "AID" => $row['aanvraag_id'],
                        "AANVRAAG" => $row['aanvraag'],
                        "DATUM" => $row['datum'],
                        "TIJD" => $row['tijd']
                    ));
                }
            }
        }
        else
        {
            // Geen afspraken
            $content->newBlock("GEEN_AFSPRAKEN");
        }
        break;
}

