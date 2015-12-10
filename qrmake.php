<?php

/**
 * 根据当前地址主机生成100x100的二维码
 * 返回相对文件名
 * 如果存在images/qr.png，直接输出该图片地址后退出
 */

if (file_exists("images/qr.png")) {
   echo urlPath(). "images/qr.png";
   exit;
}

include "qrlib.php";

$content = "http://". $_SERVER["HTTP_HOST"];
$filename = "images/". md5($content). ".png";

// 不重复生成图片
if (file_exists($filename)) {
    echo urlPath(). $filename;
    exit;
}
$errorCorrectionLevel = 'H';
// 4 means 100x100
$matrixPointSize = 4;

// generate image
QRcode::png($content, $filename, $errorCorrectionLevel, $matrixPointSize, 2);
echo urlPath(). $filename;

function urlPath() {
    return "http://". $_SERVER["HTTP_HOST"]. dirname($_SERVER["PHP_SELF"]). DIRECTORY_SEPARATOR;
}