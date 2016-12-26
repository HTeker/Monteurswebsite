<?php
$content = new TemplatePower("template/admin_monteur_toevoegen.tpl");
$content->prepare();

if(isset($_POST['submit']))
{
    // Controleren of vereiste velden zijn ingevuld
    $bError = false;
    $aVereist = array("naam","achternaam","adres","postcode","plaats","email","telnr","wachtwoord");
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
                // Email is niet geregisteerd, controleer of telnr juiste constructie heeft
                if(is_numeric($_POST['telnr']) AND strlen((string) $_POST['telnr']) == 10)
                {
                    // juiste telnr, controleer of wachtwoorden zelfde zijn
                    if($_POST['wachtwoord'] == $_POST['wachtwoord_herhalen'])
                    {
                        // ze zijn hetzelfde

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

                        $account_type = 'monteur';

                        $insert_monteur = $db->prepare("INSERT INTO gebruiker SET
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
                        $insert_monteur->bindParam(":naam",$_POST['naam']);
                        $insert_monteur->bindParam(":tussenvoegsel",$_POST['tussenvoegsel']);
                        $insert_monteur->bindParam(":achternaam",$_POST['achternaam']);
                        $insert_monteur->bindParam(":adres",$_POST['adres']);
                        $insert_monteur->bindParam(":postcode",$_POST['postcode']);
                        $insert_monteur->bindParam(":plaats",$_POST['plaats']);
                        $insert_monteur->bindParam(":email",$_POST['email']);
                        $insert_monteur->bindParam(":wachtwoord",$wachtwoord);
                        $insert_monteur->bindParam(":salt",$salt);
                        $insert_monteur->bindParam(":telnr",$_POST['telnr']);
                        $insert_monteur->bindParam(":account_type", $account_type);
                        $insert_monteur->execute();

                        $content->newBlock("NOTIFICATIE");
                        header("Refresh: 1.5; url=index.php?id=19");
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
                    // Geen juiste telnr, toon melding
                    $content->newBlock("FORMULIER");
                    $content->newBlock("MELDING");
                    $content->assign("MELDING", "<li>De door u ingevulde telefoonnummer is niet juist.</li>");
                }
            }
            else
            {
                // Email bestaat al
                $content->newBlock("FORMULIER");
                $content->newBlock("MELDING");
                $content->assign("MELDING", "<li>De door u ingevulde e-mailadres is al in gebruik.</li>");
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