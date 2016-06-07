<?php
/**
 * Created by PhpStorm.
 * User: reborn36
 * Date: 2016/5/4
 * Time: 15:02
 */

//检查是否有这个用户
function checkAdmin($link, $sql){

    return fetchOne($link, $sql);
}

//检查登录
function checkLogined(){
    if(@$_SESSION['adminId'] == "" && @$_COOKIE['adminId'] == ""){
        alertMes("请先登陆","login.php");
    }
}

//注销
function logout(){
    $_SESSION = array();
    if(isset($_COOKIE[session_name()])){
        setcookie(session_name(),"",time()-1);
    }
    if(isset($_COOKIE['adminId'])){
        setcookie("adminId","",time()-1);
    }
    if(isset($_COOKIE['adminName'])){
        setcookie("adminName","",time()-1);
    }
    session_destroy();
    header("location:login.php");
}

//添加管理员
function addAdmin($link){
    $arr = $_POST;
    $arr['password']=md5($_POST['password']);
    if(insert("dream_admin", $arr, $link)){
        $mes="添加成功!<br/><a href='addAdmin.php'>继续添加</a> or <a href='listAdmin.php'>查看管理员列表</a>";
    }else{
        $mes="添加失败!<br/><a href='addAdmin.php'>重新添加</a>";
    }
    return $mes;
}

//得到所有管理员
function getAllAdmin($link){
    $sql="select id,username,email from dream_admin";
    $rows=fetchAll($link, $sql);
    return $rows;
}

function getAdminByPage($link, $page,$pageSize=2){
    $sql="select* from dream_admin";
    global $totalRows;
    $totalRows=getResultNum($link, $sql);
    global $totalPage;
    $totalPage=ceil($totalRows/$pageSize);
    if($page<1||$page==null||!is_numeric($page)){
        $page=1;
    }
    if($page>=$totalPage)$page=$totalPage;
    $offset=($page-1)*$pageSize;
    $sql="select id,username,email from dream_admin limit {$offset},{$pageSize}";
    $rows=fetchAll($link, $sql);
    return $rows;
}

//编辑管理员
function editAdmin($id, $link){
    $arr=$_POST;
    $arr['password']=md5($_POST['password']);
    if(update($link, "dream_admin", $arr,"id={$id}")){
        $mes="编辑成功!<br/><a href='listAdmin.php'>查看管理员列表</a>";
    }else{
        $mes="编辑失败!<br/><a href='listAdmin.php'>请重新修改</a>";
    }
    return $mes;
}

//删除管理员
function delAdmin($id,$link){
    if(delete($link, "dream_admin","id={$id}")){
        $mes="删除成功!<br/><a href='listAdmin.php'>查看管理员列表</a>";
    }else{
        $mes="删除失败!<br/><a href='listAdmin.php'>请重新删除</a>";
    }
    return $mes;
}


//添加用户的操作
function addUser($link){
    $arr=$_POST;
    $arr['password']=md5($_POST['password']);
    $arr['regTime']=time();
    $uploadFile=uploadFile("../uploads");
    if($uploadFile&&is_array($uploadFile)){
        $arr['face']=$uploadFile[0]['name'];
    }else{
        return "添加失败<a href='addUser.php'>重新添加</a>";
    }
    if(insert("dream_user", $arr, $link)){
        $mes="添加成功!<br/><a href='addUser.php'>继续添加</a>|<a href='listUser.php'>查看列表</a>";
    }else{
        $filename="../uploads/".$uploadFile[0]['name'];
        if(file_exists($filename)){
            unlink($filename);
        }
        $mes="添加失败!<br/><a href='arrUser.php'>重新添加</a>|<a href='listUser.php'>查看列表</a>";
    }
    return $mes;
}

//删除用户的操作
function delUser($id, $link){
    $sql="select face from dream_user where id=".$id;
    $row=fetchOne($link,$sql);
    $face=$row['face'];
    if(file_exists("../uploads/".$face)){
        unlink("../uploads/".$face);
    }
    if(delete("dream_user","id={$id}")){
        $mes="删除成功!<br/><a href='listUser.php'>查看用户列表</a>";
    }else{
        $mes="删除失败!<br/><a href='listUser.php'>请重新删除</a>";
    }
    return $mes;
}

//编辑用户的操作
function editUser($id, $link){
    $arr=$_POST;
    $arr['password']=md5($_POST['password']);
    if(update($link,"dream_user", $arr,"id={$id}")){
        $mes="编辑成功!<br/><a href='listUser.php'>查看用户列表</a>";
    }else{
        $mes="编辑失败!<br/><a href='listUser.php'>请重新修改</a>";
    }
    return $mes;
}