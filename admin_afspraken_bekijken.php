<?php
$content = new TemplatePower("template/admin_afspraken_bekijken.tpl");
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
                WHERE af.id = :afspraak_id
                AND a.id = af.aanvraag_id
                AND g.id = gaf.gebruiker_id
                AND af.id = gaf.afspraak_id");
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
                        $select_monteur = $db->prepare("SELECT g. *
                            FROM gebruiker g, afspraak af, gebruiker_afspraak gaf
                            WHERE af.id = :afspraak_id
                            AND g.account_type =  'monteur'
                            AND af.id = gaf.afspraak_id
                            AND g.id = gaf.gebruiker_id");
                        $select_monteur->bindParam(":afspraak_id",$_GET['afid']);
                        $select_monteur->execute();

                        while($monteur = $select_monteur->fetch(PDO::FETCH_ASSOC))
                        {
                            $content->assign(array(
                                "AFID" => $row['id'],
                                "AID" => $row['aanvraag_id'],
                                "AANVRAAG" => $row['aanvraag'],
                                "DATUM" => $row['datum'],
                                "TIJD" => $row['tijd'],
                                "OPMERKING" => $row['opmerking'],
                                "KID" => $rij['id'],
                                "MNAAM" => $monteur['naam'],
                                "MTUSSENVOEGSEL" => $monteur['tussenvoegsel'],
                                "MACHTERNAAM" => $monteur['achternaam']
                            ));
                        }
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
        break;
    default:
        $select_afspraken = $db->query("SELECT af. * , a.aanvraag, DATE_FORMAT( af.datum,  '%d-%m-%Y' ) AS datum, DATE_FORMAT( af.tijd,  '%h:%i' ) AS tijd, g.id AS klant_id
            FROM afspraak af, aanvraag a, gebruiker g, gebruiker_afspraak gaf
            WHERE g.account_type =  'klant'
            AND a.id = af.aanvraag_id
            AND g.id = gaf.gebruiker_id
            AND af.id = gaf.afspraak_id
            AND af.id NOT IN (
                SELECT af.id
                FROM afspraak af, afgeronde_afspraken afaf
                WHERE af.id = afaf.afspraak_id
            )");

        if($select_afspraken->rowCount() > 0)
        {
            $content->newBlock("OVERZICHT");
            while($row = $select_afspraken->fetch(PDO::FETCH_ASSOC))
            {
                // Selecteer de klant-gegevens
                $select_monteur = $db->prepare("SELECT g. *
                    FROM gebruiker g, afspraak af, gebruiker_afspraak gaf
                    WHERE af.id = :afspraak_id
                    AND g.account_type =  'monteur'
                    AND af.id = gaf.afspraak_id
                    AND g.id = gaf.gebruiker_id");
                $select_monteur->bindParam(":afspraak_id",$row['id']);
                $select_monteur->execute();

                while($rij = $select_monteur->fetch(PDO::FETCH_ASSOC))
                {
                    // Aanvraag verkorten zodat het in het tabel past
                    $row['aanvraag'] = substr($row['aanvraag'],0,100);

                    $content->newBlock("AFSPRAKEN");
                    $content->assign(array(
                        "AFID" => $row['id'],
                        "KID" => $row['klant_id'],
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
        else
        {
            // Geen afspraken
            $content->newBlock("GEEN_AFSPRAKEN");
        }
        break;
}

