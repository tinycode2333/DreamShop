<?php
/**
 * Created by PhpStorm.
 * User: reborn36
 * Date: 2016/4/27
 * Time: 23:21
 */

function alertMes($mes,$url){
    echo "<script> alert('{$mes}'); </script>";
    echo "<script> window.location='{$url}'; </script>";
}