<?php
require_once 'captcha/CaptchaBuilderInterface.php';
require_once 'captcha/CaptchaBuilder.php';


// use Minho\Captcha\CaptchaBuilder;

$captch = new CaptchaBuilder();
$captch->initialize([
    'width' => 150,     // 宽度
    'height' => 50,     // 高度
    'line' => false,    // 直线
    'curve' => true,    // 曲线
    'noise' => 1,       // 噪点背景
    'fonts' => []       // 字体
]);

$captch->create();
// $captch->output(1);
$captch->save('./1.png',1);



?>
