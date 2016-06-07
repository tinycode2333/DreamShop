<?php
/**
 * Created by PhpStorm.
 * User: reborn36
 * Date: 2016/4/27
 * Time: 23:19
 */

function buildRandomString($type = 1, $length = 4 ){
    if($type == 1){
        $chars = join("",range(0,9));
    }
    elseif($type == 2){
        $chars = join("",array_merge(range('A','Z'), range('a','z')));
    }
    elseif($type == 3){
        $chars = join("",array_merge(range('A','Z'), range('a','z'), range(0,9)));
    }
    else{
        $chars = null;
    }
    if($length > strlen($chars)){
        exit("字符串长度不够");
    }
    $chars = str_shuffle($chars);
    return substr($chars, 0, $length);
}

//生成唯一字符串
//function getUniName(){
//    return md5(uniqid(microtime(true),true));
//}


function getUniName(){
    $can1 = microtime(true);
    $can2 = uniqid($can1,true);
    $can3 = md5($can2);
    return $can3;
}

//得到拓展名
//function getExt($filename){
//    return strtolower(end(explode(".",$filename)));
//}

function getExt($filename){
    $array=explode(".", $filename);
    $str=end($array);
    $extstr=strtolower($str);
    return $extstr;
}