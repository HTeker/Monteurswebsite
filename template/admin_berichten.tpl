<div class="container">
    <div class="wrapper">
        <div class="grid">
            <div class="row">
                <div class="span12">
                    <!-- START BLOCK : OVERZICHT -->
                    <h1 class="text-center">Overzicht berichten</h1>
                    <br>
                    <table class="table bordered striped hovered">
                        <thead>
                        <tr>
                            <th class="text-left">ID</th>
                            <th class="text-left">Gebruiker-id</th>
                            <th class="text-left">Naam</th>
                            <th class="text-left">Bericht</th>
                            <th class="text-left">Contact</th>
                            <th class="text-left"></th>
                        </tr>
                        </thead>

                        <tbody>
                            <!-- START BLOCK : BERICHTEN -->
                            <tr>
                                <td>{BID}</td>
                                <td>{GID}</td>
                                <td>{NAAM}{TUSSENVOEGSEL}{ACHTERNAAM}</td>
                                <td>{BERICHT}</td>
                                <td>E-mail: <b>{EMAIL}</b><br>
                                    Tel-nr: <b>{TELNR}</b></td>
                                <td><a href="index.php?id=24&action=antwoord&bid={BID}">[beantwoorden]</a></td>
                            </tr>
                            <!-- END BLOCK : BERICHTEN -->
                        </tbody>

                        <tfoot></tfoot>
                    </table>
                    <!-- END BLOCK : OVERZICHT -->



                    <!-- START BLOCK : ANTWOORD -->
                    <h1 class="text-center">Beantwoord bericht</h1>
                    <br>
                    <h3 class="subheader-secondary">
                        Bericht-ID : <b>{BID}</b><br>
                        Gebruiker-ID : <b>{GID}</b><br>
                        Naam: <b>{NAAM}{TUSSENVOEGSEL}{ACHTERNAAM}</b><br>
                        E-mail: <b>{EMAIL}</b><br>
                        Tel-nr: <b>{TELNR}</b><br>
                        Bericht: <br><br><b>
                        {BERICHT}</b>
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
                    <form action="index.php?id=24&action=antwoord&bid={BID}" method="post">
                        <fieldset>
                            <div class="input-control textarea">
                                <textarea name="antwoord" placeholder="Typ hier uw antwoord..."></textarea>
                            </div>
                            <input class="large primary" name="submit" type="submit" value="Verstuur e-mail">
                        </fieldset>
                    </form>

                    <!-- END BLOCK : ANTWOORD -->

                    <!-- START BLOCK : NOTIFICATIE -->
                    <br><br><br><br><br><br><br><br>
                    <h3 class="text-success text-center"><b>U heeft een e-mail verstuurd naar de gebruiker.</h3>
                    <!-- END BLOCK : NOTIFICATIE -->
                </div>
            </div>
        </div>
    </div>
</div>