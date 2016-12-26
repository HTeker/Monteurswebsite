<div class="container">
    <div class="wrapper">
        <div class="grid">
            <div class="row">
                <div class="span8">

                    <!-- START BLOCK : FORMULIER -->
                    <h1 class="text-center">Neem contact op met ons!</h1>
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
                    <form method="post" action="index.php?id=2">
                        <fieldset>
                            <div class="input-control text" data-role="input-control">
                                <input type="text" name="naam" placeholder="Naam">
                                <button class="btn-clear" tabindex="-1" type="button"></button>
                            </div>
                            <div class="input-control text" data-role="input-control">
                                <input type="text" name="email" placeholder="E-mail">
                                <button class="btn-clear" tabindex="-1" type="button"></button>
                            </div>
                            <div class="input-control text" data-role="input-control">
                                <input type="text" name="telnr" placeholder="Telnr">
                                <button class="btn-clear" tabindex="-1" type="button"></button>
                            </div>
                            <div class="input-control textarea">
                                <textarea name="bericht" placeholder="Bericht"></textarea>
                            </div>
                            <input class="large primary" type="submit" name="submit" value="Verstuur">
                        </fieldset>
                    </form>
                    <!-- END BLOCK : FORMULIER -->

                    <!-- START BLOCK : NOTIFICATIE -->
                    <h3 class="text-success text-center">
                        Uw bericht is verstuurd!</h3>
                    <h5 class="text-muted text-center">U krijgt z.s.m. een antwoord toegestuurd naar <b>{EMAIL}</b>.</h5>
                    <!-- END BLOCK : NOTIFICATIE -->
                </div>
            </div>
        </div>
    </div>
</div>

