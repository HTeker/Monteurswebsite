<?php
$content = new TemplatePower("template/gebruiker_contact.tpl");
$content->prepare();

if(isset($_POST['submit']))
{
    // Knop is ingedrukt, controleer of er een bericht is ingevuld
    if(!empty($_POST['bericht']))
    {
        // bericht is ingevuld, haal gegevens van de gebruiker op om het te inserten
        $select_gegevens = $db->prepare("SELECT * FROM gebruiker WHERE id = :gebruiker_id");
        $select_gegevens->bindParam(":gebruiker_id",$_SESSION['gebruiker_id']);
        $select_gegevens->execute();

        while($row = $select_gegevens->fetch(PDO::FETCH_ASSOC))
        {
            $datum = date("Y-m-d");
            $tijd = date("H:i:s");

            $insert_bericht = $db->prepare("INSERT INTO bericht SET
            gebruiker_id = :gebruiker_id,
            naam = :naam,
            email = :email,
            telnr = :telnr,
            bericht = :bericht,
            tijd = :tijd,
            datum = :datum");
            $insert_bericht->bindParam(":gebruiker_id",$_SESSION['gebruiker_id']);
            $insert_bericht->bindParam(":naam",$row['naam']);
            $insert_bericht->bindParam(":email",$row['email']);
            $insert_bericht->bindParam(":telnr",$row['telnr']);
            $insert_bericht->bindParam(":bericht",$_POST['bericht']);
            $insert_bericht->bindParam(":tijd",$tijd);
            $insert_bericht->bindParam(":datum",$datum);
            $insert_bericht->execute();

            $content->newBlock("NOTIFICATIE");
            $content->assign("EMAIL",$row['email']);

            /* VERSTUUR EMAIL */

            // multiple recipients
            $to  = $row['email'];

            // subject
            $subject = 'Uw bericht is verstuurd!';

            // message
            $message = "
                <html>
                <head>
                  <title>Uw bericht aan mijnketeldoethetniet.nl</title>
                </head>
                <body>
                  Hallo ".$row['naam'].", <br><br>
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
    }
    else
    {
        // bericht is leeg, toon melding
        // telnr geen juiste constructie, toon melding
        $content->newBlock("FORMULIER");
        $content->newBlock("MELDING");
        $content->assign("MELDING", "<li>U heeft geen bericht ingevuld.</li>");
    }
}
else
{
    $content->newBlock("FORMULIER");
}