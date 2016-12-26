<?php
$content = new TemplatePower("template/admin_afgeronde_afspraken_bekijken.tpl");
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

                $select_monteur = $db->prepare("SELECT g.* FROM gebruiker g, afspraak af, gebruiker_afspraak gaf
                    WHERE af.id = :afspraak_id
                    AND gaf.afspraak_id = af.id
                    AND gaf.gebruiker_id = g.id
                    AND g.account_type = 'monteur'");
                $select_monteur->bindParam(":afspraak_id",$afspraak_info['afspraak_id']);
                $select_monteur->execute();

                while($monteur = $select_monteur->fetch(PDO::FETCH_ASSOC))
                {
                    $content->assign(array(
                        "MNAAM" => $monteur['naam'],
                        "MTUSSENVOEGSEL" => $monteur['tussenvoegsel'],
                        "MACHTERNAAM" => $monteur['achternaam']
                    ));
                }
            }
        }
        else
        {
            // Er staat geen afspraakid in de url
        }
        break;
    default:
        $select_afspraken = $db->query("SELECT afaf.afspraak_id, g.id AS klant_id, af.aanvraag_id, a.aanvraag,
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
                // Aanvraag verkorten zodat het in het tabel past
                $row['aanvraag'] = substr($row['aanvraag'],0,100);

                $content->newBlock("AFSPRAKEN");
                $content->assign(array(
                    "AFID" => $row['afspraak_id'],
                    "KID" => $row['klant_id'],
                    "AID" => $row['aanvraag_id'],
                    "AANVRAAG" => $row['aanvraag'],
                    "DATUM" => $row['datum'],
                    "TIJD" => $row['tijd']
                ));

                $select_monteur = $db->prepare("SELECT g.* FROM gebruiker g, afspraak af, gebruiker_afspraak gaf
                    WHERE af.id = :afspraak_id
                    AND gaf.afspraak_id = af.id
                    AND gaf.gebruiker_id = g.id
                    AND g.account_type = 'monteur'");
                $select_monteur->bindParam(":afspraak_id",$row['afspraak_id']);
                $select_monteur->execute();

                while($monteur = $select_monteur->fetch(PDO::FETCH_ASSOC))
                {
                    $content->assign(array(
                        "MNAAM" => $monteur['naam'],
                        "MTUSSENVOEGSEL" => $monteur['tussenvoegsel'],
                        "MACHTERNAAM" => $monteur['achternaam']
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


/*// Selecteer de monteur
$select_monteur = $db->prepare("SELECT g.* FROM gebruiker g, afspraak af, gebruiker_afspraak gaf
                    WHERE af.id = :afspraak_id
                    AND gaf.afspraak_id = af.id
                    AND gaf.gebruiker_id = g.id
                    AND g.account_type = 'monteur'");
$select_monteur->bindParam(":afspraak_id",$_GET['afid']);
$select_monteur->execute();

while($monteur = $select_monteur->fetch(PDO::FETCH_ASSOC))
{

}*/