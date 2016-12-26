<div class="container">
    <div class="wrapper">
        <div class="grid">
            <div class="row">
                <div class="span12">
                    <!-- START BLOCK : OVERZICHT -->
                    <h1 class="header text-center">Overzicht aanvragen</h1>
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
                            <td><b>{AID}</b></td>
                            <td>{AANVRAAG}... <a href="index.php?id=11&action=details&aid={AID}" class="place-right">[details]</a></td>
                            <td><b>{DATUM}</b> tussen <b>{TIJDSEENHEID}</b></td>
                        </tr>
                        <!-- END BLOCK : AANVRAGEN -->
                        </tbody>

                        <tfoot></tfoot>
                    </table>
                    <!-- END BLOCK : OVERZICHT -->

                    <!-- START BLOCK : GEEN_AANVRAGEN -->
                    <br><br><br><br><br><br><br><br>
                    <h3 class="text-center"><b>U heeft nog geen aanvragen gedaan</h3>
                    <h3 class="text-center" style="font-size: 20px;"><b>Of al uw aanvragen zijn behandeld</h3>
                    <h3 class="text-center" style="font-size: 16px;"><b><a href="index.php?id=13">Klik hier om een aanvraag te doen.</a></h3>
                    <!-- END BLOCK : GEEN_AANVRAGEN -->



                    <!-- START BLOCK : DETAILS -->
                    <h1 class="text-center">Details van aanvraag</h1>
                    <br>
                    <h3 class="subheader-secondary">
                        ID: <b>{AID}</b><br>
                        Datum: <b>{DATUM}</b><br>
                        Tijd: <b>{TIJDSEENHEID}</b><br>
                        Aanvraag: <b><br><br>{AANVRAAG}</b><br>
                    </h3>
                    <br>

                    <a href="index.php?id=11"><input class="large info" name="submit" type="submit" value="Terug"></a>

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