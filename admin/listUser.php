<?php
/**
 * Created by PhpStorm.
 * User: reborn36
 * Date: 2016/6/6
 * Time: 19:04
 */

require_once '../include.php';
//checkLogined();
@$page=$_REQUEST['page']?(int)$_REQUEST['page']:1;
$sql="select * from dream_user";
$totalRows=getResultNum($link, $sql);
$pageSize=2;
$totalPage=ceil($totalRows/$pageSize);
if($page<1||$page==null||!is_numeric($page))$page=1;
if($page>=$totalPage)$page=$totalPage;
$offset=($page-1)*$pageSize;
$sql="select id,username,email,activeFlag from dream_user order by id asc limit {$offset},{$pageSize}";
$rows=fetchAll($link, $sql);
if(!$rows){
    alertMes("sorry,没有用户,请添加!","addUser.php");
    exit;
}
?>

<!DOCTYPE>
<html>
<head>
    <meta charset="UTF-8">
    <title></title>
    <link rel="stylesheet" href="styles/backstage.css">
</head>
<body>
<div class="details">
    <div class="details_operation clearfix">
        <div class="bui_select">
            <input type="button" value="添&nbsp;&nbsp;加" class="add"  onclick="addUser()">
        </div>

    </div>
    <table class="table" cellspacing="0" cellpadding="0">
        <thead>
        <tr>
            <th width="15%">编号</th>
            <th width="20%">用户名称</th>
            <th width="20%">用户邮箱</th>
            <th width="20%">是否激活</th>
            <th>操作</th>
        </tr>
        </thead>
        <tbody>
        <?php  foreach($rows as $row):?>
            <tr>
                <td><input type="checkbox" id="c1" class="check"><label for="c1" class="label"><?php echo $row['id'];?></label></td>
                <td><?php echo $row['username'];?></td>
                <td><?php echo $row['email'];?></td>
                <td>
                    <?php
                    echo $row['activeFlag']==0?"未激活":"激活";
                    ?>
                </td>
                <td align="center"><input type="button" value="修改" class="btn" onclick="editUser(<?php echo $row['id'];?>)"><input type="button" value="删除" class="btn"  onclick="delUser(<?php echo $row['id'];?>)"></td>
            </tr>
        <?php endforeach;?>
        <?php if($totalRows>$pageSize):?>
            <tr>
                <td colspan="5"><?php echo showPage($page, $totalPage);?></td>
            </tr>
        <?php endif;?>
        </tbody>
    </table>
</div>
</body>
<script type="text/javascript">

    function addUser(){
        window.location="addUser.php";
    }
    function editUser(id){
        window.location="editUser.php?id="+id;
    }
    function delUser(id){
        if(window.confirm("您确定要删除吗？删除之后不可以恢复哦！！！")){
            window.location="doAdminAction.php?act=delUser&id="+id;
        }
    }
</script>
</html>