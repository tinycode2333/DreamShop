<?php
/**
 * Created by PhpStorm.
 * User: reborn36
 * Date: 2016/6/5
 * Time: 15:26
 */

require_once '../include.php';
//checkLogined();
@$order = $_REQUEST['order'] ? $_REQUEST['order'] : null;
$orderBy = $order ? "order by p." . $order : null;
@$keywords = $_REQUEST['keywords'] ? $_REQUEST['keywords'] : null;
$where = $keywords ? "where p.pName like '%{$keywords}%'" : null;
//得到数据库中所有商品
$sql = "select p.id,p.pName,p.pSn,p.pNum,p.mPrice,p.iPrice,p.pDesc,p.pubTime,p.isShow,p.isHot,c.cName from dream_pro as p join dream_cate c on p.cId=c.id {$where}  ";
$totalRows = getResultNum($link, $sql);
$pageSize = 2;
$totalPage = ceil($totalRows / $pageSize);
@$page = $_REQUEST['page'] ? (int)$_REQUEST['page'] : 1;
if ($page < 1 || $page == null || !is_numeric($page)) $page = 1;
if ($page > $totalPage) $page = $totalPage;
$offset = ($page - 1) * $pageSize;
$sql = "select p.id,p.pName,p.pSn,p.pNum,p.mPrice,p.iPrice,p.pDesc,p.pubTime,p.isShow,p.isHot,c.cName from dream_pro as p join dream_cate c on p.cId=c.id {$where} {$orderBy} limit {$offset},{$pageSize}";
$rows = fetchAll($link, $sql);
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title></title>
    <link rel="stylesheet" href="styles/backstage.css">
</head>

<body>
<div id="showDetail" style="display:none;">

</div>
<div class="details">
    <div class="details_operation clearfix">
        <div class="bui_select">
            <input type="button" value="添&nbsp;&nbsp;加" class="add" onclick="addPro()">
        </div>
        <div class="fr">
            <div class="text">
                <span>商品价格：</span>

                <div class="bui_select">
                    <select id="" class="select" onchange="change(this.value)">
                        <option>-请选择-</option>
                        <option value="iPrice asc">由低到高</option>
                        <option value="iPrice desc">由高到底</option>
                    </select>
                </div>
            </div>
            <div class="text">
                <span>上架时间：</span>

                <div class="bui_select">
                    <select id="" class="select" onchange="change(this.value)">
                        <option>-请选择-</option>
                        <option value="pubTime desc">最新发布</option>
                        <option value="pubTime asc">历史发布</option>
                    </select>
                </div>
            </div>
            <div class="text">
                <span>搜索</span>
                <input type="text" value="" class="search" id="search" onkeypress="search() " onkeydown="return keyNumAll(event);">
            </div>
        </div>
    </div>
    <!--表格-->
    <table class="table" cellspacing="0" cellpadding="0">
        <thead>
        <tr>
            <th width="10%">编号</th>
            <th width="20%">商品名称</th>
            <th width="10%">商品分类</th>
            <th width="10%">是否上架</th>
            <th width="15%">上架时间</th>
            <th width="10%">价格</th>
            <th>操作</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($rows as $row): ?>
            <tr>
                <!--这里的id和for里面的c1 需要循环出来-->
                <td>
                    <input type="checkbox" id="c<?php echo $row['id']; ?>" class="check" value=<?php echo $row['id']; ?>>
                    <label for="c1" class="label"><?php echo $row['id']; ?></label>
                </td>
                <td><?php echo $row['pName']; ?></td>
                <td><?php echo $row['cName']; ?></td>
                <td>
                    <?php echo $row['isShow'] == 1 ? "上架" : "下架"; ?>
                </td>
                <td><?php echo date("Y-m-d H:i:s", $row['pubTime']); ?></td>
                <td><?php echo $row['iPrice']; ?>元</td>
                <td align="center">
                    <input type="button" value="详情" class="btn" onclick="showDetail(<?php echo $row['id']; ?>)">
                    <input type="button" value="修改" class="btn" onclick="editPro(<?php echo $row['id']; ?>)">
                    <input type="button" value="删除" class="btn" onclick="delPro(<?php echo $row['id']; ?>)">
                </td>
            </tr>
        <?php endforeach; ?>
        <?php if ($totalRows > $pageSize): ?>
            <tr>
                <td colspan="7"><?php echo showPage($page, $totalPage, "keywords={$keywords}&order={$order}"); ?></td>
            </tr>
        <?php endif; ?>
        </tbody>
    </table>
</div>
<script type="text/javascript">
    function showDetail(id) {
        window.open("../details.php?id=" + id, "_blank");
    }
    function addPro() {
        window.location = 'addPro.php';
    }
    function editPro(id) {
        window.location = 'editPro.php?id=' + id;
    }
    function delPro(id) {
        if (window.confirm("您确认要删除嘛？添加一次不易，且删且珍惜!")) {
            window.location = "doAdminAction.php?act=delPro&id=" + id;
        }
    }
    function search() {
        if (event.keyCode == 13 || event.which == 13) {
            var val = document.getElementById("search").value;
            window.location = "listPro.php?keywords=" + val;
        }
    }
    //兼容火狐&&ie
    function keyNumAll(evt){

        evt = (evt) ? evt : ((window.event) ? window.event : ""); //兼容IE和Firefox获得keyBoardEvent对象
        var key = evt.keyCode?evt.keyCode:evt.which;//兼容IE和Firefox获得keyBoardEvent对象的键值

        if(key == 13){
            var val = document.getElementById("search").value;
            window.location = "listPro.php?keywords=" + val;
        }

    }
    function change(val) {
        window.location = "listPro.php?order=" + val;
    }
</script>
</body>
</html>