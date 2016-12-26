<body class="metro" style="background-color: #efeae3">
<div class="container">
    <div class="wrapper">
        <div class="grid">
            <div class="row">
                <div class="span6">
                    <!-- START BLOCK : FORMULIER -->
                    <h1 class="text-center">Factuur aanmaken</h1>
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

                    <form action="index.php?id=15" method="post">
                        <fieldset>
                            <div class="input-control text" data-role="input-control">
                                <input name="afspraak-ID" type="text" placeholder="Afspraak-ID">
                                <button class="btn-clear" tabindex="-1" type="button"></button>
                            </div>
                            <label>Prijs:</label>
                            <div class="input-control text size2" data-role="input-control">
                                <input name="prijs" type="text" placeholder="00" maxlength="6">
                                <button class="btn-clear" tabindex="-1" type="button"></button>
                            </div>
                            <span>,</span>
                            <div class="input-control text size1" data-role="input-control">
                                <input name="prijs_decimaal" type="text" placeholder="00" maxlength="2">
                                <button class="btn-clear" tabindex="-1" type="button"></button>
                            </div>
                            <label>Vul eventueel een korting in:</label>
                            <div class="input-control text size2" data-role="input-control">
                                <input name="korting" type="text" placeholder="00" maxlength="6">
                                <button class="btn-clear" tabindex="-1" type="button"></button>
                            </div>
                            <span>,</span>
                            <div class="input-control text size1" data-role="input-control">
                                <input name="korting_decimaal" type="text" placeholder="00" maxlength="2">
                                <button class="btn-clear" tabindex="-1" type="button"></button>
                            </div>
                            <br><br>
                            <input class="large primary" name="submit" type="submit" value="Maak factuur">
                        </fieldset>
                    </form>
                    <!-- END BLOCK : FORMULIER -->

                    <!-- START BLOCK : FACTUUR_GEMAAKT -->
                    <br><br><br><br><br><br><br><br>
                    <h3 class="text-center"><b>De factuur is aangemaakt.</h3>
                    <!-- END BLOCK : FACTUUR_GEMAAKT -->
                </div>
            </div>
        </div>
    </div>
</div>
</body>