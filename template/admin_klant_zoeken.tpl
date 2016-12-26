<div class="container">
    <div class="wrapper">
        <div class="grid">
            <div class="row">
                <div class="span12">
                    <!-- START BLOCK : OVERZICHT_ZOEKRESULTATEN -->
                    <h1 class="text-center">Zoekresultaten voor '{ZOEKOPDRACHT}'</h1>
                    <br>
                    <table class="table bordered striped hovered">
                        <thead>
                        <tr>
                            <th class="text-left">Klant-ID</th>
                            <th class="text-left">Naam</th>
                            <th class="text-left">Adres-gegevens</th>
                            <th class="text-left">E-mail</th>
                            <th class="text-left">Telnr</th>
                        </tr>
                        </thead>

                        <tbody>
                        <!-- START BLOCK : KLANT_GEGEVENS -->
                        <tr>
                            <td><b>{KID}</b></td>
                            <td><b>{NAAM} {TUSSENVOEGSEL} {ACHTERNAAM}</b></td>
                            <td>Adres: <b>{ADRES}</b><br>
                                    Postcode: <b>{POSTCODE}</b><br>
                                    Plaats: <b>{PLAATS}</b>
                            </td>
                            <td><b>{EMAIL}</b></td>
                            <td><b>{TELNR}</b></td>
                        </tr>
                        <!-- END BLOCK : KLANT_GEGEVENS -->
                        </tbody>

                        <tfoot></tfoot>
                    </table>
                    <!-- END BLOCK : OVERZICHT_ZOEKRESULTATEN -->






                    <!-- START BLOCK : OVERZICHT_AANVRAGEN -->
                    <h1 class="text-center">Overzicht aanvragen</h1>
                    <br>
                    <table class="table bordered striped hovered">
                        <thead>
                        <tr>
                            <th class="text-left">ID</th>
                            <th class="text-left">Aanvraag</th>
                            <th class="text-left">Tijd</th>
                        </tr>
                        </thead>

                        <tbody>
                        <!-- START BLOCK : AANVRAGEN -->
                        <tr>
                            <td>{AID}</td>
                            <td class="aanvraag">{AANVRAAG}...<a href="index.php?id=7&action=details&aid={AID}"><span class="float-right">details</span></a></td>
                            <td><b>{DATUM}</b> om <b>{TIJD}</b> uur
                                <!-- START BLOCK : EIND_TIJD -->
                                <b>{EIND_DATUM}</b> om <b>{EIND_TIJD}</b> uur
                                <!-- END BLOCK : EIND_TIJD -->
                                <a href="#"><span class="float-right">verzet</span></a>
                            </td>
                        </tr>
                        </tbody>
                        <!-- END BLOCK : AANVRAGEN -->

                        <tfoot></tfoot>
                    </table>
                    <!-- END BLOCK : OVERZICHT_AANVRAGEN -->

                    <!-- START BLOCK : GEEN_ZOEKRESULTATEN -->
                    <br><br><br><br><br><br><br><br>
                    <h3 class="text-center"><b>Geen zoekresultaten</h3>
                    <!-- END BLOCK : GEEN_ZOEKRESULTATEN -->



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