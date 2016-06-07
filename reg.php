<!DOCTYPE>
<html>
<head>
    <meta charset="UTF-8">
    <title>注册</title>
    <link type="text/css" rel="stylesheet" href="styles/reset.css">
    <link type="text/css" rel="stylesheet" href="styles/main.css">
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
<div class="regBox">
    <div class="login_cont">
        <form method="post" enctype="multipart/form-data" action="doAction.php?act=reg">
            <ul class="reg">
                <li><span class="reg_item"><i>*</i>用户名：</span>

                    <div class="input_item"><input type="text" name="username" placeholder="请输入用户名"
                                                   class="login_input user_icon" required="required"></div>
                </li>
                <li><span class="reg_item"><i>*</i>密码：</span>

                    <div class="input_item"><input type="password" name="password" class="login_input " required="required"></div>
                </li>
                <li><span class="reg_item"><i>*</i>邮箱：</span>

                    <div class="input_item"><input type="email" name="email" placeholder="请输入合法邮箱" class="login_input " required="required"></div>
                </li>
                <li><span class="reg_item"><i>*</i>性别：</span>

                    <div class="input_item">
                        <input type="radio" name="sex" value="1"> 男&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <input type="radio" name="sex" value="2"> 女&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <input type="radio" name="sex" value="3" checked="checked"> 保密
                    </div>
                </li>
                <li><span class="reg_item"><i>*</i>头像：</span>

                    <div class="input_item"><input type="file" name="myFace"></div>
                </li>
                <li class="autoLogin"><span class="reg_item">&nbsp;</span>
                    <input type="checkbox" id="t1" class="checked">
                    <label for="t1">我同意霸王条款</label>
                </li>
                <li><span class="reg_item">&nbsp;</span>
                    <button>注册</button>
                </li>
            </ul>
        </form>
    </div>
</div>
<div class="hr_45"></div>
<div class="footer">
    <p>Copyright &copy;</p>
</div>
</body>
</html>