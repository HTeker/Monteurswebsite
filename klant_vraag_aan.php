<?php
$content = new TemplatePower("template/klant_vraag_aan.tpl");
$content->prepare();

if(isset($_POST['submit']))
{
    // Controleren of vereiste velden zijn ingevuld
    $bError = false;
    $aVereist = array("aanvraag","datum","tijdseenheid");
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
        // Geen error, check of datum min 1 dag erna is
        if($_POST['datum'] > date('d.m.Y'))
        {
            // Datum is minimaal een dag erna, insert de aanvraag

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
            $insert_koppeling->bindParam(":klantid",$_SESSION['gebruiker_id']);
            $insert_koppeling->bindParam(":aanvraagid",$aanvraagid);
            $insert_koppeling->execute();

            $content->newBlock("NOTIFICATIE");

            $content->assign(array(
                "DATUM" => $_POST['datum'],
                "TIJDSEENHEID" => $_POST['tijdseenheid']
            ));
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