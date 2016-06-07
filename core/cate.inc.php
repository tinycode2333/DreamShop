<?php
/**
 * Created by PhpStorm.
 * User: reborn36
 * Date: 2016/5/18
 * Time: 20:20
 */
//添加分类
function addCate($link){
    $arr=$_POST;
    if(insert("dream_cate",$arr, $link)){
        $mes="分类添加成功!<br/><a href='addCate.php'>继续添加</a>|<a href='listCate.php'>查看分类</a>";
    }else{
        $mes="分类添加失败！<br/><a href='addCate.php'>重新添加</a>|<a href='listCate.php'>查看分类</a>";
    }
    return $mes;
}

//根据ID得到分类信息
function getCateById($id, $link){
    $sql="select id,cName from dream_cate where id={$id}";
    return fetchOne($link, $sql);
}

//修改分类
function editCate($where, $link){
    $arr=$_POST;
    if(update($link, "dream_cate", $arr,$where)){
        $mes="分类修改成功!<br/><a href='listCate.php'>查看分类</a>";
    }else{
        $mes="分类修改失败!<br/><a href='listCate.php'>重新修改</a>";
    }
    return $mes;
}

//删除分类
function delCate($id, $link){
    $res=checkProExist($id, $link);
    if(!$res){
        $where="id=".$id;
        if(delete($link,"dream_cate",$where)){
            $mes="分类删除成功!<br/><a href='listCate.php'>查看分类</a>|<a href='addCate.php'>添加分类</a>";
        }else{
            $mes="删除失败！<br/><a href='listCate.php'>请重新操作</a>";
        }
        return $mes;
    }else{
        alertMes("不能删除分类，请先删除该分类下的商品", "listPro.php");
    }
}

//得到所有分类
function getAllCate($link){
    $sql="select id,cName from dream_cate";
    $rows=fetchAll($link, $sql);
    return $rows;
}

