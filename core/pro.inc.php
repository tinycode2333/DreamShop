<?php
/**
 * Created by PhpStorm.
 * User: reborn36
 * Date: 2016/6/3
 * Time: 20:18
 */


function addPro($link){
    $arr=$_POST;
    $arr['pubTime']=time();
    $path="./uploads";
    $uploadFiles=uploadFile($path);
    if(is_array($uploadFiles)&&$uploadFiles){
        foreach($uploadFiles as $key=>$uploadFile){
            thumb($path."/".$uploadFile['name'],"../images/image_50/".$uploadFile['name'],50,50);
            thumb($path."/".$uploadFile['name'],"../images/image_220/".$uploadFile['name'],220,220);
            thumb($path."/".$uploadFile['name'],"../images/image_350/".$uploadFile['name'],350,350);
            thumb($path."/".$uploadFile['name'],"../images/image_800/".$uploadFile['name'],800,800);
        }
    }
    $res=insert("dream_pro",$arr, $link);
    $pid=getInsertId($link);

    if($res&&$pid){
        foreach($uploadFiles as $uploadFile){
            $arr1['pid']=$pid;
            $arr1['albumPath']=$uploadFile['name'];
            addAlbum($arr1,$link);
        }
        $mes="<p>添加成功!</p><a href='addPro.php' target='mainFrame'>继续添加</a>|<a href='listPro.php' target='mainFrame'>查看商品列表</a>";
    }else{
        if(is_array($uploadFiles)&&$uploadFiles) {
            foreach ($uploadFiles as $uploadFile) {
                if (file_exists("../images/image_800/" . $uploadFile['name'])) {
                    unlink("../images/image_800/" . $uploadFile['name']);
                }
                if (file_exists("../images/image_50/" . $uploadFile['name'])) {
                    unlink("../images/image_50/" . $uploadFile['name']);
                }
                if (file_exists("../images/image_220/" . $uploadFile['name'])) {
                    unlink("../images/image_220/" . $uploadFile['name']);
                }
                if (file_exists("../images/image_350/" . $uploadFile['name'])) {
                    unlink("../images/image_350/" . $uploadFile['name']);
                }
            }
        }
        $mes="<p>添加失败!</p><a href='addPro.php' target='mainFrame'>重新添加</a>";

    }
    return $mes;
}

//编辑商品
function editPro($id, $link){
    $arr=$_POST;
    $path="./uploads";
    $uploadFiles=uploadFile($path);
    if(is_array($uploadFiles)&&$uploadFiles){
        foreach($uploadFiles as $key=>$uploadFile){
            thumb($path."/".$uploadFile['name'],"../images/image_50/".$uploadFile['name'],50,50);
            thumb($path."/".$uploadFile['name'],"../images/image_220/".$uploadFile['name'],220,220);
            thumb($path."/".$uploadFile['name'],"../images/image_350/".$uploadFile['name'],350,350);
            thumb($path."/".$uploadFile['name'],"../images/image_800/".$uploadFile['name'],800,800);
        }
    }
    $where="id={$id}";
    $res=update($link,"dream_pro",$arr,$where);
    $pid=$id;
    if($res&&$pid){
        if($uploadFiles &&is_array($uploadFiles)){
            foreach($uploadFiles as $uploadFile){
                $arr1['pid']=$pid;
                $arr1['albumPath']=$uploadFile['name'];
                addAlbum($arr1,$link);
            }
        }
        $mes="<p>编辑成功!</p><a href='listPro.php' target='mainFrame'>查看商品列表</a>";
    }else{
        if(is_array($uploadFiles)&&$uploadFiles){
            foreach($uploadFiles as $uploadFile){
                if(file_exists("../images/image_800/".$uploadFile['name'])){
                    unlink("../images/image_800/".$uploadFile['name']);
                }
                if(file_exists("../images/image_50/".$uploadFile['name'])){
                    unlink("../images/image_50/".$uploadFile['name']);
                }
                if(file_exists("../images/image_220/".$uploadFile['name'])){
                    unlink("../images/image_220/".$uploadFile['name']);
                }
                if(file_exists("../images/image_350/".$uploadFile['name'])){
                    unlink("../images/image_350/".$uploadFile['name']);
                }
            }
        }
        $mes="<p>编辑失败!</p><a href='listPro.php' target='mainFrame'>重新编辑</a>";

    }
    return $mes;
}

