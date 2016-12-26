<?php
$content = new TemplatePower("template/monteur_afgeronde_afspraken_bekijken.tpl");
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
            $select_afspraak = $db->prepare("SELECT afaf.*, g.id AS klant_id, af.aanvraag_id, af.opmerking, a.aanvraag,
                DATE_FORMAT( af.datum,  '%d-%m-%Y' ) AS datum, DATE_FORMAT( af.tijd,  '%h:%i' ) AS tijd
                FROM afgeronde_afspraken afaf, afspraak af, aanvraag a, gebruiker g, gebruiker_aanvraag ga
                WHERE af.id = :afspraak_id
                AND afaf.afspraak_id = af.id
                AND af.aanvraag_id = a.id
                AND a.id = ga.aanvraag_id
                AND g.id = ga.gebruiker_id
                AND g.account_type = 'klant'");
            $select_afspraak->bindParam(":afspraak_id",$_GET['afid']);
            $select_afspraak->execute();

            while($afspraak_info = $select_afspraak->fetch(PDO::FETCH_ASSOC))
            {
                $content->newBlock("DETAILS");
                $content->assign(array(
                    "AFID" => $afspraak_info['afspraak_id'],
                    "AID" => $afspraak_info['aanvraag_id'],
                    "KID" => $afspraak_info['klant_id'],
                    "DATUM" => $afspraak_info['datum'],
                    "TIJD" => $afspraak_info['tijd'],
                    "AANVRAAG" => $afspraak_info['aanvraag'],
                    "OPMERKING" => $afspraak_info['opmerking'],
                    "OMSCHRIJVING" => $afspraak_info['omschrijving'],
                    "WERKZAAMHEDEN" => $afspraak_info['werkzaamheden'],
                    "MATERIALEN" => $afspraak_info['materialen']
                ));
            }
        }
        else
        {
            // Er staat geen afspraakid in de url
        }
        break;
    default:
        // include in where statement :  afaf.id = af.id AND

        $select_afspraken = $db->prepare("SELECT af . * , af.id AS afspraak_id, DATE_FORMAT( af.datum,  '%d-%m-%Y' ) AS datum, DATE_FORMAT( af.tijd,  '%h:%i' ) AS tijd, a.aanvraag
            FROM aanvraag a, afspraak af, gebruiker g, gebruiker_afspraak gaf
            WHERE g.id = :monteur_id
            AND g.account_type =  'monteur'
            AND g.id = gaf.gebruiker_id
            AND af.id = gaf.afspraak_id
            AND a.id = af.aanvraag_id
            AND af.id IN (
                SELECT af.id
                FROM afspraak af, afgeronde_afspraken afaf
                WHERE af.id = afaf.afspraak_id
            )
            AND af.id NOT IN (
                SELECT af.id
                FROM afspraak af, factuur fac
                WHERE af.id = fac.afgeronde_afspraken_afspraak_id
            )");
        $select_afspraken->bindParam(":monteur_id",$_SESSION['gebruiker_id']);
        $select_afspraken->execute();

        if($select_afspraken->rowCount() > 0)
        {
            $content->newBlock("OVERZICHT");
            while($afspraak_info = $select_afspraken->fetch(PDO::FETCH_ASSOC))
            {
                $content->newBlock("AFSPRAKEN");

                $select_klant = $db->prepare("SELECT g . * , g.id AS klant_id
                    FROM afspraak af, aanvraag a, gebruiker g, gebruiker_afspraak gaf, afgeronde_afspraken afaf
                    WHERE g.account_type =  'klant'
                    AND af.id = :afspraak_id
                    AND af.aanvraag_id = a.id
                    AND g.id = gaf.gebruiker_id
                    AND af.id = gaf.afspraak_id
                    AND af.id NOT IN (
                        SELECT af.id
                        FROM afspraak af, factuur fac
                        WHERE af.id = fac.afgeronde_afspraken_afspraak_id
                    )");
                $select_klant->bindParam(":afspraak_id",$afspraak_info['afspraak_id']);
                $select_klant->execute();

                while($klant_info = $select_klant->fetch(PDO::FETCH_ASSOC))
                {
                    // Aanvraag verkorten zodat het in het tabel past
                    $afspraak_info['aanvraag'] = substr($afspraak_info['aanvraag'],0,100);

                    $content->assign(array(
                        "AFID" => $afspraak_info['afspraak_id'],
                        "KID" => $klant_info['klant_id'],
                        "AID" => $afspraak_info['aanvraag_id'],
                        "AANVRAAG" => $afspraak_info['aanvraag'],
                        "DATUM" => $afspraak_info['datum'],
                        "TIJD" => $afspraak_info['tijd']
                    ));
                }
            }
        }
        else
        {
            // Geen afspraken
            $content->newBlock("GEEN_AFSPRAKEN");
        }
        /*$select_afspraken = $db->query("SELECT afaf.afspraak_id, g.id AS klant_id, af.aanvraag_id, a.aanvraag,
            DATE_FORMAT( af.datum,  '%d-%m-%Y' ) AS datum, DATE_FORMAT( af.tijd,  '%h:%i' ) AS tijd
            FROM afgeronde_afspraken afaf, afspraak af, aanvraag a, gebruiker g, gebruiker_aanvraag ga
            WHERE afaf.afspraak_id = af.id
            AND af.aanvraag_id = a.id
            AND a.id = ga.aanvraag_id
            AND g.id = ga.gebruiker_id
            AND g.account_type = 'klant'");

        if($select_afspraken->rowCount() > 0)
        {
            $content->newBlock("OVERZICHT");
            while($row = $select_afspraken->fetch(PDO::FETCH_ASSOC))
            {
                $content->newBlock("AFSPRAKEN");
                $content->assign(array(
                    "AFID" => $row['afspraak_id'],
                    "KID" => $row['klant_id'],
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
        }*/
        break;
}