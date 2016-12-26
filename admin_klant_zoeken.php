<?php
$content = new TemplatePower("template/admin_klant_zoeken.tpl");
$content->prepare();

if(isset($_POST['submit']))
{
    $zoekopdracht = "%".$_POST['zoekopdracht']."%";
    $select_klanten = $db->prepare("SELECT g . *
        FROM gebruiker g
        WHERE g.account_type =  'klant'
        AND ( g.naam LIKE  :zoekopdracht
        OR g.tussenvoegsel LIKE  :zoekopdracht
        OR g.achternaam LIKE  :zoekopdracht
        OR g.id LIKE  :zoekopdracht)");
    $select_klanten->bindParam(":zoekopdracht",$zoekopdracht);
    $select_klanten->execute();

    if($select_klanten->rowCount() > 0)
    {
        $content->newBlock("OVERZICHT_ZOEKRESULTATEN");
        $content->assign("ZOEKOPDRACHT",$_POST['zoekopdracht']);

        while($zoek_resultaat = $select_klanten->fetch(PDO::FETCH_ASSOC))
        {
            $content->newBlock("KLANT_GEGEVENS");
            $content->assign(array(
                "KID" => $zoek_resultaat['id'],
                "NAAM" => $zoek_resultaat['naam'],
                "TUSSENVOEGSEL" => $zoek_resultaat['tussenvoegsel'],
                "ACHTERNAAM" => $zoek_resultaat['achternaam'],
                "ADRES" => $zoek_resultaat['adres'],
                "POSTCODE" => $zoek_resultaat['postcode'],
                "PLAATS" => $zoek_resultaat['plaats'],
                "EMAIL" => $zoek_resultaat['email'],
                "TELNR" => $zoek_resultaat['telnr']
            ));
        }
    }
    else
    {
        $content->newBlock("GEEN_ZOEKRESULTATEN");
    }
}
else
{

}