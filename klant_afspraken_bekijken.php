<?php
$content = new TemplatePower("template/klant_afspraken_bekijken.tpl");
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
            // Er is een afspraakid in de url, select afspraken
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
                // Selecteer de bijhorende monteur
                while($row = $select_afspraak->fetch(PDO::FETCH_ASSOC))
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
        }
        break;
    default:
        $select_afspraken = $db->prepare("SELECT af. * , a.aanvraag, DATE_FORMAT( af.datum,  '%d-%m-%Y' ) AS datum, DATE_FORMAT( af.tijd,  '%h:%i' ) AS tijd
            FROM afspraak af, aanvraag a, gebruiker g, gebruiker_afspraak gaf
            WHERE g.id = :gebruiker_id
            AND a.id = af.aanvraag_id
            AND g.id = gaf.gebruiker_id
            AND af.id = gaf.afspraak_id
            AND af.id NOT IN (
                SELECT af.id
                FROM afspraak af, afgeronde_afspraken afaf
                WHERE af.id = afaf.afspraak_id
            )");
        $select_afspraken->bindParam(":gebruiker_id",$_SESSION['gebruiker_id']);
        $select_afspraken->execute();

        if($select_afspraken->rowCount() > 0)
        {
            $content->newBlock("OVERZICHT");
            while($row = $select_afspraken->fetch(PDO::FETCH_ASSOC))
            {
                // Aanvraag verkorten zodat het in het tabel past
                $row['aanvraag'] = substr($row['aanvraag'],0,100);

                $content->newBlock("AFSPRAKEN");
                $content->assign(array(
                    "AFID" => $row['id'],
                    "AID" => $row['aanvraag_id'],
                    "AANVRAAG" => $row['aanvraag'],
                    "DATUM" => $row['datum'],
                    "TIJD" => $row['tijd']
                ));
            }
        }
        else
        {
            // Geen afspraken
            $content->newBlock("GEEN_AFSPRAKEN");
        }
        break;
}

