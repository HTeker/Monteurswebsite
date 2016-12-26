<body class="metro">
<div class="container">
    <div class="wrapper">
        <div class="grid">
            <div class="row">
                <div class="span8">
                    <!-- START BLOCK : FORMULIER -->
                    <h1 class="text-center">Registreer</h1>
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
                    <form action="index.php?id=4" method="post">
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
                            <div class="input-control textarea">
                                <textarea class="linebreaks" name="aanvraag" placeholder="Aanvraag"></textarea>
                            </div>
                            <br><br>
                            <!--<div class="input-control text" data-role="datepicker" data-week-start="1">
                                <input name="datum" type="text" placeholder="Kies datum">
                                <span class="btn-date"></span>
                            </div>
                            <div class="input-control text" data-role="input-control">
                                <input name="tijd" type="text" placeholder="Vul tijd in: 00:00">
                                <button class="btn-clear" tabindex="-1" type="button"></button>
                            </div>-->
                            <div class="input-control text" data-role="datepicker" data-week-start="1">
                                <input name="datum" type="text" placeholder="Kies datum">
                                <span class="btn-date"></span>
                            </div>
                            <label for="radio-buttons">Selecteer een tijd</label>
                            <div name="radio-buttons" class="input-control radio default-style">
                                <label>
                                    <input name="tijdseenheid" type="radio" value="09:00 - 12:00" checked=""/>
                                    <span class="check"></span>
                                    's Ochtends (09:00u - 12:00u)
                                </label>
                            </div>
                            <div name="radio-buttons" class="input-control radio default-style">
                                <label>
                                    <input name="tijdseenheid" type="radio" value="12:00 - 15:00"/>
                                    <span class="check"></span>
                                    's Middags (12:00u - 15:00u)
                                </label>
                            </div>
                            <div name="radio-buttons" class="input-control radio default-style">
                                <label>
                                    <input name="tijdseenheid" type="radio" value="15:00 - 18:00"/>
                                    <span class="check"></span>
                                    Na middag (15:00u - 18:00u)
                                </label>
                            </div>
                            <br><br>
                            <input class="large primary" name="submit" type="submit" value="Registreer en vraag aan">
                        </fieldset>
                    </form>
                    <!-- END BLOCK : FORMULIER -->
                </div>
            </div>
        </div>
    </div>
</div>
</body>