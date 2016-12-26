<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="product" content="Metro UI CSS Framework">
    <meta name="description" content="Simple responsive css framework">
    <meta name="author" content="Sergey S. Pimenov, Ukraine, Kiev">

    <link href="template/css/iconFont.css" rel="stylesheet">
    <link href="template/css/iconFont.min.css" rel="stylesheet">
    <link href="template/css/metro-bootstrap.css" rel="stylesheet">
    <link href="template/css/metro-bootstrap-responsive.css" rel="stylesheet">
    <link href="template/css/docs.css" rel="stylesheet">
    <link href="template/css/prettify.css" rel="stylesheet">

    <script src="template/js/metro.min.js"></script>
    <script src="template/js/jquery.min.js"></script>
    <script src="template/js/jquery.widget.min.js"></script>
    <script src="template/js/jquery.mousewheel.js"></script>
    <script src="template/js/prettify.js"></script>
    <script src="template/js/load-metro.js"></script>
    <script src="template/js/docs.js"></script>
    <script src="template/js/github.info.js"></script>
    <script src="template/js/metro-calendar.js"></script>
    <script src="template/js/metro-datepicker.js"></script>

    <link href="template/css/metro-bootstrap.css" rel="stylesheet">
    <script src="template/js/jquery.min.js"></script>
    <script src="template/js/jquery.widget.min.js"></script>
    <script src="template/js/metro.min.js"></script>

    <script type="text/javascript" src="template\js/tinymce/tinymce.min.js"></script>
    <script type="text/javascript">

tinymce.init({
    selector: "textarea",
    theme: "modern",
    skin: 'light'
});
    </script>

    <title>MIJN KETEL DOET HET NIET</title>
</head>
<body class="metro" style="background-color: #A1CAF1">

<!-- DIT IS OM DE FOOTER TE PUSHEN -->
<div id="wrap">
<div id="main">

<!-- START BLOCK : BEZOEKER_NAVIGATIE -->
<nav class="navigation-bar">
    <nav class="navigation-bar-content">
        <a href="index.php" class="element"><span class="icon-tools"></span> MIJN KETEL DOET HET NIET.NL</a>
        <span class="element-divider"></span>

        <a class="pull-menu" href="#"></a>
        <ul class="element-menu" style="display: block;">
            <li>
                <a class="element" href="index.php?id=2">Contact</a>
            </li>
            <span class="element-divider"></span>
            <li>
                <a class="element" href="index.php?id=3">Prijzen</a>
            </li>
            <span class="element-divider"></span>
            <li>
                <a class="element" href="index.php?id=4">Maak een afspraak</a>
            </li>
            <span class="element-divider"></span>
            <!-- NO-DESKTOP -->
            <span class="element-divider no-desktop"></span>
            <li class="no-desktop">
                <a class="element" href="index.php?id=5">Log in</a>
            </li>
            <!-- END NO-DESKTOP -->
            <!-- NO PHONE/TABLET-PORTRAIT -->
            <a title="Log in" class="element no-phone no-tablet-portrait place-right" href="index.php?id=5"><span class="icon-key"></span></a>
            <span class="element-divider place-right"></span>
            <!-- END NO PHONE/TABLET-PORTRAIT -->
        </ul>
    </nav>
</nav>
<!-- END BLOCK : BEZOEKER_NAVIGATIE -->

