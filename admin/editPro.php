<?php
/**
 * Created by PhpStorm.
 * User: reborn36
 * Date: 2016/6/5
 * Time: 18:15
 */

require_once '../include.php';
//checkLogined();
$rows=getAllCate($link);
if(!$rows){
    alertMes("没有相应分类，请先添加分类!!", "addCate.php");
}
$id=$_REQUEST['id'];
$proInfo=getProById($id,$link);
?>

<!DOCTYPE>
<html>
<head>
    <meta charset="UTF-8">
    <title></title>
    <link href="./styles/global.css"  rel="stylesheet"  type="text/css" media="all" />
</head>
<body>
<h3>添加商品</h3>
<form action="doAdminAction.php?act=editPro&id=<?php echo $id;?>" method="post" enctype="multipart/form-data">
    <table width="70%"  border="1" cellpadding="5" cellspacing="0" bgcolor="#cccccc">
        <tr>
            <td align="right">商品名称</td>
            <td><input type="text" name="pName"  value="<?php echo $proInfo['pName'];?>"/></td>
        </tr>
        <tr>
            <td align="right">商品分类</td>
            <td>
                <select name="cId">
                    <?php foreach($rows as $row):?>
                        <option value="<?php echo $row['id'];?>" <?php echo $row['id']==$proInfo['cId']?"selected='selected'":null;?>><?php echo $row['cName'];?></option>
                    <?php endforeach;?>
                </select>
            </td>
        </tr>
        <tr>
            <td align="right">商品货号</td>
            <td><input type="text" name="pSn"  value="<?php echo $proInfo['pSn'];?>"/></td>
        </tr>
        <tr>
            <td align="right">商品数量</td>
            <td><input type="text" name="pNum"  value="<?php echo $proInfo['pNum'];?>"/></td>
        </tr>
        <tr>
            <td align="right">商品原价</td>
            <td><input type="text" name="mPrice"  value="<?php echo $proInfo['mPrice'];?>"/></td>
        </tr>
        <tr>
            <td align="right">会员价格</td>
            <td><input type="text" name="iPrice"  value="<?php echo $proInfo['iPrice'];?>"/></td>
        </tr>
        <tr>
            <td align="right">商品描述</td>
            <td>
                <textarea name="pDesc" id="editor_id" style="width:100%;height:150px;"><?php echo $proInfo['pDesc'];?></textarea>
            </td>
        </tr>
        <tr>
            <td colspan="2"><input type="submit"  value="编辑商品"/></td>
        </tr>
    </table>
</form>
</body>
</html>