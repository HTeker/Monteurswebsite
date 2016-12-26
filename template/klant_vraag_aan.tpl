<body class="metro">
<div class="container">
    <div class="wrapper">
        <div class="grid">
            <div class="row">
                <div class="span8">
                    <!-- START BLOCK : FORMULIER -->
                    <h1 class="text-center">Afspraak aanvragen</h1>
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
                    <form action="index.php?id=13" method="post">
                        <fieldset>
                            <div class="input-control textarea">
                                <label>Beschrijf uw klacht zo gedetailleerd mogelijk:</label>
                                <textarea class="linebreaks" name="aanvraag" placeholder="Aanvraag"></textarea>
                            </div>
                            <br><br>
                            <div class="input-control text" data-role="datepicker" data-week-start="1">
                                <input name="datum" type="text" placeholder="Kies datum">
                                <span class="btn-date"></span>
                            </div>
                            <label for="radio-buttons">Selecteer een tijd</label>
                            <div name="radio-buttons" class="input-control radio default-style">
                                <label>
                                    <input name="tijdseenheid" type="radio" value="09:00 - 12:00" checked=""/>
                                    <span class="check"></span>
                                    's Ochtends (09:00u - 12:00u)
                                </label>
                            </div>
                            <div name="radio-buttons" class="input-control radio default-style">
                                <label>
                                    <input name="tijdseenheid" type="radio" value="12:00 - 15:00"/>
                                    <span class="check"></span>
                                    's Middags (12:00u - 15:00u)
                                </label>
                            </div>
                            <div name="radio-buttons" class="input-control radio default-style">
                                <label>
                                    <input name="tijdseenheid" type="radio" value="15:00 - 18:00"/>
                                    <span class="check"></span>
                                    Na middag (15:00u - 18:00u)
                                </label>
                            </div>
                            <br><br>
                            <input class="large primary" name="submit" type="submit" value="Vraag aan">
                        </fieldset>
                    </form>
                    <!-- END BLOCK : FORMULIER -->

                    <!-- START BLOCK : NOTIFICATIE -->
                    <br><br><br><br><br><br><br><br>
                    <h3 class="text-success text-center"><b>Uw aanvraag voor <strong>{DATUM}</strong> tussen <strong>{TIJDSEENHEID}</strong>
                            uur is in behandeling genomen.</h3>
                    <br><h5 class="text-info text-center">U hoort z.s.m. of een afspraak op de gewenste tijdstip mogelijk is.</h5>
                    <!-- END BLOCK : NOTIFICATIE -->
                </div>
            </div>
        </div>
    </div>
</div>
</body>