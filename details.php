<?php
/**
 * Created by PhpStorm.
 * User: reborn36
 * Date: 2016/6/7
 * Time: 11:55
 */

require_once 'include.php';
$id=$_REQUEST['id'];
$proInfo=getProById($id, $link);
$proImgs=getProImgsById($id, $link);
if(!($proImgs &&is_array($proImgs))){
    alertMes("商品图片错误", "index.php");
}

?>

<!DOCTYPE>
<html>
<head>
    <meta charset="UTF-8">
    <title></title>
    <link type="text/css" rel="stylesheet" href="styles/reset.css">
    <link type="text/css" rel="stylesheet" href="styles/main.css">
    <link type="text/css" rel="stylesheet" href="styles/index.css">
    <link type="text/css" rel="stylesheet" media="all" href="styles/jquery.jqzoom.css"/>
    <script src="scripts/jquery-1.6.js" type="text/javascript"></script>
    <script src="scripts/jquery.jqzoom-core.js" type="text/javascript"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('.jqzoom').jqzoom({
                zoomType: 'standard',
                lens:true,
                preloadImages: false,
                alwaysOn:false,
                title:false,
                zoomWidth:410,
                zoomHeight:410
            });
        });
    </script>
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
<div class="userPosition">
    <strong><a href="index.php">首页</a></strong>
    <span>&nbsp;&gt;&nbsp;</span>
    <a href="#"><?php echo $proInfo['cName'];?></a>
    <span>&nbsp;&gt;&nbsp;</span>
    <em><?php echo $proInfo['pSn'];?></em>
</div>
<div class="description_info ">
    <div class="description clearfix">
        <div class="leftArea">
            <div class="description_imgs">
                <div class="big">
                    <a href="images/image_800/<?php echo  $proImgs[0]['albumPath'];?>" class="jqzoom" rel='gal1'  title="triumph" >
                        <img width="350" height="300" src="images/image_350/<?php  echo $proImgs[0]['albumPath'];?>"  title="triumph">
                    </a>
                </div>
                <ul class="des_smimg clearfix" id="thumblist" >
                    <?php foreach($proImgs as $key=>$proImg):?>
                        <li>
                            <a class="<?php echo $key==0?"zoomThumbActive":"";?> active" href='javascript:void(0);' rel="{gallery: 'gal1', smallimage: 'images/image_350/<?php echo $proImg['albumPath'];?>',largeimage: 'images/image_800/<?php echo $proImg['albumPath'];?>'}">
                                <img src="images/image_50/<?php echo $proImg['albumPath'];?>" alt="">
                            </a>
                        </li>
                    <?php endforeach;?>
                </ul>
            </div>
        </div>
        <div class="rightArea" >
            <h1><?php echo $proInfo['pName'];?></h1>
            <pre><?php echo $proInfo['pDesc'];?></pre>
            <div class="divPrice">￥<?php echo $proInfo['iPrice'];?></div>
        </div>
        <button id="buy" onclick="buy2333()">买买买</button>
    </div>
</div>
<footer>
    <div class="hr_15"></div>
    <div id="foot_href">
        <span class="fl">@夢中</span>
        <span class="fr"><a href="#">Back to top</a></span>
    </div>
</footer>
</body>
<script type="text/javascript">
    var b = document.getElementById("buy");
    function buy2333() {
        b.innerHTML = "上当了吧，233333";
        b.style.width = '350px';
        b.style.backgroundColor = 'red';
    }

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
</html>