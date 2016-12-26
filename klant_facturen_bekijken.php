<?php
$content = new TemplatePower("template/klant_facturen_bekijken.tpl");
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
            $select_factuur = $db->prepare("SELECT fac.*, DATE_FORMAT( fac.datum,  '%d-%m-%Y' ) AS datum,
                DATE_FORMAT( fac.tijd,  '%H:%i' ) AS tijd, g.id AS klant_id
                FROM factuur fac, gebruiker g, gebruiker_afspraak gaf, gebruiker_factuur gfac
                WHERE g.id = :klant_id
                AND fac.id = :factuur_id
                AND g.id = gaf.gebruiker_id
                AND fac.afgeronde_afspraken_afspraak_id = gaf.afspraak_id
                AND fac.id = gfac.factuur_id
                AND g.id = gfac.gebruiker_id
                AND g.account_type =  'klant'");
            $select_factuur->bindParam(":klant_id", $_SESSION['gebruiker_id']);
            $select_factuur->bindParam(":factuur_id",$_GET['fid']);
            $select_factuur->execute();

            if($select_factuur->rowCount() == 1)
            {
                $content->newBlock("DETAILS");
                while($factuur_info = $select_factuur->fetch(PDO::FETCH_ASSOC))
                {
                    $content->assign(array(
                        "FID" => $factuur_info['id'],
                        "PRIJS" => "€".$factuur_info['prijs'],
                        "KORTING" => "€".$factuur_info['korting'],
                        "TOTAALPRIJS" => "€".$factuur_info['totaalprijs'],
                        "FDATUM" => $factuur_info['datum'],
                        "FTIJD" => $factuur_info['tijd']
                    ));

                    $select_extra_info = $db->prepare("SELECT g.*, g.id AS monteur_id, afaf . * , af . * , DATE_FORMAT( af.datum,  '%d-%m-%Y' ) AS datum, DATE_FORMAT( af.tijd, '%H:%i' ) AS tijd
                        FROM gebruiker g, afgeronde_afspraken afaf, gebruiker_afspraak gaf, afspraak af
                        WHERE g.account_type =  'monteur'
                        AND afaf.afspraak_id = :afspraak_id
                        AND g.id = gaf.gebruiker_id
                        AND afaf.afspraak_id = gaf.afspraak_id
                        AND af.id = afaf.afspraak_id");
                    $select_extra_info->bindParam(":afspraak_id",$factuur_info['afgeronde_afspraken_afspraak_id']);
                    $select_extra_info->execute();

                    while($extra_info = $select_extra_info->fetch(PDO::FETCH_ASSOC))
                    {
                        $content->assign(array(
                            "MNAAM" => $extra_info['naam'],
                            "MTUSSENVOEGSEL" => $extra_info['tussenvoegsel'],
                            "MACHTERNAAM" => $extra_info['achternaam'],
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
        $select_facturen = $db->prepare("SELECT fac.*, DATE_FORMAT( fac.datum,  '%d-%m-%Y' ) AS datum,
            DATE_FORMAT( fac.tijd,  '%H:%i' ) AS tijd, g.id AS klant_id
            FROM factuur fac, gebruiker g, gebruiker_afspraak gaf, gebruiker_factuur gfac
            WHERE g.id = :klant_id
			AND g.id = gaf.gebruiker_id
            AND fac.afgeronde_afspraken_afspraak_id = gaf.afspraak_id
            AND fac.id = gfac.factuur_id
            AND g.id = gfac.gebruiker_id
            AND g.account_type =  'klant'");
        $select_facturen->bindParam(":klant_id",$_SESSION['gebruiker_id']);
        $select_facturen->execute();

        if($select_facturen->rowCount() > 0)
        {
            $content->newBlock("OVERZICHT");

            while($factuur_info = $select_facturen->fetch(PDO::FETCH_ASSOC))
            {
                if($factuur_info['voldaan'] == 0)
                {
                    $voldaan = "nee";
                }
                else
                {
                    $voldaan = "ja";
                }

                $content->newBlock("FACTUREN");
                $content->assign(array(
                    "FID" => $factuur_info['id'],
                    "FDATUM" => $factuur_info['datum'],
                    "FTIJD" => $factuur_info['tijd'],
                    "TOTAALPRIJS" => "€".$factuur_info['totaalprijs'],
                    "VOLDAAN" => $voldaan
                ));

                $select_extra_info = $db->prepare("SELECT afaf.omschrijving
                    FROM afgeronde_afspraken afaf, factuur fac
                    WHERE fac.id = :factuur_id
                    AND fac.afgeronde_afspraken_afspraak_id = afaf.afspraak_id");
                $select_extra_info->bindParam(":factuur_id",$factuur_info['id']);
                $select_extra_info->execute();

                while($extra_info = $select_extra_info->fetch(PDO::FETCH_ASSOC))
                {
                    $content->assign("OMSCHRIJVING", $extra_info['omschrijving']);
                }
            }
        }
        else
        {
            $content->newBlock("GEEN_FACTUREN");
        }
        break;
}