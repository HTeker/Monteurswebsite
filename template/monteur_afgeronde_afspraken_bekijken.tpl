<div class="container">
    <div class="wrapper">
        <div class="grid">
            <div class="row">
                <div class="span12">
                    <!-- START BLOCK : OVERZICHT -->
                    <h1 class="text-center">Overzicht afgeronde afspraken</h1>
                    <br>
                    <table class="table bordered striped hovered">
                        <thead>
                        <tr>
                            <th class="text-left">Afspraak-ID</th>
                            <th class="text-left">Klant-ID</th>
                            <th class="text-left">Aanvraag-ID</th>
                            <th class="text-left">Aanvraag</th>
                            <th class="text-left">Tijd</th>
                        </tr>
                        </thead>

                        <tbody>
                        <!-- START BLOCK : AFSPRAKEN -->
                        <tr>
                            <td><b>{AFID}</b></td>
                            <td><b>{KID}</b></td>
                            <td><b>{AID}</b></td>
                            <td>{AANVRAAG}... <a class="place-right" href="index.php?id=17&action=details&afid={AFID}">[details]</a></td>
                            <td><b>{DATUM}</b> om <b>{TIJD}</b> uur</td>
                        </tr>
                        <!-- END BLOCK : AFSPRAKEN -->
                        </tbody>

                        <tfoot></tfoot>
                    </table>
                    <!-- END BLOCK : OVERZICHT -->



                    <!-- START BLOCK : DETAILS -->
                    <h1 class="text-center">Details van afspraak</h1>
                    <br>
                    <h3 class="subheader-secondary">
                        Afspraak-ID: <b>{AFID}</b><br>
                        Aanvraag-ID: <b>{AID}</b><br>
                        Klant-ID: <b>{KID}</b><br>
                        Datum: <b>{DATUM}</b><br>
                        Tijd: <b>{TIJD}</b><br><br>
                        Aanvraag (klant): <b><br><br>{AANVRAAG}</b><br><br>
                        Opmerking (admin): <b><br><br>{OPMERKING}<br></b><br>
                        Omschrijving (monteur): <b><br><br>{OMSCHRIJVING}<br></b><br>
                        Werkzaamheden (monteur): <b><br><br>{WERKZAAMHEDEN}<br></b><br>
                        Materialen (monteur): <b><br><br>{MATERIALEN}<br></b>
                    </h3>
                    <br>

                    <a href="index.php?id=17"><input class="large info" name="terug" type="button" value="Terug"></a>

                    <!-- END BLOCK : DETAILS -->

                    <!-- START BLOCK : GEEN_AFSPRAKEN -->
                    <br><br><br><br><br><br><br><br>
                    <h3 class="text-alert text-center"><b>Van alle afgeronde afspraken is er al een factuur aangemaakt.</h3>
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