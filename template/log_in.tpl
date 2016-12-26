<body class="metro" style="background-color: #efeae3">
<div class="container">
    <div class="wrapper">
        <div class="grid">
            <div class="row">
                <div class="span4">
                    <!-- START BLOCK : FORMULIER -->
                    <h1 class="text-center">Log in</h1>
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
                    <form action="index.php?id=5" method="post">
                        <fieldset>
                            <div class="input-control text" data-role="input-control">
                                <input name="email" type="text" placeholder="E-mail">
                                <button class="btn-clear" tabindex="-1" type="button"></button>
                            </div>
                            <div class="input-control password" data-role="input-control">
                                <input name="wachtwoord" type="password" placeholder="Wachtwoord" autofocus="">
                                <button class="btn-clear" tabindex="-1" type="button"></button>
                            </div>
                            <a href="index.php?id=26">Wachtwoord vergeten?</a>
                            <br><br>
                            <input class="large primary" name="submit" type="submit" value="Log in">
                        </fieldset>
                    </form>
                    <!-- END BLOCK : FORMULIER -->
                </div>
            </div>
        </div>
    </div>
</div>
</body>