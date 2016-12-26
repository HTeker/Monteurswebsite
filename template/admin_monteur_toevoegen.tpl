<body class="metro">
<div class="container">
    <div class="wrapper">
        <div class="grid">
            <div class="row">
                <div class="span8">
                    <!-- START BLOCK : FORMULIER -->
                    <h1 class="text-center">Voeg monteur toe</h1>
                    <br>
                    <!-- START BLOCK : MELDING -->
                    <div class="padding10 bg-red fg-white text-center">
                        <span class="icon-warning"></span><br>
                        <ul class="melding fg-white text-left">
                            <p>{MELDING}</p>
                        </ul>
                    </div>
                    <br>
                    <!-- END BLOCK : MELDING -->
                    <form action="index.php?id=20" method="post">
                        <fieldset>
                            <div class="input-control text" data-role="input-control">
                                <input name="naam" type="text" placeholder="Naam">
                                <button class="btn-clear" tabindex="-1" type="button"></button>
                            </div>
                            <div class="input-control text" data-role="input-control">
                                <input name="tussenvoegsel" type="text" placeholder="Tussenvoegsel">
                                <button class="btn-clear" tabindex="-1" type="button"></button>
                            </div>
                            <div class="input-control text" data-role="input-control">
                                <input name="achternaam" type="text" placeholder="Achternaam">
                                <button class="btn-clear" tabindex="-1" type="button"></button>
                            </div>
                            <br><br>
                            <div class="input-control text" data-role="input-control">
                                <input name="adres" type="text" placeholder="Adres">
                                <button class="btn-clear" tabindex="-1" type="button"></button>
                            </div>
                            <div class="input-control text" data-role="input-control">
                                <input name="postcode" type="text" placeholder="Postcode">
                                <button class="btn-clear" tabindex="-1" type="button"></button>
                            </div>
                            <div class="input-control text" data-role="input-control">
                                <input name="plaats" type="text" placeholder="Plaats">
                                <button class="btn-clear" tabindex="-1" type="button"></button>
                            </div>
                            <br><br>
                            <div class="input-control text" data-role="input-control">
                                <input name="email" type="text" placeholder="E-mail">
                                <button class="btn-clear" tabindex="-1" type="button"></button>
                            </div>
                            <div class="input-control text" data-role="input-control">
                                <input name="telnr" type="text" placeholder="Telnr">
                                <button class="btn-clear" tabindex="-1" type="button"></button>
                            </div>
                            <br><br>
                            <div class="input-control password" data-role="input-control">
                                <input name="wachtwoord" type="password" placeholder="Wachtwoord" autofocus="">
                                <button class="btn-clear" tabindex="-1" type="button"></button>
                            </div>
                            <div class="input-control password" data-role="input-control">
                                <input name="wachtwoord_herhalen" type="password" placeholder="Wachtwoord herhalen" autofocus="">
                                <button class="btn-clear" tabindex="-1" type="button"></button>
                            </div>
                            <br><br>
                            <input class="large primary" name="submit" type="submit" value="Monteur toevoegen">
                        </fieldset>
                    </form>
                    <!-- END BLOCK : FORMULIER -->

                    <!-- START BLOCK : NOTIFICATIE -->
                    <br><br><br><br><br><br><br><br>
                    <h3 class="text-success text-center"><b>De monteur is toegevoegd!</h3>
                    <!-- END BLOCK : NOTIFICATIE -->
                </div>
            </div>
        </div>
    </div>
</div>
</body>