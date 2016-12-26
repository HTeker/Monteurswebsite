<?php
$header = new TemplatePower("template/header.tpl");
$header->prepare();

/*$_SESSION['logged_in'] = true;
$_SESSION['gebruiker_id'] = 6;
$_SESSION['naam'] = 'Halil';
$_SESSION['tussenvoegsel'] = '';
$_SESSION['achternaam'] = 'Teker';
$_SESSION['account_type'] = 'admin';*/

if(isset($_SESSION['logged_in']))
{
    switch($_SESSION['account_type'])
    {
        case "klant":
            $header->newBlock("KLANT_NAVIGATIE");
            break;
        case "monteur":
            $header->newBlock("MONTEUR_NAVIGATIE");
            break;
        case "admin":
            $header->newBlock("ADMIN_NAVIGATIE");

            // Haal het aantal niet beantwoorde berichten uit db en zet in de header
            $select_berichten = $db->query("SELECT * FROM bericht WHERE antwoord = 0");
            $header->assign("BERICHTEN","<b>(".$select_berichten->rowCount().")</b>");

            break;
    }

    $header->assign(array(
        "NAAM" => $_SESSION['naam'],
        "TUSSENVOEGSEL" => $_SESSION['tussenvoegsel'],
        "ACHTERNAAM" => $_SESSION['achternaam']
    ));
}
else
{
    $header->newBlock("BEZOEKER_NAVIGATIE");
/*    $header->newBlock("KLANT_NAVIGATIE");
    $header->newBlock("MONTEUR_NAVIGATIE");
    $header->newBlock("ADMIN_NAVIGATIE");*/
}

