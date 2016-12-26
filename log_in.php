<?php
$content = new TemplatePower("template/log_in.tpl");
$content->prepare();

if(isset($_POST['submit']))
{
    if($_POST['email'] == "" OR $_POST['wachtwoord'] == '')
    {
        // Niet beide velden ingevuld, toon melding
        $content->newBlock("FORMULIER");
        $content->newBlock("MELDING");
        $content->assign("MELDING", "<li>U heeft niet beide velden ingevuld.</li>");
    }
    else
    {
        // Beide velden ingevuld, check of er een account is met email/wachtwoord-combinatie
        $select_salt = $db->prepare("SELECT salt FROM gebruiker WHERE email = :email");
        $select_salt->bindParam(":email",$_POST['email']);
        $select_salt->execute();

        if($row = $select_salt->fetch(PDO::FETCH_ASSOC))
        {
            $wachtwoord = hash('sha512',$row['salt'].$_POST['wachtwoord']);

            $check_inlog = $db->prepare("SELECT * FROM gebruiker WHERE
            email = :email AND
            wachtwoord = :wachtwoord AND
            salt = :salt");
            $check_inlog->bindParam(":email",$_POST['email']);
            $check_inlog->bindParam(":wachtwoord",$wachtwoord);
            $check_inlog->bindParam(":salt",$row['salt']);
            $check_inlog->execute();

            if($check_inlog->rowCount() == 1)
            {
                if($rij = $check_inlog->fetch(PDO::FETCH_ASSOC))
                {
                    // Log in
                    $_SESSION['logged_in'] = true;
                    $_SESSION['gebruiker_id'] = $rij['id'];
                    $_SESSION['naam'] = $rij['naam'];
                    $_SESSION['tussenvoegsel'] = $rij['tussenvoegsel'];
                    $_SESSION['achternaam'] = $rij['achternaam'];
                    $_SESSION['account_type'] = $rij['account_type'];
                    header('Location: index.php');
                }
            }
            else
            {
                // Inloggen mislukt, toon error
                $content->newBlock("FORMULIER");
                $content->newBlock("MELDING");
                $content->assign("MELDING", "<li>E-mail/wachtoord combinatie klopt niet.</li>");
            }
        }
        else
        {
            // Inloggen mislukt, toon error
            $content->newBlock("FORMULIER");
            $content->newBlock("MELDING");
            $content->assign("MELDING", "<li>E-mail/wachtoord combinatie klopt niet.</li>");
        }
    }
}
else
{
    $content->newBlock("FORMULIER");
}