<?php
/*
 * 公共函数库
 * write by tomcaroline
 * */
function sort_str($sort) //获得排序规则的字段
{
    $_sort = "";
    if(empty($sort))
        $_sort = "''";
    else
    {
        switch($sort)
        {
            case "time" : //时间排序
                $_sort = "''";break;
            case "price" : //价格排序
                $_sort = "coupin_price";break;
            case "volume" : //喜欢度排序
                $_sort = "volume";break;
            default: //默认排序
                $_sort = "''";
        }
    }
    return $_sort;
}

function getOrder($str)
{
    if(empty($str))
    {
        return "";
    }
    if($str == "up")
    {
        return " asc";
    }
    
    if($str == "down")
    {
        return " desc";
    }
    
}