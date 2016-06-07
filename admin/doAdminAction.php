<?php
/**
 * Created by PhpStorm.
 * User: reborn36
 * Date: 2016/5/4
 * Time: 16:03
 */

require_once '../include.php';
//checkLogined();
$act = $_REQUEST['act'];
@$id = $_REQUEST['id'];
if($act=="logout"){
    logout();
}
elseif($act=="addAdmin"){
    $mes=addAdmin($link);
}
elseif($act=="editAdmin"){
    $mes=editAdmin($id, $link);
}
elseif($act=="delAdmin"){
    $mes=delAdmin($id,$link);
}
elseif($act=="addCate"){
    $mes=addCate($link);
}
elseif($act=="editCate"){
    $where="id={$id}";
    $mes=editCate($where, $link);
}
elseif($act=="delCate"){
    $mes=delCate($id, $link);
}
elseif($act=="addPro"){
    $mes=addPro($link);
}
elseif($act=="editPro"){
    $mes=editPro($id,$link);
}
elseif($act=="delPro"){
    $mes=delPro($id,$link);
}
elseif($act=="addUser"){
    $mes=addUser($link);
}
elseif($act=="delUser"){
    $mes=delUser($id,$link);
}
elseif($act=="editUser"){
    $mes=editUser($id,$link);
}
elseif($act=="waterText"){
    $mes=doWaterText($id,$link);
}
elseif($act=="waterPic"){
    $mes=doWaterPic($id,$link);
}
?>

<!DOCTYPE>
<html>
<head>
    <meta charset="UTF-8">
    <title></title>
</head>
<body>
    <?php
        if($mes){
        echo $mes;
        }
    ?>
</body>
</html>