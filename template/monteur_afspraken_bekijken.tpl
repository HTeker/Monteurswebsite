<div class="container">
    <div class="wrapper">
        <div class="grid">
            <div class="row">
                <div class="span12">
                    <!-- START BLOCK : OVERZICHT -->
                    <h1 class="text-center">Overzicht afspraken</h1>
                    <br>
                    <table class="table bordered striped hovered">
                        <thead>
                        <tr>
                            <th class="text-left">Afspraak-ID</th>
                            <th class="text-left">Klant-ID</th>
                            <th class="text-left">Aanvraag-ID</th>
                            <th class="text-left">Aanvraag</th>
                            <th class="text-left">Tijd</th>
                            <th class="text-left"></th>
                        </tr>
                        </thead>

                        <tbody>
                        <!-- START BLOCK : AFSPRAKEN -->
                        <tr>
                            <td><b>{AFID}</b></td>
                            <td><b>{KID}</b></td>
                            <td><b>{AID}</b></td>
                            <td>{AANVRAAG}... <a class="place-right" href="index.php?id=16&action=details&afid={AFID}">[details]</a></td>
                            <td><b>{DATUM}</b> om <b>{TIJD}</b> uur</td>
                            <td><a class="place-right" href="index.php?id=16&action=afronden&afid={AFID}">[afronden]</a></td>
                        </tr>
                        <!-- END BLOCK : AFSPRAKEN -->
                        </tbody>

                        <tfoot></tfoot>
                    </table>
                    <!-- END BLOCK : OVERZICHT -->



                    <!-- START BLOCK : DETAILS -->
                    <h1 class="text-center">Details van aanvraag</h1>
                    <br>
                    <h3 class="subheader-secondary">
                        Afspraak-ID: <b>{AFID}</b><br>
                        Aanvraag-ID: <b>{AID}</b><br>
                        Klant-ID: <b>{KID}</b><br>
                        Datum: <b>{DATUM}</b><br>
                        Tijd: <b>{TIJD} uur</b><br><br>
                        Aanvraag (klant): <b><br><br>{AANVRAAG}</b><br><br>
                        Opmerking (admin): <b><br><br>{OPMERKING}<br></b>
                    </h3>
                    <br>

                    <a href="index.php?id=16"><input class="large info" name="submit" type="submit" value="Terug"></a>

                    <!-- END BLOCK : DETAILS -->

                    <!-- START BLOCK : AFRONDEN -->
                    <h1 class="text-center">Afspraak <b>({AFID})</b> afronden</h1>
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
                    <form method="post" action="index.php?id=16&action=afronden&afid={AFID}">
                        <fieldset>
                            <div class="input-control textarea">
                                <label>Omschrijving:</label>
                                <textarea name="omschrijving" placeholder="Omschrijving" style="min-height: 200px;"></textarea>
                            </div>
                            <br><br>
                            <div class="input-control textarea">
                                <label>Verrichte werkzaamheden:</label>
                                <textarea name="werkzaamheden" placeholder="Verrichte werkzaamheden" style="min-height: 200px;"></textarea>
                            </div>
                            <br><br>
                            <div class="input-control textarea">
                                <label>Gebruikte materialen:</label>
                                <textarea name="materialen" placeholder="Gebruikte materialen" style="min-height: 200px;"></textarea>
                            </div>
                            <br><br>
                            <input class="large primary" type="submit" name="submit" value="Verstuur">
                        </fieldset>
                    </form>
                    <!-- END BLOCK : AFRONDEN -->

                    <!-- START BLOCK : AFGEROND -->
                    <br><br><br><br><br><br><br><br>
                    <h3 class="text-succes text-center"><b>De afspraak is nu afgerond.</h3>
                    <h3 style="font-size: 120%;" class="text-succes text-center"><b><a href="index.php?id=15">Klik hier als u er een factuur van wilt maken.</a></h3>
                    <!-- END BLOCK : AFGEROND -->


                    <!-- START BLOCK : GEEN_AFSPRAKEN -->
                    <br><br><br><br><br><br><br><br>
                    <h3 class="text-alert text-center"><b>Er zijn geen afspraken ingepland.</h3>
                    <!-- END BLOCK : GEEN_AFSPRAKEN -->

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