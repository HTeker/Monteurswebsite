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
                            <th class="text-left">ID</th>
                            <th class="text-left">Aanvraag-ID</th>
                            <th class="text-left">Aanvraag</th>
                            <th class="text-left">Tijd</th>
                        </tr>
                        </thead>

                        <tbody>
                        <!-- START BLOCK : AFSPRAKEN -->
                        <tr>
                            <td><b>{AFID}</b></td>
                            <td><b>{AID}</b></td>
                            <td>{AANVRAAG}... <a class="place-right" href="index.php?id=12&action=details&afid={AFID}">[details]</a></td>
                            <td><b>{DATUM}</b> om <b>{TIJD}</b></td>
                        </tr>
                        <!-- END BLOCK : AFSPRAKEN -->
                        </tbody>

                        <tfoot></tfoot>
                    </table>
                    <!-- END BLOCK : OVERZICHT -->

                    <!-- START BLOCK : GEEN_AFSPRAKEN -->
                    <br><br><br><br><br><br><br><br>
                    <h3 class="text-alert text-center"><b>U heeft nog geen afspraken staan.</h3>
                    <h3 class="text-center" style="font-size: 20px;"><b>Het is mogelijk dat u een aanvraag heeft gedaan en dat deze nog niet verwerkt is</h3>
                    <h3 class="text-center" style="font-size: 16px;"><b><a href="index.php?id=13">Klik hier als u een aanvraag wilt doen</a></h3>
                    <!-- END BLOCK : GEEN_AFSPRAKEN -->



                    <!-- START BLOCK : DETAILS -->
                    <h1 class="text-center">Details van afspraak</h1>
                    <br>
                    <h3 class="subheader-secondary">
                        ID: <b>{AFID}</b><br>
                        Aanvraag-ID: <b>{AID}</b><br>
                        Datum: <b>{DATUM}</b><br>
                        Tijd: <b>{TIJD} uur</b><br>
                        Monteur: <b>{MNAAM} {MTUSSENVOEGSEL} {MACHTERNAAM}</b><br>
                        Aanvraag: <b><br><br>{AANVRAAG}</b>
                    </h3>
                    <br>

                    <a href="index.php?id=12"><input class="large info" name="terug" type="button" value="Terug"></a>

                    <!-- END BLOCK : DETAILS -->



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