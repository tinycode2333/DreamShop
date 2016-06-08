<?php
/**
 * Created by PhpStorm.
 * User: reborn36
 * Date: 2016/6/3
 * Time: 20:37
 */

function addAlbum($arr, $link){
    insert("dream_album", $arr, $link);
}

//根据商品id得到商品图片
function getProImgById($id, $link){
    $sql="select albumPath from dream_album where pid={$id} limit 1";
    $row=fetchOne($link,$sql);
    return $row;
}

//根据商品id得到所有图片

function getProImgsById($id, $link){
    $sql="select albumPath from dream_album where pid={$id} ";
    $rows=fetchAll($link,$sql);
    return $rows;
}
//文字水印的效果

function doWaterText($id, $link){
    $rows=getProImgsById($id,$link);
    foreach($rows as $row){
        $filename="../images/image_800/".$row['albumPath'];
        waterText($filename);
    }
    $mes="操作成功";
    return $mes;
}

//图片水印
function doWaterPic($id, $link){
    $rows=getProImgsById($id,$link);
    foreach($rows as $row){
        $filename="../images/image_800/".$row['albumPath'];
        waterPic($filename);
    }
    $mes="操作成功";
    return $mes;
}