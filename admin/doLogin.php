<?php
/**
 * Created by PhpStorm.
 * User: reborn36
 * Date: 2016/5/4
 * Time: 12:28
 */

require_once '../include.php';
$username = $_POST['username'];
$username = addslashes($username);
$password = md5($_POST['password']);
$verify = $_POST['verify'];
$verify1 = $_SESSION['verify'];
@$autoFlag = $_POST['autoFlag'];
if(strtoupper($verify) == strtoupper($verify1)){
    $sql = "select* from dream_admin where username='{$username}' and password='{$password}'";
    $row = checkAdmin($link, $sql);
    if($row){
        //如果选了一周内自动登陆
        if($autoFlag){
            setcookie("adminId",$row['id'],time()+7*24*3600);
            setcookie("adminName",$row['username'],time()+7*24*3600);
        }
        $_SESSION['adminName']=$row['username'];
        $_SESSION['adminId']=$row['id'];
        alertMes("登陆成功","index.php");
    }else{
        alertMes("登陆失败，无此用户","login.php");
    }
}else{
    echo $verify." ".$verify1;
    alertMes("验证码错误","login.php");
}