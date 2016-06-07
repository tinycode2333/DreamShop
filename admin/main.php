<!DOCTYPE>
<html>
<head>
    <meta charset="UTF-8">
    <title></title>
</head>
<body>
    <div>
        <h3>系统信息</h3>
        <table width="70%" border="1" cellpadding="5" cellspacing="1" bgcolor="#E8E8E8">
            <tr>
                <th>操作系统</th>
                <td><?php echo PHP_OS;?></td>
            </tr>
            <tr>
                <th>Mysql版本</th>
                <td><?php echo mysql_get_server_info();?></td>
            </tr>
            <tr>
                <th>PHP版本</th>
                <td><?php echo PHP_VERSION;?></td>
            </tr>
            <tr>
                <th>运行方式</th>
                <td><?php echo PHP_SAPI;?></td>
            </tr>
    </div>
</body>
</html>