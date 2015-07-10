<?php
/**
 * 参数处理类  防止SQL注入
 * @author JasonWei
 */
class Params
{

    private $get = array();

    private $post = array();

    function __construct()
    {
        if (!empty($_GET)) {
            foreach ($_GET as $key => $val) {
                if (is_numeric($val)) {
                    $this->get[$key] = $this->getInt($val);
                } else {
                    $this->get[$key] = $this->getStr($val);
                }
            }
        }
        if (!empty($_POST)) {
            foreach ($_POST as $key => $val) {
                if (is_numeric($val)) {
                    $this->post[$key] = $this->getInt($val);
                } else {
                    $this->post[$key] = $this->getStr($val);
                }
            }
        }
    }

    public function getInt($number)
    {
        return intval($number);
    }

    public function getStr($string)
    {
        if (! get_magic_quotes_gpc()) {
            $string = addslashes($string);
        }
        return $string;
    }
    public function G()
    {
        return $this->get;
    }
    public function checkInject($string)
    {
        return eregi('select|insert|update|delete|/*|*|../|./|union|into|load_file|outfile', $string);
    }

    public function verifyId($id = null)
    {
        if (! $id || $this->checkInject($id) || ! is_numeric($id)) {
            $id = false;
        } else {
            $id = intval($id);
        }
        return $id;
    }
}
