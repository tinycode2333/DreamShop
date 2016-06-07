<?php
/**
 * Created by PhpStorm.
 * User: reborn36
 * Date: 2016/4/27
 * Time: 23:20
 */


//连接数据库
function connect(){
    $link = mysqli_connect(DB_HOST, DB_USER, DB_PWD, DB_DBN) or die("Unable to connect!");
    mysqli_set_charset($link, CHARSET);
    return $link;
}


//插入操作
function insert($table, $array, $link){
    $keys = join(",", array_keys($array));
    $vals = "'".join("','", array_values($array))."'";
    $sql = "insert {$table}($keys) values({$vals})";
    if(mysqli_query($link, $sql)){
        return mysqli_insert_id($link);
    }
    else{
        return false;
    }
}

//更新操作
function update($link, $table, $array, $where = null){
    $str = null;
    $where =($where==null)?null:" where ".$where;
    foreach($array as $key=>$val){
        if($str == null){
            $sep = "";
        }
        else{
            $sep = ",";
        }
        $str .= $sep.$key."='".$val."'";
    }
    $sql = "update {$table} set {$str} $where";

    if(mysqli_query($link, $sql)){
        return mysqli_affected_rows($link);
    }
    else{
        return false;
    }
}

//删除操作
function delete($link, $table, $where = null){
    $where = $where==null?null:" where ".$where;
    $sql = "delete from {$table} {$where}";
    if(mysqli_query($link, $sql)){
        return mysqli_affected_rows($link);
    }
    else{
        return false;
    }
}

//得到一条记录
function fetchOne($link, $sql,$result_type=MYSQL_ASSOC){
    $result=mysqli_query($link, $sql);
    $row=mysqli_fetch_array($result,$result_type);
    return $row;
}

//得到多条记录
function fetchAll($link, $sql,$result_type=MYSQL_ASSOC){
    $result=mysqli_query($link, $sql);
    $rows = array();
    for($i = 0; @$row=mysqli_fetch_array($result,$result_type) ; $i++){
        $rows[$i]=$row;
    }
    return $rows;
}

//上一步插入的id号
function getInsertId($link){
    return mysqli_insert_id($link);
}

//结果集中的记录条数
function getResultNum($link, $sql){
    $result=mysqli_query($link,$sql);
    return mysqli_num_rows($result);
}