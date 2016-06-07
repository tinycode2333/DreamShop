<?php
/**
 * Created by PhpStorm.
 * User: reborn36
 * Date: 2016/5/5
 * Time: 0:19
 */

require_once '../include.php';
$id=$_REQUEST['id'];
$sql="select id,username,password,email from dream_admin where id='{$id}'";
$row=fetchOne($link, $sql);

?>

<!DOCTYPE>
<html>
<head>
    <meta charset="UTF-8">
    <title></title>
</head>
<body>
<h3>编辑管理员</h3>
<form action="doAdminAction.php?act=editAdmin&id=<?php echo $id;?>" method="post">
    <table width="70%" border="1" cellpadding="5" cellspacing="0" >
        <tr>
            <td align="center">管理员名称</td>
            <td><input type="text" name="username" value="<?php echo $row['username'];?>"/></td>
        </tr>
        <tr>
            <td align="center">管理员密码</td>
            <td><input type="password" name="password"  value="<?php echo $row['password'];?>"/></td>
        </tr>
        <tr>
            <td align="center">管理员邮箱</td>
            <td><input type="text" name="email" value="<?php echo $row['email'];?>"/></td>
        </tr>
        <tr>
            <td colspan="2"><input type="submit"  value="编辑管理员"/></td>
        </tr>

    </table>
</form>
</body>
</html>