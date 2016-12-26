<?php
$footer = new TemplatePower("template/footer.tpl");
$footer->prepare();

$header->printToScreen();
$content->printToScreen();
$footer->printToScreen();