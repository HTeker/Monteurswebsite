<?php

try{
    // verbinding met db aanmaken
    $db = new PDO(getenv('DATABASE_URL'));
    $db->setAttribute(PDO::ATTR_ERRMODE,
        PDO::ERRMODE_WARNING);
}catch (PDOException $error)
{

    //$template->newBlock("SQLERROR");
    print $error->getLine()."<br>".$error->getFile()."<br>".$error->getMessage();
}

date_default_timezone_set('Europe/Amsterdam');
