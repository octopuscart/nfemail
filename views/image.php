<?php
ob_start();
include_once 'common.php';
include_once 'class.captcha.php';
$captcha = new Captcha();
$captcha->chars_number = 8;
$captcha->font_size = 14;
$captcha->tt_font = 'verdana.ttf';
$captcha->show_image(132, 30);
?>