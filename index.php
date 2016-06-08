<?php
require_once 'include.php';
$cates = getAllcate($link);
if(!($cates && is_array($cates))) {
    echo("不好意思，网站维护中!!!");
}
?>
<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title>夢中</title>
    <link rel="stylesheet" type="text/css" href="styles/reset.css">
    <link rel="stylesheet" type="text/css" href="styles/main.css">
    <link rel="stylesheet" type="text/css" href="styles/index.css">
    <script type="text/javascript" src="scripts/roll.js"></script>
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
        <input value="提交" type="button" onclick="ssubmit();">
    </div>
</div>
<div id="main">
    <div id="content">
        <div class="banner">
            <div id="list" style="left: -800px;">
                <a href="details.php?id=29"><img src="images/banner5.jpg" alt="1"/></a>
                <a href="details.php?id=28"><img src="images/banner1.jpg" alt="1"/></a>
                <a href="details.php?id=24"><img src="images/banner2.jpg" alt="2"/></a>
                <a href="details.php?id=30"><img src="images/banner3.jpg" alt="3"/></a>
                <a href="details.php?id=31"><img src="images/banner4.jpg" alt="4"/></a>
                <a href="details.php?id=29"><img src="images/banner5.jpg" alt="5"/></a>
                <a href="details.php?id=28"><img src="images/banner1.jpg" alt="5"/></a>
            </div>
            <div id="buttons">
                <span index="1" class="on"></span>
                <span index="2"></span>
                <span index="3"></span>
                <span index="4"></span>
                <span index="5"></span>
            </div>
            <a href="javascript:;" id="prev" class="arrow">&lt;</a>
            <a href="javascript:;" id="next" class="arrow">&gt;</a>
        </div>

        <?php foreach ($cates as $cate): ?>
            <div class="shopTit comWidth">
                <span class="icon"></span>
                <h3><?php echo $cate['cName']; ?></h3>
                <a href="#" class="more">更多&gt;&gt;</a>
            </div>
            <div class="shopList comWidth clearfix">
                <div class="leftArea">
                    <div class="imgBox">
                        <a href="#"><img src="images/wolf.jpeg" alt="banner"></a>
                    </div>
                </div>
                <div class="rightArea">
                    <div class="shopList_top clearfix">
                        <?php
                        $pros = getProsByCid($cate['id'],$link);
                        if ($pros && is_array($pros)):
                            foreach ($pros as $pro):
                                $proImg = getProImgById($pro['id'],$link);
                                ?>
                                <div class="shop_item">
                                    <div class="shop_img">
                                        <a href="details.php?id=<?php echo $pro['id'];?>" target="_blank">
                                            <img height="200" width="187" src="images/image_220/<?php echo $proImg['albumPath'];?>" alt="">
                                        </a>
                                    </div>
                                    <h6><?php echo $pro['pName'];?></h6>
                                    <p><?php echo $pro['iPrice'];?>元</p>
                                </div>
                            <?php
                            endforeach;
                        endif;
                        ?>

                    </div>
                    <div class="shopList_sm clearfix">
                        <?php
                        $prosSmall = getSmallProsByCid($cate['id'],$link);
                        if ($prosSmall && is_array($prosSmall)):
                            foreach ($prosSmall as $proSmall):
                                $proSmallImg = getProImgById($proSmall['id'],$link);
                                ?>
                                <div class="shopItem_sm">
                                    <div class="shopItem_smImg">
                                        <a href="details.php?id=<?php echo $proSmall['id'];?>" target="_blank">
                                            <img  src="images/image_220/<?php echo $proSmallImg['albumPath'];?>" alt="">
                                        </a>
                                    </div>
                                    <div class="shopItem_text">
                                        <p><?php echo $proSmall['pName'];?></p>
                                        <h3>￥<?php echo $proSmall['iPrice'];?>    </h3>
                                    </div>
                                </div>
                            <?php
                            endforeach;
                        endif;
                        ?>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
        <div class="hr_25"></div>
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
