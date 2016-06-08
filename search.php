<?php
/**
 * Created by PhpStorm.
 * User: reborn36
* Date: 2016/6/7
* Time: 22:39
*/

require_once 'include.php';
@$keywords = $_REQUEST['keywords'] ? $_REQUEST['keywords'] : null;
$where = $keywords ? "where p.pName like '%{$keywords}%'" : null;
$sql = "select p.id,p.pName,p.pSn,p.pNum,p.mPrice,p.iPrice,p.pDesc,p.pubTime,p.isShow,p.isHot,c.cName from dream_pro as p join dream_cate c on p.cId=c.id {$where}  ";
$pros = fetchAll($link, $sql);

?>

<!DOCTYPE>
<html>
<head>
    <meta charset="UTF-8">
    <title></title>
    <link rel="stylesheet" type="text/css" href="styles/search.css">
    <link rel="stylesheet" type="text/css" href="styles/reset.css">
    <link rel="stylesheet" type="text/css" href="styles/index.css">
</head>
<body>
<header>
    <a href="index.php" class="fl"><img id="logo" src="images/logo.png"></a>

    <h1 class="fl">夢中</h1>
    <?php if(@$_SESSION['loginFlag']):?>
        <div>
            <span>欢迎您:</span><?php echo @$_SESSION['username'];?>
            <a href="doAction.php?act=userOut">[退出]</a>
        </div>

    <?php else:?>
        <button onclick="window.location.href='reg.php'" class="fr">&nbsp;&nbsp;&nbsp;注&nbsp;册&nbsp;&nbsp;&nbsp;</button>
        <button onclick="window.location.href='login.php'" class="fr">&nbsp;&nbsp;&nbsp;登&nbsp;陆&nbsp;&nbsp;&nbsp;</button>
    <?php endif;?>
</header>
<div id="search_pro">
    <div>
        <input id="se" onkeydown="return keyNumAll(event);">
        <input value="提交" type="button" onclick="ssubmit()">
    </div>
</div>
<div id="content">
<div id="search_main">
    <?php foreach ($pros as $pro):
        $proImg = getProImgById($pro['id'],$link);?>
        <div>
            <a href="details.php?id=<?php echo $pro['id'];?>" target="_blank">
                <img  src="images/image_350/<?php echo $proImg['albumPath'];?>" alt="">
            </a>
            <h4><?php echo $pro['pName'];?></h4>
            <p><?php echo $pro['iPrice'];?>元</p>
        </div>
    <?php endforeach; ?>
</div>
</div>
<footer>
    <div id="contact">
        <span>联系我们</span>

        <p>为了更好地获取我们的最新产品咨询，您可以留下您的产品邮箱快速订阅我们的产品咨询<br/>
            也可以通过以下方式关注我们的动态</p>

        <div>
            <input type="email">
            <input value="提交" type="button">
        </div>
        <img src="images/qq.png">
        <img src="images/weibo.png">
        <img src="images/tw.png">
        <img src="images/world.png">
    </div>
    <div id="foot_href">
        <span class="fl">@夢中</span>
        <span class="fr"><a href="#">Back to top</a></span>
    </div>
</footer>
<script type="text/javascript">
    function keyNumAll(evt){
        evt = (evt) ? evt : ((window.event) ? window.event : ""); //兼容IE和Firefox获得keyBoardEvent对象
        var key = evt.keyCode?evt.keyCode:evt.which;//兼容IE和Firefox获得keyBoardEvent对象的键值
        if(key == 13){
            var val = document.getElementById("se").value;
            window.location = "search.php?keywords=" + val;
        }
    }

    function ssubmit(){
        var val = document.getElementById("se").value;
        window.location = "search.php?keywords=" + val;

    }
</script>
</body>
</html>