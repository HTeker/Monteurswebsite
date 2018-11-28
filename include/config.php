<?php

try{
    $parts = (parse_url(getenv('DATABASE_URL') ?: 'postgresql://root:@localhost/monteur'));
    extract($parts);
    $path = ltrim($path, "/");
    // verbinding met db aanmaken
    $db = new PDO("pgsql:host={$host};port={$port};dbname={$path}", $user, $pass);
    $db->setAttribute(PDO::ATTR_ERRMODE,
        PDO::ERRMODE_WARNING);
}catch (PDOException $error)
{

    //$template->newBlock("SQLERROR");
    print $error->getLine()."<br>".$error->getFile()."<br>".$error->getMessage();
}

date_default_timezone_set('Europe/Amsterdam');
