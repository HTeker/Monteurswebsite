<?php
$content = new TemplatePower("template/gebruiker_account_gegevens_wijzigen.tpl");
$content->prepare();

$select_gegevens = $db->prepare("SELECT * FROM gebruiker WHERE id = :id");
$select_gegevens->bindParam(":id", $_SESSION['gebruiker_id']);
$select_gegevens->execute();

if(isset($_POST['submit']))
{
    // Als de knop 'wijzigen' is ingedrukt

    // Velden definiëren die veranderd kunnen worden
    $aVelden = array("adres", "postcode", "plaats", "telnr", "wachtwoord");
    $aIngevuldeVelden = array();
    $aNietIngevuldeVelden = array();

    // Controleren of 1 van de velden is ingevuld
    foreach($aVelden as $sVeld)
    {
        if($_POST[$sVeld] != '')
        {
            // Als veld is ingevuld, stop in de variabele
            $aIngevuldeVelden[] = $sVeld;
        }
        else
        {
            // Als veld niet is ingevuld, stop in de variabele
            $aNietIngevuldeVelden[] = $sVeld;
        }
    }

    if(empty($aIngevuldeVelden))
    {
        // Als alle velden leeg zijn, geef error

        while($row = $select_gegevens->fetch(PDO::FETCH_ASSOC))
        {
            $content->newBlock("FORMULIER");
            $content->assign(array(
                "ADRES" => $row['adres'],
                "POSTCODE" => $row['postcode'],
                "PLAATS" => $row['plaats'],
                "TELNR" => $row['telnr']
            ));
        }

        $content->newBlock("MELDING");
        $content->assign("MELDING", "<li>U dient minstens één veld in te vullen.</li>");
    }
    else
    {
        // Als er minstens 1 veld is ingevuld

        // Controleer of de nieuwe wachtwoorden overeenkomen
        if($_POST['wachtwoord'] != $_POST['wachtwoord_herhalen'])
        {
            // Als de wachtwoorden niet overeenkomen, toon error

            while($row = $select_gegevens->fetch(PDO::FETCH_ASSOC))
            {
                $content->newBlock("FORMULIER");
                $content->assign(array(
                    "ADRES" => $row['adres'],
                    "POSTCODE" => $row['postcode'],
                    "PLAATS" => $row['plaats'],
                    "TELNR" => $row['telnr']
                ));
            }

            $content->newBlock("MELDING");
            $content->assign("MELDING", "<li>De nieuwe wachtwoorden komen niet overeen.</li>");
        }
        else
        {
            // Als de nieuwe wachtwoorden overeen komen, controleer oude wachtwoord

            while($row = $select_gegevens->fetch(PDO::FETCH_ASSOC))
            {
                $select_salt = $db->prepare("SELECT salt FROM gebruiker WHERE id = :gebruiker_id");
                $select_salt->bindParam(":gebruiker_id",$_SESSION['gebruiker_id']);
                $select_salt->execute();

                while($rij = $select_salt->fetch(PDO::FETCH_ASSOC))
                {
                    $wachtwoord = hash('sha512',$rij['salt'].$_POST['oud_wachtwoord']);

                    $check_wachtwoord = $db->prepare("SELECT * FROM gebruiker WHERE
                        id = :gebruiker_id AND
                        wachtwoord = :wachtwoord AND
                        salt = :salt");
                    $check_wachtwoord->bindParam(":gebruiker_id",$_SESSION['gebruiker_id']);
                    $check_wachtwoord->bindParam(":wachtwoord",$wachtwoord);
                    $check_wachtwoord->bindParam(":salt",$rij['salt']);
                    $check_wachtwoord->execute();

                    if($check_wachtwoord->rowCount() == 1)
                    {
                        // Wachtwoord klopt
                        // Als het oude wachtwoord wel klopt, werkt gegevens bij in db

                        // Niet ingevulde velden oude waarde geven
                        foreach($aNietIngevuldeVelden as $veld)
                        {
                            $_POST[$veld] = $row[$veld];
                        }

                        // WACHTWOORD-ENCRYPTIE
                        function RandomString()
                        {
                            $characters = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
                            $randstring = '';
                            for ($i = 0; $i < 10; $i++) {
                                $randstring .= $characters[rand(0, strlen($characters))];
                            }
                            return $randstring;
                        }
                        $salt = RandomString();
                        $wachtwoord = hash('sha512',$salt.$_POST['wachtwoord']);
                        // WACHTWOORD-ENCRYPTIE

                        $update_gegevens = $db->prepare("UPDATE gebruiker SET
                            adres = :adres,
                            postcode = :postcode,
                            plaats = :plaats,
                            telnr = :telnr,
                            wachtwoord = :wachtwoord,
                            salt = :salt
                            WHERE id = :gebruiker_id
                        ");
                        $update_gegevens->bindParam(":adres", $_POST['adres']);
                        $update_gegevens->bindParam(":postcode", $_POST['postcode']);
                        $update_gegevens->bindParam(":plaats", $_POST['plaats']);
                        $update_gegevens->bindParam(":telnr", $_POST['telnr']);
                        $update_gegevens->bindParam(":wachtwoord", $wachtwoord);
                        $update_gegevens->bindParam(":salt",$salt);
                        $update_gegevens->bindParam(":gebruiker_id", $_SESSION['gebruiker_id']);
                        $update_gegevens->execute();

                        $content->newBlock("GEWIJZIGD");
                        header("Refresh: 1.5; url=index.php?id=8");
                    }
                    else
                    {
                        // Wachtwoord klopt niet
                        $content->newBlock("FORMULIER");
                        $content->assign(array(
                            "ADRES" => $row['adres'],
                            "POSTCODE" => $row['postcode'],
                            "PLAATS" => $row['plaats'],
                            "TELNR" => $row['telnr']
                        ));

                        $content->newBlock("MELDING");
                        $content->assign("MELDING", "<li>Uw oude wachtwoord klopt niet.</li>");
                    }
                }
            }
        }
    }
}
else
{
    // Knop niet ingedrukt, haal huidige gegevens uit db en zet ze in placeholders

    while($row = $select_gegevens->fetch(PDO::FETCH_ASSOC))
    {
        $content->newBlock("FORMULIER");
        $content->assign(array(
            "ADRES" => $row['adres'],
            "POSTCODE" => $row['postcode'],
            "PLAATS" => $row['plaats'],
            "TELNR" => $row['telnr']
        ));

        /*$content->newBlock("MELDING");
        $content->assign("MELDING", "<li>U dient beide velden in te vullen.</li>");*/
    }
}