<div class="container">
    <div class="wrapper">
        <div class="grid">
            <div class="row">
                <div class="span12">
                    <!-- START BLOCK : OVERZICHT -->
                    <h1 class="text-center">Overzicht facturen</h1>
                    <br>
                    <table class="table bordered striped hovered">
                        <thead>
                        <tr>
                            <th class="text-left">Factuur-ID</th>
                            <th class="text-left">Klant-ID</th>
                            <th class="text-left">Omschrijving</th>
                            <th class="text-left">Factuurdatum</th>
                            <th class="text-left">Monteur</th>
                            <th class="text-left">Totaalprijs</th>
                            <th class="text-left">Voldaan</th>
                        </tr>
                        </thead>

                        <tbody>
                        <!-- START BLOCK : FACTUREN -->
                        <tr>
                            <td><b>{FID}</b></td>
                            <td><b>{KID}</b></td>
                            <td><b>{OMSCHRIJVING}</b>... <a class="place-right" href="index.php?id=18&action=details&fid={FID}">[details]</a></td>
                            <td><b>{FDATUM}</b> om <b>{FTIJD}</b> uur</td>
                            <td><b>{MNAAM} {MTUSSENVOEGSEL} {MACHTERNAAM}</b></td>
                            <td><b>{TOTAALPRIJS}</b></td>
                            <td><b>{VOLDAAN}</b></td>
                        </tr>
                        <!-- END BLOCK : FACTUREN -->
                        </tbody>

                        <tfoot></tfoot>
                    </table>
                    <!-- END BLOCK : OVERZICHT -->



                    <!-- START BLOCK : DETAILS -->
                    <h1 class="text-center">Details van factuur</h1>
                    <br>
                    <h3 class="subheader-secondary">
                        Factuur-ID: <b>{FID}</b><br>
                        Klant-ID: <b>{KID}</b><br>
                        Factuurdatum: <b>{FDATUM}</b> om <b>{FTIJD}</b> uur<br>
                        Afspraakdatum: <b>{AFDATUM}</b> om <b>{AFTIJD} uur</b><br><br>
                        Omschrijving (monteur): <br><br><b>{OMSCHRIJVING}</b><br><br>
                        Werkzaamheden (monteur): <b>{WERKZAAMHEDEN}</b><br><br>
                        Materialen (monteur): <b>{MATERIALEN}</b><br><br>
                        Prijs: <b>{PRIJS}</b><br>
                        Korting: <b>{KORTING}</b><br>
                        Totaalprijs: <b>{TOTAALPRIJS}</b><br>
                    </h3>
                    <br>

                    <a href="index.php?id=18"><input class="large info" name="terug" type="button" value="Terug"></a>

                    <!-- END BLOCK : DETAILS -->


                    <!-- START BLOCK : GEEN_FACTUREN -->
                    <br><br><br><br><br><br><br><br>
                    <h3 class="text-center"><b>Er zijn nog geen facturen aangemaakt</h3>
                    <!-- END BLOCK : GEEN_FACTUREN -->

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