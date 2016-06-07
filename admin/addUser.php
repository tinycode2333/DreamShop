<!DOCTYPE>
<html>
<head>
    <meta charset="UTF-8">
    <title></title>
</head>
<body>
<h3>添加用户</h3>
<form action="doAdminAction.php?act=addUser" method="post" enctype="multipart/form-data">
    <table width="70%" border="1" cellpadding="5" cellspacing="0" >
        <tr>
            <td align="center">用户名</td>
            <td><input type="text" name="username" placeholder="请输入用户名称"/></td>
        </tr>
        <tr>
            <td align="center">密码</td>
            <td><input type="password" name="password" /></td>
        </tr>
        <tr>
            <td align="center">邮箱</td>
            <td><input type="text" name="email" placeholder="请输入用户邮箱"/></td>
        </tr>
        <tr>
            <td align="center">性别</td>
            <td><input type="radio" name="sex" value="0" />男
                <input type="radio" name="sex" value="1" />女
                <input type="radio" name="sex" value="2" checked="checked"/>保密
            </td>
        </tr>
        <tr>
            <td align="center">头像</td>
            <td><input type="file" name="myFile" /></td>
        </tr>
        <tr>
            <td colspan="2"><input type="submit"  value="添加用户"/></td>
        </tr>

    </table>
</form>
</body>
</html>