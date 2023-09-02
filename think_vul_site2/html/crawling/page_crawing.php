<?php
    function sw(){
        $html = file_get_html('http://tusw.tu.ac.kr/pages/sub.htm?nav_code=tus1546422118');

        // 모든 이미지 태그를 검색 후 주소 출력
        $i = 0;
        foreach($html->find("td.subject") as $element) {
            $i++;
            echo $i.'.'.'<strong>'.$element->plaintext.'</strong>'.'<br><br>';
        }
    }

    function ourSec(){
        
    }

    function secNew(){
        $html = file_get_html('https://www.boannews.com/media/t_list.asp');

        // 모든 이미지 태그를 검색 후 주소 출력
        $i = 0;
        foreach($html->find("span.news_txt") as $element) {
            $i++;
            echo $i.'.'.'<strong>'.$element.'</strong>'.'<br><br>';
        }
    }

    function rankNew(){
        $html = file_get_html('https://media.naver.com/press/022/ranking');

        // 모든 이미지 태그를 검색 후 주소 출력
        $i = 0;
        foreach($html->find("strong.list_title") as $element) {
            $i++;
            echo $i.'.'.$element.'<br><br>';
        }
    }

    function rankSearch(){
        $html = file_get_html('https://trends.google.co.kr/trends/trendingsearches/daily/rss?geo=KR');
	
        // 모든 이미지 태그를 검색 후 주소 출력
        $i = 0;
        foreach($html->find("item") as $element) {
            $i++;
            echo $i.'.'.'<strong>'.$element->find("title",0)->plaintext.'</strong>'.'<br>';
            echo '<small>'.$element->find("ht:news_item_title",0)->plaintext.'</small><br><br>';
        }
    }
?>