function delPro($id, $link){
    $where="id=$id";
    $res=delete($link,"dream_pro",$where);
    $proImgs=getAllImgByProId($id, $link);
    if($proImgs&&is_array($proImgs)){
        foreach($proImgs as $proImg){
            if(file_exists("uploads/".$proImg['albumPath'])){
                unlink("uploads/".$proImg['albumPath']);
            }
            if(file_exists("../images/image_50/".$proImg['albumPath'])){
                unlink("../images/image_50/".$proImg['albumPath']);
            }
            if(file_exists("../images/image_220/".$proImg['albumPath'])){
                unlink("../images/image_220/".$proImg['albumPath']);
            }
            if(file_exists("../images/image_350/".$proImg['albumPath'])){
                unlink("../images/image_350/".$proImg['albumPath']);
            }
            if(file_exists("../images/image_800/".$proImg['albumPath'])){
                unlink("../images/image_800/".$proImg['albumPath']);
            }

        }
    }
    $where1="pid={$id}";
    $res1=delete($link,"dream_album",$where1);
    if($res&&$res1){
        $mes="删除成功!<br/><a href='listPro.php' target='mainFrame'>查看商品列表</a>";
    }else{
        $mes="删除失败!<br/><a href='listPro.php' target='mainFrame'>重新删除</a>";
    }
    return $mes;
}


//得到商品的所有信息
function getAllProByAdmin($link){
    $sql="select p.id,p.pName,p.pSn,p.pNum,p.mPrice,p.iPrice,p.pDesc,p.pubTime,p.isShow,p.isHot,c.cName from dream_pro as p join dream_cate c on p.cId=c.id";
    $rows=fetchAll($link,$sql);
    return $rows;
}

//根据商品id得到商品图片
function getAllImgByProId($id,$link){
    $sql="select a.albumPath from dream_album  a where pid={$id}";
    $rows=fetchAll($link,$sql);
    return $rows;
}

// 根据id得到商品的详细信息
function getProById($id, $link){
    $sql="select p.id,p.pName,p.pSn,p.pNum,p.mPrice,p.iPrice,p.pDesc,p.pubTime,p.isShow,p.isHot,c.cName,p.cId from dream_pro as p join dream_cate c on p.cId=c.id where p.id={$id}";
    $row=fetchOne($link, $sql);
    return $row;
}
//检查分类下是否有产品
function checkProExist($cid, $link){
    $sql="select * from dream_pro where cId={$cid}";
    $rows=fetchAll($link,$sql);
    return $rows;
}

//得到所有商品
function getAllPros($link){
    $sql="select p.id,p.pName,p.pSn,p.pNum,p.mPrice,p.iPrice,p.pDesc,p.pubTime,p.isShow,p.isHot,c.cName,p.cId from dream_pro as p join dream_cate c on p.cId=c.id ";
    $rows=fetchAll($link,$sql);
    return $rows;
}

//根据cid得到4条产品
function getProsByCid($cid, $link){
    $sql="select p.id,p.pName,p.pSn,p.pNum,p.mPrice,p.iPrice,p.pDesc,p.pubTime,p.isShow,p.isHot,c.cName,p.cId from dream_pro as p join dream_cate c on p.cId=c.id where p.cId={$cid} limit 4";
    $rows=fetchAll($link,$sql);
    return $rows;
}

//得到下4条产品
function getSmallProsByCid($cid, $link){
    $sql="select p.id,p.pName,p.pSn,p.pNum,p.mPrice,p.iPrice,p.pDesc,p.pubTime,p.isShow,p.isHot,c.cName,p.cId from dream_pro as p join dream_cate c on p.cId=c.id where p.cId={$cid} limit 4,4";
    $rows=fetchAll($link,$sql);
    return $rows;
}

//得到商品ID和商品名称
function getProInfo($link){
    $sql="select id,pName from dream_pro order by id asc";
    $rows=fetchAll($link,$sql);
    return $rows;
}
