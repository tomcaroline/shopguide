<?php
/**
 * json 生成,分析 支持中文
 */
class Json_Helper {
    /**
     * 生成json
     */
    public static function encode($str){
        if(gettype($str)=="array")
        {
            foreach ($str as $key=>$value)
            {
                $str[$key] = urlencode($value);
            }
        }
        
        return urldecode(json_encode($str));
    }

    /**
     * 分析json
     */
    public static function decode($str) {
        return json_decode($str);
    }
}
?>