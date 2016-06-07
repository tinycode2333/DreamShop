<?php
/**
 * Created by PhpStorm.
 * User: reborn36
 * Date: 2016/6/6
 * Time: 18:40
 */

require_once 'include.php';
require_once 'core/user.inc.php';
$act=$_REQUEST['act'];
if($act==="reg"){
    $mes=reg($link);
}elseif($act==="login"){
    $mes=login($link);
}elseif($act==="userOut"){
    userOut();
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