<!-- START BLOCK : KLANT_NAVIGATIE -->
<div class="navigation-bar">
    <div class="navigation-bar-content">
        <a href="index.php" class="element"><span class="icon-tools"></span> MIJN KETEL DOET HET NIET.NL</a>
        <span class="element-divider"></span>

        <a class="pull-menu" href="#"></a>
        <ul class="element-menu" style="display: block;">
            <li>
                <a class="element" href="index.php?id=9">Contact</a>
            </li>
            <span class="element-divider"></span>
            <li>
                <a class="element" href="index.php?id=3">Prijzen</a>
            </li>
            <span class="element-divider"></span>
            <li>
                <a class="element" href="index.php?id=10">Facturen bekijken</a>
            </li>
            <span class="element-divider"></span>
            <li>
                <a class="dropdown-toggle" href="#">Afspraken</a>
                <ul class="dropdown-menu" data-role="dropdown">
                    <li><a href="index.php?id=11">Bekijk uw aanvragen</a></li>
                    <li class="divider"></li>
                    <li><a href="index.php?id=12">Bekijk uw afspraken</a></li>
                    <li class="divider"></li>
                    <li><a href="index.php?id=13">Maak een afspraak</a></li>
                </ul>
            </li>

            <!-- NO-DESKTOP -->
            <span class="element-divider no-desktop"></span>
            <li class="no-desktop">
                <a class="element " href="index.php?id=8">Account gegevens wijzigen</a>
            </li>
            <span class="element-divider no-desktop"></span>
            <li class="no-desktop">
                <a class="element " href="index.php?id=7">Uitloggen</a>
            </li>
            <!-- END NO-DESKTOP -->

            <!-- NO PHONE/TABLET-PORTRAIT -->
            <span class="element-divider"></span>
            <a title="Log uit" class="element place-right no-phone no-tablet-portrait" href="index.php?id=7"><span class="icon-locked-2"></span></a>

            <span class="element-divider place-right"></span>
            <div class="element place-right no-phone no-tablet-portrait">
                <a class="dropdown-toggle" href="#">
                    <span class="icon-cog"></span>
                </a>
                <ul class="dropdown-menu place-right" data-role="dropdown">
                    <li><a href="index.php?id=8">Account gegevens wijzigen</a></li>
                </ul>
            </div>


            <span class="element-divider place-right no-phone no-tablet"></span>
            <span class="element place-right no-phone no-tablet-portrait">
                Welkom <b>{NAAM} {TUSSENVOEGSEL} {ACHTERNAAM}!</b>
            </span>
            <span class="element-divider place-right no-phone no-tablet-portrait"></span>
            <!-- END NO PHONE/TABLET-PORTRAIT -->
        </ul>

    </div>
</div>
<!-- END BLOCK : KLANT_NAVIGATIE -->

<!-- START BLOCK : MONTEUR_NAVIGATIE -->
<div class="navigation-bar">
    <div class="navigation-bar-content">
        <a href="index.php" class="element"><span class="icon-tools"></span> MIJN KETEL DOET HET NIET.NL</a>
        <span class="element-divider"></span>

        <a class="pull-menu" href="#"></a>
        <ul class="element-menu" style="display: block;">
            <li>
                <a class="element" href="index.php?id=9">Contact</a>
            </li>
            <span class="element-divider"></span>
            <li>
                <a class="element" href="index.php?id=3">Prijzen</a>
            </li>
            <span class="element-divider"></span>
            <li>
                <a class="dropdown-toggle" href="#">Facturen</a>
                <ul class="dropdown-menu" data-role="dropdown">
                    <li><a href="index.php?id=14">Facturen bekijken</a></li>
                    <li class="divider"></li>
                    <li><a href="index.php?id=15">Factuur maken</a></li>
                </ul>
            </li>
            <span class="element-divider"></span>
            <li>
                <a class="dropdown-toggle" href="#">Afspraken</a>
                <ul class="dropdown-menu" data-role="dropdown">
                    <li><a href="index.php?id=16">Bekijk afspraken</a></li>
                    <li class="divider"></li>
                    <li><a href="index.php?id=17">Bekijk afgeronde afspraken</a></li>
                </ul>
            </li>

            <!-- NO-DESKTOP -->
            <span class="element-divider no-desktop"></span>
            <li class="no-desktop">
                <a class="element " href="index.php?id=8">Account gegevens wijzigen</a>
            </li>
            <span class="element-divider no-desktop"></span>
            <li class="no-desktop">
                <a class="element " href="7">Uitloggen</a>
            </li>
            <!-- END NO-DESKTOP -->

            <!-- NO PHONE/TABLET-PORTRAIT -->
            <span class="element-divider"></span>
            <a title="Log uit" class="element place-right no-phone no-tablet-portrait" href="index.php?id=7"><span class="icon-locked-2"></span></a>

            <span class="element-divider place-right"></span>
            <div class="element place-right no-phone no-tablet-portrait">
                <a class="dropdown-toggle" href="#">
                    <span class="icon-cog"></span>
                </a>
                <ul class="dropdown-menu place-right" data-role="dropdown">
                    <li><a href="index.php?id=8">Account gegevens wijzigen</a></li>
                </ul>
            </div>


            <span class="element-divider place-right"></span>
                    <span class="element place-right no-phone no-tablet-portrait">
                        Welkom <b>{NAAM} {TUSSENVOEGSEL} {ACHTERNAAM}!</b>
                    </span>
            <span class="element-divider place-right"></span>
            <!-- END NO PHONE/TABLET-PORTRAIT -->
        </ul>

    </div>
