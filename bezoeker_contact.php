<?php
$content = new TemplatePower("template/bezoeker_contact.tpl");
$content->prepare();

if(isset($_POST['submit']))
{
    // Controleren of vereiste velden zijn ingevuld
    $bError = false;
    $aVereist = array("naam","email","telnr","bericht");
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
        // Vereiste velden zijn ingevuld, check of email juiste constructie heeft
        if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL))
        {
            // E-mailconstructie is onjuist, toon melding
            $content->newBlock("FORMULIER");
            $content->newBlock("MELDING");
            $content->assign("MELDING", "<li>De door u ingevulde e-mailadres is niet geldig.</li>");
        }
        else
        {
            // Email is in juiste constructie, check of telnr juiste constructie heeft
            if(is_numeric($_POST['telnr']) AND strlen((string) $_POST['telnr']) == 10)
            {
                // Telnr juiste constructie, zet bericht in db en stuur email naar de bezoeker

                $datum = date("Y-m-d");
                $tijd = date("H:i:s");

                $insert_bericht = $db->prepare("INSERT INTO bericht SET
                naam = :naam,
                email = :email,
                telnr = :telnr,
                bericht = :bericht,
                tijd = :tijd,
                datum = :datum");
                $insert_bericht->bindParam(":naam",$_POST['naam']);
                $insert_bericht->bindParam(":email",$_POST['email']);
                $insert_bericht->bindParam(":telnr",$_POST['telnr']);
                $insert_bericht->bindParam(":bericht",$_POST['bericht']);
                $insert_bericht->bindParam(":tijd",$tijd);
                $insert_bericht->bindParam(":datum",$datum);
                $insert_bericht->execute();

                $content->newBlock("NOTIFICATIE");
                $content->assign("EMAIL",$_POST['email']);

                /* VERSTUUR EMAIL */

                // multiple recipients
                $to  = $_POST['email'];

                // subject
                $subject = 'Uw bericht is verstuurd!';

                // message
                $message = "
                <html>
                <head>
                  <title>Uw bericht aan mijnketeldoethetniet.nl</title>
                </head>
                <body>
                  Hallo ".$_POST['naam'].", <br><br>
                  Uw bericht is verstuurd naar ons, er wordt zo snel mogelijk contact met u opgenomen via de mail.<br><br>
                  <b>Hieronder uw bericht:</b><br>
                  ".$_POST['bericht']."
                </body>
                </html>
                ";

                // To send HTML mail, the Content-type header must be set
                $headers  = 'MIME-Version: 1.0' . "\r\n";
                $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

                // Mail it
                mail($to, $subject, $message, $headers);

                /* VERSTUUR EMAIL */

            }
            else
            {
                // telnr geen juiste constructie, toon melding
                $content->newBlock("FORMULIER");
                $content->newBlock("MELDING");
                $content->assign("MELDING", "<li>De door u ingevulde telefoonnummer is niet geldig.</li>");
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
    $content->newBlock("FORMULIER");
}