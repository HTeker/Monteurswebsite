<?php
try
{
    session_start();
    error_reporting(E_ALL);
// inladen van template power
    include_once("include/class.TemplatePower.inc.php");
    include_once("include/config.php");

    date_default_timezone_set('Europe/Amsterdam');

// inladen van header
    include("header.php");

// inladen van content
    if(isset($_GET['id']))
    {
        // heb een pagina id, dus opzoeken in db
        $check_id = $db->prepare("SELECT count(*)
            FROM pagina WHERE id = :paginaid");
        $check_id->bindParam(":paginaid", $_GET['id']);
        $check_id->execute();

        // controle of het resultaat van de count
        // (tellen van rijen) gelijk is aan 1
        if($check_id->fetchColumn() == 1)
        {
            // id in url staat in DB, dus pagina bestaat
            // ophalen van bestandsnaam

            $get_pagina = $db->prepare("SELECT * FROM
            pagina WHERE id = :paginaid");
            $get_pagina->bindParam(":paginaid", $_GET['id']);
            $get_pagina->execute();
            // heb maar 1 rij, dus geen lus nodig
            $pagina = $get_pagina->fetch(PDO::FETCH_ASSOC);

            // controleren of bestand ook werkelijk bestaat
            if(file_exists($pagina['bestand']))
            {
                // bestand bestaat, dus inladen
                include($pagina['bestand']);
            }
            else
            {
                // bestand bestaat niet, dus content.php
                include("content.php");
            }

        }
        else
        {
            // id in url bestaat niet. content.php inladen
            include("content.php");
        }

    }
    else
    {
        // geen pagina id gekregen.
        // standaard de content.php inladen
        include("content.php");

    }

// inladen van footer
    include("footer.php");
}
catch(PDOException $e)
{
    $sMsg = '<p>
            Regelnummer: '.$e->getLine().'<br />
            Bestand: '.$e->getFile().'<br />
            Foutmelding: '.$e->getMessage().'
        </p>';

    trigger_error($sMsg);
}
?>