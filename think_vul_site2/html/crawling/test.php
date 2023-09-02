<?php
    include "../lib/simple_html_dom.php";
    include "page_crawing.php";
    
    $html = file_get_html('https://cafe.naver.com/boanproject');

        // 모든 이미지 태그를 검색 후 주소 출력
    $i = 0;
    foreach($html->find("div.inner_list") as $element) {
        $i++;
        echo $i.'.'.'<strong>'.$element->plaintext.'</strong>'.'<br><br>';
    }
?>