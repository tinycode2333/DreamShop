<?php
/**
 * Created by PhpStorm.
 * User: reborn36
 * Date: 2016/5/18
 * Time: 20:52
 */
require_once '../include.php';
$id=$_REQUEST['id'];
$row=getCateById($id, $link);
?>

<!DOCTYPE>
<html>
<head>
    <meta charset="UTF-8">
    <title></title>
</head>
<body>
<h3>修改分类</h3>
<form action="doAdminAction.php?act=editCate&id=<?php echo $id;?>" method="post">
    <table width="70%" border="1" cellpadding="5" cellspacing="0" >
        <tr>
            <td align="center">分类名称</td>
            <td><input type="text" name="cName" placeholder="<?php echo $row['cName'];?>"/></td>
        </tr>
        <tr>
            <td colspan="2"><input type="submit"  value="修改分类"/></td>
        </tr>
    </table>
</form>
</body>
</html>