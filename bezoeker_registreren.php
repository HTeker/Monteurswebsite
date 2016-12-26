<?php
$content = new TemplatePower("template/bezoeker_registreren.tpl");
$content->prepare();

if(isset($_POST['submit']))
{
    // Controleren of vereiste velden zijn ingevuld
    $bError = false;
    $aVereist = array("naam","achternaam","adres","postcode","plaats","email","wachtwoord","telnr","aanvraag","datum","tijdseenheid");
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
        // Vereiste velden zijn ingevuld, check of e-mail een juiste constructie heeft
        if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL))
        {
            // E-mailconstructie is onjuist, toon melding
            $content->newBlock("FORMULIER");
            $content->newBlock("MELDING");
            $content->assign("MELDING", "<li>De door u ingevulde e-mailadres is niet geldig.</li>");
        }
        else
        {
            // E-mail is geldig, check of email al bestaat
            $check_email = $db->prepare("SELECT * FROM gebruiker WHERE email = :email");
            $check_email->bindParam(":email",$_POST['email']);
            $check_email->execute();

            if($check_email->rowCount() != 1)
            {
                // Email is niet geregisteerd, controleer of wachtwoorden zelfde zijn

                if($_POST['wachtwoord'] == $_POST['wachtwoord_herhalen'])
                {
                    // Wachtwoorden zijn hetzelfde, controleer of telnr juiste constructie heeft

                    if(is_numeric($_POST['telnr']) AND strlen((string) $_POST['telnr']) == 10)
                    {
                        // Telnr juiste constructie, check datum min 1 dag erna

                        if($_POST['datum'] > date('d.m.Y'))
                        {
                            // Datum is minimaal een dag erna, insert de klant

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

                            $account_type = 'klant';

                            $insert_klant = $db->prepare("INSERT INTO gebruiker SET
                            naam = :naam,
                            tussenvoegsel = :tussenvoegsel,
                            achternaam = :achternaam,
                            adres = :adres,
                            postcode = :postcode,
                            plaats = :plaats,
                            email = :email,
                            wachtwoord = :wachtwoord,
                            salt = :salt,
                            telnr = :telnr,
                            account_type = :account_type");
                            $insert_klant->bindParam(":naam",$_POST['naam']);
                            $insert_klant->bindParam(":tussenvoegsel",$_POST['tussenvoegsel']);
                            $insert_klant->bindParam(":achternaam",$_POST['achternaam']);
                            $insert_klant->bindParam(":adres",$_POST['adres']);
                            $insert_klant->bindParam(":postcode",$_POST['postcode']);
                            $insert_klant->bindParam(":plaats",$_POST['plaats']);
                            $insert_klant->bindParam(":email",$_POST['email']);
                            $insert_klant->bindParam(":wachtwoord",$wachtwoord);
                            $insert_klant->bindParam(":salt",$salt);
                            $insert_klant->bindParam(":telnr",$_POST['telnr']);
                            $insert_klant->bindParam(":account_type", $account_type);
                            $insert_klant->execute();

                            $klantid = $db->lastInsertId();

                            // insert de aanvraag
                            // De datum in de juiste formaat zetten
                            $dag = substr($_POST['datum'],0,2);
                            $maand = substr($_POST['datum'],3,2);
                            $jaar = substr($_POST['datum'],6,4);
                            $datum = $jaar."-".$maand."-".$dag;

                            $insert_aanvraag = $db->prepare("INSERT INTO aanvraag SET
                            aanvraag = :aanvraag,
                            datum = :datum,
                            tijdseenheid = :tijdseenheid");
                            $insert_aanvraag->bindParam(":aanvraag",$_POST['aanvraag']);
                            $insert_aanvraag->bindParam(":datum",$datum);
                            $insert_aanvraag->bindParam(":tijdseenheid",$_POST['tijdseenheid']);
                            $insert_aanvraag->execute();

                            $aanvraagid = $db->lastInsertId();

                            // insert de gebruikers_aanvraag
                            $insert_koppeling = $db->prepare("INSERT INTO gebruiker_aanvraag SET
                            gebruiker_id = :klantid,
                            aanvraag_id = :aanvraagid");
                            $insert_koppeling->bindParam(":klantid",$klantid);
                            $insert_koppeling->bindParam(":aanvraagid",$aanvraagid);
                            $insert_koppeling->execute();

                            // Log direct in
                            header('Location: index.php?id=11');
                            $_SESSION['logged_in'] = true;
                            $_SESSION['gebruiker_id'] = $klantid;
                            $_SESSION['naam'] = $_POST['naam'];
                            $_SESSION['tussenvoegsel'] = $_POST['tussenvoegsel'];
                            $_SESSION['achternaam'] = $_POST['achternaam'];
                            $_SESSION['account_type'] = 'klant';
                        }
                        else
                        {
                            // Datum is niet een dag erna, toon melding
                            $content->newBlock("FORMULIER");
                            $content->newBlock("MELDING");
                            $content->assign("MELDING", "<li>De door u gekozen datum is niet minimaal een dag na vandaag.</li>");
                        }
                    }
                    else
                    {
                        // Geen juiste telnr, toon melding
                        $content->newBlock("FORMULIER");
                        $content->newBlock("MELDING");
                        $content->assign("MELDING", "<li>De door u ingevulde telefoonnummer is niet juist.</li>");
                    }
                }
                else
                {
                    // Wachtwoorden zijn niet hetzelfde, toon error
                    $content->newBlock("FORMULIER");
                    $content->newBlock("MELDING");
                    $content->assign("MELDING", "<li>De door u ingevulde wachtwoorden komen niet overeen.</li>");
                }

            }
            else
            {
                // Email bestaat al
                $content->newBlock("FORMULIER");
                $content->newBlock("MELDING");
                $content->assign("MELDING", "<li>De door u ingevulde e-mailadres is al bij ons geregistreerd.</li>");
            }
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
            $sMeldingen = $sMeldingen."<li>U dient <b style='font-size: 16px;'>".$sVeld."</b> in te vullen</li>";
            $content->assign("MELDING", $sMeldingen);
        }
    }
}
else
{
    // Knop niet ingedrukt, toon formulier
    $content->newBlock("FORMULIER");
}