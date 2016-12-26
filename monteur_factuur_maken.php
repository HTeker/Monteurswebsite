<?php
$content = new TemplatePower("template/monteur_factuur_maken.tpl");
$content->prepare();

if(isset($_POST['submit']))
{
    // Controleren of vereiste velden zijn ingevuld
    $bError = false;
    $aVereist = array("afspraak-ID","prijs");
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
        // Controleer of de afspraak-ID een cijfer is
        if(is_numeric($_POST['afspraak-ID']))
        {
            // Controleer of totaal bedrag enkel uit cijfers bestaat
            if(is_numeric($_POST['prijs']) AND is_numeric($_POST['prijs_decimaal']))
            {
                // Controleer of er een korting is ingevuld
                if($_POST['korting'] != '')
                {
                    // Controleer of de korting enkel bestaat uit cijfers
                    if(is_numeric($_POST['korting']) AND is_numeric($_POST['korting_decimaal']))
                    {
                        $select_klant = $db->prepare("SELECT g.id FROM gebruiker g, afspraak af, gebruiker_afspraak gaf
                            WHERE af.id = :afspraak_id
                            AND g.id = gaf.gebruiker_id
                            AND af.id = gaf.afspraak_id
                            AND g.account_type = 'klant'");
                        $select_klant->bindParam(":afspraak_id",$_POST['afspraak-ID']);
                        $select_klant->execute();

                        if($select_klant->rowCount() == 1)
                        {
                            while($klant = $select_klant->fetch(PDO::FETCH_ASSOC))
                            {
                                $prijs = number_format($_POST['prijs'].".".$_POST['prijs_decimaal'],2,'.','');
                                $korting = number_format($_POST['korting'].".".$_POST['korting_decimaal'],2,'.','');
                                $totaalbedrag = number_format(($_POST['prijs'].".".$_POST['prijs_decimaal']) - ($_POST['korting'].".".$_POST['korting_decimaal']),2,'.','');
                                $datum = date("Y-m-d");
                                $tijd = date("H:i");


                                // Maak factuur aan voor de desbetreffende afspraak-ID met de korting
                                // Maak factuur aan voor de desbetreffende afspraak-ID
                                $insert_factuur = $db->prepare("INSERT INTO factuur SET
                                    prijs = :prijs,
                                    korting = :korting,
                                    totaalprijs = :totaalprijs,
                                    afgeronde_afspraken_afspraak_id = :afspraak_id,
                                    datum = :datum,
                                    tijd = :tijd");
                                $insert_factuur->bindParam(":prijs",$prijs);
                                $insert_factuur->bindParam(":korting",$korting);
                                $insert_factuur->bindParam(":totaalprijs",$totaalbedrag);
                                $insert_factuur->bindParam(":afspraak_id",$_POST['afspraak-ID']);
                                $insert_factuur->bindParam(":datum",$datum);
                                $insert_factuur->bindParam(":tijd",$tijd);
                                $insert_factuur->execute();

                                $factuur_id = $db->lastInsertId();

                                $insert_koppeling_monteur = $db->prepare("INSERT INTO gebruiker_factuur SET
                                    gebruiker_id = :monteur_id,
                                    factuur_id = :factuur_id");
                                $insert_koppeling_monteur->bindParam(":monteur_id",$_SESSION['gebruiker_id']);
                                $insert_koppeling_monteur->bindParam(":factuur_id",$factuur_id);
                                $insert_koppeling_monteur->execute();

                                $insert_koppeling_klant = $db->prepare("INSERT INTO gebruiker_factuur SET
                                    gebruiker_id = :klant_id,
                                    factuur_id = :factuur_id");
                                $insert_koppeling_klant->bindParam(":klant_id",$klant['id']);
                                $insert_koppeling_klant->bindParam(":factuur_id",$factuur_id);
                                $insert_koppeling_klant->execute();


                                $content->newBlock("FACTUUR_GEMAAKT");
                                header("Refresh: 2; url=index.php?id=15");
                            }
                        }
                        else
                        {
                            $content->newBlock("404");
                        }
                    }
                    else
                    {
                        // Geen cijfer, toon melding
                        $content->newBlock("FORMULIER");
                        $content->newBlock("MELDING");
                        $content->assign("MELDING", "<li>De door u ingevulde korting bestaat niet enkel uit cijfers.</li>");
                    }
                }
                else
                {
                    $prijs = number_format($_POST['prijs'].".".$_POST['prijs_decimaal'],2,'.','');
                    $datum = date("Y-m-d");
                    $tijd = date("H:i");



                    // Maak factuur aan voor de desbetreffende afspraak-ID
                    $insert_factuur = $db->prepare("INSERT INTO factuur SET
                    prijs = :prijs,
                    totaalprijs = :totaalprijs,
                    afgeronde_afspraken_afspraak_id = :afspraak_id,
                    datum = :datum,
                    tijd = :tijd");
                    $insert_factuur->bindParam(":prijs",$prijs);
                    $insert_factuur->bindParam(":totaalprijs",$prijs);
                    $insert_factuur->bindParam(":afspraak_id",$_POST['afspraak-ID']);
                    $insert_factuur->bindParam(":datum",$datum);
                    $insert_factuur->bindParam(":tijd",$tijd);
                    //$insert_factuur->execute();

                    echo $datum;
                    echo $tijd;
                    echo "test";

                    $content->newBlock("FACTUUR_GEMAAKT");
                    //header("Refresh: 2; url=index.php?id=15");
                }
            }
            else
            {
                // Geen cijfer, toon melding
                $content->newBlock("FORMULIER");
                $content->newBlock("MELDING");
                $content->assign("MELDING", "<li>De door u ingevulde prijs bestaat niet enkel uit cijfers.</li>");
            }

        }
        else
        {
            // Geen cijfer, toon melding
            $content->newBlock("FORMULIER");
            $content->newBlock("MELDING");
            $content->assign("MELDING", "<li>De door u ingevulde afspraak-ID is niet geldig.</li>");
        }
    }
    else
    {
        // Vereiste velden zijn niet ingevuld, toon melding
        $content->newBlock("FORMULIER");
        $content->newBlock("MELDING");
        $sMeldingen = NULL; // Variabele aanmaken om error-meldingen in op te slaan
        foreach($aErrorVelden as $sVeld)
        {
            $sMeldingen = $sMeldingen."<li>U dient een <b style='font-size: 16px;'>".$sVeld."</b> in te vullen</li>";
            $content->assign("MELDING", $sMeldingen);
        }
    }
}
else
{
    $content->newBlock("FORMULIER");
}