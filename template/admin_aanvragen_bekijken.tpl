<div class="container">
    <div class="wrapper">
        <div class="grid">
            <div class="row">
                <div class="span12">
                    <!-- START BLOCK : OVERZICHT -->
                    <h1 class="text-center">Overzicht aanvragen</h1>
                    <br>
                    <table class="table bordered striped hovered">
                        <thead>
                        <tr>
                            <th class="text-left">Aanvraag-ID</th>
                            <th class="text-left">Klant-ID</th>
                            <th class="text-left">Aanvraag</th>
                            <th class="text-left">Tijd</th>
                            <th class="text-left"></th>
                            <th class="text-left"></th>
                        </tr>
                        </thead>

                        <tbody>
                        <!-- START BLOCK : AANVRAGEN -->
                        <tr>
                            <td><b>{AID}</b></td>
                            <td><b>{KID}</b></td>
                            <td>{AANVRAAG}... <a class="place-right" href="index.php?id=21&action=details&aid={AID}">[details]</a></td>
                            <td><b>{DATUM}</b> tussen <b>{TIJDSEENHEID}</b></td>
                            <td><a class="place-right" href="index.php?id=21&action=inplannen&aid={AID}">[inplannen]</a></td>
                            <td><a class="place-right" href="index.php?id=21&action=annuleren&aid={AID}">[annuleren]</a></td>
                        </tr>
                        <!-- END BLOCK : AANVRAGEN -->
                        </tbody>

                        <tfoot></tfoot>
                    </table>
                    <!-- END BLOCK : OVERZICHT -->

                    <!-- START BLOCK : GEEN_AANVRAGEN -->
                    <br><br><br><br><br><br><br><br>
                    <h3 class="text-alert text-center"><b>Er zijn geen aanvragen</h3>
                    <!-- END BLOCK : GEEN_AANVRAGEN -->



                    <!-- START BLOCK : DETAILS -->
                    <h1 class="text-center">Details van aanvraag</h1>
                    <br>
                    <h3 class="subheader-secondary">
                        Aanvraag-ID: <b>{AID}</b><br>
                        Klant-ID: <b>{KID}</b><br>
                        Naam: <b>{NAAM} {TUSSENVOEGSEL} {ACHTERNAAM}</b><br>
                        Datum: <b>{DATUM}</b><br>
                        Tijd: <b>{TIJDSEENHEID}</b><br>
                        Aanvraag: <b><br><br>{AANVRAAG}</b>
                    </h3>
                    <br>

                    <a href="index.php?id=21"><input class="large info" name="submit" type="submit" value="Terug"></a>

                    <!-- END BLOCK : DETAILS -->


                    <!-- START BLOCK : GEANNULEERD -->
                    <br><br><br><br><br><br><br><br>
                    <h3 class="text-succes text-center"><b>De aanvraag is geannuleerd.</h3>
                    <h3 style="font-size: 120%;" class="text-succes text-center"><b>Er is een e-mail naar de klant verstuurd.</h3>
                    <!-- END BLOCK : GEANNULEERD -->

                    <!-- START BLOCK : INPLANNEN -->
                    <h1 class="header text-center">Aanvraag inplannen</h1>
                    <br>
                    <h3 class="subheader-secondary">
                        Aanvraag-ID: <b>{AID}</b><br>
                        Klant-ID: <b>{KID}</b><br>
                        Naam: <b>{KNAAM} {KTUSSENVOEGSEL} {KACHTERNAAM}</b><br>
                        Datum: <b>{DATUM}</b><br>
                        Tijd: <b>{TIJDSEENHEID}</b><br>
                        Aanvraag: <b><br><br>{AANVRAAG}</b>
                    </h3>
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

                    <form action="index.php?id=21&action=inplannen&aid={AID}" method="post">
                        <fieldset>
                            <label>Tijd:</label>
                            <div class="input-control text size1" data-role="input-control">
                                <input id="uur" name="uur" type="text" placeholder="00" maxlength="2" onkeyup="functie(this.value)">
                                <button class="btn-clear" tabindex="-1" type="button"></button>
                            </div>
                            <span>:</span>
                            <div class="input-control text size1" data-role="input-control">
                                <input id="min" name="min" type="text" placeholder="00" maxlength="2" onkeyup="functie(this.value)">
                                <button class="btn-clear" tabindex="-1" type="button"></button>
                            </div>
                            <span>uur</span>
                            <br>
                            <div class="input-control select size4">
                                <select name="monteur_id">
                                    <option value="default">Selecteer een monteur</option>
                                    <!-- START BLOCK : MONTEURS -->
                                    <option value="{MID}">{MNAAM} {MTUSSENVOEGSEL} {MACHTERNAAM}</option>
                                    <!-- END BLOCK : MONTEURS -->
                                </select>
                            </div>
                            <label>Opmerking:</label>
                            <div class="input-control textarea">
                                <textarea name="opmerking" style="min-height: 200px;"></textarea>
                            </div>
                            <br><br>
                            <a href="index.php?id=21"><input class="large info" name="terug" type="button" value="Terug"></a>
                            <input class="large primary" name="submit" type="submit" value="Plan in">
                        </fieldset>
                    </form>



<!--
                    <form action="index.php?id=21" method="post">
                        <fieldset>
                            <select id="option">
                                <option value="default">Choose</option>
                                <option value="opt1">Option 1</option>
                                <option value="opt2">Option 2</option>
                            </select>
                            <input id="tekst" type="text" class="tekst">
                            <br><br>
                            <a href="index.php?id=21"><input class="large info" type="submit" value="Terug"></a>
                            <input class="large primary" name="submit" type="submit" value="Plan in">
                        </fieldset>
                    </form>
-->


                    <!-- END BLOCK : INPLANNEN -->

                    <!-- START BLOCK : INGEPLAND -->
                    <br><br><br><br><br><br><br><br>
                    <h2 class="text-center"><b>De afspraak is ingepland</b></h2>
                    <!-- END BLOCK : INGEPLAND -->


                    <!-- START BLOCK : 404 -->
                    <br><br><br><br><br><br><br><br>
                    <h1 class="text-alert text-center"><b>404</b></h1>
                    <h3 class="text-alert text-center" style="font-size: 16px;">Deze pagina is niet toegankelijk</h3>
                    <!-- END BLOCK : 404 -->
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript" src="template/js/ext.js"></script>