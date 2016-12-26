<div class="container">
    <div class="wrapper">
        <div class="grid">
            <div class="row">
                <div class="span12">
                    <!-- START BLOCK : OVERZICHT_MONTEURS -->
                    <h1 class="text-center">Overzicht monteurs</h1>
                    <br>
                    <table class="table bordered striped hovered">
                        <thead>
                        <tr>
                            <th class="text-left">ID</th>
                            <th class="text-left">Naam</th>
                            <th class="text-left">Afspraken</th>
                            <th class="text-left">Status</th>
                        </tr>
                        </thead>

                        <tbody>
                        <!-- START BLOCK : MONTEURS -->
                        <tr>
                            <td>{MID}</td>
                            <td>{MNAAM} {MTUSSENVOEGSEL} {MACHTERNAAM}</td>
                            <td>Eerst volgende afspraak op <b>{1DATUM}</b> om <b>{1TIJD} </b>uur
                                <a class="place-right" href="index.php?id=19&action=afspraken&mid={MID}">[bekijk afspraken]</a></td>
                            <td>{STATUS} <a class="place-right" href="index.php?id=19&action={SETSTATUS}&mid={MID}">[zet op {SETSTATUS}]</a></td>
                        </tr>
                        <!-- END BLOCK : MONTEURS -->
                        </tbody>

                        <tfoot></tfoot>
                    </table>
                    <!-- END BLOCK : OVERZICHT_MONTEURS -->


                    <!-- START BLOCK : GEEN_MONTEURS -->
                    <br><br><br><br><br><br><br><br>
                    <h3 class="text-alert text-center"><b>Er zijn nog geen monteurs</h3>
                    <h3 class="text-alert text-center" style="font-size: 16px;"><b><a href="index.php?id=20">Klik hier om er een toe te voegen</a></h3>
                    <!-- END BLOCK : GEEN_MONTEURS -->





                    <!-- START BLOCK : OVERZICHT_AFSPRAKEN -->
                    <h1 class="text-center">Afspraken van monteur <b>{MNAAM}</b></h1>
                    <br>
                    <table class="table bordered striped hovered">
                        <thead>
                        <tr>
                            <th class="text-left">ID</th>
                            <th class="text-left">Klant-ID</th>
                            <th class="text-left">Aanvraag</th>
                            <th class="text-left">Tijd</th>
                        </tr>
                        </thead>

                        <tbody>
                        <!-- START BLOCK : AFSPRAKEN -->
                        <tr>
                            <td>{AFID}</td>
                            <td>{KID}</td>
                            <td>{AANVRAAG}... <a class="place-right" href="index.php?id=19&action=details&afid={AFID}">[details]</a></td>
                            <td><b>{DATUM}</b> om <b>{TIJD}</b></td>
                        </tr>
                        <!-- END BLOCK : AFSPRAKEN -->
                        </tbody>

                        <tfoot></tfoot>
                    </table>
                    <a href="index.php?id=19"><input class="large info" name="terug" type="button" value="Terug"></a>
                    <!-- END BLOCK : OVERZICHT_AFSPRAKEN -->

                    <!-- START BLOCK : GEEN_AFSPRAKEN -->
                    <br><br><br><br><br><br><br><br>
                    <h3 class="text-alert text-center"><b>Deze monteur heeft geen afspraken staan</h3>
                    <h3 class="text-alert text-center" style="font-size: 16px;"><b><a href="index.php?id=21">Klik hier om een aanvraag te koppelen</a></h3>
                    <!-- END BLOCK : GEEN_AFSPRAKEN -->

                    <!-- START BLOCK : DETAILS -->
                    <h1 class="text-center">Details van afspraak</h1>
                    <br>
                    <h3 class="subheader-secondary">
                        ID: <b>{AFID}</b><br>
                        Klant-ID: <b>{KID}</b><br>
                        Klant-naam: <b>{KNAAM} {KTUSSENVOEGSEL} {KACHTERNAAM}</b><br>
                        Datum: <b>{DATUM}</b><br>
                        Tijd: <b>{TIJD}</b><br><br>

                        Aanvraag (klant): <br><br><b>
                            {AANVRAAG}</b><br><br>
                        Opmerking (admin): <br><br><b>
                            {OPMERKING}</b>
                    </h3>
                    <br>
                    <a href="index.php?id=19&action=afspraken&mid={MID}"><input class="large info" name="terug" type="button" value="Terug"></a>


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