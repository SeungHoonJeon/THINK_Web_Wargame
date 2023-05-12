<?php
    //변수가 숫자인지 아닌지 판별하고 숫자가 아니라면 NULL로 초기화.
    function IsNum($IsNum){
        $IsNum = intval($IsNum);
        if($IsNum == 0){
            $IsNum = "NULL";
            return $IsNum;
        }else{
            return $IsNum;
        }
    }
/*
    function IsNum($IsNum){
        $IsNum = intval($IsNum);
        if($IsNum == 0){
            echo "<script>alert('파라미터 변조 금지');history.back(-1);</script>";
            exit();
        }else{
            return $IsNum;
        }
    }
*/

    //XSS방지
    function xssSec($data){
        // Fix &entity\n;
        $data = str_replace(array('&amp;','&lt;','&gt;'), array('&amp;amp;','&amp;lt;','&amp;gt;'), $data);
        $data = preg_replace('/(&#*\w+)[\x00-\x20]+;/u', '$1;', $data);
        $data = preg_replace('/(&#x*[0-9A-F]+);*/iu', '$1;', $data);
        $data = html_entity_decode($data, ENT_COMPAT, 'UTF-8');

        // Remove any attribute starting with "on" or xmlns
        $data = preg_replace('#(<[^>]+?[\x00-\x20"\'])(?:on|xmlns)[^>]*+>#iu', '$1>', $data);

        // Remove javascript: and vbscript: protocols
        $data = preg_replace('#([a-z]*)[\x00-\x20]*=[\x00-\x20]*([`\'"]*)[\x00-\x20]*j[\x00-\x20]*a[\x00-\x20]*v[\x00-\x20]*a[\x00-\x20]*s[\x00-\x20]*c[\x00-\x20]*r[\x00-\x20]*i[\x00-\x20]*p[\x00-\x20]*t[\x00-\x20]*:#iu', '$1=$2nojavascript...', $data);
        $data = preg_replace('#([a-z]*)[\x00-\x20]*=([\'"]*)[\x00-\x20]*v[\x00-\x20]*b[\x00-\x20]*s[\x00-\x20]*c[\x00-\x20]*r[\x00-\x20]*i[\x00-\x20]*p[\x00-\x20]*t[\x00-\x20]*:#iu', '$1=$2novbscript...', $data);
        $data = preg_replace('#([a-z]*)[\x00-\x20]*=([\'"]*)[\x00-\x20]*-moz-binding[\x00-\x20]*:#u', '$1=$2nomozbinding...', $data);

        // Only works in IE: <span style="width: expression(alert('Ping!'));"></span>
        $data = preg_replace('#(<[^>]+?)style[\x00-\x20]*=[\x00-\x20]*[`\'"]*.*?expression[\x00-\x20]*\([^>]*+>#i', '$1>', $data);
        $data = preg_replace('#(<[^>]+?)style[\x00-\x20]*=[\x00-\x20]*[`\'"]*.*?behaviour[\x00-\x20]*\([^>]*+>#i', '$1>', $data);
        $data = preg_replace('#(<[^>]+?)style[\x00-\x20]*=[\x00-\x20]*[`\'"]*.*?s[\x00-\x20]*c[\x00-\x20]*r[\x00-\x20]*i[\x00-\x20]*p[\x00-\x20]*t[\x00-\x20]*:*[^>]*+>#iu', '$1>', $data);

        // Remove namespaced elements (we do not need them)
        $data = preg_replace('#</*\w+:\w[^>]*+>#i', '', $data);

        do
        {
            // Remove really unwanted tags
            $old_data = $data;
            $data = preg_replace('#</*(?:applet|b(?:ase|gsound|link)|embed|frame(?:set)?|i(?:frame|layer)|l(?:ayer|ink)|meta|object|s(?:cript|tyle)|title|xml)[^>]*+>#i', '', $data);
        }
        while ($old_data !== $data);

        // we are done...
        return $data;
    }

    //게시글 제목 입력값 유효처리 최소 1글자 ~ 최대 50 및 XSS 방지
    function titleSec($title){
        $title_len = strlen(trim($title));
        if($title_len < 1 || $title_len > 100){
            echo "<script>alert('게시글 제목은 최소 1 글자 ~ 최대 50 글자만 허용합니다.');history.back(-1);</script>";
            exit();
        }
        
        return xssSec($title);
    }

    //게시글 본문 입력값 유효처리 최소 1글자 ~ 최대 300 및 XSS 방지
    function contentSec($content){
        $content_len = strlen(trim($content));

        if($content_len < 1 || $content_len > 300){
            echo "<script>alert('게시글 본문은 최소 1글자 ~ 최대 300만 허용합니다.');history.back(-1);</script>";
            exit();
        }

        return xssSec($content);
    }
?>