<?php
$content = new TemplatePower("template/log_uit.tpl");
$content->prepare();

session_destroy();
header('Location: index.php');