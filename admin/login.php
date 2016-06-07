<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>登陆</title>
    <link type="text/css" rel="stylesheet" href="styles/reset.css">
    <link type="text/css" rel="stylesheet" href="../styles/main.css">
</head>

<body>
<div class="headerBar">
    <div class="logoBar login_logo">
        <div class="logo fl">
            <a href="#"><img src="images/logo.png" alt="blue_bird"></a>
        </div>
        <h3 class="welcome_title">welcome to 夢中</h3>
    </div>
</div>


<div class="loginBackBox">
    <div class="login_cont">
        <form action="doLogin.php" method="post">
            <ul class="login">
                <li class="l_tit">管理员账户</li>
                <li class="mb_10"><input type="text" name="username" class="login_input user_icon"></li>
                <li class="l_tit">密码</li>
                <li class="mb_10"><input type="password" name="password" class="login_input "></li>
                <li class="l_tit">验证码</li>
                <li class="mb_10"><input type="text" name="verify" class="login_input "></li>
                <img src="getVerify.php" alt=""/>
                <li class="autoLogin"><input type="checkbox" id="a1" name="autoFlag" value="1" class="checked"><label for="a1">自动登陆</label></li>
                <li><input type="submit" value="" class="login_btn"></li>
            </ul>
            <div class="login_partners">
                <p class="l_tit">使用合作方账号登陆网站</p>
                <ul class="login_list clearfix">
                    <li><a href="#">QQ</a></li>
                    <li><span>|</span></li>
                    <li><a href="#">微信</a></li>
                    <li><span>|</span></li>
                    <li><a href="#">新浪微博</a></li>
                    <li><span>|</span></li>
                    <li><a href="#">百度</a></li>
                    <li><span>|</span></li>
                </ul>
            </div>
        </form>
    </div>
    <a class="reg_link" href="#"></a>
</div>


<div class="hr_45"></div>
<div class="footer">
    <p>Copyright &copy;</p>
</div>
</body>
</html>
