<?php
$content = new TemplatePower("template/klant_aanvragen_bekijken.tpl");
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
        // Check of er een aanvraagid staat in de GET
        if(isset($_GET['aid']))
        {
            // Er is een aanvraagid meegegeven, toon gegevens van de aanvraag

            $select_aanvraag = $db->prepare("SELECT a.*, DATE_FORMAT(a.datum,'%d-%m-%Y') AS datum FROM aanvraag a, gebruiker g,
            gebruiker_aanvraag ga
            WHERE g.id = :gebruiker_id AND
			a.id = :aanvraag_id AND
           	a.id = ga.aanvraag_id AND
           	g.id = ga.gebruiker_id");
            $select_aanvraag->bindParam(":gebruiker_id",$_SESSION['gebruiker_id']);
            $select_aanvraag->bindParam(":aanvraag_id",$_GET['aid']);
            $select_aanvraag->execute();

            // Check of er een rij uitkomt, dus of de gebruiker de url niet heeft gemanipuleerd
            if($select_aanvraag->rowCount() == 1)
            {
                $content->newBlock("DETAILS");

                // Toon gegevens op pagina
                while($row = $select_aanvraag->fetch(PDO::FETCH_ASSOC))
                {
                    $content->assign(array(
                        "AID" => $row['id'],
                        "DATUM" => $row['datum'],
                        "TIJDSEENHEID" => $row['tijdseenheid'],
                        "AANVRAAG" => $row['aanvraag']
                    ));
                }
            }
            else
            {
                $content->newBlock("404");
            }
        }
        else
        {
            // er staat geen aanvraagid
            $content->newBlock("404");
        }
        break;
    default:
        // Check eerst of er aanvragen zijn
        $select_aanvragen = $db->prepare("SELECT a.*, DATE_FORMAT(a.datum,'%d-%m-%Y') AS datum  FROM aanvraag a, gebruiker g,
            gebruiker_aanvraag ga
            WHERE g.id = :gebruiker_id AND
           	a.id = ga.aanvraag_id AND
           	g.id = ga.gebruiker_id AND
            a.id NOT IN (SELECT a.id FROM aanvraag a, afspraak af WHERE a.id = af.aanvraag_id)");
        $select_aanvragen->bindParam(":gebruiker_id",$_SESSION['gebruiker_id']);
        $select_aanvragen->execute();

        // Als er aanvragen zijn toon ze, anders weergeef melding
        if($select_aanvragen->rowCount() > 0)
        {
            // Er zijn aanvragen
            $content->newBlock("OVERZICHT");

            while($row = $select_aanvragen->fetch(PDO::FETCH_ASSOC))
            {
                // Aanvraag verkorten zodat het in het tabel past
                $row['aanvraag'] = substr($row['aanvraag'],0,100);

                $content->newBlock("AANVRAGEN");
                $content->assign(array(
                    "AID" => $row['id'],
                    "AANVRAAG" => $row['aanvraag'],
                    "DATUM" => $row['datum'],
                    "TIJDSEENHEID" => $row['tijdseenheid']
                ));
            }
        }
        else
        {
            // Er zijn geen aanvragen
            $content->newBlock("GEEN_AANVRAGEN");
        }
        break;
}