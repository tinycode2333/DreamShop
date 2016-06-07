<?php
/**
 * Created by PhpStorm.
 * User: reborn36
 * Date: 2016/4/27
 * Time: 23:18
 */

require_once 'string.func.php';
//require_once '../include.php';//满满的bug 彻底被搞懵逼了。

//创建画布（GD库）
function verifyImage($type=3,$length=4,$dot=0,$line=0,$session_name = "verify")
{
    $width = 80;
    $height = 30;
    $image = imagecreatetruecolor($width, $height);
    $white = imagecolorallocate($image, 255, 255, 255);
    $black = imagecolorallocate($image, 0, 0, 0);

    //填充矩形填充画布
    imagefilledrectangle($image, 1, 1, $width - 2, $height - 2, $white);
    $chars = buildRandomString($type, $length);
    $fontfiles = array("ERASBD.TTF", "GARA.TTF", "GILLUBCD.TTF", "GILSANUB.TTF");
    $fontfile = "../fonts/" . $fontfiles[mt_rand(0, count($fontfiles) - 1)];
//    session_start();
    $_SESSION[$session_name] = $chars;
    for ($i = 0; $i < $length; $i++) {
        $size = mt_rand(14, 18);
        $angle = mt_rand(-20, 20);
        $x = 5 + $size * $i;
        $y = mt_rand(15, 20);
        $color = imagecolorallocate($image, mt_rand(0, 255), mt_rand(0, 255), mt_rand(0, 255));
        $text = substr($chars, $i, 1);
        imagettftext($image, $size, $angle, $x, $y, $color, $fontfile, $text);
    }
    //添加干扰点
    if ($dot) {
        for ($i = 0; $i < $dot; $i++) {
            imagesetpixel($image, mt_rand(0, $width - 1), mt_rand(0, $height - 1), $black);
        }
    }
    //添加干扰线
    if ($line) {
        for ($i = 1; $i < $line; $i++) {
            $color = imagecolorallocate($image, mt_rand(0, 255), mt_rand(0, 255), mt_rand(0, 255));
            imageline($image, mt_rand(0, $width - 1), mt_rand(0, $height - 1), mt_rand(0, $width - 1), mt_rand(0, $height - 1), $color);
        }
    }
    header("content-type:image/gif");
    imagegif($image);
    imagedestroy($image);
}


//缩略图
function thumb($filename,$destination=null,$dst_w=null,$dst_h=null,$isReservedSource=true,$scale=0.5){
    list($src_w,$src_h,$imagetype)=getimagesize($filename);
    if(is_null($dst_w)||is_null($dst_h)){
        $dst_w=ceil($src_w*$scale);
        $dst_h=ceil($src_h*$scale);
    }
    $mime=image_type_to_mime_type($imagetype);
    $createFun=str_replace("/", "createfrom", $mime);
    $outFun=str_replace("/", null, $mime);
    /** @var string $createFun */
    $src_image=$createFun ($filename);
    $dst_image=imagecreatetruecolor($dst_w, $dst_h);
    imagecopyresampled($dst_image, $src_image, 0,0,0,0, $dst_w, $dst_h, $src_w, $src_h);
    if($destination&&!file_exists(dirname($destination))){
        mkdir(dirname($destination),0777,true);
    }
    $dstFilename=$destination==null?getUniName().".".getExt($filename):$destination;
    /** @var string $outFun */
    $outFun($dst_image,$dstFilename);
    imagedestroy($src_image);
    imagedestroy($dst_image);
    if(!$isReservedSource){
        unlink($filename);
    }
    return $dstFilename;
}

//文字水印
function waterText($filename,$text="dream.com",$fontfile="GARA.TTF"){
    $fileInfo = getimagesize ( $filename );
    $mime = $fileInfo ['mime'];
    $createFun = str_replace ( "/", "createfrom", $mime );
    $outFun = str_replace ( "/", null, $mime );
    /** @var string $createFun */
    $image = $createFun( $filename );
    $color = imagecolorallocatealpha ( $image, 255, 0, 0, 50 );
    $fontfile = "../fonts/{$fontfile}";
    imagettftext ( $image, 14, 0, 0, 14, $color, $fontfile, $text );
    /** @var string $outFun */
    $outFun ( $image, $filename );
    imagedestroy ( $image );
}

//图片水印
/**
 * @param $dstFile
 * @param string $srcFile
 * @param int $pct
 */
function waterPic($dstFile,$srcFile="../images/logo.png",$pct=30){
    $srcFileInfo = getimagesize ( $srcFile );
    $src_w = $srcFileInfo [0];
    $src_h = $srcFileInfo [1];
    $dstFileInfo = getimagesize ( $dstFile );
    $srcMime = $srcFileInfo ['mime'];
    $dstMime = $dstFileInfo ['mime'];
    $createSrcFun = str_replace ( "/", "createfrom", $srcMime );
    $createDstFun = str_replace ( "/", "createfrom", $dstMime );
    $outDstFun = str_replace ( "/", null, $dstMime );
    /** @var string $createDstFun */
    $dst_im = $createDstFun ( $dstFile );
    /** @var string $createSrcFun */
    $src_im = $createSrcFun ( $srcFile );
    imagecopymerge ( $dst_im, $src_im, 0, 0, 0, 0, $src_w, $src_h, $pct );
//	header ( "content-type:" . $dstMime );
    /** @var string $outDstFun */
    $outDstFun ( $dst_im, $dstFile );
    imagedestroy ( $src_im );
    imagedestroy ( $dst_im );
}