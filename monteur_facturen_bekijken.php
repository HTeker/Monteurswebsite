<?php
$content = new TemplatePower("template/monteur_facturen_bekijken.tpl");
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
        if(isset($_GET['fid']))
        {
            $select_factuur = $db->prepare("SELECT fac.*, DATE_FORMAT(fac.datum,'%d-%m-%Y') AS datum,
            DATE_FORMAT(fac.tijd,'%H:%i') AS tijd
            FROM factuur fac, gebruiker g, gebruiker_afspraak gaf
            WHERE g.id = :monteur_id
            AND g.id = gaf.gebruiker_id
            AND fac.afgeronde_afspraken_afspraak_id = gaf.afspraak_id");
            $select_factuur->bindParam(":monteur_id",$_SESSION['gebruiker_id']);
            $select_factuur->execute();

            if($select_factuur->rowCount() > 0)
            {
                $content->newBlock("DETAILS");

                while($factuur_info = $select_factuur->fetch(PDO::FETCH_ASSOC))
                {
                    $select_extra_info = $db->prepare("SELECT g.id AS klant_id, afaf.* , af.*,
                        DATE_FORMAT(af.datum,'%d-%m-%Y') AS datum, DATE_FORMAT(af.tijd,'%H:%i') AS tijd
                        FROM gebruiker g, afgeronde_afspraken afaf, gebruiker_afspraak gaf, afspraak af
                        WHERE g.account_type =  'klant'
                        AND afaf.afspraak_id = :afspraak_id
                        AND g.id = gaf.gebruiker_id
                        AND afaf.afspraak_id = gaf.afspraak_id
                        AND af.id = afaf.afspraak_id");
                    $select_extra_info->bindParam(":afspraak_id",$factuur_info['afgeronde_afspraken_afspraak_id']);
                    $select_extra_info->execute();

                    while($extra_info = $select_extra_info->fetch(PDO::FETCH_ASSOC))
                    {
                        $content->assign(array(
                            "FID" => $factuur_info['id'],
                            "FDATUM" => $factuur_info['datum'],
                            "PRIJS" => "€".$factuur_info['prijs'],
                            "KORTING" => "€".$factuur_info['korting'],
                            "TOTAALPRIJS" => "€".$factuur_info['totaalprijs'],
                            "KID" => $extra_info['klant_id'],
                            "AFDATUM" => $extra_info['datum'],
                            "AFTIJD" => $extra_info['tijd'],
                            "OMSCHRIJVING" => $extra_info['omschrijving'],
                            "WERKZAAMHEDEN" => $extra_info['werkzaamheden'],
                            "MATERIALEN" => $extra_info['materialen']
                        ));
                    }
                }
            }
            else
            {
                $content->newBlock("404");
            }
        }
        else
        {
            $content->newBlock("404");
        }
        break;
    default:
        $select_facturen = $db->prepare("SELECT fac.*, DATE_FORMAT(fac.datum,'%d-%m-%Y') AS datum,
            DATE_FORMAT(fac.tijd,'%H:%i') AS tijd
            FROM factuur fac, gebruiker g, gebruiker_afspraak gaf
            WHERE g.id = :monteur_id
            AND g.id = gaf.gebruiker_id
            AND fac.afgeronde_afspraken_afspraak_id = gaf.afspraak_id");
        $select_facturen->bindParam(":monteur_id",$_SESSION['gebruiker_id']);
        $select_facturen->execute();

        if($select_facturen->rowCount() > 0)
        {
            $content->newBlock("OVERZICHT");
            while($factuur_info = $select_facturen->fetch(PDO::FETCH_ASSOC))
            {
                $select_klant = $db->prepare("SELECT g.id, afaf.omschrijving
                    FROM gebruiker g, afgeronde_afspraken afaf, gebruiker_afspraak gaf
                    WHERE g.account_type = 'klant'
                    AND afaf.afspraak_id = :afspraak_id
                    AND g.id = gaf.gebruiker_id
                    AND afaf.afspraak_id = gaf.afspraak_id");
                $select_klant->bindParam(":afspraak_id",$factuur_info['afgeronde_afspraken_afspraak_id']);
                $select_klant->execute();

                while($klant_info = $select_klant->fetch(PDO::FETCH_ASSOC))
                {
                    $content->newBlock("FACTUREN");
                    $content->assign(array(
                        "FID" => $factuur_info['id'],
                        "FDATUM" => $factuur_info['datum'],
                        "FTIJD" => $factuur_info['tijd'],
                        "TOTAALPRIJS" => "€".$factuur_info['totaalprijs'],
                        "KID" => $klant_info['id'],
                        "OMSCHRIJVING" => $klant_info['omschrijving']
                    ));
                }
            }
        }
        else
        {
            $content->newBlock("GEEN_FACTUREN");
        }
        break;
}