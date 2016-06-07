<?php
/**
 * Created by PhpStorm.
 * User: reborn36
 * Date: 2016/6/7
 * Time: 19:39
 */

require_once '../include.php';
$id=$_REQUEST['id'];
$sql="select id,username,password,email,sex from dream_user where id='{$id}'";
$row=fetchOne($link,$sql);
?>

<!DOCTYPE>
<html>
<head>
    <meta charset="UTF-8">
    <title></title>
</head>
<body>
<h3>编辑用户</h3>
<form action="doAdminAction.php?act=editUser&id=<?php echo $id;?>" method="post" enctype="multipart/form-data">
    <table width="70%" border="1" cellpadding="5" cellspacing="0">
        <tr>
            <td align="center">用户名</td>
            <td><input type="text" name="username" placeholder="<?php echo $row['username'];?>"/></td>
        </tr>
        <tr>
            <td align="center">密码</td>
            <td><input type="password" name="password"/></td>
        </tr>
        <tr>
            <td align="center">邮箱</td>
            <td><input type="text" name="email" placeholder="<?php echo $row['email'];?>"/></td>

        </tr>
        <tr>
            <td align="center">性别</td>
            <td><input type="radio" name="sex" value="1"  <?php echo $row['sex']=="男"?"checked='checked'":null;?>/>男
                <input type="radio" name="sex" value="2" <?php echo $row['sex']=="女"?"checked='checked'":null;?>/>女
                <input type="radio" name="sex" value="3" <?php echo $row['sex']=="保密"?"checked='checked'":null;?>/>保密
            </td>
        </tr>
        <tr>
            <td colspan="2"><input type="submit"  value="编辑用户"/></td>
        </tr>

    </table>
</form>
</body>
</html>