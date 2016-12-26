<?php
$content = new TemplatePower("template/admin_monteurs_bekijken.tpl");
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
        // check of er een afspraak id in url staat
        if(isset($_GET['afid']))
        {
            // Er staat eeen afspraakid in de url, select alle details van de afspraak
            $select_afspraakinfo = $db->prepare("SELECT g.id, g.naam, g.tussenvoegsel, g.achternaam, af.opmerking,
                DATE_FORMAT(af.datum, '%d-%m-%Y') AS datum, DATE_FORMAT(af.tijd,'%h:%i') AS tijd, a.aanvraag
                FROM gebruiker g, afspraak af, gebruiker_afspraak gaf, aanvraag a
                WHERE af.id = :afspraak_id AND
                af.id = gaf.afspraak_id AND
                g.id = gaf.gebruiker_id AND
                g.account_type = 'klant' AND
                a.id = af.aanvraag_id");
            $select_afspraakinfo->bindParam(":afspraak_id",$_GET['afid']);
            $select_afspraakinfo->execute();

            // Check of er afspraken
            if($select_afspraakinfo->rowCount() == 1)
            {
                // Print alle info op de pagina
                $content->newBlock("DETAILS");
                while($row = $select_afspraakinfo->fetch(PDO::FETCH_ASSOC))
                {
                    $content->assign(array(
                        "AFID" => $_GET['afid'],
                        "KID" => $row['id'],
                        "KNAAM" => $row['naam'],
                        "KTUSSENVOEGSEL" => $row['tussenvoegsel'],
                        "KACHTERNAAM" => $row['achternaam'],
                        "DATUM" => $row['datum'],
                        "TIJD" => $row['tijd'],
                        "AANVRAAG" => $row['aanvraag'],
                        "OPMERKING" => $row['opmerking'],
                        "MID" => $_SESSION['monteur_id']
                    ));
                }
            }
            else
            {
                // Geen afspraakid, dus ook geen gegevens, toon 404
                $content->newBlock("404");
            }
        }
        else

        {
            // Er staat geen afspraak id in de url
            $content->newBlock("404");
        }
        break;
    case "afspraken":
        if(isset($_GET['mid']))
        {
            // Zet monteurid in Session variabele om de terug knop te kunnen gebruiken
            $_SESSION['monteur_id'] = $_GET['mid'];

            // Er staat een monteurid in de url, selecteer zijn afspraken
            $select_afspraken = $db->prepare("SELECT af . * , DATE_FORMAT( af.datum,  '%d-%m-%Y' ) AS datum, DATE_FORMAT( af.tijd,  '%h:%i' ) AS tijd
                FROM afspraak af, gebruiker_afspraak gaf
                WHERE gaf.gebruiker_id = :monteur_id
                AND af.id = gaf.afspraak_id
                AND af.id NOT IN (
                SELECT af.id
                FROM afspraak af, afgeronde_afspraken afaf
                WHERE af.id = afaf.afspraak_id)
                ORDER BY datum, tijd");
            $select_afspraken->bindParam(":monteur_id",$_GET['mid']);
            $select_afspraken->execute();

            if($select_afspraken->rowCount() > 0)
            {
                $content->newBlock("OVERZICHT_AFSPRAKEN");
                // Selecteer de klant-id en de aanvraag van de afspraak
                while($row = $select_afspraken->fetch(PDO::FETCH_ASSOC))
                {
                    $select_afspraakinfo = $db->prepare("SELECT g.id AS klant_id, a.aanvraag
                    FROM gebruiker g, aanvraag a, gebruiker_aanvraag ga
                    WHERE a.id = :aanvraag_id AND
                    g.account_type = 'klant' AND
                    ga.aanvraag_id = a.id AND
                    ga.gebruiker_id = g.id");
                    $select_afspraakinfo->bindParam(":aanvraag_id",$row['aanvraag_id']);
                    $select_afspraakinfo->execute();

                    // Ik zet nu alles in een loop om het naar de pagina te sturen
                    while($rij = $select_afspraakinfo->fetch(PDO::FETCH_ASSOC))
                    {
                        // Aanvraag inkorten zodat het in de tabel past
                        $rij['aanvraag'] = substr($rij['aanvraag'],0,100);

                        $content->newBlock("AFSPRAKEN");
                        $content->assign(array(
                            "AFID" => $row['id'],
                            "KID" => $rij['klant_id'],
                            "AANVRAAG" => $rij['aanvraag'],
                            "DATUM" => $row['datum'],
                            "TIJD" => $row['tijd']
                        ));
                    }
                }
            }
            else
            {
                $content->newBlock("GEEN_AFSPRAKEN");
            }
        }
        else
        {
            // Er is geen monteurid in url
            $content->newBlock("404");
        }
        break;
    case "actief":
        if(isset($_GET['mid']))
        {
            // Er staat een monteurid in de url
            $monteur_actief = $db->prepare("UPDATE gebruiker SET actief = 1
            WHERE account_type = 'monteur' AND
            id = :monteur_id");
            $monteur_actief->bindParam(":monteur_id",$_GET['mid']);
            $monteur_actief->execute();
            header("Location: index.php?id=19");
        }
        else
        {
            // Er staat geen monteurid in de url
        }
        break;
    case "non-actief":
        if(isset($_GET['mid']))
        {
            // Er staat een monteurid in de url
            $monteur_nonactief = $db->prepare("UPDATE gebruiker SET actief = 0
            WHERE account_type = 'monteur' AND
            id = :monteur_id");
            $monteur_nonactief->bindParam(":monteur_id",$_GET['mid']);
            $monteur_nonactief->execute();
            header("Location: index.php?id=19");
        }
        else
        {
            // Er staat geen monteurid in de url
        }
        break;
    default:
        // Selecteer alle monteurs en zet ze in tabel
        $select_monteurs = $db->query("SELECT * FROM gebruiker WHERE account_type = 'monteur' ORDER BY actief DESC,
        naam, tussenvoegsel, achternaam ASC");

        // Check of er enige monteurs zijn
        if($select_monteurs->rowCount() > 0)
        {
            // Er zijn monteurs, toon ze in tabel
            $content->newBlock("OVERZICHT_MONTEURS");
            while($row = $select_monteurs->fetch(PDO::FETCH_ASSOC))
            {
                // Selecteer eerst volgende afspraak van monteur
                $select_afspraak = $db->prepare("SELECT af.*, DATE_FORMAT(af.datum,'%d-%m-%Y') AS datum,
                    DATE_FORMAT(af.tijd,'%k:%i') AS tijd
                    FROM afspraak af, gebruiker g, gebruiker_afspraak gaf
                    WHERE af.datum >= CURRENT_DATE AND
					g.id = :monteur_id AND
                    gaf.afspraak_id = af.id AND
                    gaf.gebruiker_id = g.id");
                $select_afspraak->bindParam(":monteur_id",$row['id']);
                $select_afspraak->execute();

                // Als de monteur actief is wijzig variabele in 'actief'
                $status = "non-actief";
                $setstatus = "actief";

                if($row['actief'] == 1)
                {
                    $status = "actief";
                    $setstatus = "non-actief";
                }

                // Assign monteur
                $content->newBlock("MONTEURS");
                $content->assign(array(
                    "MID" => $row['id'],
                    "MNAAM" => $row['naam'],
                    "MTUSSENVOEGSEL" => $row['tussenvoegsel'],
                    "MACHTERNAAM" => $row['achternaam'],
                    "STATUS" => $status,
                    "SETSTATUS" => $setstatus
                ));


                while($rij = $select_afspraak->fetch(PDO::FETCH_ASSOC))
                {
                    $content->assign(array(
                        "1DATUM" => $rij['datum'],
                        "1TIJD" => $rij['tijd']
                    ));
                }
            }
        }
        else
        {
            // Er zijn geen monteurs
            $content->newBlock("GEEN_MONTEURS");
        }
        break;
}