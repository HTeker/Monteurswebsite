<div class="container">
    <div class="wrapper">
        <div class="grid">
            <div class="row">
                <div class="span12">
                    <!-- START BLOCK : FORMULIER -->
                    <h1 class="text-center">Gegevens wijzigen</h1>
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
                    <form action="index.php?id=8" method="post">
                        <fieldset>
                            <div class="input-control text" data-role="input-control">
                                <input name="adres" type="text" placeholder="{ADRES}">
                                <button class="btn-clear" tabindex="-1" type="button"></button>
                            </div>
                            <div class="input-control text" data-role="input-control">
                                <input name="postcode" type="text" placeholder="{POSTCODE}">
                                <button class="btn-clear" tabindex="-1" type="button"></button>
                            </div>
                            <div class="input-control text" data-role="input-control">
                                <input name="plaats" type="text" placeholder="{PLAATS}">
                                <button class="btn-clear" tabindex="-1" type="button"></button>
                            </div>
                            <div class="input-control text" data-role="input-control">
                                <input name="telnr" type="text" placeholder="{TELNR}">
                                <button class="btn-clear" tabindex="-1" type="button"></button>
                            </div>
                            <br><br>
                            <div class="input-control password" data-role="input-control">
                                <input name="wachtwoord" type="password" placeholder="Nieuw wachtwoord" autofocus="">
                                <button class="btn-clear" tabindex="-1" type="button"></button>
                            </div>
                            <div class="input-control password" data-role="input-control">
                                <input name="wachtwoord_herhalen" type="password" placeholder="Nieuw wachtwoord herhalen" autofocus="">
                                <button class="btn-clear" tabindex="-1" type="button"></button>
                            </div>
                            <br><br>
                            <label for="oud_wachtwoord">Vul uw oude wachtwoord in om de gegevens te wijzigen</label>
                            <div class="input-control password" data-role="input-control">
                                <input name="oud_wachtwoord" type="password" placeholder="Oud wachtwoord" autofocus="">
                                <button class="btn-clear" tabindex="-1" type="button"></button>
                            </div>
                            <br><br>
                            <input class="large primary" name="submit" type="submit" value="Wijzigen">
                        </fieldset>
                    </form>
                    <!-- END BLOCK : FORMULIER -->
                    <!-- START BLOCK : GEWIJZIGD -->
                    <br><br><br><br><br><br><br><br>
                    <h3 class="text-success text-center"><b>Uw gegevens zijn gewijzigd!</b></h3>
                    <!-- END BLOCK : GEWIJZIGD -->
                </div>
            </div>
        </div>
    </div>
</div>