</div>
<!-- END BLOCK : MONTEUR_NAVIGATIE -->

<!-- START BLOCK : ADMIN_NAVIGATIE -->
<div class="navigation-bar">
    <div class="navigation-bar-content">
        <a href="index.php" class="element"><span class="icon-tools"></span> MIJN KETEL DOET HET NIET.NL</a>
        <span class="element-divider"></span>

        <a class="pull-menu" href="#"></a>
        <ul class="element-menu" style="display: block;">
            <li>
                <a class="element" href="index.php?id=9">Contact</a>
            </li>
            <span class="element-divider"></span>
            <li>
                <a class="element" href="index.php?id=3">Prijzen</a>
            </li>
            <span class="element-divider"></span>
            <li>
                <a class="element" href="index.php?id=18">Facturen bekijken</a>
            </li>
            <span class="element-divider"></span>
            <li>
                <a class="dropdown-toggle" href="#">Monteurs</a>
                <ul class="dropdown-menu" data-role="dropdown">
                    <li><a href="index.php?id=19">Bekijken</a></li>
                    <li><a href="index.php?id=20">Toevoegen</a></li>
                </ul>
            </li>
            <span class="element-divider"></span>
            <li>
                <a class="dropdown-toggle" href="#">Afspraken</a>
                <ul class="dropdown-menu" data-role="dropdown">
                    <li><a href="index.php?id=21">Bekijk overzicht aanvragen</a></li>
                    <li class="divider"></li>
                    <li><a href="index.php?id=22">Afspraken bekijken</a></li>
                    <li class="divider"></li>
                    <li><a href="index.php?id=23">Afgeronde afspraken bekijken</a></li>
                    <li class="divider"></li>
                </ul>
            </li>
            <span class="element-divider"></span>
            <li>
                <a class="element" href="index.php?id=24">Berichten {BERICHTEN}</a>
            </li>
            <span class="element-divider"></span>
            <div class="element input-element">
                <form method="post" action="index.php?id=25">
                    <div class="input-control text no-phone no-tablet" style="width: 110%">
                        <input type="text" name="zoekopdracht" placeholder="Klant zoeken...">
                        <button class="btn-search" name="submit"></button>
                    </div>
                </form>
                <form method="post" action="index.php?id=25">
                    <div class="input-control text no-desktop" style="width: 100%">
                        <input type="text" name="zoekopdracht" placeholder="Klant zoeken op id, naam of achternaam">
                        <button class="btn-search" name="submit"></button>
                    </div>
                </form>
            </div>

            <!-- NO-DESKTOP -->
            <span class="element-divider no-desktop"></span>
            <li class="no-desktop">
                <a class="element " href="index.php?id=8">Account gegevens wijzigen</a>
            </li>
            <span class="element-divider no-desktop"></span>
            <li class="no-desktop">
                <a class="element " href="7">Uitloggen</a>
            </li>
            <!-- END NO-DESKTOP -->

            <!-- NO PHONE/TABLET-PORTRAIT -->
            <a title="Log uit" class="element place-right no-phone no-tablet-portrait" href="index.php?id=7"><span class="icon-locked-2"></span></a>

            <span class="element-divider place-right"></span>
            <div class="element place-right no-phone no-tablet-portrait">
                <a class="dropdown-toggle" href="#">
                    <span class="icon-cog"></span>
                </a>
                <ul class="dropdown-menu place-right" data-role="dropdown">
                    <li><a href="index.php?id=8">Account gegevens wijzigen</a></li>
                </ul>
            </div>
            <!-- END NO PHONE/TABLET-PORTRAIT -->
            <!-- NO PHONE/TABLET -->
            <span class="element-divider place-right"></span>
                    <span class="element place-right no-tablet">
                        Welkom <b>{NAAM} {TUSSENVOEGSEL} {ACHTERNAAM}!</b>
                    </span>
            <span class="element-divider place-right"></span>
            <!-- END NO PHONE/TABLET -->
        </ul>
    </div>
</div>
<!-- END BLOCK : ADMIN_NAVIGATIE -->

</body>
</html>