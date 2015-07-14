<?php
$get = $G->G(); //获得过滤特殊字符后的$_GET数组
$product = trim($get['product']); //获得请求数据表
$numRequests = trim($get['numRequests']); //获得第几次请求
$numPerpage = trim($get['numPerpage']); //获得请求个数
$Sorting = trim($get['Sorting']); //排序方式
$cate_id = trim($get['cate_id']); //分类ID
$search = trim($get['search']); //分类ID
$orig_id = trim($get['orig_id']);
$orderby = trim($get['orderby']); //排序规则

$real_sort = sort_str($Sorting);
//echo $real_sort;

$orderby = getOrder($orderby);

if(empty($product))
{
    $product = "items";
}

if(empty($numRequests))
{
    $numRequests = 0;
}

if(empty($numPerpage))
{
    $numPerpage = 10;
}
if(empty($numPerpage))
    $start = $numRequests * 10;
else
    $start = $numRequests * $numPerpage;
if(empty($cate_id))
{
    if(!empty($orig_id))
    {
        $sql_items = "SELECT id,title,pic_url,item_url,shop_type,price,coupon_price,volume,coupon_rate,ems FROM ftxia_".$product." WHERE orig_id=".$orig_id." ORDER BY ".$real_sort.$orderby." LIMIT ".$start.",".$numPerpage;
    }
    else
    {
        if(empty($search))
        {
            $sql_items = "SELECT id,title,pic_url,item_url,shop_type,price,coupon_price,volume,coupon_rate,ems FROM ftxia_".$product." ORDER BY ".$real_sort.$orderby." LIMIT ".$start.",".$numPerpage;
        }
        else
        {
            $sql_items = "SELECT id,title,pic_url,item_url,shop_type,price,coupon_price,volume,coupon_rate,ems FROM ftxia_".$product." WHERE title LIKE '%".$search."%'"." ORDER BY ".$real_sort.$orderby." LIMIT ".$start.",10";
        }
    }

}
else
{
    $sql_items = "SELECT id,title,pic_url,item_url,shop_type,price,coupon_price,volume,coupon_rate,ems FROM ftxia_".$product." WHERE cate_id=".$cate_id." ORDER BY ".$real_sort.$orderby." LIMIT ".$start.",".$numPerpage;
}
//echo $sql_items;
//exit();
$ios_json = "[";
$db->query($sql_items);
while(($rs = $db->fetch_assoc()) !==false)
{
    $ios_json = $ios_json.json_encode($rs).','; 
}
$ios_json = substr($ios_json, 0, strlen($ios_json)-1);
$ios_json = $ios_json.']';
echo $ios_json;
