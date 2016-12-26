<?php
$uren = array("01","02","03","04","05","06","07","08","09","10","11","12",
    "13","14","15","16","17","18","19","20","21","22","23","24");

$u = $_REQUEST['u']; $verzoek = "";

if($u != "")
{
    foreach($uren as $uur)
    {
        if($uur === $verzoek)
        {
            echo $verzoek;
        }
    }
}

echo $u;
echo "test";